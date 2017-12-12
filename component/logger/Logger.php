<?php
namespace sebastiangolian\php\component\logger;

use sebastiangolian\php\base\Object;

class Logger
{
    private static $instance;
    private $messages = [];
    
    private function __construct() {}
    private function __clone() {}
    
    /**
     * @return Logger
     */
    public static function getInstance()
    {
        if(self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    /**
     * Logger::getInstance()->addLogInObject($this,$name);
     * @param Object $object
     * @param string $message
     */
    public function addLogInObject(Object $object, $message)
    {
        $method = debug_backtrace()[1]['function'];
        array_push($this->messages, new LoggerMessage($object->getName().'.'.$method,$message));
    }
    
    /**
     * Logger::getInstance()->addLog(new LoggerMessage('category1','message1'));
     * @param LoggerMessage $message
     */
    public function addLog(LoggerMessage $message)
    {
        array_push($this->messages, $message);
    }
    
    /**
     * Logger::getInstance()->addDefaultLog('message default log');
     * @param string $message
     */
    public function addDefaultLog($message)
    {
        $this->addLog(new LoggerMessage('default', $message));
    }
    
    /**
     * Return all messages
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }
    
    /**
     * Return all messages in string with break
     * @param string $break
     * @return string
     */
    public function generateAllMessages($break = "<br />")
    {
        $ret = '';
        foreach ($this->messages as $message) {
            $ret .= "[".$message->type."] ".$message->message.$break;
        }
        return $ret;
    }
}