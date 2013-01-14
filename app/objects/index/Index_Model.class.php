<?php

include_once CORE_PATH . DS . 'Model.class.php';

class Index_Model extends BaseModel {
	
	private $pageContent;

	public function __construct($content, array $args = array()) {
		parent::__construct($args);
		$this->pageContent = $content;
	}

	public function getPageContent() {
		return $this->pageContent;
	}
}