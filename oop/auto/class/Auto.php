<?php
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

