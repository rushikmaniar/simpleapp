<?php
$con = mysqli_connect('localhost', 'root', '', 'simpleapp');
$query = "SELECT user_dob FROM user WHERE user_id=35";
$q = mysqli_query($con, $query);
$array = mysqli_fetch_assoc($q);
echo $dob = $array['user_dob'];
echo "<br>";
echo $current = date('Y-m-d');
echo "<br>";
//echo $diff =date_diff($dob,$current);


//$datetime1 = date_create('2009-10-11');
//$datetime2 = date_create('2009-10-13');
echo $datetime1 = strtotime($current);
echo "<br>";
echo $datetime2 = strtotime($dob);
echo "<br>";
echo $diff = $datetime2 - $datetime1;
echo "<br>" . $diff / 3600;
?>