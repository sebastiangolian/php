<?php
namespace sebastiangolian\php\models;

use sebastiangolian\php\base\Collection;

class PhoneCollection extends Collection
{
    /**
     * {@inheritDoc}
     * @see \sebastiangolian\php\base\Collection::addItem()
     */
    public function addItem(Phone $obj, $key = null) {
        parent::addItem($obj, $key);
    }
}
