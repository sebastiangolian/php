<h1>Abstrakcja</h1><hr />
<p>Rozwiązanie problemu przez algorytm i zwiększenie jego ogólności. <p>

<?php
interface DBConnection
{
    public function connect();
    public function disconnect();
}

class OracleDbConnection implements DBConnection
{
    public function connect()
    {
        return 'rozpoczęcie połączenia dla bazy ORACLE';
    }
    public function disconnect()
    {
        return 'zakończenia połączenia dla bazy ORACLE';
    }
}

class MySqlDbConnection implements DBConnection
{
    public function connect()
    {
        return 'rozpoczęcie połączenia dla bazy MySql';
    }
    public function disconnect()
    {
        return 'zakończenia połączenia dla bazy MySql';
    }
}

class Application
{
    private $dbConnection;
    
    public function connectDb(DBConnection $dbc)
    {
        $this->dbConnection = $dbc;
        return 'połączenie z bazą danych dla aplikacji';
    }
    
    public function getDbConnection()
    {
        return $this->dbConnection;
    }
}

//example
$application = new Application();
$application->connectDb(new MySqlDbConnection());
$application->getDbConnection()->connect();
$application->getDbConnection()->disconnect();