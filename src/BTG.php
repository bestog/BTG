<?php

namespace bestog;

/**
 * Class BTG
 *
 * @package bestog
 */
class BTG {

	/**
	 * @param $value
	 *
	 * @return bool
	 */
	public static function isTimestamp($value) {
		return is_numeric($value) && $value > 0;
	}

}