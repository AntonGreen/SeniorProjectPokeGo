<?php
/*
    Class
    Inherits from : Model
    Purpose : ins and outs for data to the view
    after being processed

    By: Antonio Garcia
    Date : Oct 23 2014
*/
require_once("Model.class.php");
require_once("pokeGOMySQL.class.php");

class CreateNewUserModel extends Model
{
    const NO_USER = 0;
    protected $myNEWUserName;
    protected $myNEWPassword;
    protected $myNEWCONFIRMPassword;
    protected $myUserExists;// bool
    protected $myUserID;
    public $mysql;
            
    public function process()
    {
        session_start();
        $mysql = new pokeGOMySQL();
		// check for name being passed in
		if(isset($this->inData['goBack']))
		{
             header("location:LoginController.php");
		}
        else if(isset($this->inData['submitUser']))
        {
            header("location:CreateNewUserController.php");

            $this->myNEWUserName = $this->inData['myNEWUserName'];
            $this->myNEWPassword = $this->inData['myNEWPassword'];
            //$this->myNEWCONFIRMPassword = $this->inData['myNEWCONFIRMPassword'];

            //$_SESSION['myNEWCONFIRMPassword'] = $this->inData['myNEWCONFIRMPassword'];
            $_SESSION['myNEWPassword'] = $this->inData['myNEWPassword'];
            $_SESSION['myNEWUserName'] = $this->inData['myNEWUserName'];
         
            //$this->outData['myNEWCONFIRMPassword'] = $_SESSION['myNEWCONFIRMPassword'];
            $this->outData['myNEWPassword'] = $_SESSION['myNEWPassword'];
            $this->outData['myNEWUserName'] = $_SESSION['myNEWUserName'];

            $this->addUser($mysql);
        }
		else
		{

			// initialize a new session array, this is if the page is refreshed
			session_destroy();
			//if the session_destroy does not destroy the session
			//this will force all $_SESSION into a new array
			$_SESSION=array();
		}

    }

    //adds user for database
    protected function addUser($mysql)
    {
      
        $mysql->addUser($this->myNEWUserName , $this->myNEWPassword);
        echo "User is added<br>";
            
        
    }
   
}
?>