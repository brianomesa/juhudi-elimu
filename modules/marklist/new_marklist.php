<?php
require_once(dirname(__FILE__) . '/../../includes/dbconnect.php');
require_once(dirname(__FILE__) . '/../../includes/functions.php');

@$cat=$_GET['cat'];
@$subcat=$_GET['subcat'];
$msg="";
@$insert=$_GET['insert'];
if(isset($_GET['insert']))
{
	$msg.="<br><div class='alert bg-success alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center>
                               SUCCESS! SCHOOL HAS BEEN ADDED!</center><a href='#' class='alert-link'></a>
                            </div>";
	}

if(isset($_POST['create']))
			  {
				 $countyID=$_POST['county'];
				  $districtID=$_POST['district'];
				  $schoolID=$_POST['school'];
				  $classID=$_POST['class'];
				  $className=mysql_real_escape_string(strtoupper($_POST['classname']));
				  $termID=$_POST['term'];
				  $otherInfor=mysql_real_escape_string(strtoupper($_POST['otherinfor']));
				  $trID=$_SESSION['user2'];
				  $year=date('Y');
				  if($classID<=5){
					  $inshaCre=30;
					  $_SESSION['inshacomp'] =30;

					  }else if($classID>5){

					  $inshaCre=40;
					  $_SESSION['inshacomp'] =40;

						  }
						  else{$inshaCre=30;
					  $_SESSION['inshacomp'] =30;
				  }

				   if(createSystemLog($countyID, $districtID, $schoolID, $trID, $year, $classID, $className, $termID, $otherInfor))
				  {


				  }
				  else{
										$msg.='<!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">ERROR</h4>
                                        </div>
                                        <div class="modal-body">
                                            AN ERROR HAS OCCURED. PLEASE TRY AGAIN!
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal"><a href="tables.php" >PROCEED</a></button>
                                            </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->';
										echo $msg;

						}}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Juhudi Elimu: Welcome <?=getUserName(); ?></title>


<link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../../assets/css/datepicker3.css" rel="stylesheet">
<link href="../../assets/css/style.css" rel="stylesheet">
<link href="../../assets/css/bootstrap-table.css" rel="stylesheet">
<link href="../../assets/css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="../../assets/js/lumino.glyphs.js"></script>
<!--[if lt IE 9]>
<script src="../../assets/js/html5shiv.js"></script>
<script src="../../assets/js/respond.min.js"></script>
<![endif]-->

<script language="javascript">
			<!--
			function reload(form)
			{
			var val=form.county.options[form.county.options.selectedIndex].value;
 self.location='new_marklist.php?cat=' + val;

			}
 function reload1(form)
			{
			var val=form.county.options[form.county.options.selectedIndex].value;
var val2=form.district.options[form.district.options.selectedIndex].value;
			self.location='new_marklist.php?cat=' + val+ '&subcat='+val2;

			}
			function disableselect()
			{
			<?Php
			if(isset($cat) and strlen($cat) > 0){


echo "document.f1.district.disabled = false;";


}
			else{
	echo "document.f1.district.disabled = true;";
	echo "document.f1.school.disabled = true;";
	echo "document.f1.class.disabled = true;";
	}
	if(isset($subcat) and strlen($subcat) > 0){
		echo "document.f1.school.disabled = false;";


		}
	else{
		echo "document.f1.school.disabled = true;";
		echo "document.f1.class.disabled = true;";
		}



			?>
			}
			//-->

</script>
</head>

<body onLoad=disableselect();>
<!--navbar-->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

	<?php include_once(dirname(__FILE__) . '/../../helpers/header.php');?>

</nav>

<!--sidebar-->
<?php include_once(dirname(__FILE__) . '/../../helpers/sidebar.php');?> <!--/.sidebar-->


	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">New Mark List</li>
			</ol>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
            <div class="col-lg-8">
				<div class="panel panel-default">
					<div class="panel-heading">Create New Marklist</div>
					<div class="panel-body">
					 <?php echo $msg;?>
                        <div class="panel-body">
                        <?php

						///////// Getting the data from Mysql table for first list box//////////
						$quer2="SELECT DISTINCT county_id, county_name FROM county order by county_id";
						///////////// End of query for first list box////////////

						/////// for second drop down list we will check if category is selected else we will display all the subcategory/////
			if(isset($cat) and strlen($cat) > 0)
						{
							$quer="SELECT DISTINCT district_id, district_name FROM district WHERE district_county_id=$cat order by district_name ASC";
						}
						else{
							$quer="SELECT DISTINCT district_id, district_name FROM district order by district_name ASC"; }

				if(isset($subcat) and strlen($subcat) > 0)
						{
							$quer6="SELECT DISTINCT school_id, school_name FROM school WHERE school_district_id=$subcat AND school_county_id=$cat order by school_name ASC";
						}
						else{
							$quer6="SELECT DISTINCT school_id, school_name FROM school order by school_name ASC";
							}


						////////// end of query for second subcategory drop down list box ///////////////////////////
						$quer4="SELECT DISTINCT class_id, class_name FROM class order by class_id ASC";
						$quer5="SELECT DISTINCT term_id, exam_term_name FROM term order by term_id ASC";

						?>
				<form action="" method="post" name="f1" role="form">
                    <p><label>County</label>

              <?php  echo "<select name='county' onchange=\"reload(this.form)\" class='form-control' required><option value=''>Select County</option>";
				//while($noticia2 = mysql_fetch_array($quer2)) {
				foreach ($dbo->query($quer2) as $noticia2) {
					if($noticia2['county_id']==@$cat){
						echo "<option selected value='$noticia2[county_id]'>$noticia2[county_name]</option>"."<BR>";}
					else{
						echo  "<option value='$noticia2[county_id]'>$noticia2[county_name]</option>";}
					}
				echo "</select>";
//////////////////  This will end the first drop down list ///////////

//////////        Starting of second drop downlist /////////

			echo "<p><label>District</label>";
				 echo "<select name='district' onchange=\"reload1(this.form)\" class='form-control' required><option value=''>Select District</option>";
			foreach ($dbo->query($quer) as $noticia) {
								if($noticia['district_id']==@$subcat){
									echo "<option selected value='$noticia[district_id]'>$noticia[district_name]</option>"."<BR>";}
								else{
									echo  "<option value='$noticia[district_id]'>$noticia[district_name]</option>";}
								}
							echo "</select>";

			echo "<p><label>School</label>";
			echo "<select name='school' class='form-control' required><option value='' >Select School</option>";
			//while($noticia = mysql_fetch_array($quer)) {
			foreach ($dbo->query($quer6) as $noticia6) {
			echo  "<option value='$noticia6[school_id]'>$noticia6[school_name]</option>";
			}
			echo "</select>";
			echo'<a href="../school/add_school.php" >Click here if you cannot find your school.</a>';

			//  This will end the first drop down list ///////////
			echo "<p><label>Term</label>";

			echo "<select name='term' class='form-control' required><option value='' required>Select Term<option>";
			//while($noticia = mysql_fetch_array($quer)) {
			foreach ($dbo->query($quer5) as $noticia5) {
			echo  "<option value='$noticia5[term_id]'>$noticia5[exam_term_name]</option>";
			}
			echo "</select>";
			//////////        Starting of second drop downlist /////////
			echo "<p><label>Class</label>";

			echo "<select name='class' class='form-control' required><option value='' >Select Class</option>";
			//while($noticia = mysql_fetch_array($quer)) {
			foreach ($dbo->query($quer4) as $noticia4) {
			echo  "<option value='$noticia4[class_id]'>$noticia4[class_name]</option>";
			}
			echo "</select>";
			?>
			<p><label>Class Name</label>
										<input class="form-control" id="inputid" name="classname" placeholder="EAST, BLUE, ZAMBEZI, ... " value=""  required></p>
			<p><label>Other Information</label>
										<input class="form-control" id="inputid" name="otherinfor" placeholder="ZONE, DIVISION, SPECIAL EXAM, ... " value="" required></p>
			<br>


                        <p><left>  <right><button type="submit" name="create" value="create" class="btn btn-success">Create List</button>
                           </form>
                            <a href="../dashboard/index.php" ></right><left><button align="right" type="submit" name="cancel" value="cancel" class="btn btn-danger">Cancel</button></a></a></left></left>
                        </div>
				</div>
           </div></div>
		</div><!--/.row-->



	</div><!--/.main-->

	<script src="../../assets/js/jquery-1.11.1.min.js"></script>
	<script src="../../assets/js/bootstrap.min.js"></script>
	<script src="../../assets/js/chart.min.js"></script>
	<script src="../../assets/js/chart-data.js"></script>
	<script src="../../assets/js/easypiechart.js"></script>
	<script src="../../assets/js/easypiechart-data.js"></script>
	<script src="../../assets/js/bootstrap-datepicker.js"></script>
	<script src="../../assets/js/bootstrap-table.js"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){
				$(this).find('em:first').toggleClass("glyphicon-minus");
			});
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>
</body>

</html>
