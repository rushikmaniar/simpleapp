<?php //config file?>
<?php
/*echo __FILE__;
echo "<br>";
echo __DIR__ ;
echo "<br>";
echo __FUNCTION__ ;
echo "<br>";
echo __CLASS__ ;
echo "<br>";
echo __METHOD__ ;
echo "<br>";
echo __LINE__  ;
echo "<br>";
echo __NAMESPACE__  ;
echo "<br>";*/
define('BASE_URL',str_replace(array('config'),'',__DIR__));
//echo BASE_URL;
define('BASE_PATH',$_SERVER['HTTP_HOST'].str_replace(array('config','user','admin','login'),'',dirname($_SERVER['SCRIPT_NAME'])));
//echo '<br>';
//echo BASE_PATH;
//echo "<br>";
//echo __FILE__;
//echo "<pre>";
//print_r($_SERVER);
//echo "</pre>";

/**
* Connection Class
*/
class connection
{
	public $mysqli;
	public $disable_id;
	public $insert_func;
	public $signup_query;
	public $add_query;
	function __construct()
	{
		$dbhost = 'localhost';
  		$dbuser = 'root';    $dbpass = 'mysql';    $dbname = 'simpleapp';
        // mysqli - start
        $this->mysqli = new mysqli("$dbhost", "$dbuser", "$dbpass", "$dbname");
		if($this->mysqli){
			//echo "<script type='text/javascript'>console.log('database connnection success');";
			echo '<script>console.log("connection success");</script>';
		}
		else{
			echo mysqli_error($this->mysqli);
		}
	}//construct ends

	function check_birthday($check_date){
		$current = strtotime(date('Y-m-d'));
		$user_date = strtotime($check_date);
		$day = ((($user_date - $current)/3600)/24);
		if($day <=10){
			if($day==0){
				echo "<h1 class='h2 alert-success'>Happy Birthday</h1>";
				?>
				<br><div align="center">
				<img src="assets/images/birthday.png" alt="happy birthday">
				</div>
				<?php
			}
			else if($day==1){
				echo "<h1 class='h1'>Tommorow is Your Birthday</h1>";
			}
			else if($day > 1 ){
				echo "<h1 class='h1'>Your Birthday in ".$day."days"."</h1>";
			}
			else{
				//echo "Birhtday not found";
			}
		}
		else{
				echo "Birhtday not found";
			}
	}
	function user_login($user_username,$user_check_password){
		//echo "hello";
		//exit();

		$query = "SELECT * FROM user
		 WHERE user_username = '$user_username'";
		$login = mysqli_query($this->mysqli,$query);
		/*if($login){
			//echo "success";
			//exit();
		}else{
			echo mysqli_error($this->mysqli);
		}*/

		$array = mysqli_fetch_array($login);

		
		
			//echo "hello";
			if(mysqli_num_rows($login) == 1){
				
				if($array['user_status'] == 0){

					echo "<script type='text/javascript'>alert('Admin has Deacativate You . Contact Admin');</script>";
					header("location:index.php");
				}else{
						if(password_verify($user_check_password,$array['user_password'])){
							//echo "verify";
							//exit();
							if($array['user_type'] == 'admin'){
								$_SESSION["user_username"] = $array['user_username'];
								$_SESSION["usertype"] = "admin";
								header("location:../admin/index.php");
							}
							else{
								$_SESSION["user_username"] = $array['user_username'];
								header("location:../user/index.php");
							}
						}else{
							//password not verfied
							echo "<font class='error'>login failed</font>";
						}
				}
			}else{
						//num of rows not 1 
						echo "<font class='error'>login failed</font>";
				}
	}//function end


	function user_signup(
		$user_firstname,
		$user_lastname,
		$user_gender,
		$user_age,
		$user_dob,
		$user_phone,
		$user_city,
		$user_state,
		$user_country,
		$user_email,
		$user_username,
		$user_password){


		$insert_query = "
		INSERT INTO user
		(user_firstname,
		user_lastname,
		user_gender,
		user_age,
		user_dob,
		user_phone,
		user_city,
		user_state,
		user_country,
		user_email,
		user_username,
		user_password,
		user_status)
		VALUES(
		'$user_firstname',
		'$user_lastname',
		$user_gender,
		$user_age,
		'$user_dob',
		$user_phone,
		'$user_city',
		'$user_state',
		'$user_country',
		'$user_email',
		'$user_username',
		'$user_password',
		1)
		";
		//echo "<br><br>";
		$this->signup_query = mysqli_query($this->mysqli,$insert_query);
		if($this->signup_query){
			echo "insert success";
		}else{
			echo "<h2 class='text-danger'> UserName Already Exists Or Something Wrong</h2>";
			echo mysqli_error($this->mysqli);
		}
	}

	function add_user(
		$user_firstname,
		$user_lastname,
		$user_gender,
		$user_age,
		$user_dob,
		$user_phone,
		$user_city,
		$user_state,
		$user_country,
		$user_email,
		$user_username,
		$user_password,
		$user_type){

		$user_password = password_hash($user_password,PASSWORD_DEFAULT);
		echo $insert_query = "
		INSERT INTO user
		(user_firstname,
		user_lastname,
		user_gender,
		user_age,
		user_dob,
		user_phone,
		user_city,
		user_state,
		user_country,
		user_email,
		user_username,
		user_password,
		user_status,
		user_type)
		VALUES(
		'$user_firstname',
		'$user_lastname',
		$user_gender,
		$user_age,
		'$user_dob',
		$user_phone,
		'$user_city',
		'$user_state',
		'$user_country',
		'$user_email',
		'$user_username',
		'$user_password',
		1,
		'$user_type')
		";
		//echo "<br><br>";
		$this->add_query = mysqli_query($this->mysqli,$insert_query);
		
	}


	function user_update_password(
		$user_password,
		$current_id
	){
		//echo $user_password.$current_id;
		$update_query = "UPDATE user
		SET user_password = '$user_password'
		WHERE user_id = $current_id
		 ";
		 $q = mysqli_query($this->mysqli,$update_query);

		if($q){
			echo "update success";
			}else{
			echo mysqli_error($this->mysqli);
		}
	}

	//without Password
	function user_update_profile(
 		$user_firstname,
		$user_lastname,
		$user_gender,
		$user_age,
		$user_dob,
		$user_phone,
		$user_city,
		$user_state,
		$user_country,
		$user_email,
		$user_username,
		$current_id
	){
		$update_query = "UPDATE user
		SET user_firstname = '$user_firstname',
			user_lastname = '$user_lastname',
			user_gender = $user_gender,
			user_age = $user_age,
			user_dob = '$user_dob',
			user_phone = $user_phone,
			user_city = '$user_city',
			user_state = '$user_state',
			user_country = '$user_country',
			user_email = '$user_email',
			user_username = '$user_username'
			WHERE user_id = $current_id
		 ";
		 $q = mysqli_query($this->mysqli,$update_query);

/*		if($q){
			//echo "<script>alert('update success');</script>";
		}else{
			echo mysqli_error($this->mysqli);
		}*/
	}

	function get_user_header(){

	}
	function get_user_footer(){

	}
	function get_admin_header(){
		?>
		<link rel="stylesheet" type="text/css" href="<?php echo 'http://'.BASE_PATH; ?>/admin/assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo '
		http://'.BASE_PATH; ?>/admin/assets/css/my.css">
		<?php
		require_once(BASE_URL.'/admin/admin_includes/admin_header.php');
	}
	function get_admin_footer(){
		?>
		<script src="<?php echo 'http://'.BASE_PATH; ?>/admin/assets/js/jquery/jquery.min.js"></script>
		<script src="<?php echo 'http://'.BASE_PATH; ?>/admin/assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo 'http://'.BASE_PATH; ?>/admin/assets/js/my.js"></script>
		<?php
		require_once(BASE_URL.'/admin/admin_includes/admin_footer.php');
	}
}//class connection ends
?>
