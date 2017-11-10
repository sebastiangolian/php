<?php
namespace sebastiangolian\php\components;

use Exception;
use sebastiangolian\php\base\Component;

/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 * 
 * PHP Component allows the use of cUrl library
 * 
 * $curl = new Curl('www.example.com');
 * $curl = new Curl('http://www.ebay.com/sch/i.html',['_nkw'=>272115847388]);
 * $curl->setProxy('proxy.com', 8080, 'login', 'pass');
 * echo $curl->sendGet();
 * echo $curl->sendPost();
 */

class Curl extends Component
{
    /**
     * @var resource Handler to cUrl object
     * @see http://php.net/manual/en/book.curl.php
     */
    public $curl;
    
    /**
     * @var string Url adress example: www.example.com
     */
    public $url;
    
    /**
     *
     * @var array Data to send
     */
    public $data = [];
    
    /**
     *
     * @var array cUrl object options 
     * @see http://php.net/manual/en/function.curl-setopt.php
     */
    private $curlOptions = [];
    
    /**
     * Constructor.
     * Sets url and urlData
     *
     * @param string $url
     * @param array $data
     * @param array $config
     */
    public function __construct($url, $data = [], $config = []) 
    {
        parent::__construct($config);
        $this->url = $url;
        $this->data = $data;
        
        if (!extension_loaded('curl')) {
            throw new Exception('cURL library is not loaded');
        }
        $this->curl = curl_init();
        $this->setCurlOption(CURLINFO_HEADER_OUT, true);
        $this->setCurlOption(CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * Exec curl query 
     * @return mixed
     */
    public function exec()
    {
        return curl_exec($this->curl);
    }
    
    /**
     * Send cUrl query for GET request
     * @return mixed
     */
    public function sendGet()
    {
        $url = $this->url.(empty($this->data) ? '' : '?'.http_build_query($this->data, '', '&')); 
        $this->setCurlOption(CURLOPT_URL, $url);
        return $this->exec();
    }
    
    /**
     * Send cUrl query for POST request
     * @return mixed
     */
    public function sendPost()
    {
        $this->setCurlOption(CURLOPT_URL, $this->url);
        $this->setCurlOption(CURLOPT_POST, 1);
        $this->setCurlOption(CURLOPT_POSTFIELDS, http_build_query($this->data));
        return $this->exec();
    }
    
    /**
     * Set proxy data
     * @param string $url
     * @param integer $port
     * @param string $username
     * @param string $pwd
     */
    public function setProxy($url,$port,$username,$pwd)
    {
        $this->setCurlOption(CURLOPT_PROXY, $url);
        $this->setCurlOption(CURLOPT_PROXYPORT, $port);
        $this->setCurlOption(CURLOPT_PROXYUSERPWD, $username.':'.$pwd);
    }

    /**
     * Set cUrl option
     * @param int $option
     * @param string $value
     * @return boolean
     * 
     * $curl->setCurlOption(CURLOPT_PROXY, 'http://example.com');
     */
    public function setCurlOption($option, $value)
    {
        $success = curl_setopt($this->curl, $option, $value);
        if ($success) {
            $this->curlOptions[$option] = $value;
        }
        return $success;
    }
    
    /**
     * Set cUrl options
     * @param array $options
     * @return boolean
     */
    public function setCurlOptions(array $options)
    {
        foreach ($options as $option => $value) {
            if (!$this->setCurlOption($option, $value)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Get information regarding a specific transfer
     * @param integer $opt
     * @return mixed
     */
    public function getInfo()
    {
        return curl_getinfo($this->curl);
    }
    
    /**
     * Close cUrl connection
     */
    public function close()
    {
        if (is_resource($this->curl)) {
            curl_close($this->curl);
        }
    }
    
    /**
     * Destructor
     */
    public function __destruct()
    {
        $this->close();
    }
}

