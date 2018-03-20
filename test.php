<?php
use sebastiangolian\php\logger\Logger;
use sebastiangolian\php\logger\LoggerMessage;

Logger::getInstance()->addDefaultLog('test');
Logger::getInstance()->addLog(new LoggerMessage('type', 'message'));

echo Logger::getInstance()->generateAllMessages();
