<?php
namespace sebastiangolian\php\model;

use sebastiangolian\php\base\Model;


/*
    $email = new Email(['email' => 'sebastiangolian@gmail.com']);
    VarDumper::dump($email->validate());
    VarDumper::dump($email->errors);
 */
class Email extends Model
{
    const TYPE_HOME = 0;
    const TYPE_WORK = 1;
    const TYPE_ANOTHER = 2;
    
    protected $email;   
    protected $type = self::TYPE_HOME;                
    
    
    /**
    * {@inheritDoc}
    * @see \sebastiangolian\php\base\Model::validate()
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
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = strtolower(trim($email));
        return $this;
    }
    
    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * @param int $type
     * @throws \Exception
     * @return $this
     */
    public function setType($type)
    {
        if (in_array($type, [0,1,2])) {
            return $this;
        } 
        else{
            throw new \Exception('Not valid value for "type"');
        }
    }
    
    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }
}

