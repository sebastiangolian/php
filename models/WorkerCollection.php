<?php
namespace sebastiangolian\php\models;

use sebastiangolian\php\base\Collection;

class WorkerCollection extends Collection
{
    public function addItem(Worker $obj, $key = null) {
        parent::addItem($obj, $key);
    }
}
