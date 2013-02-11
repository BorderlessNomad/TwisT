<?php 
include('header.php'); 

//If the category form is submitted
if(isset($_POST['addcat-submit'])) 
{				
	$hasError = false;
	//Check to make sure that a valid email address is submitted
	if(trim($_POST['catname']) == '')  
	{
		$hasError = true;
		echo "Category Name Empty<br />";
	} 
	else 
	{
		$catname = mysql_real_escape_string($_POST['catname']);
		$addcat = new Categories();
		$addcat->addNewCategory($catname);
		echo "$catname added successfully";
	}
}

//If the article form is submitted
if(isset($_POST['addart-submit'])) 
{				
	$hasError = false;
	//Check to make sure that a valid email address is submitted
	if(trim($_POST['artcat']) == '')  
	{
		$hasError = true;
		echo "Please Select Category<br />";
	}
	else if(trim($_POST['artname']) == '')  
	{
		$hasError = true;
		echo "Please Enter Article Name<br />";
	}
	else if(trim($_POST['artcontent']) == '')  
	{
		$hasError = true;
		echo "Please Enter Article Content<br />";
	}  
	else 
	{
		$artcat = mysql_real_escape_string($_POST['artcat']);
		$artname = mysql_real_escape_string($_POST['artname']);
		$artcontent = mysql_real_escape_string($_POST['artcontent']);
		
		$addart = new Content();
		$addart->addNewContent($artcat,$artname,$artcontent);
		echo "Article added successfully";
	}
}
?>
<div class="container">
    <!-- User Home Page Left Part -->
    <div class="home-left">
        <div class="username-home"><h3>Welcome, Admin</h3></div><div class="user-home-container user-home-links">
            <ul>
                <li><a style="background: url('./images/updates.png') no-repeat;" href="?add=category">Add New Category</a></li>
                <li><a style="background: url('./images/edit.png') no-repeat;" href="?add=article">Add New Article</a></li>
            </ul>
        </div>
    </div>

    <!-- User Home Page Middle Part -->
    <div class="home-middle" style="width:740px; margin-right:0;">
		<?php 
			if(isset($_GET['add']))
			{
				if($_GET['add'] == 'category')
				{ ?>
					<div class="index-register">
						<h1>Add new Category</h1>
						<div>
							<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="register_form" id="admin-addcat-form" method="post">
								<ul>
									<li>
										<label for="catname">Category Name</label>
										<input type="text" name="catname" id="catname" value="" />
									</li>
			
									<li class="button">
										<input type="hidden" name="formsubmitted" value="TRUE" />
										<input type="submit" name="addcat-submit" id="addcat-submit" value="Add Now" class="submit" />
									</li>
								</ul>
							</form>
						</div>
					</div>									
				<?php }
				else if($_GET['add'] == 'article')
				{ ?>
					<div class="index-register">
						<h1>Add new Article</h1>
						<div>
							<?php $cat = new Categories(); ?>
							<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="register_form" id="admin-addart-form" method="post">
								<ul>
									<li>
										<label for="artcat">Article Category</label>
										<select name="artcat" id="artcat">
										  	<option value="">--Select--</option>
										  	<?php
												$catlist = $cat->listCategories(); 
												foreach($catlist as $id)
												{
													echo "<option value='".$id."'>".$cat->getCategoryFromID($id)."</option>";
												}
											?>
										</select>
									</li>
									
									<li>
										<label for="artname">Article Name</label>
										<input type="text" name="artname" id="artname" value="" />
									</li>
									
									 <li>
										<label for="artcontent">Content</label>
										<textarea name="artcontent" id="artcontent" value="" ></textarea>
									</li>
			
									<li class="button">
										<input type="hidden" name="formsubmitted" value="TRUE" />
										<input type="submit" name="addart-submit" id="addart-submit" value="Add Now" class="submit" />
									</li>
								</ul>
							</form>
						</div>
					</div>										
				<?php }
				else
				{
					echo "Invalid Request Type";
				}
			}
			else
			{
				echo "Please select Task";
			}
		?>
    </div>

    <!-- User Home Page Right Part --></div>
<?php include('footer.php'); ?>