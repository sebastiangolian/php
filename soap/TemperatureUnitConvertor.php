<?php
namespace sebastiangolian\php\soap;

use sebastiangolian\php\base\Soap;


/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 * 
 * TemperatureUnitConvertor Webservice
 * @see http://www.webservicex.com/New/Home/ServiceDetail/31
 */
class TemperatureUnitConvertor extends Soap
{
    protected $_wsdl = 'http://www.webservicex.net/ConvertTemperature.asmx?WSDL';
    
    const UNIT_CELCIUS = 'degreeCelsius';
    const UNIT_FAHRENHEIT = 'degreeFahrenheit';
    const UNIT_RANKINE = 'degreeRankine';
    const UNIT_REAUMR = 'degreeReaumur';
    const UNIT_KELVIN = 'kelvin';
    
    /**
     * Convert temperature
     * $soap = new TemperatureUnitConvertor();
     * $soap->ConvertTemp(20, TemperatureUnitConvertor::UNIT_CELCIUS, TemperatureUnitConvertor::UNIT_KELVIN);
     * @param float $temperature
     * @param string $fromUnit
     * @param string $toUnit
     * @return float
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

