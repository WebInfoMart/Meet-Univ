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
	<link rel="stylesheet" href="<?php echo "$base$admin_css"; ?>/bootstrap.css">
	
	<!--<link rel="stylesheet" href="<?php //echo "$base$css_path"?>/bootstrap.css">-->

	
	
	
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
	<script type="text/javascript" src="<?php echo "$base$js";?>/jquery.timeago.js"></script>
	<script type="text/javascript" src="<?php echo "$base$js";?>/bootstrap-typeahead.js"></script>
	
</head>



 
<body>


	<div id="header">
	<?php 
	$img_exist=0;
  if($admin_user_level==3){ 
  $univ_detail_edit=$this->adminmodel->fetch_univ_detail($user_id);
  $univ_img = $univ_detail_edit[0]->univ_logo_path;
  if(file_exists(getcwd().'/uploads/univ_gallery/'.$univ_img) && $univ_img!='')	{ 
  list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/univ_gallery/'.$univ_img);
  $univ_image=$base.'uploads/univ_gallery/'.$univ_img;
  $img_exist=1;
  }
  }
  if($img_exist==0)
  {
	list($width, $height, $type, $attr) = getimagesize(getcwd().'/images/logo.png');
	$univ_image=$base.'images/logo.png';
  }
  $img_arr=$this->searchmodel->set_the_image($width,$height,50,180,TRUE);
	?>						
		<div class="aspectcorrect float_l" ><img style="height:50px;width:180px;"  src="<?php echo $univ_image;?>" alt=""  />
		</div>
	<?php  if($admin_user_level==3){
			if($univ_detail_edit!=0){ ?>
		<div class="float_l univ_name_margin" ><h3><?php echo $univ_detail_edit[0]->univ_name; ?></h3></div>
		<?php } } ?>
		<form action="" method="post" class="searchform">
			<input type="text" class="text" value="Search..." />
			<input type="submit" class="submit" value="" />
		</form>
		
		
		<div class="userprofile">
			<ul>
				<li><a href="#"><img src="../images/admin/avatar.gif" alt="" />Welcome <?php echo ucwords($this->session->userdata('admin_fullname')); ?></a>
					<ul>
						<li><a href="#">Profile</a></li>
						<li><?php echo anchor('admin/update_password/', 'Change Password'); ?></li>
						<!--<li><a href="#">Messages</a></li>-->
						<li><?php echo anchor('admin/adminlogout/', 'Logout'); ?></li>
					</ul>
				</li>
			</ul>
		</div>		<!-- .userprofile ends -->
			
	</div>			<!-- #header ends -->
	
<script>
 jQuery(document).ready(function() {
  jQuery("abbr.timeago").timeago();
});
</script>	
	
	
	