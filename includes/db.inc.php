<?php
/*Define constant to connect to database */
DEFINE('DATABASE_HOST', 'localhost');
DEFINE('DATABASE_USER', 'root');
DEFINE('DATABASE_PASSWORD', '');
DEFINE('DATABASE_NAME', 'twist2');

// Make the connection:
$connect = mysql_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD);
if (!$connect)
{
	die('Could not connect: ' . mysql_error());
}
mysql_select_db(DATABASE_NAME, $connect) or die('Could not select: ' . mysql_error()); 

?>