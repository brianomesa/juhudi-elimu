<!--sidebar -->
<?php

require_once(dirname(__FILE__) . '/../includes/functions.php');
sec_session_start();
 ?>
  <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">

<ul class="nav menu">
  <li class="active"><a href="../dashboard/index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
  <li><a href="../marklist/new_marklist.php"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Create New Mark List</a></li>
  <li><a href="../tables/index.php"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> My Mark Lists</a></li>
  <li><a href="../settings/index.php"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
    <li role="presentation" class="divider"></li>
    <?php
  if(isset($_SESSION['user'])!="")
{
              echo '<li><a href="../authentication/logout.php?logout=0"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>';
  } else{
    echo '<li><a href="../authentication/login.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Login</a></li>';

    }

  ?>
  </ul>

</div><!--/.sidebar-->
