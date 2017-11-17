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
    
    public function __construct(Uczen $uczen, Ocena $ocena, Semestr $semestr, Przedmiot $przedmiot)
    {
        $this->uczen = $uczen;
        $this->ocena = $ocena;
        $this->semestr = $uczen;
        $this->przedmiot = $przedmiot;
    }
}

