<?php
include('./includes/config.php');
include('header.php');

if(!$_SESSION['loggedIn'] || !isset($_GET['id']) || $_GET['id'] == $uID)	//If user is already logged in or is self
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
		if($_GET['task'] == 'addbuddy')
		{
			$buddyObj->addNewBuddy($uID,$buddyid);
			header("Location: ./user.php?id=$buddyid");
		}
		else if($_GET['task'] == 'rembuddy')
		{
			$buddyObj->removeBuddy($uID,$buddyid);
			header("Location: ./user.php?id=$buddyid");
		}
	}
	
	$mybuddy = 0;
	if($buddyObj->isBuddy($uID,$buddyid))
	{
		if($buddyObj->isBuddyAccepted($uID,$buddyid))
			$myBuddy = 1;
		else
			$myBuddy = -1;
	}
?>
<title>Twist :: Profile</title>
<div class="container">
     	<!-- User Home Page Left Part -->
    <div class="home-left">
        <div class="username-home"><?php echo "<h3><a href='#'>".$userObj->getProfileData($buddyid,'firstname'). " " .$userObj->getProfileData($buddyid,'lastname')."</a></h3>"; ?></div>
        <?php
			$profileImg = $userObj->getProfileData($buddyid,'photo');
		?>
		<div class="user-home-photo"><a href=""><img src="./uploads/profile/thumb_<?php echo $profileImg; ?>" /></a></div>
		<ul class="add-buddy">
        	<?php
			if($myBuddy == 0) { ?>
			<li><a href="?id=<?php echo $buddyid; ?>&task=addbuddy">Add as a Buddy</a></li>
			<?php
			}
			else if($myBuddy == -1) { ?>
			<li><a href="">Request Pending</a></li>
			<?php 
			} 
			else { ?>
			<li><a href="?id=<?php echo $buddyid; ?>&task=rembuddy">Remove Buddy</a></li>
			<?php } ?>
		</ul>
        <?php
		/*<div class="user-home-container">
		//Mutual buddies can be shown here       
		</div>*/
		?>
    </div>
 	<!-- User Home Page Left Part End -->

    <!-- User Home Page Middle Part -->
    <div class="home-middle" style="width: 737px; margin-right:0;">
        <script type="text/javascript">
            $(document).ready(function() {

                //When page loads...
                $(".tab_content").hide(); //Hide all content
                $("ul.tabs li:first").addClass("active").show(); //Activate first tab
                $(".tab_content:first").show(); //Show first tab content

                //On Click Event
                $("ul.tabs li").click(function() {

                        $("ul.tabs li").removeClass("active"); //Remove any "active" class
                        $(this).addClass("active"); //Add "active" class to selected tab
                        $(".tab_content").hide(); //Hide all tab content

                        var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
                        $(activeTab).fadeIn(); //Fade in the active ID content
                        return false;
                });
            });
        </script>
        <div class="home-tabs">
            <ul class="tabs">
			<?php
			if($myBuddy == 1) {
			?>
                <li><a href="#personalinfo">Personal Info</a></li>
                <li><a href="#buddies">Buddies</a></li>
			<?php
			}
			?>
				<li><a href="#interests">Interests</a></li>
            </ul>

            <div class="tab_container">
			<?php
			if($myBuddy == 1) {
			?>
                <div id="personalinfo" class="tab_content">
                	<div class="profile-display profile-feed">
						<ul>
							<h3>Personal Information</h3>
							<li>Gender :
							<?php 
								$gender = $userObj->getProfileData($buddyid, 'gender'); 
								if($gender == 1)
									echo "Male";
								else
									echo "Female";
							?>
							</li>
							<li>Birthday :
							<?php 
								$birthdate = $userObj->getProfileData($buddyid, 'birthdate');
								$year = substr($birthdate,0,4);
								$month = substr($birthdate,5,2);
								$Month = date('F',mktime(0,0,0,$month,1));
								$day = substr($birthdate,8,2);  
								echo $day." ".$Month." ".$year;
							?>
							</li>
							<li>About :
								<?php echo $about = $userObj->getProfileData($buddyid, 'about'); ?>
							</li>
							<h3>Contact Information</h3>
							<li>Website :
								<?php echo $website = $userObj->getProfileData($buddyid, 'website'); ?>
							</li>
							<li>Twitter :
								<?php echo $twitter = $userObj->getProfileData($buddyid, 'twitter'); ?>
							</li>
							<li>Facebook :
								<?php echo $facebook = $userObj->getProfileData($buddyid, 'facebook'); ?>
							</li>
							<li>Skype :
								<?php echo $skype = $userObj->getProfileData($buddyid, 'skype'); ?>
							</li>
							<li>Secondary Email :
								<?php echo $secemail = $userObj->getProfileData($buddyid, 'secemail'); ?>
							</li>
							<h3>Location & Education Information</h3>
							<li>City :
								<?php echo $city = $userObj->getProfileData($buddyid, 'city'); ?>
							</li>
							<li>Country :
								<?php echo $country = $userObj->getProfileData($buddyid, 'country'); ?>
							</li>
							<li>Languages :
								<?php echo $languages = $userObj->getProfileData($buddyid, 'languages'); ?>
							</li>
							<li>School :
								<?php echo $school = $userObj->getProfileData($buddyid, 'school'); ?>
							</li>
							<li>High School :
								<?php echo $highschool = $userObj->getProfileData($buddyid, 'highschool'); ?>
							</li>
							<li>College :
								<?php echo $college = $userObj->getProfileData($buddyid, 'college'); ?>
							</li>
							<li>University :
								<?php echo $university = $userObj->getProfileData($buddyid, 'university'); ?>
							</li>
							<h3>Additional Information</h3>
							<li>Company :
								<?php echo $company = $userObj->getProfileData($buddyid, 'company'); ?>
							</li>
							<li>Religion :
								<?php echo $religion = $userObj->getProfileData($buddyid, 'religion'); ?>
							</li>
							<li>Music :
								<?php echo $music = $userObj->getProfileData($buddyid, 'music'); ?>
							</li>
							<li>Books :
								<?php echo $books = $userObj->getProfileData($buddyid, 'books'); ?>
							</li>
							<li>Movies :
								<?php echo $movies = $userObj->getProfileData($buddyid, 'movies'); ?>
							</li>
							<li>Television :
								<?php echo $television = $userObj->getProfileData($buddyid, 'television'); ?>
							</li>
							<li>Sports :
								<?php echo $sports = $userObj->getProfileData($buddyid, 'sports'); ?>
							</li>
						</ul>
				   	</div>
                </div>
                <div id="buddies" class="tab_content">
					<div class="buddy-list">
						<ul>
						<?php
							$buddies = myBuddies($buddyid);
							$buddylist = array();
							if(!empty($buddies))
							{
								$i=0;
								foreach ($buddies as $buddyID=>$value) 
								{
									$buddylist[$i]['id'] = $buddyID;
									foreach ($value as $item => $iValue) 
									{
										$buddylist[$i][$item] = $iValue;
									}
									$i++;
								}
								for($i=0;$i<count($buddylist);$i++)
								{
									echo "
									<li>
										<a href='user.php?id=".$buddylist[$i]['id']."'>
											<span class='buddy-photo'><img src='./uploads/profile/thumb_".$buddylist[$i]['photo']."' alt='".$buddylist[$i]['fname']." ".$buddylist[$i]['lname']."' /></span>
											".$buddylist[$i]['fname']." ".$buddylist[$i]['lname']."
										</a>
									</li>";
								}
							}
							else
								echo "No Buddies Found!";
						?>							
						</ul>
					</div>
                </div>
				<?php } ?>
				<div id="interests" class="tab_content">
					<div class="subscribe-category">
						<ul>
							<?php 
								$catObj = new Categories();
								$listcats = $catObj->getSubscribed($buddyid);
								if(!count($listcats))
									echo "Interests List Empty";
								for($i=0;$i<count($listcats);$i++)
								{
									echo "
									<li>
										<a href='./categories.php?id=".$listcats[$i]."' target='_new'>".$catObj->getCategoryFromID($listcats[$i])."</a>
									</li>";
								}
							?>
						</ul>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php include('footer.php'); ?>