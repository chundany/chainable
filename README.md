# Chainable
Allow for chainable, fluent method calls

## Chaining Methods
Using this class:
```
<?php
use Skybluesofa\Chainable\Traits\Chainable;

class SomeChainableClass {
    use Chainable;

    private $abc;
    private $mno;
    private $xyz;

    private function setAbc($abc=null) {
        $this->abc = $abc;
        return $this;
    }

    private function setMno($mno=null) {
        $this->mno = $mno;
        return $this;
    }

    private function run() {
        return [
            'abc' => $this->abc,
            'mno' => $this->mno,
            'xyz' => $this->xyz,
        ];
    }
}
```

Now you can call these methods fluently:
```
SomeChainableClass::run();

SomeChainableClass::setAbc('123')->run();

SomeChainableClass::setAbc('123')->setMno('456')->run();
```

This will return an exception, as the 'setXyz' method does not exist.
```
SomeChainableClass::setXyz('123')->run();
```
