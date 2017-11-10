<h1>Interface - Interfejsy</h1><hr />

<?php
//------------- proste użycie interfejsu -------------------
interface ModelInterface 
{
    //wymuszenie istnienia metody w klasach implementujących
    public function tableName();
}

class UserModel implements ModelInterface
{
    public function tableName() {
        return 'user';
    }
}

$model = new UserModel();
echo $model->tableName();       //return 'user'


//------------- przykład zagnieżdzania interfejsów -------------------
interface IInfo {

    public function do_inform();
}

interface IVersion {

    public function get_version();
}

interface ILog extends IInfo, IVersion {

    public function do_log();
}

class DBConnect implements ILog {

    public function do_inform() {
        echo "To jest klasa DBConnect.<br />";
    }

    public function get_version() {
        echo "Wersja 1.02.<br />";
    }

    public function do_log() {
        echo "Logowanie.<br />";
    }

    public function connect() {
        echo "Łączenie z bazą danych.<br />";
    }
}

echo "<hr />";
$db = new DBConnect();
$db->do_inform();
$db->get_version();
$db->do_log();
$db->connect();
