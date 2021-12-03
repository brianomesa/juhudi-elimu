<?php
require_once(dirname(__FILE__) . '/../../includes/dbconnect.php');
require_once(dirname(__FILE__) . '/../../includes/functions.php');

$message='';

	$trid= $_SESSION['user2'];



	if(isset($_POST['btn-save']))
	{
		$composition_den = mysql_real_escape_string($_POST['comp_den']);
		$socialstudies_den= mysql_real_escape_string($_POST['socials']);
		$cre_den = mysql_real_escape_string($_POST['cre_den']);

		$result=mysql_query("SELECT * FROM `marks_denominator` WHERE `tr_id`='$trid'") or die(mysql_error());
		if(mysql_num_rows($result))
		{

		$verify= mysql_query("UPDATE `marks_denominator` SET `composition_den`='$composition_den',`sstudie_den`='$socialstudies_den',`cre_den`='$cre_den' WHERE `tr_id`= '$trid'")or die(mysql_error());

			 $message.= "<div class='alert bg-success alert-dismissable'>
	                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center>
	                                Update was Successfull. </a>
	                            </div>";

	}
	else{
		$insertDEN = mysql_query("INSERT INTO `marks_denominator`(`tr_id`, `composition_den`, `sstudie_den`, `cre_den`) VALUES ('$trid','$composition_den','$socialstudies_den','$cre_den')")or die(mysql_error());

	}
}
	$result=mysql_query("SELECT `composition_den`, `sstudie_den`, `cre_den` FROM `marks_denominator` WHERE tr_id='$trid'")or die(mysql_error());

	$row=mysql_fetch_array($result);
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

</head>

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
				<li class="active">Settings</li>
			</ol>
		</div><!--/.row-->

		<br>

		<div class="col-lg-8">
										 <div class="panel panel-info">
												<div class="panel-heading">
														<i class="fa fa-bell fa-fw"></i>Denominator Settings
												</div>
												<!-- /.panel-heading -->
												<div class="panel-body">
														<div class="list-group">
                    <?php echo $message;	?>
                        <form action="" method="post" name="f1" al>
                        <p> <label>Composition/Insha Denominator</label><p class="text-success"><?php echo " ".$row['composition_den'] ?></p>
													  <p><label>Social Studeies Denominator</label><p class="text-success"><?php echo " ".$row['sstudie_den'] ?></p>
                            <p><label>CRE Denominator</label><p class="text-success"><?php echo " ".$row['cre_den']?></p>

                            </form>
                        </div>
												<button class="btn btn-primary btn-default" data-toggle="modal" data-target="#settings">
																	 Update Settings
																</button>
				</div>
           </div>
		</div><!--/.row-->

<!--/.modal-->
<div class="modal fade" id="settings" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
		 <div class="modal-dialog">
				 <div class="panel panel-primary">
						 <div class="panel-heading">
								 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								 <h4 class="panel-title" id="contactLabel"><span class="glyphicon glyphicon-info-sign"></span>UPDATE SETTINGS</h4>
						 </div>
						 <form action="" method="post" accept-charset="utf-8">
						 <div class="modal-body" style="padding: 5px;">
									 <div class="row">
										 <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
														 <input class="form-control" name="comp_den" placeholder="Insha/Composition Denominator" value="<?php echo $row['composition_den']?>" type="number" required autofocus />
												 </div>

										 </div>
										  <div class="row">
										 <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
														<input class="form-control" name="socials" placeholder="Social Studies Denominator" value="<?php echo  $row['sstudie_den']?>" type="number" required autofocus />
												</div>

										</div>
										 <div class="row">
												 <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
														 <input class="form-control" name="cre_den" placeholder="CRE Denominator" type="number" value="<?php echo  $row['cre_den']?>" required autofocus   />
												 </div>
										 </div>
										</div>
								 <div class="panel-footer" style="margin-bottom:-14px;">
										 <input type="submit" name="btn-save" class="btn btn-success" value="Send"/>
												 <!--<span class="glyphicon glyphicon-ok"></span>-->
										 <input type="reset" class="btn btn-danger" value="Clear" />
												 <!--<span class="glyphicon glyphicon-remove"></span>-->
										 <button style="float: right;" type="button" class="btn btn-default  btn-close" data-dismiss="modal">Close</button>
								 </div>
						 </div>
				 </div>
		 </div>
 </div>

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
