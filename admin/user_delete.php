<?php session_start(); ?>
<?php 
$id = $_POST['user_id'];
$con = mysqli_connect("localhost",'root','mysql','simpleapp');
$display_query = "SELECT * FROM user WHERE user_id=$id";
$q = mysqli_query($con,$display_query);
$arr= mysqli_fetch_assoc($q);
$path = "../user/uploads/profile/images/".$arr['img_name'];
$del = unlink($path);
if($del){
	echo "delete success";
}
$delete_query = "DELETE FROM user WHERE user_id = $id";
$q = mysqli_query($con,$delete_query);
$array = mysqli_fetch_assoc($q);
?>