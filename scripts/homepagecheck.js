/***************************************************
 REGISTER FORM VALIDATION JAVASCRIPT
 ***************************************************/
$(document).ready(function ()
{
	$("form#home-register-form").submit(function ()
	{
		$("form#home-register-form .error").remove();
		var hasError = false;
		$("form#home-register-form .requiredField").each(function ()
		{
			$email = $("#email").val();
			$fname = $("#firstname").val();
			$lname = $("#lastname").val();
			$pass1 = $("#password1").val();
			$pass2 = $("#password2").val();
			
			if (jQuery.trim($(this).val()) == "")
			{
				var labelText = $(this).prev("label").text();
				$(this).parent().append("<span class='error'>This field is required</span>");
				$(this).addClass("inputError");
				hasError = true;
			}
			else if ($(this).hasClass("email"))
			{
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if (!emailReg.test(jQuery.trim($(this).val())))
				{
					$(this).parent().append("<span class='error'>Email address is Invalid</span>");
					$(this).addClass("inputError");
					hasError = true;
				}
				else
				{
					var myEmail = "emailcheck=" + email;
					$.ajax(
					{
						type: "POST",
						url: "./includes/check.php",
						data: myEmail,
						success: 
								function(server_response) 
								{ 
										if(server_response == '0')
										{
											$("#username").parent().append("<span class='error'>Email Available</span>");
											$("#username").addClass("inputError");
										}
										else
										{
											$("#username").parent().append("<span class='error'>Email Unavailable</span>");
											$("#username").addClass("inputError");
											$(this).val()=='';
											hasError = true;
										}
								}
					});
				}
			}

			else if ($(this).hasClass("firstname"))
			{
				if($fname.length < 3)
				{
					$(this).parent().append("<span class='error'>Minimum 3 characters are required</span>");
					$(this).addClass("inputError");
					hasError = true;
				}
			}
			else if ($(this).hasClass("lastname"))
			{
				if($lname.length < 3)
				{
					$(this).parent().append("<span class='error'>Minimum 3 characters are required</span>");
					$(this).addClass("inputError");
					hasError = true;
				}
			}
			else if ($(this).hasClass("password_o"))
			{
				if($pass1.length < 6)
				{
					$(this).parent().append("<span class='error'>Minimum 6 characters are required</span>");
					$(this).addClass("inputError");
					hasError = true;
				}
			}
			else if ($(this).hasClass("password_r"))
			{
				if($pass2.length < 6)
				{
					$(this).parent().append("<span class='error'>Minimum 6 characters are required</span>");
					$(this).addClass("inputError");
					hasError = true;
				}
			}
			if($pass1 != $pass2)
			{
				$("#password2").parent().append("<span class='error'>Passwords don\'t match</span>");
				$("#password2").addClass("inputError");
				hasError = true;
			}
		});
		return false;
	});
});