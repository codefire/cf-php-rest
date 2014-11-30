<?php
set_include_path(get_include_path() . PATH_SEPARATOR . realpath(dirname(__FILE__) . '/../vendor/') . PATH_SEPARATOR . realpath(dirname(__FILE__) . '/../app/'));
function __autoload($class_name)
{
    $filename = $class_name . '.php';
    include $filename;
}

if(!defined('BASE_URL')){
    define('BASE_URL', (getenv('BASE_URL') ? getenv('BASE_URL') : '/'));
}

$request = new CodeFire\Request($_SERVER['REQUEST_URI'], BASE_URL);
$router = new CodeFire\Router\Api($request);
$route = $router->getRoute();

if(!empty($route->version) && is_numeric($route->version)){

    $dir = realpath(dirname(__FILE__).'/../app/versions/v'.$route->version.'/handlers');
    set_include_path(get_include_path() . PATH_SEPARATOR . $dir);

    $class = ucfirst($route->handler);
    $handler = new $class();

    if(is_object($handler)){
        $command = $route->command.'Command';
        if(method_exists($handler, $command)){
            $response = $handler->$command();
        }else{
            echo 'could not find command '.$class.'::'.$command;
        }
    }
}else{
    echo 'no/invalid version given';
}
