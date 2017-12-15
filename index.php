<?php
use sebastiangolian\php\component\helper\VarDumper;
use sebastiangolian\php\mvc\model\Customer;

require_once 'base/Autoloader.php';

VarDumper::dump(Customer::findOne(1));
VarDumper::dump(Customer::findAll(['id','>','1']));




