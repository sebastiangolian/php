<?php
namespace sebastiangolian\php\base;

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
    protected $_wsdl = '';
    protected $_options = [];
    
    /**
     * BaseSoap constructor
     * @param array $options [optional]
     */
    public function __construct($options = null) 
    {
        $this->setOptions($options);
        parent::__construct($this->_wsdl,$this->_options);
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
            return parent::__soapCall($function_name,[$arguments],$this->_options,$input_headers,$output_headers);
        } 
        catch (Exception $ex) {
            return $ex->faultstring;
        }
    }
    
    /**
     * Set SOAP option
     * @param string $option
     * @param string $value
     */
    public function setOption($option,$value)
    {
        $this->_options[$option] = $value;
    }
    
    /**
     * Get SOAP option
     * @param string $value
     * @return mixed
     */
    public function getOption($value)
    {
        if(isset($this->_options[$value])){
            return $this->_options[$value];
        }
        else {
            return null;
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
                $this->_options[$key] = $value;
            }
        } 
    }
    
    /**
     * Get all SOAP options
     * @return array
     */
    public function getOptions()
    {
        return $this->_options;
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

