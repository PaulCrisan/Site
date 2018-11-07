<?php
namespace Core;

class View{

public static function render($view = null, $args = []){
    extract($args, EXTR_SKIP);
    $file = "App/Views/template.php";
    $page = $view;

    $cssLink = explode('/',$view);
    $link = "http://localhost/public_html/public/css/".$cssLink[0]. "/" . lcfirst((explode(".", $cssLink[1]))[0]).".css";
    $script = "http://localhost/public_html/public/js/".$cssLink[0]. "/" . lcfirst((explode(".", $cssLink[1]))[0]).".js";
    if(is_readable($file)){
      require $file;
    } else {
      throw new \Exception("$file not found");
    }
  }
}


