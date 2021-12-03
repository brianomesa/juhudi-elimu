<?php
require_once(dirname(__FILE__) . '/../../includes/dbconnect.php');
require_once(dirname(__FILE__) . '/../../includes/functions.php');

@$teacher_id=$_GET('mwalimu');
@$truemanene=$_GET['reset'];
if($truemanene==true&&isset($teacher_id))
{
	$newTeacherId=$teacher_id/111;

	$newPass =md5( mysql_real_escape_string($_POST['newPassword']));
	$confrPass = md5(mysql_real_escape_string($_POST['confirmPassword']));
	$message='';
	$result=mysql_query("SELECT * FROM users WHERE id_number='$newTeacherId'")or die(mysql_error());
	$row=mysql_fetch_array($result);

		if($confrPass==$newPass)
		{
			if(mysql_num_rows($result))
			{
				mysql_query("INSERT INTO users(password) VALUES('$newPass')");
				 $message.= "<div class='alert alert-success alert-dismissable'>
										<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center>
										You have successfully Changed Your Password. Keep it safe! <br>Your next login will require the new password!</center> <a href='../login.php' class='alert-link'>Click here to login</a>.
									</div>";
			}
			else
			{

				?>
				<?php   $message.="<div class='alert alert-danger alert-dismissable'>
										<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center>
										Password change has failed. Please try again!</center><a href='#' class='alert-link'></a>.
									</div>";

			}
			}
			else{
				$message.="<div class='alert alert-danger alert-dismissable'>
										<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center>
										New and Confirmed passwords do not match. Try Again!</center><a href='#' class='alert-link'></a>.
									</div>";}

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

</head>

<body>
	<!--navbar-->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

	  <?php include_once(dirname(__FILE__) . '/../../helpers/header.php');?>

	</nav>



	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="login.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Forgot Password</li>
			</ol>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Advanced Table</div>
					<div class="panel-body">
						<div class="message"><?php if(isset($message)) { echo $message; } ?></div>
  <div style="padding: 20px;" id="form-olvidado">
  <form method="post">
      <fieldset>
        <div class="form-group input-group">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-lock">
            </i>
          </span>
          <input class="form-control" placeholder="New Password" name="newPassword" type="password" value="" required="">
        </div>
        <div class="form-group input-group">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-lock">
            </i>
          </span>
          <input class="form-control" placeholder="Confirm Password" name="confirmPassword" type="password" value="" required="">
        </div>
        <div class="form-group">
          <button type="submit" name="submit_pass" value="Submit" class="btn btn-primary btn-block">
            Submit
          </button>
          <br>
           <a href="index.php"> <button type="submit" name="cancel" value="Submit" class="btn btn-danger btn-block">
            Cancel
          </button></a>
        </div>
      </fieldset>
    </form>

</form>
  </div>

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
