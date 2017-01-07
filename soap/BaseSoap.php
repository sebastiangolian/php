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
abstract class BaseSoap extends SoapClient
{
    protected $_wsdl = '';
    protected $_options = [];
    
    public function __construct() 
    {
        parent::__construct($this->_wsdl,$this->_options);
    }
    
    public function __soapCall($function_name,$arguments,$options=NULL,$input_headers=NULL,&$output_headers=NULL)
    {
        try{
            $this->__setSoapHeaders();
            return parent::__soapCall($function_name,[$arguments],$options,$input_headers,$output_headers);
        } 
        catch (Exception $ex) {
            return $ex->faultstring;
        }
    }
}

