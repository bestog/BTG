<?php

namespace bestog;

/**
 * Class Test
 *
 * @package bestog
 */
class Test extends \PHPUnit\Framework\TestCase {

	/**
	 * Test: isTimestamp
	 */
	public function test_isTimestamp() {
		static::assertEquals(true, BTG::isTimestamp(time()));
		static::assertEquals(true, BTG::isTimestamp('123456789'));
		static::assertEquals(false, BTG::isTimestamp('1970-01-01 01:00:00'));
		static::assertEquals(false, BTG::isTimestamp('12:00:00'));
	}

	/**
	 * Test: datetime
	 */
	public function test_datetime() {
		$nowTime = time();
		static::assertEquals(date('Y-m-d H:i:s', $nowTime), BTG::datetime($nowTime));
	}

	/**
	 * Test: readableSize
	 */
	public function test_readableSize() {
		// low value and decimal precision
		static::assertEquals('1.00B', BTG::readableSize(1));
		static::assertEquals('1.000B', BTG::readableSize(1, 3));
		// high value
		static::assertEquals('9.09TB', BTG::readableSize(9999999999999));
		// string value
		static::assertEquals('200.00B', BTG::readableSize('200'));
	}

	/**
	 * Test: isHexColor
	 */
	public function test_isHexColor() {
		// correct hex codes
		static::assertEquals(3, BTG::isHexColor('#f0f'));
		static::assertEquals(6, BTG::isHexColor('#ff00ff'));
		// wrong hex codes
		static::assertEquals(-1, BTG::isHexColor('f0f'));
		static::assertEquals(-1, BTG::isHexColor('ff00ff'));
		static::assertEquals(-1, BTG::isHexColor('#fff000fff'));
	}

	/**
	 * Test: getNestedArray
	 */
	public function test_getNestedArray() {
		$nestedArray = [
			['name' => 'Adam'],
			['name' => 'Bob'],
			['name' => 'Carl']
		];

		// correct
		static::assertEquals(['name' => 'Bob'], BTG::getNestedArray($nestedArray, 'name', 'Bob'));
		// wrong
		static::assertEquals(null, BTG::getNestedArray($nestedArray, 'name', 'Alice'));
	}

}
