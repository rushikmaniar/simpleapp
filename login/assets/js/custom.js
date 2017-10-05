var flag = 1;
$(document).ready(function() {

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
			},submitHandler: function(form){
			///	alert("form submitted");
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

$('#signupForm').on("submit",function() {
			//alert("submit");
	    	if(flag == 0)
	    	{
	    	//alert("called");
			$('input[name=user_username]').before('<label class="error" for="user_username">username already exists</label>');
			return false;
			}else{
				//alert("sign");
			}
		});

$("#signupForm").on("submit",function(){
			var user_username1 = $('input[name=user_username]').val();
			var user_phone = $('input[name=user_phone]').val();
			var user_email = $('input[name=user_phone]').val();

			console.log(user_username1);
			$.ajax({
				url : 'check_username.php',
				type : 'post',
				data : {user_username: user_username1},
				success : function(data){
					var temp = data;
					if(temp == 0){
						flag = 1;
					}
					else{
						console.log(data);
						$('input[name=user_username]').before('<label class="error" for="user_username">username already exists</label>');
						flag = 0;
						return false;
						}
					
				},
				error : function(data){
					console.log(data);
				}
			});
});

