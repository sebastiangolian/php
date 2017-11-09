<?php
namespace sebastiangolian\php\helpers;

/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 * 
 * Math provides a set of static methods for commonly used function math
 */
abstract class Math
{
    /**
     * Round value to $precision places after comma
     * Math::rounding(10.45678, 2)
     * @param int $value
     * @param float $precision
     * @param int $mode
     * @return type
     */
    public static function rounding($value,$precision = 0,$mode = PHP_ROUND_HALF_UP)
    {
        return round($value,$precision,$mode);
    }

    /**
     * Generate a random integer
     * Math::random(1,100)
     * @param type $min
     * @param type $max
     * @return type
     */
    public static function random($min,$max)
    {
        return rand($min,$max);
    }
    
    /**
     * Return percent from value
     * Math::percent(1000, 70)
     * @param type $value
     * @param type $percent
     * @param type $precision
     * @return type
     */
    public static function percent($value, $percent, $precision = 0)
    {
        $newValue = $value*$percent/100;
        return self::rounding($newValue,$precision);
    }
}