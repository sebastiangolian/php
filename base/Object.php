<?php
namespace sebastiangolian\php\base;

use Exception;
abstract class Object
{
    /**
     * Constructor
     * @param array $config
     */
    public function __construct($attributes = [])
    {
        if (!empty($attributes)) {
            foreach ($attributes as $name => $value) {
                $this->__set($name, $value);
            }
        }
    }
    
    /**
     * Return class name
     * @return string
     */
    public static function className()
    {
        return get_called_class();
    }
    
    /**
     * Return values properties class
     * @return string
     */
    public function toString()
    {
        echo '<pre>';
        var_export(get_object_vars($this));
        echo '</pre>';
    }
    
    /**
     * Returns the value of an object property.
     * @param mixed $name
     * @return mixed
     * @throws Exception
     */
    public function __get($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)){
            return $this->$getter();
        } 
        elseif (property_exists($this,$name)){
            return $this->$name;
        } 
        else {
            throw new Exception("Getting unknown property:{$this->className()}::{$name}");
        }
    }
    
    /**
     * Sets value of an object property.
     * @param string $name
     * @param mixed $value
     * @throws Exception
     */
    public function __set($name, $value)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        } 
        elseif (property_exists($this, $name)) {
            $this->$name = $value;
        } 
        else {
            throw new Exception('Setting unknown property: ' . get_class($this) . '::' . $name);
        }
    }
    
    public function __isset($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter() !== null;
        } else {
            return false;
        }
    }
    
    public function __unset($name)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            $this->$setter(null);
        } elseif (method_exists($this, 'get' . $name)) {
            throw new Exception('Unsetting read-only property: ' . get_class($this) . '::' . $name);
        }
    }
    
    public function __call($name, $params)
    {
        throw new Exception('Calling unknown method: ' . get_class($this) . "::$name()");
    }
}

