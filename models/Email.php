<?php
namespace sebastiangolian\php\models;

use sebastiangolian\php\base\Model;

class Email extends Model
{
    protected $email;   
    protected $type;                
    
    /**
     * Validation object
     * @return boolean
     */
    public function validate()
    {
        if(empty($this->email)){$this->errors['email'] = 'Pole email jest wymagane';}
        if(empty($this->type)){$this->errors['type'] = 'Pole type jest wymagane';}
        
        if(count($this->errors) > 0){
            return false;
        } else {
            return true;
        }
    }
    
    /**
     * Set firstname property
     * @param string $value
     */
    public function setEmail($value)
    {
        $this->email = strtolower(trim($value));
    }
}

