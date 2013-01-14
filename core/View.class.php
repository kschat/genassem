<?php

class BaseView {
	private $file;
	private $object;
	private $path;
	
	public function __construct($file, $object = '') {
		$this->file = $file;
		$this->object = $object;

		if(empty($this->object)) {
			$this->object = $this->file;
		}

		$this->path = OBJECTS_PATH . DS . $this->object . DS . 'views' . DS . $this->file;
	}

	public function render($model) {
		include_once $this->path;
	}
}