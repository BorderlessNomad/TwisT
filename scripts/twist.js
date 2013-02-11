/***	Index Login Check	***/
$(document).ready(function(){
	$("#index-login-form").validate({
		errorElement: "span",
		errorPlacement: function(error, element) {
			error.appendTo(element.prev());
		},
		highlight: function(element, errorClass) {
			$(element).fadeIn();
		},
		rules: {
			logemail: {
				required: true,
				email: true,
			},
			logpassword: {
				required: true,
				minlength: 6,
				remote: {
					url : 'includes/login.php?task=login',
					data : {
						logemail : function() {
							return $('#logemail').val();
						},
						logpassword : function() {
							return $('#logpassword').val();
						}
					},
				}
			}
		},
		messages: {
			logemail: {
				required: "Please enter your email address",
				email: "Email address is invalid",
			},
			logpassword: {
				required: "Please enter your a password",
				minlength: "Minimum 6 Characters are required",
				remote: jQuery.format("Incorrect Email/Password")
			}							
		}
	});
});

/***	Index Register Check	***/
$(document).ready(function(){
	$("#index-register-form").validate({
		errorElement: "span",
		errorPlacement: function(error, element) {
		 	error.appendTo(element.prev());
	   	},
		highlight: function(element, errorClass) {
			$(element).fadeIn();
		},
		rules: {
			email: {
				required: true,
				email: true,
				remote: "includes/check.php?task=email"
			},
			firstname: {
				required: true,
				minlength: 3
			},
			lastname: {
				required: true,
				minlength: 3
			},
			password: {
				required: true,
				minlength: 6
			},
			confirm_password: {
				required: true,
				minlength: 6,
				equalTo: "#password"
			},
		},
		messages: {
			email: {
				required: "Please enter your email address",
				email: "Email address is invalid",
				remote: jQuery.format("Email is already in use")
			},
			firstname: {
				required: "Please enter your firstname",
				minlength: "Minimum 3 Characters are required"
			},
			lastname: {
				required: "Please enter your lastname",
				minlength: "Minimum 3 Characters are required"
			},
			password: {
				required: "Please enter your a password",
				minlength: "Minimum 6 Characters are required"
			},
			confirm_password: {
				required: "Please enter your a password",
				minlength: "Minimum 6 Characters are required",
				equalTo: "Password doesn't match"
			},					
		}
	});
});

/***	Reggistration Page Step 1	***/
$(document).ready(function(){
	$("#register-form-step1").validate({
		errorElement: "span",
		errorPlacement: function(error, element) {
			error.appendTo(element.prev());
		},
		highlight: function(element, errorClass) {
			$(element).fadeIn();
		},
		rules: {
			gender: {
				required: true,
			},
			day: {
				required: true,
			},
			month: {
				required: true,
			},
			year: {
				required: true,
			},
		},
		messages: {
			gender: {
				required: "Please slect your gender",
			},
			day: {
				required: "Please enter your birthday",
			},
			month: {
				required: "Please enter your birthday",
			},
			year: {
				required: "Please enter your birthday",
			},					
		}
	});
});

/***	Friend Request	***/
$(document).ready(function(){
	$("#invite-friend-form").validate({
		errorElement: "span",
		errorPlacement: function(error, element) {
		 	error.appendTo(element.prev());
	   	},
		highlight: function(element, errorClass) {
			$(element).fadeIn();
		},
		rules: {
			youremail: {
				required: true,
				email: true,
			},
			friendemail: {
				required: true,
				email: true,
			},
			subject: {
				required: true,
				minlength: 6
			},
			message: {
				required: true,
				minlength: 10,
				remote: {
					url : 'includes/login.php?task=friend',
					type : 'GET',
					data : {
						from : function() {
							return $('#youremail').val();
						},
						to : function() {
							return $('#friendemail').val();
						},
						subject : function() {
							return $('#subject').val();
						},
						/*mailmessage : function() {	Default Pass
							return $('#message').val();
						},*/
					},
				}
			}
		},
		messages: {
			youremail: {
				required: "Please enter your email address",
				email: "Email address is invalid",
			},
			friendemail: {
				required: "Please enter friend's email address",
				email: "Email address is invalid",
			},
			subject: {
				required: "Please enter your firstname",
				minlength: "Minimum 6 Characters are required"
			},
			message: {
				required: "Please enter your lastname",
				minlength: "Minimum 10 Characters are required",
				remote: jQuery.format("Unable to Send Request")
			}				
		}
	});
});