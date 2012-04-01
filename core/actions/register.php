<?php
if(!isset($_POST['submit']))
	die();
require_once("../db.php");
require_once("../lib/salt.php");
session_start();
$db = new DBConnect;
$username = mysql_real_escape_string(@$_POST['username']);
$password = hashPassword(@$_POST['password']);
$email = mysql_real_escape_string(@$_POST['email']);
$errors = array();
if(empty($username) || empty($_POST['password']) || empty($email))
	$errors[] = "One or more fields blank.";
if(strlen($username) > 24)
	$errors[] = "Username too long.";
if(strlen($username) <= 3)
	$errors[] = "Username too short.";
if(strlen($email) > 300)
	$errors[] = "You can't possibly have that long of an email.";
if(strlen($email) < 4)
	$errors[] = "Email too short.";
if($_POST['captcha'] != $_SESSION['captcha'])
	$errors[] = "Invalid security image.";
if(@$_POST['password'] != @$_POST['ver_password'])
	$errors[] = "Passwords don't match.";
if(mysql_num_rows($db->query("SELECT * FROM users WHERE username='$username'")) > 0)
	$errors[] = "Username taken.";
if(count($errors) != 0)
{
	$_SESSION['e'] = $errors;
	header("Location: ../register");
	die("You shouldn't be here.");
}
else
{
	$gmtimenow = time() - (int)substr(date('O'),0,3)*60*60; 
	$db->query("INSERT INTO users VALUES('',2,'{$username}','{$password}','{$email}',$gmtimenow);");
	header("Location: ../register-complete");
	die();
}
?>