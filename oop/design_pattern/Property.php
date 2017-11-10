<h1>Property - Wzorzec właściwości</h1><hr />
<p>
    Property to wzorzec projektowy, którego zadanie, jest przechowywać i udostępniać dane w obrębie aplikacji. 
    Implementacja wzorca zastępuje globalne zmienne jakże nielubiane w dobie programowania obiektowego. 
    Brzmi znajomo? Wzorzec ten ma zbliżone zastosowania do Singletona. Jednak tu nie tworzymy obiektu – wszystkie metody są statyczne.
</p>
<p>
    Wszystkie dane trzymamy w tablicy array. Za pomocą metod set() i get() możemy ustawiać/pobierać dane. 
    Poza tym możemy zaimplementować inne metody kontrolujące np. dostęp do zmiennych.
</p>
<h3>Zastosowanie</h3>
<p>
    Property można wykorzystać do przechowywania konfiguracji aplikacji.
</p>

<?php
class Config{
    private static $conf = array();
 
    public static function set($name, $value) {
        self::$conf[$name]=$value;
    }
    public static function get($name) {
        return self::$conf[$name];
    }
    public static function exist($name) {
        return isset(self::$conf[$name]);
    }
}
 
//testy
Config::set("language", "pl");
Config::set("path", "jakas_sciezka");
echo Config::get("language"); // wyswietli "pl"
echo Config::get("path"); // wyswietli "/jakas_sciezka/"
echo Config::exist("language"); // wyswietli "true"