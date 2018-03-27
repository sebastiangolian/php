<?php

use sebastiangolian\php\logger\Logger;

class Test
{
    private $test = 'test';
}

$class = new Test();
$arr = ['key'=> 'value','key1'=> 'value1','key2'=> 'value2'];

Logger::getInstance()->add($class);
Logger::getInstance()->add($arr);
Logger::getInstance()->add('XYZ');

echo Logger::getInstance()->generateAllMessages();