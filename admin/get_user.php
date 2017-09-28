<?php session_start(); ?>
<?php 
$id = $_POST['user_id'];
//require_once("../config/config.php");
$con = mysqli_connect("localhost",'root','','simpleapp');
$display_query = "SELECT * FROM user WHERE user_id = $id";
$q = mysqli_query($con,$display_query);
$array = mysqli_fetch_assoc($q);
header('Content-Type: application/json');
echo json_encode($array);
 ?>