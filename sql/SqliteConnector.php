<?php
namespace sebastiangolian\php\sql;

use SQLite3;
use sebastiangolian\php\base\Component;

/*
//CONNECT
$db = SqliteConnector::getInstance('db/sqlite.db')->getConnect();

//INSERT
$stmt = $db->prepare('INSERT INTO people(firstname,lastname,address_id) values(:firstname,:lastname,:address_id)');
$stmt->bindValue(':firstname', 'Michał', SQLITE3_TEXT);
$stmt->bindValue(':lastname', 'Nowak', SQLITE3_TEXT);
$stmt->bindValue(':address_id', 1, SQLITE3_INTEGER);
$stmt->execute();

//UPDATE
$stmt = $db->prepare('UPDATE people SET firstname=:firstname, lastname=:lastname, address_id=:address_id WHERE person_id=:person_id');
$stmt->bindValue(':firstname', 'Michał', SQLITE3_TEXT);
$stmt->bindValue(':lastname', 'Nowak', SQLITE3_TEXT);
$stmt->bindValue(':address_id', 1, SQLITE3_INTEGER);
$stmt->bindValue(':person_id', 4, SQLITE3_INTEGER);
$stmt->execute();

//DELETE
$stmt = $db->prepare('DELETE FROM people WHERE person_id=:person_id');
$stmt->bindValue(':person_id', 4, SQLITE3_INTEGER);
$stmt->execute();

//SELECT ALL
$results = $db->prepare('SELECT * FROM people')->execute();
VarDumper::dump($results->fetchArray());

//SELECT WITH PARAMETER
$stmt = $db->prepare('SELECT * FROM people WHERE person_id=:person_id');
$stmt->bindValue(':person_id', 1, SQLITE3_INTEGER);
$result = $stmt->execute();
VarDumper::dump($result->fetchArray());
*/
class SqliteConnector extends Component
{
    /**
     * @var $this
     */
    private static $instance;
    
    /**
     * @var SQLite3
     */
    private $connect;
    
    /**
     * @param string $filename
     */
    private function __construct($filename) {
        $this->connect = new SQLite3($filename);
    }
    
    /**
     * 
     * @param string $filename
     * @return SqliteConnector
     */
    public static function getInstance($filename) {
        if(self::$instance === null) {
            self::$instance = new self($filename);
        }
        return self::$instance;
    }
    
    /**
     * @return SQLite3
     */
    public function getConnect()
    {
        return $this->connect;
    }
}