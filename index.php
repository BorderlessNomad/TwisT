<?php
include ('./includes/config.php');
include ('header.php');
if($_SESSION['loggedIn'])	//If user is already logged in
{
	header("Location: ./home.php");
	exit;
}
else
{
?>
<title>Welcome to TwisT</title>
    <div class="container">
        <div class="index-left">
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#index-login-form").validate();
                });
            </script>
            <div class="index-login">
                <h1>Login</h1>
                <div>
                <?php
                    //If the form is submitted
                    if (isset($_POST['login-submit'])) {
                        $hasError = false;
                        //Check to make sure that a valid email address is submitted
                        if (trim($_POST['logemail']) == '') {
                            $hasError = true;
                            echo "Email Empty<br />";
                        } else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['logemail']))) {
                            $hasError = true;
                            echo "Email Invalid<br />";
                        } else if ($_POST['logpassword'] == '') { //Check to make sure password is entered
                            $hasError = true;
                            echo "Please Enter Password<br />";
                        } else if (!checkEmailLogin($_POST['logemail'], $_POST['logpassword'])) {
                            $hasError = true;
                            echo "Email/Password doesn't match";
                        }
                        if (isset($_POST['remember_me']) && $_POST['remember_me'] == "1") {
                            setcookie("Twist_Auth_Email", $_SESSION['twistuser']['email'], time() + 3600*24*7);	//Set for 7 Days
							setcookie("Twist_Auth_Pass", $_SESSION['twistuser']['pass'], time() + 3600*24*7);
                        }

                        if (!$hasError) {
                            header('Location: ./register.php?step=1');
                        }
                    }
                ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="login_form" id="index-login-form" method="post">
                    <ul>
                        <li>
                            <label for="logemail">Email</label>
                            <input type="text" name="logemail" id="logemail" value="" class="required" />
                        </li>

                        <li>
                            <label for="logpassword">Password</label>
                            <input type="password" name="logpassword" id="logpassword" value="" class="required" />
                        </li>

                        <li class="button" style="margin-top:10px;">
                            <input type="hidden" name="formsubmitted" value="TRUE" />
                            <input type="submit" name="login-submit" id="login-submit" value="Login" class="submit" />
                        </li>
                    </ul>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#index-register-form").validate();
            });
        </script>
        <div class="index-register">
            <h1>Register</h1>
            <div>
            <?php
                //If the form is submitted
                if (isset($_POST['register-submit'])) {
                    $hasError = false;
                    //Check to make sure that a valid email address is submitted
                    if (trim($_POST['email']) == '') {
                        $hasError = true;
                        echo "Email Empty<br />";
                    } else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
                        $hasError = true;
                        echo "Email Invalid<br />";
                    } else if (checkEmailExist(trim($_POST['email']))) {
                        $hasError = true;
                        echo "Email already Exists<br />";
                    } else {
                        $_SESSION['registeruser']['email'] = mysql_real_escape_string($_POST['email']);
                    }

                    //Check to make sure that the firstname field is not empty
                    if (trim($_POST['firstname']) == '') {
                        $hasError = true;
                        echo "Firstname Empty<br />";
                    } else {
                        $_SESSION['registeruser']['fname'] = mysql_real_escape_string($_POST['firstname']);
                    }

                    //Check to make sure that the lastname field is not empty
                    if (trim($_POST['lastname']) == '') {
                        $hasError = true;
                        echo "Lastname Empty<br />";
                    } else {
                        $_SESSION['registeruser']['lname'] = mysql_real_escape_string($_POST['lastname']);
                    }

                    //Check to make sure password is entered
                    if ($_POST['password'] == '') {
                        $hasError = true;
                        echo "Please Enter Password<br />";
                    } else if ($_POST['password'] != $_POST['confirm_password']) {
                        $hasError = true;
                        echo "Passwords Don't Match<br />";
                    } else {
                        $_SESSION['registeruser']['passw'] = $_POST['password'];
                    }

                    if (!$hasError) {
                        header('Location: ./register.php?step=1');
                    }
                }
                ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="register_form" id="index-register-form" method="post">
                    <ul>
                        <li>
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" value="" class="required" />
                        </li>

                        <li>
                            <label for="firstname">First Name</label>
                            <input type="text" name="firstname" id="firstname" value="" class="required" minlength="3" />
                        </li>

                        <li>
                            <label for="lastname">Last Name</label>
                            <input type="text" name="lastname" id="lastname" value="" class="required" minlength="3" />
                        </li>

                        <li>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" value="" class="required" minlength="6" />
                        </li>

                        <li>
                            <label for="confirm_password">Repeat Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" value="" class="required" minlength="6" />
                        </li>

                        <li class="button" style="margin-left:0;">
                            <input type="hidden" name="formsubmitted" value="TRUE" />
                            <input type="submit" name="register-submit" id="register-submit" value="Register Now" class="submit" />
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
    <div class="index-right">
        <h1>Welcome to TwisT</h1>
        <p>Twist is an Open World Knowledge Sharing Network which provides a platform to the users searching information on the same project that directly publishes the new updates for a desired category or group of categories to the people who had enrolled as that category for their Personal interest.</p>
        <p>It also asks the users to make friends on the web searching for the same articles by selecting the interested categories; the application provides the user with the latest updates from the various sites. If the user needs more information then user will be redirected to the sites providing latest news and updates.</p>
        <p>Here the basic aim of Twist which is "Instead users searches information, information searches users" Is defined.</p>
        <p>Till now we have seen use of the Cloud computing only in very large Systems which are not available for general public. But use of same for Twist as a Backbone enables to tracks the user's location and hence routes the user's request to the geographically nearest available Server. This will also help to publish the local information based on users' location.</p>
        <p>"Twist is not a social networking platform but it is being developed for collaborating and searching knowledge on the web."</p>
    </div>
</div>
<?php } ?>
<?php include('footer.php'); ?>