<?php
require_once(dirname(__FILE__) . '/../../includes/dbconnect.php');
require_once(dirname(__FILE__) . '/../../includes/functions.php');

$message='';
if(isset($_POST['btn-email']))
{
	$email_check=mysql_real_escape_string($_POST['email']);
	$result=mysql_query("SELECT * FROM profile WHERE email='$email_check'") or die(mysql_error());
	if(mysql_num_rows($result))
	{
		forgotPassword($email_check);

		$message.="<br><div class='alert alert-success alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center>
                                A Reset Link has been sent to your Email address. Please access your email to create a new password. <a href='../authentication/login.php' class='alert-link'>Click here to Login</a></center>
                            </div>";

	}
	else
	{
		$message.="<br><div class='alert alert-warning alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center>
                                ACCOUNT DOES NOT EXIST! PLEASE TRY AGAIN.</center><a href='#' class='alert-link'></a>
                            </div>";
	}

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Juhudi Elimu: Welcome <?=getUserName(); ?></title>

<!-- Custom CSS -->
<link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../../assets/css/datepicker3.css" rel="stylesheet">
<link href="../../assets/css/styles.css" rel="stylesheet">
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
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php"><span>Juhudi </span>Elimu</a>
					</li>
				</ul>
			</div>

		</div><!-- /.container-fluid -->
	</nav>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active"><a href="login.php">Login</a></li>
				<li class="active">Forgot Password</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="message"><?php if(isset($message)) { echo $message; } ?></div>
        <div class="col-md-6 col-md-offset-3">

  <h4 style="border-bottom: 1px solid #c5c5c5;">
    <i class="glyphicon glyphicon-user">
    </i>
    Account Access
  </h4>
  <div style="padding: 20px;" id="form-olvidado">
  <h4 class="">
      Forgot your password?
    </h4>
<form accept-charset="UTF-8" role="form" id="login-recordar" method="post" action="">
      <fieldset>
        <span class="help-block">
         Enter the Email address you registered your account with
          <br>
          We'll send you an email with instructions to choose a new password.
        </span>
        <div class="form-group input-group">
          <span class="input-group-addon">
            @
          </span>
          <input class="form-control" placeholder="Email" name="email" type="email" required="">
        </div>
        <button type="submit" class="btn btn-primary btn-block" id="btn-olvidado" name="btn-email">
          Continue
        </button>
      </fieldset>
    </form>
  </div>
                        </div>
				</div>
           </div>
		</div><!--/.row-->



	</div><!--/.main-->

	<script src="../../assets/jquery-1.11.1.min.js"></script>
	<script src="../../assets/bootstrap.min.js"></script>
	<script src="../../assets/chart.min.js"></script>
	<script src="../../assets/chart-data.js"></script>
	<script src="../../assets/easypiechart.js"></script>
	<script src="../../assets/easypiechart-data.js"></script>
	<script src="../../assets/bootstrap-datepicker.js"></script>
	<script src="../../assets/bootstrap-table.js"></script>
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
