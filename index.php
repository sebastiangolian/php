<?php
use sebastiangolian\php\base\Collection;
use sebastiangolian\php\helpers\VarDumper;

require_once 'base/Autoloader.php';
require_once 'oop/example/Uczniowie.php';

$semestrJesien2017 = new Semestr("Jesień 2017");
$przedmiotMatematyka = new Przedmiot("Matematyka");
$przedmiotPolski = new Przedmiot("Jezyk polski");


$ocena4 = new Ocena("4");
$ocena5 = new Ocena("5");
$ocena6 = new Ocena("6");

$uczen = new Uczen("Jan","Kowalski");
$uczen->dodajOceneNaSemestr(new OcenaNaSemestr($uczen, $ocena4, $semestrJesien2017, $przedmiotPolski));
$uczen->dodajOceneNaSemestr(new OcenaNaSemestr($uczen, $ocena5, $semestrJesien2017, $przedmiotMatematyka));


class OcenyCollection extends Collection { 
    public function addItem(Ocena $obj, $key = null) {
        parent::addItem($obj, $key);
    }
}

$oceny = new OcenyCollection();
$oceny->addItem($ocena4);
$oceny->addItem($ocena5);
$oceny->addItem($ocena6);

foreach ($oceny as $value)
{
    VarDumper::dump($value);
}

VarDumper::dump($oceny->length());
VarDumper::dump($oceny->getItem(1));