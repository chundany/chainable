<?php
namespace Skybluesofa\Chainable\Traits;

trait Chainable
{
    public function __call($method, $parameters) {
        if ($this->methodCallable($this, $method)) {
            return call_user_func_array([$this, $method], $parameters);
        }
    }

    public static function __callStatic($method, $parameters) {
        $instance = new static;
        if ($instance->methodCallable($instance, $method)) {
            return call_user_func_array([$instance, $method], $parameters);
        }
    }

    private function methodCallable($object=null, $method=null) {
        if (is_null($object)) {
            throw new \Exception('Chainable subject has not been provided.');
        }
        if (!is_object($object)) {
            throw new \Exception('Chainable subject is not an object.');
        }

        $class = get_class($object);

        if (is_null($method)) {
            throw new \Exception("Chainable method not provided for object {$class}.");
        }
        if (!method_exists($object, $method)) {
            throw new \Exception("Chainable method does not exist on object {$class}.");
        }

        return true;
    }
}
