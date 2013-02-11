<?php
include('./includes/config.php');
include('header.php');

if(!$_SESSION['loggedIn'])	//If user is already logged in
{
	header("Location: ./index.php");
	exit;
}
else
{
	$profilePage = true;
?>
<title>Twist :: Profile</title>
<div class="container">
    <?php include('left.php'); ?>

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
                <li><a href="#updates">Updates</a></li>
                <li><a href="#personalinfo">Personal Info</a></li>
                <li><a href="#buddies">Buddies</a></li>
				<li><a href="#interests">Interests</a></li>
            </ul>

            <div class="tab_container">
                <div id="updates" class="tab_content">
                    <ul class="profile-feed">					
						<?php
							$u = new Updates();		
							$update = $u->ShowUpdatesForUser($_SESSION['twistuser']['id']);
							$temp = 0;
							for($i=1;$i<25;$i= $i + 2)
							{
								if($update[$i] != " ")
								{
									$temp = 1;
									echo "
									<li>
										<div class='profile-item-image'>
											<a href='#' title='Content'><img src='./images/nophoto_thumb.png' alt='Content Image' /></a>
										</div>
										<div class='profile-item-content'>
											<div class='profile-item-content-title'>
												".$update[$i]."
											</div>
											<div class='profile-item-content-info'>
												On ".$update[$i+1]."
											</div>                               
										</div>
									</li>";
								}
								else 
								{
									echo "
									<li>
										<div class='profile-item-image'></div>
										<div class='profile-item-content'>
											<div class='profile-item-content-title'>";
											if($temp == 0)
									{
												echo "No Updates Found";
									}
											echo "</div>                             
										</div>
									</li>";
									break;
								}
							}
						?>
                    </ul>
                </div>

                <div id="personalinfo" class="tab_content">
                	<div class="profile-display profile-feed">
						<?php 
							$userObj = new Users();
						?>
						<?php 
						if(isset($_POST['profile-save']))
						{
							//echo $birthdate = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
							
							$userObj->updateProfile($uID,'gender',$_POST['gender']);					
							//$userObj->updateProfile($uID,'birthdate',$_POST['birthdate']);
							$userObj->updateProfile($uID,'about',$_POST['about']);
							$userObj->updateProfile($uID,'website',$_POST['website']);
							$userObj->updateProfile($uID,'twitter',$_POST['twitter']);
							$userObj->updateProfile($uID,'facebook',$_POST['facebook']);
							$userObj->updateProfile($uID,'skype',$_POST['skype']);
							$userObj->updateProfile($uID,'secemail',$_POST['secemail']);
							$userObj->updateProfile($uID,'city',$_POST['city']);
							$userObj->updateProfile($uID,'country',$_POST['country']);
							$userObj->updateProfile($uID,'languages',$_POST['languages']);
							$userObj->updateProfile($uID,'school',$_POST['school']);
							$userObj->updateProfile($uID,'highschool',$_POST['highschool']);
							$userObj->updateProfile($uID,'college',$_POST['college']);
							$userObj->updateProfile($uID,'university',$_POST['university']);
							$userObj->updateProfile($uID,'company',$_POST['company']);
							$userObj->updateProfile($uID,'religion',$_POST['religion']);
							$userObj->updateProfile($uID,'music',$_POST['music']);
							$userObj->updateProfile($uID,'books',$_POST['books']);
							$userObj->updateProfile($uID,'movies',$_POST['movies']);						
							$userObj->updateProfile($uID,'television',$_POST['television']);						
							$userObj->updateProfile($uID,'sports',$_POST['sports']);
						?>
							<script type='text/javascript'>
								alert('Profile Succssfully Updated');
							</script>
						<?php						
						}
						?>
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="register_form" id="profile-display" method="POST">
							<ul>
								<h3>Personal Information</h3>
								<li>
									<?php 
										$gender = $userObj->getProfileData($uID, 'gender'); 
										if($gender == 1)
											$Gender = "Male";
										else
											$Gender = "Female";
									?>
									<label>Gender</label>
									<select name="gender" id="gender" show="1" class="required" >
										<option value="<?php echo $gender; ?>" label="<?php echo $Gender; ?>"><?php echo $Gender; ?></option>
										<option value="" label=""></option>
										<option value="1" label="Male">Male</option>
										<option value="2" label="Female">Female</option>
									</select>
								</li>
	
								<li>
									<?php 
										$birthdate = $userObj->getProfileData($uID, 'birthdate');
										$year = substr($birthdate,0,4);
										$month = substr($birthdate,5,2);
										$Month = date('F',mktime(0,0,0,$month,1));
										$day = substr($birthdate,8,2);  
									?>
									<label>Birthday</label>
									<select name="month" id="month" show="1" class="required">
										<option value="<?php echo $month; ?>" label="<?php echo $Month; ?>"><?php echo $Month; ?></option>
										<option value="" label="">Month</option>
										<?php generateMonth(); ?>
									</select>&nbsp;
									<select name="day" id="day" show="1" class="required">
										<option value="<?php echo $day; ?>" label="<?php echo $day; ?>"><?php echo $day; ?></option>
										<option value="" label="">Day</option>
										<?php generateDay(); ?>
									</select>&nbsp;
									<select name="year" id="year" show="1" class="required">
										<option value="<?php echo $year; ?>" label="<?php echo $year; ?>"><?php echo $year; ?></option>
										<option value="" label="">Year</option>
										<?php generateYear(); ?>
									</select>
								</li>
								<li>
									<?php $about = $userObj->getProfileData($uID, 'about'); ?>
									<label>About Me</label>
									<textarea name="about" id="about" value="" ><?php echo $about; ?></textarea>
								</li>
								<h3>Contact Information</h3>
								<li>
									<?php $website = $userObj->getProfileData($uID, 'website'); ?>
									<label>Website</label>
									<input type="text" name="website" id="website" value="<?php echo $website; ?>" />
								</li>
	
								<li>
									<?php $twitter = $userObj->getProfileData($uID, 'twitter'); ?>
									<label>Twitter</label>
									<input type="text" name="twitter" id="twitter" value="<?php echo $twitter; ?>" />
								</li>
	
								<li>
									<?php $facebook = $userObj->getProfileData($uID, 'facebook'); ?>
									<label>Facebook</label>
									<input type="text" name="facebook" id="facebook" value="<?php echo $facebook; ?>" />
								</li>
	
								<li>
									<?php $skype = $userObj->getProfileData($uID, 'skype'); ?>
									<label>Skype</label>
									<input type="text" name="skype" id="skype" value="<?php echo $skype; ?>" />
								</li>
								<li>
									<?php $secemail = $userObj->getProfileData($uID, 'secemail'); ?>
									<label>Secondary Email</label>
									<input type="text" name="secemail" id="secemail" value="<?php echo $secemail; ?>" />
								</li>
							<h3>Location & Education Information</h3>
								<li>
									<?php $city = $userObj->getProfileData($uID, 'city'); ?>
									<label>City</label>
									<input type="text" name="city" id="city" value="<?php echo $city; ?>" />
								</li>
	
								<li>
									<?php $country = $userObj->getProfileData($uID, 'country'); ?>
									<label>Country</label>
									<input type="text" name="country" id="country" value="<?php echo $country; ?>" />
								</li>
	
								<li>
									<?php $languages = $userObj->getProfileData($uID, 'languages'); ?>
									<label>Languages</label>
									<input type="text" name="languages" id="languages" value="<?php echo $languages; ?>" />
								</li>
	
								<li>
									<?php $school = $userObj->getProfileData($uID, 'school'); ?>
									<label>School</label>
									<input type="text" name="school" id="school" value="<?php echo $school; ?>" />
								</li>
								<li>
									<?php $highschool = $userObj->getProfileData($uID, 'highschool'); ?>
									<label>High School</label>
									<input type="text" name="highschool" id="highschool" value="<?php echo $highschool; ?>" />
								</li>
								<li>
									<?php $college = $userObj->getProfileData($uID, 'college'); ?>
									<label>College</label>
									<input type="text" name="college" id="college" value="<?php echo $college; ?>" />
								</li>
								<li>
									<?php $university = $userObj->getProfileData($uID, 'university'); ?>
									<label>University</label>
									<input type="text" name="university" id="university" value="<?php echo $university; ?>" />
								</li>
							<h3>Additional Information</h3>
								<li>
									<?php $company = $userObj->getProfileData($uID, 'company'); ?>
									<label>Company</label>
									<input type="text" name="company" id="company" value="<?php echo $company; ?>" />
								</li>
	
								<li>
									<?php $religion = $userObj->getProfileData($uID, 'religion'); ?>
									<label>Religion</label>
									<input type="text" name="religion" id="religion" value="<?php echo $religion; ?>" />
								</li>
	
								<li>
									<?php $music = $userObj->getProfileData($uID, 'music'); ?>
									<label>Music</label>
									<input type="text" name="music" id="music" value="<?php echo $music; ?>" />
								</li>
	
								<li>
									<?php $books = $userObj->getProfileData($uID, 'books'); ?>
									<label>Books</label>
									<input type="text" name="books" id="books" value="<?php echo $books; ?>" />
								</li>
								<li>
									<?php $movies = $userObj->getProfileData($uID, 'movies'); ?>
									<label>Movies</label>
									<input type="text" name="movies" id="movies" value="<?php echo $movies; ?>" />
								</li>
								<li>
									<?php $television = $userObj->getProfileData($uID, 'television'); ?>
									<label>Television</label>
									<input type="text" name="television" id="television" value="<?php echo $television; ?>" />
								</li>
								<li>
									<?php $sports = $userObj->getProfileData($uID, 'sports'); ?>
									<label>Sports</label>
									<input type="text" name="sports" id="sports" value="<?php echo $sports; ?>" />
								</li>
							<li class="button">
								<input type="hidden" name="formsubmitted" value="TRUE" />
								<input type="submit" name="profile-save" id="profile-save" value="Update" class="submit" />
							</li>
						</ul>
					</form>				   		
				   	</div>
                </div>
                <div id="buddies" class="tab_content">
					<div class="buddy-list">
						<ul>
						<?php
							$buddies = myBuddies($uID);
							$buddylist = array();
							if(!empty($buddies))
							{
								$i=0;
								foreach ($buddies as $buddyid=>$value) 
								{
									$buddylist[$i]['id'] = $buddyid;
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
				<div id="interests" class="tab_content">
					<div class="subscribe-category">
						<h4>You can Subscibe/Unsubscribe Categories of your choice from here.</h4>
						<?php
						if(isset($_POST['category-save']))
						{
							$count = 0;
							for($i=1;$i<=$_POST['totalcats'];$i++)
							{
								if(isset($_POST['category_'.$i]))
								{
									$category[] = '1';
									$count++;
								}
								else
									$category[] = '0';
							}

							if($count<3)
							{
								echo "Please select atleast 3 Categories";
							}
							else
							{
								$catObj = new Categories();
								$catObj->changeSubscribe($category,$uID);
							}
						}
						?>
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="register_form" id="subscribe-category" method="POST">
						<ul>
							<?php 
								$listcats = getCategories($uID);
								for($i=1;$i<=count($listcats);$i++)
								{
									echo "<li><label><input type='checkbox' name='category_".$listcats[$i]['id']."' value='".$listcats[$i]['id']."' id='category_".$listcats[$i]['id']."'".$listcats[$i]['subscribe']." />".$listcats[$i]['name']." <a href='./categories.php?id=".$listcats[$i]['id']."' target='_new'>View</a></label></li>";
								}
							?>
							<li class="button" style="border-bottom: none;">
								<input type="hidden" name="formsubmitted" value="TRUE" />
								<input type="hidden" name="totalcats" value="<?php echo count($listcats); ?>" />
								<input type="submit" name="category-save" id="submit" value="Update" class="submit" />
							</li>
						</ul>
						</form>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php include('footer.php'); ?>