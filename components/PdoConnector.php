<?php
namespace sebastiangolian\php\components;

use Exception;
use PDO;
use sebastiangolian\php\base\Component;

/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 * 
 * PHP Component allows the use of PDO library
 */
class PdoConnector extends Component
{
    /**
     * PDO handler
     * @var PDO 
     */
    private $_pdo;
    
    /**
     * List of query parameters 
     * @var array 
     */
    private $_parameters = [];
    
    /**
     * Query to prepare
     * @var string 
     */
    private $_query;
    
    /**
     * PdoConnector object
     * $pdo = new \sebastiangolian\php\components\PdoConnector('localhost','db','root','password');
     * @param string $dbhost
     * @param string $dbname
     * @param string $user
     * @param string $pass
     * @param array $config
     */
    public function __construct($dbhost, $dbname, $user, $pass, $config = []) 
    {
        parent::__construct($config);
        try {
            $pdo = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname . ';charset=utf8', $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_pdo = $pdo;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    /**
     * Returns an array containing all of the result set rows or query row count
     * Testing::vd($pdo->query("INSERT INTO service VALUES (1,'test', 'test', '1')"));
     * Testing::vd($pdo->query("INSERT INTO service VALUES (:id,:name,:short_name,:type)",['id'=>2,'name'=>'test','short_name'=>'t','type'=>1]));
     * Testing::vd($pdo->query('SELECT * FROM service'));
     * Testing::vd($pdo->query("DELETE FROM service WHERE id=:id",['id'=>1]));
     * @param string $query
     * @param array $params
     * @param int $fetchmode
     * @return mixed
     */
    public function query($query, $params = null, $fetchmode = PDO::FETCH_ASSOC)
    {
        $query = trim(str_replace("\r", " ", $query));
        $this->before($query, $params);
        $rawStatement = explode(" ", preg_replace("/\s+|\t+|\n+/", " ", $query));
        $statement = strtolower($rawStatement[0]);
        
        if ($statement === 'select' || $statement === 'show') {
            return $this->_query->fetchAll($fetchmode);
        } elseif ($statement === 'insert' || $statement === 'update' || $statement === 'delete') {
            return $this->_query->rowCount();
        } else {
            return NULL;
        }
    }
    
    /**
     * Tasks before query realisation
     * @param string $query
     * @param array $parameters
     */
    private function before($query, $parameters = "")
    {
        try {
            $this->_query = $this->_pdo->prepare($query);
            $this->_parameters = [];
            $this->addParameters($parameters);

            if (!empty($this->_parameters)) {
                foreach ($this->_parameters as $value) {
                    if(is_int($value[1])) {
                        $type = PDO::PARAM_INT;
                    } else if(is_bool($value[1])) {
                        $type = PDO::PARAM_BOOL;
                    } else if(is_null($value[1])) {
                        $type = PDO::PARAM_NULL;
                    } else {
                        $type = PDO::PARAM_STR;
                    }
                    $this->_query->bindValue($value[0], $value[1], $type);
                }
            }
            
            $this->_query->execute();
        }
        catch (Exception $ex) {
            echo $ex->getMessage().' '.$query;
        }
    }
    
    /**
     * Add parameter to list
     * @param type $parameter
     * @param type $value
     */
    public function addParametr($parameter, $value)
    {
        $this->_parameters[sizeof($this->_parameters)] = [":" . $parameter , $value];
    }

    /**
     * Add parameters to list
     * @param type $parameters
     */
    public function addParameters($parameters)
    {
        if (empty($this->_parameters) && is_array($parameters)) {
            $columns = array_keys($parameters);
            foreach ($columns as &$column) {
                $this->addParametr($column, $parameters[$column]);
            }
        }
    }
    
    /**
     * Get id last insert row
     * @return string
     */
    public function getLastInsertId()
    {
        return $this->_pdo->lastInsertId();
    }
    
    /**
     * Begin transaction
     * @return boolean
     */
    public function beginTransaction()
    {
        return $this->_pdo->beginTransaction();
    }
    
    /**
     * Execute transaction
     * @return boolean
     */
    public function executeTransaction()
    {
        return $this->_pdo->commit();
    }
    
    /**
     * Rollback of transaction
     * @return boolean
     */
    public function rollBack()
    {
        return $this->pdo->rollBack();
    }
    
    /**
     * Close PDO connection
     */
    public function close()
    {
        $this->_pdo = null;
    }
    
    /**
     * PdoConnector destructor
     */
    public function __destruct() {
        $this->close();
    }
}

