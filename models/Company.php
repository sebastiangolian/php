<?php
namespace sebastiangolian\php\models;

/**
 * Organizacja
 */
class Company extends Entity
{
    /**
     *
     * @var WorkerCollection
     */
    protected $workers;

    /**
     * @return \sebastiangolian\php\models\WorkerCollection
     */
    public function getWorkers()
    {
        return $this->workers;
    }
    
    public function addWorker(Worker $worker)
    {
        $this->isWorkerCollection();
        $this->workers->addItem($worker);
        return $this;
    }
    
    public function removeWorker($key)
    {
        $this->isWorkerCollection();
        if($this->workers->exists($key)){
            $this->workers->removeItem($key);
        }
        return $this;
    }
    
    private function isWorkerCollection()
    {
        if(!isset($this->workers)){
            $this->workers = new WorkerCollection();
        }
    }
    
}

