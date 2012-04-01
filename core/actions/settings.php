<?php
session_start();
include("../db.php");
$db = new DBConnect;
$uname = @$_SESSION['username'];
if(!$uname)
{
	header("Location: ../settings");
	die('HERESY!');
}
$uname = mysql_real_escape_string($uname);
$uq = $db->query("SELECT userid FROM users WHERE username='$uname'");
$uf = mysql_fetch_array($uq);
$id = $uf['userid'];
if(isset($_POST['change-avatar-submit']))
{
	$e = array();
	$hash = md5(time().$_FILES['avatar']);
	$file = $_FILES['avatar'];
	$ext = end(explode('.', $file['name']));
	if($ext != "jpeg" && $ext != "jpg" && $ext != "png" && $ext != "gif")
		$e[] = "Image must be JPEG, PNG, or GIF.";
	while(file_exists($hash.".".$ext))	
		$hash = md5(time().$_FILES['avatar'].rand());
	if($file['size'] > 50000)
		$e[] = "Image must be 50kb or smaller.";
	if(count($e) != 0)
	{
		$_SESSION['e'] = $e;
		header("Location: ../settings");
		die();
	}
	$a = "uploads/avatar/".$hash.".".$ext;
	move_uploaded_file($file['tmp_name'], "../../uploads/avatar/".$hash.".".$ext);
	$a = mysql_real_escape_string($a);
	$q = $db->query("SELECT * FROM profile WHERE field='avatar' AND userid=$id");
	if(mysql_num_rows($q) > 0)
	{
		$f = mysql_fetch_array($q);
		unlink("../../".$f['value']);
		$db->query("UPDATE profile SET value='$a' WHERE field='avatar' AND userid=$id");
	}
	else
	{
		$db->query("INSERT INTO profile VALUES($id,'avatar','$a');");
	}
	$_SESSION['settings_done'] = true;
	header("Location: ../settings");
	die();
}
if(isset($_POST['change-timezone-submit']))
{
    $e = array();
    $t = @$_POST['timezone'];
    if($t < -11 || $t > 12)
        $e[] = "Timezone out of range.";
    if(!is_numeric($t))
        $e[] = "Timezone is not numeric.";
    if(count($e) != 0)
    {
        $_SESSION['e'] = $e;
        header("Location: ../settings");
        die();
    }
    $t = mysql_real_escape_string($t);
    $q = $db->query("SELECT * FROM profile WHERE field='timezone' AND userid='$id'");
    if(mysql_num_rows($q) > 0)
    {
            $f = mysql_fetch_array($q);
            $db->query("UPDATE profile SET value='$t' WHERE field='timezone' AND userid=$id");
    }
    else
    {
            $db->query("INSERT INTO profile VALUES($id,'timezone','$t');");
    }
    $_SESSION['settings_done'] = true;
    header("Location: ../settings");
    die();
}
?>