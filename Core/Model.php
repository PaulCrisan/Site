<?php
namespace Core;
use PDO;
use App\Config;

abstract class Model{

protected static function getDB(){
  static $db = null;

  if($db === null){
  

    $dsn = 'mysql:host='. Config::HOST .
            ';dbname='. Config::DB_NAME .
            ';charset=' . Config::CHARSET .
            ';';

      $db = new PDO($dsn, Config::USER, Config::PASSWORD);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;

  }
}

}
