<?php
require_once(dirname(__FILE__) . '/../../includes/dbconnect.php');
require_once(dirname(__FILE__) . '/../../includes/functions.php');

  if(isset($_GET['id'])!="")
  {
  $delete=$_GET['id'];
  deleteTableValue($delete);
  }
   if(isset($_GET['idmlst'])!="")
  {
  $delete1=$_GET['idmlst'];
  deleteMarklist($delete1);
  }

  ob_end_flush();
?>
