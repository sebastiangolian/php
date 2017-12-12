<?php
namespace sebastiangolian\php\component\logger;

class LoggerMessage
{
    /**
     * @var string
     */
    public $type;
    
    /**
     * @var string
     */
    public $message;
    
    /**
     * @param string $type
     * @param string $message
     */
    public function __construct($type,$message)
    {
        $this->type = $type;
        $this->message = $message;
    }
    
    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}