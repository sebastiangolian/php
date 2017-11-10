<?php

/*
class Zamowienie {     
    public function dodajTowar($towar);
    public function usunTowar($towar);
    public function obliczCene();
    public function pobierzPodsumowanie();
    public function dodajOdbiorce($odbiorca);
    public function dodajRabat($rabat);
    public function wybierzSposobPlatnosci();
    public function wybierzSposobTransportu();
}
*/


class BaseCommand
{
    
}

class BaseEvent
{
    
}

//Agregat bierze na wejściu Command a zwraca Event
class BaseAggregate
{
    public function __construct(BaseCommand $command)
    {
        
    }
}


class Book extends BaseAggregate
{
    
}

class SellBook extends BaseCommand
{
    
}

class BookSelled extends BaseEvent
{
    
}