<?php 
	include('./includes/config.php');
	include('./includes/functions.inc.php');
	include('./classes/content.class.php');
	include('./classes/categories.class.php');
	include('./classes/users.class.php');
	include('./classes/buddies.class.php');
	include('./classes/updates.class.php');
	include('./classes/suggestions.class.php');
	include('./classes/twist.class.php');
	
	if(checkLogin())
	{
		$_SESSION['loggedIn'] = true;
		$uID = $_SESSION['twistuser']['id'];
	}
	else
		$_SESSION['loggedIn'] = false;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="./styles/style.css"/>
        <link rel="stylesheet" href="./styles/tabs.css"/>
		<link rel="stylesheet" href="./styles/boxy.css"/>
        <script type="text/javascript" src="./scripts/jquery.js"></script>
		<script type="text/javascript" src="./scripts/jquery.ui.js"></script>
		<script type="text/javascript" src="./scripts/jquery.validate.js"></script>
		<script type="text/javascript" src="./scripts/jquery.flip.js"></script>
		<script type="text/javascript" src="./scripts/jquery.boxy.js"></script>
		<script type="text/javascript" src="./scripts/twist.js"></script>
    </head>
    <body>
        <div class="wrapper">
            <div class="header">
                <div class="logo">
                    <a href="index.php"><div class="logotwist"></div></a>
                </div>
				<div class="top-panel">
                    <div class="user-panel">
                        <ul>
                             <?php
							if ($_SESSION['loggedIn'])	//If user is already logged in
							{ ?>
							<li>
								<a href="">Updates</a>
								<ul>
							<?php	
								$updateObj = new Updates();
								$update = $updateObj->ShowUpdatesForUser($uID);
								
								$temp = 0;
								for($i=1;$i<10;$i+=2)
								{
									if($update[$i] != " ")
									{
										$temp = 1;
										echo "<li>".$update[$i]."</li>";
									}
									else 
									{
										if($temp == 0)
										{
											echo "<li>";
											echo "No Updates Found";
											echo "</li>";
											break;
										}
									}
								}
							?>
									<li style="float:right; border:none; background: none;"><a href="./profile.php">View All Updates</a></li>
								</ul>
							</li>
                            <li><a href="./profile.php">Profile</a></li>
                            <li><a href="./categories.php">Categories</a></li>
                            <li><a href="./includes/login.php?task=logout">Logout</a></li>
							<?php }
							?>
                            <li>
                                <form action="search.php" name="search" method="get">
                                    <input type="text" name="search" class="search-data" value="Search..." onclick="this.value='';" />
                                    <input type="submit" class="search-button" value="Search" />
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
			<div class="clear"></div>
			            <?php /*

            <div class="menu">
                <ul>
                    <li><a href="./home.php">Home</a></li>
                    <li><a href="./members.php">Members</a></li>
                    <li><a href="./categories.php">Categories</a>
                        <ul>
                            <li><a href="./categories.php?type=popular">Most Poplular</a></li>
                            <li><a href="./categories.php?type=recent">Recently Added</a></li>
                            <li><a href="./categories.php?type=featured">Featured</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
			*/?>