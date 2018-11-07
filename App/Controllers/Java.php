<?php
namespace App\Controllers;
use Core\View;



class Java extends \Core\Controller{

  public function javaCourseAction(){
    View::render('Java/course.php');
  }
  public function androidApplicationsAction(){
    View::render('Java/android.php');
  }

}
