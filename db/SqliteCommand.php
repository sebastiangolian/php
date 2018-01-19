<?php
namespace sebastiangolian\php\db;
use SQLite3Result;
use sebastiangolian\php\base\Component;

class SqliteCommand extends Component 
{
    private $connector;
    
    /**
     * @param SqliteConnector $connector
     * 
     * $sqlliteCommand = new SqliteCommand(SqliteConnector::getInstance('mvc/db/sqlite.db'));
     */
    public function __construct(SqliteConnector $connector)  
    {
        $this->connector = $connector;
    }
    
    /**
     * Get all rows
     * @param array $where
     * @return array
     *
     * $select = $sqlliteCommand->select('customer',['lastname'=>'Kowalski']);
     */
    public function select($table,$where = null)
    {
        $query = new Query();
        $sql = $query->where($where)->select([$table]); 
        $stmt = $this->connector->getConnect()->prepare($sql);
        $ret = array();
        $results = $stmt->execute();
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            array_push($ret, $row);
        }
        return $ret;
    }

    /**
     * @param array $table
     * @param array $attributes
     * @return SQLite3Result
     * 
     * $sqlliteCommand->insert('customer',[
     *      'firstname'=>'Michał',
     *      'lastname' => 'Nowaczek',
     *      'profile_id' => 1
     *  ]);
     */
    public function insert($table,$attributes) 
    {
        $query  = "INSERT INTO ".$table;
        $query .= " (`".implode("`, `", array_keys($attributes))."`)";
        $query .= " VALUES ('".implode("', '", $attributes)."') ";
        return $this->connector->getConnect()->prepare($query)->execute();
    }
    
    /**
     * 
     * @param string $table
     * @param array $attributes
     * @param array $where
     * @return SQLite3Result
     * 
     * $sqlliteCommand->update('customer',['firstname'=>'Michał'],['customer_id'=>3]);
     */
    public function update($table, $attributes, $where) 
    {
        $query  = "UPDATE ".$table;
        $query .= " SET ";
        
        foreach ($attributes as $key=>$value) 
        {
            $query .= $key." = '".$value."',";
        }
        $query = substr($query, 0, -1);
        $query .= $this->queryWhere($where);
        
        return $this->connector->getConnect()->prepare($query)->execute();
    }
    
    /**
     * @param string $table
     * @param array $where
     * @return SQLite3Result
     * 
     * $sqlliteCommand->delete('customer',['customer_id'=>5]);
     */
    public function delete($table, $where) {
        $query  = "DELETE FROM ".$table;
        $query .= $this->queryWhere($where);
        return $this->connector->getConnect()->prepare($query)->execute();
    }

    /**
     * @param string $table
     * 
     * $sqlliteCommand->printTable('customer');
     */
    public function printTable($table)
    {
        $result = $this->select($table);
        $existHeader = false;
        echo "<span>-------------  <b>".strtoupper($table)."</b>  -------------</span><br />";
        echo "<table>";
        foreach ($result as $rows)
        {
            if(!$existHeader)
            {
                echo "<tr>";
                foreach ($rows as $key=>$value)
                {
                    echo "<th>".$key."</th>";
                }
                echo "</tr>";
                $existHeader = true;
            }
            
            echo "<tr>";
            foreach ($rows as $value)
            {
                echo "<td>".$value."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    
    /**
     * @param array $tables
     * 
     * $sqlliteCommand->printTables(['customer','profile']);
     */
    public function printTables($tables = null)
    {
        if($tables == null){
            $tables = $this->getTableNames();
        }
        
        foreach ($tables as $table)
        {
            $this->printTable($table);
        }
    }
    
    public function getTableNames()
    {
        $sql = "SELECT name FROM sqlite_master WHERE type='table'";
        $stmt = $this->connector->getConnect()->prepare($sql);
        $ret = array();
        $results = $stmt->execute();
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            array_push($ret, $row['name']);
        }
        return $ret;
    }
}