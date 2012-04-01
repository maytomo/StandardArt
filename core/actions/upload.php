<?php
session_start();
include("../db.php");
$db = new DBConnect;
$uname = @$_SESSION['username'];
if(!$uname)
{
	header("Location: ../upload");
	die('HERESY!');
}
$uname = mysql_real_escape_string($uname);
$uq = $db->query("SELECT userid FROM users WHERE username='$uname'");
$uf = mysql_fetch_array($uq);
$id = $uf['userid'];
if(isset($_POST['submit']))
{
	$e = array();
	$hash = md5(sha1((rand(0,100).time().$_FILES['artfile'])));
	$file = $_FILES['artfile'];
	$ext = end(explode('.', $file['name']));
	if($ext != "jpeg" && $ext != "jpg" && $ext != "png" && $ext != "gif")
		$e[] = "Image must be JPEG, PNG, or GIF.";
	while(file_exists($hash.".".$ext))	
		$hash = sha1(rand(0,100).time().$_FILES['artfile']).md5(time());
	if($file['size'] > 5000000)
		$e[] = "Image must be 5MB or smaller.";
        $cat = mysql_real_escape_string(@$_POST['category']);
        if(!$cat) 
            $e[] = "No category!";
        $title = mysql_real_escape_string(@$_POST['title']);
        if(!$title)
            $e[] = "Artwork needs a title!";
        $desc = mysql_real_escape_string(@$_POST['desc']);
        if(!$desc)
            $e[] = "Artwork needs a description!";
        if(strlen($desc) > 2000)
            $e[] = "Description too long!";
        if(strlen($title) > 100)
            $e[] = "Title too long!";
	if(count($e) != 0)
	{
		$_SESSION['e'] = $e;
		header("Location: ../upload");
		die();
	}
	$a = "uploads/art/".$hash.".".$ext;
	move_uploaded_file($file['tmp_name'], "../../uploads/art/".$hash.".".$ext);
	$a = mysql_real_escape_string($a);
        $gmtimenow = time() - (int)substr(date('O'),0,3)*60*60; 
	$db->query("INSERT INTO artwork (userid,date,title,path,descr,cat) VALUES('$id','$gmtimenow',
                '$title','$a','$desc','$cat');");
        $q = $db->query("SELECT * FROM artwork WHERE userid='$id' ORDER BY id DESC");
        $f = mysql_fetch_array($q);
	header("Location: ../art-".$f['id']);
	die();
}
?>