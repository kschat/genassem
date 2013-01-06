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
	* This function takes an id (wildcards are accepted), an offset, and an amount of members to grab
	* as paramters. It then queries the members table based on the information provided and returns an
	* array containing the result of the query. 
	*
	* @param string $id used to identify a single member or all members by default.
	* @param int $offset used to determine the offset of members to grab based on their id's.
	* @param int $amount used to determine how many members to get.
	* @return array an array containing all fields from the members table
	*/
	public function getMembers($id = '%', $offset = 0, $amount = 10) {
		$sql = 'SELECT *
				FROM members
				WHERE members.member_id LIKE :id
				ORDER BY members.member_id ASC LIMIT :offset, :amount;';

		$params = array(
				':id' 		=> $id,
				':offset' 	=> $offset,
				':amount'	=> $amount
		);
		
		return $this->executeQuery($sql, $params);
	}


	/**
	* Function used to add a member of the members table.
	*
	* This function takes a first name, last name, email address, and a password as parameters.
	* It queries the database to insert a row with the information passed to the function. If the
	* new member was added to the members table successfully it returns true; false otherwise. 
	*
	* @param string $fName contains the new members first name.
	* @param string $lName contains the new members last name.
	* @param string $email contains the new members email.
	* @param string $password contains the new members password.
	* @return boolean returns true if the member as added successfully; false otherwise.
	*/
	public function addMember($fName, $lName, $email, $password) {
		$sql = 'INSERT INTO members
				VALUES(:id, :fname, :lname, :email, :password);';

		$params = array(
				':id'		=> '',
				':fname'	=> $fName,
				':lname'	=> $lName,
				':email'	=> $email,
				':password'	=> $password
		);

		return $this->executeUpdate($sql, $params);
	}
}