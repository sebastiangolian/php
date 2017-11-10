<h1>Observer - Wzorzec obserwatora</h1><hr />
<p>
    Głównym obszarem wykorzystania wzorca Obserwator jest stworzenie relacji typu jeden-do-wielu łączącej 
    grupę obiektów. Dzięki zastosowaniu wzorca zmiana stanu (czyli zmiana aktualnych wartości pól) obiektu 
    obserwowanego umożliwi automatyczne powiadomienie o niej wszystkich innych dołączanych elementów (obserwatorów). 
</p>
<h3>Zastosowanie</h3>
<p>
    Wzorzec Obserwatora sprawdza się wszędzie tam, gdzie stan jednego obiektu uzależniony jest od stanu drugiego obiektu.
</p>

<?php
class CacheObserver implements SplObserver {
    public function update(SplSubject $subject) {
        echo "Odswieza cache<br />";
    }
}
 
class RSSObserver implements SplObserver {
    public function update(SplSubject $subject) {
        echo "Odswieza RSS<br />";
    }
}
 
class NewsletterObserver implements SplObserver {
    public function update(SplSubject $subject) {
        echo "Wysylam maile z nowym newsem<br />";
    }
}
 
class News implements SplSubject {
    private $observers = array();
 
    public function attach(SplObserver $observer) {
        $this->observers[spl_object_hash($observer)] = $observer;
    }
 
    public function detach(SplObserver $observer) {
        unset($this->observers[spl_object_hash($observer)]);
    }
 
    public function notify() {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
 
    public function add($data) {
        echo "Dodaje news do bazy<br />";
        $this->notify();
    }
 
}
 
$news = new News();
 
$news->attach(new RSSObserver());
$news->attach(new CacheObserver());
$news->attach(new NewsletterObserver());
 
$news->add(array(
    'title' => 'Tytuł',
    'content' => 'blablabla'
));