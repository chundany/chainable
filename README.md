[![Build Status](https://travis-ci.org/skybluesofa/chainable.svg?branch=master)](https://travis-ci.org/skybluesofa/chainable) [![Code Climate](https://codeclimate.com/github/skybluesofa/chainable/badges/gpa.svg)](https://codeclimate.com/github/skybluesofa/chainable) [![Test Coverage](https://codeclimate.com/github/skybluesofa/chainable/badges/coverage.svg)](https://codeclimate.com/github/skybluesofa/chainable/coverage) [![Total Downloads](https://img.shields.io/packagist/dt/skybluesofa/chainable.svg?style=flat)](https://packagist.org/packages/skybluesofa/chainable) [![Version](https://img.shields.io/packagist/v/skybluesofa/chainable.svg?style=flat)](https://packagist.org/packages/skybluesofa/chainable) [![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat)](LICENSE)

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
