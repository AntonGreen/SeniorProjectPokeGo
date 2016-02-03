<?php

//no changes were made

/************************************************/
/*						*/
/* Class : Element				*/
/* Inherits from : Base class			*/
/* Purpose : Extend this class to represent 	*/
/*	     HTML elements such as tables,	*/
/*	     forms, etc				*/
/*						*/
/* Author : m branton				*/
/* Date   : 6 Sept 2007				*/
/*						*/
/* Revisions : 					*/
/*	    18 Oct 2007 added name and id	*/
/*	    15 Sep 2009 use pass by reference	*/
/*	       for $data			*/
/*						*/
/*          18  Sept 2014                       */
/*              reverted last change due to     */              
/*              stupid change in strict use     */              
/*              concerning pass be reference    */              
/*              of the form f(g(x))             */
/*						*/
/************************************************/
	
abstract class Element
{

	protected $myElements;
	protected $name;
	protected $id;
	protected $style;
	protected $data;

	public function __construct(&$data='')
	{
		$this->myElements=array();
		if($data!='')
		{
			$this->data=$data;
		}
	}

	abstract public function printElement();

	public function addElement($element)
	{
		$this->myElements[]=$element;
	}

	public function setName($name)
	{
		$this->name=$name;
	}

	public function setID($id)
	{
		$this->id=$id;
	}

	public function setStyle($style)
	{
		$this->style=$style;
	}

	public function setData($data)
	{
		$this->data=$data;
	}
}
?>
