<?php
namespace Core;
class Router{

protected $routes = [];
protected $params = [];


public function add($route, $params = []){

    $route = preg_replace('/\//', '\\/', $route);
    $route = preg_replace('/\{([a-z]+)\}/', '(?P<$1>[a-z-]+)', $route);
    $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)' , $route);
    $route = '/^' . $route . '$/i';
    $this->routes[$route] = $params;

}

public function matchURL($url){
  foreach ($this->routes as $route => $params) {

    if(preg_match($route, $url, $matches)){
        foreach ($matches as $key => $match) {
          if(is_string($key)){
            $params[$key] = $match;
          }
        }
        $this->params = $params;
        return true;
    }
  }
  return false;
}
public function assign($url){
  $url = $this->removeQueryVariables($url);
  if($this->matchURL($url)){
    $controller = $this->params['controller'];
    $controller = $this->studlyCapsConversion($controller);
    $controller = $this->getNamespace() . $controller;
    if(class_exists($controller)){
      $controller_obj = new $controller($this->params);
      $action = $this->params['action'];
      $action = $this->camelCaseConversion($action);
      if(is_callable([$controller_obj, $action])){
        $controller_obj->$action();
      }else {
       
        throw new \Exception("Method $action (in controller $controller) not found");

      }

    }else {
    
      throw new \Exception("Controller class $controller not found");
    }
  }else {
  
    throw new \Exception("No route matched", 404);
  }

}
public function removeQueryVariables($url){
  if($url != ''){
    $s = explode("&", $url, 2);
    if(strpos($s[0], '=') === false){
      $url = $s[0];
    }else $url = '';
  }
  return $url;
}
protected function studlyCapsConversion($string){
  $string = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
  return $string;
}
protected function camelCaseConversion($string){
  return lcfirst($this->studlyCapsConversion($string));
}
protected function getNamespace(){
  $namespace = 'App\Controllers\\';
  if(array_key_exists('namespace', $this->params)){
    $namespace .= $this->params['namespace'] . '\\';
  }
  return $namespace;
}

}
