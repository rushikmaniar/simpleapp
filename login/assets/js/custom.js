var flag = 1;
$(document).ready(function () {
    $('#dob').datepick({dateFormat: 'yyyy-mm-dd'});
// validate signup form on keyup and submit
    $("#submitbtn").on("click", function () {
        $("#signupForm").validate({

            rules: {
                user_firstname: {
                    required: true
                },
                user_lastname: {
                    required: true
                },
                user_username: {
                    required: true,
                    minlength: 1
                },
                user_password: {
                    required: true,
                    minlength: 1
                },
                user_email: {
                    required: true,
                    email: true
                },
                user_age: {
                    required: true,
                    min: 18
                },
                user_gender: {
                    required: true
                }
            },
            messages: {
                user_firstname: {
                    required: "Please enter your firstname"
                },
                user_lastname: {
                    required: "Please enter your lastname"
                },
                user_username: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                user_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                user_email: {
                    required: "Please enter a valid email address"
                },
                user_age: {
                    required: "please enter age",
                    min: "Age should be 18 or more"
                },
                user_gender: {
                    required: "Please enter the gender"
                }
            },
            submitHandler: function (form) {

                var user_username1 = $('input[name=user_username]').val();
                var user_phone = $('input[name=user_phone]').val();
                var user_email = $('input[name=user_email]').val();

                //console.log(user_username1);
                $.ajax({
                    url: 'check_username.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        user_phone: user_phone,
                        user_email: user_email,
                        user_username: user_username1
                    },
                    success: function (data) {
                        console.log(data[0]);
                        //$str = json.str
                        var temp = data;

                        if (data[2] == 1) {
                            //alert("user dosent exisit");
                            //form.submit();
                        }
                        else {
                            $('input[name=user_username]').before('<label class="error" for="user_username">username already exists</label>');
                        }

                        if (data[1] == 1) {
                            //alert("email dosent exisit");
                            //form.submit();
                        }
                        else {
                            $('input[name=user_email]').before('<label class="error" for="user_email">email already exists</label>');
                        }

                        if (data[0] == 1) {
                            //alert("phone dosent exisit");
                            //form.submit();
                        }
                        else {
                            $('input[name=user_phone]').before('<label class="error" for="user_phone">phone already exists</label>');
                        }
                        if (data[0] == 1 && data[1] == 1 && data[2] == 1) {
                            //console.log(form.submit());
                            form.submit();
                        } else {
                            alert("notsubmit");
                            return false;
                        }

                    },
                    error: function (data) {
                        console.log('error');
                    }
                });
            }
        });
    });
});

$("#loginForm").validate({
    rules: {
        user_username: {
            required: true,
            minlength: 1
        },
        user_password: {
            required: true,
            minlength: 1
        }
    },
    messages: {
        user_username: {
            required: "Please enter a username",
            minlength: "Your username must consist of at least 2 characters"
        },
        user_password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
        }
    }
});
/*$("#testId").validate({
	rules:{
		faqir : {
			required : true
		}
	},
	messages : {
		faqir : {
			required : "Please enter name !"
		}
	},
	submitHandler : function(form){
		alert("form submitted");
		form.submit();
	}
});*/





