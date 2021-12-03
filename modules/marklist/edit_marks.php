<?php
require_once(dirname(__FILE__) . '/../../includes/dbconnect.php');
require_once(dirname(__FILE__) . '/../../includes/functions.php');

if(isset($_GET['id']))
{
  $id=$_GET['id'];
  if(isset($_POST['update']))
  {
  $estudent=mb_strtoupper(mysql_real_escape_string($_POST['studentname']));
  $elang =mysql_real_escape_string($_POST['lang']);
  $ecompo=mysql_real_escape_string($_POST['compo']);
  $elugha=mysql_real_escape_string($_POST['lugha']);
  $einsha=mysql_real_escape_string($_POST['insha']);
  $emath=mysql_real_escape_string($_POST['maths']);
  $escience=mysql_real_escape_string($_POST['science']);
  $estudies=mysql_real_escape_string($_POST['studies']);
  $ecre=mysql_real_escape_string($_POST['cre']);

  editTableValue($id,$estudent,$elang,$ecompo,$elugha,$einsha,$emath,$escience,$estudies,$ecre);

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
				<li class="active">Edit Marks</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Edit Student Marks</div>
					<div class="panel-body">

                    <?php
					  if(isset($_GET['id']))
					  {
					  $id=$_GET['id'];
					  $getselect=mysql_query("SELECT * FROM results WHERE r_id='$id'");
					  while($profile=mysql_fetch_array($getselect))
					  {
						$student=$profile['student_name'];
						$lang=$profile['language'];
						$compo=$profile['composition'];
						 $lugha=$profile['lugha'];
						$insha=$profile['insha'];
						$maths=$profile['maths'];
						 $science=$profile['science'];
						$socialstudies=$profile['socialstudies'];
						$cre=$profile['cre'];

?>
  <form action="" method="post" name="insertform">
    <p>
      <label for="name"  id="preinput"> Student Name : </label>
      <input type="text" name="studentname" required placeholder="Edit Student Name"
      value="<?php echo $student; ?>" id="inputid" />
    </p>
    <p>
      <label  for="email"  id="preinput"> Language : </label>
      <input type="number" name="lang" required placeholder="Edit Language"
      value="<?php echo $lang; ?>" id="inputid" max="50" min="0"/>
    </p>
    <p>
      <label for="mobile" id="preinput"> Composition: </label>
      <input type="number" name="compo" required placeholder="Edit Composition"
      value="<?php echo $compo; ?>" id="inputid" max="30" min="0"/>
    </p>
      <p>
      <label for="name"  id="preinput"> Lugha : </label>
      <input type="number" name="lugha" required placeholder="Edit Lugha"
      value="<?php echo $lugha; ?>" id="inputid" max="50" min="0" />
    </p>
    <p>
      <label  for="email"  id="preinput"> Insha : </label>
      <input type="number" name="insha" required placeholder="Edit Insha"
      value="<?php echo $insha; ?>" id="inputid" max="30" min="0"/>
    </p>
    <p>
      <label for="mobile" id="preinput"> Maths : </label>
      <input type="number" name="maths" required placeholder="Edit Maths"
      value="<?php echo $maths; ?>" id="inputid" max="100" min="0"/>
    </p>
    <p>
      <label for="mobile" id="preinput"> Science : </label>
      <input type="number" name="science" required placeholder="Edit Science"
      value="<?php echo $science; ?>" id="inputid" max="100" min="0"/>
    </p>

   <p>
      <label for="mobile" id="preinput"> S/Studies : </label>
      <input type="number" name="studies" required placeholder="Edit S/Studies"
      value="<?php echo $socialstudies; ?>" id="inputid" max="60" min="0" />
    </p>
    <p>
      <label for="mobile" id="preinput"> C.R.E : </label>
      <input type="number" name="cre" required placeholder="Edit C.R.E"
      value="<?php echo $cre; ?>" id="inputid" max="30" min="0"/>
    </p>
    <p>
      <input type="submit" name="update" value="Update Marks" id="inputid" class="btn btn-success" />
    </p>
  </form>
             <?php } }else{
	echo"No selection was made for editing.";
	} ?>  </div>
                        <div class="panel-footer">
                            Easy & Fast
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
