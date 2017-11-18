<?php
namespace sebastiangolian\php\models;

use sebastiangolian\php\base\Collection;

class WorkerCollection extends Collection
{
    /**
     * {@inheritDoc}
     * @see \sebastiangolian\php\base\Collection::addItem()
     */
    public function addItem(Worker $obj, $key = null) {
        parent::addItem($obj, $key);
    }
}
