<?php

namespace bestog;

date_default_timezone_set('Europe/Berlin');

/**
 * Class BTG
 * Useful PHP-Functions
 *
 * @package bestog
 */
class BTG {

	/**
	 * Get datetime from timestamp or date
	 *
	 * @param int|boolean|string $value Date or timestamp
	 *
	 * @return string
	 */
	public static function datetime($value) {
		if (!self::isTimestamp($value)) {
			$value = \strtotime($value);
		}
		return date('Y-m-d H:i:s', $value);
	}

	/**
	 * Is the value a valid timestamp?
	 *
	 * @param int|string $stamp
	 *
	 * @return bool
	 */
	public static function isTimestamp($stamp) {
		return ctype_digit($stamp) && strtotime(date('Y-m-d H:i:s', $stamp)) === (int)$stamp;
	}

	/**
	 * Format bytes to a readable size
	 *
	 * @param int $bytes    Bytes
	 * @param int $decimals Decimals
	 *
	 * @return string
	 */
	public static function readableSize($bytes, $decimals = 2) {
		$size   = ['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
		$factor = (int)floor((strlen($bytes) - 1) / 3);
		return sprintf("%.{$decimals}f", $bytes / (1024 ** $factor)).$size[ $factor ];
	}

	/**
	 * Check if value is a hex color (or shorthand hex color)
	 *
	 * @param string $value (example: #ff00ff or #f0f)
	 *
	 * @return int  (6 = #ff00ff, 3 = #f0f, -1 = invalid)
	 */
	public static function isHexColor($value) {
		$check = function($value, $len) {
			return preg_match('/^#(?:[0-9a-fA-F]{'.$len.'})$/', $value) && strlen($value) === $len + 1;
		};
		return $check($value, 6) ? 6 : ($check($value, 3) ? 3 : -1);
	}

	/**
	 * Get nested array from ArrayList
	 *
	 * @param array  $array
	 * @param string $nestedKey
	 * @param mixed  $nestedValue
	 *
	 * @return array|null
	 */
	public static function getNestedArray($array, $nestedKey, $nestedValue) {
		if (count($array) > 0) {
			foreach ($array as $item) {
				if ($item[ $nestedKey ] === $nestedValue) {
					return $item;
				}
			}
		}
		return null;
	}

}