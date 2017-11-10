<?php
namespace sebastiangolian\php\soap;

use Exception;
use SoapClient;

/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 * 
 * Component allows the use of SOAP component
 */
abstract class Soap extends SoapClient
{
    protected $wsdl = '';
    protected $options = [];
    protected $classmap = [];
    
    /**
     * BaseSoap constructor
     * @param array $options [optional]
     */
    public function __construct($options = null) 
    {
        $options['classmap'] = $this->classmap;
        $this->setOptions($options);
        
        parent::__construct($this->wsdl,$this->options);
    }
    
    /**
     * Calls a SOAP function
     * @param string $function_name
     * @param array $arguments
     * @param array $options
     * @param mixed $input_headers
     * @param array $output_headers
     * @return mixed
     */
    public function __soapCall($function_name,$arguments,$options=NULL,$input_headers=NULL,&$output_headers=NULL)
    {
        $this->setOptions($options);
        try{
            $this->__setSoapHeaders();
            return parent::__soapCall($function_name,[$arguments],$options,$input_headers,$output_headers);
        } 
        catch (Exception $ex) {
            return $ex->faultstring;
        }
    }
    
    /**
     * Set WSDL options
     * @param array $options
     */
    public function setOptions($options)
    {
        if($options != null){
            foreach ($options as $key=>$value) {
                $this->options[$key] = $value;
            }
        } 
    }
    
    /**
     * Get all SOAP options
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     * Get WSDL variable types 
     * @return array
     */
    public function getTypes()
    {
        return $this->__getTypes();
    }
    
    /**
     * Get last SOAP request
     * Options trace must be 1
     * $soap = new TestSoap(['trace' => 1])
     * @return string
     */
    public function getLastRequest()
    {
        return $this->__getLastRequest();
    }
    
    /**
     * Get last SOAP response
     * Options trace must be 1
     * $soap = new TestSoap(['trace' => 1])
     * @return string
     */
    public function getLastResponse()
    {
        return $this->__getLastResponse();
    }
}

