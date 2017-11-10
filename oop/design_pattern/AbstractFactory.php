<h1>Abstract factory  - Fabryka abstrakcyjna</h1><hr />
<p>
    Fabryka abstrakcyjna jest wzorcem projektowym, którego zadaniem jest określenie interfejsu 
    do tworzenia różnych obiektów należących do tego samego typu (rodziny). Interfejs ten definiuje 
    grupę metod, za pomocą których tworzone są obiekty.
</p>

<?php

//----------------------------------- PRODUKTY -------------------------------
interface Document {
    function generate();
}

class PDF implements Document {
    public function generate()          {return 'Generuje dokument PDF<br />';}
    public function setColor($color)    {echo "Ustawiam kolor: ".$color.'<br />';}
}
 
class HTML implements Document {
    public function generate()          {return 'Generuje dokument HTML<br />';}
    public function setColor($color)    {echo "Ustawiam kolor: ".$color.'<br />';}
}

//----------------------------------- FABRYKI -------------------------------
interface DocumentGenerator {
    function create();
    function setColor($color);
}

class PDFGenerator implements DocumentGenerator {
    private $color;
 
    public function create() {
        $doc = new PDF();
        $doc->setColor($this->color);
        return $doc;
    }
 
    public function setColor($color) {
        $this->color = $color;
    }
}
 
class HTMLGenerator implements DocumentGenerator {
    private $color;
 
    public function create() {
        $doc = new HTML();
        $doc->setColor($this->color);
        return $doc;
    }
 
    public function setColor($color) {
        $this->color = $color;
    }
}
 
class Page {
    private $documentFactory;
 
    public function __construct(DocumentGenerator $factory) {
        $this->documentFactory = $factory;
    }
    public function render() {
        $document = $this->documentFactory->create();
        echo $document->generate();
    }
 
}
 
// testy
$pdf = new PDFGenerator();
$pdf->setColor("#000000");
$html = new HTMLGenerator();
$html->setColor("#ffffff");
$page1 = new Page($pdf);
$page1->render(); // wyswietli "Generuje dokument PDF"
$page2 = new Page($html);
$page2->render(); // wyswietli "Generuje dokument HTML"