<?php
namespace sebastiangolian\php\models;

use sebastiangolian\php\base\Collection;

class PhoneNumberCollection extends Collection
{
    public function addItem(PhoneNumber $obj, $key = null) {
        parent::addItem($obj, $key);
    }
}
