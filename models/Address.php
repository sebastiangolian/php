<?php
namespace sebastiangolian\php\models;

use sebastiangolian\php\base\Model;

/*
Address::create()->setStreet('Długa 28')->setPostcode('20-000')->setCity('Warszawa')->toString();
*/
class Address extends Model
{
    protected $street = '';
    protected $postcode = '';
    protected $city = '';
    
    /**
     * {@inheritDoc}
     * @see \sebastiangolian\php\base\Model::validate()
     */
    public function validate()
    {
        if(empty($this->street)){$this->errors['street'] = 'Pole street jest wymagane';}
        if(empty($this->postcode)){$this->errors['postCode'] = 'Pole postCode jest wymagane';}
        if(empty($this->city)){$this->errors['city'] = 'Pole city jest wymagane';}
        
        if(count($this->errors) > 0){
            return false;
        } else {
            return true;
        }
    }
    
    /**
     * @param string $street
     * @return $this
     */
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }
    
    /**
     * @param string $postcode
     * @return $this
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }
    
    /**
     * @param string $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }
}
