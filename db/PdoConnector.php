<?php
namespace sebastiangolian\php\db;

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
    private $pdo;
    
    /**
     * List of query parameters 
     * @var array 
     */
    private $parameters = [];
    
    /**
     * Query to prepare
     * @var string 
     */
    private $query;
    
    /**
     * PdoConnector object
     * $pdo = new \sebastiangolian\php\components\PdoConnector('localhost','db','root','password');
     * @param string $dbhost
     * @param string $dbname
     * @param string $user
     * @param string $pass
     * @param array $config
     */
    public function __construct($dbhost, $dbname, $user, $pass) 
    {
        try {
            $pdo = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname . ';charset=utf8', $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    /**
     * Returns an array containing all of the result set rows or query row count
     * Testing::vd($pdo->query("SELECT table_name FROM information_schema.tables WHERE table_schema='dbonline'"));
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
            return $this->query->fetchAll($fetchmode);
        } elseif ($statement === 'insert' || $statement === 'update' || $statement === 'delete') {
            return $this->query->rowCount();
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
            $this->query = $this->pdo->prepare($query);
            $this->parameters = [];
            $this->addParameters($parameters);

            if (!empty($this->parameters)) {
                foreach ($this->parameters as $value) {
                    if(is_int($value[1])) {
                        $type = PDO::PARAM_INT;
                    } else if(is_bool($value[1])) {
                        $type = PDO::PARAM_BOOL;
                    } else if(is_null($value[1])) {
                        $type = PDO::PARAM_NULL;
                    } else {
                        $type = PDO::PARAM_STR;
                    }
                    $this->query->bindValue($value[0], $value[1], $type);
                }
            }
            
            $this->query->execute();
        }
        catch (Exception $ex) {
            echo $ex->getMessage().' '.$query;
        }
    }
    
    /**
     * Add parameter to list
     * @param string $parameter
     * @param string $value
     */
    public function addParametr($parameter, $value)
    {
        $this->parameters[sizeof($this->parameters)] = [":" . $parameter , $value];
    }

    /**
     * Add parameters to list
     * @param array $parameters
     */
    public function addParameters($parameters)
    {
        if (empty($this->parameters) && is_array($parameters)) {
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
        return $this->pdo->lastInsertId();
    }
    
    /**
     * Begin transaction
     * @return boolean
     * 
        $pdoConnector = new PdoConnector('localhost','dbonline', 'root', 'pass');
        try {
            $pdoConnector->beginTransaction();
            $pdoConnector->execTransaction("INSERT INTO `log` (`id`, `level`, `category`, `log_time`, `prefix`, `message`, `is_error`) VALUES (NULL, '1', 'test', NULL, 'test', 'test', '0');");
            $pdoConnector->commitTransaction();
            
        } catch (Exception $e) {
            $pdoConnector->rollBack();
            echo "Failed: " . $e->getMessage();
        }
     */
    public function beginTransaction()
    {
        return $this->pdo->beginTransaction();
    }
    
    /**
     * Execute transaction
     * @return boolean
     */
    public function execTransaction($query)
    {
        return $this->pdo->exec($query);
    }
    
    /**
     * Commit transaction
     * @return boolean
     */
    public function commitTransaction()
    {
        return $this->pdo->commit();
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
        $this->pdo = null;
    }
    
    /**
     * PdoConnector destructor
     */
    public function __destruct() {
        $this->close();
    }
}

