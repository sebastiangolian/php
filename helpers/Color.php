<?php
namespace sebastiangolian\php\helpers;

/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 * 
 * Color provides a set of static methods for commonly used function color
 */
class Color
{
    /**
     * Convert color value in HEX to RGB format
     * Color::hexToRgb("#4486F8")
     * Color::hexToRgb("#4486F8",true,'-')
     * @param string $hexStr
     * @param bool $returnAsString
     * @param string $seperator
     * @return mixed
     */
    public static function hexToRgb($hexStr, $returnAsString = false, $seperator = ',') 
    {
        $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); 
        $rgbArray = array();

        if (strlen($hexStr) == 6) { 
            $colorVal = hexdec($hexStr);
            $r = 0xFF & ($colorVal >> 0x10);
            $g = 0xFF & ($colorVal >> 0x8);
            $b = 0xFF & $colorVal;
        } 
        elseif (strlen($hexStr) == 3) { 
            $r = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
            $g = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
            $b = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
        } 
        else {
            return false; 
        }
        
        $rgbArray = array($r, $g, $b);
        
        return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; 
    }
    
    /**
     * Convert color value in RGB to HEX format
     * Color::rgbToHex([68,134,248])
     * @param array $rgb
     * @param bool $addSharp
     * @return mixed
     */
    public static function rgbToHex(array $rgb, $addSharp = true) 
    {
        if(count($rgb) != 3) {
            return false;
        }
        
        if($addSharp){
            $hex = "#";
        } else {
            $hex = '';
        }
        
        $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

        return $hex;
    }
}