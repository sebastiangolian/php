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
    
    public function addWorkers(Worker $worker)
    {
        $this->isWorkerCollection();
        $this->worker->addItem($worker);
        return $this;
    }
    
    public function removeWorker($key)
    {
        $this->isWorkerCollection();
        if($this->worker->exists($key)){
            $this->worker->removeItem($key);
        }
        return $this;
    }
    
    private function isWorkerCollection()
    {
        if(!isset($this->workers)){
            $this->worker = new WorkerCollection();
        }
    }
    
}

