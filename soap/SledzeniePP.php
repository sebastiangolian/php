<?php
namespace sebastiangolian\php\soap;

use SoapHeader;
use SoapVar;

class SledzeniePP extends BaseSoap
{
    protected $_uri = 'http://sledzenie.pocztapolska.pl';
    protected $_wsdl = 'https://tt.poczta-polska.pl/Sledzenie/services/Sledzenie?wsdl';
    protected $_login = 'sledzeniepp';
    protected $_password = 'PPSA';
    
    
    public function __setSoapHeaders($soapheaders = null) {
        
        $header = "<wsse:Security xmlns:wsse='http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd'>";
    	$header.= "<wsse:UsernameToken xmlns:wsse='http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd'>";
    	$header.= "<wsse:Username>{$this->_login}</wsse:Username>";
    	$header.= "<wsse:Password Type='http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText'>{$this->_password}</wsse:Password>";
    	$header.= "</wsse:UsernameToken>";
    	$header.= "</wsse:Security>";
        
        $soap_header = new SoapVar($header,XSD_ANYXML,null,null,null);
        $soapheaders = new SoapHeader($this->_uri,'wsse',$soap_header);
        
        return parent::__setSoapHeaders($soapheaders);
    }
    
    public function sprawdzPrzesylke($numer='testp0')
    {
        return $this->__soapCall('SprawdzPrzesylke',['numer'=>$numer]);
    }
    
    public function sprawdzPrzesylki($numer='testk-1')
    {
        return $this->__soapCall('SprawdzPrzesylki',['numer'=>$numer]);
    }
}
