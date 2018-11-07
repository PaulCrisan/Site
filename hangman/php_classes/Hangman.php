<?php
namespace hangman\php_classes;

use PDO;


class Hangman extends \Core\Model
{
    //class Hangman {
    private $guessString;
    private $nrOfGuesses;
    private $timeLimit;
    private $winArray;
    private $usedChars;
    const SCORE = 100;
    private $sessionScore;
    private $hintsArray;
    private $descr;

    public function __construct($timeLimit = 2, $nrOfGuesses = 10)
    {
        $this->nrOfGuesses = $nrOfGuesses;
        $this->timeLimit = $timeLimit;
        $this->winArray = array();
        $this->usedChars = array();
        $temp = $this->queryRdmStr();

        $this->guessString = $temp['function'];
        $this->descr = $temp['description'];
        $this->hintsArray = str_split($this->guessString);

    }

    public function queryRdmStr()
    {
        //alegem random un string din baza de date in functie de cate sunt introduse
        $minId;
        $maxId;
        $temp = array();
        $str ="";
        $pdo = static::getDB();
        $sql = "SELECT `id` FROM `hangman_fun` WHERE id = (SELECT MIN(id) FROM hangman_fun)";
        $sql2 = "SELECT `id` FROM `hangman_fun` WHERE id = (SELECT MAX(id) FROM hangman_fun)";
        $stmt = $pdo->query($sql);
        $row = $stmt->fetch();
        $minId = $row["id"];


        $stmt = $pdo->query($sql2);
        $row = $stmt->fetch();
        $maxId = $row["id"];


        do {
            $rdm = rand($minId, $maxId);
            $sql3 = "SELECT `function`,`descr` FROM `hangman_fun` WHERE id = '$rdm'";
            $stmt = $pdo->query($sql3);
            $row = $stmt->fetch();
            //var_dump($row['descr']. " prima" . $row["function"]);
            $temp["function"] = $row["function"];
            $temp["description"] = $row["descr"];


        } while (strlen($temp['function']) == 0);
        return $temp;
    }

    public function useHint()
    {
        //logica pentru afisarea hint-urilor
        $char ="";
        //verificare cate litere mai sunt in array fara cele null
        if (count(array_filter($this->hintsArray)) > 1) {
            do {
                $char = $this->hintsArray[rand(0, count($this->hintsArray)-1)];
            } while ($char == null);
        } else {
            return array("hint" => "none");
        }
        //folosim metoda checkChar deja creata pentru verificari
        $s = $this->checkChar($char);

        $this->removePoints('hint');
        return $s;
    }

    public function checkWin()
    {
        if (count(array_diff(str_split($this->guessString), $this->winArray)) == 0) {
            return "win";
        }
    }

    public function checkChar($char_)
    {
        $positions = array();
        if (strpos($this->guessString, $char_) !== false) {
            $tempArray = str_split($this->guessString);
            for ($i=0; $i < count($tempArray) ; $i++) {
                if ($tempArray[$i] == $char_) {
                    $positions[] = $i;
                    $this->winArray[] = $char_ ;
                    // eliminam literele gasite din array de hint pentru a nu fi repetate
                    $this->hintsArray[$i] = null;
                }
            }
            $positions = array($char_ => $positions);
            return $positions;
        } else {
            if (!in_array($char_, $this->usedChars)) {
                $this->usedChars[] = $char_;
                $this->nrOfGuesses --;
                $this->removePoints('check');
            }
        }
        return $positions;
    }

    public function removePoints($type)
    {
        if ($type == 'hint') {
            //adaugam 20 puncte respectiv 1 punct
            $this->sessionScore += 20;
        } elseif ($type == 'check') {
            $this->sessionScore += 5;
        }
    }

    public function calculateScore($time)
    {
        if ($time != null && strpbrk($time, '1234567890') !== false) {
            $baseTime = ($this->timeLimit * 60)/120;
            $time = round(60-(($time/$baseTime)/2));
        } else {
            $time = 0;
        }
        $score = (Hangman::SCORE - $this->sessionScore)-$time;
        if ($score <= 0) {
            $score = 0;
        }
        return $score;
    }

    public function getNrOFGuesses()
    {
        return $this->nrOfGuesses;
    }

    public function getUsedChars()
    {
        return $this->usedChars;
    }

    public function getGuessStringCount()
    {
        return strlen($this->guessString);
    }

    public function getGuessString()
    {
        return $this->guessString;
    }
    public function getDescrString()
    {
        return $this->descr;
    }

    public function getTimeLimit()
    {
        return $this->timeLimit;
    }
}
