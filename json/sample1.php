<?php
//header('Content-Type: application/json');
$con = mysqli_connect("localhost", "root", "", "bca"); // 

//$name1='c';
//$password1='c';

//$name1 = $_POST['name1'];
//$password1 = $_POST['password1'];
//Insert query
/*$query = mysqli_query($con,"SELECT * from user WHERE username='$name1' 
	AND password='$password1' ");
*/
//$query = "SELECT * FROM users WHERE user_type='admin' AND password='1' OR '1'='1'drop table user";
//$query = "SELECT * FROM user WHERE user_type = 'admin' OR 1=1";

//$query = "SELECT * FROM user WHERE username =\"\" or \"\"=\"\" AND password =\"\" or \"\"=\"\"";

$query = "SELECT * FROM user WHERE user_type='decompiler'";
$q = mysqli_query($con, $query);
if ($q) {
    echo "success";
} else {
    echo mysqli_error($con);
}
echo "<pre>";
$arr = mysqli_fetch_array($q);
echo "<pre>";
print_r($arr);
/*echo "{\"arr\":[";
foreach ($arr as $key => $value) {
	echo "{\"".$key."\"";
	echo ":";
	echo "\"".$value."\"";
	echo "}";
	if(!($key == "user_type"))
	echo ",";
}
echo "]";
echo "}";
*/
//echo $s = json_decode("{\"face\":\"\\uD83D\\uDE02\" }");
?>
