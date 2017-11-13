<?php
namespace sebastiangolian\php\base;

use Iterator;

class CollectionIterator implements Iterator {
    
    private $_collection;
    private $_currIndex = 0;
    private $_keys;
    
    public function __construct(Collection $objCol) {
        $this->_collection = $objCol;
        $this->_keys = $this->_collection->keys();
    }
    
    public function rewind() {
        $this->_currIndex = 0;
    }
    
    public function hasMore() {
        return $this->_currIndex < $this->_collection->length();
    }
    
    public function key() {
        return $this->_keys[$this->_currIndex];
    }
    
    public function current() {
        return $this->_collection->getItem($this->_keys[$this->_currIndex]);
    }
    
    public function next() {
        $this->_currIndex++;
    }
    public function valid()
    {
        
    }

}