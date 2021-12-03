<?php
require_once(dirname(__FILE__) . '/dbconnect.php');
session_start();

function getUserID($userid){
	$query = "SELECT * FROM users WHERE id_number='$userid'";
	return $query;
}

function login($row,$userpass)
{

	//$dbc = new DbC("localhost", "root", "", "register");
//	$query = "SELECT * FROM users WHERE id_number='$userid'";
//	$queryResult = $dbc->queryDb($query) or die(mysqli_error());
//	$row = mysqli_fetch_array($queryResult);
	if($row['password']==md5($userpass))
	{
		$_SESSION['user'] = $row['user_id'];
		$_SESSION['user2'] = $row['id_number'];
		$_SESSION['LOGINSTRING']=md5($row['password']);
		$_SESSION['loggedin_time'] = time();
		$userName = $row['username'];
		//return $userName;

		header("Location: ../dashboard/index.php");
	}

}

function checklogin(){
	if (isset($_SESSION['user'])) {
			true;
				}
		else{
				header("Location: ../authentication/login.php?log=102002");
				}
				}

	/////////////TEACHER PROFILE/////////////////
function getUserName(){

if(isset($_SESSION['user']))
{
	$res="SELECT * FROM users WHERE user_id=".$_SESSION['user'];
	$query = getUserID($loginid);
	$queryResult= $dbc->queryDb($query);
	$rowResults = $dbc->fetchResults($queryResult);
	return $userRow['username'];
	}
}
	function updateProfile($trUsername,$trname,$email,$picture,$location,$year){
		if(isset($_SESSION['user2'])){

		$updated=mysql_query("UPDATE profile SET
		teacher_username='$trUsername', teacher_name='$trname',teacher_email='$email',
		picture='$picture' , location='$location' , year='$year'
		 WHERE teacher_id=".$_SESSION['user2'])or die(mysql_error());;
		 $update2=mysql_query("UPDATE users SET username='$trUsername' WHERE id_number=".$_SESSION['user2'])or die(mysql_error());;
	}}
	///////////////////////////////////////////////////////end of Teacher Profile
	///////////////////Table Functions//////////////////////////////
//////////////sets random number for ech marklist//////////////
 function setRandom($id){
		 $_SESSION['random']= $id;
		 }
	///////////sets denominator value from database///////////
	function setDenominator()
	{
		if(isset($_SESSION['user2']))
		{
			$trid= $_SESSION['user2'];
 		$denominator=mysql_query("SELECT `composition_den`, `sstudie_den`, `cre_den` FROM `marks_denominator` WHERE tr_id='$trid'") or die(mysql_error());
		$row=mysql_fetch_array($denominator);
		$_SESSION['inshacomp']=$row['composition_den'];
		$_SESSION['sstudie_den']=$row['sstudie_den'];
		$_SESSION['cre_den']=$row['cre_den'];

	}
	else
	{
		$_SESSION['inshacomp'] =30;
		$_SESSION['sstudie_den']=60;
		$_SESSION['cre_den']=30;

		}
}
	 function deleteTableValue($delete){
		  $deleteTableValue=mysql_query("DELETE FROM results WHERE r_id='$delete'") or die(mysql_error());
		  if($delete)
		  {
			  header("Location:tables.php");
		  }
		  else
		  {
			  echo mysql_error();
		  }
		 }
		 function deleteMarklist($delete1)
		 {

		  $deleteTableValue=mysql_query("DELETE FROM system_log WHERE system_log_id='$delete1'") or die(mysql_error());
		  $deleteResults=mysql_query("DELETE FROM results WHERE s_log_id='$delete1'") or die(mysql_error());
		  if($delete1)
		  {
			  header("Location:../tables/index.php?true=$delete1");
		  }
		  else
		  {
			  echo mysql_error();
		  }
		 }

		 function editTableValue($id,$estudent,$elang,$ecompo,$elugha,$einsha,$emath,$escience,$estudies,$ecre)
		 {
			 			setDenominator();
						$elangTotal=(($elang+$ecompo)/($_SESSION['inshacomp']+50))*100;
						  $elughaTotal=(($elugha+$einsha)/($_SESSION['inshacomp']+50))*100;
							$s_denominator=($_SESSION['sstudie_den']+$_SESSION['cre_den']);
						  $estudiesTotal=(($estudies+$ecre)/$s_denominator)*100;
						  $egrandTotal=$elangTotal+$elughaTotal+$emath+$escience+$estudiesTotal;

					$updated=mysql_query("UPDATE results SET
						student_name='$estudent', language='$elang', composition='$ecompo', lang_total='$elangTotal',
						 lugha='$elugha', insha='$einsha', lugha_total='$elughaTotal', maths='$emath',
						  science='$escience', socialstudies='$estudies', cre='$ecre', cress_total='$estudiesTotal', grand_total='$egrandTotal'
						  WHERE r_id='$id'")or die(mysql_error());;

						  if($updated){
							  {
							  $msg="Successfully Updated!!";
							  header('Location:tables.php');
  }
							  }
						  }

						  function createSystemLog($countyid,$districtid, $schoolid, $trID, $year, $classid, $classname, $termid, $otherInfor)
							{
							  $random=mt_rand(10000,1000000);
							 if(isset($trID)){

							  $_SESSION['random']=$random;//needs to do checks just incase
								}
							  $query1 = "INSERT INTO system_log(system_log_id,s_county_id,s_district_id,s_school_id, s_teacher_id, s_log_year, s_class_id,s_class_name,s_term_id,s_other_info)
							  VALUES('$random','$countyid','$districtid',' $schoolid',' $trID','$year','$classid','$classname','$termid','$otherInfor')";
								$insertvalues=mysql_query($query1);
								if($insertvalues){

									header('Location:tables.php');

									}
									else{

										}

							  }

	  function DisplayLogInfo(){
		  if(isset($_SESSION['random']))
	{
			   $logRandom=$_SESSION['random'];
			   $result1=mysql_query("SELECT county.county_name, district.district_name, school.school_name,profile.teacher_name, class.class_name, term.exam_term_name, system_log.s_class_name,system_log.s_other_info
			   FROM county, district, school, profile, class, term, system_log
			   WHERE system_log_id='$logRandom'
			   AND system_log.s_county_id=county.county_id
			   AND system_log.s_district_id=district.district_id
			   AND system_log.s_school_id=school.school_id
			   AND system_log.s_teacher_id=profile.teacher_id
			   AND system_log.s_class_id=class.class_id
			   AND system_log.s_term_id=term.term_id
						 ") or die(mysql_error());
		$row=mysql_fetch_array($result1);
		 echo '<table border="0"  cellpadding="5px" cellspacing="8px" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; background-color:#b2d2e0" width="90%" align="center">';
			echo "<tr bgcolor='#ddd' style='font-weight:bold'></thead>";

			echo "<tr><td align='center'>".$row['county_name']." COUNTY EDUCATION DEPARTMENT </td></tr>
								<tr><td align='center'>".$row['district_name']." DISTRICT </td><td align='left'> YEAR   ".$current_year=date('Y'). "</td></tr>
								<tr><td align='center'>".$row['s_other_info']."</td></tr>
								<tr><td align='center'>".$row['school_name']."</td><td align='left'>".$row['class_name']." ".$row['s_class_name']." </td><td align='right'>".$row['exam_term_name']."</td></tr>
								<tr> </tr>
								</table>";

		}
	}

	function myTables(){

	if(isset($_SESSION['user']))
	{
		$count=0;
		$message="";
		$teacherId= $_SESSION['user2'];
		$result= mysql_query("SELECT DISTINCT county.county_name, district.district_name, school.school_name, class.class_name, term.exam_term_name, system_log.system_log_id, system_log.s_class_name,system_log.s_other_info
							   FROM county, district, school, class, term, system_log
							   WHERE s_teacher_id='$teacherId'
							   AND system_log.s_county_id=county.county_id
							   AND system_log.s_district_id=district.district_id
							   AND system_log.s_school_id=school.school_id
							   AND system_log.s_class_id=class.class_id
							   AND system_log.s_term_id=term.term_id
							   ORDER BY s_log_number DESC
						 ") or die(mysql_error());

 if(mysql_num_rows($result))
	{
		echo "<div class='panel-body'>
              <div class='dataTable_wrapper'>
			<div class='dataTable_wrapper'>";

		echo '<table border="0" class="table table-striped table-bordered table-hover" cellpadding="5px" cellspacing="1px" cellstyle="font-family:Verdana, Geneva, sans-serif; font-size:14px; background-color:#E1E1E1" width="100%" align="right">';
		echo "<tr bgcolor='#ddd' style='font-weight:bold' align='left'><thead><th> </th><th>COUNTY </th><th>DISTRICT</th><th>SCHOOL</th><th>TERM</th><th>CLASS NAME</th><th>OTHER INFO</th><th>Edit Actions</th></tr></thead>";
		while($row=mysql_fetch_array($result))
		{
			$count=$count+1;
		  echo "<tr bgcolor='#FFFFFF' align='left'><td>".$count."</td><td>".$row['county_name']."</td><td>".$row['district_name']."</td><td>".$row['school_name']."</td><td>".$row['exam_term_name']."</td><td >".$row['class_name']."-".$row['s_class_name']."</td><td>".$row['s_other_info']."</td>";?>
		  <?php echo "<td><div class='btn-group pull-right'>
                                <button type='button' class='btn btn-default btn-xs dropdown-toggle' data-toggle='dropdown'>
                                   <span class='glyphicon glyphicon-chevron-down'></span>
                                </button>
                                <ul class='dropdown-menu slidedown'>
                                    <li>";?>
                                        <a href="../marklist/headeredirect.php?id=<?php echo $row['system_log_id'];?>">
                                     <?php echo     " <i class='glyphicon glyphicon-pencil'></i> Edit Header Info
                                        </a>
                                    </li>
                                    <li>";?>
                                        <a href="../marklist/tables.php?id=<?php echo $row['system_log_id'];?>">
                                          <?php echo  " <i class='glyphicon glyphicon-check'></i> Complete Data Entry
                                        </a>
                                    </li>
                                    <li>";?>
                                       <a href="../pdf/reportlist.php?list=<?php echo $row['system_log_id'];?>" target="_blank">
                                       <?php echo  "      <i class='glyphicon glyphicon-print'></i> Print
                                        </a>
                                    </li>
									<li>";?>
                                       <a href="../marklist/delete.php?idmlst=<?php echo $row['system_log_id'];?>"
		   onclick="return confirm('Are you sure you wish to delete this Record?');">
                                       <?php echo  "      <i class='glyphicon glyphicon-remove'></i> Delete
                                        </a>
                                    </li>

                                </ul>
                            </div></td></tr>";

			}

			echo "</table></div></div></div>";
	}
	else{
		$message.="<div class='alert bg-warning alert-dismissable'>
	                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
	                               <center> YOU HAVE NOT CREATED ANY MARKLISTS. </center><a href='#' class='alert-link'></a>
	                            </div>";
		echo "<br><br><br>". $message;
		}
	}

	}
	function viewResultsTable()
 {
	 $msg="";
	 if(isset($_SESSION['random'])){
			 $slogid=$_SESSION['random'];
			 setDenominator();
		  $select=mysql_query("SELECT * FROM results where s_log_id='$slogid' order by grand_total desc") or die(mysql_error());

		  $i=1;
		  $count=0;$compCount=0; $langCount=0; $inshaCount=0; $lughaCount=0;
		 $mathCount=0; $scienceCount=0; $socialCount=0;$creCount=0;$langTotalCount=0;
		 $grandTotalCount=0;$creSSTotalCount=0;	$lughaTotalCount=0;

		 $avelang=0; $aveicompo=0;$avelangTotal=0;
		 $avelugha=0;$aveinsha=0;$avelughaTotal=0;
		 $avemath=0;$avescience=0;$avesocialS=0;$avecre=0;$avecresocialTotal=0;$aveGrandTotal=0;

		  echo' <br> <div class="panel panel-default chat">
					<div class="panel-body">';

		echo '<table border="0" class="table table-striped table-bordered table-hover" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; background-color:#E1E1E1" width="90%" align="left">';
		echo "<tr bgcolor='#ddd' style='font-weight:bold' ><thead><th> </th><th>Student Name</th><th>Language</th><th>Comp</th><th>Total</th><th>Lugha</th><th>Insha</th><th>Total</th><th>Maths</th><th>Science</th><th>S/Studies</th><th>C.R.E</th><th>Total</th><th>Grand Total</th></tr></thead>";
		while($row=mysql_fetch_array($select))
		{
			$count=$count+1;
			$inshaCount=$inshaCount+$row['insha'];
			$lughaCount=$lughaCount+$row['lugha'];
			$compCount=$compCount+$row['composition'];
			$langCount=$langCount+$row['language'];
			$mathCount=$mathCount+$row['maths'];
			$scienceCount=$scienceCount+$row['science'];
			$creCount=$creCount+$row['insha'];
			$socialCount=$socialCount+$row['socialstudies'];
			$langTotalCount=$langTotalCount+$row['lang_total'];
			$lughaTotalCount=$lughaTotalCount+$row['lugha_total'];
			$creSSTotalCount=$creSSTotalCount+$row['cress_total'];
			$grandTotalCount=$grandTotalCount+$row['grand_total'];

			$aveicompo=round(($compCount)/$count,2);
			$avelang=round(($langCount)/$count,2);
			$avelangTotal=round(($langTotalCount)/$count,2);
			$aveinsha=round(($inshaCount)/$count,2);
			$avelugha=round(($lughaCount)/$count,2);
			$avelughaTotal=round(($lughaTotalCount)/$count,2);
			$avemath=round(($mathCount)/$count,2);
			$avescience=round(($scienceCount)/$count,2);
			$avesocialS=round(($socialCount)/$count,2);
 			$avecre=round(($creCount)/$count,2);
			$avecresocialTotal=round($creSSTotalCount/$count,2);
			$aveGrandTotal=round($grandTotalCount/$count,2);

		  echo "<tr bgcolor='#FFFFFF' align='center'><td>".$count."</td><td align='left'>".$row['student_name']."</td><td>".$row['language']."</td><td>".$row['composition']."</td><td style='font-weight:bold'>".$row['lang_total']."</td>
		  <td>".$row['lugha']."</td><td>".$row['insha']."</td><td style='font-weight:bold'>".$row['lugha_total']."</td><td style='font-weight:bold'>".$row['maths']."</td>
		  <td style='font-weight:bold'>".$row['science']."</td><td>".$row['socialstudies']."</td><td>".$row['cre']."</td><td style='font-weight:bold'>".$row['cress_total']."</td><td style='font-weight:bold'>".$row['grand_total']."</td><td>";
		 echo '<a href="edit_marks.php?id='.$row['r_id'].'"> <span class="edit" title="Edit"> Edit </span></a>';
		 echo "</td><td>";?>
		 <a href="delete.php?id=<?php echo $row['r_id'];?>"
		   onclick="return confirm('Are you sure you wish to delete this Record?');">
					<span class="delete" title="Delete"> Delete </span></a>
<?php echo "</td></tr>";




			}
			echo"
			<tr bgcolor='#FFFFFF' align='center' style='font-weight:bold'><td>**</td><td>SUBJECT TOTAL</td><td>".$langCount."</td><td>".$compCount."</td><td>".$langTotalCount."</td><td>".$lughaCount."</td><td>".$inshaCount."</td><td>".$lughaTotalCount."</td>
			<td>".$mathCount."</td><td>".$scienceCount."</td><td>".$socialCount."</td><td>".$creCount."</td><td>".$creSSTotalCount."</td><td>".$grandTotalCount."</td></tr>
			<tr></tr>
			<tr bgcolor='#FFFFFF' align='center' style='font-weight:bold'><td>**</td><td>AVERAGE MARKS</td><td>".$avelang."</td><td>".$aveicompo."</td><td>".$avelangTotal."</td><td>".$avelugha."</td><td>".$aveinsha."</td><td>".$avelughaTotal."</td>
			<td>".$avemath."</td><td>".$avescience."</td><td>".$avesocialS."</td><td>".$avecre."</td><td>".$avecresocialTotal."</td><td>".$aveGrandTotal."</td></tr>
			<tr style='font-weight:bold'><td></td><td >CLASS AVERAGE</td><td>".($aveGrandTotal/5)."</td>";
			echo "</table></div></div></div>";
			if($count>=3){
				echo" <button class='btn btn-outline btn-success  btn-block' data-toggle='modal' data-target='#myModal' t>
                                PRINT REPORT
                            </button>";
				}
	 }else{
		 $msg.='No Table is selected. Please Create a table <a href="../marklist/new_marklist.php" class="alert-link">Here</a> or choose a table from your <a href="my_tables.php" class="alert-link">Tables</a>.';
		echo' <div class="alert alert-danger">'
                                .$msg.'
                            </div></div>';


		 }}

	 function updateHeader($s_id,$county_id,$district_id,$school_id,$class_id,$clasname,$termid,$otherinfo){
		 $updated=mysql_query("UPDATE system_log SET s_county_id='$county_id', s_district_id='$district_id', s_school_id='$school_id', s_class_id='$class_id', s_class_name='$clasname', s_term_id='$termid',s_other_info='$otherinfo'
		 														WHERE system_log_id='$s_id'")or die(mysql_error());;
																if($updated){

																			header('Location: ../tables/index.php?update=1');
																}
}

	function pdfname(){
		if(isset($_SESSION['random']))
	{
		$pdfname;
			   $logRandom=$_SESSION['random'];
			   $result=mysql_query("SELECT profile.teacher_name, class.class_name, system_log.s_class_name
			   FROM profile, class, system_log
			   WHERE system_log_id='$logRandom'
			   AND system_log.s_teacher_id=profile.teacher_id
			   AND system_log.s_class_id=class.class_id
						 ") or die(mysql_error());
		$row=mysql_fetch_array($result);
		$trName= $row['teacher_name'];
		$classNumber= $row['class_name'];
		$className=$row['s_class_name'];
		$pdfname=strtoupper($trName."-".$classNumber."-".$className);
		return $pdfname;
				}
		}
		function sec_session_start() {  // Start the PHP session
			if(isset($_SESSION['last-activity'])&&time()-$_SESSION['last-activity']>600){
				header('location: ../authentication/logout.php?slot=4');
				}
				$_SESSION['last-activity']= time();//update last activity stamp
			session_regenerate_id(true);    // regenerated the session, delete the old one.
		}
	function forgotPassword($email){
		$headers='';
		$result=mysql_query("SELECT * FROM profile WHERE email='$email'") or die(mysql_error());
		$row=mysql_fetch_array($result);
			if($row['teacher_id'])
			{
				$to=$row['email'];
				$subject="RESET PASSWORD";
				$from='admin@this.co.ke';
				$message="Hi.<br><br>Click on the link below to reset your password. It will expire in 24 hours.<br>
				<a href='../modules/authentication/fgt-change-password.php?mwalimu=".(111*$row['teacher_id'])."&reset=true >Password Change</a>";
				$headers.="From:".strip_tags($from)."\r\n";
				$headers.="MIME-Version: 1.0\r\n";
				$headers.="Content-Type: text/html; charset=ISO-8859-1\r\n";
				mail($to,$subject,$message,$headers);

			}

}
function createSchoolName($countyID,$districtID,$schoolName){

			 $query1 = "INSERT INTO school (school_name,school_county_id,school_district_id)
		VALUES('$schoolName','$countyID','$districtID')";
			$insertvalues=mysql_query($query1)or die(mysql_error());;
			if($insertvalues){
				header('Location:../marklist/new_marklist.php?insert=true');

				}
				else{
					header('Location:../school/add_school.php?insert=false');

					}

	}

	?>
