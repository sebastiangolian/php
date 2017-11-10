<h1>Klasa abstrakcyjna</h1><hr />

<?php
abstract class BaseProduct {
    protected $name;
    protected $price;
 
    public function __construct($name, $price){
        $this->name = $name;
        $this->price = $price;
    }
    
    abstract function getName();
}

class Bike extends BaseProduct{
    public function getName() {
        return 'Rower - '.$this->name;
    }
}

class Motorcycle extends BaseProduct{
    public function getName() {
        return 'Motor - '.$this->name;
    }
}

class Order {
    private $products = [];
    
    public function setProducts($products)
    {
        $this->products = $products;
    }
    
    public function getDescription()
    {
        foreach ($this->products as $product) {
            echo $product->getName().'<br />';
        }
    }
}
$products = [];
array_push($products, new Motorcycle('V2000',5000));
array_push($products, new Bike('Vello 20',1000));

$order = new Order();
$order->setProducts($products);
echo $order->getDescription();


