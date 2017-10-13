<?php session_start(); ?>
<?php
//require_once("../config/config.php");
$con = mysqli_connect("localhost", 'root', 'mysql', 'simpleapp');
$userid = $_POST['user_id'];
$display_query = "SELECT * FROM user WHERE user_id=$userid";
$q = mysqli_query($con, $display_query);
$array = mysqli_fetch_assoc($q);
header('Content-Type: application/json');
echo json_encode($array);
?>