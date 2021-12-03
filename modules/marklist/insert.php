<?php
require_once(dirname(__FILE__) . '/../../includes/dbconnect.php');
require_once(dirname(__FILE__) . '/../../includes/functions.php');

  if(isset($_POST['send'])!=""&& isset($_SESSION['random']))
  {
	 $logRandom=$_SESSION['random'];
	 $calcinco=$_SESSION['inshacomp'];

  $Studentname=strtoupper(mysql_real_escape_string($_POST['studentname']));
  $English=mysql_real_escape_string($_POST['english']);
  $Composition=mysql_real_escape_string($_POST['composition']);
  $english_total=(($English+$Composition)/($calcinco+50))*100;;
  $Kiswahili=mysql_real_escape_string($_POST['kiswahili']);
  $Insha=mysql_real_escape_string($_POST['insha']);
  $lugha_total=(($Kiswahili+$Insha)/($calcinco+50))*100;;
  $Maths=mysql_real_escape_string($_POST['maths']);
  $Science=mysql_real_escape_string($_POST['science']);
  $Socialstudies=mysql_real_escape_string($_POST['socialstudies']);
  $Cre=mysql_real_escape_string($_POST['cre']);
  $socialstudies_total=(($Socialstudies+$Cre)/90)*100;
  $grand_total=$socialstudies_total+$lugha_total+$english_total+$Maths+$Science;

   $update=mysql_query("INSERT INTO results (s_log_id,student_name,language,composition,lang_total,lugha,insha,lugha_total,maths,science,socialstudies,cre,cress_total,grand_total) VALUES
									  ('$logRandom','$Studentname','$English','$Composition','$english_total','$Kiswahili','$Insha','$lugha_total','$Maths','$Science','$Socialstudies','$Cre','$socialstudies_total','$grand_total')");

  if($update)
  {
	   $msg="Successfully Updated!!";
	  echo "<script type='text/javascript'>alert('$msg');</script>";
	  header('Location:tables.php');}
  else
  {
	 $errormsg="Something went wrong, Try again";

	  header('Location:index.php');
	  echo "<script type='text/javascript'>alert('$errormsg');</script>";
  }

  }
 ob_end_flush();
?>
