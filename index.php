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

//  ID  KEY VALUE                   A   B   C
//  1   A   A1                  1   A1  B1  B1
//  1   B   B1                  2   A2  n   C2
//  1   C   C1                  3   A3  B3  n
//  2   A   A2
//  2   B   null
//  2   C   C2
//  3   A   A3
//  3   B   B3
//  3   C   null

/*
$arr[1]['A'] = 'A1';
$arr[1]['B'] = 'B1';
$arr[1]['C'] = 'C1';
$arr[2]['A'] = 'A2';
$arr[2]['B'] = 'null';
$arr[2]['C'] = 'C2';
$arr[3]['A'] = 'A3';
$arr[3]['B'] = 'B3';
$arr[3]['C'] = 'null';
*/

$arr = [
    ['1','A','A1'],  
    ['1','B','B1'],  
    ['1','C','C1'],  
    ['2','A','A2'],  
    ['2','B',null],  
    ['2','C','C2'],  
    ['3','A','A3'],
    ['3','B','B3'],
    ['3','C',null],  
];

$arrNew = array();
foreach ($arr as $record)
{
    $arrNew[$record[0]][$record[1]] = $record[2];
}

VarDumper::dump($arrNew['2']['B']);

