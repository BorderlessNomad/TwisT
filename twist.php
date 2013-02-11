						<?php
						include('./includes/functions.inc.php');
						include('./classes/content.class.php');
						include('./classes/categories.class.php');
						include('./classes/users.class.php');
						include('./classes/buddies.class.php');
						include('./classes/updates.class.php');
						include('./classes/suggestions.class.php');
						include('./classes/twist.class.php');
						
						$uID = $_GET['userid'];
						$twistObj = new Twist();
						
						if(isset($_GET['catid']) && !isset($_GET['artid']))
						{
							$currentCat = array();
							for($x=0;$x<1;$x++)
							{
								$c = $twistObj->twistCatagory($uID,$currentCat);
							?>
								<script type="text/javascript">
									$(document).ready(function() {
										var cat = 'userid=<?php echo $uID; ?>&catid=<?php echo $x; ?>';
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
									for($y=0;$y<3;$y++)
									{
									?>
									<script type="text/javascript">
									$(document).ready(function() {
										var art = 'userid=<?php echo $uID; ?>&catid=<?php echo $c[0]; ?>&artid=<?php echo $y; ?>';
										$("#twistcat<?php echo $x."_".$y; ?>").click(function() {
											$("#cat_<?php echo $x."_".$y; ?>").flip({
												direction:'rl',
												color: '#FFF',
												content: function() {
													$.ajax({
														url : "./twist.php",
														type : "GET",
														data : art,
														cache: false,
														success : function (response) {
															$("#cat_<?php echo $x."_".$y; ?>").html(response);
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
						}
						
						if(isset($_GET['catid']) && isset($_GET['artid']))
						{
							$currentArt = array();
							$catid = $_GET['catid'];
							$artid = $_GET['artid'];
							$c = $twistObj->twistContent($catid,$currentArt);
							
							for($y=0;$y<1;$y++)
							{
							?>
							<script type="text/javascript">
							$(document).ready(function() {
								var art = 'userid=<?php echo $uID; ?>&catid=<?php echo $catid; ?>&artid=<?php echo $y; ?>';
								$("#twistcat<?php echo $catid."_".$y; ?>").click(function() {
									$("#cat_<?php echo $catid."_".$y; ?>").flip({
										direction:'rl',
										color: '#FFF',
										content: function() {
											$.ajax({
												url : "./twist.php",
												type : "GET",
												data : art,
												cache: false,
												success : function (response) {
													$("#cat_<?php echo $catid."_".$y; ?>").html(response);
												},
											});
										},
									});
								});
							});
							</script>
							<?php
								echo "
								<li id='obj_".$catid."_".$y."'>
									<div class='feed-item-image'>
										<a href='#' title='Content'>
										<img src='./images/content_no_image.png' alt='Content Image' /></a>
									</div>
									<div class='feed-item-content'>
										<div class='feed-item-content-title'>
											<a href='articles.php?id=".$c[0]."' title='content'>".$c[1]."</a>											
										</div>
										<div class='feed-item-content-intro'>
											<a href='articles.php?id=".$c[0]."' title='description'>".$c[2]."</a>
										</div>
										<div class='feed-item-content-links'>
											<a href='articles.php?id=".$c[0]."' title='Readmore'>Read more</a>
											<a href='#' title='Like'>Like</a>
											<a href='#' title='Twist' id='twistobj".$catid."_".$y."'>Twist</a>
										</div>
									</div>
								</li>";
							}
						}
						?>