<h1>Hermetyzacja - Eskapulacja</h1><hr />
<p>Ograniczenie dostępów do właściwości i metod klasy, dla innych klas.<p>

<?php
class User
{
    const DEFAULT_NAME = 'User';
    public static $table = 'user';
    public $defaultCountry = 'Poland';
    private $firstname;
    
    public static function getClassName()
    {
        return self::$table;
    }
    
    public function setFirstname($firstname)
    {
        if($this->_stringValidation($firstname))
        {
            $this->firstname = ucfirst($firstname);
        }
        else
        {
            new Exception('Invalid firstname');
        }
    }
    
    public function getFirstname()
    {
        return $this->firstname;
    }
    
    public static function getRandomUser()
    {
        $user = new User;
        $user->firstname = 'RandomUser';
        return $user;
    }
    
    private function _stringValidation($string)
    {
        if($string != null && is_string($string))
        {
            return true;
        }
        else 
        {
            return false;
        }
    }
}

User::getRandomUser();