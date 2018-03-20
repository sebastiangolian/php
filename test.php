<?php
use sebastiangolian\php\logger\Logger;
use sebastiangolian\php\logger\LoggerFile;
use sebastiangolian\php\logger\Message;

Logger::getInstance()->addDefaultLog('test');
Logger::getInstance()->addLog(new Message('type', 'message'));

echo Logger::getInstance()->generateAllMessages();
$loggerHtml = new LoggerFile(Logger::getInstance());
echo $loggerHtml->saveToFile();
 
