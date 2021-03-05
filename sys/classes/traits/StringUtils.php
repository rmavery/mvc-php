<?php

/**
 * Auxiliary functions for working with strings
 */
trait StringUtils {

	/**
	 * Checks if a particular string ends with another substring
	 * @param string $haystack The first string
	 * @param string $needle The second string
	 * @return bool
	 */
	final public static function endsWith($haystack, $needle) {
		$haystack = substr($haystack, -strlen($needle));
		return $haystack === $needle;
	}

	/**
	 * Checks if a particular string starts with another substring
	 * @param string $haystack The first string
	 * @param string $needle The second string
	 * @return bool
	 */
	final public static function startsWith($haystack, $needle) {
		$haystack = substr($haystack, 0, strlen($needle));
		return $haystack === $needle;
	}

}
