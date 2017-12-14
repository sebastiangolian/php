<?php
namespace sebastiangolian\php\base;

use SQLite3;
use sebastiangolian\php\component\sqlite\SqliteConnector;

abstract class ActiveRecord
{
    private $id;
    
    abstract static function tableName();
    abstract function rules();
    
    public static function findOne($id)
    {
        $stmt = self::getConnect()->prepare("SELECT * FROM ".self::tableName()." WHERE id=:id");
        $stmt->bindValue(':id', 1, SQLITE3_INTEGER);
        return $stmt->execute();
    }
    
    /**
     * @return SQLite3
     */
    private static function getConnect()
    {
        return SqliteConnector::getInstance('mvc/db/sqlite.db')->getConnect();
    }
}