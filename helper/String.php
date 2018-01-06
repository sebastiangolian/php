<?php
namespace sebastiangolian\php\helper;

/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 * 
 * String provides a set of static methods for commonly used function string
 */
abstract class String
{	
    /**
     * Replace all occurrences of the search string with the replacement string
     * String::replace('new','old','This in new value')
     * @param string $search
     * @param string $replace
     * @param string $subject
     * @return string
     */
    public static function replace($search,$replace,$subject)
    {
        return str_replace($search,$replace,$subject);
    }
            
    /**
     * Translate characters or replace substrings
     * String::repleaceSubstrings('The Microsoft-Company C.O.O.',['.',' ','-'],'_')
     * @param string $string
     * @param string[] $from
     * @param string $to
     * @return string
     */
    public static function repleaceSubstrings($string,array $from, $to = ''){
        
        foreach ($from as $value) {
            $from[$value] = $to;
        }
        
        return strtr($string,$from);
    }

    /**
     * Generate random string
     * String::random(10)
     * @param int $length
     * @return string
     */
    public static function random($length = 8)
    {
        $code = md5(uniqid(rand(), true));
        return substr($code, 0, $length);
    } 
}
