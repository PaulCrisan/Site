<?php
namespace App\Controllers;

use Core\View;
use hangman\php_classes\Hangman as Hangman;

class Php extends \Core\Controller
{
    public function ModelViewControllerAction()
    {
        View::render('Php/mvc.php');
    }
    public function hangmanPhpGameAction()
    {
        $displayblock = "_" ;
        $currUser = "";
        $hidden ="";
        session_start();
        if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
            $user = new Users($_COOKIE['username'], $_COOKIE['password']);
            if ($user->checkUserPassword(false)) {
                $_SESSION['user'] = $user->getUser();
            }
        }
        if (!isset($_SESSION['game'])) {
            if (isset($_SESSION['time'])) {
                $_SESSION['game'] = new Hangman($_SESSION['time']);
            } else {
                $_SESSION['game'] = new Hangman();
            }
        }
        if (isset($_SESSION['user'])) {
            $hidden = "style = 'display:none'";
            $currUser = "<div class ='links'>
                      <p id= 'loggedUser' class='txt title'>Welcome, ".$_SESSION['user']. "&nbsp;</p>
                      <a href='logIn.php'>
                      <p id= 'logOut' class='link-text margin-ls'> / Log out </p>
                      </a>
                   </div>";
            $_SESSION['score'] = new Score();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['info']) && strlen($_POST['info']) != 0) {
                if ($_POST['info'] == 'hint') {
                    $ar = array('check_char_array' => $_SESSION['game']->useHint());
                    echo json_encode($ar);
                    exit;
                } elseif (strlen($_POST['info']) == 1) {
                    $ar = array('check_char_array' => $_SESSION['game']->checkChar($_POST["info"]),
                        'time_limit'     => $_SESSION['game']->getTimeLimit(),
                         'check_win'     => $_SESSION['game']->checkWin(),
                         'used_chars'    => $_SESSION['game']->getUsedChars(),
                      'guesses_left'     => $_SESSION['game']->getNrOFGuesses());
                    echo json_encode($ar);
                    exit;
                } elseif ($_POST['info'] == 'loadInfo') {
                    $ar = array(
                    'description'=>$_SESSION['game']->getDescrString()
                );
                    echo json_encode($ar);
                    exit;
                } elseif ($_POST['info'] == 'logOut') {
                    $_SESSION[] = array();
                    session_destroy();
                    setcookie('username', "", 1);
                    setcookie('password', "", 1);
                    exit;
                }
            } elseif (isset($_POST['score']) && strlen($_POST['score']) != 0) {
                $score = $_SESSION['game']->calculateScore($_POST['score']);
                $topscore = array();
                if (isset($_SESSION['score'])) {
                    $topscore =$_SESSION['score']->getMultipleScores($_SESSION['user']);
                    $_SESSION['score']->insertScore($score, $_SESSION['user']);
                }
                $ar = array(
                    'score'=>$score,
                 'topscore'=>$topscore
                );

                echo json_encode($ar);
                exit;
            }


            if (isset($_POST['restart'])) {
                if ($_POST['restart'] != null) {
                    $_SESSION['time'] = $_POST['restart'] ;
                }
                unset($_SESSION['game']);
                header("Location: http://localhost/public_html/php/hangman-php-game");
                exit;
            }
        }



        View::render('Php/hangman.php', ['displayblock' => $displayblock, 'currUser' => $currUser, 'hidden'=> $hidden]);
    }
}
