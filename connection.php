<?php
require_once("conf.php");
$con_status=mysqli_connect($server,$db_userid,$db_password,$database);
if($con_status)
{
	return true;
	}
else
{
	$eno=1046;
	header("Location:Tchr_leave.php?eno=$eno");
	return false;
}
?>