<?php
include('db.inc.php');

function checkLogin()
{
	/* Check if user has been remembered */
   /*if(isset($_COOKIE['Twist_Auth_Email']) && isset($_COOKIE['Twist_Auth_Pass'])) 
   {
		echo $_SESSION['twistuser']['email'] = $_COOKIE['Twist_Auth_Email'];
		echo $_SESSION['twistuser']['pass'] = $_COOKIE['Twist_Auth_Pass'];
   }*/
   
   /* Username and password have been set */
   if(isset($_SESSION['twistuser']['email']) && isset($_SESSION['twistuser']['pass']))
   {
      	/* Confirm that username and password are valid */
      	if(!checkEmailPass($_SESSION['twistuser']['email'], $_SESSION['twistuser']['pass']))
		{
         	/* Variables are incorrect, user not logged in */
         	unset($_SESSION['twistuser']['email']);
         	unset($_SESSION['twistuser']['pass']);
         	return false;
      	}
      	else
			return true;	//All correct Allow Login
   }
   else
		return false;	/* User not logged in */
}


/* Email Exist Check */
function checkEmailExist($email)
{
	$result = mysql_query("SELECT * FROM users WHERE email = '$email'");

	if(mysql_num_rows($result))
		return true;	//If there is a record match in the Database - Not Available
	else
		return false;	//No Record Found - Username is available
}

function checkEmailPass($email, $hPass)
{
	$result = mysql_query("SELECT * FROM users WHERE email = '$email'");

	if(mysql_num_rows($result))
	{
		$row = mysql_fetch_array($result);	//Retrive data from row	
			
		if($hPass == $row['password'])
			return true;
		else
			return false;	//Email Correct but Incorrect Password
	}
	else
		return false;	//No Record Found - Username is available
}

function checkEmailLogin($email, $pass)
{
	$result = mysql_query("SELECT * FROM users WHERE email = '$email'");

	if(mysql_num_rows($result))
	{
		$row = mysql_fetch_array($result);	//Retrive data from row
		
		$logSalt = $row['salt'];	//Since email exists get SALT
		$logHPass = sha512($logSalt.$pass.$email);	//Generate the Hashed Password same as generateHashedPass()
		
		if($logHPass == $row['password'])
			return true;
		else
			return false;	//Email Correct but Incorrect Password
	}
	else
		return false;	//No Record Found - Username is available
}

/* SHA 512 Hash */
function sha512($value)
{
	return hash("sha512",$value);
}

/* Generate Hased Password */
function generateHashedPass($email, $password)
{
    $_SESSION['registeruser']['salt'] = sha512(uniqid(mt_rand())); 					// Create a salt based off the time, prefixed with a random number.
	$_SESSION['registeruser']['hpass'] = sha512($_SESSION['registeruser']['salt'].$password.$email); 	// Generate the hash from password and salt.
}

/* Generate Dates */
function generateMonth()
{
	for($i=1; $i<=12; $i++)
	{
		$month = date('F',mktime(0,0,0,$i,1));
		echo "<option value='$i' label='$month'>$month</option>";
	}
}
function generateDay()
{
	for($i=1; $i<=31; $i++)
	{
		echo "<option value='$i' label='$i'>$i</option>";
	}
}
function generateYear()
{
	for($i=date('Y'); $i>1900; $i--)
	{
		echo "<option value='$i' label='$i'>$i</option>";
	}
}

function getPageTitle()
{
	echo $_SESSION['pagetitle'];
}
function setPageTitle($title)
{
	$_SESSION['pagetitle'] = "<title>".$title."</title>";
}

function getCategories($userID) {
	//Display the list of all Categories for user
	$query = "SELECT * FROM categories";
	$result = mysql_query($query);
	$cats = array();
	$i = 1;
	while($row = mysql_fetch_array($result))
	{
		$cats[$i]['id'] = $row['categoryid'];
		$cats[$i]['name'] = $row['categoryname'];
		$cats[$i]['subscribe'] = '';
		$catObj = new Categories();
		if($catObj->isSubscribed($row['categoryid'], $_SESSION['twistuser']['id']))
		{
			$cats[$i]['subscribe'] = 'checked';
		}
		$i++;
	}
	return $cats;
}

function getCategoryList()	//Retrive all categories
{
	$catObj = new Categories();
	$catlist = $catObj->listCategories();
	foreach($catlist as $catid)
	{
		$categoryList[$catid]['id'] = $catid;
		$categoryList[$catid]['name'] = $catObj->getCategoryData($catid, 'categoryname');
		$categoryList[$catid]['totalarticles'] = $catObj->countCatArticles($catid);
		$categoryList[$catid]['totalsubscribe'] = $catObj->countCatSubscribe($catid);
		$categoryList[$catid]['totalikes'] = $catObj->countCatLikes($catid);
	}
	return $categoryList;
}

function catTitle($catID)
{
	$catObj = new Categories();
	$catName = $catObj->getCategoryFromID($catID);
	echo $catName;
}

function getArticleList($catid)	//Retrive all articles of category
{
	$contentObj = new Content();
	$article = $contentObj->getContentArticles($catid);
	for($i=0;$i<count($article);$i++)
	{
		$artid = $article[$i];
		$articleList[$i]['id'] = $artid;
		$articleList[$i]['title'] = $contentObj->getContentData($artid, 'title');
		$articleList[$i]['description'] = $contentObj->getContentData($artid, 'description');
		$articleList[$i]['views'] = $contentObj->getContentData($artid, 'views');
		$articleList[$i]['likes'] = $contentObj->getContentData($artid, 'likes');
	}
	return $articleList;
}

function myBuddies($userid)
{
	$buddyObj = new Buddies();
	$buddies = $buddyObj->listBuddies($userid);
	if(!empty($buddies))
	{
		$userObj = new Users();
		$buddyData = array();
	
		foreach($buddies as $buddyID)
		{
			$buddyData[$buddyID]['photo'] = $userObj->getProfileData($buddyID, 'photo');
			$buddyData[$buddyID]['fname'] = $userObj->getProfileData($buddyID, 'firstname');
			$buddyData[$buddyID]['lname'] = $userObj->getProfileData($buddyID, 'lastname');
		}
		return $buddyData;
	}
}

function myOnlineBuddies($userid)
{
	$buddyObj = new Buddies();
	$buddies = $buddyObj->listOnlineBuddies($userid);
	if(!empty($buddies))
	{
		$userObj = new Users();
		$buddyData = array();
	
		foreach($buddies as $buddyID)
		{
			$buddyData[$buddyID]['photo'] = $userObj->getProfileData($buddyID, 'photo');
			$buddyData[$buddyID]['fname'] = $userObj->getProfileData($buddyID, 'firstname');
			$buddyData[$buddyID]['lname'] = $userObj->getProfileData($buddyID, 'lastname');
		}
		return $buddyData;
	}
}

?>