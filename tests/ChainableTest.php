<?php
use Skybluesofa\Chainable\Tests\Sandwich;

class ChainableTest extends PHPUnit_Framework_TestCase {
	/**
     * @expectedException Exception
	 * @expectedExceptionMessage That's not a sandwich
     */
	function test_without_setting_required_parameter() {
		$sandwich = Sandwich::make();
	}
	/**
     * @expectedException Exception
	 * @expectedExceptionMessage Chainable method does not exist on object
     */
	 function test_missing_method() {
		$sandwich = Sandwich::addBananas()->run();
	}
	function test_peanut_butter_and_jelly() {
		$sandwich = Sandwich::withBread('white')->addCondiment('peanut butter')->addCondiment('jelly')->make();
		$this->assertEquals('white', $sandwich['bread']);
		$this->assertContains('peanut butter', $sandwich['condiments']);
		$this->assertContains('jelly', $sandwich['condiments']);
		$this->assertEmpty($sandwich['vegetables']);
		$this->assertNull($sandwich['cheese']);
		$this->assertNull($sandwich['meat']);
		$this->assertFalse($sandwich['isGrilled']);
	}
	function test_grilled_cheese() {
		$sandwich = Sandwich::withBread('white')->withCheese('american')->addVegetable('onion')->removeVegetable('onion')->grill()->make();
		$this->assertEquals('white', $sandwich['bread']);
		$this->assertEmpty($sandwich['condiments']);
		$this->assertEmpty($sandwich['vegetables']);
		$this->assertEquals('american', $sandwich['cheese']);
		$this->assertNull($sandwich['meat']);
		$this->assertTrue($sandwich['isGrilled']);
	}
	function test_ham_and_swiss_on_wheat() {
		$sandwich = Sandwich::withBread('wheat')->withCheese('swiss')->withMeat('ham')->addCondiment('mayo')->addCondiment('mustard')->removeCondiment('mustard')->grill(false)->make();
		$this->assertEquals('wheat', $sandwich['bread']);
		$this->assertContains('mayo', $sandwich['condiments']);
		$this->assertEmpty($sandwich['vegetables']);
		$this->assertEquals('swiss', $sandwich['cheese']);
		$this->assertEquals('ham', $sandwich['meat']);
		$this->assertFalse($sandwich['isGrilled']);
	}
	function test_grilled_pb_and_j_wait_no_i_dont_want_it_grilled() {
		$sandwich = Sandwich::withBread('white')->grill()->addCondiment('peanut butter')->addCondiment('jelly')->grill(false)->make();
		$this->assertEquals('white', $sandwich['bread']);
		$this->assertContains('peanut butter', $sandwich['condiments']);
		$this->assertContains('jelly', $sandwich['condiments']);
		$this->assertEmpty($sandwich['vegetables']);
		$this->assertNull($sandwich['cheese']);
		$this->assertNull($sandwich['meat']);
		$this->assertFalse($sandwich['isGrilled']);
	}
	function test_blt() {
		$sandwich = Sandwich::chainableProxy()->addVegetable('lettuce')->addCondiment('mayo')->addVegetable('tomato')->withBread('white')->withMeat('bacon')->grill()->make();
		$this->assertEquals('white', $sandwich['bread']);
		$this->assertContains('mayo', $sandwich['condiments']);
		$this->assertEquals('bacon', $sandwich['meat']);
		$this->assertContains('lettuce', $sandwich['vegetables']);
		$this->assertContains('tomato', $sandwich['vegetables']);
		$this->assertTrue($sandwich['isGrilled']);
	}
}
?>
