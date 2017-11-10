<h1>Proxy - Wzorzec pośrednik</h1><hr />
<p>
    Pełnomocnik jest wzorcem projektowym, którego celem jest utworzenie obiektu zastępującego inny obiekt. 
    Stosowany jest on w celu kontrolowanego tworzenia na żądanie kosztownych obiektów oraz kontroli dostępu do nich.  
</p>
<h3>Zastosowanie</h3>
<p>
    Wzorzec Proxy możemy wykorzystać w sytuacji, gdy koszt utworzenia obiektu jest wysoki, 
    a wykorzystanie danego obiektu uzależnione jest od spełnienia pewnych warunków.
</p>

<?php
interface HighResolutionImage{
    function display();
}
class Image implements HighResolutionImage{
    private $options;
    public function __construct($options) {
        $this->options=$options; 
        // generate image
    }
    public function display() {
        echo 'display image';
    }
}
class ProxyImage implements HighResolutionImage{
    private $options;
    private $passwrd;
    private $image = null;
    public function __construct($options, $password) {
        $this->options=$options; 
        $this->passwrd=$password;
    }
    public function display() {
        if($this->passwrd=='tajne') {
        if($this->image==null) {
            $this->image=new Image($this->options);
        }
        $this->image->display();
        } else {
            echo 'Access denied';
        }
    }
}
 
$image = new ProxyImage(array('width' => 3800, 'height' => 2000), 'tajne');
$image2 = new ProxyImage(array('width' => 3800, 'height' => 2000), 'tajne2');
$image->display(); // wyswietli "display image"
$image2->display(); // wyswietli "Access denied"