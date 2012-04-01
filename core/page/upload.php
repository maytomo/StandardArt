<?php
if(!defined("IN_SA")) exit();
function categories()
{
    $db = new DBConnect;
    $retr = "";
    $c = $db->query("SELECT * FROM categories");
    while($f = mysql_fetch_array($c))
    {
        $retr .= "<option value='{$f['id']}'>{$f['name']}</option>";
    }
    return $retr;
}
?>
