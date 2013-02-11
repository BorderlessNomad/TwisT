<?php
/* updates Connector Class */
class Updates {
	function addUserInUpdate($userId) {
		//Code for adding new user to the system
		$timestamp = date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']);
		$query = "INSERT INTO updates (userid, update1 , time1, update2 , time2, update3 , time3, update4 , time4, update5 , time5, update6 , time6, update7 , time7, update8 , time8, update9 , time9, update10 , time10, update11 , time11, update12 , time12) VALUES ('$userId', '','$timestamp', '','$timestamp', '','$timestamp', '','$timestamp', '','$timestamp', '','$timestamp', '','$timestamp', '','$timestamp', '','$timestamp', '','$timestamp', '','$timestamp', '','$timestamp') ";
		mysql_query($query) or die();
	}
	
	function ShowUpdatesForUser($userId)
	{
		// Returns an object with 12 updates n their timeStamp.
		$query = "SELECT * FROM  updates WHERE userid = $userId";
		$result = mysql_query($query) or die();
		while($row = mysql_fetch_array($result))
		{
			if($row['update1'] != '')
			{
				$j[1]=$row['update1'];
				$j[2]=$row['time1'];
			}
			else
			{
				$j[1]=' ';
				$j[2]=' ';
			}
			if($row['update2'] != '')
			{
				$j[3]=$row['update2'];
				$j[4]=$row['time2'];
			}
			else
			{
				$j[3]=' ';
				$j[4]=' ';
			}
			if($row['update3'] != '')
			{
				$j[5]=$row['update3'];
				$j[6]=$row['time3'];
			}
			else
			{
				$j[5]=' ';
				$j[6]=' ';
			}
			if($row['update4'] != '')
			{
				$j[7]=$row['update4'];
				$j[8]=$row['time4'];
			}
			else
			{
				$j[7]=' ';
				$j[8]=' ';
			}
			if($row['update5'] != '')
			{
				$j[9]=$row['update5'];
				$j[10]=$row['time5'];
			}
			else
			{
				$j[9]=' ';
				$j[10]=' ';
			}
			if($row['update6'] != '')
			{
				$j[11]=$row['update6'];
				$j[12]=$row['time6'];
			}
			else
			{
				$j[11]=' ';
				$j[12]=' ';
			}
			if($row['update7'] != '')
			{
				$j[13]=$row['update7'];
				$j[14]=$row['time7'];
			}
			else
			{
				$j[13]=' ';
				$j[14]=' ';
			}
			if($row['update8'] != '')
			{
				$j[15]=$row['update8'];
				$j[16]=$row['time8'];
			}
			else
			{
				$j[15]=' ';
				$j[16]=' ';
			}
			if($row['update9'] != '')
			{
				$j[17]=$row['update9'];
				$j[18]=$row['time9'];
			}
			else
			{
				$j[17]=' ';
				$j[18]=' ';
			}	
			if($row['update10'] != '')
			{
				$j[19]=$row['update10'];
				$j[20]=$row['time10'];
			}
			else
			{
				$j[19]=' ';
				$j[20]=' ';
			}
			if($row['update11'] != '')
			{
				$j[21]=$row['update11'];
				$j[22]=$row['time11'];
			}
			else
			{
				$j[21]=' ';
				$j[22]=' ';
			}	
			if($row['update12'] != '')
			{
				$j[23]=$row['update12'];				
				$j[24]=$row['time12'];	
			}
			else
			{
				$j[23]=' ';
				$j[24]=' ';
			}					
		}
		return $j; 
	}
}
?>