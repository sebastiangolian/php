<?php
namespace sebastiangolian\php\helpers;

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
     * Testing::vd(array[0,1,2,3]);
     * @param mixed $var variable by dumping
     * @return string
     */
    public static function vd($var)
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }
}