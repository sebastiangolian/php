<?php
namespace sebastiangolian\php\base;

use Iterator;

class CollectionIterator implements Iterator {
    
    private $collection;
    private $position = 0;
    private $keys;
    
    public function __construct(Collection $objCol) {
        $this->collection = $objCol;
        $this->keys = $this->collection->keys();
    }
    
    public function rewind() {
        $this->position = 0;
    }
    
    public function hasMore() {
        return $this->position < $this->collection->length();
    }
    
    public function key() {
        return $this->keys[$this->position];
    }
    
    public function current() {
        return $this->collection->getItem($this->keys[$this->position]);
    }
    
    public function next() {
        ++$this->position;
    }
    
    public function valid()
    {
        return isset($this->keys[$this->position]);
    }

}