<?php
namespace sebastiangolian\php\helper;

/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 *
 */
abstract class Lorem
{
    /**
     * Lorem::lorem(2,true);
     * @param int $count
     * @param boolean $paragraph
     * @return string
     */
    public static function lorem($count = 1, $paragraph = true)
    {
        $return = "";
        for($i=1;$i<=$count;$i++)
        {
            if($paragraph) $return .='<p>';
            $return .= 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
            if($paragraph) $return .='</p>';
        }
        
        return $return;
    }
}