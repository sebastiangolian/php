<?php
abstract class Object
{
    protected $name;
    public function getName()
    {
        if($this->name == null){
            return get_called_class();
        }
        else {
            return $this->name;
        }
    }
}

