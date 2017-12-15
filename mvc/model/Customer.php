<?php
namespace sebastiangolian\php\mvc\model;

use sebastiangolian\php\base\ActiveRecord;

/**
 * @property string $firstname  
 * @property string $lastname 
 * @property integer $profile_id 
 */

class Customer extends ActiveRecord
{
    protected $firstname;
    protected $lastname;
    protected $profile_id;
    
    protected $tableName = 'customer';
    protected $rules = [
        [['username', 'email', 'status'], 'required'],
        [['profile_id'], 'integer']
    ];
}