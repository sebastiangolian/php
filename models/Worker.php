<?php
namespace sebastiangolian\php\models;


class Worker extends Entity
{
    public $firstname;
    public $lastname;
    public $title;
    
    /**
     *
     * @var Company
     */
    protected $company;
    
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
    
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }
    
    public function addCompany(Company $company)
    {
        $this->company = $company;
        $this->company->addWorker($this);
        return $this;
    }
    
    public function removeCompany()
    {
        $this->company = null;
        return $this;
    }
    
    private function isCompany()
    {
        return isset($this->company);
    }
}

