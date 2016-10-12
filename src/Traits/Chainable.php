<?php
namespace Skybluesofa\Chainable\Traits;

trait Chainable
{
    public function __call($method, $parameters) {
        $this->checkMethodCallable($this, $method);
        return call_user_func_array([$this, $method], $parameters);
    }

    public static function __callStatic($method, $parameters) {
        $instance = new static;
        $instance->checkMethodCallable($instance, $method);
        return call_user_func_array([$instance, $method], $parameters);
    }

    public static function chainableProxy() {
      return new static;
    }

    /**
     * @param mixed $object
     * @param string $method
     * @return bool
     * @throws \Exception
     */
    private function checkMethodCallable($object, $method) {
        if (!is_object($object)) {
            throw new \Exception('Chainable subject is not an object.');
        }

        $class = get_class($object);

        if (!is_string($method)) {
            $type = gettype($method);
            throw new \Exception("Chainable method name must be a string. {$type} was provided for object {$class}.");
        }
        if (!method_exists($object, $method)) {
            throw new \Exception("Chainable method does not exist on object {$class}.");
        }
    }
}
