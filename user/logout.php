<?php session_start(); ?>
<?php 
session_unset($_SESSION['user_username']);
header("location:../index.php");
 ?>