<?php session_start(); ?>
<?php 
//require_once("../config/config.php");
//print_r($_POST);exit;
$con = mysqli_connect("localhost",'root','mysql','simpleapp');

$user_phone = $_POST['user_phone'];
$user_email = $_POST['user_email'];
$user_username1 = $_POST['user_username'];
$array = array();


$display_query = "SELECT * FROM user WHERE user_phone=$user_phone";
$q = mysqli_query($con,$display_query);
$arr = mysqli_num_rows($q);
if($arr > 0){
	array_push($array,0);
}else{
	array_push($array,1);
}
$display_query = "SELECT * FROM user WHERE user_email='$user_email'";
$q = mysqli_query($con,$display_query);
$arr = mysqli_num_rows($q);
if($arr > 0){
	array_push($array,0);
}else{
	array_push($array,1);
}

$display_query = "SELECT * FROM user WHERE user_username='$user_username1'";
$q = mysqli_query($con,$display_query);
$arr = mysqli_num_rows($q);
if($arr > 0){
	array_push($array,0);
}else{
	array_push($array,1);
}
//print_r($array);
echo json_encode($array);
exit();
?>
