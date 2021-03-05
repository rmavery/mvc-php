<?php

/**
 * TaskApiController
 */
class TaskApiController extends ApiController {

	/**
	 * Route: /api/tasks
	 * CURL example:
	 * <code>
	 * 	curl http://localhost/dev/MVC/api/tasks --cookie "PHPSESSID=$yourSessionId"
	 * </code>
	 * @return void
	 */
	public function index() {
		// Stop further processing of the request in case the HTTP method is not appropriate
		Http::checkMethodIsAllowed('GET');

		// Taking data from the database
		$tasks = TaskModel::getAll();

		// Forwarding data to the display layer
		$this->set('tasks', $tasks);
	}

}
