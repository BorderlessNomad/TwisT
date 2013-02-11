<?php
/* Class for Users */
class Users {
	
	function addNewUser($email, $password, $salt, $firstname, $lastname) {
		//Code for adding new user to the system
		$timestamp = date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']);
		$query = "INSERT INTO users (email,password,salt,firstname,lastname,datecreated) VALUES ('$email','$password','$salt','$firstname','$lastname','$timestamp')";
		mysql_query($query) or die();
		
		return mysql_insert_id();	//Return userid for created user
	}
		
	function editUser($userID, $email = NULL, $password = NULL, $salt = NULL) {
		//Code for editing an existing user from the system
		//User must EXIST
		$timestamp = date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']);
		$query = "UPDATE users SET email = '$email',password = '$password',salt = $salt,datecreated = '$timestamp' WHERE userid = '$userID'";
		mysql_query($query) or die();
	}

	function removeUser($userID)
	{
		//From Buddies
		$query1 = "DELETE FROM buddies WHERE sourceid = '$userID' OR destinationid = '$userID'";
		mysql_query($query1) or die();
		//From interests
		$query2 = "DELETE FROM interests WHERE userid = '$userID'";
		mysql_query($query2) or die();
		//From Profile
		$query3 = "DELETE FROM profile WHERE userid = '$userID'";
		mysql_query($query3) or die();
		//From Suggestions
		$query4 = "DELETE FROM suggestions WHERE sourceid = '$userID' OR destinationid = '$userID'";
		mysql_query($query4) or die();
		//From Updates
		$query5 = "DELETE FROM updates WHERE userid = '$userID'";
		mysql_query($query5) or die();
		//From Users
		$query6 = "DELETE FROM users WHERE userid = '$userID'";
		mysql_query($query6) or die();
		//From Visited
		$query7 = "DELETE FROM visited WHERE userid = '$userID'";
		mysql_query($query7) or die();
	}
	
	function initProfile($userID)
	{
		//Initialize user profile
		$timestamp = date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']);
		$query = "INSERT INTO profile (userid) VALUES ('$userID')";
		mysql_query($query) or die();
		$userUpdate = new Updates();
		$userSuggest = new Suggestions();
		$userUpdate->addUserInUpdate($userID);
		$userSuggest->addUserInSuggestion($userID);
	}
	
	/*function updateProfile($userID, $firstName = NULL, $lastName = NULL, $gender = NULL, $birthDate = NULL, $website = NULL, $twitter = NULL, $facebook = NULL, $skype = NULL, $secEmail = NULL, $about = NULL) {
		//Update user profile
		$timestamp = date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']);
		$query = "UPDATE profile SET firstname = '$firstName',lastname = '$lastName',gender = $gender,birthdate = '$birthDate',website = '$website',twitter = '$twitter',facebook = '$facebook',skype = '$skype',secEmail = '$secEmail',about = '$about',datecreated = '$timestamp' WHERE userid = '$userID'";
		mysql_query($query) or die();
	}**/
	
	function updateProfile($userID, $data, $value)
	{
		//Update user profile
		$timestamp = date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']);
		$query = "UPDATE profile SET ".$data." = '$value', lastupdate = '$timestamp' WHERE userid = $userID";
		mysql_query($query) or die();
	}
	
	function makeOnline($userID) {
		$query = "UPDATE users SET online = 1 WHERE userid = '$userID'";
		mysql_query($query) or die();
	}
	
	function makeOffline($userID) {
		$query = "UPDATE users SET online = 0 WHERE userid = '$userID'";
		mysql_query($query) or die();
	}
	
	function listUsers() {
		//Display the list of all Users.
		$query = "SELECT * from users";
		$result = mysql_query($query);
		
		while($row = mysql_fetch_array($result))
		{
			echo "<option value=".$row['username'].">".$row['email']."</option>";
		}
	}
	
	function getProfileData($userid, $data) {
		$query = "SELECT ".$data." FROM profile WHERE userid = '$userid'";
		$result = mysql_query($query);
		
		while($row = mysql_fetch_array($result))
		{
			$profileData =  $row[$data];
		}
		return $profileData;				
	}
}
?>