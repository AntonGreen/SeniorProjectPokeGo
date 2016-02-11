<?php
/************************************************/
/*                                              */
/* Class: BodyElement
	Inherits from : Element
	Purpose : creates elements for View

	By: Antonio Garcia
	
/************************************************/

require_once("Element.class.php");


class CreateNewUserBodyElement extends Element
{
	public function printElement()
	{
		echo "<center>";
		$this->View();
		echo "</center>";
	}

	//sets view for log in credentials
	protected function View()
	{
		$this->skipLines(10);
		echo "Username: <br><input type='text' name='myNEWUserName' size='20' value=''>";
		$this->skipLines(2);
		echo "Password: <br><input type='password' name='myNEWPassword' size='20' value=''>";
		$this->skipLines(2);
		echo "Confirm Password: <br><input type='password' name='myNEWCONFIRMPassword' size='20' value=''>";
		$this->skipLines(2);
		echo "<input type='submit' name='submitUser' value='Submit'>";
		$this->skipLines(2);
		echo "<input type='submit' name='goBack' value='Go Back'>";
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
