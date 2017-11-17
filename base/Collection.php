<?php

namespace sebastiangolian\php\base;

use Exception;
use IteratorAggregate;


abstract class Collection implements IteratorAggregate
{
    private $elements = array(); 
    private $onload;               
    private $isLoaded = false;     
    
    public function addItem($obj, $key = null) {
        $this->_checkCallback();     
        
        if($key) {
            if(isset($this->elements[$key])) {
                throw new Exception("Klucz \"$key\" jest już zajęty!");
            } else {
                $this->elements[$key] = $obj;
            }
        } else {
            $this->elements[] = $obj;
        }
    }
    
    public function removeItem($key) {
        $this->_checkCallback();
        
        if(isset($this->elements[$key])) {
            unset($this->elements[$key]);
        } else {
            throw new Exception("Błędny klucz \"$key\"!");
        }
    }
    
    public function getItem($key) {
        $this->_checkCallback();
        
        if(isset($this->elements[$key])) {
            return $this->elements[$key];
        } else {
            throw new Exception("Błędny klucz \"$key\"!");
        }
    }
    
    public function keys() {
        $this->_checkCallback();
        return array_keys($this->elements);
    }
    
    public function length() {
        $this->_checkCallback();
        return sizeof($this->elements);
    }
    
    public function exists($key) {
        $this->_checkCallback();
        return (isset($this->elements[$key]));
    }
   
    public function getIterator()
    {
        $this->_checkCallback();
        return new CollectionIterator($this);
    }
    
    public function setLoadCallback($functionName, $objOrClass = null) {
        if($objOrClass) {
            $callback = array($objOrClass, $functionName);
        } else {
            $callback = $functionName;
        }
        
        if(!is_callable($callback, false, $callableName)) {
            throw new Exception("Funkcja zwrotna $callableName nieprawidłowa!");
            return false;
        }
        $this->onload = $callback;
    }

    private function _checkCallback() {
        if(isset($this->onload) && !$this->isLoaded) {
            $this->isLoaded = true;
            call_user_func($this->onload, $this);
        }
    }
}