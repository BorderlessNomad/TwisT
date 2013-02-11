<?php
include('functions.inc.php');

if(isset($_POST['emailcheck']))	//Checking Email for Uniqueness
{
	$email = mysql_real_escape_string($_POST['emailcheck']);
}

$result = mysql_query("SELECT * FROM users WHERE email = '$email'");

if(mysql_num_rows($result))
{
	echo '1';	//If there is a record match in the Database - Not Available
}
else
{
	echo '0';	//No Record Found - Email is available
}
?>