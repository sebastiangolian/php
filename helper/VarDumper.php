<?php
namespace sebastiangolian\php\helper;

/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 * 
 * VarDumper
 */

abstract class VarDumper
{
    /**
     * Displays a variable
     * Testing::dump(array[0,1,2,3]);
     * @param mixed $var variable by dumping
     * @return string
     */
    public static function dump($var)
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }
}