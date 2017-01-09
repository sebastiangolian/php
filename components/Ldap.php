<?php
namespace sebastiangolian\php\components;
use sebastiangolian\php\base\Component;

class Ldap extends Component
{
    public $host = 'ldap://net.pp';
    public $port = 636;
    public $dn = 'DC=net,DC=pp';
    private $_conn;
    
    public function __construct($config = []) 
    {
        parent::__construct($config);
        
        $this->_conn = ldap_connect($this->host, $this->port) or die("Nie udało się nawiązać połączenia LDAP.");
        ldap_set_option($this->_conn, LDAP_OPT_PROTOCOL_VERSION, 3);   //użycie wersji protokołu LDAP v3
        ldap_set_option($this->_conn, LDAP_OPT_REFERRALS, 0);
    }
   
    /**
     * Zwraca ostatni błąd komendy połączenia LDAP
     * @return string
     */
    public function getError()
    {
        return ldap_error($this->_conn);
    }
    
    /**
     * Tworzy powiązanie z katalogiem LDAP, dzięki czemu możemy go przeszukiwać
     * @param string $bind_rdn
     * @param string $bind_password
     * @return bool
     * 
     * $ldap->bind('cn=read-only-admin,dc=example,dc=com','password');
     */
    public function bind($bind_rdn,$bind_password)
    {
        return ldap_bind($this->_conn,$bind_rdn,$bind_password);
    }
    
    /**
     * Wyszukiwanie w AD za pomocą LDAP
     * @param string $bind_rdn
     * @param string $bind_password
     * @param string $filter
     * @return array
     * 
     * $ldap->search('cn=read-only-admin,dc=example,dc=com','password','(uid=riemann)')
     */
    public function search($bind_rdn,$bind_password,$filter)
    {        
        if($bind = ldap_bind($this->_conn,$bind_rdn,$bind_password)) 
        {
            $result = ldap_search($this->_conn,$this->dn,$filter);
            $entries = ldap_get_entries($this->_conn, $result);
            return $entries;
        }        
    }
    
    /**
     * Zamknięcie połaczenia LDAP
     */
    public function close()
    {
        ldap_close($this->_conn);
    }
    
    /**
     * Logowanie przez AD
     * @param string $login
     * @param string $password
     * @return boolean
     */
    public function login($login,$password)
    {
        if(@ldap_bind($this->_conn, $login, $password))
            return true;
        else
            return false;
    }
    
    /**
     * Sprawdzenie czy istnieje login w AD [konieczne login i hasło admina AD
     * @param string $admin_login
     * @param string $admin_pass
     * @param string $login
     * @return boolean
     */
    public function existLogin($admin_login,$admin_pass,$login)
    {
        ldap_bind($this->_conn,$admin_login,$admin_pass);
        $result = ldap_search($this->conn, $this->dn,'(&(cn='.$login.'))') or die ('Błąd: ' . ldap_error($this->_conn));
        return ldap_get_entries($this->_conn, $result);
    }
}
