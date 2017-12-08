<?php
namespace sebastiangolian\php\models;

/*
$company = Company::create()->setName('ZOO z.o.o.');
*/
class Company extends Entity
{
    /**
     * @var string
     */
    protected $name;
    
    /**
     *
     * @var WorkerCollection
     */
    protected $workers;

    
    /**
     * {@inheritDoc}
     * @see \sebastiangolian\php\base\Model::validate()
     */
    public function validate()
    {
        if(empty($this->name)){$this->errors['name'] = 'Pole name jest wymagane';}
        
        if(count($this->errors) > 0){
            return false;
        } else {
            return true;
        }
    }
    
    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @return \sebastiangolian\php\models\WorkerCollection
     */
    public function getWorkers()
    {
        return $this->workers;
    }
    
    /**
     * @param Worker $worker
     * @return $this
     */
    public function addWorker(Worker $worker)
    {
        $this->initWorkerCollection();
        $this->workers->addItem($worker,$worker->getId());
        return $this;
    }
    
    /**
     * @param int $key
     * @return $this
     */
    public function removeWorker($key)
    {
        $this->initWorkerCollection();
        if($this->workers->exists($key)){
            $this->workers->removeItem($key);
        }
        return $this;
    }
    
    /**
     * @return $this
     */
    private function initWorkerCollection()
    {
        if(!isset($this->workers)){
            $this->workers = new WorkerCollection();
        }
        return $this;
    }
}