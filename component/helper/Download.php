<?php
namespace sebastiangolian\php\component\helper;

/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 *
 */
abstract class Download
{
    /**
     * Download::fromFile(dirname(__FILE__).'\test.pdf');
     * @param string $file
     */
    public static function fromFile($file)
    {
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }
    
    /**
     * Download::fromString('This is test content of file.','testowy.txt');
     * @param string $str
     * @param string $filename
     */
    public static function fromString($str,$filename)
    {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$filename);
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . strlen($str));
        ob_clean();
        flush();
        echo $str;
        exit;
    }
}