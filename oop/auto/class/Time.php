<?php
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

