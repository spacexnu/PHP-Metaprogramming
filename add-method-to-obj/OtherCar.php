<?php
class Car {
	public $model, $year;
	private $functionArgs;
	public function __construct($model, $year) {
		$this->model = $model;
		$this->year = $year;
	}
	public function start() {
		echo "Starting...\n";
	}
	public function __call($method, $args) {
		if ($this->{$method} instanceof Closure) {
			return call_user_func_array ( $this->{$method}, $args );
		}
	}
}