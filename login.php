<?php
include('./includes/functions.inc.php');

//No Direct Access

if(isset($_GET['task']))
{	
	if($_GET['task'] == 'logemail')	//Email login check
	{
		$email = mysql_real_escape_string(trim(strtolower($_GET['logemail'])));	//remove spaces and make lowercase
		$password = $_GET['logpassword'];
		
		if(isset($email) && isset($password))	
		{			
			$valid = 'false';
			
			$query = "select * from users where email='$email'";
			$result = mysql_query($query);
		
			if(mysql_num_rows($result))
			{				
				$row = mysql_fetch_array($result);	//Retrive data from row
				$logSalt = $row['salt'];	//Since email exists get SALT
				$logHPass = sha512($logSalt.$password.$email);	//Generate the Hashed Password same as generateHashedPass()
				
				if($logHPass == $row['password'])
				{
					$_SESSION['loginuser']['email'] = $row['email'];
					$_SESSION['loginuser']['firstname'] = $row['firstname'];
					$_SESSION['loginuser']['lastname'] = $row['lastname'];
					
					$valid = 'true';	//Email and Password both Correct
				}
				else
					$valid = 'false';	//Email Correct but Password Incorrect
			}
			echo $valid;	//Email Incorrect
		}
	}
	
	if($_GET['task'] == 'logout')	//Logout
	{
		session_destroy();
		echo "<meta http-equiv='Refresh' content='0; url=index.php'>";
	}
}
else
	echo "No Direct Access";
?>