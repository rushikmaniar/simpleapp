<?php session_start(); ?>
<?php 
//require_once("../config/config.php");
$con = mysqli_connect("localhost",'root','mysql','simpleapp');
$user_username1 = $_POST['user_username'];
$display_query = "SELECT * FROM user WHERE user_username=$user_username1";
$q = mysqli_query($con,$display_query);
$arr = mysqli_num_rows($q);
if($arr > 0){
	echo "1";
}else{
	echo "0";
}
?>
