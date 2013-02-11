<?php
/* Class for Content */


class Content
{
	
	function addNewContent($contentCategory, $contentTitle, $contentDescription, $contentSource = 0) {
		//Code for adding new content to the system
		//Add TimeStamp
		//Sourcr modifiefd from db
		$timestamp = date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']);
		$query = "INSERT INTO content (categoryid, title, description , datecreated) VALUES ('$contentCategory','$contentTitle', '$contentDescription', '$timestamp')";
		mysql_query($query) or die();
	}
	
	function editContent($contentID, $contentTitle = NULL, $contentDescription = NULL, $contentSource = NULL) {
		//Code for editing an existing content from the system
		//Content must EXIST
		$timestamp = date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']);
		$query = "UPDATE content SET title = '$contentTitle',description = '$contentDescription',datecreated = '$timestamp' WHERE contentid = '$contentID'";
		mysql_query($query) or die();
	}
	
	function removeContent($contentID) {
		//Code for removing an existing content from the system
		//Content must EXIST
		$query = "DELETE FROM content WHERE contentid = '$contentID'";
		mysql_query($query) or die();
	}
	
	function getContentArticles($catID)
	{
		$query = "SELECT * FROM content WHERE categoryid = '$catID' ORDER BY datecreated DESC";
		$result = mysql_query($query) or die();
		while($row = mysql_fetch_array($result))
		{
			$articleContent[] = $row['contentid'];
		}
		return $articleContent;
	}
	
	function getContentData($articleID, $data)
	{
		$query = "SELECT ".$data." FROM content WHERE contentid = '$articleID'";
		$result = mysql_query($query) or die();
		while($row = mysql_fetch_array($result))
		{
			$articleContent = $row[$data];
		}
		return $articleContent;
	}
	
	function getContentArticleLikes($catID)	//This function returns Total Likes for a given category
	{
		$query = "SELECT sum(likes) as total_likes FROM content WHERE categoryid = '$catID'";
		$result = mysql_query($query) or die();
		while($row = mysql_fetch_array($result))
		{
			$categoryLikes = $row['total_likes'];
		}
		return $categoryLikes;
	}
	
	function listContent() {
		//Display the list of all Contents in Hierarchical pattern
		//Group Categories first and than order
		$query = "SELECT * from content order by categoryid,contentid";
		$result = mysql_query($query) or die();
		echo "<table border='1'>";
		while($row = mysql_fetch_array($result))
		{
			echo "<tr>";
			echo "<td>".$row['contentid']."</td>";
			echo "<td>".$row['categoryid']."</td>";
			echo "<td>".$row['title']."</td>";
			echo "<td>".$row['description']."</td>";
			echo "<td>".$row['source']."</td>";
			echo "<td>".$row['datecreated']."</td>";
			echo "<td>".$row['views']."</td>";
			echo "<td>".$row['likes']."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	
	function getContent($contentID) {
		//Display the list of all Contents in particular Category
		$query = "SELECT * from content WHERE contentid = '$contentID'";
		$result = mysql_query($query);
		
		while($row = mysql_fetch_array($result))
		{
			echo "<option value=".$row['title'].">".$row['contentid']."</option>";
		}
	}
	
	function updateViews($contentID) {
		//Update Views of article
		$timestamp = date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']);
		$result = mysql_query("SELECT views from content WHERE contentid = '$contentID'");
		while($row = mysql_fetch_array($result))
		{
			$view = $row['views'];
		}
		$view = $view + 1;
		$query = "UPDATE content SET views = '$view' WHERE contentid = '$contentID'";
		mysql_query($query) or die();
	}

	function decreaseViews($contentID)
	{
		//Update Views of article
		$timestamp = date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']);
		$result = mysql_query("SELECT views from content WHERE contentid = '$contentID'");
		while($row = mysql_fetch_array($result))
		{
			$view = $row['views'];
		}
		$view = $view - 1;
		$query = "UPDATE content SET views = '$view' WHERE contentid = '$contentID'";
		mysql_query($query) or die();
	}
	
	function updateLikes($contentID)
	{
		//Update likes of article
		$timestamp = date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']);
		$result = mysql_query("SELECT likes from content WHERE contentid = '$contentID'");
		while($row = mysql_fetch_array($result))
		{
			$like = $row['likes'];
		}
		$like = $like + 1;
		$query = "UPDATE content SET likes = '$like' WHERE contentid = '$contentID'";
		mysql_query($query) or die();
	}

	function userVisitsArticle($contentID,$userId)
	{
		//Entery Visited table
		$timestamp = date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']);
		$query = "Select * From visited WHERE userid = '$userId' AND contentid = '$contentID'";
		$result = mysql_query($query);
		if(mysql_num_rows($result))
		{
			$query = "UPDATE visited SET timevisited = '$timestamp' WHERE userid = '$userId' AND contentid = '$contentID'";
			mysql_query($query) or die();
		}
		else
		{
		$query = "INSERT INTO visited (userid, contentid, timevisited) VALUES ('$userId','$contentID', '$timestamp')";
		mysql_query($query) or die();
		$this->updateViews($contentID);
		$query = "SELECT * FROM users WHERE userid = '$userId'";
		$result = mysql_query($query) or die();
		while($row = mysql_fetch_array($result))
			{
			$userName = $row['firstname'].' '.$row['lastname'];
			}
		$query = "SELECT * from  content WHERE contentid='$contentID'";
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result))
		{
			$contName = $row['title'];
		}
		$this->updateFrom($userId,'<a href="user.php?id='.$userId.'" title="User">'.$userName.'</a> has Read article on <a href=articles.php?id='.$contentID.' title="Content">'.$contName.'</a>',$timestamp);
		}
	}

	function hadUserLiked($contentID, $userId)	{
		$query = "Select * From visited WHERE userid = '$userId' AND contentid = '$contentID' AND likes = '1'";
		$result = mysql_query($query);
		if(mysql_num_rows($result))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function userLikesArticle($contentID, $userId)
	{
		//Update likes of article

		$timestamp = date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']);
		$query = "Select * From visited WHERE userid = '$userId' AND contentid = '$contentID' AND likes = '1'";
		$result = mysql_query($query);
		if(mysql_num_rows($result))
		{
			$query = "UPDATE visited SET timevisited = '$timestamp' WHERE userid = '$userId' AND contentid = '$contentID'";
			mysql_query($query) or die();
		}
		else
		{
		$query = "UPDATE visited SET likes = '1',timevisited = '$timestamp' WHERE userid = '$userId' AND contentid = '$contentID'";
		mysql_query($query) or die();
		$this->updateLikes($contentID);
		$query = "INSERT INTO visited (userid, contentid, timevisited) VALUES ('$userId','$contentID', '$timestamp')";
		mysql_query($query) or die();
		$query = "SELECT * FROM users WHERE userid = '$userId'";
		$result = mysql_query($query) or die();
		while($row = mysql_fetch_array($result))
			{
			$userName = $row['firstname'].' '.$row['lastname'];
			}
		$query = "SELECT * from  content WHERE contentid='$contentID'";
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result))
		{
			$contName = $row['title'];
			$catId = $row['categoryid'];
		}
		$_SESSION['catid'] = $catId;
		$this->updateFrom($userId,'<a href="user.php?id='.$userId.'" title="User">'.$userName.'</a> has liked article on <a href=articles.php?id='.$contentID.' title="Content">'.$contName.'</a>',$timestamp);
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