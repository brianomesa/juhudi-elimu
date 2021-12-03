<?php
require_once(dirname(__FILE__) . '/../includes/dbconnect.php');
require_once(dirname(__FILE__) . '/../includes/functions.php');
sec_session_start();
checklogin();
?>
<div class="container-fluid">
	<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="../index.php"><span>JUHUDI </span>ELIMU</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg><?php
						if(isset($_SESSION['user'])!=""){

				   echo 'Welcome Tr '.login();
						} else{

						echo 'User';
							}?>
							<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="../profile/index.php"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
              <?php
						if(isset($_SESSION['user'])!="")
{
                        echo '<li><a href="../authentication/logout.php?logout=0"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>';
						} else{
							echo '<li><a href="../authentication/login.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Login</a></li>';

							}

						?>
						</ul>
					</li>
				</ul>
			</div></div>
