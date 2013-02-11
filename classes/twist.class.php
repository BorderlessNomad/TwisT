<?php
class Twist
{
	function twistContent($CatagoryId, $ContentId) {
		// twist an article
		$query = "SELECT * FROM content WHERE categoryid = '$CatagoryId' ORDER BY RAND() LIMIT 0, 1";
		$result = mysql_query($query) or die();
		$i = 0;
		while($row = mysql_fetch_array($result))
		{
			if(!in_array($row['contentid'],$ContentId))
			{
				$c[$i] = $row['contentid'];
				$i++;
				$c[$i] = $row['title'];
				$i++;
				$c[$i] = substr($row['description'], 0, 100)."...";	//For displaying only first 100 Chars of description + append "..."
				$i++;
			}
		}
		return $c;
	}

	function twistCatagory($userId,$CategoryId) {
		// twist a Category
		$query = "SELECT * FROM interests WHERE userid = '$userId' ORDER BY RAND() LIMIT 0, 3";
		$result = mysql_query($query) or die();
		$i = 0;
		while($row = mysql_fetch_array($result))
		{
			if(!in_array($row['categoryid'],$CategoryId))
			{
				$d = $row['categoryid'];
				$c[$i] = $d;
				$i++;
				break;
			}
		}
		$query = "SELECT * FROM  categories WHERE categoryid = '$d' ";
		$result = mysql_query($query) or die();
		while($row = mysql_fetch_array($result))
		{
			$c[$i] = $row['categoryname']; 
			$i++;
		}
		
		$query = "SELECT * FROM content WHERE categoryid = '$c[0]' ORDER BY datecreated DESC LIMIT 0, 3";
		$result = mysql_query($query) or die();
		while($row = mysql_fetch_array($result))
		{
			$c[$i] = $row['contentid'];
			$i++;
			$c[$i] = $row['title'];
			$i++;
			$c[$i] = substr($row['description'], 0, 100)."...";	//For displaying only first 100 Chars of description + append "..."
			$i++;
		}
		return $c;
	}
	
	function twistCatagoryPopular() {
		// twist a Category
		$query = "SELECT categoryid, sum(likes) AS total_likes FROM content GROUP BY categoryid ORDER BY sum(likes) DESC LIMIT 0, 3";
		$result = mysql_query($query) or die();
		while($row = mysql_fetch_array($result))
		{
			$CatLikes[$row['categoryid']][] = $row['total_likes'];
		}
		//return $CatLikes;

		foreach($CatLikes as $catid=>$likes)
		{
			$j = 0;
			$query = "SELECT * FROM categories WHERE categoryid = '$catid'";
			$result = mysql_query($query) or die();
			while($row = mysql_fetch_array($result))
			{
				$c[$catid][$j] = $catid;
				$j++;
				$c[$catid][$j] = $row['categoryname'];
				$j++;
				$c[$catid][$j] = $likes;
				$j++;
			}
			
			$query = "SELECT * FROM content WHERE categoryid = '$catid' ORDER BY RAND() LIMIT 0, 3";
			$result = mysql_query($query) or die();
			
			while($row = mysql_fetch_array($result))
			{
				$c[$catid][$j] = $row['contentid'];
				$j++;
				$c[$catid][$j] = $row['title'];
				$j++;
				$c[$catid][$j] = substr($row['description'], 0, 100)."...";	//For displaying only first 100 Chars of description + append "..."
				$j++;
			}
		}
		return $c;	//Return popCats[][];
	}

	function FindMutualContentsViewed($SrcId, $DestId) {
			// Calculates No of Common Liked Articles
		$counter = 0;
		$query1 = "SELECT * FROM visited WHERE userid = '$SrcId'";
		$result1 = mysql_query($query1) or die();
			while($row1 = mysql_fetch_array($result1))
			{
			$listcont1[] = $row1['contentid'];
			}
		$query2 = "Select * FROM visited WHERE userid = '$DestId'";
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
			echo $counter;
	}

}
?>