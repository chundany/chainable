<?php
use Skybluesofa\Chainable\Tests\SomeChainableClass;

class ChainableTest extends PHPUnit_Framework_TestCase {
	function test_static_implementation() {
		$chainableExpectation = ['abc'=>null,'mno'=>null,'xyz'=>null];
		$chainableResults = SomeChainableClass::run();
		$this->assertEquals($chainableExpectation, $chainableResults);
	}
	function test_chained_implementation() {
		$chainableExpectation = ['abc'=>'123','mno'=>null,'xyz'=>null];
		$chainableResults = SomeChainableClass::setAbc('123')->run();
		$this->assertEquals($chainableExpectation, $chainableResults);
	}
	function test_multichained_implementation() {
		$chainableExpectation = ['abc'=>'123','mno'=>'456','xyz'=>null];
		$chainableResults = SomeChainableClass::setAbc('123')->setMno('456')->run();
		$this->assertEquals($chainableExpectation, $chainableResults);
	}
	/**
     * @expectedException Exception
	 * @expectedExceptionMessage Chainable method does not exist on object
     */
	 function test_missing_method() {
		$chainableResults = SomeChainableClass::setXyz('890')->run();
	}
}
?>
