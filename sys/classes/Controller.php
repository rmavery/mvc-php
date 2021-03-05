<?php

/**
 * Abstract controller class. Every controller needs to extend this class.
 */
abstract class Controller {

	/**
	 * Data to be shared between the controller and the story template
	 * @var array
	 */
	private $data = [];

	/**
	 * The default method of each controller
	 * @return void
	 */
	abstract public function index();

	/**
	 * Add a new variable to the data string
	 * @param string $key Variable name
	 * @param mixed $value The value of the variable
	 * @return void
	 */
	final protected function set($key, $value) {
		$this->data[$key] = $value;
	}

	/**
	 * Restore a data string
	 * @return array
	 */
	final public function getData() {
		return $this->data;
	}

	/**
	 * A method that executes before the index method
	 */
	public function __pre() {}

		/**
	 * The method that is executed after the index method
	 */
	public function __post() {}

}
