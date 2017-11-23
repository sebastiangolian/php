<?php

use sebastiangolian\php\helpers\VarDumper;

require_once 'base/Autoloader.php';

/*
$address = Address::create()->setStreet('Długa 28')->setPostcode('20-000')->setCity('Warszawa');
$email = Email::create()->setEmail('test@o2.pl')->setType(Email::TYPE_HOME);
$phone = Phone::create()->setNumber('777777777')->setType(Phone::TYPE_HOME);
$woker = Worker::create()->setId(1)->setFirstname('Jan')->setLastname('Kowalski')->setGender(Worker::GENDER_MAN);
$company = Company::create()->setId(1)->setName('ZOO z.o.o.');
$woker->addAddress($address)->addEmail($email)->addPhone($phone)->addCompany($company)->toString();
*/


$arr[1]['A'] = 'A1';
$arr[1]['B'] = 'B1';
$arr[1]['C'] = 'C1';
$arr[2]['A'] = 'A2';
$arr[2]['B'] = 'null';
$arr[2]['C'] = 'C2';
$arr[3]['A'] = 'A3';
$arr[3]['B'] = 'B3';
$arr[3]['C'] = 'null';

VarDumper::dump($arr);

