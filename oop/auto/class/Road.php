<?php
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

