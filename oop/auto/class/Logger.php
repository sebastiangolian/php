<?php
class Logger
{
    private static $instance;
    private $messages = [];
    private $break = "<br />";
    
    private function __construct() {}
    private function __clone() {}
    
    /**
     * @return Logger
     */
    public static function getInstance() 
    {
        if(self::$instance === null) {
            self::$instance = new Logger();
        }
        return self::$instance;
    }
    
    public function addLogFromObject(Object $object,$value)
    {
        $method = debug_backtrace()[1]['function'];
        array_push($this->messages, new LoggerMessage($object->getName().'.'.$method,$value));
        
    }
    
    public function addLog(LoggerMessage $message)
    {
        array_push($this->messages, $message);
    }
    
    public function getMessages()
    {
        return $this->messages;
    }
    
    public function generateAllMessages()
    {
        $ret = '';
        foreach ($this->messages as $message) {
            $ret .= "[".$message->type."] ".$message->message.$this->break;
        }
        return $ret;
    }
}

