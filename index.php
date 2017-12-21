<?php

use sebastiangolian\php\mvc\core\Router;

function __autoload($class) {
    $class = str_replace("sebastiangolian\php\\","", $class);
    $class = str_replace("\\","/", $class) . '.php';
    require_once($class);
}

error_reporting(E_ALL);
set_error_handler('sebastiangolian\php\mvc\core\Error::errorHandler');
set_exception_handler('sebastiangolian\php\mvc\core\Error::exceptionHandler');

$router = new Router();
$router->add('', ['controller' => 'Index', 'action' => 'home']);
$router->add('{controller}/{action}');
$router->dispatch($_SERVER['QUERY_STRING']);

require_once 'test.php';