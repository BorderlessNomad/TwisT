 	<!-- User Home Page Left Part -->
    <div class="home-left">
        <div class="username-home"><?php  echo "<h3>Hi, <a href='./index.php'>".$_SESSION['twistuser']['firstname']. " " .$_SESSION['twistuser']['lastname']."</a></h3>"; ?></div>
        <?php
			$userObj = new Users();
			$profileImg = $userObj->getProfileData($_SESSION['twistuser']['id'],'photo');
		?>
		<div class="user-home-photo"><a href="#"><img src="./uploads/profile/thumb_<?php echo $profileImg; ?>" /></a></div>
		<?php if($profilePage) 
		{ ?>
			<script type="text/javascript">
				var allDialogs = [];
				var seq = 0;
				function chnageProfile(options) {
					options = $.extend({title: "Change your Profile Image"}, options || {});
				 	var dialog = new Boxy($("#profile-image-change"), options);
				  	allDialogs.push(dialog);
				  	return false;
				}
       		</script>
			<div class="user-home-container user-home-links">
				<ul>
        	        <li style="padding: 0; margin: 0 auto; border: none;"><a href="#" id="profile-image" onclick="return chnageProfile({modal: true});">Change Profile Image</a></li>
				</ul>
			</div>
			<div id='profile-image-change' class="index-register" style="display: none; background: none; margin: 0;">
			<?php
				if (isset($_POST['profile-image-submit'])) 
				{
					$uID = $_SESSION['twistuser']['id'];
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
						header('Location: ./profile.php');  
					}
				} 
				?>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="login_form" id="profile-image-form" method="POST" enctype="multipart/form-data">
					<ul>
						<li>
							<label>Select Image</label>
							<input type="file" name="profileimg" id="profileimg" value="" />
						</li>
						<li>Note: Please select either JPG/JPEG or PNG Files of size less than 10MB</li>
					</ul>
					<ul>
						<li class="button">
							<input type="hidden" name="formsubmitted" value="TRUE" />
							<input type="submit" name="profile-image-submit" id="submit" value="Next" class="submit" />
						</li>
					</ul>
				</form>
			</div> 
		<?php 
		} ?>
        <div class="user-home-container user-home-links">
			<script type="text/javascript">
				var allDialogs = [];
				var seq = 0;
				function inviteFriend(options) {
					options = $.extend({title: "Invite your Friends to TwisT"}, options || {});
				 	var dialog = new Boxy($("#invite-friend"), options);
				  	allDialogs.push(dialog);
				  	return false;
				}
            </script>
            <ul>
                <li><a style="background: url('./images/updates.png') no-repeat;" href="./profile.php#updates">View Recent Updates</a></li>
                <li><a style="background: url('./images/profile.png') no-repeat;" href="./profile.php#personalinfo">View My Profile</a></li>
                <li><a style="background: url('./images/edit.png') no-repeat;" href="./profile.php#personalinfo">Edit My Profile</a></li>
                <li><a style="background: url('./images/search.png') no-repeat;" href="./profile.php#interests">Browse Categories</a></li>
                <li><a style="background: url('./images/invite.png') no-repeat;" href="#" id="invite" onclick="return inviteFriend({modal: true});">Invite Your Friends</a></li>
            </ul>
        </div>
		<div id='invite-friend' class="index-register" style="display: none; background: none; margin: 0;">
			<script type="text/javascript">
                $(document).ready(function(){
                    $("#invite-friend-form").validate();
                });
            </script>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="login_form" id="invite-friend-form" method="POST">
                    <ul>
                        <li>
                            <label for="youremail">Your Email</label>
                            <input type="text" name="youremail" id="youremail" value="<?php echo $_SESSION['twistuser']['email'] ?>" class="required" />
                        </li>
						<li>
                            <label for="friendemail">Friend's Email</label>
                            <input type="text" name="friendemail" id="friendemail" value="" class="required" />
                        </li>
						<li>
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" id="subject" value="You're Invited to TwisT" class="required" />
                        </li>

                        <li>
                            <label for="message">Messgae</label>
                            <textarea name="message" id="message" value="" class="" >Hi, I've been using TwisT and thought you might like to try it out. Here's an invitation to create an account.</textarea>
                        </li>

                        <li class="button" style="margin: 0;">
                            <input type="hidden" name="formsubmitted" value="TRUE" />
                            <input type="submit" name="invite-submit" id="invite-submit" value="Invite Now" class="submit" />
                        </li>
                    </ul>
                </form>
		</div> 
        <div class="user-home-container">            
		<?php
			$buddies = myOnlineBuddies($uID);
			if(!empty($buddies))
			{
				$buddylist = array();
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
				echo "
				<h4>".count($buddylist)." Buddies Online</h4>
				";
				for($i=0;$i<count($buddylist);$i++)
				{
					echo "
					<div class='whosonline'>
						<a href='user.php?id=".$buddylist[$i]['id']."' title='".$buddylist[$i]['fname']." ".$buddylist[$i]['lname']."'>
							<img src='./uploads/profile/thumb_".$userObj->getProfileData($buddylist[$i]['id'],'photo')."' alt='".$buddylist[$i]['fname']." ".$buddylist[$i]['lname']."' />
						</a>
					</div>
					";
				}
			}
			else
				echo "
				<h4>No Buddies Online</h4>
				";
			?>
			
            
        </div>
    </div>
 	<!-- User Home Page Left Part End -->