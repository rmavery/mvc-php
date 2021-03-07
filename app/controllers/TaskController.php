<?php

/**
 * TaskController
 */
class TaskController extends AuthController {

	/**
	 * Route: /tasks/
	 * @return void
	 */
	public function index() {
		// Setting the title
		$this->set('title', 'Task / Index');

		// Taking data from the database
		$tasks = TaskModel::getAllFromInnerJoinWithUsers();

		// Formatting display data
		foreach ($tasks as $task) {
			$task->created_at = Utils::formatDateAndTime($task->created_at);
			$task->user = $this->formatFirstAndLastName($task->first_name, $task->last_name);
		}

		// Forwarding data to the display layer
		$this->set('tasks', $tasks);
	}

	/**
	 * Route: /tasks/create/
	 * @return void
	 */
	public function create() {
		// Setting the title
		$this->set('title', 'Task / Add task');

		// Stop further processing of the request in case the HTTP method is not appropriate
		if (!Http::isPost()) {
			return;
		}

		// Retrieving data from HTTP POST variables
		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
		$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

		// Data validation
		if (empty($name) || empty($description)) {
			$this->set('message', 'Error #1!');
			return;
		}

		// Normalization of data before entry into the database
		$userId = intval(Session::get(Config::USER_COOKIE));
		$name = trim($name);
		$description = trim($description);

		// Data entry into the database
		$task = TaskModel::create([
			'user_id' => $userId,
			'name' => $name,
			'description' => $description
		]);

		// Return to the form in case of failed entry in the database
		if (!$task) {
			$this->set('message', 'Error #2!');
			return;
		}

		// Redirection
		Redirect::to('tasks');
	}

	/**
	 * Route: /tasks/update/$id
	 * @param int $id ID parameter
	 * @return void
	 */
	public function update($id) {
		// Setting the title
		$this->set('title', 'Task / Update task');

		// Stop further processing of the request in case the HTTP method is not appropriate
		if (!Http::isPost()) {
			$this->setTask($id);
			return;
		}

		// Retrieving data from HTTP POST variables
		$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
		$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

		// Data validation
		if (empty($name) || empty($description)) {
			$this->set('message', 'Error #1!');
			$this->setTask($id);
			return;
		}

		// Normalization of data before entry into the database
		$userId = intval(Session::get(Config::USER_COOKIE));
		$name = trim($name);
		$description = trim($description);

		// Update data in the database
		$status = TaskModel::update($id, [
			'user_id' => $userId,
			'name' => $name,
			'description' => $description
		]);

		// Return to the form in case of failed entry in the database
		if (!$status) {
			$this->set('message', 'Error #2!');
			$this->setTask($id);
			return;
		}

		// Redirection
		Redirect::to('tasks');
	}

	/**
	 * Route: /tasks/delete/$id
	 * @param int $id ID parameter
	 * @return void
	 */
	public function delete($id) {
		// Removing data from the database
		TaskModel::delete($id);

		// Redirection
		Redirect::to('tasks');
	}

	/**
	 * Returns a row from the table by ID parameter and stores it in the display data
	 * @param int $id ID parameter
	 * @return void
	 */
	private function setTask($id, $name = 'task') {
		// Reading data from the database
		$task = TaskModel::getById($id);

		// Forwarding data to the display layer
		$this->set($name, $task);
	}

	/**
	 *Formats the first and last name of the user to display
	 * @param string $firstName Name
	 * @param string $lastName Surname
	 * @return string
	 */
	public static function formatFirstAndLastName($firstName, $lastName) {
		$user = trim(implode(' ', [$firstName, $lastName]));
		return $user ? $user : 'N/A';
	}

}
