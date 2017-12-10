<?php
namespace sebastiangolian\php\component\soap;


/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 * 
 * TemperatureUnitConvertor Webservice
 * @see http://www.webservicex.com/New/Home/ServiceDetail/31
 */
class TemperatureUnitConvertor extends Soap
{
    protected $wsdl = 'http://www.webservicex.net/ConvertTemperature.asmx?WSDL';
    
    protected $classmap = [
        "ConvertTemp" => "sebastiangolian\php\soap\ConvertTemp",
        "TemperatureUnit" => "sebastiangolian\php\soap\TemperatureUnit",
        "ConvertTempResponse" => "sebastiangolian\php\soap\ConvertTempResponse"
    ];
    
    const UNIT_CELCIUS = 'degreeCelsius';
    const UNIT_FAHRENHEIT = 'degreeFahrenheit';
    const UNIT_RANKINE = 'degreeRankine';
    const UNIT_REAUMR = 'degreeReaumur';
    const UNIT_KELVIN = 'kelvin';
    
    /**
     * Convert temperature
     * $soap = new TemperatureUnitConvertor();
     * $convertTempResponse = $soap->ConvertTemp(20, TemperatureUnitConvertor::UNIT_CELCIUS, TemperatureUnitConvertor::UNIT_KELVIN);
     * @param float $temperature
     * @param string $fromUnit
     * @param string $toUnit
     * @return ConvertTempResponse
     */
    public function ConvertTemp($temperature,$fromUnit = self::UNIT_CELCIUS,$toUnit = self::UNIT_FAHRENHEIT)
    {
        return $this->__soapCall('ConvertTemp',[
            'Temperature'=>$temperature,
            'FromUnit' => $fromUnit,
            'ToUnit' => $toUnit
        ]);
    }
}

/**********SOAP TYPES***********/

/**
 * Generated data proxy class for struct ConvertTemp
 *
 */
class ConvertTemp {
    
    /**
     * @var double $Temperature
     */
    public $Temperature;
    
    /**
     * @var TemperatureUnit $FromUnit
     */
    public $FromUnit;
    
    /**
     * @var TemperatureUnit $ToUnit
     */
    public $ToUnit;
    
}

/**
 * Generated data proxy class for string TemperatureUnit
 *
 */
class TemperatureUnit {
    
}

/**
 * Generated data proxy class for struct ConvertTempResponse
 *
 */
class ConvertTempResponse {
    
    /**
     * @var double $ConvertTempResult
     */
    public $ConvertTempResult;
    
}


