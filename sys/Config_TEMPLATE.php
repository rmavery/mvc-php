<?php

/**
 * Configuration file - Rename this file to 'config.php'.   If it's in the sys directory, .gitignore will not upload it to the repository (because it has sensitive data in it)
 */
final class Config {

	/**
	 * Absolute application link
	 * @var string
	 */
	const BASE = 'http://base.url.for.website.org/';

	/**
	 * Relative link of the application (usually only '/' in production)
	 */
	const PATH = '/';

	/**
	 * BP server: host name
	 * @var string
	 */
	const DB_HOST = 'localhost';

	/**
	 * Server DB: username
	 * @var string
	 */
	const DB_USER = 'database_username';

	/**
	 * Server DB: password
	 * @var string
	 */
	const DB_PASS = 'DatabaseDpAsTsAwBoArSdEPassword';

	/**
	 * Server BP: database name
	 * @var string
	 */
	const DB_NAME = 'nameof_databse';

	/**
	 * The session variable in which the user ID will be stored at login
	 * @var string
	 */
	const USER_COOKIE = 'user_id';

	/**
	 * Random or pseudo-random string of arbitrary length
	 * @var string
	 */
	const SALT = 'JustTypeRandomStuffHere like=> XK8/VE2Xph2gynvQCgBLau6K7mggn0bHItk.mjhar0ctZ73G3Oec.';

}
