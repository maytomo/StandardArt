<?php
class DBConnect
{
	public function __construct()
	{
		mysql_connect("localhost","root","") or die(mysql_error());
		mysql_select_db("standardart") or die(mysql_error());
	}
	public function query($query)
	{
		$q = mysql_query($query) or die(mysql_error());
		return $q;
	}
}
?>