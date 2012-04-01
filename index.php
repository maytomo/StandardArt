<?php
$template = @$_GET['page'];
if($template == "")
{
	$template = "index";
}
define('IN_SA',true);
include("core/core.php");
?>