<h1>Adapter - Wzorzec adaptera</h1><hr />
<p>
    Wzorzec adapter (znany także pod nazwą wrapper) służy do przystosowania interfejsów obiektowych, tak aby możliwa była 
    współpraca obiektów o niezgodnych interfejsach. Szczególnie przydaje się przypadku wykorzystania gotowych bibliotek o 
    interfejsach niezgodnych ze stosowanymi w aplikacji. W świecie rzeczywistym adapter to przejściówka, np. przejściówka 
    do wtyczki gniazdka angielskiego na polskie.
</p>
<p>
    Struktura wzorca składa się z elementów takich jak: Target, Adaptee, Adapter oraz Client. Target jest abstrakcją 
    (zazwyczaj interfejsem), jakiej oczekuje klient. Elementem dostarczającym żądanej przez klienta funkcjonalności jest 
    Adaptee (np. zewnętrzną biblioteką). Rolą adaptera, który implementuje interfejs Target, jest „przetłumaczenie” wywołania 
    metod należących do interfejsu Target poprzez wykonanie innych, specyficznych metod z klasy Adaptee.
</p>
<h3>Zastosowanie</h3>
<p>
    Wzorzec adaptera stosowany jest najczęściej w przypadku, gdy wykorzystanie istniejącej klasy jest niemożliwe ze względu 
    na jej niekompatybilny interfejs. Drugim powodem użycia może być chęć stworzenia klasy, która będzie współpracowała z 
    klasami o nieokreślonych interfejsach.
</p>

<?php
interface OldXML 
{
    public function writeXml();
}

class NewXML 
{
    public function xml() 
    {
        echo "Kod XML";
    }
}
class XML implements OldXML 
{
    public function writeXml() 
    {
        $adaptee = new NewXML();
        $adaptee->xml();
    }
}
 
//test
$client = new XML();
$client->writeXml(); // wyswietli "Kod XML"