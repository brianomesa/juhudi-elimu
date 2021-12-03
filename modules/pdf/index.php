<?php
session_start();
require_once(dirname(__FILE__) . '/../../includes/dbconnect.php');
require_once(dirname(__FILE__) . '/../../includes/functions.php');

checklogin();
header("Location: ../dashboard/index.php");
?>
