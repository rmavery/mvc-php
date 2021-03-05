<?php

/**
 * Auxiliary functions for working with the date
 */
trait DateUtils {

	/**
	 * Date and time formatting
	 * @param int|string PHP or MySQL timestamp
	 * @return string
	 */
	final public static function formatDateAndTime($ts) {
		if (is_string($ts)) {
			$ts = strtotime($ts);
		}
		return date('H:i:s d.m.Y', $ts);
	}

}
