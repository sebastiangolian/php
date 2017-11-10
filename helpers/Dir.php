<?php
namespace sebastiangolian\php\helpers;

/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 * 
 * Dir provides a set of static methods for commonly used function dir
 */
abstract class Dir
{
    /**
     * Create dir in $dirPath location
     * Dir::create(__DIR__.DIRECTORY_SEPARATOR.'test')
     * @param string $dirPath
     * @return boolean
     */
    public static function create($dirPath)
    {
        if (!is_dir($dirPath)){
            return mkdir($dirPath);
        }
        else {
            return false;
        }
    }
    
    /**
     * Delete dir or only contents in $dirPath location
     * Dir::delete(__DIR__.DIRECTORY_SEPARATOR.'test')
     * @param string $dirPath
     * @param bool $onlyContent
     * @return boolean
     */
    public static function delete($dirPath, $onlyContent = false)
    {
        //delete content
        if ($dirHandle = opendir($dirPath))
        {
            while (false !== ($dirFile = readdir($dirHandle))){
                if ($dirFile != "." && $dirFile != ".."){
                    if (is_dir($dirPath."/".$dirFile)){
                        self::delete($dirPath."/".$dirFile, false);
                    }
                    else {
                        if (!unlink($dirPath."/".$dirFile)){
                            return false;
                        }
                    }
                }
            }
            closedir($dirHandle);
        } 
        else {
            return false;
        }
        
        //delete dir
        if (!$onlyContent){
            if (!rmdir($dirPath)){
                return false;
            }
        } 
            
        return true;  
    }

    /**
     * Move dir to $destinationPath
     * Dir::move($sourcePath, $destinationPath)
     * @param string $sourcePath
     * @param string $destinationPath
     * @return boolean
     */
    public static function move($sourcePath,$destinationPath) 
    {
        if(is_dir($sourcePath)) 
        {
            @mkdir($destinationPath);
            $directory = dir($sourcePath);
            while(false !== ($readdirectory = $directory->read())){
                if($readdirectory == '.' || $readdirectory == '..') {
                    continue;
                }
                $pathDir = $sourcePath.'/'.$readdirectory; 
                if(is_dir($pathDir)){
                    self::move($pathDir,$destinationPath.'/'.$readdirectory);
                    continue;
                }
                copy($pathDir,$destinationPath.'/'.$readdirectory);
            }
            $directory->close();
        }
        else 
        {
            if (is_dir($sourcePath)){
                return copy($sourcePath,$destinationPath);
            } else {
                return false;
            }
        }
        self::delete($sourcePath);
    }
}