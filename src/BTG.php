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
		return sprintf("%.{$decimals}f", $bytes / \pow(1024, $factor)).$size[ $factor ];
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

	/**
	 * Calculate distance between two coordinates
	 *
	 * @param array $first  [0] Latitude & [1] Longitude (as float/string) (Example: [52.5243700, 13.4105300])
	 * @param array $second [0] Latitude & [1] Longitude (as float/string) (Example: [48.137154, 11.576124])
	 *
	 * @return int metres (Example: 504845m / km = 504.845)
	 */
	public static function coordinatesDistance($first, $second) {
		if (is_array($first) && is_array($second) && count($first) === 2 && count($second) === 2) {
			// Convert values in floats (as a precaution)
			$first  = \array_map('floatval', $first);
			$second = \array_map('floatval', $second);
			// Calculation
			$theta = $first[1] - $second[1];
			$dist  = sin(deg2rad($first[0])) * sin(deg2rad($second[0])) + cos(deg2rad($first[0])) * cos(deg2rad($second[0])) * cos(deg2rad($theta));
			$miles = rad2deg(acos($dist)) * 60 * 1.1515;
			// Round (as a precaution) and return the result
			return (int)(($miles * 1.609344) * 1000);
		}
		return null;
	}

	/**
	 * Check if all values as parameters are not empty.
	 * Number of parameters unlimited.
	 *
	 * @return bool
	 */
	public static function nothingEmpty() {
		foreach (func_get_args() as $arg) {
			if (empty($arg)) {
				return false;
			}
		}
		return true;
	}

}