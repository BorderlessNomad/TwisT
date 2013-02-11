else if($(this).hasClass("username"))
            {
                var username = $("#username").val();
                var myUsername = "usernamer=" + username;
                if(username.length >= 6)
                {
                    $.ajax(
                    {
                        type: "POST",
                        url: "check.php",
                        data: myUsername,
                        success:
                        function(server_response)
                        {
                            if(server_response == '0')
                            {
                                $("#username").parent().append("<span class='error'>Username Available</span>");
                                $("#username").addClass("inputError");
                            }
                            else
                            {
                                $("#username").parent().append("<span class='error'>Username Unavailable</span>");
                                $("#username").addClass("inputError");
                                $(this).val()=='';
                                hasError = true;
                            }
                        }
                    });
                }
                else
                {
                    $(this).parent().append("<span class='error'>Username must be atleast 6 characters long</span>");
                    $(this).addClass('inputError');
                    hasError = true;
                }
            }