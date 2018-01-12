<?php
namespace sebastiangolian\php\faker;

/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 *
 */
abstract class Image
{
    /**
     * Image::image(100,100,0);
     * Image::image(100,100,1);
     * 
     * @param int $width
     * @param int $height
     * @param boolean $lorem_pixel
     */
    public static function image($width,$height,$lorem_pixel = false)
    {
        if($lorem_pixel){
            echo "<img src='http://lorempixel.com/{$width}/{$height}/' />";
        }
        else{
            echo "<div style='width:{$width}px;height:{$height}px;background-color:silver; text-align: center; font-size:30px;vertical-align: middle; display: table-cell;'>{$width}x{$height}</div>";
        }
    }
}