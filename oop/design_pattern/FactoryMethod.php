<h1>Factory method - Wzorzec metody wytwórczej</h1><hr />
<p>
    Wzorzec metody wytwórczej dostarcza abstrakcji do tworzenia obiektów nieokreślonych, ale powiązanych typów. 
    Umożliwia także dziedziczącym klasom decydowanie jakiego typu ma to być obiekt.
</p>
<p>
    Wzorzec składa się z dwóch ról: produktu Product definiującego typ zasobów oraz kreatora Creator definiującego 
    sposób ich tworzenia. Wszystkie typy produktów (ConreteProduct1, ConreteProduct2 itp.) muszą implementować interfejs Product. 
    Z kolei ConcreteCrator dostarcza mechanizm umożliwiający stworzenie obiektu produktu danego typu
</p>
<h3>Zastosowanie</h3>
<p>
    Wzorzec metody wytwórczej można wykorzystać między innymi przy tworzeniu systemów zamówień, 
    gdzie oferta może się zmieniać, ale składa z jednakowego typu produktów.

    Innym zastosowaniem może być system pluginów. Dzięki zastosowaniu metody wytwórczej możemy łatwo 
    rozbudowywać nasz skrypt o kolejne funkcjonalności (np. o obsługę kolejnych formatów plików).
</p>

<?php
// Produkty
interface Pizza{
    public function getName();
}
class HawaiianPizza implements Pizza{
    public function getName() {
        return "Hawalian pizza";
    }
}
class DeluxePizza implements Pizza{
    public function getName() {
        return "Deluxe pizza";
    }
}
 
// Kreator tworzacy obiekt produktu
interface Creator{
    public function create($type);
}
class ConcreteCreator implements Creator{
    public function create($type) {
        switch($type) {
            case 'Hawalian':
                return new HawaiianPizza();
                break;
            case 'Deluxe':
                return new DeluxePizza();
                break;
        }
    }
}
 
// testy
$creator = new ConcreteCreator();
$prod1 = $creator->create("Hawalian");
$prod2 = $creator->create("Deluxe");
echo $prod1->getName(); // wyswietli "Hawalian pizza"
echo $prod2->getName(); // wyswietli "Deluxe pizza"