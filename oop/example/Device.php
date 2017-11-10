<?php

/*
    $computer = new Computer();
    $computer->turnOn()->turnOff();
    
    $monitor = new MessageMonitor();
    $monitor->printMessages();
 */
class Message
{
    private $text;
    
    public function __construct($text)
    {
        $this->setText($text);
    }
    
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }
    
    public function getText()
    {
        return $this->text;
    }
}

class MessageCollection
{
    private static $instance;
    private static $messages = array();
    public static function getInstance() {
        if(self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    public static function addMessage(Message $message)
    {
        array_push(self::$messages, $message);
    }
    
    public static function getMessages()
    {
        return self::$messages;
    }
}

class MessageMonitor
{
    public function printMessages()
    {
        $ret = '';
        $messages = MessageCollection::getMessages();
        if(count($messages) == 0){
            $ret = 'Brak wiadomości';
        }
        else
        {
            foreach ($messages as $message)
            {
                $ret .= $message->getText().'<br />';
            }
        }
        echo $ret;
    }
}

interface DeviceInterface
{
    public function turnOn();
    public function turnOff();
}

class Computer implements DeviceInterface
{
    public function turnOn()
    {
        MessageCollection::addMessage(new Message('computer.turnOn'));
        return $this;
    }
    
    public function turnOff()
    {
        MessageCollection::addMessage(new Message('computer.turnOff'));
        return $this;
    }
}