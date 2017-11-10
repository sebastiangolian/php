<h1>Facade - Wzorzec Fasady</h1><hr />
<p>
    Fasada służy do ujednolicenia dostępu do złożonego systemu poprzez udostępnienie uproszczonego i 
    uporządkowanego interfejsu programistycznego. Fasada zwykle implementowana jest w bardzo prosty sposób – w 
    postaci jednej klasy powiązanej z klasami reprezentującymi system, do którego klient chce uzyskać dostęp. 
</p>
<h3>Zastosowanie</h3>
<p>
    Przykładem użycia wzorca fasady może być zbudowanie API, które zezwoli zewnętrznym serwisom i aplikacjom łączyć się 
    w prosty sposób z naszą aplikacją.
    Innym praktycznym przykładem jest system bankowy. Logując się na internetowe konto mamy dostęp tylko do pojedynczych 
    składowych całego systemu (autoryzacja, przelewy, saldo konta itp).
</p>

<?php
class User{
    public function login() {
        echo "Logowanie do systemu\n";
    }
    public function register() {
        echo "Rejestracja\n";
    }
}
 
class Cart{
    public function getItems() {
        echo "Zawartość koszyka\n";
    }
}
 
class Product{
    public function getAll() {
        echo "Lista produktów\n";
    }
     
    public function get($id) {
        echo "Produkt o ID ".$id."\n";
    }
}
 
class API{
    private $user;
    private $cart;
    private $product;
     
    public function __construct() {
        $this->user = new User();
        $this->cart = new Cart();
        $this->product = new Product();
    }
     
    public function login() {
        $this->user->login();
    }
     
    public function register() {
        $this->user->register();
    }
     
    public function getBuyProducts() {
        $this->cart->getItems();
    }
     
    public function getProducts() {
        $this->product->getAll();
    }
     
    public function getProduct($id) {
        $this->product->get($id);
    }
}
 
// testy
$client = new API();
$client->register();
$client->login();
$client->getProducts();
$client->getProduct(5);
$client->getBuyProducts();