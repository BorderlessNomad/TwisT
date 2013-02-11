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
	if(!isset($_GET['id']))
	{
		header("Location: ./categories.php");
		exit;
	}
	else
	{
		$articleid = $_GET['id'];
		$contentObj = new Content();
		$categoryID = $contentObj->getContentData($articleid, 'categoryid');	//Retrive the category of article
		$contentObj->userVisitsArticle($articleid, $uID);
		if(isset($_GET['task']) && $_GET['task'] == 'like')
		{
			$contentObj->userLikesArticle($articleid,$uID);	//Update the Likes of article
			$liked = true;
		}
?>
	<title>Twist :: Articles</title>
	<div class="container">
		<?php include('left.php'); ?>
	
		<!-- User Home Page Middle Part -->
		<div class="home-middle noright articles">
			<ul>
				<div class="breadcrumbs">
					<a href="./categories.php">Category</a><a href="./categories.php?id=<?php echo $categoryID; ?>"><?php catTitle($categoryID); ?></a>
				</div>
				<?php
				if(!($contentObj->hadUserLiked($articleid,$uID)))
				{ ?>	
				<div class="pagination">
					<ul>
						<a href="?id=<?php echo $articleid; ?>&task=like"><li>Like</li></a>
					</ul>
				</div>
				
				<?php
				}	
					$contentObj->userVisitsArticle($articleid,$uID);	//Update the views of article
					$title = $contentObj->getContentData($articleid, 'title');
					$description = $contentObj->getContentData($articleid, 'description');
					$source = $contentObj->getContentData($articleid, 'source');
					$datecreated = $contentObj->getContentData($articleid, 'datecreated');
					$views = $contentObj->getContentData($articleid, 'views');
					$likes = $contentObj->getContentData($articleid, 'likes');
					echo "
					<li style='background-image: none; padding-left: 5px'>
						<ul>
							<a href='articles.php?id=".$articleid."'><li class='article_name'><strong>".$title."</strong></li></a>
							<li class='article_total'>".$datecreated."</li>
							<a href='articles.php?id=".$articleid."'><li class='article_subs'>".$description."</li></a>
							<li class='article_total'><a href='#'>".$likes." Likes</a></li>
							<li class='article_total'>".$views." Views</li>
							<a href='".$source."'><li class='article_subs'>Source : ".$source."</li></a>
						</ul>
					</li>
					";
				?>
			</ul>
		</div>
	</div>
<?php 
	}
}?>
<?php include('footer.php'); ?>