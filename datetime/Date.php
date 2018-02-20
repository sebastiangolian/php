<?php

namespace sebastiangolian\php\datetime;

/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 * 
 * Date provides a set of static methods for commonly used function time and date
 */
abstract class Date
{
    /**
     * Return current Unix timestamp
     * Date::currentTimestamp();
     * @return int
     */
    public static function currentTimestamp()
    {
        return time();
    }
    
    /**
     * Return current date and time in chosen format
     * Date::currentDate('Y-m-d');
     * @param string $format
     * @return string
     */
    public static function currentDate($format = 'Y-m-d H:i:s')
    {
        return date($format);
    }
    
    /**
     * Parse Date description into a Unix timestamp
     * Date::dateToTimestamp('2017-01-01')
     * Date::dateToTimestamp('2017-01-01 12:00:00')
     * @param string $date
     * @return int
     */
    public static function dateToTimestamp($date)
    {
        return strtotime($date);
    }
    
    /**
     * Parse Unix timestamp into a datetime description 
     * Date::timestampToDate('1483268450')
     * @param int $timestamp
     * @param string $format
     * @return string
     */
    public static function timestampToDate($timestamp,$format = 'Y-m-d H:i:s')
    {
        return date($format,$timestamp);
    }
    
    
    /**
     * Return day name in polish language of $timestamp 
     * @param int $timestamp
     * @return string
     */
    public static function getDayPl($timestamp = null)
    {
        if ($timestamp == null){
            $timestamp = time();
        }
        
        $day = date("l",$timestamp);
        switch ($day) {
            case "Monday":
                return "Poniedziałek";
            case "Tuesday":
                return "Wtorek";
            case "Wednesday":
                return "Środa";
            case "Thursday":
                return "Czwartek";
            case "Friday":
                return "Piątek";
            case "Saturday":
                return "Sobota";
            default:
                return "Niedziela";
        }
    }
    
     /**
     * Return month name in polish language of $timestamp 
     * @param int $timestamp
     * @return string
     */
    static function getMonthPl($timestamp = null)
    {
        if ($timestamp == null){
            $timestamp = time();
        }
        
        $month = date("m",$timestamp);
        switch ($month) 
        {
            case "01":
                return "Styczeń";
            case "02":
                return "Luty";
            case "03":
                return "Marzec";
            case "04":
                return "Kwiecień";
            case "05":
                return "Maj";
            case "06":
                return "Czerwiec";
            case "07":
                return "Lipiec";
            case "08":
                return "Sierpień";
            case "09":
                return "Wrzesień";
            case "10":
                return "Październik";
            case "11":
                return "Listopad";
            default:
                return "Grudzień";
        }
    }
    
    /**
     * Return DateInterval object by difference $date1 and $date2
     * Date::getDifference('2017-01-30', '2017-01-01')
     * @param string $date1
     * @param string $date2
     * @return array
     */
    static function getDifference($date1,$date2)
    {
        $datetime1 = new \DateTime($date1);
        $datetime2 = new \DateTime($date2);
        $array = $datetime1->diff($datetime2);

        return $array;
    }

    /**
     * Adds an amount of days, months, years, hours, minutes and seconds to a $date
     * Date::add($date, "P7Y5M4DT1H15M44S")
     * @param string $date
     * @param string $howMuch 
     * @param string $format Return date format
     * @return string
     */
    static function add($date,$howMuch="P7D",$format='Y-m-d H:i:s')
    {
        $date = new \DateTime($date);
        $date->add(new \DateInterval($howMuch));
        return $date->format($format);
    }
    
    /**
     * Return count weekend days for period
     * Date::getWeekendDays('2017-01-01', '2017-01-30')
     * @param string $date_start
     * @param string $date_end
     * @return int
     */
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
