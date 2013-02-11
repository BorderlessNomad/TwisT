<?php
include('./config.php');
include('./functions.inc.php');
include('../classes/users.class.php');

//No Direct Access

if(isset($_GET['task']))
{	
	if($_GET['task'] == 'login')	//Email login check
	{
		$email = mysql_real_escape_string(trim(strtolower($_REQUEST['logemail'])));	//remove spaces and make lowercase
		$password = $_REQUEST['logpassword'];
		
		if(isset($email) && isset($password))	
		{			
			$valid = 'false';	//Email Incorrect
			
			$query = "select * from users where email='$email'";
			$result = mysql_query($query);
		
			if(mysql_num_rows($result))
			{				
				$row = mysql_fetch_array($result);	//Retrive data from row
				$logSalt = $row['salt'];	//Since email exists get SALT
				$logHPass = sha512($logSalt.$password.$email);	//Generate the Hashed Password same as generateHashedPass()
				
				if($logHPass == $row['password'])
				{					
					$_SESSION = array();	// Unset all of the session variables.
					if(isset($_SESSION['twistuser'])) {
						unset($_SESSION['twistuser']);
					}
					$_SESSION['twistuser']['id'] = $row['userid'];
					$_SESSION['twistuser']['email'] = $row['email'];
					$_SESSION['twistuser']['pass'] = $row['password'];
					$_SESSION['twistuser']['firstname'] = $row['firstname'];
					$_SESSION['twistuser']['lastname'] = $row['lastname'];
					if(isset($_SESSION['twistuser']['email']) && isset($_SESSION['twistuser']['pass']) && isset($_SESSION['twistuser']['firstname']) && isset($_SESSION['twistuser']['lastname']))
					{
						$makeonline = new Users();
						$makeonline->makeOnline($_SESSION['twistuser']['id']);
						$valid = 'true';	//Email and Password both Correct and Session SET
					}
					else
						$valid = 'false';	//Sessions are not set
				}
				else
					$valid = 'false';	//Email Correct but Password Incorrect
			}
			echo $valid;	
		}
	}
	
	else if($_GET['task'] == 'logout')	//Logout
	{
		$makeoffline = new Users();
		$makeoffline->makeOffline($_SESSION['twistuser']['id']);
		
		if(isset($_COOKIE['Twist_Auth_Email']) && isset($_COOKIE['Twist_Auth_Pass']))
		{
			setcookie("Twist_Auth_Email", "", time()-3600);	//Set for 1 Hour Ago
			unset($_COOKIE['Twist_Auth_Email']);
			setcookie("Twist_Auth_Pass", "", time()-3600);	//Set for 1 Hour Ago
			unset($_COOKIE['Twist_Auth_Pass']);
		}
		
		$_SESSION = array();
		session_destroy();
		header('Location: ../index.php'); 
	}
	
	else if($_GET['task'] == 'friend')	//Logout
	{
		$from = mysql_real_escape_string(trim(strtolower($_GET['from'])));	//remove spaces and make lowercase
		$to = mysql_real_escape_string(trim(strtolower($_GET['to'])));	//remove spaces and make lowercase
		$subject = $_GET['subject'];
		$message = $_GET['message'];
		$email = 'false';
		if(isset($_GET['from']) && isset($_GET['to']) && isset($_GET['subject']) && isset($_GET['message']))
		{
			$headers = 	"
			From: ".$from."\r\n
			Reply-To: ".$from."\r\n
			X-Mailer: PHP/".phpversion();
			mail($to, $subject, $message, $headers);
			$email = 'true';
		}		
		echo $email;
	}
	
	else	//No TASK specified
	{
		header('Location: ../index.php'); 
	}
}
else	//Coming Directly
	header('Location: ../index.php'); 
?>