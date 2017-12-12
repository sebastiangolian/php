<?php
namespace sebastiangolian\php\component\logger;

class LoggerHtml
{
    private $logger;
    
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }
    
    /**
     * Generate all messages in html table
     * @return string
     */
    public function generateAllMessages()
    {
        $ret = "<table>";
        $ret .= "<tr><th>type</th><th>message</th></tr>";
        foreach ($this->logger->getMessages() as $message) {
            $ret .= "<tr><td>{$message->type}</td><td>{$message->message}</td></tr>";
        }
        $ret .= "</table>";
        return $ret;
    }
}