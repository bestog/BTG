<?php

namespace bestog;

use PHPUnit\Framework\TestCase;

/**
 * Class Test
 *
 * @package bestog
 */
class Test extends TestCase {

	/**
	 * Test: isTimestamp
	 */
	public function test_isTimestamp() {
		static::assertEquals(true, BTG::isTimestamp(time()));
		static::assertEquals(true, BTG::isTimestamp('123456789'));
		static::assertEquals(true, BTG::isTimestamp(123456789));
		static::assertEquals(false, BTG::isTimestamp('1970-01-01 01:00:00'));
		static::assertEquals(false, BTG::isTimestamp('12:00:00'));
	}

	/**
	 * Test: datetime
	 */
	public function test_datetime() {
		$nowTime = time();
		$datetime = date('Y-m-d H:i:s', $nowTime);
		static::assertEquals($datetime, BTG::datetime($nowTime));
		static::assertEquals($datetime, BTG::datetime(date('d.m.Y H:i:s', $nowTime)));
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

	/**
	 * Test: coordinatesDistance
	 */
	public function test_coordinatesDistance() {
		// correct
		static::assertEquals(504845, BTG::coordinatesDistance([52.5243700, 13.4105300], [48.137154, 11.576124]));
		static::assertEquals(504845, BTG::coordinatesDistance(['52.5243700', '13.4105300'], ['48.137154', '11.576124']));
		// wrong
		static::assertEquals(null, BTG::coordinatesDistance([52.5243700], [48.137154]));
		static::assertEquals(null, BTG::coordinatesDistance(['Berlin'], ['München']));
	}

	/**
	 * Test: nothingEmpty
	 */
	public function test_nothingEmpty() {
		$a = $b = $c = $d = $e = $f = 'val';
		$y = '';
		$z = null;

		static::assertTrue(BTG::nothingEmpty($a, $b, $c, $d));
		static::assertNotTrue(BTG::nothingEmpty($a, $b, $c, $d, $z));
		static::assertNotTrue(BTG::nothingEmpty($a, $b, $c, $d, $y));
		static::assertNotTrue(BTG::nothingEmpty($z, $y));
	}

}
