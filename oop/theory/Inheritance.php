<h1>Inherit - Dziedziczenie</h1><hr />
<p>Przekazywanie właściwości i metod klasie potomnej.<p>

<?php
abstract class Model 
{
    public $name = 'ModelClass';
    protected $tableName;
    
    public function getTableName()
    {
        return $this->tableName;
    }
}

class UserModel extends Model 
{
    protected $tableName = 'user';
}

$model = new UserModel();
echo $model->name.'<br />';
echo $model->getTableName();