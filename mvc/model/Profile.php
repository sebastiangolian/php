<?php
namespace sebastiangolian\php\mvc\model;

use sebastiangolian\php\base\ActiveRecord;

/**
 * @property string $login 
 * @property string $role 
 */

class Profile extends ActiveRecord 
{
    protected $login;
    protected $role;
    
    protected $tableName = 'profile';
    protected $rules = [
        [['login', 'role'], 'required']
    ];
}