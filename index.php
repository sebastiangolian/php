<?php
use sebastiangolian\php\component\sql\SqliteCommand;
use sebastiangolian\php\component\sql\SqliteConnector;
use sebastiangolian\php\mvc\model\Customer;
use sebastiangolian\php\component\helper\VarDumper;

require_once 'base/Autoloader.php';

//VarDumper::dump(Customer::findOne(1));
//VarDumper::dump(Customer::findAll(['id','>','1']));


$sqlliteCommand = new SqliteCommand(SqliteConnector::getInstance('mvc/db/sqlite.db'));
$select = $sqlliteCommand->select('customer',['profile_id'=>'1']);

VarDumper::dump($select);



