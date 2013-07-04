<?php
require 'traitGenMetodo.php';
class Car {

	use genMethod;
	private $model, $year;
	public function __construct($model, $year) {
		$this->model = $model;
		$this->year = $year;
		$this->functionArgs = null;
	}
	public function start() {
		echo "Starting the car\n";
	}
}
