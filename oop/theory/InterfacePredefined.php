<h1>Interfejsy predefiniowane PHP</h1>
<h2>ArrayAccess, Traversable, Iterator, IteratorAggregate, Throwable, Serializable, Closure, Generator</h2><hr />

<?php
class ArrayAccessTest implements ArrayAccess {
    private $container = array();

    public function __construct() {
        $this->container = array(
            "one"   => 1,
            "two"   => 2,
            "three" => 3,
        );
    }

    public function offsetSet($offset, $value) {
        echo '-- Run function offsetSet() --<br />';
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        echo '-- Run function offsetExists() --<br />';
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset) {
        echo '-- Run function offsetUnset() --<br />';
        unset($this->container[$offset]);
    }

    public function offsetGet($offset) {
        echo '-- Run function offsetGet() --<br />';
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
}

echo '<h3>Testowe wykorzystanie interfejsu ArrayAccess, który pozwala na nadpisywanie podstawowych metod tablicy - set,get,isset,unset</h3>';

$objectAAT = new ArrayAccessTest();
$objectAAT['test'] = 'test123';
if(isset($objectAAT['test'])){
    echo $objectAAT['test'].'<br />';
}
unset($objectAAT['test']);

