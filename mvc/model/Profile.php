<?php
namespace sebastiangolian\php\mvc\model;

use sebastiangolian\php\mvc\core\Model;

/**
 * @property string $login 
 * @property string $role 
 */

class Profile extends Model
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