$().ready(function() {

// validate signup form on keyup and submit
		$("#signupForm").validate({
			rules: {
				user_firstname: "required",
				user_lastname: "required",
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
				user_age :{
					min:18
				}
			},
			messages: {
				user_firstname: "Please enter your firstname",
				user_lastname: "Please enter your lastname",
				user_username: {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 2 characters"
				},
				user_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				user_email: "Please enter a valid email address",
				user_age: "Age Should be 18 or more"
			}
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
				},
			},
			messages: {
				user_username: {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 2 characters"
				},
				user_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
			}
		});
		
});