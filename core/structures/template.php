<?php

class Template {
	private $args;
	private $file;
	private $object;
	
	public function __construct($file, $object = '', $args = array()) {
		$this->file = $file;
		$this->args = $args;
		$this->object = $object;

		if(empty($this->object)) {
			$this->object = $this->file;
		}
	}

	public function render() {
		include OBJECTS_PATH . DS . $this->object . DS . 'views' . DS . $this->file;
	}
	
	public function __get($name) {
		return $this->args[$name];
	}
	
	public function __set($name, $value) {
		if(is_array($this->args[$name])) {
			$this->args[$name][] = $value;
		}
		else {
			$this->args[$name] = $value;
		}
	}
}