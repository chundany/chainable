[![Build Status](https://travis-ci.org/skybluesofa/chainable.svg?branch=master)](https://travis-ci.org/skybluesofa/chainable) [![Code Climate](https://codeclimate.com/github/skybluesofa/chainable/badges/gpa.svg)](https://codeclimate.com/github/skybluesofa/chainable) [![Test Coverage](https://codeclimate.com/github/skybluesofa/chainable/badges/coverage.svg)](https://codeclimate.com/github/skybluesofa/chainable/coverage) [![Total Downloads](https://img.shields.io/packagist/dt/skybluesofa/chainable.svg?style=flat)](https://packagist.org/packages/skybluesofa/chainable) [![Version](https://img.shields.io/packagist/v/skybluesofa/chainable.svg?style=flat)](https://packagist.org/packages/skybluesofa/chainable) [![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat)](LICENSE)

# Chainable
Allow for chainable, fluent method calls

## Chaining Methods
Check out the [Tests/Sandwich(https://github.com/skybluesofa/chainable/blob/master/tests/Sandwich.php] class. It gives a bunch of uses for the Chainable trait.

Basic use of this trait:
* Set the visibility for the chainable functions to 'private'
* Ensure that you either modify the current class or return a cloned version of the class
* Ensure that you return a reference to the class
```
private function withBread($breadType=null) {
  $this->breadType = $breadType;
  return $this;
}
```

### Calling fluent methods
Now you can call these methods fluently:
```
Sandwich::withBread('white')->
  addCondiment('peanut butter')->
  addCondiment('jelly')->
  make();
```
or the same sandwich, but the methods are called in a different order:
```
Sandwich::addCondiment('peanut butter')->
  withBread('white')->
  addCondiment('jelly')->
  make();
```

### Modifying the output
Any time up until you return something other than a reference to the chained class, you can modify what will be output:
```
Sandwich::withBread('wheat')->
  addCondiment('peanut butter')->
  addCondiment('grape jelly')->
  withBread('white')->
  removeCondiment('grape jelly')->
  addCondiment('strawberry jelly')->
  make();
```

### Missing methods
This will return an exception, as the 'addBananas' method does not exist.
```
Sandwich::withBread('white')->
  addCondiment('peanut butter')->
  addBananas()->
  make();
```

### Public methods
This will return an error, as the 'addVegetable' method is not static:
```
Sandwich::addVegetable('lettuce')->
  withBread('white')->
  make();
```

To work around this, use the 'chainableProxy' method before calling 'addVegetable':
```
Sandwich::chainableProxy()->
  addVegetable('lettuce')->
  withBread('white')->
  make();
```
