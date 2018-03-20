<?php
namespace sebastiangolian\php\logger;

/*
    Logger::getInstance()->addDefaultLog('test');
    Logger::getInstance()->addLog(new Message('type', 'message'));
    $loggerHtml = new LoggerHtml(Logger::getInstance());
    echo $loggerHtml->generateAllMessages();
 */
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
        $ret .= "<tr><th>datetime</th><th>type</th><th>message</th></tr>";
        foreach ($this->logger->getMessages() as $message) {
            $ret .= "<tr><td>{$message->getDateTime()}</td><td>{$message->getType()}</td><td>{$message->getMessage()}</td></tr>";
        }
        $ret .= "</table>";
        return $ret;
    }
}