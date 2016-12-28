<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace sebastiangolian\php\components;

/**
 * Description of TestComponent
 *
 * @property string $value
 */
class TestComponent extends Component {
    public function setValue($value)
    {
        $this->value = $value;
    }
    
    public function getValue()
    {
        return $this->value;
    }
}
