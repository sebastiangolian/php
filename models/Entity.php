<?php
namespace sebastiangolian\php\models;

use sebastiangolian\php\base\Model;

/**
 * Jednostka
 */
abstract class Entity extends Model
{
    protected $name;
    protected $id;
    
    public $addresses = array();
    public $phoneNumbers = array();
    public $emails = array();
    
    /**
     * Validation object
     * @return boolean
     */
    public function validate()
    {
        if(empty($this->name)){$this->errors['name'] = 'Pole name jest wymagane';}
        if(empty($this->id)){$this->errors['id'] = 'Pole id jest wymagane';}
        
        if(count($this->errors) > 0){
            return false;
        } else {
            return true;
        }
    }
}

