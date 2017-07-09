<?php

namespace bestog;

/**
 * Class Test
 *
 * @package bestog
 */
class Test extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 */
	public function test_isTimestamp() {
		static::assertEquals(true, BTG::isTimestamp(time()));
		static::assertEquals(true, BTG::isTimestamp(1));
		static::assertEquals(false, BTG::isTimestamp('1970-01-01 01:00:00'));
		static::assertEquals(false, BTG::isTimestamp('12:00:00'));
	}

}
