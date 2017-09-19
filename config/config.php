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
define('BASE_PATH',$_SERVER['HTTP_HOST'].str_replace(array('config','user','admin'),'',dirname($_SERVER['SCRIPT_NAME'])));
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
	public $signup_query;
	function __construct()
	{
		$dbhost = 'localhost';
  		$dbuser = 'root';    $dbpass = '';    $dbname = 'simpleapp';
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


	function user_login($user_username,$user_check_password){
		$query = "SELECT * FROM user
		 WHERE user_username = '$user_username'
		AND user_password = '$user_check_password'";
		$login = mysqli_query($this->mysqli,$query);
		/*if($login){

		}else{
			echo mysqli_error($this->mysqli);
		}*/
		$array = mysqli_fetch_array($login);
		if($array['user_status'] == 0){
			echo "<script type='text/javascript'>alert('Admin has Deacativate You . Contact Admin');</script>";
			header("location:index.php");
		}
		else{
			if(mysqli_num_rows($login) > 0){
				if(($array['user_username'] == $user_username) && ($array['user_password'] == $user_check_password)){
					if($array['user_type'] == 'admin'){
						header("location:index.php");
					}
					else{
						$_SESSION["user_username"] = $array['user_username'];
						header("location:../user/index.php");
					}
				}
				else{
					echo "login failed";
				}
			}
			else{
				echo "login failed";
			}

			}//else of status end

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
		$user_dob,
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