<?php
namespace sebastiangolian\php\mvc\model;

use sebastiangolian\php\mvc\core\Model;

/**
 * @property string $firstname  
 * @property string $lastname 
 * @property integer $profile_id 
 */

class Customer extends Model
{
    protected $tableName = 'customer';
    
    protected $columns = [
        'firstname' => 'Imię',
        'lastname' => 'Nazwisko',
        'profile_id' => 'Id profilu'
    ];
    
    protected $rules = [
        [['firstname', 'lastname', 'profile_id'], 'required'],
        [['profile_id'], 'integer']
    ];
}