<?php

namespace bestog;

class Test extends \PHPUnit_Framework_TestCase {

	public function test_isTimestamp() {
		$this->assertEquals(true, BTG::isTimestamp(time()));
		$this->assertEquals(true, BTG::isTimestamp(1));
		$this->assertEquals(false, BTG::isTimestamp('1970-01-01 01:00:00'));
		$this->assertEquals(false, BTG::isTimestamp('12:00:00'));
	}

}
