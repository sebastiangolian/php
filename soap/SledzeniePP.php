<?php
namespace sebastiangolian\php\soap;

use sebastiangolian\php\base\Soap;
use SoapHeader;
use SoapVar;

class SledzeniePP extends Soap
{
    protected $_wsdl = 'https://tt.poczta-polska.pl/Sledzenie/services/Sledzenie?wsdl';
    
    public function __setSoapHeaders($soapheaders = null) {
        
        $header = "<wsse:Security xmlns:wsse='http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd'>";
    	$header.= "<wsse:UsernameToken xmlns:wsse='http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd'>";
    	$header.= "<wsse:Username>sledzeniepp</wsse:Username>";
    	$header.= "<wsse:Password Type='http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText'>PPSA</wsse:Password>";
    	$header.= "</wsse:UsernameToken>";
    	$header.= "</wsse:Security>";
        
        $soap_header = new SoapVar($header,XSD_ANYXML,null,null,null);
        $soapheaders = new SoapHeader('http://sledzenie.pocztapolska.pl','wsse',$soap_header);
        
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
