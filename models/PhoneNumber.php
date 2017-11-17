<?php
namespace sebastiangolian\php\models;

use sebastiangolian\php\base\Model;

class PhoneNumber extends Model
{
    protected $number;
    protected $type;
    
    /**
     * Validation object
     * @return boolean
     */
    public function validate()
    {
        if(empty($this->number)){$this->errors['number'] = 'Pole number jest wymagane';}
        if(empty($this->type)){$this->errors['type'] = 'Pole type jest wymagane';}
        
        if(count($this->errors) > 0){
            return false;
        } else {
            return true;
        }
    }
}

