<?php
if(!isset($_POST['submit']))
	die();
require_once("../db.php");
require_once("../lib/salt.php");
session_start();
$db = new DBConnect;
$username = mysql_real_escape_string(@$_POST['username']);
$query = $db->query("SELECT * FROM users WHERE username='{$username}'");
$f = mysql_fetch_array($query);
if(!validatePassword(@$_POST['password'], $f['password']))
        $errors[] = "Username or Password Incorrect";
if(count($errors) != 0)
{
	$_SESSION['e'] = $errors;
	header("Location: ../login");
	die("You shouldn't be here.");
}
else
{
	$_SESSION['username'] = $username;
	header("Location: ../");
	die();
}
?>