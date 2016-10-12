<?php
use Skybluesofa\Chainable\Tests\Sandwich;

class ChainableTest extends PHPUnit_Framework_TestCase {
	/**
     * @expectedException Exception
	 * @expectedExceptionMessage That's not a sandwich
     */
	public function test_without_setting_required_parameter() {
		$sandwich = Sandwich::make();
	}
	/**
     * @expectedException Exception
	 * @expectedExceptionMessage Chainable method does not exist on object
     */
	public function test_missing_method() {
		$sandwich = Sandwich::addBananas()->run();
	}

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage Chainable subject is not an object
	 */
	public function test_method_called_on_non_object_throws_exception(){
		$sandwich = new Sandwich();
		$reflection = new ReflectionObject($sandwich);
		$method = $reflection->getMethod('checkMethodCallable');
		$method->setAccessible(true);
		$method->invokeArgs($sandwich, [1, 'method']);
	}

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage Chainable method name must be a string. integer was provided for object Skybluesofa\Chainable\Tests\Sandwich.
	 */
	public function test_method_called_with_non_string_method_name_throws_exception(){
		$sandwich = new Sandwich();
		$reflection = new ReflectionObject($sandwich);
		$method = $reflection->getMethod('checkMethodCallable');
		$method->setAccessible(true);
		$method->invokeArgs($sandwich, [$sandwich, 5]);
	}

	public function test_peanut_butter_and_jelly() {
		$sandwich = Sandwich::withBread('white')->addCondiment('peanut butter')->addCondiment('jelly')->make();
		$this->assertEquals('white', $sandwich['bread']);
		$this->assertContains('peanut butter', $sandwich['condiments']);
		$this->assertContains('jelly', $sandwich['condiments']);
		$this->assertEmpty($sandwich['vegetables']);
		$this->assertNull($sandwich['cheese']);
		$this->assertNull($sandwich['meat']);
		$this->assertFalse($sandwich['isGrilled']);
	}

	public function test_grilled_cheese() {
		$sandwich = Sandwich::withBread('white')->withCheese('american')->addVegetable('onion')->removeVegetable('onion')->grill()->make();
		$this->assertEquals('white', $sandwich['bread']);
		$this->assertEmpty($sandwich['condiments']);
		$this->assertEmpty($sandwich['vegetables']);
		$this->assertEquals('american', $sandwich['cheese']);
		$this->assertNull($sandwich['meat']);
		$this->assertTrue($sandwich['isGrilled']);
	}

	public function test_ham_and_swiss_on_wheat() {
		$sandwich = Sandwich::withBread('wheat')->withCheese('swiss')->withMeat('ham')->addCondiment('mayo')->addCondiment('mustard')->removeCondiment('mustard')->grill(false)->make();
		$this->assertEquals('wheat', $sandwich['bread']);
		$this->assertContains('mayo', $sandwich['condiments']);
		$this->assertNotContains('mustard', $sandwich['condiments']);
		$this->assertEmpty($sandwich['vegetables']);
		$this->assertEquals('swiss', $sandwich['cheese']);
		$this->assertEquals('ham', $sandwich['meat']);
		$this->assertFalse($sandwich['isGrilled']);
	}

	public function test_grilled_pb_and_j_wait_no_i_dont_want_it_grilled() {
		$sandwich = Sandwich::withBread('white')->grill()->addCondiment('peanut butter')->addCondiment('jelly')->grill(false)->make();
		$this->assertEquals('white', $sandwich['bread']);
		$this->assertContains('peanut butter', $sandwich['condiments']);
		$this->assertContains('jelly', $sandwich['condiments']);
		$this->assertEmpty($sandwich['vegetables']);
		$this->assertNull($sandwich['cheese']);
		$this->assertNull($sandwich['meat']);
		$this->assertFalse($sandwich['isGrilled']);
	}

	public function test_blt() {
		$sandwich = Sandwich::chainableProxy()->addVegetable('lettuce')->addCondiment('mayo')->addVegetable('tomato')->withBread('white')->withMeat('bacon')->grill()->make();
		$this->assertEquals('white', $sandwich['bread']);
		$this->assertContains('mayo', $sandwich['condiments']);
		$this->assertEquals('bacon', $sandwich['meat']);
		$this->assertContains('lettuce', $sandwich['vegetables']);
		$this->assertContains('tomato', $sandwich['vegetables']);
		$this->assertTrue($sandwich['isGrilled']);
	}
}
