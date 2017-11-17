<?php
use sebastiangolian\php\models\Address;
use sebastiangolian\php\models\Company;
use sebastiangolian\php\models\Email;
use sebastiangolian\php\models\PhoneNumber;
use sebastiangolian\php\models\Worker;

require_once 'base/Autoloader.php';
//require_once 'oop/example/Uczniowie.php';

$company = new Company(['id' => 1,'name' => 'Company S.A.']);
$address = new Address(['street'=>'Testowa','number'=> '10','local' => '2','city' => 'Lublin','postCode' => '20-900','type' => 'firmowy']);
$phoneNumber = new PhoneNumber(['number'=> '777777777', 'type'=>'domowy']);
$email = new Email(['email'=> 'test@o2.pl', 'type'=>'domowy']);



$worker = new Worker(['firstname'=>'Jan','lastname'=>'Kowalski','title'=>'Dyrektor']);
$worker->addCompany($company);


$company->addAddress($address)
->addPhoneNumber($phoneNumber)
->addEmail($email)
->toString();