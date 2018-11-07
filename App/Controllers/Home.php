<?php
namespace App\Controllers;
use Core\View;
use App\Models\Home as H;


class Home extends \Core\Controller{

  public function indexAction(){
    H::setTime();
    View::render('Home/index.php');
  }


  protected function after(){

  }
  protected function before(){

  }
}
