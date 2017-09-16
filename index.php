<?php session_start(); ?>
<?php require_once('config/config.php'); 
$con = new connection();
$con->get_user_header();
?>