<?php
namespace sebastiangolian\php\models;

/*
$woker = Worker::create()
    ->setFirstname('Jan')
    ->setLastname('Kowalski')
    ->setGender(Worker::GENDER_MAN)
    ->addAddress(Address::create()->setStreet('Długa 28')->setPostcode('20-000')->setCity('Warszawa'))
    ->addEmail(Email::create()->setEmail('test@o2.pl')->setType(Email::TYPE_HOME))
    ->addPhone(Phone::create()->setNumber('777777777')->setType(Phone::TYPE_HOME))
    ->addCompany($company);
*/
class Worker extends Entity
{
    const GENDER_WOMEN = 0;
    const GENDER_MAN = 1;
    
    /**
     * @var string
     */
    protected $firstname;
    
    /**
     * @var string
     */
    protected $lastname;
    
    /**
     * @var int
     */
    protected $gender;
    
    /**
     *
     * @var Company
     */
    protected $company;
    
    /**
     * {@inheritDoc}
     * @see \sebastiangolian\php\models\Entity::validate()
     */
    public function validate()
    {
        if(empty($this->firstname)){$this->errors['firstname'] = 'Pole firstname jest wymagane';}
        if(empty($this->lastname)){$this->errors['lastname'] = 'Pole lastname jest wymagane';}
        if(empty($this->gender)){$this->errors['gender'] = 'Pole gender jest wymagane';}
        
        if(count($this->errors) > 0){
            return false;
        } else {
            return true;
        }
    }
    
    /**
     * @param string $firstname
     * @return $this
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }
    
    /**
     * @param string $lastname
     * @return $this
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }
    
    /**
     * @param int $type
     * @throws \Exception
     * @return $this
     */
    public function setGender($type)
    {
        if (in_array($type, [0,1])) {
            return $this;
        }
        else{
            throw new \Exception('Not valid value for "gender"');
        }
    }
    
    /**
     * @return int
     */
    public function getGender()
    {
        return $this->type;
    }
    
    /**
     * @param Company $company
     * @return $this
     */
    public function addCompany(Company $company)
    {
        $this->company = $company;
        $this->company->addWorker($this);
        return $this;
    }
    
    /**
     * @return $this
     */
    public function removeCompany()
    {
        $this->company = null;
        return $this;
    }
    
    /**
     * @return \sebastiangolian\php\models\Company
     */
    public function getCompany()
    {
        return $this->company;
    }
    
    /**
     * @return bool
     */
    private function hasCompany()
    {
        return isset($this->company);
    }
}

