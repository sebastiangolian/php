<?php
namespace sebastiangolian\php\db;
use sebastiangolian\php\base\Component;

class SqliteTest extends Component 
{
    private $dbPath;
    private $connector;
    
    /**
     * @param SqliteConnector $connector
     * 
     * $sqlliteTest = new SqliteTest('db/sqlite.db');
     */
    public function __construct($dbPath = 'db/sqlite.db')  
    {
        $this->dbPath = $dbPath;
        $this->connector = SqliteConnector::getInstance($dbPath);
    }
    
    public function create()
    {
        $this->createCustomerTable();
        $this->createCustomerRows();
        $this->createTaskTable();
        $this->createTaskRows();
    }
    
    public function printTables()
    {
        $sqlliteCommand = new SqliteCommand($this->connector);
        $sqlliteCommand->printTables();
    }
    
    public function delete()
    {
        $this->connector->getConnect()->close();
        if(file_exists($this->dbPath))
            return unlink($this->dbPath);
        else 
            return false;
    }
    
    private function createCustomerTable()
    {
        $query = "
        CREATE TABLE IF NOT EXISTS 'customer' (
        	id INTEGER NOT NULL PRIMARY KEY,
        	name text NOT NULL,
        	created datetime NOT NULL,
        	modified timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
        )";
        
        return $this->connector->getConnect()->prepare($query)->execute();
    }
    
    private function createCustomerRows()
    {
        $query = "
        INSERT INTO customer (name,created)
            VALUES
             ('Jan Kowalski','".date('Y-m-d h:i:s')."'),
             ('Michał Nowak','".date('Y-m-d h:i:s')."'),
             ('Katarzyna Kowalska','".date('Y-m-d h:i:s')."')
        ";
        
        return $this->connector->getConnect()->prepare($query)->execute();
    }
    
    private function createTaskTable()
    {
        $query = "
        CREATE TABLE IF NOT EXISTS 'task' (
        	id integer NOT NULL PRIMARY KEY,
        	name text NOT NULL,
            customer_id integer NOT NULL,
        	created datetime NOT NULL,
        	modified timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
        )";
        
        return $this->connector->getConnect()->prepare($query)->execute();
    } 
    
    private function createTaskRows()
    {
        $query = "
        INSERT INTO task (name,customer_id,created)
            VALUES
             ('Task 1','1','".date('Y-m-d h:i:s')."'),
             ('Task 2','2','".date('Y-m-d h:i:s')."'),
             ('Task 3','3','".date('Y-m-d h:i:s')."')
        ";
        
        return $this->connector->getConnect()->prepare($query)->execute();
    }
}