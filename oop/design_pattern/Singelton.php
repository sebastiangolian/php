<h1>Singelton</h1><hr />
<p>
    Singleton jest jednym z najprostszych wzorców projektowych. Jego celem jest ograniczenie 
    możliwości tworzenia obiektów danej klasy do jednej instancji oraz zapewnienie globalnego 
    dostępu do stworzonego obiektu – jest to obiektowa alternatywa dla zmiennych globalnych.
</p>
<p>
    Singleton implementuje się poprzez stworzenie klasy, która posiada statyczną metodę getInstance(). 
    Metoda ta sprawdza, czy istnieje już instancja tej klasy, jeżeli nie – tworzy ją i przechowuje jej 
    referencję w prywatnym polu. Aby uniemożliwić tworzenie dodatkowych instancji, konstruktor klasy 
    deklaruje się jako prywatny lub chroniony.
</p>
<h3>Zastosowanie</h3>
<p>
    Programując w PHP używa się wzorca Singleton do przechowywania konfiguracji aplikacji oraz utrzymania 
    połączenia z bazą danych. Jednak, warto pamiętać o wadach tego wzorca i korzystać z niego rozważnie. 
    Zbyt częste stosowanie wzorca Singleton pogarsza przejrzystość kodu.
</p>

<?php
class Config {
    private static $instance;
    private $config = array(
        "login"     =>  "mojlogin",
        "password"  =>  "haslo",
        "language"  =>  "pl"
        );
 
    private function __construct() {}
    private function __clone() {}
 
    public static function getInstance() {
        if(self::$instance === null) {
            self::$instance = new Config();
        }
        return self::$instance;
    }
    public function setLanguage($lang) {
        $this->config["language"] = $lang;
    }
    public function getLanguage() {
        return $this->config["language"];
    }
}
 
// testy
$conf1 = Config::getInstance();
echo $conf1->getLanguage(); // wyswietla "pl"
echo '<br />';
$conf2 = Config::getInstance();
$conf2->setLanguage("en");
echo $conf1->getLanguage(); // wyswietla "en"