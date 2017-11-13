<?php
class Uczen
{
    private $imie;
    private $nazwisko;
    
    private $ocenyNaSemestr = array();
    
    public function __construct($imie,$nazwisko)
    {
        $this->imie = $imie;
        $this->nazwisko = $nazwisko;
    }
    
    public function pobierzOcenyNaSemestr()
    {
        return $this->ocenyNaSemestr;
    }
    
    public function dodajOceneNaSemestr(OcenaNaSemestr $ocenaNaSemestr)
    {
        array_push($this->ocenyNaSemestr, $ocenaNaSemestr);
    }
}

class Przedmiot
{
    private $nazwa;
    
    public function __construct($nazwa)
    {
        $this->nazwa = $nazwa;
    }
    
}

class Ocena
{
    private $nazwa;

    public function __construct($nazwa)
    {
        $this->nazwa = $nazwa;
    }
}

class Semestr
{
    private $nazwa;
    
    public function __construct($nazwa)
    {
        $this->nazwa = $nazwa;
    }
    
}

class OcenaNaSemestr
{
    private $uczen;
    private $ocena;
    private $semestr;
    
    public function __construct(Uczen $uczen,Ocena $ocena, Semestr $semestr, Przedmiot $przedmiot)
    {
        $this->uczen = $uczen;
        $this->ocena = $ocena;
        $this->semestr = $uczen;
        $this->przedmiot = $przedmiot;
    }
}

class Collection {
    
    private $_members = array();    // elementy kolekcji
    
    private $_onload;               // funkcja zwrotna
    
    private $_isLoaded = false;     // flaga określająca, czy funkcja zwrotna została już wywołana
    
    public function addItem($obj, $key = null) {
        $this->_checkCallback();     // _checkCallback zdefiniowano nieco póĽniej
        
        if($key) {
            if(isset($this->_members[$key])) {
                throw new Exception("Klucz \"$key\" jest już zajęty!");
            } else {
                $this->_members[$key] = $obj;
            }
        } else {
            $this->_members[] = $obj;
        }
    }
    
    public function removeItem($key) {
        $this->_checkCallback();
        
        if(isset($this->_members[$key])) {
            unset($this->_members[$key]);
        } else {
            throw new Exception("Błędny klucz \"$key\"!");
        }
    }
    
    public function getItem($key) {
        $this->_checkCallback();
        
        if(isset($this->_members[$key])) {
            return $this->_members[$key];
        } else {
            throw new Exception("Błędny klucz \"$key\"!");
        }
    }
    
    public function keys() {
        $this->_checkCallback();
        return array_keys($this->_members);
    }
    
    public function length() {
        $this->_checkCallback();
        return sizeof($this->_members);
    }
    
    public function exists($key) {
        $this->_checkCallback();
        return (isset($this->_members[$key]));
    }
    
    /**
     * Ta metoda pozwala na zdefiniowanie funkcji,
     * którą należy wywołać, aby wypełnić kolekcję.
     * Jedynym parametrem tej funkcji powinna być
     * kolekcja do wypełnienia.
     */
    public function setLoadCallback($functionName, $objOrClass = null) {
        if($objOrClass) {
            $callback = array($objOrClass, $functionName);
        } else {
            $callback = $functionName;
        }
        
        // sprawdzenie, czy funkcję zwrotną da się wywołać
        if(!is_callable($callback, false, $callableName)) {
            throw new Exception("Funkcja zwrotna $callableName nieprawidłowa!");
            return false;
        }
        $this->_onload = $callback;
    }
    /**
     * Sprawdzenie, czy funkcja zwrotna została zdefiniowana,
     * a jeśli tak, czy została już wywołana. Jeśli nie,
     * zostaje ona wywołana.
     */
    private function _checkCallback() {
        if(isset($this->_onload) && !$this->_isLoaded) {
            $this->_isLoaded = true;
            call_user_func($this->_onload, $this);
        }
    }
}