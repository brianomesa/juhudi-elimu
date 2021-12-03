<?php
require_once(dirname(__FILE__) . '/../../includes/dbconnect.php');
require_once(dirname(__FILE__) . '/../../includes/functions.php');

@$cat=$_GET['cat'];
@$subcat=$_GET['subcat'];
@$insert=$_GET['insert'];
$msg="";
if(isset($_POST['create']))
			  {
				 $countyID=$_POST['county'];
				  $districtID=$_POST['district'];
				  $schoolName=$_POST['schoolname'];
				  echo $countyID,$districtID;
				  echo $cat, $subcat;

				  createSchoolName($countyID,$districtID,$schoolName);

			  }

				  if(isset($_GET['insert']))
{
	$msg.="<br><div class='alert bg-warning alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center>
                               YOUR ATTEMPT TO ADD A SCHOOL DID NOT SUCCEED. PLEASE TRY AGAIN!</center><a href='#' class='alert-link'></a>
                            </div>";
	}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Juhudi Mwalimu: Welcome <?=getUserName(); ?></title>

<link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../../assets/css/datepicker3.css" rel="stylesheet">
<link href="../../assets/css/style.css" rel="stylesheet">
<link href="../../assets/css/bootstrap-table.css" rel="stylesheet">
<link href="../../assets/css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="../../assets/js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<SCRIPT language=JavaScript>
            <!--
            function reload(form)
            {
            var val=form.county.options[form.county.options.selectedIndex].value;
			 self.location='add_school.php?cat=' + val;

            }
			 function reload1(form)
            {
            var val=form.county.options[form.county.options.selectedIndex].value;
			var val2=form.district.options[form.district.options.selectedIndex].value;
            self.location='add_school.php?cat=' + val+ '&subcat='+val2;

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
				<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li><a href="create_new_marklist.php">New Mark List</a></li>
				<li class="active">Add School</li>
			</ol>
		</div><!--/.row-->


		<div class="row">
			<div class="col-lg-8">
				<div class="panel panel-default">
					<div class="panel-heading">Add School</div>
					<div class="panel-body">
					   <br>
                          <?php echo $msg;?><br>

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

                        <form action="" method="post" name="f1">
                           <p><label>County</label>

              <?php  echo "<select name='county' onchange=\"reload(this.form)\" class='form-control' ><option value=''>Select County</option>";
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
     echo "<select name='district' onchange=\"reload1(this.form)\" class='form-control' ><option value=''>Select District</option>";
foreach ($dbo->query($quer) as $noticia) {
					if($noticia['district_id']==@$subcat){
						echo "<option selected value='$noticia[district_id]'>$noticia[district_name]</option>"."<BR>";}
					else{
						echo  "<option value='$noticia[district_id]'>$noticia[district_name]</option>";}
					}
				echo "</select>";

echo '<p><label>School Name</label>
                            <input class="form-control" id="inputid" name="schoolname" placeholder="SCHOOL NAME... " value=""  required></p>';
?>


<br>


                        <p><left>  <right><button type="submit" name="create" value="create" class="btn btn-success">Add New School</button>
                           </form>
                            <a href="../marklist/new_marklist.php" ></right><left><button align="right" type="submit" name="cancel" value="cancel" class="btn btn-danger">Cancel</button></a></a></left></left>
                        </div>
				</div>
           </div>
		</div><!--/.row-->



	</div><!--/.main-->
<script src="../../assets/js/jquery.min.js"> </script>
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
