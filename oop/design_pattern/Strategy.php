<h1>Strategy - Wzorzec Strategii</h1><hr />
<p>
    Strategia jest wzorcem projektowym, który definiuje rodzinę wymiennych algorytmów i kapsułkuje je w 
    postaci klas. Dzięki temu umożliwia wymienne stosowanie każdego z nich w trakcie działania programu.
</p>
<h3>Zastosowanie</h3>
<p>
    Wszędzie tam, gdzie istnieje potrzeba rozwiązania danego problemu na kilka różnych sposobów.
</p>

<?php
interface Tax{
    public function count($net);
}
 
class TaxPL implements Tax{
    public function count($net) {
        return 0.23*$net;
    }
}
 
class TaxEN implements Tax{
    public function count($net) {
        return 0.15*$net;
    }
}
 
class TaxDE implements Tax{
    public function count($net) {
        return 0.3*$net;
    }
}
 
class Context{
    private $tax;
 
    /**
     * @return mixed
     */
    public function getTax()
    {
        return $this->tax;
    }
 
    /**
     * @param mixed $tax
     */
    public function setTax(Tax $tax)
    {
        $this->tax = $tax;
    }
 
}
 
// testy
$tax = new Context();
$tax->setTax(new TaxPL());
echo $tax->getTax()->count(100); // wyswietla "23"
$tax->setTax(new TaxEN());
echo $tax->getTax()->count(100); // wyswietla "15"
$tax->setTax(new TaxDE());
echo $tax->getTax()->count(100); // wyswietla "30"