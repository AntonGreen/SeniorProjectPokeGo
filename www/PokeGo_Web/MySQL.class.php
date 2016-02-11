<?php

/************************************************/
/*                                              */
/* Class : MySQL                                */
/* Inherits from : mysqli                       */
/* Purpose : Extend this class to 		*/
/*	     to add needed queries		*/
/*                                              */
/* Author : m branton                           */
/* Date   : 20 Sept 2007                        */
/*                                              */
/* Revisions :                                  */
/*		20 Feb, 2013 change to using 	*/
/*		mysqli in place of mysql	*/
/*                                              */
/************************************************/

class MySQL extends mysqli
{
	private   $db;		// database we're using
	public    $data;	// data returned by query
	const	  TIMEOUT=5;	// connection timeout

	function __construct($db='')
	{
		include("globals.inc.php");

		// consturctor parameter takes priority
		if($db!='')
		{
			$this->db = $db;
		}
		elseif(isset($global_database))
		{
			$this->db = $global_database;
		}

		$this->data=array();
		
		//connect to database 
		$rc=$this->checkConnection($global_hostname);
		if($rc==1)
		{
			if(isset($this->db))
			{
				parent::__construct($global_hostname, $global_username, $global_password,$this->db,$global_port);
			}
			else // no database specified yet
			{
				parent::__construct($global_hostname, $global_username, $global_password);
			}
		}
                return $rc;
	}

	// check to see if server is there
	function checkConnection($hostname)
	{
		include("globals.inc.php");

	        // Connect to Database server
        	if($SocketTest = @fsockopen($hostname,$global_port , $errno, $errstr, self::TIMEOUT)) 
        	{
                	// server is responding 
                 	fclose($SocketTest); 
			return 1;
		}
		else
		{
			return 0;
		}
	}

	// choose database
	function setDB($db)
	{
		$this->db=$db;
		$this->select_db($this->db);
	}

    function storeResultAssoc($sql)
    {
        unset($this->data);
        $this->data=array();
        $this->appendResultAssoc($sql);
    }

    function storeResultNum($sql)
    {
        unset($this->data);
        $this->data=array();
        $this->appendResultNum($sql);
    }

    function storeResult($sql)
    {
	   unset($this->data);
	   $this->data=array();
	   $this->appendResult($sql);
    }

	function appendResultAssoc($sql)
    {
		$result = &$this->doRead($sql);
                if(($result!='')&&(count($result)>0)) 
                {
                        // store in associative array
                        while($row=$result->fetch_array(MYSQLI_ASSOC))
                        {
                                $temp=array($row);
                                $this->data=array_merge($this->data,$temp);
                        }
                }
                $result->free();
    }

	function appendResultNum($sql)
        {
		$result = &$this->doRead($sql);
                if(($result!='')&&(count($result)>0))
                {
                        // store in numerical array
                        while($row=$result->fetch_array(MYSQLI_NUM))
                        {
                                $temp=array($row);
                                $this->data=array_merge($this->data,$temp);
                        }
                }
                $result->free();
        }

        function appendResult($sql)
        {
		$result = &$this->doRead($sql);
                if(($result!='')&&(count($result)>0))
                {
                        // store in associative array
                        while($row=$result->fetch_array(MYSQLI_BOTH))
                        {
                                $temp=array($row);
                                $this->data=array_merge($this->data,$temp);
                        }
                }
                $result->free();
        }

	// used for updates and deletes
	function doQuery($sql)
        {
                $rc=$this->query($sql);
                return $rc;
        }

	// used for reads; note the return by reference so we can free the result set later 
        function &doRead($sql)
        {
                $result=$this->query($sql);
                return $result;
        }

	// inserts should return the primary key
        function doInsert($sql)
        {
                $result=mysqli_query($sql);
                return $this->insert_id;
        }
}
?>