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
	if(isset($_GET['id']))
	{
		$catid = $_SESSION['catid'] = $_GET['id'];
?>
		<title>Twist :: Articles</title>
		<div class="container">
			<?php include('left.php'); ?>
		
			<!-- User Home Page Middle Part -->
			<div class="home-middle noright articles">
				<ul>
					<div class="breadcrumbs">
						<a href="./categories.php">Category</a><a href="#"><?php catTitle($catid); ?></a>
					</div>
					<?php
						$articles = getArticleList($catid);
						for($i=0;$i<count($articles);$i++)
						{
							echo "
							<li>
								<ul>
									<a href='articles.php?id=".$articles[$i]['id']."'><li class='article_name'><strong>".$articles[$i]['title']."</strong></li></a>
									<li class='article_total'>".$articles[$i]['likes']." Likes<br />".$articles[$i]['views']." Views</li>
									<a href='articles.php?id=".$articles[$i]['id']."'><li class='article_subs'>".$articles[$i]['description']."</li></a>
								</ul>
							</li>
							";
						}
					?>
				</ul>
			</div>
		</div>
<?php
	}
	else
	{
		$catObj = new Categories();
		$categories = getCategoryList();
		
		if(isset($_GET['task']) && isset($_GET['catid']))
		{
			if($_GET['task'] == 'subscribe')
			{
				$catObj->addSubscribe($_GET['catid'], $uID);
				header("Location: ./categories.php");
			}
			else
			{
				$totalcats = $catObj->getSubscribed($uID);
				if(count($totalcats) < 4)
				{
					echo "
					<script type='text/javascript'>
						alert('Atleast 3 Categories must be subscribed!')
					</script>";
				}
				else 
				{
					$catObj->removeSubscribe($_GET['catid'], $uID);
					header("Location: ./categories.php");
				}
			}
		}
?>
	<title>Twist :: Categories</title>
	<div class="container">
		<?php include('left.php'); ?>
		<!-- User Home Page Middle Part -->
		<div class="home-middle noright categories">
			<ul>
				<?php 
					for($i=1;$i<=count($categories);$i++)
					{
						echo "
						<li>
							<ul>
								<a href='categories.php?id=".$categories[$i]['id']."'><li class='category_name'>".$categories[$i]['name']."</li></a>
								<li>".$categories[$i]['totalarticles']." Articles</li>
								<li class='category_total'>".$categories[$i]['totalsubscribe']." Subscriptions</li>
								<li>".$categories[$i]['totalikes']." Likes</li>";
								if(!($catObj->isSubscribed($i,$uID)))
								{
									echo "<a href='?task=subscribe&catid=".$categories[$i]['id']."'><li class='category_subs'>Subscribe</li></a>";
								}
								else
								{
									echo "<a href='?task=unsubscribe&catid=".$categories[$i]['id']."'><li class='category_subs'>Unsubscribe</li></a>";
								}
						echo	
							"</ul>
						</li>
						";
					}
				?>
			</ul>
		</div>
	</div>
<?php
	
	}
} ?>
<?php include('footer.php'); ?>