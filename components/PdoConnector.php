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
    private $_pdo;
    private $_parameters = [];
    private $_query;
    
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
    
    public function before($query, $parameters = "")
    {
        try {
            
            $this->_query = $this->_pdo->prepare($query);
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
                    $this->_query->bindValue($value[0], $value[1], $type);
                }
            }
            
            $this->_query->execute();
        }
        catch (Exception $ex) {
            echo $ex->getMessage().' '.$query;
        }
    }
    
    public function addParametr($parameter, $value)
    {
        $this->_parameters[sizeof($this->_parameters)] = [":" . $parameter , $value];
    }

    public function addParameters($parameters)
    {
        if (empty($this->_parameters) && is_array($parameters)) {
            $columns = array_keys($parameters);
            foreach ($columns as &$column) {
                $this->addParametr($column, $parameters[$column]);
            }
        }
    }
    
    public function close()
    {
        $this->_pdo = null;
    }
    
    public function __destruct() {
        $this->close();
    }
}

