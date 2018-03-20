<?php
namespace sebastiangolian\php\logger;

class Message
{
    /**
     * @var string
     */
    protected $type;
    
    /**
     * @var string
     */
    protected $message;
    
    /**
     * @var string
     */
    protected $datetime;
    
    /**
     * @param string $type
     * @param string $message
     */
    public function __construct($type,$message)
    {
        $this->type = $type;
        $this->message = $message;
        $this->datetime = date('Y-m-d H:i:s.').substr(microtime(), 2, 5);
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
    
    /**
     * @return string
     */
    public function getDateTime()
    {
        return $this->datetime;
    }
}