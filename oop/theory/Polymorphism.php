<h1>Polimorfizmy - Interfejsy, klasy abstrakcyjne</h1><hr />
<p> 
    Wykorzystanie interfejsów i klas abstrakcyjnych w celu uogólnienia i 
    wymusznia posiadania określonych metod przez klasę implementującą interfejs, 
    lub klasę abstrakcyjną.
<p>
<?php
//---------------------- SIMPLE --------------------------------------------
interface Shape
{
    public function draw();
}

class Rectangle implements Shape
{
    public function draw()
    {
        echo 'Rysuje prostokąt';
    }
}

class Circle implements Shape
{
    public function draw()
    {
        echo 'Rysuje koło';
    }
}

//---------------------- ADVANCED --------------------------------------------
//---------------------- INTERFACES --------------------------------------------
interface BillInterface
{
    public function addService (ServiceInterface $service);
    
    public function getSummaryCost();
    public function getSummaryTime();
    public function printingSummary();
}

interface ServiceInterface
{
    public function getCost();
    public function getTime();
}

//---------------------- CLASSES --------------------------------------------
class BreakService implements ServiceInterface
{
    public function getCost() {
        return 200;
    }
    
    public function getTime() {
        return 60;
    }
}

class EngineService implements ServiceInterface
{
    public function getCost() {
        return 1000;
    }
    
    public function getTime() {
        return 300;
    }
}

class Bill implements BillInterface
{
    private $services = array();
    public function addService (ServiceInterface $service)
    {
        array_push($this->services, $service);
    }
    
    public function getSummaryCost()
    {
        $cost = 0;
        foreach ($this->services as $service) {
            $cost += $service->getCost();
        }
        return $cost;
    }
    
    public function getSummaryTime()
    {
        $time = 0;
        foreach ($this->services as $service) {
            $time += $service->getTime();
        }
        return $time;
    }
    
    public function printingSummary()
    {
        return 'Total cost: '.$this->getSummaryCost().', total time: '.$this->getSummaryTime();
    }
}

//---------------------------- USES --------------------------------------------

$bill = new Bill();
$bill->addService(new BreakService());
$bill->addService(new EngineService());

echo $bill->printingSummary();