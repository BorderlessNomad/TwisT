<?php
/* Databse Connector Class */
class Database 
{
	function Database() 
	{
		//Default Constructor for Database
	}
	
	function dbConnect($dbHost, $dbUser, $dbPass, $dbName) 
	{
		//Connect to the database
		$connect = mysql_connect($dbHost,$dbUser,$dbPass);
		if (!$connect) 
		{
	  		die('Could Not Connect: ' . mysql_error());
	  	}
		
		mysql_select_db($dbName, $connect);
	}
	
	function dbQuery()
	{
		//Run any query
	}
}
?>