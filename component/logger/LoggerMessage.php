<?php
namespace sebastiangolian\php\component\logger;

class LoggerMessage
{
    public $type;
    public $message;
    
    public function __construct($type,$message)
    {
        $this->type = $type;
        $this->message = $message;
    }
}