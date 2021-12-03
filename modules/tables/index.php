<?php

require_once(dirname(__FILE__) . '/../../includes/dbconnect.php');
require_once(dirname(__FILE__) . '/../../includes/functions.php');

$message='';

if(isset($_GET['true'])){
	$message.="<div class='alert bg-success alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><center>
                               Your Mark List Has been deleted successfully.
                            </div>";
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
<script src="../../assets/js/html5shiv.js"></script>
<script src="../../assets/js/respond.min.js"></script>
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
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">My Mark Lists</li>
			</ol>
		</div><!--/.row-->


		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">My Mark Lists</div>
					<div class="panel-body">


                    <?php echo $message; ?>
                    <a href="../marklist/new_marklist.php"> <button class="btn btn-primary btn-default" >
                               Create New Marklist
                            </button>

                            </a>
                                  <?php myTables(); ?><br>
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
