<?php

include_once CORE_PATH . DS . 'Controller.class.php';

class Index_Controller extends AbstractController {
	
	private $controllers = array();

	public function __construct($model, $view) {
		parent::__construct($model, $view);
	}

	public function addController($name, $model, $view) {
		$this->controllers[$name] = new AbstractController($model, $view);
	}

	public function getController($name) {
		return $this->controllers[$name];
	}

	public function renderViews() {
		$this->renderView();
		foreach($this->controllers as $controller) {
			printArray($controller);
			$controller->renderView($controller->getModel());
		}
	}

	public function invokeAll() {
		$this->invoke();
		foreach ($this->controllers as $controller) {
			echo 'a';
			printArray($controller);
			$controller->invoke();
		}
	}
}