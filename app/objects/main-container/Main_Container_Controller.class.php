<?php

include_once CORE_PATH . DS . 'Controller.class.php';

class Main_Container_Controller extends AbstractController {
	
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
			$controller->renderView($controller->getModel());
		}
	}
}