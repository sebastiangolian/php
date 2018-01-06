<?php
namespace sebastiangolian\php\helper;

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