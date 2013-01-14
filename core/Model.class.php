<?php

class BaseModel {
	private $args;
	
	public function __construct(array $args = array()) {
		$this->args = $args;
	}

	public function __get($name) {
		return $this->args[$name];
	}

	public function __set($name, $value) {
		$this->args[$name] = $value;
	}
}