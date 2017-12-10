<?php
namespace sebastiangolian\php\component\soap;

use SoapHeader;
use SoapVar;

/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian\php@gmail.com>
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
    protected $wsdl = 'https://tt.poczta-polska.pl/Sledzenie/services/Sledzenie?wsdl';
    protected $classmap = array(
        "maksymalnaLiczbaPrzesylekResponse" => "sebastiangolian\php\soap\maksymalnaLiczbaPrzesylekResponse",
        "sprawdzPrzesylke" => "sebastiangolian\php\soap\sprawdzPrzesylke",
        "sprawdzPrzesylkeResponse" => "sebastiangolian\php\soap\sprawdzPrzesylkeResponse",
        "sprawdzPrzesylkePl" => "sebastiangolian\php\soap\sprawdzPrzesylkePl",
        "sprawdzPrzesylkePlResponse" => "sebastiangolian\php\soap\sprawdzPrzesylkePlResponse",
        "sprawdzPrzesylki" => "sebastiangolian\php\soap\sprawdzPrzesylki",
        "sprawdzPrzesylkiResponse" => "sebastiangolian\php\soap\sprawdzPrzesylkiResponse",
        "sprawdzPrzesylkiPl" => "sebastiangolian\php\soap\sprawdzPrzesylkiPl",
        "sprawdzPrzesylkiPlResponse" => "sebastiangolian\php\soap\sprawdzPrzesylkiPlResponse",
        "sprawdzPrzesylkiOdDo" => "sebastiangolian\php\soap\sprawdzPrzesylkiOdDo",
        "sprawdzPrzesylkiOdDoResponse" => "sebastiangolian\php\soap\sprawdzPrzesylkiOdDoResponse",
        "sprawdzPrzesylkiOdDoPl" => "sebastiangolian\php\soap\sprawdzPrzesylkiOdDoPl",
        "sprawdzPrzesylkiOdDoPlResponse" => "sebastiangolian\php\soap\sprawdzPrzesylkiOdDoPlResponse",
        "wersjaResponse" => "sebastiangolian\php\soap\wersjaResponse",
        "witaj" => "sebastiangolian\php\soap\witaj",
        "witajResponse" => "sebastiangolian\php\soap\witajResponse",
        "Przesylka" => "sebastiangolian\php\soap\Przesylka",
        "DanePrzesylki" => "sebastiangolian\php\soap\DanePrzesylki",
        "Jednostka" => "sebastiangolian\php\soap\Jednostka",
        "SzczDaneJednostki" => "sebastiangolian\php\soap\SzczDaneJednostki",
        "GodzinyPracy" => "sebastiangolian\php\soap\GodzinyPracy",
        "GodzinyZUwagami" => "sebastiangolian\php\soap\GodzinyZUwagami",
        "ListaZdarzen" => "sebastiangolian\php\soap\ListaZdarzen",
        "Zdarzenie" => "sebastiangolian\php\soap\Zdarzenie",
        "Przyczyna" => "sebastiangolian\php\soap\Przyczyna",
        "Komunikat" => "sebastiangolian\php\soap\Komunikat",
        "ListaPrzesylek" => "sebastiangolian\php\soap\ListaPrzesylek"
    );
    
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
     * @return sprawdzPrzesylkeResponse
     */
    public function sprawdzPrzesylke($numer='testp0')
    {
        return $this->__soapCall('SprawdzPrzesylke',['numer'=>$numer]);
    }
    
    /**
     * Check more delivery info
     * @param string $numer
     * @return sprawdzPrzesylkiResponse
     */
    public function sprawdzPrzesylki($numer='testk-1')
    {
        return $this->__soapCall('SprawdzPrzesylki',['numer'=>$numer]);
    }
    
    /**
     * Genarated webservice method witaj
     *
     * @param witaj $parameters
     * @return witajResponse
     */
    public function witaj(witaj $parameters) {
        return $this->__soapCall('witaj',['parameters'=>$parameters]);
    }
    
    /*
    * Genarated webservice method wersja
    *
    * @return wersjaResponse
    */
    public function wersja() {
        return $this->__soapCall('wersja');
    }
}

/**********SOAP TYPES***********/

/**
 * Generated data proxy class for struct maksymalnaLiczbaPrzesylekResponse
 *
 */
class maksymalnaLiczbaPrzesylekResponse {
    
    /**
     * @var int $return
     */
    public $return;
    
}

/**
 * Generated data proxy class for struct sprawdzPrzesylkiOdDoPl
 *
 */
class sprawdzPrzesylkiOdDoPl {
    
    /**
     * @var string $numer
     */
    public $numer;
    
    /**
     * @var string $odDnia
     */
    public $odDnia;
    
    /**
     * @var string $doDnia
     */
    public $doDnia;
    
}

/**
 * Generated data proxy class for struct sprawdzPrzesylkiOdDoPlResponse
 *
 */
class sprawdzPrzesylkiOdDoPlResponse {
    
    /**
     * @var Komunikat $return
     */
    public $return;
    
}

/**
 * Generated data proxy class for struct wersjaResponse
 *
 */
class wersjaResponse {
    
    /**
     * @var string $return
     */
    public $return;
    
}

/**
 * Generated data proxy class for struct witaj
 *
 */
class witaj {
    
    /**
     * @var string $imie
     */
    public $imie;
    
}

/**
 * Generated data proxy class for struct witajResponse
 *
 */
class witajResponse {
    
    /**
     * @var string $return
     */
    public $return;
    
}

/**
 * Generated data proxy class for struct sprawdzPrzesylke
 *
 */
class sprawdzPrzesylke {
    
    /**
     * @var string $numer
     */
    public $numer;
    
}

/**
 * Generated data proxy class for struct sprawdzPrzesylkeResponse
 *
 */
class sprawdzPrzesylkeResponse {
    
    /**
     * @var Przesylka $return
     */
    public $return;
    
}

/**
 * Generated data proxy class for struct sprawdzPrzesylkePl
 *
 */
class sprawdzPrzesylkePl {
    
    /**
     * @var string $numer
     */
    public $numer;
    
}

/**
 * Generated data proxy class for struct sprawdzPrzesylkePlResponse
 *
 */
class sprawdzPrzesylkePlResponse {
    
    /**
     * @var Przesylka $return
     */
    public $return;
    
}

/**
 * Generated data proxy class for struct sprawdzPrzesylki
 *
 */
class sprawdzPrzesylki {
    
    /**
     * @var string $numer
     */
    public $numer;
    
}

/**
 * Generated data proxy class for struct sprawdzPrzesylkiResponse
 *
 */
class sprawdzPrzesylkiResponse {
    
    /**
     * @var Komunikat $return
     */
    public $return;
    
}

/**
 * Generated data proxy class for struct sprawdzPrzesylkiPl
 *
 */
class sprawdzPrzesylkiPl {
    
    /**
     * @var string $numer
     */
    public $numer;
    
}

/**
 * Generated data proxy class for struct sprawdzPrzesylkiPlResponse
 *
 */
class sprawdzPrzesylkiPlResponse {
    
    /**
     * @var Komunikat $return
     */
    public $return;
    
}

/**
 * Generated data proxy class for struct sprawdzPrzesylkiOdDo
 *
 */
class sprawdzPrzesylkiOdDo {
    
    /**
     * @var string $numer
     */
    public $numer;
    
    /**
     * @var string $odDnia
     */
    public $odDnia;
    
    /**
     * @var string $doDnia
     */
    public $doDnia;
    
}

/**
 * Generated data proxy class for struct sprawdzPrzesylkiOdDoResponse
 *
 */
class sprawdzPrzesylkiOdDoResponse {
    
    /**
     * @var Komunikat $return
     */
    public $return;
    
}

/**
 * Generated data proxy class for struct Komunikat
 *
 */
class Komunikat {
    
    /**
     * @var ListaPrzesylek $przesylki
     */
    public $przesylki;
    
    /**
     * @var int $status
     */
    public $status;
    
}

/**
 * Generated data proxy class for struct ListaPrzesylek
 *
 */
class ListaPrzesylek {
    
    /**
     * @var Przesylka $przesylka
     */
    public $przesylka;
    
}

/**
 * Generated data proxy class for struct Przesylka
 *
 */
class Przesylka {
    
    /**
     * @var DanePrzesylki $danePrzesylki
     */
    public $danePrzesylki;
    
    /**
     * @var string $numer
     */
    public $numer;
    
    /**
     * @var int $status
     */
    public $status;
    
}

/**
 * Generated data proxy class for struct DanePrzesylki
 *
 */
class DanePrzesylki {
    
    /**
     * @var string $dataNadania
     */
    public $dataNadania;
    
    /**
     * @var string $kodKrajuNadania
     */
    public $kodKrajuNadania;
    
    /**
     * @var string $kodKrajuPrzezn
     */
    public $kodKrajuPrzezn;
    
    /**
     * @var string $kodRodzPrzes
     */
    public $kodRodzPrzes;
    
    /**
     * @var string $krajNadania
     */
    public $krajNadania;
    
    /**
     * @var string $krajPrzezn
     */
    public $krajPrzezn;
    
    /**
     * @var float $masa
     */
    public $masa;
    
    /**
     * @var string $numer
     */
    public $numer;
    
    /**
     * @var string $rodzPrzes
     */
    public $rodzPrzes;
    
    /**
     * @var Jednostka $urzadNadania
     */
    public $urzadNadania;
    
    /**
     * @var Jednostka $urzadPrzezn
     */
    public $urzadPrzezn;
    
    /**
     * @var boolean $zakonczonoObsluge
     */
    public $zakonczonoObsluge;
    
    /**
     * @var ListaZdarzen $zdarzenia
     */
    public $zdarzenia;
    
}

/**
 * Generated data proxy class for struct Jednostka
 *
 */
class Jednostka {
    
    /**
     * @var SzczDaneJednostki $daneSzczegolowe
     */
    public $daneSzczegolowe;
    
    /**
     * @var string $nazwa
     */
    public $nazwa;
    
}

/**
 * Generated data proxy class for struct SzczDaneJednostki
 *
 */
class SzczDaneJednostki {
    
    /**
     * @var float $dlGeogr
     */
    public $dlGeogr;
    
    /**
     * @var GodzinyPracy $godzinyPracy
     */
    public $godzinyPracy;
    
    /**
     * @var string $miejscowosc
     */
    public $miejscowosc;
    
    /**
     * @var string $nrDomu
     */
    public $nrDomu;
    
    /**
     * @var string $nrLokalu
     */
    public $nrLokalu;
    
    /**
     * @var string $pna
     */
    public $pna;
    
    /**
     * @var float $szerGeogr
     */
    public $szerGeogr;
    
    /**
     * @var string $ulica
     */
    public $ulica;
    
}

/**
 * Generated data proxy class for struct GodzinyPracy
 *
 */
class GodzinyPracy {
    
    /**
     * @var GodzinyZUwagami $dniRobocze
     */
    public $dniRobocze;
    
    /**
     * @var GodzinyZUwagami $niedzISw
     */
    public $niedzISw;
    
    /**
     * @var GodzinyZUwagami $soboty
     */
    public $soboty;
    
}

/**
 * Generated data proxy class for struct GodzinyZUwagami
 *
 */
class GodzinyZUwagami {
    
    /**
     * @var string $godziny
     */
    public $godziny;
    
    /**
     * @var string $uwagi
     */
    public $uwagi;
    
}

/**
 * Generated data proxy class for struct ListaZdarzen
 *
 */
class ListaZdarzen {
    
    /**
     * @var Zdarzenie $zdarzenie
     */
    public $zdarzenie;
    
}

/**
 * Generated data proxy class for struct Zdarzenie
 *
 */
class Zdarzenie {
    
    /**
     * @var string $czas
     */
    public $czas;
    
    /**
     * @var Jednostka $jednostka
     */
    public $jednostka;
    
    /**
     * @var string $kod
     */
    public $kod;
    
    /**
     * @var boolean $konczace
     */
    public $konczace;
    
    /**
     * @var string $nazwa
     */
    public $nazwa;
    
    /**
     * @var Przyczyna $przyczyna
     */
    public $przyczyna;
    
}

/**
 * Generated data proxy class for struct Przyczyna
 *
 */
class Przyczyna {
    
    /**
     * @var string $kod
     */
    public $kod;
    
    /**
     * @var string $nazwa
     */
    public $nazwa;
    
}


