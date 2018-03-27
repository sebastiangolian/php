<?php
namespace sebastiangolian\php\logger;

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
     * Logger::getInstance()->add('XYZ');
     * Add new log
     * @param mixed $var
     * @param string $type
     */
    public function add($var,$type = 'default')
    {
        $message = print_r($var, true);
        $objMessage = new Message($type, $message);  
        
        array_push($this->messages, $objMessage);
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