<?php
require_once(dirname(__FILE__) . '/../../includes/dbconnect.php');
require_once(dirname(__FILE__) . '/../../includes/functions.php');

@$cat=$_GET['cat'];
@$subcat=$_GET['subcat'];
@$school=$_GET['scl'];
@$term=$_GET['t'];
@$id=$_GET['lu'];
@$class=$_GET['cl'];

$msg="";
$s_other_info;$s_class_name;

  if(isset($_GET['lu']))
					  {
					  $getselect=mysql_query("SELECT * FROM system_log WHERE system_log_id='$id'");
					  while($profile=mysql_fetch_array($getselect))
					  {
						$system_log_id=$profile['system_log_id'];

						$s_class_id=$profile['s_class_id'];
						$s_class_name=$profile['s_class_name'];
						$s_term_id=$profile['s_term_id'];
						$s_log_year= $profile['s_log_year'];
						$s_other_info=$profile['s_other_info'];
					  }

					  }else{
						  $s_other_info="";
						  $s_class_name="";

						  }

        if(isset($_POST['update']))
                                    {
               $county_id=$_POST['county'];
                                      $district_id=$_POST['district'];
                                      $school_id=$_POST['school'];
                                     $class_id=$_POST['class'];
                                      $clasname=strtoupper($_POST['classname']);
                                      $termID=$_POST['term'];
                                      $otherInfo=strtoupper($_POST['otherinfor']);
                                      $trID=$_SESSION['user2'];


        updateHeader($id,$county_id,$district_id,$school_id,$class_id,$clasname,$termID,$otherInfo);

                                      }

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
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<SCRIPT language=JavaScript>
            <!--
            function reload(form)
            {
            var val=form.county.options[form.county.options.selectedIndex].value;
			 self.location='update_header.php?cat=' + val;

            }
			 function reload1(form)
            {
            var val=form.county.options[form.county.options.selectedIndex].value;
			var val2=form.district.options[form.district.options.selectedIndex].value;
            self.location='update_header.php?cat=' + val+ '&subcat='+val2;

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

<body onload=disableselect();>
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
				<li class="active">Header Informatiom</li>
			</ol>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
            <div class="col-lg-8">
				<div class="panel panel-default">
					<div class="panel-heading">Edit Header Information</div>
					<div class="panel-body">
						<?php if (isset($msg)){ echo $msg;}?>
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

				if(isset($subcat) and isset($subcat))
						{
							$quer6="SELECT DISTINCT school_id, school_name FROM school WHERE school_district_id=$subcat AND school_county_id=$cat order by school_name";
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

              <?php  echo "<select name='county' onchange=\"reload(this.form)\" class='form-control' ><option value=''>Select one</option>";
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
     echo "<select name='district' onchange=\"reload1(this.form)\" class='form-control' ><option value=''>Select one</option>";
foreach ($dbo->query($quer) as $noticia) {
					if($noticia['district_id']==@$subcat){
						echo "<option selected value='$noticia[district_id]'>$noticia[district_name]</option>"."<BR>";}
					else{
						echo  "<option value='$noticia[district_id]'>$noticia[district_name]</option>";}
					}
				echo "</select>";

echo "<p><label>School</label>";
echo "<select name='school' class='form-control'><option value='' >Select one</option>";
//while($noticia = mysql_fetch_array($quer)) {
foreach ($dbo->query($quer6) as $noticia6) {
	if($noticia6['school_id']==@$school){
						echo "<option selected value='$noticia6[school_id]'>$noticia6[school_name]</option>"."<BR>";}
					else{
echo  "<option value='$noticia6[school_id]'>$noticia6[school_name]</option>";
}}
echo "</select>";


//  This will end the first drop down list ///////////
echo "<p><label>Term</label>";

echo "<select name='term' class='form-control' ><option value='' >Select one</option>";
//while($noticia = mysql_fetch_array($quer)) {
foreach ($dbo->query($quer5) as $noticia5) {
	if($noticia5['term_id']==@$term){
						echo "<option selected value='$noticia5[term_id]'>$noticia5[exam_term_name]</option>"."<BR>";}
					else{

echo  "<option value='$noticia5[term_id]'>$noticia5[exam_term_name]</option>";
}}
echo "</select>";
//////////        Starting of second drop downlist /////////
echo "<p><label>Class</label>";

echo "<select name='class' class='form-control' ><option value='' >Select one</option>";
//while($noticia = mysql_fetch_array($quer)) {
foreach ($dbo->query($quer4) as $noticia4) {
	if($noticia4['class_id']==@$class){
						echo "<option selected value='$noticia4[class_id]'>$noticia4[class_name]</option>"."<BR>";}
					else{

echo  "<option value='$noticia4[class_id]'>$noticia4[class_name]</option>";
}}
echo "</select>";
//////////        Starting of second drop downlist /////////

?>
<p><label>Class Name</label>
                            <input class="form-control" id="inputid" name="classname" placeholder="EAST, BLUE, ZAMBEZI, ... " value="<?php echo $s_class_name; ?>" ></p>
<p><label>Other Information</label>
                            <input class="form-control" id="inputid" name="otherinfor" placeholder="ZONE, DIVISION, SPECIAL EXAM, ... " value="<?php echo $s_other_info;?>" ></p>


<br>


                       <p>   <left> <button type="submit" name="update" value="update" class="btn btn-success">Update Header Info</button></left>
                            </form>
                           <right> <a href="../tables/index.php" > <button align="right" type="submit" name="cancel" value="cancel" class="btn btn-danger">Cancel</button></a></p>
                        </div>
                        </div>
				</div>
           </div>
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
