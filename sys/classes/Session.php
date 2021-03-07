<?php

final class Session {

	/**
	 * Session cookie configuration
	 * @var array
	 */
	// private static $cookieParams = [
	// 	'lifetime' => 0,
	// 	'path' => '/',
	// 	'domain' => '',
	// 	'secure' => false,
	// 	'httponly' => true,
	// 	'samesite' => 'Strict'
	// ];

	/**
	 * Starting a session
	 * @return void
	 */
	final public static function begin() {


		$domain = Config::DOMAIN;
		$cookieParams = session_get_cookie_params();
		$cookieParams = [
			'lifetime' => 0,
			'path' => '/',
			'domain' => $domain,
			'secure' => false,
			'httponly' => true,
			'samesite' => 'Strict'
		];

		if (Http::isHttps()) {
			//echo json_encode($cookieParams);
			$cookieParams['secure'] = true;
		}

		session_write_close();
		
		//ref: https://hotexamples.com/examples/-/-/session_set_cookie_params/php-session_set_cookie_params-function-examples.html
		session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $cookieParams["secure"], $cookieParams["httponly"]);

		//if (!session_set_cookie_params(self::$cookieParams)) {
		// if(!session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $cookieParams["secure"], $cookieParams["httponly"])){
		// 	if (ob_get_length() > 0) {
		// 		ob_clean();
		// 	  }
		// 	debug_to_console($cookieParams);
		// 	die('SESSION: Unable to set cookie params.');
		// }

		if (ob_get_length() > 0) {
			ob_clean();
		}
		// Starting a Session 
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
