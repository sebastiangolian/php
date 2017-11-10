<?php
use sebastiangolian\php\helpers\VarDumper;
use sebastiangolian\php\models\Address;
use sebastiangolian\php\models\Company;
use sebastiangolian\php\models\Email;
use sebastiangolian\php\models\PhoneNumber;
use sebastiangolian\php\models\Worker;

include_once 'base/Autoloader.php';

//stworzenie dwóch obiektów Address
$address = new Address(['street'=>'Testowa 22','number'=>'1','local'=>'2a','postCode'=>'20-000','city'=>'Warszawa','type'=>'domowy']);
$address1 = new Address(['street'=>'Testowa 2','number'=>'3','local'=>'4','postCode'=>'21-000','city'=>'Lublin','type'=>'firmowy']);

//stworzenie dwóch obiektów Email
$email = new Email(['email'=>'SebastianGolian@gmail.com','type'=>'domowy']);
$email1 = new Email(['email'=>'sg@pp.com','type'=>'firmowy']);

//stworzenie dwóch obiektów PhoneNumber
$phoneNumber = new PhoneNumber(['number'=>'25 733 33 33','extension'=>'22','type'=>'firmowy']);
$phoneNumber1 = new PhoneNumber(['number'=>'777777777','extension'=>null,'type'=>'komórkowy']);

//stworzenie obiektu Worker
$worker = new Worker([
    'id' => 1,
    'firstname'=>'Jan',
    'lastname'=>'Kowalski',
    'title' => 'Mgr',
    'addresses'=> [$address,$address1],
    'emails'=>[$email,$email1],
    'phoneNumbers'=>[$phoneNumber,$phoneNumber1]
]);

//stworzenie obiektu Company
$company = new Company([
    'id' => 1,
    'name' => 'Company S.A.',
    'workers' => [$worker]
]);

echo '<h2>Adresy pracownika nr 1 firmy Company S.A.</h2>';
$company_worker_1_addresses = $company->workers[0]->addresses;
VarDumper::dump($company_worker_1_addresses);

$email = new Email([
    'email' => 'sebastiangolian@gmail.com'
]);

VarDumper::dump($email->validate());
VarDumper::dump($email->errors);
