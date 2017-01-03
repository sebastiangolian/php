<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace sebastiangolian\php\components;

use sebastiangolian\php\base\Object;
use sebastiangolian\yii2\helpers\Testing;


/**
 * Test component
 * 
 * @property integer $value
 */
class Test extends Object 
{    
    public function setValue($value)
    {
        Testing::vd($value,'setValue');
        $this->value = $value + 100;
    }
}
