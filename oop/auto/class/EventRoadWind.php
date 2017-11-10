<?php
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

