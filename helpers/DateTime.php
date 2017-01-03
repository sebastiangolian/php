<?php

namespace sebastiangolian\php\helpers;

/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 * 
 * DateTime provides a set of static methods for commonly used function time and date
 */
class DateTime
{
    public static function getWeekendDays($date_start,$date_end)
    {
        $begin = strtotime($date_start);
        $end   = strtotime($date_end);
    
        $no_days  = 0;
        $weekends = 0;
        while ($begin <= $end) {
            $no_days++;
            $what_day = date("N", $begin);
            if ($what_day > 5) {
                $weekends++;
            };
            $begin += 86400;
        };   
        
        return $weekends;
    }
}
