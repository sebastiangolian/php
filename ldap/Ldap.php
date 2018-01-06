<?php
namespace sebastiangolian\php\ldap;

use sebastiangolian\php\base\Component;



/**
 * @license GNU GENERAL PUBLIC LICENSE
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 * 
 * PHP Component allows the use of LDAP library
 * 
 * $ldap = new Ldap('ldap://hostname',636,'DC=dc,DC=en');
 * $ldap->login('login', 'password')
 */
class Ldap extends Component
{
    /**
     * Hostname. ldaps://hostname/, ldap://hostname/.
     * @var string 
     */
    public $host;
    
    /**
     * Port number. 389 - LDAP, 636 - LDAPS
     * @var int
     */
    public $port = 636;
    
    /**
     * The base DN for the directory.
     * @var string 
     */
    public $dn;
    
    /**
     * Ldap connection handler
     * @var string 
     */
    private $conn;
    
    /**
     * Ldap component constructor
     * @param string $host
     * @param int $port
     * @param string $dn
     * @param array $config
     */
    public function __construct($host, $port, $dn, $config = []) 
    {
        $this->host = $host;
        $this->port = $port;
        $this->dn = $dn;
        parent::__construct($config);
        
        $this->conn = ldap_connect($this->host, $this->port) or die("Nie udało się nawiązać połączenia LDAP.");
        ldap_set_option($this->conn, LDAP_OPT_PROTOCOL_VERSION, 3);   //użycie wersji protokołu LDAP v3
        ldap_set_option($this->conn, LDAP_OPT_REFERRALS, 0);
    }
   
    /**
     * Return the LDAP error message of the last LDAP command
     * @return string
     */
    public function getError()
    {
        return ldap_error($this->conn);
    }
    
    /**
     * Bind to LDAP directory
     * $ldap->bind('cn=read-only-admin,dc=example,dc=com','password');
     * @param string $bindRdn
     * @param string $bindPassword
     * @return bool
     */
    public function bind($bindRdn,$bindPassword)
    {
        return ldap_bind($this->conn,$bindRdn,$bindPassword);
    }
    
    /**
     * Search to LDAP directory
     * $ldap->search('cn=read-only-admin,dc=example,dc=com','password','(uid=riemann)')
     * @param string $bindRdn
     * @param string $bindPassword
     * @param string $filter
     * @return array
     */
    public function search($bindRdn,$bindPassword,$filter)
    {        
        if(ldap_bind($this->conn,$bindRdn,$bindPassword)) 
        {
            $result = ldap_search($this->conn,$this->dn,$filter);
            $entries = ldap_get_entries($this->conn, $result);
            return $entries;
        }  
        return [];
    }
    
    /**
     * Close LDAP connection
     */
    public function close()
    {
        ldap_close($this->conn);
    }
    
    /**
     * Ldap logging
     * @param string $login
     * @param string $password
     * @return boolean
     */
    public function login($login,$password)
    {
        if(@ldap_bind($this->conn, $login, $password))
            return true;
        else
            return false;
    }
    
    /**
     * Check exist login 
     * @param string $adminLogin
     * @param string $adminPass
     * @param string $login
     * @return boolean
     */
    public function existLogin($adminLogin,$adminPass,$login)
    {
        ldap_bind($this->conn,$adminLogin,$adminPass);
        $result = ldap_search($this->conn, $this->dn,'(&(cn='.$login.'))') or die ('Błąd: ' . ldap_error($this->conn));
        return ldap_get_entries($this->conn, $result);
    }
}
