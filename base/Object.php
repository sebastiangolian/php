<?php
namespace sebastiangolian\php\base;

use sebastiangolian\php\helpers\VarDumper;
abstract class Object
{
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

