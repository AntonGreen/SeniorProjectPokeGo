<?php

//no changes were made

/************************************************/
/*						*/
/* Class : FormElement				*/
/* Inherits from : Element.class		*/
/* Purpose : display a form in a web page; 	*/
/*	     both the form action and		*/
/*	     submit method may be set		*/
/*	     default submit method is POST	*/
/*	     default action is to return to the */
/*	     same page				*/
/*						*/
/* Author : m branton				*/
/* Date   : 3 Sept 2007				*/
/* Revisions : 					*/
/*	15 OCt 2007				*/
/*		added onSubmit			*/
/*						*/
/************************************************/
	
require_once("Element.class.php");

class FormElement extends Element
{

	protected $action;	// the form's action. default is to return to current page
	protected $method;	// the form's submit method. default is POST
	protected $onsubmit;	// action to take before form is submitted

	public function __construct()
	{
		parent::__construct();
		$this->setMethod('post');
		$this->setAction('');
	}

	public function printElement()
	{
		isset($this->name)?$name=" name='".$this->name."' ":$name="";
		isset($this->id)?$id=" id='".$this->id."' ":$id="";
		isset($this->onsubmit)?$onsubmit=" onsubmit='".$this->onsubmit."' ":$onsubmit="";
		print("
		<form action='".$this->action."' method='".$this->method."' ".$name.$id.$onsubmit.">
		");

		if(count($this->myElements)>0)
		foreach($this->myElements as $element)
		{
			$element->printElement();
		}

		print("
		</form>
		");
	}

	public function setMethod($method)
	{
		$this->method=$method;
	}

	public function setAction($action)
	{
		$this->action=$action;
	}

	public function setOnsubmit($onsubmit)
	{
		$this->onsubmit=$onsubmit;
	}
}
?>
