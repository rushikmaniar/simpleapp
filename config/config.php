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
define('BASE_PATH',$_SERVER['HTTP_HOST'].str_replace(array('config'),'',dirname($_SERVER['SCRIPT_NAME'])));
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
		$query = "SELECT user_username,user_password FROM user";
		$login = $this->mysqli->query($this->mysqli,$query);
		$array = mysqli_fetch_array($this->mysqli,$login);
		if(mysqli_num_rows($con->mysqli,$array) > 0){
			if(password_verify($user_check_password,$array['user_password'])){
				echo "login success";
			}
			else{
				echo "login failed";
			}
		}

	}
	function user_signup(){
		
	}

	function get_user_header(){
		?>
		<link rel="stylesheet" type="text/css" href="<?php echo 'http://'.BASE_PATH; ?>/assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo '
		http://'.BASE_PATH; ?>/assets/css/my.css">
		<?php
		require_once(BASE_URL.'/includes/user_header.php');
	}
	function get_user_footer(){
		?>
		<script src="<?php echo 'http://'.BASE_PATH; ?>/assets/js/jquery/jquery.min.js"></script>
		<script src="<?php echo 'http://'.BASE_PATH; ?>/assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo 'http://'.BASE_PATH; ?>/assets/js/my.js"></script>
		<?php
		require_once(BASE_URL.'/includes/user_footer.php');
	}
}//class connection ends
?>