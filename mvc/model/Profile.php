<?php
namespace sebastiangolian\php\mvc\model;

use sebastiangolian\php\base\ActiveRecord;

class Profile extends ActiveRecord 
{
    private $login;
    private $role;
    
    public static function tableName()
    {
        return 'customer';
    }
    
    public function rules()
    {
        return [
            [['username', 'email', 'status'], 'required'],
            [['profile_id'], 'integer']
        ];
    }
}