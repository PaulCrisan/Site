<?php


use Core\Router;
spl_autoload_register(function($class){
  $root = dirname(__DIR__);
  $file = $root . '/' .'public_html/'. str_replace('\\', '/' , $class) . '.php';
  if(is_readable($file)){
    require $root . '/'.'public_html/' . str_replace('\\', '/', $class) . '.php';
  }
});

error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


$url = $_SERVER['QUERY_STRING'];


$router = new Router();
$router->add('{controller}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
$router->add('',['controller' => 'Home', 'action' => 'index']);

$router->assign($url);

?>
