<?php 
/**
* Abstract Wrapper class used to connect the database and run queries against it. 
* This class shouldn't (and can't) be used as an instance, but rather should be
* extended for more specific purposes.
* 
* @author Kyle Schattler
* @version 1.0
*/

abstract class DatabaseHandler {

	/**
	* Object used to reference the handle returned from PDO to connect to the database
	* @access protected
	* @var PDO Object
	*/
	protected $handle;
	
	/**
	* Flag used to determine if PDO should report errors.
	* @access protected
	* @var boolean
	*/
	protected $error_handling;
	/**
	* Class constructor.
	*
	* Requires the database name, host name, user name, and password. Error handling is on by
	* default. If an error occurs the message is printed out to the current output.
	*/
	public function __construct($database, $host, $user, $password, $error_handling = true){
		try {
			$this->handle = new PDO("mysql:host=$host;dbname=$database;", $user, $password);
			$this->error_handling = $error_handling;

			/** Turns on exceptions and warnings for PDO */
			if($this->error_handling) {
				$this->handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			}
		}
		catch(PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}
	}

	/**
	* Class destructor.
	*
	* Disconnects from the database.
	*/
	public function __destruct() {
		$this->disconnect();
	}
	
	/**
	* Function used to execute a query against the database.
	*
	* This function takes a query string, an array of parameters, and a fetch type as parameters.
	* The function attempts to execute the query using the parameters given to the function. If the
	* query can't be executed an empty array is returned. 
	*
	* @param string $query query string
	* @param array $parameters variables that should be injected into the query
	* @param PDO constant $fetch_type determines how the return array should be formatted
	* @return array an array containing the information returned from the database
	*/
	public function executeQuery($query, array $parameters = array(), $fetch_type = PDO::FETCH_ASSOC) {
		$result = array();

		$sth = $this->handle->prepare($query);

		foreach ($parameters as $key => $value) {
			if(is_numeric($value)) {
				$sth->bindValue($key, (int)trim($value), PDO::PARAM_INT);
			}
			else {
				$sth->bindValue($key, trim($value), PDO::PARAM_STR);
			}
		}
		
		if($sth->execute()) {
			while($row = $sth->fetch($fetch_type)) {
				array_push($result, $row);
			}
		}
		
		return $result;
	}

	/**
	* Function used to execute an update query against the database.
	*
	* This function takes a query string, an array of parameters, and a fetch type as parameters.
	* The function attempts to execute the update using the parameters given to the function. If the
	* query can't be executed an empty array is returned. 
	*
	* @param string $query query string
	* @param array $parameters variables that should be injected into the query
	* @return boolean true if the execution of the update was a success, false otherwise
	*/
	public function executeUpdate($query, array $parameters = array()) {
		$sth = $this->handle->prepare($query);
		
		return $sth->execute($parameters);
	}

	/**
	* Disconnects from the database by setting the PDO object to null. 
	* @see __destruct()
	*/
	public function disconnect() {
		$handle = null;
	}
}