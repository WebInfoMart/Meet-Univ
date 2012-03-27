<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<meta http-equiv="X-UA-Compatible" content="IE=7" />

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
	<title>Adminium - Modern Admin Panel Interface</title>
	
	<meta name="description" content="." />
	<meta name="keywords" content="." />
		
	
	<link rel="stylesheet" href="<?php echo "$base$admin_css";?>/style.css">
	<link rel="stylesheet" href="<?php echo "$base$admin_css"; ?>/visualize.css">
	<link rel="stylesheet" href="<?php echo "$base$admin_css"; ?>/date_input.css">
	<link rel="stylesheet" href="<?php echo "$base$admin_css"; ?>/jquery.minicolors.css">
	<link rel="stylesheet" href="<?php echo "$base$admin_css"; ?>/jquery.wysiwyg.css">
	<link rel="stylesheet" href="<?php echo "$base$admin_css" ;?>/jquery.fancybox.css">
	<link rel="stylesheet" href="<?php echo "$base$admin_css"; ?>/tipsy.css">
	<link rel="stylesheet" href="<?php echo "$base$admin_css"; ?>/admin.css">

	
	
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.8.16/jquery-ui.min.js"></script>
	
	<script type="text/javascript" src="<?php echo "$base$js";?>/excanvas.js"></script>
	<script type="text/javascript" src="<?php echo "$base$js";?>/jquery.visualize.js"></script>
	<script type="text/javascript" src="<?php echo "$base$js";?>/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="<?php echo "$base$js";?>/jquery.date_input.min.js"></script>
	<script type="text/javascript" src="<?php echo "$base$js";?>/jquery.minicolors.min.js"></script>
	<script type="text/javascript" src="<?php echo "$base$js";?>/jquery.wysiwyg.js"></script>
	<script type="text/javascript" src="<?php echo "$base$js";?>/jquery.fancybox.js"></script>
	<script type="text/javascript" src="<?php echo "$base$js";?>/jquery.tipsy.js"></script>
	<script type="text/javascript" src="<?php echo "$base$js";?>/custom.js"></script>
	<script type="text/javascript" src="<?php echo "$base$js";?>/jquery.MultiFile.min.js"></script>
	<script type="text/javascript" src="<?php echo "$base$js";?>/bootstrap-dropdown.js"></script>
</head>




<body>


	<div id="header">
	
		<a href="<?php echo "$base$admin"; ?>"><img src="<?php echo "$base$img_path" ?>/logo.png" alt="" height="50px;" width="180px" /></a>
		
		<form action="" method="post" class="searchform">
			<input type="text" class="text" value="Search..." />
			<input type="submit" class="submit" value="" />
		</form>
		
		
		<div class="userprofile">
			<ul>
				<li><a href="#"><img src="../images/admin/avatar.gif" alt="" />Welcome <?php echo ucwords($this->session->userdata('admin_fullname')); ?></a>
					<ul>
						<li><a href="#">Profile</a></li>
						<li><a href="#">Messages</a></li>
						<li><?php echo anchor('admin/adminlogout/', 'Logout'); ?></li>
					</ul>
				</li>
			</ul>
		</div>		<!-- .userprofile ends -->
			
	</div>			<!-- #header ends -->
	
	
	
	
	