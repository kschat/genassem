<?php

include_once 'DatabaseHandler.class.php';

class ComponentDatabaseHandler extends DatabaseHandler {
	/**
	* Class constructor. Calls parents consturctor.
	*
	* @see DatabaseHandler::__construct()
	*/
	public function __construct($database, $host, $user, $password, $error_handling = true) {
		parent::__construct($database, $host, $user, $password, $error_handling);
	}

	/**
	* Class destructor. Disconnects from the database.
	*
	* @see DatabaseHandler::__descturct()
	*/
	public function __destruct() {
		parent::__destruct();
	}

	public function getComponentByName($name = '%') {
		$sql = 'SELECT * FROM components
				WHERE components.name LIKE :name;';

		$params = array(':name' => $name);

		return $this->executeQuery($sql, $params);
	}

	public function getComponentByID($id = '%') {
		$sql = 'SELECT * FROM components
				WHERE components.component_id LIKE :id;';

		$params = array(':id' => $id);

		return $this->executeQuery($sql, $params);
	}

	public function getComponentsForPage($pageName = '%') {
		$sql = 'SELECT components.component_id, components.component_name FROM
					(components LEFT JOIN page_has_comp 
					ON components.component_id = page_has_comp.component_id)
					LEFT JOIN pages 
					ON page_has_comp.page_id = pages.page_id
				WHERE pages.name LIKE :pageName;';

		$params = array(':pageName' => $pageName);

		return $this->executeQuery($sql, $params);
	}
}