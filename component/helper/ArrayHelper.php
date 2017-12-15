<?php
namespace sebastiangolian\php\component\helper;

abstract class ArrayHelper
{
    public static function isAssoc($arr)
    {
        if(!is_array($arr)){
            return false;
        }
        
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}