<?php
namespace sebastiangolian\php\soap;

use sebastiangolian\php\base\Soap;
use SoapHeader;
use SoapVar;

/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 * 
 * Sledzenie Webservice
 * @see https://tt.poczta-polska.pl/Sledzenie/services/Sledzenie?wsdl
 */
class SledzeniePP extends Soap
{
    /**
     * WSDL url
     * @var string 
     */
    protected $_wsdl = 'https://tt.poczta-polska.pl/Sledzenie/services/Sledzenie?wsdl';
    
    /**
     * Set soap header
     * @param SoapHeader $soapheaders
     * @return bool
     */
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
    
    /**
     * Check one delivery info
     * @param string $numer
     * @return StdClass
     */
    public function sprawdzPrzesylke($numer='testp0')
    {
        return $this->__soapCall('SprawdzPrzesylke',['numer'=>$numer]);
    }
    
    /**
     * Check more delivery info
     * @param string $numer
     * @return StdClass
     */
    public function sprawdzPrzesylki($numer='testk-1')
    {
        return $this->__soapCall('SprawdzPrzesylki',['numer'=>$numer]);
    }
}
