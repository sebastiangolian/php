<?php
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





$collection = new Collection('Ocena');
$collection[] = $ocena4;
$collection[] = $ocena6;
$collection[] = $ocena5;

sort($collection);
foreach ($collection as $value)
{
    VarDumper::dump($value);
}