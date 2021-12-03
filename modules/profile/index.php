<?php
require_once(dirname(__FILE__) . '/../../includes/dbconnect.php');
require_once(dirname(__FILE__) . '/../../includes/functions.php');

$message='';

	$trid= $_SESSION['user2'];



	if(isset($_POST['btn-save']))
	{
		$teacher_name = mysql_real_escape_string($_POST['fullnames']);
		$username= mysql_real_escape_string($_POST['username']);
		$dateofbirth = mysql_real_escape_string($_POST['dateofbirth']);
		$phone = mysql_real_escape_string($_POST['phone']);
		$email = mysql_real_escape_string($_POST['email']);
		$location = mysql_real_escape_string($_POST['location']);

		$verify= mysql_query("UPDATE `profile` SET `teacher_username`='$username',`teacher_name`='$teacher_name',
			`location`='$location',`year`='$dateofbirth',`email`='$email',`phone`='$phone' WHERE teacher_id = '$trid' ");

			 $message.= "<div class='alert bg-success alert-dismissable'>
	                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center>
	                                Update was Successfull. </a>
	                            </div>";

	}
	$result=mysql_query("SELECT `profile_id`, `teacher_id`, `teacher_username`, `teacher_name`, `location`, `year`, `email`, `phone` FROM `profile` WHERE teacher_id='$trid'")or die(mysql_error());

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
				<li class="active">Profile</li>
			</ol>
		</div><!--/.row-->

		<br>

		<div class="col-lg-8">
										 <div class="panel panel-info">
												<div class="panel-heading">
														<i class="fa fa-bell fa-fw"></i>My Profile
												</div>
												<!-- /.panel-heading -->
												<div class="panel-body">
														<div class="list-group">
                    <?php echo $message;	?>
                        <form action="" method="post" name="f1" al>
                        <p> <label>User Name</label><p class="text-success"><?php echo " ".$row['teacher_username'] ?></p></p>
												<p><label>ID Number</label><p class="text-success"><?php echo " ".$row['teacher_id'] ?></p>
													  <p><label>Full Names</label><p class="text-success"><?php echo " ".$row['teacher_name'] ?></p>
                            <p><label>County</label><p class="text-success"><?php echo " ".$row['location']?></p>
                            <p><label>Date Of Birth</label><p class="text-success"><?php echo " ".$row['year'] ?></p>
                            <p><label>Email</label><p class="text-success"><?php echo " ".$row['email']?></p>
                            <p><label>phone</label><p class="text-success"><?php echo " ".$row['phone']?></p>

                            </form>
                        </div>
												<button class="btn btn-primary btn-default" data-toggle="modal" data-target="#profile">
																	 Update Profile
																</button>
												 <a href="../authentication/change_password.php"> <button class="btn btn-primary btn-default" >Change Password
																</button></a>
				</div>
           </div>
		</div><!--/.row-->

<!--/.modal-->
<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
		 <div class="modal-dialog">
				 <div class="panel panel-primary">
						 <div class="panel-heading">
								 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								 <h4 class="panel-title" id="contactLabel"><span class="glyphicon glyphicon-info-sign"></span>UPDATE PROFILE</h4>
						 </div>
						 <form action="" method="post" accept-charset="utf-8">
						 <div class="modal-body" style="padding: 5px;">
									 <div class="row">
										 <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
														 <input class="form-control" name="fullnames" placeholder="Full Names" value="<?php echo $row['teacher_name']?>" type="text" required autofocus />
												 </div>

										 </div>
										  <div class="row">
										 <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
														<input class="form-control" name="username" placeholder="User Name" value="<?php echo  $row['teacher_username']?>" type="text" required autofocus />
												</div>

										</div>
										 <div class="row">
												 <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
														 <input class="form-control" name="idnumber" placeholder="ID Number" type="text" value="<?php echo  $row['teacher_id']?>"  disabled />
												 </div>
										 </div>
											<div class="row">
												 <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
														 <input class="form-control" name="phone" placeholder="Phone Number" type="text" value="<?php echo $row['phone']?>" required />
												 </div>
										 </div>
										 <div class="row">
												 <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
														 <input class="form-control" name="email" placeholder="Email" type="text" value="<?php echo  $row['email']?>" required />
												 </div>
										 </div>
										 <div class="row">
												 <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
														 <input class="form-control" id="inputdate" name="dateofbirth" placeholder="Date of Birth" type="date" value="<?php echo  $row['year']?>" required />
												 </div>
										 </div>
										 <div class="row">
												 <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
														 <input class="form-control" name="location" placeholder="County" type="text" value="<?php echo  $row['location']?>" required />
												 </div>
										 </div>

								 </div>
								 <div class="panel-footer" style="margin-bottom:-14px;">
										 <input type="submit" name="btn-save" class="btn btn-success" value="Update"/>
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
