<?php session_start(); ?>
<?php require_once('../config/config.php');
$con = new connection();

if(isset($_POST['submit']) && $_POST['submit']=='signup'){
	echo $user_email = mysqli_real_escape_string($con->mysqli,$_POST['user_firstname']);
	echo $user_email = mysqli_real_escape_string($con->mysqli,$_POST['user_lastname']);
	echo $user_email = mysqli_real_escape_string($con->mysqli,$_POST['user_gender']);
	echo $user_email = mysqli_real_escape_string($con->mysqli,$_POST['user_age']);
	echo $user_email = mysqli_real_escape_string($con->mysqli,$_POST['user_phone']);
	echo $user_email = mysqli_real_escape_string($con->mysqli,$_POST['user_city']);
	echo $user_email = mysqli_real_escape_string($con->mysqli,$_POST['user_state']);
	echo $user_email = mysqli_real_escape_string($con->mysqli,$_POST['user_country']);
	echo $user_email = mysqli_real_escape_string($con->mysqli,$_POST['user_email']);
	echo $user_email = mysqli_real_escape_string($con->mysqli,$_POST['user_email']);
	
 	echo $user_username = mysqli_real_escape_string($con->mysqli,$_POST['user_username']);
 	echo $user_password = mysqli_real_escape_string($con->mysqli,$_POST['user_password']); 
 	//$con->user_signup();

}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=1,initial-scale=1,user-scalable=1" />
	<title>Simple App</title>
	
	<link href="http://fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css" />
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

	<section class="container">
			<section class="signup-form">
				<form method="post" action="" role="login">
					<img src="assets/images/logo2.png" class="img-responsive" alt="" />
					<h2 class="h2" align="center">SignUpForm</h2>
					<input type="text" name="user_firstname" placeholder="Firstname" required class="form-control input-lg">
					<input type="text" name="user_lastname" placeholder="LastName" required class="form-control input-lg">
					<input type="radio" name="user_gender" value="1">
					Male
					<input type="radio" name="user_gender" value="0">
					Female
					<br>
					<input type="number" name="user_age" placeholder="Age" required class="form-control input-lg">
					Date Of Birth
					<input type="date" name="user_dob" required class="form-control input-lg">
					<br>
					<input type="text" name="user_phone" required class="form-control input-lg" placeholder="Phone Number">
					<input type="text" name="user_username" required class="form-control input-lg" placeholder="UserName">
					<input type="email" name="user_email" placeholder="Email" required class="form-control input-lg" />
					<input type="password" name="user_password" placeholder="Password" required class="form-control input-lg" />
					<button type="submit" name="submit" class="btn btn-lg btn-primary btn-block" value="signup">Sign Up</button>
					<div>
						<a href="signup.php">Create account</a> or <a href="#">reset password</a>
					</div>
				</form>
				<!--<div class="form-links">
					<a href="#">www.website.com</a>
				</div>-->
			</section>
	</section>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>