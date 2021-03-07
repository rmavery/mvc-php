<?php

/**
 * HomeController
 */
class HomeController extends Controller {

	/**
	 * Route: /
	 * @return void
	 */
	public function index() {
		// Write Title
		$this->set('title', 'Home / Index');

		// Collection of email from the database
		$user = UserModel::getById(Session::get(Config::USER_COOKIE));

		// Format the display data
		if ($user) {
			$this->set('user', TaskController::formatFirstAndLastName($user->first_name, $user->last_name));
		} else {
			$this->set('user', false);
		}
	}

	/**
	 * Route: /login/
	 * @return void
	 */
	public function login() {
		// Putting a title
		$this->set('title', 'Home / Log in');

		// Cancel this request request if it does not comply with the HTTP method
		if (!Http::isPost()) {
			if (!empty(Session::get(Config::USER_COOKIE))) {
				Redirect::to('');
			}
			return;
		}

		// Email collection from HTTP POST variables
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

		// Data validation
		if (empty($email) || empty($password) || strlen($email) > 255) {
			$this->set('message', 'Error #1!');
			return;
		}

		// Additional email validation
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->set('message', 'Error #2!');
			return;
		}

		// Hash-value password
		$password = Crypto::sha512($password, true);

		// Collection of data from the database - user authentication
		$user = UserModel::getByEmailAndPassword($email, $password);

		// Set a session cookie in case of successful authentication
		if ($user) {
			Session::set(Config::USER_COOKIE, intval($user->id));
			Redirect::to('');
		} else {
			$this->set('message', 'Error #3!');
			sleep(2);
			return;
		}
	}

	/**
	 * Route: /logout/
	 * @return void
	 */
	public function logout() {
		// Cleaning session
		Session::end();

		// Redirection
		Redirect::to('');
	}

	/**
	 * Route: HTTP 404 Not Found
	 * @return void
	 */
	public function e404() {
		// Set the appropriate HTTP status code
		http_response_code(404);

		// An error message
		ob_clean();
		die('HTTP: 404 not found.');
	}

}
