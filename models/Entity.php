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
    
    /**
     *
     * @var AddressCollection
     */
    public $addresses;
    
    /**
     *
     * @var PhoneNumberCollection
     */
    public $phoneNumbers;
    
    /**
     *
     * @var EmailCollection
     */
    public $emails;
    
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
    
    public function addAddress(Address $address)
    {
        $this->isAddressCollection();
        $this->addresses->addItem($address);
        return $this;
    }
    
    public function removeAddress($key)
    {
        $this->isAddressCollection();
        if($this->addresses->exists($key)){
            $this->addresses->removeItem($key);
        }
        return $this;
    }
    
    private function isAddressCollection()
    {
        if(!isset($this->addresses)){
            $this->addresses = new AddressCollection();
        }
    }
    
    public function addPhoneNumber(PhoneNumber $phoneNumber)
    {
        $this->isPhoneNumberCollection();
        $this->phoneNumbers->addItem($phoneNumber);
        return $this;
    }
    
    public function removePhoneNumber($key)
    {
        $this->isPhoneNumberCollection();
        if($this->phoneNumbers->exists($key)){
            $this->phoneNumbers->removeItem($key);
        }
        return $this;
    }
    
    private function isPhoneNumberCollection()
    {
        if(!isset($this->phoneNumbers)){
            $this->phoneNumbers = new PhoneNumberCollection();
        }
    }
    
    public function addEmail(Email $email)
    {
        $this->isEmailCollection();
        $this->emails->addItem($email);
        return $this;
    }
    
    public function removeEmail($key)
    {
        $this->isEmailCollection();
        if($this->emails->exists($key)){
            $this->emails->removeItem($key);
        }
        return $this;
    }
    
    private function isEmailCollection()
    {
        if(!isset($this->emails)){
            $this->emails = new EmailCollection();
        }
    }
}

