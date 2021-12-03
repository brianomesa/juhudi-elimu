<?php
session_start();
@$log=$_GET['slot'];
if(!isset($_SESSION['user']))
{
	header("Location: login.php");
}
else if(isset($_SESSION['user']))
{
	header("Location: ../dashboard/dashboard.php");
}

if(isset($_GET['logout']))
{
	session_destroy();
	unset($_SESSION['user']);
	header("Location: ../../index.php");
}
if(isset($_GET['slot']))
{
	session_destroy();
	unset($_SESSION['user']);
	header("Location: login.php?log=4");
}
?>
