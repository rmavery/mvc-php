<?php

/**
 * Session management class.
 */
final class Session {

	/**
	 * Session cookie configuration
	 * @var array
	 */
	private static $cookieParams = [
		'lifetime' => 0,
		'path' => '/',
		'domain' => '',
		'secure' => false,
		'httponly' => true,
		'samesite' => 'Strict'
	];

	/**
	 * Starting a session
	 * @return void
	 */
	final public static function begin() {
		if (Http::isHttps()) {
			$this->cookieParams['secure'] = true;
		}

		if (!session_set_cookie_params(self::$cookieParams)) {
			ob_clean();
			die('SESSION: Unable to set cookie params.');
		}
		session_start();
	}

	/**
	 * Clear session data and end a session
	 * @return void
	 */
	final public static function end() {
		$_SESSION = [];
		session_destroy();
	}

	/**
	 * Session data manipulation
	 * @param string $key Session variable
	 * @param mixed $value Session variable value
	 */
	final public static function set($key, $value) {
		$_SESSION[$key] = $value;
	}

	/**
	 * Restore the value of the corresponding session variable
	 * @param string $key Session variable
	 * @return mixed|boolean
	 */
	final public static function get($key) {
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		}
		return false;
	}

	/**
	 * "Turning off" the constructor.
	 */
	private function __construct() {}

}
