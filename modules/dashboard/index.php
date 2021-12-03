<?php
require_once(dirname(__FILE__) . '/../../includes/dbconnect.php');
require_once(dirname(__FILE__) . '/../../includes/functions.php');

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Juhudi Elimu: Welcome <?=getUserName(); ?></title>

<link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../../assets/css/datepicker3.css" rel="stylesheet">
<link href="../../assets/css/styles.css" rel="stylesheet">

<link href="../../assetscss/bootstrap-table.css" rel="stylesheet">
<link href="../../assetscss/styles.css" rel="stylesheet">

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

	<!--sidebar-->
	<?php include_once(dirname(__FILE__) . '/../../helpers/sidebar.php');?> <!--/.sidebar-->

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Thank you for choosing Juhudi Elimu</h1>
			</div>
		</div><!--/.row-->


		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">How It Works</div>
					<div class="panel-body">
						JUHUDI ELIMU is a sofware platform for teachers to enable them process their class Mark List in a Quick, Neat and Efficient manner. The manual process is tideous, wastes papers and time. JUHUDI ELIMU reduces the effort put to come up with a Mark List. It also stores your Mark List for future reference, therefore you can print it whenever you want to.
                        </div>
				</div>
           </div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<h3>Process</h3>
			</div>
			<div class="col-md-4">
				<div class="panel panel-blue">
					<div class="panel-heading">
						Step 1
					</div>
					<div class="panel-body">
						<p>New users are required to update their profiles once they log in. Profile updates can be made <a href="../profile/index.php" style="color:black">HERE</a></p>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel panel-orange">
					<div class="panel-heading">
						Step 2
					</div>
					<div class="panel-body">
						<p>To start your New Mark List. Click on the New Mark List Menu. You will fill the options required and the information entered will be used as the Heading of The Mark List. After creating the Header Info You will be directed to another page to Enter the Students Marks.</p>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel panel-red">
					<div class="panel-heading">
						Step 3
					</div>
					<div class="panel-body">
						<p>After completing Step 2, Click on the Blue Button "PRINT MARK LIST". A PDF document will be generated and you will save it and Print. Note that you can Edit or Delete the results as many times as you want.</p>
					</div>
				</div>
			</div>
		</div><!-- /.row -->


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
