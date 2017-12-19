<?php
namespace sebastiangolian\php\mvc\model;

use sebastiangolian\php\component\sql\SqliteActiveRecord;

/**
 * @property string $login 
 * @property string $role 
 */

class Profile extends SqliteActiveRecord
{
    protected $tableName = 'profile';
    
    protected $columns = [
        'login' => 'Login',
        'role' => 'Rola'
    ];
    
    protected $rules = [
        [['login', 'role'], 'required']
    ];
}