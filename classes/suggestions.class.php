<?php
/* Suggesting Buddies Class */
class Suggestions 
{
	function addUserInSuggestion($userId) {
		//Code for adding new user to the system
		$timestamp = date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']);
		$query = "SELECT * FROM users WHERE userid <> '$userId' ";
		$result = mysql_query($query) or die();
		while($row = mysql_fetch_array($result))
		{
			$destination = $row['userid'];
			$query = "INSERT INTO suggestions ( sourceid, destinationid, mutualcategories, mutualcontentsliked, connected ) VALUES ('$userId','$destination','0','0','0')";
			mysql_query($query) or die();
		}
	}
	
	function FindMutualCategories($SrcId, $DestId) {
		// Calculates No of Common Subscribed Categories
		$counter = 0;
		$query1 = "SELECT * From interests Where userid = '$SrcId' ";
		$result1 = mysql_query($query1);
		while($row1 = mysql_fetch_array($result1))
		{
			$listcat1[] = $row1['categoryid'];
		}
		$query2 = "Select * From interests where userid = '$DestId'";
		$result2 = mysql_query($query2) or die();	
		while($row2 = mysql_fetch_array($result2))
		{
			$listcat2[] = $row2['categoryid'];
		}
		for($i1=0;$i1<count($listcat1);$i1++)
		{
			for($i2=0;$i2<count($listcat2);$i2++)
		{
			if($listcat1[$i1] == $listcat2[$i2])
			{
				$counter = $counter + 1;
				break;
			}
		}
		}
		return $counter;	
	}

	function FindMutualContentsLiked($SrcId, $DestId) {
		// Calculates No of Common Liked Articles
		$counter = 0;
		$query1 = "SELECT * From  visited Where userid = '$SrcId' AND likes = 1 ";
		$result1 = mysql_query($query1);
		while($row1 = mysql_fetch_array($result1))
		{
			$listcont1[] = $row1['contentid'];
		}
		$query2 = "Select * From  visited where userid = '$DestId' AND likes = 1 ";
		$result2 = mysql_query($query2) or die();	
		while($row2 = mysql_fetch_array($result2))
		{
			$listcont2[] = $row2['contentid'];
		}
		for($i1=0;$i1<count($listcont1);$i1++)
		{
			for($i2=0;$i2<count($listcont2);$i2++)
		{
			if($listcont1[$i1] == $listcont2[$i2])
			{
				$counter = $counter + 1;
				break;
			}
		}
		}
		return $counter;	
	}

	function GetSuggestionOnCategories($userId) 
	{
		$query = "SELECT * FROM suggestions WHERE sourceid = '$userId' OR destinationid = '$userId'";
		$result = mysql_query($query) or die();
		$i = 0;
		while($row = mysql_fetch_array($result))
		{
			$s[$i] = $row['suggestionid'];
			$b1[$i] = $this->FindMutualCategories($row['sourceid'],$row['destinationid']);	
			$b2[$i] = $this->FindMutualContentsLiked($row['sourceid'],$row['destinationid']);
			$i++;
		}

		for($i=0;$i<count($s);$i++)
		{
			$query = "UPDATE suggestions SET mutualcategories = '$b1[$i]', mutualcontentsliked = '$b2[$i]' WHERE suggestionid = '$s[$i]'";
			mysql_query($query) or die();
		}

		$i = 0;
		$query = "SELECT * FROM suggestions WHERE (connected = '0' AND(sourceid = '$userId' OR destinationid = '$userId')) ORDER BY  mutualcategories DESC LIMIT 0 , 8";
		$result = mysql_query($query) or die();

		while($row = mysql_fetch_array($result))
		{
			if($row['sourceid'] == $userId)
			{
				$a[$i] = $row['destinationid'];
				$i++;
			}
			else 
			{
				$a[$i] = $row['sourceid'];
				$i++;
			}
		}
		$j = 0;
		$userObj = new Users();
		for($i=0;$i<count($a);$i++)
		{
			$suggested[$j][] = $userId = $a[$i];
			$suggested[$j][] = $userObj->getProfileData($userId, 'firstname')."&nbsp;".$userObj->getProfileData($userId, 'lastname');
			$suggested[$j][] = $userObj->getProfileData($userId, 'photo');
			$j++;
		}
		return $suggested;
	}


	function GetSuggestionOnContnetsLiked($userId)
	{
		$query = "SELECT * FROM  suggestions WHERE sourceid = '$userId' OR destinationid = '$userId'";
		$result = mysql_query($query) or die();
		$i = 0;
		while($row = mysql_fetch_array($result))
		{
			$b1[$i] = $this->FindMutualCategories($row['sourceid'],$row['destinationid']);	
			$b2[$i] = $this->FindMutualContentsLiked($row['sourceid'],$row['destinationid']);
			$s[$i] = $row['suggestionid'];
			$i++;
		}

		for($i=0;$i<count($s);$i++)
		{
			$query = "UPDATE suggestions SET mutualcategories = '$b1[$i]', mutualcontentsliked = '$b2[$i]' WHERE suggestionid = '$s[$i]'";
			mysql_query($query) or die();
		}

		$i = 0;
		$query = "SELECT * FROM suggestions WHERE (sourceid = '$userId' OR destinationid = '$userId') AND connected = 0 ORDER BY  suggestions.mutualcontentsliked DESC LIMIT 0 , 8";
		$result = mysql_query($query) or die();

		while($row = mysql_fetch_array($result))
		{
			if($row['sourceid'] == $userId)
			{
				$a[$i] = $row['destinationid'];
				$i = $i + 1;
			}
			else 
			{
				$a[$i] = $row['sourceid'];
				$i = $i + 1;
			}
		}

		for($i=0;$i<count($a);$i++)
		{
			echo $a[$i];
			echo "<br/>";
		}
		return $a;
	}
}
?>