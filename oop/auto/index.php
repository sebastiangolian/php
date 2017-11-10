<?php
require_once 'class/LoggerMessage.php';
require_once 'class/Logger.php';
require_once 'class/LoggerHtml.php';
require_once 'class/Object.php';
require_once 'class/Time.php';
require_once 'class/TimeObserver.php';
require_once 'class/Auto.php';
require_once 'class/Road.php';
require_once 'class/Event.php';
require_once 'class/EventAuto.php';
require_once 'class/EventAutoStart.php';
require_once 'class/EventRoad.php';
require_once 'class/EventRoadWind.php';

Time::getInstance()->setTime(1);

Logger::getInstance()->addLog(new LoggerMessage('','------------------- ADD AUTOS -------------------'));
$volvo = new Auto('LLU1234',0,0);

Logger::getInstance()->addLog(new LoggerMessage('','------------------- ADD ROAD -------------------'));
$road = new Road('Krakowska');
$road->addAuto($volvo);
$road->addAuto(new Auto('LLU1224'));

Logger::getInstance()->addLog(new LoggerMessage('','------------------- START AUTO -------------------'));
$volvo->addEvent(new EventAutoStart(100));

Logger::getInstance()->addLog(new LoggerMessage('','------------------- ADD WIND -------------------'));
$road->addEvent(new EventRoadWind(10));

Logger::getInstance()->addLog(new LoggerMessage('','------------------- ADD 100 SEC -------------------'));
Time::getInstance()->addObserver($volvo);
Time::getInstance()->addTime(100);

Logger::getInstance()->addLog(new LoggerMessage('','------------------- GET LLU1234 SPEED -------------------'));
Logger::getInstance()->addLog(new LoggerMessage('LLU1234.getSpeed',$volvo->getSpeed()));

Logger::getInstance()->addLog(new LoggerMessage('','------------------- GET AUTOS IN ROAD -------------------'));
Logger::getInstance()->addLog(new LoggerMessage('Road.getAutos',implode(', ',$road->getAutoNames())));

$loggerHtml = new LoggerHtml(Logger::getInstance());
echo $loggerHtml->generateAllMessages();



