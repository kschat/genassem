<?php

include_once CORE_PATH . DS . 'Controller.class.php';

class Signin_Controller extends AbstractController {

	public function __construct($model, $view) {
		parent::__construct($model, $view);
	}

	public function signIn() {
		echo '<h1>hello</h1>';
	}

	public function invoke() {
		$this->signIn();
	}
}