<?php
include ('./includes/config.php');
include ('header.php');

if(!$_SESSION['loggedIn'])	//If user is already logged in
{
	header("Location: ./index.php");
	exit;
}
else
{	
?>
<title>Twist :: Search</title>
<div class="container">
    <!-- User Home Page Middle Part -->
    <div class="home-middle noright">
		<div class="search-page">
			<?php
			if(!isset($_GET['search']))
			{
				echo "Please Enter Search";
			}			
			else
			{
				$searchTerms = trim($_GET['search']);
				$searchTerms = strip_tags($searchTerms); // remove any html/javascript.
				if (strlen($searchTerms) < 3) {
					echo $error[] = "Search terms must be longer than 3 characters.";
				}
				else {
					$searchTermDB = mysql_real_escape_string($searchTerms); // prevent sql injection.
				}
				
				// If there are no errors, lets get the search going.
				if (count($error) < 1) {
					$searchSQL = "SELECT contentid, categoryid, title, description FROM content WHERE description LIKE '%{$searchTermDB}%' ORDER BY contentid";
						
					$searchResult = mysql_query($searchSQL) or trigger_error("There was an error.<br/>" . mysql_error() . "<br />SQL Was: {$searchSQL}");
					  
					if (mysql_num_rows($searchResult) < 1) {
						echo $error[] = "The search term provided <b><i>{$searchTerms}</i></b> yielded no results.";
					}
					else {
						$results = array(); // the result array
						$i = 1;
						$catObj = new Categories();
						while ($row = mysql_fetch_array($searchResult)) {
							$results[$i]['sid'] = $i;
							$results[$i]['cid'] = $row['contentid'];
							$results[$i]['catid'] = $row['categoryid'];
							$results[$i]['cat'] = $catObj->getCategoryFromID($results[$i]['catid']);							
							$results[$i]['title'] = $row['title'];
							$results[$i]['desc'] = $row['description'];
							$i++;
						}	
						?>
						<ul class="profile-feed">
							<h4>Total <?php echo count($results); ?> matches found</h4>
						<?php
							for($i=1; $i<=count($results);$i++)
							{	
						?>
								<li class="profile-item-content">
									<div class="profile-item-content-title">
										<a href="./articles.php?id=<?php echo $results[$i]['cid']; ?>"><?php echo $results[$i]['title']; ?></a>
										<span>in category 
										<a href="./categories.php?id=<?php echo $results[$i]['catid']; ?>"><?php echo $results[$i]['cat']; ?></a></span>
									</div>
									<div class="profile-item-content-info"><?php echo $results[$i]['desc']; ?></div>
								</li>
						<?php
							}
						?>
						</ul>
						<?php					
					}
				}
			}
			?>
		</div>
    </div>

    <!-- User Home Page Right Part -->
    <div class="home-right">
        <div class="user-home-container">
            <h4>Tag Cloud</h4>
            
        </div>
    </div>
</div>
<?php } ?>
<?php include('footer.php'); ?>