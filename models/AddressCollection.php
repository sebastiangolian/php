<?php
namespace sebastiangolian\php\models;

use sebastiangolian\php\base\Collection;

class AddressCollection extends Collection
{
    public function addItem(Address $obj, $key = null) {
        parent::addItem($obj, $key);
    }
}
