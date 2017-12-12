<?php


use sebastiangolian\php\component\logger\Logger;
use sebastiangolian\php\component\logger\LoggerHtml;
use sebastiangolian\php\component\logger\LoggerMessage;

require_once 'base/Autoloader.php';

Logger::getInstance()->addLog(new LoggerMessage('test','test'));

$loggerHtml = new LoggerHtml(Logger::getInstance());
$loggerHtml->generateAllMessages();