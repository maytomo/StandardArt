<?php
if(!defined("IN_SA")) exit();
if(!isset($_SESSION))
	session_start();
require_once("smarty/Smarty.class.php");
require_once('lib/markdown.php');
require_once('lib/timesince.php');
if(!isset($template))
{
	$template = "index";
}
include('db.php');
$template .= ".tpl";
$smarty = new Smarty();
$smarty->setTemplateDir(ROOT_DIR."\\templates");
$smarty->assign('loggedin',isset($_SESSION['username']));
$smarty->assign('user',htmlspecialchars(@$_SESSION['username']));
$smarty->assign('errors',@$_SESSION['e']);
$smarty->assign('base_url', "http://localhost/sa/");
if(isset($_SESSION['e']))
	unset($_SESSION['e']);
$smarty->assign('req',$_SERVER['REQUEST_URI']);
if($template == "profile.tpl")
	include("page/profile.php");
if($template == "viewart.tpl")
    include("page/viewart.php");
if($template == "upload.tpl")
{
    include("page/upload.php");
    $smarty->assign('upload_categories',categories());
}
try
{
	$smarty->display($template);
}
catch(SmartyException $e)
{
	$smarty->display("notfound.tpl");
}
if(isset($_SESSION['settings_done']))
	unset($_SESSION['settings_done']);
?>