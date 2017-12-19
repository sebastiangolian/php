<?php
namespace sebastiangolian\php\component\sql;

use SQLite3;
use SQLite3Result;
use sebastiangolian\php\component\sql\Query;
use sebastiangolian\php\component\sql\SqliteCommand;
use sebastiangolian\php\component\sql\SqliteConnector;

class SqliteActiveRecord
{
    protected $id;
    protected $columns;
    protected $tableName;
    protected $rules;
    
    public function getTableName()
    {
        return $this->tableName;
    }
    
    /**
     * Find one record
     * Customer::findOne(1)
     * 
     * @param integer $id
     * @return self
     */
    public static function findOne($id)
    {
        $results = self::find(['id'=>$id]);
        $className = get_called_class();
        $activeRecord = new $className;
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $activeRecord->setAttributes($row);
            break;
        }        
        return $activeRecord;
    }
    
     /**
     * Find more record
     * Customer::findAll()
     * Customer::findAll(['id' = 1])
     * Customer::findAll(['id','>','1'])
     * 
     * @return self[]
     */
    public static function findAll($condition = null)
    {
        $results = self::find($condition);
        $className = get_called_class();
        $retArray = array();
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $activeRecord = new $className;
            $activeRecord->setAttributes($row);
            array_push($retArray,$activeRecord);
        }
        return $retArray;
    }
    
    /**
     * $customer = new Customer();
     * $customer->firstname = "test 321";
     * $customer->lastname = "Typowy";
     * $customer->profile_id = 1;
     * $customer->insert();
     * @return SQLite3Result
     */
    public function insert()
    {
        $columns = array_keys($this->columns);
        $attributes = array();
        foreach ($columns as $column)
        {
            $attributes[$column] = $this->$column;
        }

        $sqlliteCommand = new SqliteCommand($this->getConnector());
        return $sqlliteCommand->insert('customer',$attributes);
    }
    
    /**
     * Update row
     * $customer = Customer::findOne(5);
     * $customer->firstname = "test 456";
     * $customer->update();
     * 
     * @return SQLite3Result
     */
    public function update()
    {
        $columns = array_keys($this->columns);
        $attributes = array();
        foreach ($columns as $column)
        {
            $attributes[$column] = $this->$column;
        }
        
        $sqlliteCommand = new SqliteCommand($this->getConnector());
        return $sqlliteCommand->update('customer',$attributes,['id'=>$this->id]);
    }
   
    /**
     * Find row in table
     * @param array $condition
     * @return SQLite3Result an SQLite3Result object on successful execution of the prepared
     * statement, false on failure.
     */
    
    protected static function find($condition = null)
    {
        $className = get_called_class();
        $activeRecord = new $className;
        $sql = Query::create()->where($condition)->select($activeRecord->getTableName());
        $stmt = $activeRecord->getConnect()->prepare($sql);
        unset($activeRecord);
        return $stmt->execute();
    }
    
    /**
     * @return SQLite3
     */
    protected function getConnect()
    {
        return SqliteConnector::getInstance('mvc/db/sqlite.db')->getConnect();
    }
    
    /**
     * @return \sebastiangolian\php\component\sql\SqliteConnector
     */
    protected function getConnector()
    {
        return SqliteConnector::getInstance('mvc/db/sqlite.db');
    }
    
    /**
     * @param array $attibutes
     * @return boolean
     */
    protected function setAttributes(array $attributes)
    {
        foreach ($attributes as $key=>$value){
            $this->$key = $value; 
        }
        
        return true;
    }
    
    /**
     * Magic function set
     * @param string $name
     * @param string $value
     */
    public function __set($name, $value)
    {
        $this->$name = $value;
    }
    
    /**
     * Magic function get
     * @param string $name
     * @return string
     */
    public function __get($name)
    {
        return $this->$name;
    }
}