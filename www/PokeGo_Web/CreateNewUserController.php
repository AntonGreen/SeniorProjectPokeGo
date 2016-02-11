<?php
/*
	Class: CreateNewUserController

	By: Antonio Garcia
	Date : Oct 23 2014
*/
// GUI error out put 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
require_once("CreateNewUserModel.class.php");
require_once("HTMLView.class.php");
require_once("FormElement.class.php");
require_once("CreateNewUserBodyElement.class.php");

	$myModel = new CreateNewUserModel();
	$myModel->setData($_POST);

	$myModel->process();

	$myBodyEle = new CreateNewUserBodyElement();
	$myBodyEle->setData($myModel->getData());

	$myFormEle = new FormElement();
	//adds bodyelements to form
	$myFormEle->addElement($myBodyEle);

	$myView = new HTMLView();
	//adds form to html element
	$myView->addElement($myFormEle);
	//print form with bodyelement with element in that
	$myView->printView();

?>
