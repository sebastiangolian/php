<?php 
function __autoload($class) {
    $class = str_replace("sebastiangolian\php\\","", $class);
    $class = str_replace("\\","/", $class) . '.php';
    require_once($class);
}
require_once 'test.php'; 
    
