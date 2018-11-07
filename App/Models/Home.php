<?php
namespace App\Models;
use PDO;

class Home extends \Core\Model{

public static function setTime(){
  try{
    $pdo = static::getDB();
    $sql = "INSERT INTO `counter`(`date`) VALUES (?)";
    $date = date('Y-m-d H:i:s');
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$date]);


    }catch (PDOException $e){
      echo $e->getMessage();
    }
}

}
