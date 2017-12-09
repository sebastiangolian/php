<?php

use sebastiangolian\php\components\SqliteCommand;
use sebastiangolian\php\components\SqliteConnector;
use sebastiangolian\php\helpers\VarDumper;

require_once 'base/Autoloader.php';

$sqlliteCommand = new SqliteCommand(SqliteConnector::getInstance('db/sqlite.db'));

/*
$sqlliteCommand->insert('customer',[
    'firstname'=>'Michał',
    'lastname' => 'Nowaczek',
    'profile_id' => 1
]);

$sqlliteCommand->update('customer',['firstname'=>'Michał'],['customer_id'=>3]);
$sqlliteCommand->delete('customer',['customer_id'=>5]);
*/


$sqlliteCommand->printTables(['customer','profile']);
