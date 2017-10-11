<?php session_start(); ?>
<?php

require_once ('../config/config.php');
$con = new connection();
if (isset($_REQUEST['status'])) {
    echo "<h3 class='h3 alert-success'><b>Registraton Success . Please Login</b></h3>";
}
if (isset($_POST['submit']) && $_POST['submit'] == 'login') {
    // echo $user_email = mysqli_real_escape_string($con->mysqli,$_POST['user_email']);
    $user_username = mysqli_real_escape_string($con->mysqli, $_POST['user_username']);
    $user_password = mysqli_real_escape_string($con->mysqli, $_POST['user_password']);
    $con->user_login($user_username, $user_password);
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=1,initial-scale=1,user-scalable=1" />
<title>Simple App</title>

<link
	href="http://fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900"
	rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css"
	href="assets/bootstrap/css/bootstrap.min.css" />
    <link href="assets/js/jquery.datepick.package-5.1.0/css/jquery.datepick.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="assets/css/styles.css" />

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

	<section class="container">
		<section class="login-form">
			<form method="post" action="" role="login" id="loginForm">
				<img src="assets/images/logo2.png" class="img-responsive" alt="" />
				<h2 class="h2" align="center">LoginForm</h2>
				<input type="text" name="user_username" placeholder="Username"
					required class="form-control input-lg" /> <input type="password"
					name="user_password" placeholder="Password" required
					class="form-control input-lg" />
				<button type="submit" name="submit"
					class="btn btn-lg btn-primary btn-block" value="login">Sign in</button>
				<div>
					<a href="signup.php">Not Memeber ?</a> or <a href="reset.php">reset
						password</a>
				</div>
			</form>
			<!--<div class="form-links">
					<a href="#">www.website.com</a>
				</div>-->
		</section>
	</section>

	<script
		src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	 <script src="assets/js/jquery.datepick.package-5.1.0/js/jquery.plugin.min.js"></script>
    <script src="assets/js/jquery.datepick.package-5.1.0/js/jquery.datepick.js"></script>
	<script src="assets/js/jquery.validate.js"></script>
	<script src="assets/js/custom.js" type="text/javascript"></script>
</body>
</html>
