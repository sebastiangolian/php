<?php
namespace sebastiangolian\php\logger;

use sebastiangolian\php\base\Object;


/*
 Logger::getInstance()->addDefaultLog('test');
 Logger::getInstance()->addLog(new Message('type', 'message'));
 echo Logger::getInstance()->generateAllMessages();
 */

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
        array_push($this->messages, new Message($object->getName().'.'.$method,$message));
    }
    
    /**
     * Logger::getInstance()->addLog(new Message('category1','message1'));
     * @param Message $message
     */
    public function addLog(Message $message)
    {
        array_push($this->messages, $message);
    }
    
    /**
     * Logger::getInstance()->addDefaultLog('message default log');
     * @param string $message
     */
    public function addDefaultLog($message)
    {
        $this->addLog(new Message('default', $message));
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
            $ret .= $message->getDateTime()." - [".$message->getType()."] ".$message->getMessage().$break;
        }
        return $ret;
    }
}