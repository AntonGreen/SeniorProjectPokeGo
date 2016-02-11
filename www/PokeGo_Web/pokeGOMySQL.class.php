<?php

require_once("MySQL.class.php");

/*
	Class: PokeGOMySQL
	Inherits from : MySQL
	Purpose : passes data
	from and to the database PokeGO 

	By: Antonio Garcia
	Date : Oct 23 2014
*/

class pokeGOMySQL extends MySQL
{

	/*
		get userID from database
		to check log in is valid
		returns userID
	*/
	public function checkLogin($myUserName, $myPassword)
	{
		//prevents SQL injections
		$myUserName = stripslashes($myUserName);
		$myPassword = stripslashes($myPassword);
		
		//hashes password
		$myPassword = md5($myPassword);

		$sql = "SELECT userID FROM User WHERE userName ='$myUserName' and password ='$myPassword'";

		$this->storeResultAssoc($sql);

		return $this->data[0]['userID'];
	}

	/*
		in the model i will have to make an if statement saying 
		if checkUser is correct then getUserType
		and if that is true then you will switch controller (view)
		meaning you will need to create a controller 
		and bodyElement for every page

		this should return 1, 2, or 3 where
		1 = CEO
		2 = orderer 
		3 = sale
		returns userType
	*/


	// gets userID from username alone returns userID
	public function getUserID($myUserName)
	{
		$myUserName = stripslashes($myUserName);
		$sql = "SELECT userID FROM User WHERE userName = '$myUserName'";

		$this->storeResultAssoc($sql);

		return $this->data[0]['userID'];
	}



	/*
		deletes User from database based on id
	*/
	public function deleteUser($myUserID)
	{
		$myUserID = stripslashes($myUserID);
		$sql = "DELETE FROM User WHERE userID='$myUserID'";
		$this->doQuery($sql);
	}


	// adds user to the User database
	public function addUser($myUserName,$myPassword)
	{
		//$myUserName = stripslashes($myUserName);
		//$myPassword = stripslashes($myPassword);
		$myPassword = md5($myPassword);
		$sql = "INSERT INTO User (username, password) VALUES ('$myUserName','$myPassword')";
		$this->doQuery($sql);
	}

	

	
}

?>
