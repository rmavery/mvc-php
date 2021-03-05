<?php

/**
 * Functions related to cryptography.
 */
final class Crypto {

	/**
	 * Symmetric block encryption algorithm
	 * @var string
	 */
	private static $algo = 'aes-256-cbc';

	/**
	 * SHA-512 hash function
	 * @param string $password Hash function input
	 * @param bool $salt The value should be true if we use, or false if we do not use the $salt parameter
	 * @return string Hash function output
	 */
	final public static function sha512($password, $salt = false) {
		if ($salt) {
			return hash('sha512', $password . Config::SALT);
		} else {
			return hash('sha512', $password);
		}
	}

	/**
	 * Symmetric block encryption, the output is in Base64 format
	 * @param string $plainText Plain text
	 * @param string $key Symmetrical key (aes-256-cbc = 256 бита)
	 * @param string $iv Initialization vector (aes-256-cbc = 128 бита)
	 * @return string
	 */
	final public static function encrypt($plainText, $key, $iv = false) {
		$cipherText = openssl_encrypt($plainText, self::$algo, $key, OPENSSL_RAW_DATA, $iv);
		return base64_encode($cipherText);
	}

	/**
	 * Symmetrical block decryption, the input is in Base64 format
	 * @param string $cipherTextEncoded Code
	 * @param string $key Symmetrical key (aes-256-cbc = 256 бита)
	 * @param string $iv Initialization vector (aes-256-cbc = 128 бита)
	 * @return string
	 */
	final public static function decrypt($cipherTextEncoded, $key, $iv = false) {
		$cipherText = base64_decode($cipherTextEncoded);
		$decrypted = openssl_decrypt($cipherText, self::$algo, $key, OPENSSL_RAW_DATA, $iv);
		return $decrypted;
	}

	/**
	 * "Turning off" the constructor.
	 */
	private function __construct() {}

}
