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
?>
<title>Twist :: Home</title>
<div class="container">
	<?php include('left.php'); ?>
	<!-- User Home Page Middle Part -->
    <div class="home-middle">
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
                <li><a href="#latest">Latest</a></li>
                <li><a href="#popular">Popular</a></li>
            </ul>

            <div class="tab_container">
                <div id="latest" class="tab_content">
                    <ul class="content-feed">
						<?php
						$noOfCats = 1;	//Number of Categories to display
						$noOfArts = 3;	//Number of Articles in each category
						$currentCat = array();
						$twistObj = new Twist();
						for($x=0;$x<$noOfCats;$x++)
						{
							$c = $twistObj->twistCatagory($_SESSION['twistuser']['id'],$currentCat);
						?>
							<script type="text/javascript">
								$(document).ready(function() {
									var cat = 'userid=<?php echo $uID; ?>&catid=<?php echo $c[0]; ?>';
									$("#twistcat<?php echo $x; ?>").click(function() {
										$("#cat_<?php echo $x; ?>").flip({
											direction:'lr',
											color: '#FFF',
											content: function() {
												$.ajax({
													url : "./twist.php",
													type : "GET",
													data : cat,
													cache: false,
													success : function (response) {
														$("#cat_<?php echo $x; ?>").html(response);
													},
												});
											},
										});
									});
								});
							</script>
							<li id="cat_<?php echo $x; ?>">
								<div class="content-cat-title">
								<?php 
								echo "
									<a href='categories.php?id=".$c[0]."' title='".$c[1]."'><h4>".$c[1]."</h4></a>";
									$currentCat[] = $c[0];
								?>
                           			<span><a href="#" title="Twist" id="twistcat<?php echo $x; ?>">Twist</a></span>
                    			</div>  
                        		<ul>
								<?php
								$i=2;
								for($y=0;$y<$noOfArts;$y++)
								{
								?>
								<script type="text/javascript">
									$(document).ready(function() {
										var art = 'userid=<?php echo $uID; ?>&catid=<?php echo $c[0]; ?>&artid=<?php echo $y; ?>';
										$("#twistobj<?php echo $x."_".$y; ?>").click(function() {
											$("#obj_<?php echo $x."_".$y; ?>").flip({
												direction:'rl',
												color: '#FFF',
												content: function() {
													$.ajax({
														url : "./twist.php",
														type : "GET",
														data : art,
														cache: false,
														success : function (response) {
															$("#obj_<?php echo $x."_".$y; ?>").html(response);
														},
													});
												},
											});
										});
									});
								</script>
								<?php
									echo "
									<li id='obj_".$x."_".$y."'>
										<div class='feed-item-image'>
											<a href='#' title='Content'>
											<img src='./images/content_no_image.png' alt='Content Image' /></a>
										</div>
										<div class='feed-item-content'>
											<div class='feed-item-content-title'>
												<a href='articles.php?id=".$c[$i]."' title='content'>".$c[$i+1]."</a>											
											</div>
											<div class='feed-item-content-intro'>
												<a href='articles.php?id=".$c[$i]."' title='description'>".$c[$i+2]."</a>
											</div>
											<div class='feed-item-content-links'>
												<a href='articles.php?id=".$c[$i]."' title='Readmore'>Read more</a>
												<a href='#' title='Twist' id='twistobj".$x."_".$y."'>Twist</a>
											</div>
										</div>
									</li>";
									$i = $i + 3;
								} ?>
								</ul>
							</li>
						<?php
						}
						?>
					</ul>
				</div>
		        <div id="popular" class="tab_content">
                   <ul class="content-feed">
						<?php
						$twistObj = new Twist();
						$popCats = $twistObj->twistCatagoryPopular();
						//var_dump($popCats);
						$i = 0;
						foreach($popCats as $catlist)
						{
							foreach($catlist as $key=>$value)
							{
								$popularCats[$i][$key] = $value; 
							}
							$i++;
						}
						
						for($i=0;$i<count($popularCats);$i++)
						{
						?>
						<li>
                            <div class="content-cat-title">
                                <a href="categories.php?id=<?php echo $popularCats[$i][0]; ?>" title="<?php echo $popularCats[$i][1]; ?>"><h4><?php echo $popularCats[$i][1]; ?></h4></a><!-- Category Name -->
                            </div>
                            <ul>
							<?php
								for($j=3;$j<=11;$j+=3)
								{
							?>
								<li>
                                    <div class="feed-item-image">
                                        <a href="#" title="Content"><img src="./images/content_no_image.png" alt="Content Image" /></a>
                                    </div>
                                    <div class="feed-item-content">
                                        <div class="feed-item-content-title">
                                            <a href="articles.php?id=<?php echo $popularCats[$i][$j] ?>" title="Content"><?php echo $popularCats[$i][$j+1] ?></a>
                                        </div>
                                        <div class="feed-item-content-intro">
                                            <a href="articles.php?id=<?php echo $popularCats[$i][$j] ?>" title="Content"><?php echo $popularCats[$i][$j+2] ?></a>
                                        </div>
                                        <div class="feed-item-content-links">
                                            <a href="articles.php?id=<?php echo $popularCats[$i][$j] ?>" title="Readmore">Read more</a>
                                        </div>
                                    </div>
                                </li>
							<?php
								}
							?>
                            </ul>
                        </li>
						<?php
						}
						?>
					</ul>
                </div>
            </div>
        </div>
    </div>

    <!-- User Home Page Right Part -->
    <div class="home-right">
        <div class="user-home-container">
            <h4>Suggested Buddies</h4>
            <?php
				$sugObj = new Suggestions();
				$sug = $sugObj->GetSuggestionOnCategories($uID);
				for($i=0;$i<count($sug);$i++)
				{
					echo"
					<div class='whosonline'>
						<a href='user.php?id=".$sug[$i][0]."' title=".$sug[$i][1].">
						<img src=./uploads/profile/thumb_".$sug[$i][2]." /> 
						</a>
					</div> ";
				}
			?>
        </div>
    </div>
</div>
	<br/><br/>
	 <div class="home-right">
        <div class="user-home-container">
            <li><a href="accept.php">Pending Buddy Requests</a></li>
        </div>
    </div>



<?php } ?>
<?php include('footer.php'); ?>