<?php
header('Content-Type: application/json');
$con = mysqli_connect("localhost", "root", "",'bca'); // 

//$name1=$_POST['name1'];
//$password1=$_POST['password1'];

$name1 = $_POST['name1'];
$password1 = $_POST['password1'];
//Insert query
$query = mysqli_query($con,"SELECT * from user WHERE username='$name1' 
	AND password='$password1' ");
echo $json = json_encode(mysqli_fetch_assoc($query));
?>