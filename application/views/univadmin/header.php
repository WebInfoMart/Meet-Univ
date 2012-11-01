<!doctype html>
<html lang="en">
<head>
  <link rel="stylesheet" href="<?php echo $base; ?>newadmin/css/style.css">
  <link rel="stylesheet" href="<?php echo $base; ?>newadmin/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo $base; ?>newadmin/css/bootstrap-responsive.css">
  <link rel="stylesheet" href="<?php echo $base; ?>newadmin/css/fullcalendar.css">
  <link rel="stylesheet" href="<?php echo $base; ?>newadmin/css/jquery.fancybox-1.3.4.css">
  <link rel="stylesheet" href="<?php echo $base; ?>newadmin/css/smoothness/jquery-ui-1.8.21.custom.css">
  <script src="<?php echo $base;?>newadmin/js/jquery.js"></script>
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
  <!-- BEGIN Navbar -->
  <div class="navbar navbar-top">
    <div class="navbar-inner">
      <div class="container-fluid">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a class="brand" href="#">Meet Universities Admin</a>
        <div class="pull-right nav-collapse">
          <ul class="nav">
            <li class='dropdown'>
              <a href="#" class='dropdown-toggle' data-toggle='dropdown'>
                <img src="<?php echo $base;?>newadmin/img/icon-user.png" alt="" />
                Username
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="account.html">My Account</a>
                  <a href="balance.html">Balance</a>
                </li>
              </ul>
            </li>
            <li class="divider-vertical"></li>
            <li>
              <a href="#">
                <img src="<?php echo $base;?>newadmin/img/icon-message.png" alt="" />
                Messages
              </a>
            </li>
            <li class="divider-vertical"></li>
            <li>
              <a href="change_password.html">
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