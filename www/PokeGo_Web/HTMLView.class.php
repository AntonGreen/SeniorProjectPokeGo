<?php

//no changes were made

/************************************************/
/*                                              */
/* Class : HTMLView                             */
/* Inherits from : Base class                   */
/* Purpose : display an HTML web page;		*/
/*           elements may be contained in the	*/
/*           page by using the addElement method*/
/*           setTitle will set the title of the */
/*	     page that displays in the titlebar	*/
/*	     of the page.              		*/
/*                                              */
/* Author : m branton                           */
/* Date   : 3 Sept 2007                         */
/* Revisions :                                  */
/*	15 Oct: added javascript element	*/
/*		added DOCTYPE			*/
/*		added meta tag			*/
/*		added css			*/
/*	22 Oct:	allow multiple stylesheets	*/
/*						*/
/*	15 Sept 2014				*/
/*		default doctype is now html 5	*/
/*                                              */
/************************************************/

class HTMLView
{
	private $myElements;	// elements added to the page
	private $doctype;	// doc type info
	private $title;		// title for this webpage
	private $meta;		// meta tag content
	private $myCSS;		// stylesheet for page

	private $myJavascripts;	// names of javascript files to be included

	// create needed arrays for elements,javascripts and style sheets.
	// give defualt values for doctype and meta data
	public function __construct()
	{
		$this->myElements=array();
		$this->myJavascripts=array();
		$this->myCSS=array();
		$this->doctype='HTML';   	// default is html 5
		$this->meta='http-equiv="Content-Type" content="text/html; charset=utf-8"';				// default
	}

	// output the view
	public function printView()
	{
		$this->printDoctype();
		print("
		<html>
		");
		$this->printHead();
		$this->printBody();
		print("
		</html>
		");
	}

	public function setDoctype($doctype)
	{
		$this->doctype=$doctype;
	}

	public function getDoctype()
        {
                return $this->doctype;
        }

	protected function printDoctype()
	{
		if(isset($this->doctype))
		{
			print('
			<!DOCTYPE '.$this->doctype.' >
			');
		}
	}

	public function setMeta($meta)
	{
		$this->meta=$meta;
	}

	public function getMeta($meta)
        {
                return $this->meta;
        }

	protected function printMeta()
	{
		if(isset($this->meta))
		{
			print("
			<meta ".$this->meta." />
			");
		}
	}

	protected function printHead()
	{
		// you might want to allow this to be changed!
		print("
		<head dir='ltr' lang='en'>
		");

		$this->printMeta();
		$this->printCSS();
		$this->printTitle();
		$this->printJavascripts();

		print("
		</head>
		");
	}

	function addJavascript($script)
	{
		$this->myJavascripts[]=$script;
	}

	function printJavascripts()
	{
		if(isset($this->myJavascripts)) foreach($this->myJavascripts as $script)
		{
			print("
			<script language='Javascript' src='".$script."'>
			</script>
			");
		}
	}

	function addCSS($css)
        {
		$this->myCSS[]=$css;
	}

	function printCSS()
	{
		if(isset($this->myCSS)) foreach($this->myCSS as $css)
		{
			print("
			<link rel='STYLESHEET' type='text/css' href='".$css."'>
			");
		}
        }

	protected function printBody()
	{
		print("
		<body>
		");

		$this->printElements();

		print("
		</body>
		");
	}

	public function setTitle($title)
	{
		$this->title=$title;
	}

	protected function printTitle()
	{
		if(isset($this->title))
		{
			print("
	                <title>".$this->title."</title>
        	        ");
		}
	}

	public function addElement($element)
	{
		$this->myElements[]=$element;
	}

	protected function printElements()
	{
		if(count($this->myElements)>0)
		foreach($this->myElements as $element)
		{
			$element->printElement();
		}
	}
}
?>
