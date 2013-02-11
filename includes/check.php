<?php
include('functions.inc.php');

//No Direct Access

if(isset($_GET['task']))
{
	if($_GET['task'] == 'email')	//Email register check
	{
		$request = trim(strtolower($_REQUEST['email']));	//remove spaces and make lowercase
		if(isset($request))	
		{
			$email = mysql_real_escape_string($request);
			
			$valid = 'true';
			
			$query = "select * from users where email='$email'";
			$result = mysql_query($query);
		
			if(mysql_num_rows($result))
				$valid = 'false';	//If there is a record match in the Database - Not Available
			echo $valid;
		}
	}
	else if($_GET['task'] == 'profileupdate')	//Email register check
	{
	}
}
else
	echo "No Direct Access";
?>