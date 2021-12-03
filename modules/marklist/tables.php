<?php
require_once(dirname(__FILE__) . '/../../includes/dbconnect.php');
require_once(dirname(__FILE__) . '/../../includes/functions.php');

if(isset($_GET['id'])){
$id=$_GET['id'];
if($id){
	setRandom($id);
	}
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

<!--sidebar-->
	<?php include_once(dirname(__FILE__) . '/../../helpers/sidebar.php');?> <!--/.sidebar-->


	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Enter Marks</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Enter Class Marks</div>
					<div class="panel-body">
						<button class="btn btn-primary btn-default" data-toggle="modal" data-target="#settings">
											 Add Student Details
										</button>

											</div></div></div>
											<?=DisplayLogInfo(); ?>

											<?=viewResultsTable(); ?>
											                    </div>

							</div>
           </div>
		</div><!--/.row-->



	</div><!--/.main-->
	<!--/.modal-->
	<div class="modal fade" id="settings" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
			 <div class="modal-dialog">
					 <div class="panel panel-primary">
							 <div class="panel-heading">
									 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									 <h4 class="panel-title" id="contactLabel"><span class="glyphicon glyphicon-info-sign"></span>ADD STUDENT</h4>
							 </div>
							 <form action="insert.php" method="post" name="insertform" accept-charset="utf-8">
							 <div class="modal-body">
								 <div class="row">
									 <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
								 <label for="name" id="preinput"> Please Enter Values As labelled: </label>
							 </div>
							</div>
								 <div class="row">
									 <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
										 <input type="text" class="form-control"  style='text-transform:capitalize' name="studentname" required placeholder="Student Name" id="inputid"/>
									  </div>
									 </div>
										<div class="row">
									 <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
										 <input type="number" class="form-control"  name="english" required placeholder="Language" max="50" min="0"  id="inputid"/>
									 </div>

									</div>
									 <div class="row">
											 <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
												 <input type="number" class="form-control" name="composition" required placeholder="Composition" max="30" min="0" id="inputid" />
 										 </div>
									 </div>
									 <div class="row">
										 <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
											 <input type="number" class="form-control" name="kiswahili" required placeholder="Lugha" max="50" min="0" id="inputid" />
										 	</div>

										 </div>
											<div class="row">
										 <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
											 <input type="number" class="form-control" name="insha" required placeholder="Insha" max="30" min="0" id="inputid"/>
										 </div>

										</div>
										 <div class="row">
												 <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
													 <input type="number" class="form-control" name="maths" required placeholder="Mathematics" max="100" min="0" id="inputid" />
												 </div>
										 </div>
										 <div class="row">
											 <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
												 <input type="number" class="form-control" name="science" required placeholder="Science" max="100" min="0" id="inputid" />
											 </div>

											 </div>
												<div class="row">
											 <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
												 <input type="number" class="form-control" name="socialstudies" required placeholder="S/Studies" max="60" min="0" id="inputid"/>

											 </div>

											</div>
											 <div class="row">
													 <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
														 <input type="number" class="form-control" name="cre" required placeholder="C.R.E" max="30" min="0"  id="inputid" />
													 </div>
											 </div>

											</div>
									 <div class="panel-footer" style="margin-bottom:-14px;">
											 <input type="submit"  class="btn btn-success" name="send" value="Submit Marks"  id="inputid" />
													 <!--<span class="glyphicon glyphicon-ok"></span>-->
											 <input type="reset" class="btn btn-danger" value="Clear" />
													 <!--<span class="glyphicon glyphicon-remove"></span>-->
											 <button style="float: right;" type="button" class="btn btn-default  btn-close" data-dismiss="modal">Close</button>
									 </div>
							 </div>
					 </div>
			 </div>
    <!-- Button trigger modal -->

                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">NOTE!</h4>
                                        </div>
                                        <div class="modal-body">
                                            Please verify everything before you print the Mark List. Note that you can edit or delete any wrong entry.<br> Otherwise if you are satisfied click on PROCEED.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary" onClick="window.open('../pdf/reportlist.php');"  data-dismiss="modal" >PROCEED</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

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
