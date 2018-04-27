<?php
namespace sebastiangolian\php\base;

use sebastiangolian\php\vardumper\VarDumper;  

abstract class BaseObject
{
    /**
     * @return string
     */
    public function getId()
    {
        return spl_object_hash($this);
    }
    
    /**
     * Return class name
     * @return string
     */
    public static function className()
    {
        return get_called_class();
    }
    
    /**
     * Return values properties class
     * @return string
     */
    public function toString()
    {
        VarDumper::dump($this);
    }
}

