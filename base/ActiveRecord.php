<?php
namespace sebastiangolian\php\base;

use SQLite3;
use sebastiangolian\php\component\sql\Query;
use sebastiangolian\php\component\sqlite\SqliteConnector;

class ActiveRecord
{
    protected $id;
    protected $tableName;
    protected $rules;
    
    public function getTableName()
    {
        return $this->tableName;
    }
    
    /**
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
     * @param array $attibutes
     * @return boolean
     */
    protected function setAttributes(array $attibutes)
    {
        foreach ($attibutes as $key=>$value){
            $this->$key = $value; 
        }
        
        return true;
    }
    
    public function __set($name, $value)
    {
        $this->$name = $value;
    }
    
    public function __get($name)
    {
        return $this->$name;
    }
}