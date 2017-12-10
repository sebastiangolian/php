<?php
namespace sebastiangolian\php\component\helper;

/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 * 
 * File provides a set of static methods for commonly used function file
 */
abstract class File
{
    /**
     * Create file with content
     * @param string $filePath
     * @param string $content
     * @return boolean
     */
    public static function create($filePath, $content = null)
    {
        if(!is_file($filePath) && !is_writable($filePath)){
            $fh = fopen($filePath, 'w');
            fwrite($fh, $content);
            fclose($fh);
            return true; 
        } else {
            return false;
        }
    }
      
    /**
     * Delete file
     * @param string $filePath
     * @return boolean
     */
    public static function delete($filePath)
    {	
        if(is_file($filePath) && is_writable($filePath)){
            return unlink($filePath); 
        } else {
            return false;
        }
    }
	
    /**
     * Move file
     * @param string $sourcePath
     * @param string $destinationPath
     * @return boolean
     */
    public static function move($sourcePath, $destinationPath)
    {
        if(is_file($sourcePath)){
            return rename($sourcePath, $destinationPath);
        } else {
            return false;
        }  
    }
    
    /**
     * Copy file
     * @param string $sourcePath
     * @param string $destinationPath
     * @return boolean
     */
    public static function copy($sourcePath, $destinationPath)
    {
        if(is_file($sourcePath)){
            return copy($sourcePath, $destinationPath);
        } else {
            return false;
        }  
    }
    
    /**
     * Return content file
     * @param string $filePath
     * @return string
     */
    public static function getContent($filePath)
    {
        if(is_file($filePath)){
            return file_get_contents($filePath);
        } else {
            return null;
        }
    }

    /**
     * Set content file
     * @param string $filePath
     * @param string $content
     * @return boolean
     */
    public static function setContent($filePath,$content)
    {
        if(is_file($filePath) && is_writable($filePath)){
            file_put_contents($filePath,$content);
            return true;
        } else {
            return null;
        }
    }
    
    /**
     * Add content to file
     * @param string $filePath
     * @param string $content
     * @return boolean
     */
    public static function addContent($filePath,$content)
    {
        if(is_file($filePath) && is_writable($filePath)){
            $currentContent = self::getContent($filePath);
            $currentContent .= $content;
            return self::setContent($filePath, $currentContent);
        }
        else {
            return false;
        }
    }
	
    /**
     * Clear file content
     * @param string $filePath
     * @return boolean
     */
    public static function clear($filePath)
    {   
        if(is_file($filePath) && is_writable($filePath)){
            file_put_contents($filePath, '');
        }
        else {
            return false;
        }
    }
}
