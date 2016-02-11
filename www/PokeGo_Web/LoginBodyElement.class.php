<?php
/************************************************/
/*                                              */
/* Class: LoginBodyElement
	Inherits from : Element
	Purpose : creates elements for Login View

	By: Antonio Garcia
	Date : Oct 23 2014
/************************************************/

require_once("Element.class.php");


class LoginBodyElement extends Element
{
	public function printElement()
	{
		echo "<center>";
		$this->usernameAndPasswordBox();
		echo "</center>";
	}

	//sets view for log in credentials
	protected function usernameAndPasswordBox()
	{
		$this->skipLines(10);
		echo "Username: <br><input type='text' name='myUserName' size='20' value=''>";
		$this->skipLines(2);
		echo "Password: <br><input type='password' name='myPassword' size='20' value=''>";
		$this->skipLines(2);
		echo "<input type='submit' name='login' value='login'>";
		$this->skipLines(2);
		echo "<input type='submit' name='createNewUser' value='Create New User'>";
	}

	//silly little for loop to skip lines with a parameter 
	protected function skipLines($lines = 0)
	{
		for($i = 0; $i < $lines; $i++)
		{
			echo "<br>";
		}
	}
		
}

?>
