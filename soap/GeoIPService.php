<?php

namespace sebastiangolian\php\soap;

/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 * 
 * GeoIPService Webservice
 */
class GeoIPService extends Soap 
{
    /**
     * WSDL url
     * @var string
     */
    protected $wsdl = 'http://www.webservicex.net/geoipservice.asmx?WSDL';
    protected $classmap = [
        "GetGeoIP" => "sebastiangolian\php\soap\GetGeoIP",
        "GetGeoIPResponse" => "sebastiangolian\php\soap\GetGeoIPResponse",
        "GeoIP" => "sebastiangolian\php\soap\GeoIP",
        "GetGeoIPContext" => "sebastiangolian\php\soap\GetGeoIPContext",
        "GetGeoIPContextResponse" => "sebastiangolian\php\soap\GetGeoIPContextResponse"
    ];
    
    /**
     * Enables you to easily look up countries by IP addresses
     * $soap = new GeoIPService();
     * $getGeoIPResponse = $soap->GetGeolocationByIp("188.127.30.36");
     * 
     * @param string $ip
     * @return GetGeoIPResponse
     */
    public function GetGeolocationByIp($ip = '188.127.18.242')
    {
        return $this->__soapCall('GetGeoIP',['IPAddress'=>$ip]);
    }
    
    /**
     * Enables you to easily look up countries by Context 
     * $soap = new GeoIPService();
     * $getGeoIPContextResponse = $soap->GetGeolocationByIp();
     * 
     * @return GetGeoIPContextResponse
     */
    public function GetGeolocationYourIp()
    {
        return $this->__soapCall('GetGeoIPContext',[]);
    }  
}

/**********SOAP TYPES***********/

/**
 * Generated data proxy class for struct GetGeoIP
 *
 */
class GetGeoIP {
    
    /**
     * @var string $IPAddress
     */
    public $IPAddress;
    
}

/**
 * Generated data proxy class for struct GetGeoIPResponse
 *
 */
class GetGeoIPResponse {
    
    /**
     * @var GeoIP $GetGeoIPResult
     */
    public $GetGeoIPResult;
    
}

/**
 * Generated data proxy class for struct GeoIP
 *
 */
class GeoIP {
    
    /**
     * @var int $ReturnCode
     */
    public $ReturnCode;
    
    /**
     * @var string $IP
     */
    public $IP;
    
    /**
     * @var string $ReturnCodeDetails
     */
    public $ReturnCodeDetails;
    
    /**
     * @var string $CountryName
     */
    public $CountryName;
    
    /**
     * @var string $CountryCode
     */
    public $CountryCode;
    
}

/**
 * Generated data proxy class for struct GetGeoIPContext
 *
 */
class GetGeoIPContext {
    
}

/**
 * Generated data proxy class for struct GetGeoIPContextResponse
 *
 */
class GetGeoIPContextResponse {
    
    /**
     * @var GeoIP $GetGeoIPContextResult
     */
    public $GetGeoIPContextResult;
    
}

