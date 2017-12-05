<?php
namespace sebastiangolian\php\models;

use sebastiangolian\php\base\Model;

/**
 * Jednostka
 */
abstract class Entity extends Model
{
    /**
     * @var AddressCollection
     */
    protected $addresses;
    
    /**
     * @var PhoneCollection
     */
    protected $phones;
    
    /**
     * @var EmailCollection
     */
    protected $emails;
    
    
    /**
     * @param Address $address
     * @return $this
     */
    public function addAddress(Address $address)
    {
        $this->initAddressCollection();
        $this->addresses->addItem($address,$address->getId());
        return $this;
    }
    
    /**
     * @param int $key
     * @return $this
     */
    public function removeAddress($key)
    {
        $this->initAddressCollection();
        if($this->addresses->exists($key)){
            $this->addresses->removeItem($key);
        }
        return $this;
    }
    
    /**
     * @return $this
     */
    private function initAddressCollection()
    {
        if(!isset($this->addresses)){
            $this->addresses = new AddressCollection();
        }
        return $this;
    }
    
    /** 
     * @param Phone $phone
     * @return $this
     */
    public function addPhone(Phone $phone)
    {
        $this->initPhoneCollection();
        $this->phones->addItem($phone,$phone->getId());
        return $this;
    }
    
    /**
     * @param int $key
     * @return $this
     */
    public function removePhone($key)
    {
        $this->initPhoneNumberCollection();
        if($this->phones->exists($key)){
            $this->phones->removeItem($key);
        }
        return $this;
    }
    
    /**
     * @return $this
     */
    private function initPhoneCollection()
    {
        if(!isset($this->phones)){
            $this->phones = new PhoneCollection();
        }
        return $this;
    }
    
    /**
     * @param Email $email
     * @return $this
     */
    public function addEmail(Email $email)
    {
        $this->initEmailCollection();
        $this->emails->addItem($email,$email->getId());
        return $this;
    }
    
    /**
     * @param int $key
     * @return $this
     */
    public function removeEmail($key)
    {
        $this->initEmailCollection();
        if($this->emails->exists($key)){
            $this->emails->removeItem($key);
        }
        return $this;
    }
    
    /**
     * @return $this
     */
    private function initEmailCollection()
    {
        if(!isset($this->emails)){
            $this->emails = new EmailCollection();
        }
        
        return $this;
    }
}