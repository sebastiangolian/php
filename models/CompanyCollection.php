<?php
namespace sebastiangolian\php\models;

use sebastiangolian\php\base\Collection;

class CompanyCollection extends Collection
{
    /**
     * {@inheritDoc}
     * @see \sebastiangolian\php\base\Collection::addItem()
     */
    public function addItem(Company $obj, $key = null) {
        parent::addItem($obj, $key);
    }
}