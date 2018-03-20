<?php
namespace sebastiangolian\php\logger;

/*
 Logger::getInstance()->addDefaultLog('test');
 Logger::getInstance()->addLog(new Message('type', 'message'));
 $loggerHtml = new LoggerFile(Logger::getInstance());
 echo $loggerHtml->saveToFile();
 */
class LoggerFile
{
    private $logger;
    
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }
    
    /**
     * Save all logs to file
     * @return number
     */
    public function saveToFile()
    {
        $text = "";
        $break = "\n";
        foreach ($this->logger->getMessages() as $message) {
            $text .= $message->getDateTime()." - [".$message->getType()."] ".$message->getMessage().$break;
        }
        
        $file = "logger.txt";
        if (is_file($file))
        {
            $currentData = file_get_contents($file);
            $text = $text.$currentData;
        }
        
        return file_put_contents($file,$text);
    }
}