<?php

abstract class AbstractController {
	protected $model;
	protected $view; 

	public function __construct($model, $view) {
		$this->model = $model;
		$this->view = $view;
	}

	protected function get_view() {
		return $this->view;
	}

	protected function get_model() {
		return $this->model;
	}
}