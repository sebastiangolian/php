<?php
/*
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
 */







use sebastiangolian\php\component\logger\Logger;

abstract class Object
{
    protected $name;
    public function getName()
    {
        if($this->name == null){
            return get_called_class();
        }
        else {
            return $this->name;
        }
    }
}

interface TimeObserver {
    public function update(Time $time);
}

class Time {
    private static $instance;
    private $time;
    private $observers = [];
    private function __construct() {}
    private function __clone() {}
    
    /**
     *
     * @return Time
     */
    public static function getInstance()
    {
        if(self::$instance === null) {
            self::$instance = new Time();
        }
        return self::$instance;
    }
    
    public function setTime($time)
    {
        $this->time = $time;
    }
    
    public function getTime()
    {
        return $this->time;
    }
    
    public function addTime($diffTime)
    {
        $this->time += $diffTime;
        $this->updateObserver();
    }
    
    public function addObserver(TimeObserver $observer)
    {
        $this->observers[spl_object_hash($observer)] = $observer;
    }
    
    public function removeObserver(TimeObserver $observer)
    {
        unset($this->observers[spl_object_hash($observer)]);
    }
    
    public function updateObserver()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}

class Auto extends Object implements TimeObserver
{
    private $position = 0;
    private $speed = 0;
    
    private $eventList = [];
    
    public function __construct($name,$position = 0) {
        $this->setName($name);
        $this->setPosition($position);
    }
    
    public function setName($name)
    {
        Logger::getInstance()->addLogFromObject($this,$name);
        $this->name = $name;
    }
    
    public function setPosition($position)
    {
        Logger::getInstance()->addLogFromObject($this,$position);
        $this->position = $position;
    }
    
    public function changePosition($differencePosition)
    {
        Logger::getInstance()->addLogFromObject($this,$differencePosition);
        $this->position += $differencePosition;
    }
    
    public function setSpeed($speed)
    {
        Logger::getInstance()->addLogFromObject($this,$speed);
        $this->speed = $speed;
    }
    
    public function getSpeed()
    {
        return $this->speed;
    }
    
    public function changeSpeed($differenceSpeed)
    {
        Logger::getInstance()->addLogFromObject($this,$differenceSpeed);
        $this->speed += $differenceSpeed;
    }
    
    public function addEvent(EventAuto $event)
    {
        Logger::getInstance()->addLogFromObject($this,$event->getName());
        $event->setAuto($this);
        array_push($this->eventList, $event);
    }
    
    public function update(Time $time)
    {
        $this->changePosition($this->speed * $time->getTime());
    }
}

class Road extends Object
{
    private $autoList = [];
    private $eventList = [];
    
    public function __construct($name)
    {
        $this->setName($name);
    }
    
    public function setName($name)
    {
        Logger::getInstance()->addLogFromObject($this,$name);
        $this->name = $name;
    }
    
    public function addAuto(Auto $auto)
    {
        Logger::getInstance()->addLogFromObject($this,$auto->getName());
        array_push($this->autoList,$auto);
    }
    
    public function getAutos()
    {
        return $this->autoList;
    }
    
    public function getAutoNames()
    {
        $autoNames = [];
        foreach ($this->autoList as $auto) {
            array_push($autoNames,$auto->getName());
        }
        return $autoNames;
    }
    
    public function addEvent(EventRoad $event)
    {
        Logger::getInstance()->addLogFromObject($this,$event->getName());
        $event->setRoad($this);
        array_push($this->eventList,$event);
    }
}

interface Event
{
    public function getName();
}

interface EventAuto
{
    public function getName();
    public function setAuto(Auto $auto);
}

class EventAutoStart extends Object implements EventAuto
{
    private $auto;
    private $speed;
    
    public function __construct($speed)
    {
        $this->speed = $speed;
    }
    
    public function setAuto(Auto $auto)
    {
        Logger::getInstance()->addLogFromObject($this,$auto->getName());
        $this->auto = $auto;
        $this->auto->setSpeed($this->speed);
    }
}

interface EventRoad extends Event
{
    public function setRoad(Road $road);
}

class EventRoadWind extends Object implements EventRoad
{
    private $roads = [];
    private $windPower = 0;
    
    public function __construct($windPower)
    {
        $this->windPower = $windPower;
    }
    
    public function setRoad(Road $road) {
        Logger::getInstance()->addLogFromObject($this,$road->getName());
        array_push($this->roads,$road);
        $this->influenceWindToAutos();
    }
    
    private function influenceWindToAutos()
    {
        foreach ($this->roads as $road) {
            foreach ($road->getAutos() as $auto) {
                $auto->changeSpeed(-$this->windPower);
            }
        }
    }
}
