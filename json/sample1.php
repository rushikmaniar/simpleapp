<?<?php
$con = mysqli_connect("localhost", "root", "",'bca'); // 
$name1=$_POST['name1'];
$password1=$_POST['password1'];

//Insert query
$query = mysqli_query($con,"select firstname,lastname,user_type from user WHERE username='$name1' AND password = '$password1'");
$array= mysqli_fetch_array($con,$query);
echo json_encode($array);
?>