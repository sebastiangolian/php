<?php
namespace sebastiangolian\php\components;

use Exception;
use sebastiangolian\php\base\Component;

/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 * 
 * PHP Component allows send sms message
 * 
 * $smsSender = new SmsSender(['+48777777777@text.plusgsm.pl','subject','message','from']);
 * $smsSender->send();
 */
class SmsSender extends Component
{
    /**
     * Receiver, or receivers of the message.
     * @var string 
     */
    public $to;
    
    /**
     * Subject of the message to be sent.
     * @var string 
     */
    public $subject;
    
    /**
     * Message to be sent.
     * @var string 
     */
    public $message;
    
    /**
     * Name of sender message. Example: example.com
     * @var string 
     */
    public $from;
    
    /**
     * Send sms message
     * @return mixed
     */
    public function send()
    {
        try {
            return mail(
                $this->to,
                $this->subject,
                $this->message,
                "From:<".$this->from.">\r\n"
            );
        } 
        catch (Exception $e) {
            return 'Caught exception: '.$e->getMessage()."\n";
        }
    }
}