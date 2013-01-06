<?php 
/**
* Wrapper class used to connect the database and run queries dealing with members.
* 
* @author Kyle Schattler
* @version 1.0
*/

include_once 'DatabaseHandler.class.php';

class MemberDatabaseHandler extends DatabaseHandler {

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

	/**
	* Function used to execute a query against the database.
	*
	* This function takes a query string, an array of parameters, and a fetch type as parameters.
	* The function attempts to execute the query using the parameters given to the function. If the
	* query can't be executed an empty array is returned. 
	*
	* @param string used to identify a single member or all members by default.
	* @return array an array containing all fields from the members table
	*/
	public function getMembers($id = '%', $offset = 0, $amount = 10) {
		$sql = 'SELECT *
				FROM members
				WHERE members.member_id LIKE :id
				ORDER BY members.member_id DESC LIMIT :offset, :amount;';

		$params = array(
				':id' 		=> $id,
				':offset' 	=> $offset,
				':amount'	=> $amount
		);
		
		return $this->executeQuery($sql, $params);
	}
}