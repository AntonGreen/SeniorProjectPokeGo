<?php
/*
	Class: LoginController
	Purpose : creates elements for Login View

	By: Antonio Garcia
	Date : Oct 23 2014
*/
// GUI error out put 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
require_once("LoginModel.class.php");
require_once("HTMLView.class.php");
require_once("FormElement.class.php");
require_once("LoginBodyElement.class.php");

	$myAcmeModel = new LoginModel();
	$myAcmeModel->setData($_POST);

	$myAcmeModel->process();

	$myAcmeBodyEle = new LoginBodyElement();
	$myAcmeBodyEle->setData($myAcmeModel->getData());

	$myFormEle = new FormElement();
	//adds bodyelements to form
	$myFormEle->addElement($myAcmeBodyEle);

	$myView = new HTMLView();
	//adds form to html element
	$myView->addElement($myFormEle);
	//print form with bodyelement with element in that
	$myView->printView();

?>