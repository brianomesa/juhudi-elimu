<?php
require_once(dirname(__FILE__) . '/../../includes/dbconnect.php');
require_once(dirname(__FILE__) . '/../../includes/functions.php');

   if(isset($_GET['id']))
					  {
					  $id=$_GET['id'];
					  $getselect= mysql_query("SELECT * FROM system_log WHERE system_log_id=".$id);

					  while($profile=mysql_fetch_array($getselect))
					  {
						$system_log_id=$profile['system_log_id'];
						$s_county_id=$profile['s_county_id'];
						$s_district_id=$profile['s_district_id'];
						$s_school_id=$profile['s_school_id'];
						$s_teacher_id=$profile['s_teacher_id'];
						$s_class_id=$profile['s_class_id'];
						$s_class_name=$profile['s_class_name'];
						$s_term_id=$profile['s_term_id'];
						$s_year_log=$profile['s_year_log'];
					  }
					  header('Location: update_header.php?cat='.$s_county_id.'&subcat='.$s_district_id.'&scl='.$s_school_id.'&t='.$s_term_id.'&lu='.$id.'&cl='.$s_class_id);
					  }

					  ?>
