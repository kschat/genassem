<?php

class AbstractController {
	protected $model;
	protected $view; 

	public function __construct($model, $view) {
		$this->model = $model;
		$this->view = $view;
	}

	protected function getView() {
		return $this->view;
	}

	protected function getModel() {
		return $this->model;
	}

	public function renderView() {
		$this->view->render($this->model);
	}

	public function invoke() {
		echo '<h1>INVOKE</h1>';
	}
}