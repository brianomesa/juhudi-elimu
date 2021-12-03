<?php
require_once(dirname(__FILE__) . '/../../includes/dbconnect.php');
require_once(dirname(__FILE__) . '/../../includes/functions.php');

$dbc = new DbC("localhost", "root", "", "register");
$message="";
@$log=$_GET['log'];

switch ($log){
	case 102002:
	$message.="<div class='alert bg-warning alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center>
                                YOU ARE NOT LOGGED IN! PLEASE REGISTER OR LOG IN BELOW. </center><a href='#' class='alert-link'></a>
                            </div>";
							break;
	case 2:
	$message.="<div class='alert bg-danger alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center>
                                YOU ARE NOT REGISTERED! PLEASE REGISTER BELOW TO ACCESS OUR SERVICE.</center><a href='#' class='alert-link'></a>
                            </div>";
							break;
	case 3:
	$message.="<div class='alert alert-warning alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                               <center> AN ERROR HAS OCCURED! PLEASE LOG IN AGAIN.</center><a href='#' class='alert-link'></a>
                            </div>";
							break;
	case 4:
	$message.="<div class='alert bg-warning alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                               <center> YOUR SESSION HAS TIMED OUT! PLEASE LOG IN AGAIN.</center><a href='#' class='alert-link'></a>
                            </div>";
							break;



	}
if(isset($_SESSION['user']))
{
	header("Location: ../dashboard/index.php");
}

if(isset($_POST['btn-login']))
{
	$loginid = $dbc->escape($_POST['loginid']);
	$loginpass = $dbc->escape($_POST['loginpass']);

	$query = getUserID($loginid);
	$queryResult= $dbc->queryDb($query);
	$rowResults = $dbc->fetchResults($queryResult);

	if(login($rowResults,$loginid))
	{
	//do nothing
	$_SESSION['user'] = $rowResults['user_id'];

				if(isset($_GET['redirect'])) {
					 header('Location: index.php?redirect='.base64_decode($_GET['redirect']));
					 die;
					}
					else{
						header('Location: ../dashboard/index.php');
					}

	}

	else
	{
		$message.="<div class='alert bg-danger alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong><center>
                                CONFIRM USERNAME AND PASSWORD! ARE YOU REGISTERED?
																</center></strong><a href='#' class='alert-link'></a>
                            </div>";
	}

}

if(isset($_POST['btn-signup']))
{
	$uname = $dbc->escape($_POST['uname']);
	$id = $mysqli->real_escape_string($_POST['id']);
	$upass = md5($mysqli->real_escape_string($_POST['pass']));
	$email = $mysqli->real_escape_string($_POST['email']);

	$verify="SELECT * FROM users WHERE id_number='$id'";
	$result= $mysqli->query($verify) or die(mysqli_error());

	if(mysqli_num_rows($result)<1)
	{
		$mysqli->query("INSERT INTO users(username,id_number,password) VALUES('$uname','$id','$upass')")or die(mysqli_error());
		$mysqli->query("INSERT INTO `profile`(`teacher_id`, `teacher_username`, `email`) VALUES ('$id','$uname','$email')") or die(mysqli_error());
    $mysqli->query("INSERT INTO `marks_denominator`(`tr_id`, `composition_den`, `sstudie_den`, `cre_den`) VALUES ('$id',30, 60, 30)") or die(mysqli_error());
		 $message.= "<div class='alert bg-success alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center>
                                You have successfully Registered. Please <a href='login.php'>Login</a></center> <a href='#' class='alert-link'></a>.
                            </div>";
	}
	else
	{

		?>
        <?php   $message.="<div class='alert alert-warning alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center>
                                Your Registration has failed! User with the same ID exists. Please try again!</center><a href='#' class='alert-link'></a>.
                            </div>";

	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Juhudi Elimu</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
   <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/datepicker3.css" rel="stylesheet">
    <link href="../../assets/css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

                   <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="../../index.php"><span>Juhudi </span>Elimu</a>
                </li>
				</ul>
			</div>

		</div><!-- /.container-fluid -->
	</nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
									<br>
                      <!-- /.panel -->
                      <div class="container">

    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
							<h6><?php echo $message;?></h6>
						<div class="row">
							<div class="col-xs-6">
								<a href="#login" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="#register" id="register-form-link">Click Here To Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="loginid" id="inputid" tabindex="1" class="form-control" placeholder="User ID/ TSC Number" value="" required>
									</div>
									<div class="form-group">
										<input type="password" name="loginpass" id="inputid" tabindex="2" class="form-control" placeholder="Password" required>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="btn-login" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="register.php" tabindex="5" class="forgot-password">Register Here</a>
													<a href="forgot_password.php" tabindex="5" class="forgot-password">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div>
								</form>
								<form id="register-form" action="" method="post" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="uname" id="inputid" tabindex="1"  class="form-control" placeholder="User Name" value="" required>
									</div>
									<div class="form-group">
										<input type="email" name="email" id="inputid" tabindex="1" class="form-control" placeholder="Email Address" value="" required>
									</div>
									<div class="form-group">
										<input type="text" name="id" id="inputid" tabindex="2" class="form-control" placeholder="ID/TSC Number" required>
									</div>
									<div class="form-group">
										<input type="password" name="pass" id="inputid" tabindex="2" class="form-control" placeholder="Password" required>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="btn-signup" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../assets/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../assets/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script>$(function() {

    $('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

});
</script>


</body>

</html>
