<?php
/*
    Class: LoginModel
    Inherits from : Model
    Purpose : ins and outs for data to the view
    after being processed

    By: Antonio Garcia
    Date : Oct 23 2014
*/
require_once("Model.class.php");
//require_once("AcmeMySQL.class.php");

class LoginModel extends Model
{
    const NO_USER = 0;
    const CEO_USER = 1;
    const ORDERER_USER = 2;
    const SALES_USER = 3;
    protected $myUserName;
    protected $myPassword;//string? or hash?
    protected $myUserType = LoginModel::NO_USER;
    protected $myUserExists;// bool
    protected $myUserID;
    public $mysql;
            
    public function process()
    {
        session_start();
        //$mysql = new AcmeMySQL();
		// check for name being passed in
		if(isset($this->inData['login']))
		{
             header("location:CreateNewUserController.php");
            //  $this->myUserName = $this->inData['myUserName'];
            //  $this->myPassword = $this->inData['myPassword'];

            //  $_SESSION['myPassword'] = $this->inData['myPassword'];
            //  $_SESSION['myUserName'] = $this->inData['myUserName'];
         
            // $this->outData['myPassword'] = $_SESSION['myPassword'];
            // $this->outData['myUserName'] = $_SESSION['myUserName'];

            //$this->setGUILocation($mysql);
	
		}
        else if(isset($this->inData['createNewUser']))
        {
            header("location:CreateNewUserController.php");
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

// checks if user exists
    protected function checkMyUser($mysql)
    {
        //bool to check if user and pass is correct then it will get the type

        if(!($mysql->checkLogin($this->myUserName, $this->myPassword) == ''))
        {
            $this->myUserID = $mysql->checkLogin($this->myUserName, $this->myPassword);
            $this->myUserExists = true;
            return $this->myUserExists;
        }
        $this->myUserExists = false;
        return $this->myUserExists;
    }

    //gets 1,2 or 3 which is CEO, orderer, sales user respectivly
    //or not user
    protected function getUserTypeNum($mysql)
    {
        $this->checkMyUser($mysql);
        if($this->myUserExists);
        {
            $this->myUserType = $mysql->getUserType($this->myUserID);
            return $this->myUserType;
        }
        $this->myUserType = LoginModel::NO_USER;
        return $this->myUserType;

    }

    //sets a header based on the user type during the session
    //while not refressed the session remains 
    protected function setGUILocation($mysql)
    {
        //getting the db user  type you can find out where to send the user
        $this->getUserTypeNum($mysql);
        $myHeaderLocation;
        if($this->myUserType == LoginModel::CEO_USER)
        {
            $myHeaderLocation = "CeoController.php";
        }
        else if($this->myUserType == LoginModel::ORDERER_USER)
        {
            $myHeaderLocation = "OrdererController.php";
        }
        else if($this->myUserType == LoginModel::SALES_USER)
        {
            $myHeaderLocation = "SalesController.php";
        }
        else if($this->myUserType == LoginModel::NO_USER)
        {
            $myHeaderLocation = "LoginController.php";
        }
        header("location:$myHeaderLocation");
    }     
}
?>