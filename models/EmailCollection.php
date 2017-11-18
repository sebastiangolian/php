<?php
namespace sebastiangolian\php\models;

use sebastiangolian\php\base\Collection;

class EmailCollection extends Collection
{
    /**
     * {@inheritDoc}
     * @see \sebastiangolian\php\base\Collection::addItem()
     */
    public function addItem(Email $obj, $key = null) {
        parent::addItem($obj, $key);
    }
}
