<?php
namespace sebastiangolian\php\components;

use ErrorException;
use sebastiangolian\yii2\helpers\Testing;

class Curl extends Component
{
    public $curl;
    public $url;
    public $data = [];
    public $options = [];
    
    public function __construct($attributes = [])
    {
        parent::__construct($attributes);

        if (!extension_loaded('curl')) {
            throw new ErrorException('cURL library is not loaded');
        }
        $this->curl = curl_init();
        $this->setOption(CURLINFO_HEADER_OUT, true);
        $this->setOption(CURLOPT_RETURNTRANSFER, true);
    }

    public function exec()
    {
        return curl_exec($this->curl);
    }
    
    public function setProxy($url,$port,$username,$pwd)
    {
        $this->setOption(CURLOPT_PROXY, $url);
        $this->setOption(CURLOPT_PROXYPORT, $port);
        $this->setOption(CURLOPT_PROXYUSERPWD, $username.':'.$pwd);
    }
    
    //************************* SETTER, GETTER ********************************/
    
    public function setUrl($url)
    {
        Testing::vd($url,'setUrl');
        $this->url = $this->buildURL($url, $this->data);
        $this->setOption(CURLOPT_URL, $this->url);
    }
    
    public function setOption($option, $value)
    {
        $success = curl_setopt($this->curl, $option, $value);
        if ($success) {
            $this->options[$option] = $value;
        }
        return $success;
    }
    
    public function setOptions($options = [])
    {
        foreach ($options as $option => $value) {
            if (!$this->setOption($option, $value)) {
                return false;
            }
        }
        return true;
    }
    
    
    
    
    
    
   
    
    private function buildURL($url, $data = [])
    {
        return $url . (empty($data) ? '' : '?' . http_build_query($data, '', '&')); 
    }
}

