<?php

namespace bestog;

date_default_timezone_set('Europe/Berlin');

/**
 * Class BTG
 *
 * @package bestog
 */
class BTG {

	/**
	 * @param $value
	 *
	 * @return false|string
	 */
	public static function datetime($value) {
		if (!self::isTimestamp($value)) {
			$value = \strtotime($value);
		}

		return date('Y-m-d H:i:s', $value);
	}

	/**
	 * @param $value
	 *
	 * @return bool
	 */
	public static function isTimestamp($value) {
		return is_numeric($value) && $value > 0;
	}

}