<?php
$admin_profile = $this->adminmodel->get_admin_profile($user_id);
foreach($admin_profile as $profile_detail)
{
	if(file_exists(getcwd().'/uploads/user_pic/'.$profile_detail['user_pic_path']) && $profile_detail['user_pic_path']!='') 
	{
		$profile_img_path=$base.'uploads/user_pic/'.$profile_detail['user_pic_path'];
	}
	else
	{
		$profile_img_path=$base.'images/profile_icon.png';
	}
	$admin_name = $profile_detail['fullname'];
}
?>
<!doctype html>
<html lang="en">
<head>
  <link rel="stylesheet" href="<?php echo $base; ?>newadmin/css/style.css">
  <link rel="stylesheet" href="<?php echo $base; ?>newadmin/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo $base; ?>newadmin/css/bootstrap-responsive.css">
  <link rel="stylesheet" href="<?php echo $base; ?>newadmin/css/fullcalendar.css">
  <link rel="stylesheet" href="<?php echo $base; ?>newadmin/css/jquery.fancybox-1.3.4.css">
  <link rel="stylesheet" href="<?php echo $base; ?>newadmin/css/smoothness/jquery-ui-1.8.21.custom.css">
  <link rel="stylesheet" href="<?php echo $base; ?>newadmin/css/jquery.cleditor.css">
  <link rel="stylesheet" href="<?php echo $base; ?>newadmin/css/jquery.tagsinput.css">
  <link rel="stylesheet" href="<?php echo $base; ?>newadmin/css/bootstrap.datepicker.css">
  <link rel="stylesheet" href="<?php echo $base; ?>newadmin/css/jquery.ui.plupload.css">
  <link rel="stylesheet" href="<?php echo $base; ?>newadmin/css/jquery.plupload.queue.css">

 
<script src="<?php echo $base;?>js/jquery.js"></script>
<script src="<?php echo $base;?>newadmin/js/bootstrap.js"></script>
<script src="<?php echo $base;?>newadmin/js/jquery.flot.js"></script>
<script src="<?php echo $base;?>newadmin/js/fullcalendar.min.js"></script>
<script src="<?php echo $base;?>newadmin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $base;?>newadmin/js/jquery.fancybox-1.3.4.pack.js"></script>
<script src="<?php echo $base;?>newadmin/js/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo $base;?>newadmin/js/jquery.flot.pie.js"></script>
<script src="<?php echo $base;?>newadmin/js/jquery.flot.orderBars.js"></script>
<script src="<?php echo $base;?>newadmin/js/jquery.flot.resize.js"></script>
<script src="<?php echo $base;?>newadmin/js/jquery-ui-1.8.21.custom.min.js"></script>
<script src="<?php echo $base;?>newadmin/js/custom.js"></script>
<script src="<?php echo $base;?>newadmin/js/jquery.timeago.js"></script>
<script src="<?php echo $base;?>newadmin/js/jquery.timepicker.js"></script>
<script src="<?php echo $base;?>newadmin/js/jquery.cleditor.min.js"></script>
<script src="<?php echo $base;?>newadmin/js/chosen.jquery.min.js"></script>
<script src="<?php echo $base;?>newadmin/js/bootstrap.datepicker.js"></script>
<script src="<?php echo $base;?>newadmin/js/jquery.mousewheel.js"></script>
<script src="<?php echo $base;?>newadmin/js/ui.spinner.js"></script>
<script src="<?php echo $base;?>newadmin/js/plupload/plupload.full.js"></script>
<script src="<?php echo $base;?>newadmin/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script src="<?php echo $base;?>newadmin/js/jquery.tagsinput.min.js"></script>
<script src="<?php echo $base;?>newadmin/js/jquery.inputmask.min.js"></script> 
<script src="<?php echo $base;?>newadmin/js/bootstrap.timepicker.js"></script>


<!--<script src="<?php //echo $base;?>newadmin/js/jquery.js"></script>-->
	
	<script type="text/javascript" src="<?php echo $base;?>js/jquery.MultiFile.min.js"></script>
  <!-- BEGIN Navbar -->
  <div class="navbar navbar-top">
    <div class="navbar-inner">
      <div class="container-fluid">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a class="brand" href="<?php echo $base;?>admin">Meet Universities Admin</a>
        <div class="pull-right nav-collapse">
          <ul class="nav">
            <li class='dropdown'>
              <a href="#" class='dropdown-toggle' data-toggle='dropdown'>
                <img src="<?php echo $profile_img_path;?>" alt="" width="13" height="auto"/>
                <?php echo ucwords($admin_name); ?>
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="javascript:void(0);">My Account</a>
                  <a href="javascript:void(0);">Balance</a>
                </li>
              </ul>
            </li>
            <li class="divider-vertical"></li>
            <li>
              <a href="javascript:void(0);">
                <img src="<?php echo $base;?>newadmin/img/icon-message.png" alt="" />
                Messages
              </a>
            </li>
            <li class="divider-vertical"></li>
            <li>
              <a href="<?php echo $base;?>admin/update_password">
                <img src="<?php echo $base;?>newadmin/img/icon-settings.png" alt="" />
                Settings
              </a>
            </li>
            <li class="divider-vertical"></li>
            <li>
              <a href="<?php echo $base; ?>admin/adminlogout">
                <img src="<?php echo $base;?>newadmin/img/icon-logout.png" alt="" />
                Logout
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- END Navbar -->
  <script>
  var baseurl='<?php echo $base;?>newadmin';
  </script>
  </head>
 <body> 