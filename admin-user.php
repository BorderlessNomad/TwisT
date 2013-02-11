<?php
include('./includes/config.php');
include('header.php');
if(isset($_POST['remuser-submit']))
{
	$userObj = new Users();
	$userObj->removeUser($_POST['remuserid']);
	echo "User Removed";
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="register_form" id="admin-remuser-form" method="POST">
<ul>
	<li>
		<label for="remuserid">Enter User ID</label>
		<input type="text" name="remuserid" id="remuserid" value="" />
	</li>
			
	<li class="button">
		<input type="submit" name="remuser-submit" id="remuser-submit" value="Remove User" class="submit" />
	</li>
</ul>
</form>