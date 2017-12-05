<?php

use sebastiangolian\php\helpers\VarDumper;
use sebastiangolian\php\models\Address;
use sebastiangolian\php\models\Company;
use sebastiangolian\php\models\Email;
use sebastiangolian\php\models\Phone;
use sebastiangolian\php\models\Worker;

require_once 'base/Autoloader.php';

$company = Company::create()->setName('ZOO z.o.o.');
$woker1 = Worker::create()
    ->setFirstname('Jan')
    ->setLastname('Kowalski')
    ->setGender(Worker::GENDER_MAN)
    ->addAddress(Address::create()->setStreet('Długa 28')->setPostcode('20-000')->setCity('Warszawa'))
    ->addEmail(Email::create()->setEmail('test@o2.pl')->setType(Email::TYPE_HOME))
    ->addPhone(Phone::create()->setNumber('777777777')->setType(Phone::TYPE_HOME))
    ->addCompany($company);

$worker2 = Worker::create()->setFirstname("Michał")->setLastname("Nowak");
$worker3 = Worker::create()->setFirstname("Michał")->setLastname("Nowak");
$company->addWorker($worker2);
$company->addWorker($worker3);

foreach ($company->getWorkers() as $loopWorker)
{
    VarDumper::dump($loopWorker->getLastname());
}
    



