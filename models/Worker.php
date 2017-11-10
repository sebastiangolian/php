<?php
namespace sebastiangolian\php\models;


/*
$address = new Address(['street'=>'Testowa 22','number'=>'1','local'=>'2a','postCode'=>'20-000','city'=>'Warszawa','type'=>'domowy']);
$address1 = new Address(['street'=>'Testowa 2','number'=>'3','local'=>'4','postCode'=>'21-000','city'=>'Lublin','type'=>'firmowy']);


$email = new Email(['email'=>'SebastianGolian@gmail.com','type'=>'domowy']);
$email1 = new Email(['email'=>'sg@pp.com','type'=>'firmowy']);


$phoneNumber = new PhoneNumber(['number'=>'25 733 33 33','extension'=>'22','type'=>'firmowy']);
$phoneNumber1 = new PhoneNumber(['number'=>'777777777','extension'=>null,'type'=>'komórkowy']);

$worker = new Worker([
    'firstname'=>'Jan',
    'lastname'=>'Kowalski',
    'title' => 'Mgr',
    'addresses'=> [$address,$address1],
    'emails'=>[$email,$email1],
    'phoneNumbers'=>[$phoneNumber,$phoneNumber1]
]);

$worker->toString();
*/
/**
 * Osoba
 */
class Worker extends Entity
{
    protected $firstname;
    protected $lastname;
    protected $title;
    
    /**
     *
     * @var Company
     */
    protected $company;
    
    
    /**
     * Constructor
     * @param array $config
     */
    public function __construct($config = array()) {
        parent::__construct($config);
        $this->setName(null);
    }
    
    /**
     * Validation object
     * @return boolean
     */
    public function validate()
    {
        if(empty($this->firstname)){$this->errors['firstname'] = 'Pole firstname jest wymagane';}
        if(empty($this->lastname)){$this->errors['lastname'] = 'Pole lastname jest wymagane';}
        if(empty($this->title)){$this->errors['title'] = 'Pole title jest wymagane';}
        
        if(count($this->errors) > 0){
            return false;
        } else {
            return true;
        }
    }
    
    /**
     * Name setter
     * @param string $value
     */
    public function setName($value)
    {
        $this->name = $this->firstname.' '.$this->lastname;
    }
}

