<?php
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

