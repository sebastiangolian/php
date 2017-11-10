<h1>Bulider - Wzorzec budowniczego</h1><hr />
<p>
    Budowniczy jest wzorcem, gdzie proces tworzenia obiektu podzielony jest na kilka mniejszych etapów, 
    a każdy z nich może być implementowany na wiele sposobów. Dzięki takiemu rozwiązaniu możliwe jest tworzenie 
    różnych reprezentacji obiektów w tym samym procesie konstrukcyjnym.
</p>
<p>
    Standardowo wzorzec składa się z dwóch podstawowych elementów. Pierwszy z nich oznaczony jest jako 
    Builder – jego celem jest dostarczenie interfejsu do tworzenia obiektów nazywanych produktami (product). 
    Drugim elementem jest obiekt oznaczony jako ConcreteBuilder, a jego celem jest tworzenie konkretnych 
    reprezentacji produktów przy pomocy zaimplementowanego interfejsu Builder. W ConcreteBuilder zawarte 
    są procedury odpowiedzialne za konstrukcje i inicjalizację obiektu. Strukturę wzorca uzupełnia obiekt 
    Director (zwany także czasem kierownikiem, nadzorcą – tak jak na budowie ;)), który zleca konstrukcję 
    produktów poprzez obiekt Builder dbając o to, aby proces budowy przebiegał w odpowiedniej kolejności.
</p>
<h3>Zastosowanie</h3>
<p>
    Wzorzec budowniczego stosowany jest do oddzielenia sposobu tworzenia obiektów od tego jak te obiekty mają wyglądać. 
    Przykładem jest oprogramowanie konwertujące tekst z jednego formatu na drugi. Algorytm odczytujący i interpretujący 
    dane wejściowe jest oddzielony od algorytmu tworzącego dane wyjściowe. Dzięki takiemu rozwiązaniu możliwe jest 
    zastosowanie jednego obiektu odczytującego dane wejściowe oraz wielu obiektów konwertujących odczytane dane do różnych 
    formatów (ASCII, HTML, RTF, itp.), co zwiększa skalowalność rozwiązania.

    Innym zastosowaniem może być stworzenie narzędzia, które będzie miało różną implementację zależnie od użytej 
    technologii – tak jak w omawianym przykładzie odtwarzacz wideo.
</p>

<?php
class Player {
    private $playerName;
 
    public function setplayerName($playerName) {
        $this->playerName = $playerName;
    }
    public function render() {
        return $this->playerName;
    }
}
 
interface Builder {
    public function buildPlayer();
    public function getPlayer();
}
 
class FlashBuilder implements Builder {
    private $player;
 
    public function __construct() {
        $this->player = new Player();
    }
    public function buildPlayer() {
        $this->player->setplayerName("Player w Flash");
    }
    public function getPlayer() {
        return $this->player;
    }
}
 
class HTMLBuilder implements Builder {
    private $player;
 
    public function __construct() {
        $this->player = new Player();
    }
    public function buildPlayer() {
        $this->player->setplayerName("Player w HTML5");
    }
    public function getPlayer() {
        return $this->player;
    }
}
 
class Director{
    private $builder;
 
    public function __construct(Builder $builder) {
        $this->builder = $builder;
    }
    public function construct() {
        $this->builder->buildPlayer();
    }
    public function getResult() {
        return $this->builder->getPlayer();
    }
}
 
// testy
$flash = new FlashBuilder();
$director = new Director($flash);
$director->construct();
$player = $director->getResult();
echo $player->render(); // wyswietli "player w flash"
 
$html = new HTMLBuilder();
$director2 = new Director($html);
$director2->construct();
$player2 = $director2->getResult();
echo $player2->render(); // wyswietli "player w HTML5"