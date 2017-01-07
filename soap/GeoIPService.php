<?php
namespace sebastiangolian\php\soap;


/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 * 
 * GeoIPService Webservice
 */
class GeoIPService extends BaseSoap
{
    protected $_wsdl = 'http://www.webservicex.net/geoipservice.asmx?WSDL';
    protected $_options = ['soap_version' => SOAP_1_2];
    
    /**
     * Enables you to easily look up countries by IP addresses
     * @param string $ip
     * @return StdClass
     */
    public function GetGeolocationByIp($ip = '188.127.18.242')
    {
        return $this->__soapCall('GetGeoIP',[
            'GetGeoIP'=>['IPAddress'=>$ip]
        ]);
    }
    
    /**
     * Enables you to easily look up countries by Context 
     * @return StdClass
     */
    public function GetGeolocationYourIp()
    {
        return $this->__soapCall('GetGeoIPContext',[]);
    }  
}

