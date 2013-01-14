<?php

include_once CORE_PATH . DS . 'Model.class.php';

class Signin_Model extends BaseModel {

	public function __construct(array $args = array()) {
		parent::__construct($args);

		$this->email = isset($_POST['signin-email']) ? $_POST['signin-email'] : '';
		$this->password = isset($_POST['signin-password']) ? $_POST['signin-password'] : '';
	}
}