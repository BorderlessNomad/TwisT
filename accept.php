<?php
include('header.php');
if(!$_SESSION['loggedIn'])	//If user is already logged in or is self
{
	header("Location: ./index.php");
	exit;
}
else
{
	$buddyid = $_GET['id'];
	$buddyObj = new Buddies();
	$userObj = new Users();
	
	if(isset($_GET['task']))
	{
		if($_GET['task'] == 'acceptRequest')
		{
			$buddyObj->AcceptFriendRequest($buddyid,$uID);
			header("Location: ./user.php?id=$buddyid");
		}
	}

						$buddiesOb = new Buddies();
						$buddies = $buddiesOb->listPendingBuddiesRequest($uID);
						if(!empty($buddies))
							{
								for($i=0;$i<count($buddies);$i++)
								{
									$userObj = New Users();
									$userPhoto = $userObj->getProfileData($buddies[$i],photo);
									$userfname = $userObj->getProfileData($buddies[$i],firstname);
									$userlname = $userObj->getProfileData($buddies[$i],lastname);
									echo "<h3>".$userfname." ".$userlname."<br/><a href='user.php?id=".$buddies[$i]."'>
									<span class='buddy-photo'><img src='./uploads/profile/thumb_".$userPhoto."' alt='".$userfname." ".$userlname."' /></span></a></h3><br/>"; ?>		
									<div class="container">
											<!-- User Home Page Left Part -->
										<div class="home-left">
											<ul class="add-buddy">
												
												<li><a href="?id=<?php echo $buddies[$i]; ?>&task=acceptRequest">Accept Request</a></li>
											</ul>
										</div>
									</div>
								<br/>
<?php
										
								}
							}
							else
								echo "No Buddies Requests Found!";
}							
include('footer.php');
?>