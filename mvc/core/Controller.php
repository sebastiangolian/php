<?php

namespace sebastiangolian\php\mvc\core;

abstract class Controller
{
    protected $params = [];

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function __call($name, $args)
    {
        $action = $name . 'Action';

        if (method_exists($this, $action)) {
                call_user_func_array([$this, $action], $args);
        } 
        else {
            throw new \Exception("Action $action not found in controller " . get_class($this));
        }
    }
}
