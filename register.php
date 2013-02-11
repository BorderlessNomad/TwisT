<?php 
include('header.php');
        
if(	isset($_SESSION['registeruser']['email']) && (isset($_GET['step']) || isset($_POST['register-submit-1']) || isset($_POST['register-submit-2']) || isset($_POST['register-submit-3']) || isset($_POST['register-submit-4'])))
{
	$email = $_SESSION['registeruser']['email'];
	$fname = $_SESSION['registeruser']['fname'];
	$lname = $_SESSION['registeruser']['lname'];
	$passw = $_SESSION['registeruser']['passw'];

	if($_GET['step'] == '1' || isset($_POST['register-submit-1']))
	{
		echo "<h3>Welcome, " . $fname . " " . $lname . "</h3>";
		$user = generateHashedPass($email, $passw);
		$salt = $_SESSION['registeruser']['salt'];
		$hpass = $_SESSION['registeruser']['hpass'];	
?>
		<title>Twist :: Register - Step 1</title>
		<div class="container">    
			<div class="index-left" style="width:470px;">    
				<div class="index-register" style="width:450px;">    
					<h3>Profile Information</h3>
					<?php
					if (isset($_POST['register-submit-1'])) 
					{
						$hasError = false;
						
						$gender = $_POST['gender'];
						$month = $_POST['month'];
						$day = $_POST['day'];
						$year = $_POST['year'];
						
						if ($gender == '') {
							$hasError = true;
							echo "Please select Gender<br />";
						}
						else {
							$gender = mysql_real_escape_string($gender);
						}

						//Check to make sure that the firstname field is not empty
						if ($month == '' || $day == '' || $year == '' ) {
							$hasError = true;
							echo "Please Enter Birthday<br />";
						} 
						else {
							$birthdate = $year."-".$month."-".$day;
						}
											
						if (!$hasError) {	
							$userObj = new Users();
							$uID = $_SESSION['registeruser']['id'] = $userObj->addNewUser($email, $hpass, $salt, $fname, $lname);
							$userObj->initProfile($uID);
							$userObj->updateProfile($uID,'firstname',$fname);
							$userObj->updateProfile($uID,'lastname',$lname);
							$userObj->updateProfile($uID,'gender',$_POST['gender']);					
							$userObj->updateProfile($uID,'birthdate',$birthdate);
							$userObj->updateProfile($uID,'about',$_POST['about']);
							$userObj->updateProfile($uID,'website',$_POST['website']);
							$userObj->updateProfile($uID,'twitter',$_POST['twitter']);
							$userObj->updateProfile($uID,'facebook',$_POST['facebook']);
							$userObj->updateProfile($uID,'skype',$_POST['skype']);
							$userObj->updateProfile($uID,'secemail',$_POST['secemail']);
							header('Location: ./register.php?step=2');  
						}
					} 
					?>
					<div> 
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="register_form" id="register-form-step1" method="POST">
						<fieldset>
							<legend>Personal Information</legend>
							<ul>
								<li>
									<label>Gender</label>
									<select name="gender" id="gender" show="1" class="required" >
										<option value="" label="">Select</option>
										<option value="1" label="Male">Male</option>
										<option value="2" label="Female">Female</option>
									</select>
								</li>

								<li>
									<label>Birthday</label>
									<select name="month" id="month" show="1" class="required">
										<option value="" label="">Month</option>
										<?php generateMonth(); ?>
									</select>&nbsp;
									<select name="day" id="day" show="1" class="required">
										<option value="" label=" ">Day</option>
										<?php generateDay(); ?>
									</select>&nbsp;
									<select name="year" id="year" show="1" class="required">
										<option value="" label=" ">Year</option>
										<?php generateYear(); ?>
									</select>
								</li>
								<li>
									<label>About Me</label>
									<textarea name="about" id="about" value="" class="" ></textarea>
								</li>
							</ul>
						</fieldset>
						<fieldset>
							<legend>Contact Information</legend>
							<ul>
								<li>
									<label>Secondary Email</label>
									<input type="text" name="secemail" id="secemail" value="" />
								</li>
								<li>
									<label>Website</label>
									<input type="text" name="website" id="website" value="" />
								</li>

								<li>
									<label>Twitter</label>
									<input type="text" name="twitter" id="twitter" value="" />
								</li>

								<li>
									<label>Facebook</label>
									<input type="text" name="facebook" id="facebook" value="" />
								</li>

								<li>
									<label>Skype</label>
									<input type="text" name="skype" id="skype" value="" />
								</li>
							</ul>
						</fieldset>
						<ul>
							<li class="button">
								<input type="hidden" name="formsubmitted" value="TRUE" />
								<input type="submit" name="register-submit-1" id="login-submit" value="Next" class="submit" />
							</li>
						</ul>
					</form>
				</div>
			</div>
		</div>
		<div class="index-right" style="width:470px;">
			<h1>What is TwisT?</h1>
			<p>TwisT means changing form of, by rotating from only one end, or  rotating two opposite ends in different directions. It can also be explained  simply as just unexpected development of events. The name reflects twisting the  immense volumes of information that exists today with a spice of Social  Networking.</p> 
			<p><strong>Twisting vs Searching</strong></p>
			<p>Using search engines to locate relevant content typically means  hunting through pages of results. You need something, you search on search  engine. You don’t really know what time pass you looking for? Twist is waiting.  Rather than searching for quality contents, Twisting is basically giving  entertaining environment with world full of surprising information; here  members will be taken directly to the content matching their personal interests  and preferences while they are always in touch of their friends and near-ones.</p> <p>Till now we have seen use of the Cloud computing only in very large Systems which are not available for general public. But use of same for Twist as a Backbone enables to tracks the user's location and hence routes the user's request to the geographically nearest available Server. This will also help to publish the local information based on users' location.</p>
			<p>By developing a new field known as Information Networking we can derive following advantages of Twist.
			<ul>
				<li>Reduces time and resources consumption.</li>
				<li>Unstructured content from various sites is formatted in standard structure and categories.</li>
				<li>Real-time Aggregation of information from various websites and users searching same information.</li>
				<li>Easy to use Web 2.0 dimensions and completely User friendly UI; since two most famous triads of web viz. Information Portals and Social Networking are submerged.</li>
				<li>Completely Open Source APIs using Model-View-Controller (MVC) using Open-Source software APIs.</li>
			</ul>
			People working on the same projects can mutually share data which is automatically facilitated by Twist.
			</p>
		</div>
	</div>
	<?php
	}
	else if($_GET['step'] == '2' || isset($_POST['register-submit-2']))
	{
		echo "<h3>Welcome, " . $fname . " " . $lname . "</h3>";
?>
		<title>Twist :: Register - Step 2</title>
		<div class="container">    
			<div class="index-left" style="width:470px;">    
				<div class="index-register" style="width:450px;">    
					<h3>Profile Information</h3> 
					<div>    
					<?php
					if (isset($_POST['register-submit-2'])) 
					{
						$userObj = new Users();
						$uID = $_SESSION['registeruser']['id'];
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
						$userObj->updateProfile($uID,'movies',$_POST['movies']);
						$userObj->updateProfile($uID,'books',$_POST['books']);
						$userObj->updateProfile($uID,'television',$_POST['television']);
						$userObj->updateProfile($uID,'sports',$_POST['sports']);
						header('Location: ./register.php?step=3'); 
					} 
					?>

					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="register_form" id="register-form-step2" method="POST">
						<fieldset>
							<legend>Location & Education Information</legend>
							<ul>
								<li>
									<label>City</label>
									<input type="text" name="city" id="city" value="" />
								</li>
								<li>
									<label>Country</label>
									<input type="text" name="country" id="country" value="" />
								</li>
								<li>
									<label>Languages</label>
									<input type="text" name="languages" id="languages" value="" />
								</li>
								<li>
									<label>School</label>
									<input type="text" name="school" id="school" value="" />
								</li>
								<li>
									<label>High School</label>
									<input type="text" name="highschool" id="highschool" value="" />
								</li>
								<li>
									<label>College</label>
									<input type="text" name="college" id="college" value="" />
								</li>
								<li>
									<label>University</label>
									<input type="text" name="university" id="university" value="" />
								</li>
							</ul>
						</fieldset>
						<fieldset>
							<legend>Additional Information</legend>
							<ul>
								<li>
									<label>Company</label>
									<input type="text" name="company" id="company" value="" />
								</li>

								<li>
									<label>Religion</label>
									<input type="text" name="religion" id="religion" value="" />
								</li>

								<li>
									<label>Music</label>
									<input type="text" name="music" id="music" value="" />
								</li>
								
								<li>
									<label>Books</label>
									<input type="text" name="books" id="books" value="" />
								</li>

								<li>
									<label>Movie</label>
									<input type="text" name="movies" id="movies" value="" />
								</li>
								
								<li>
									<label>Television</label>
									<input type="text" name="television" id="television" value="" />
								</li>
								<li>
									<label>Sports</label>
									<input type="text" name="sports" id="sports" value="" />
								</li>
							</ul>
						</fieldset>
						<ul>
							<li class="button">
								<input type="submit" name="register-submit-2" id="login-submit" value="Next" class="submit" />
								<a href="./register.php?step=3" title="Skip" style="float: right; margin: 8px 0 0 240px;">Skip</a>
							</li>
						</ul>
					</form>
				</div>
			</div>
		</div>
		<div class="index-right" style="width:470px;">
			<h1>What is TwisT?</h1>
			<p>Twist is an Open World Knowledge Sharing Network which provides a platform to the users searching information on the same project that directly publishes the new updates for a desired category or group of categories to the people who had enrolled as that category for their Personal interest.</p>
			<p>It also asks the users to make friends on the web searching for the same articles by selecting the interested categories; the application provides the user with the latest updates from the various sites. If the user needs more information then user will be redirected to the sites providing latest news and updates.</p>
			<p>Here the basic aim of Twist which is "Instead users searches information, information searches users" Is defined.</p>
			<p>Till now we have seen use of the Cloud computing only in very large Systems which are not available for general public. But use of same for Twist as a Backbone enables to tracks the user's location and hence routes the user's request to the geographically nearest available Server. This will also help to publish the local information based on users' location.</p>
			<p>"Twist is not a social networking platform but it is being developed for collaborating and searching knowledge on the web."</p>
		</div>
	</div>	
	<?php
	}
	else if($_GET['step'] == '3' || isset($_POST['register-submit-3']))
	{
		echo "<h3>Welcome, " . $fname . " " . $lname . "</h3>";
?>
		<title>Twist :: Register - Step 3</title>
		<div class="container">    
			<div class="index-left" style="width:470px;">    
				<div class="index-register" style="width:450px;">    
					<h3>Plese Subscibe Categories of your choice</h3> 
					<div>    
					<?php
					if (isset($_POST['register-submit-3'])) 
					{
						$catCount = 0;
						$uID = $_SESSION['registeruser']['id'];
						for($i=1;$i<=$_POST['totalcats'];$i++)
						{
							if(isset($_POST['category_'.$i]))
							{
								$category[] = '1';
								$catCount++;
							}
							else
								$category[] = '0';
						}
						if($catCount < 3)
						{
							echo "Please select atlest 3 Categories!";
						}
						else 
						{
							$catObj = new Categories();
							$catObj->changeSubscribe($category,$uID);
							header('Location: ./register.php?step=4'); 
						}
					} 
					?>

					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="register_form" id="register-form-step3" method="POST">
						<fieldset>
							<legend>Available Categories</legend>
							<ul style="font-size: 16px;">
								<?php 
								$listcats = getCategories($uID);
								for($i=1;$i<=count($listcats);$i++)
								{
									echo "
									<li style='font-size: 16px;'>
										<input style='width: 20px;' type='checkbox' name='category_".$listcats[$i]['id']."' value='".$listcats[$i]['id']."' id='category_".$listcats[$i]['id']."'".$listcats[$i]['subscribe']." />".$listcats[$i]['name']." 
										<a href='./categories.php?id=".$listcats[$i]['id']."' target='_new'>View</a>
									</li>";
								}
							?>
							</ul>
						</fieldset>
							<li class="button">
								<input type="hidden" name="totalcats" value="<?php echo count($listcats); ?>" />
								<input type="submit" name="register-submit-3" id="submit" value="Next" class="submit" />
							</li>
					</form>
				</div>
			</div>
		</div>
		<div class="index-right" style="width:470px;">
			<h1>What is Data, Information and Knowledge?</h1>
			<p><strong>Data</strong> is/are the facts of the World. For example, take yourself. You may be 5ft tall, have brown hair and blue eyes. All of this is "data". You have brown hair whether this is written down somewhere or not.
			In many ways, data can be thought of as a description of the World. We can perceive this data with our senses, and then the brain can process this.
			Human beings have used data as long as we've existed to form knowledge of the world.</p>
			<p>Until we started using information, all we could use was data directly. If you wanted to know how tall I was, you would have to come and look at me. Our knowledge was limited by our direct experiences.</p>
			
			<p><strong>Information</strong> allows us to expand our vision beyond the range of our senses. We can capture data in information, and then move it about so that other people can access it at different times.
			Here is a simple analogy for you.</p>
			<p>If I take a picture of you, the photograph is information. But what you look like is data.</p>
			<p>I can move the photo of you around; send it to other people via e-mail etc. However, I'm not actually moving you around – or what you look like. I'm simply allowing other people who can't directly see you from where they are to know what you look like. If I lose or destroy the photo, this doesn't change how you look.</p>
			<p>So, in the case of the lost tax records, the CDs were information. The information was lost, but the data wasn't. Mrs. Patel still lives at Sion, and she was still born on 15th August 1971.</p>
			
			<p><strong>Knowledge</strong> is what we know. Think of this as the map of the World we build inside our brains. Like a physical map, it helps us know where things are – but it contains more than that. It also contains our beliefs and expectations. "If I do this, I will probably get that." Crucially, the brain links all these things together into a giant network of ideas, memories, predictions, beliefs, etc.</p>
			<p>It is from this "map" that we base our decisions, not the real world itself. Our brains constantly update this map from the signals coming through our eyes, ears, nose, mouth and skin.</p>
			<p>You can't currently store knowledge in anything other than a brain, because a brain connects it all together. Everything is inter-connected in the brain. Computers are not artificial brains. They don't understand what they are processing, and can't make independent decisions based upon what you tell them.</p>
		</div>
	</div>	
	<?php
	}
	else if($_GET['step'] == '4' || isset($_POST['register-submit-4']))
	{
		echo "<h3>Welcome, " . $fname . " " . $lname . "</h3>";
?>
		<title>Twist :: Register - Step 4</title>
		<div class="container">    
			<div class="index-left" style="width:470px;">    
				<div class="index-register" style="width:450px;">    
					<h3>Profile Information</h3> 
					<div>    
					<?php
					$_SESSION['twistuser']['id'] = $_SESSION['registeruser']['id'];
					$_SESSION['twistuser']['email'] = $_SESSION['registeruser']['email'];
					$_SESSION['twistuser']['pass'] = $_SESSION['registeruser']['hpass'];
					$_SESSION['twistuser']['firstname'] = $_SESSION['registeruser']['fname'];
					$_SESSION['twistuser']['lastname'] = $_SESSION['registeruser']['lname'];

					if (isset($_POST['register-submit-4'])) 
					{
						$uID = $_SESSION['registeruser']['id'];
						define ("MAX_SIZE","64"); 
						define ("WIDTH","200"); 	// define the width and height for the thumbnail
						define ("HEIGHT","200"); 
						
						// this is the function that will create the thumbnail image from the uploaded image
						function make_thumb($img_name,$filename,$new_w,$new_h)
						{
							$ext = getExtension($img_name);
							if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext))
								$src_img = imagecreatefromjpeg($img_name);
						
							if(!strcmp("png",$ext))
								$src_img = imagecreatefrompng($img_name);
						
							$old_x = imageSX($src_img);	//gets the dimmensions of the image
							$old_y = imageSY($src_img);
							
							$ratio = $old_x/$new_w;	// next we will calculate the new dimmensions for the thumbnail image
							$thumb_w = $new_w;
							$thumb_h = $new_h;
						
							$dst_img = ImageCreateTrueColor($thumb_w,$thumb_h);	// we create a new image with the new dimmensions
						
							imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 	// resize the big image to the new created one
							
							if(!strcmp("png",$ext))	// output the created image to the file. Now we will have the thumbnail into the file named by $filename
								imagepng($dst_img,$filename); 
							else
								imagejpeg($dst_img,$filename); 
						
							imagedestroy($dst_img); 	//destroys source and destination images. 
							imagedestroy($src_img);
						}
						
						
						function getExtension($str) 	// This function reads the extension of the file. It is used to determine if the file is an image by checking the extension. 
						{
							$i  =  strrpos($str,".");
							if (!$i) { return ""; }
							$l  =  strlen($str) - $i;
							$ext  =  substr($str,$i+1,$l);
							return $ext;
						}
						
						$errors = 0;
						
						$image = $_FILES['profileimg']['name'];	//reads the name of the file the user submitted for uploading
						if ($image) 	// if it is not empty
						{	
							$filename  =  stripslashes($_FILES['profileimg']['name']);	// get the original name of the file from the clients machine
							$extension  =  getExtension($filename);	// get the extension of the file in a lower case format
							$extension  =  strtolower($extension);
							
							if (($extension !=  "jpg") && ($extension !=  "jpeg") && ($extension !=  "png")) 
							{
								echo '<h1>Unknown extension!</h1>';
								$errors = 1;
							}
							else 
							{				
								$size = getimagesize($_FILES['profileimg']['tmp_name']);	// get the size of the image in bytes
								$sizekb = filesize($_FILES['profileimg']['tmp_name']);		// $_FILES[\'image\'][\'tmp_name\'] is the temporary filename of the file in which the uploaded file was stored on the server
								
								if ($sizekb > MAX_SIZE*1024*1024)	//compare the size with the maxim size we defined and print error if bigger
								{
									echo '<h1>You have exceeded the size limit!</h1>';
									$errors = 1;
								}
								
								$image_name = time().'.'.$extension;	//we will give an unique name, for example the time in unix time format
								
								$newname = "uploads/profile/".$image_name;	//the new name will be containing the full path where will be stored (images folder)
								$copied  =  copy($_FILES['profileimg']['tmp_name'], $newname);
								
								if (!$copied) 	//we verify if the image has been uploaded, and print error instead
								{
									echo '<h1>Copy unsuccessfull!</h1>';
									$errors = 1;
								}
								else 
								{									
									$thumb_name = 'uploads/profile/thumb_'.$image_name;		// the new thumbnail image will be placed in uploads/profile/ folder
									$thumb = make_thumb($newname,$thumb_name,WIDTH,HEIGHT);	// call the function that will create the thumbnail. The function will get as parameters the image name, the thumbnail name and the width and height desired for the thumbnail
								}
							}	
						}
						
						if(!$errors) {
							$userObj = new Users();
							$userObj->updateProfile($uID,'photo',$image_name);
							$updateObj = new Updates();
							$updateObj->addUserInUpdate($uID);

							if(isset($_SESSION['twistuser']['email']) && isset($_SESSION['twistuser']['pass']) && isset($_SESSION['twistuser']['firstname']) && isset($_SESSION['twistuser']['lastname']))
							{
								$makeonline = new Users();
								$makeonline->makeOnline($_SESSION['twistuser']['id']);
								header('Location: ./home.php');  
							}
						}
					} 
					?>

					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="register_form" id="register-form-step4" method="POST" enctype="multipart/form-data">
						<fieldset>
							<legend>Profile Image</legend>
							<ul>
								<li>
									<label>Select Image</label>
									<input type="file" name="profileimg" id="profileimg" value="" />
								</li>
								<li>Note: Please select either JPG/JPEG or PNG Files of size less than 10MB</li>
							</ul>
						</fieldset>
						<ul>
							<li class="button">
								<input type="submit" name="register-submit-4" id="submit" value="Next" class="submit" />
								<a href="./home.php" title="Skip" style="float: right; margin: 8px 0 0 240px;">Skip</a>
							</li>
						</ul>
					</form>
				</div>
			</div>
		</div>
		<div class="index-right" style="width:470px;">
			<h1>Major Features of TwisT</h1>
			<p>
				<ul>
					<li>Subscrube to your likes.</li>
					<li>Read your faviourite articles</li>
					<li>Add and Explore Buddies</li>
					<li>Get updated</li>
				</ul>
			</p>			
		</div>
	</div>
	<?php
	}
	else
		header("Location:./index.php");
}
else
	header("Location:./index.php");
include('footer.php');
?>