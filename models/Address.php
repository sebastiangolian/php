<?php
namespace sebastiangolian\php\models;

use sebastiangolian\php\base\Model;

/*
    $address = new Address([
        'street'=>'Testowa', 
        'number'=> '10',
        'local' => '2',
        'city' => 'Lublin',
        'postCode' => '20-900',
        'type' => 'domowy'
    ]);
 */

class Address extends Model
{
    protected $street;
    protected $number;
    protected $local = '';
    protected $city;
    protected $postCode;
    protected $type;
    
    /**
     * Validation object
     * @return boolean
     */
    public function validate()
    {
        if(empty($this->street)){$this->errors['street'] = 'Pole street jest wymagane';}
        if(empty($this->number)){$this->errors['number'] = 'Pole number jest wymagane';}
        if(empty($this->city)){$this->errors['city'] = 'Pole city jest wymagane';}
        if(empty($this->postCode)){$this->errors['postCode'] = 'Pole postCode jest wymagane';}
        if(empty($this->type)){$this->errors['type'] = 'Pole type jest wymagane';}
        
        if(count($this->errors) > 0){
            return false;
        } else {
            return true;
        }
    }
}
