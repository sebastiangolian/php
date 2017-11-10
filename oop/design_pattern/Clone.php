<h1>Prototype - Wzorzec prototypu</h1><hr />
<p>
    Prototyp jest wzorcem, opisującym mechanizm tworzenia nowych obiektów poprzez klonowanie jednego 
    obiektu macierzystego. Mechanizm klonowania wykorzystywany jest wówczas, gdy należy wykreować dużą 
    obiektów tego samego typu lub istnieje potrzeba tworzenia zbioru obiektów o bardzo podobnych właściwościach.
</p>
<p>
    Implementując ten wzorzec deklaruje się klasę Prototype z abstrakcyjną operacją klonującą clone(). 
    Operacja ta jest implementowana w klasach dziedziczonych po Prototype. Klient chcąc stworzyć nowy obiekt 
    wywołuje metodę clone() pośrednio, za pomocą zdefiniowanej przez siebie operacji z parametrem określającym 
    wymaganą docelową klasę realizującą abstrakcję Prototype.
</p>
<h3>Zastosowanie</h3>
<p>
    Wzorzec Prototype można stosować w sytuacjach, gdy tworzona jest duża liczba obiektów tego samego typu. 
    Stosuje się go głównie w celach optymalizacji, gdyż klonowanie obiektu jest szybsze niż jego stworzenie.
</p>

<?php
abstract class Book{
    protected $name;
 
    public function __construct($name) {
        $this->name=$name;
    }
    abstract function __clone();
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
}
 
class PHPBook extends Book{
 
    public function __construct($name) {
        parent::__construct($name);
    }
    public function __clone() {}
}
 
$book1 = new PHPBook("PHPBook");
echo  $book1->getName(); // wyswietli "PHPBook"
$book2 = clone $book1;
$book2->setName('JAVABook');
echo '<br />';
echo $book2->getName(); // wyswietli "JavaBook"