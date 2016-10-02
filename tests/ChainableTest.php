<?php
use Skybluesofa\OnThisDay\OnThisDay;

class ChainableTest extends PHPUnit_Framework_TestCase {
	function test_january_object() {
		$this->assertFileExists(__DIR__.'/../src/Data/Month/En/Us/January.php');
		$this->assertNotContains ("New Year's Day", OnThisDay::getEvents('1/1/2016'));
		$this->assertContains ("New Year's Day", OnThisDay::getHolidays('1/1/2016'));
	}
}
?>
