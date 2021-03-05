<?php

/**
 * Redirection class.
 */
final class Redirect {

	/**
	 * Internal redirection
	 * @param string $link Relative link to internal resource
	 */
	final public static function to($link) {
		ob_clean();
		header('Location: ' . Config::BASE . $link);
		die;
	}

	/**
	 * External redirection
	 * @param string $link An absolute link to an (external) resource
	 */
	final public static function absolute($link) {
		ob_clean();
		header('Location: ' . $link);
		die;
	}

	/**
	 * "Turning off" the constructor
	 */
	private function __construct() {}

}
