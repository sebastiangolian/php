<?php
namespace sebastiangolian\php\mvc\model;

use sebastiangolian\php\base\ActiveRecord;

class Customer extends ActiveRecord
{
    private $firstname;
    private $lastname;
    private $profile_id;
    
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