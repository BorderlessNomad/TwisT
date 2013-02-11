<?php
/* Class for Categories
List of functions
	* addNewCategory($categoryName, $categoryParent = 0)
	* editCategory($categoryID, $categoryName = NULL, $categoryParent = NULL)
	* removeCategory($categoryID)
	* getCategoryFromID($catID)
	* getCategoryData($catID, $data)
	* countCatArticles($catID)
	* countCatLikes($catID)
	* 

*/

class Categories {
	
	function addNewCategory($categoryName, $categoryParent = 0) {
		//Code for adding new category to the system
		//Default Parent Category is ROOT i.e. No Parent
		$timestamp = date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']);
		$query = "INSERT INTO categories (categoryparent,categoryname,datecreated) VALUES ('$categoryParent','$categoryName','$timestamp')";
		mysql_query($query) or die();
	}
	
	function editCategory($categoryID, $categoryName = NULL, $categoryParent = NULL) {
		//Code for editing an existing category from the system
		//Category must EXIST
		$timestamp = date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']);
		$query = "UPDATE categories SET categoryparent = '$categoryParent',categoryname = '$categoryName',datecreated = '$timestamp' WHERE categoryid = '$categoryID'";
		mysql_query($query) or die();
	}
	
	function removeCategory($categoryID) {
		//Code for removing an existing category from the system
		//Category must EXIST
		//Removing a Category will also delete Items under it.
		$query = "DELETE FROM categories WHERE categoryid = '$categoryID'";
		$query = "DELETE FROM content WHERE categoryid = '$categoryID'";
		mysql_query($query) or die();
	}
	
	function getCategoryFromID($catID)
	{
		$query = "SELECT * FROM categories WHERE categoryid='$catID'";
		$result = mysql_query($query);
		
		while($row = mysql_fetch_array($result))
		{
			return $row['categoryname'];
		}		
	}
	
	function getCategoryData($catID, $data)
	{
		$query = "SELECT ".$data." FROM categories WHERE categoryid = '$catID'";
		$result = mysql_query($query);
		
		while($row = mysql_fetch_array($result))
		{
			$catData = $row['categoryname'];
		}
		return $catData;		
	}
	
	function countCatArticles($catID)
	{
		$contentObj = new Content();
		$articleCount = $contentObj->getContentArticles($catID);
		return count($articleCount);
	}
	
	function countCatLikes($catID)
	{
		$contentObj = new Content();
		return $contentObj->getContentArticleLikes($catID);
	}
	
	function countCatSubscribe($catID) {
		//Return count of subscribed for category
		$query = "SELECT * FROM interests WHERE categoryid='$catID'";
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result))
		{
			$listcat[] = $row['categoryid'];
		}
		return count($listcat);
	}
	
	function listCategories() {
		//Display the list of all Categories in Hierarchical pattern
		$query = "SELECT * from categories";
		$result = mysql_query($query);
		
		$i = 0;
		while($row = mysql_fetch_array($result))
		{
			$cats[] = $row['categoryid'];
		}
		return $cats;
	}
	
	function getSubscribed($userid) {
		//Return list of subscribed categories for user
		$query = "SELECT * FROM interests WHERE userid='$userid'";
		$result = mysql_query($query);
		$listcat = array();
		while($row = mysql_fetch_array($result))
		{
			$listcat[] = $row['categoryid'];
		}
		return $listcat;
	}
	
	function isSubscribed($catid, $userid) {
		//Return true of Category is subscribed by user
		$query = "SELECT * from interests WHERE userid='$userid' AND categoryid='$catid'";
		$result = mysql_query($query);
		
		if(mysql_num_rows($result))
			return true;
		else
			return false;
	}
	
	function removeSubscribed($catid, $userId) {
		//Return true of Category is subscribed by user
		$query = "DELETE from interests WHERE userid='$userId' AND categoryid='$catid'";
		mysql_query($query) or die();
	}
	
	function addSubscribe($catid, $userId) {
		//Return true of Category is subscribed by user
		$timestamp = date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']);
		if($this->isSubscribed($catid, $userId))
		{
			echo "you are Already subscribed to this Category";
		}
		else
		{
			$query = "INSERT INTO interests (userid,categoryid,datecreated) VALUES ('$userId','$catid','$timestamp')";
			mysql_query($query) or die();
			$query = "SELECT * FROM users WHERE userid = '$userId'";
			$result = mysql_query($query) or die();
			while($row = mysql_fetch_array($result))
			{
				$userName = $row['firstname'].' '.$row['lastname'];
			}
			$query = "SELECT * from categories WHERE categoryid='$catid'";
			$result = mysql_query($query);
			while($row = mysql_fetch_array($result))
			{
				$catName = $row['categoryname'];
			}
			$this->updateFrom($userId,'<a href=user.php?id='.$userId.' >'.$userName.'</a> has subscribed to <a href="categories.php?id='.$catid.'"> '.$catName.'</a> ',$timestamp);
		}
	}
	
	function removeSubscribe($catid, $userId) {
		$query = "DELETE FROM interests WHERE userid = '$userId' AND categoryid = '$catid'";
		$result = mysql_query($query) or die();
	}
	
	function changeSubscribe($catList, $userid)
	{
		for($i=0;$i<count($catList);$i++)
		{
			if($catList[$i] == '0' && $this->isSubscribed($i+1,$userid))
				$this->removeSubscribed($i+1,$userid);
			else if($catList[$i] == '1' && !$this->isSubscribed($i+1,$userid))
				$this->addSubscribe($i+1, $userid);			
		}
	}

	function updateFrom($userID,$content,$timeStamp){
		$query = "SELECT * from buddies WHERE (sourceid = '$userID' OR destinationid = '$userID') AND accepted = 1";
		$result = mysql_query($query);
		$i=0;
		while($row = mysql_fetch_array($result))
		{
			if($row['sourceid'] == $userID)
			{
				$buddies[$i] = $row['destinationid'];
				$i = $i + 1;
			}
			else
			{
				$buddies[$i] = $row['sourceid'];
				$i = $i + 1;
			}
		}
		for($i=0;$i<count($buddies);$i++)
		{
		$this->addNewUpdate($buddies[$i],$content,$timeStamp);
		}
	}

	function addNewUpdate($userId,$update,$timestamp) 
	{
		// shifts updates
		$query = "SELECT * FROM  updates WHERE userid = $userId";
		$result = mysql_query($query) or die();
		while($row = mysql_fetch_array($result))
		{
				$j[1]=$row['update1'];
				$j[2]=$row['update2'];
				$j[3]=$row['update3'];
				$j[4]=$row['update4'];
				$j[5]=$row['update5'];
				$j[6]=$row['update6'];
				$j[7]=$row['update7'];
				$j[8]=$row['update8'];
				$j[9]=$row['update9'];
				$j[10]=$row['update10'];
				$j[11]=$row['update11'];
				$j[12]=$row['update12'];
				$k[1]=$row['time1'];
				$k[2]=$row['time2'];
				$k[3]=$row['time3'];
				$k[4]=$row['time4'];
				$k[5]=$row['time5'];
				$k[6]=$row['time6'];
				$k[7]=$row['time7'];
				$k[8]=$row['time8'];
				$k[9]=$row['time9'];
				$k[10]=$row['time10'];
				$k[11]=$row['time11'];
				$k[12]=$row['time12'];
		}
		$query = "UPDATE updates SET update1 = '$update', time1 = '$timestamp', update2 = '$j[1]', time2 = '$k[1]', update3 = '$j[2]', time3 = '$k[2]', update4 = '$j[3]', time4 = '$k[3]', update5 = '$j[4]', time5 = '$k[4]', update6 = '$j[5]', time6 = '$k[5]', update7 = '$j[6]', time7 = '$k[6]', update8 = '$j[7]', time8 = '$k[7]', update9 = '$j[8]', time9 = '$k[8]', update10 = '$j[9]', time10 = '$k[9]', update11 = '$j[10]', time11 = '$k[10]', update12 = '$j[11]', time12 = '$k[11]' WHERE userid = '$userId'";
		mysql_query($query) or die(); 	
	}
}
?>