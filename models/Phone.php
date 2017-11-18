<?php
namespace sebastiangolian\php\models;

use sebastiangolian\php\base\Model;

class Phone extends Model
{
    const TYPE_HOME = 0;
    const TYPE_WORK = 1;
    const TYPE_ANOTHER = 2;
    
    protected $number;
    protected $type;
    
    /**
     * {@inheritDoc}
     * @see \sebastiangolian\php\base\Model::validate()
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
    
    /**
     * @param string $number
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
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

