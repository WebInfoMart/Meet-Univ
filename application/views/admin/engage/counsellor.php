<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Meet Universities - Get connected to your dream university.</title>
<link rel="stylesheet" href="<?php echo $base; ?>css/admin/engage/bootstrap.css">
<link rel="stylesheet" href="<?php echo $base; ?>css/admin/engage/style.css">
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
</head>
<body>
	<header>
		<div class="span6 float_r margin2">
			<div class="float_l border_holder">
				<img src="<?php echo $base; ?>images/images/user.png" alt="User" title="User"/>
				<span class="margin_l">Hello Administrator</span>
			</div>
			<div class="float_l border_holder">
				<img src="<?php echo $base; ?>images/images/msg.png" alt="User" title="User"/>
			</div>
			<div class="float_l border_holder">
				<img src="<?php echo $base; ?>images/images/setting.png" alt="User" title="User"/>
			</div>
			<div class="float_l border_holder border_beta">
				logout
			</div>
		</div>
	</header>
	<div class="float_l sidebar">
		<div class="search_box">
			<img src="<?php echo $base; ?>images/images/search_icon.png" class="search_input_set"><input type="text" name="search" value="search" class="search_input">
		</div>
		<div class="menu">
			<ul id="nav">
                <li class="active"><a href="#"><img src="<?php echo $base; ?>images/images/home_icon.png" /> <span>Dashboard</span></a></li>
                <li><a href="#"><img src="<?php echo $base; ?>images/images/paged_icon.png" /><span>Pages</span></a>
                </li>
               <li><a href="#"><img src="<?php echo $base; ?>images/images/side_user_icon.png" /><span>Users</span></a>
                </li>
                <li><a href="#"><img src="<?php echo $base; ?>images/images/edit_icon.png" /><span>Articles</span></a></li>
                <li><a href="#"><img src="<?php echo $base; ?>images/images/cal_icon.png" /><span>Events</span></a></li>
                <li><a href="#"><img src="<?php echo $base; ?>images/images/lib_icon.png" /><span>Manage Universities</span></a></li> 
				<li><a href="#"><img src="<?php echo $base; ?>images/images/img_icon.png" /><span>Manage Home Gallery</span></a></li> 
				<li><a href="#"><img src="<?php echo $base; ?>images/images/book_icon.png" /><span>Proagram/Courses</span></a></li> 
				<li><a href="#"><img src="<?php echo $base; ?>images/images/book_icon.png" /><span>University/Courses</span></a></li>
				<li><a href="#"><img src="<?php echo $base; ?>images/images/img_icon.png" /><span>University Gallery</span></a></li>
				<li><a href="#"><img src="<?php echo $base; ?>images/images/clip_icon.png" /><span>Manage Univ/Proagram</span> </a></li>
				<li><a href="#"><img src="<?php echo $base; ?>images/images/clip_icon.png" /><span>Manage Univ/Users</span> </a></li>
				<li><a href="#"><img src="<?php echo $base; ?>images/images/setting.png" /><span>Settings</span> </a></li>
				<li><a href="#"><img src="<?php echo $base; ?>images/images/bulb_icon.png" /><span>Supports</span></a></li>
            </ul>
		</div>
	</div>
	<div class="body">
		<div class="big_width margin_delta">
			<div class="counsel_bg">
			<div class="float_l span3 margin_delta">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Source country: </label>
					<div class="controls-input-data">
					<input type="text" class="large" id="input01">
					</div>
				</div>
			</div>
			<div class="float_l span3">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Source city: </label>
					<div class="controls-input-data">
					<input type="text" class="large" id="input01">
					</div>
				</div>
			</div>
			<div class="float_l span3">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Leads: </label>
					<div class="controls-input-data">
					<input type="text" class="large" id="input01">
					</div>
				</div>
			</div>
			<div class="float_l span3">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Next action: </label>
					<div class="controls-input-data">
					<input type="text" class="large" id="input01">
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="bottom_line"></div>
			<div class="float_l span3 margin_delta">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Source: </label>
					<div class="controls-input-data">
					<input type="text" class="large" id="input01">
					</div>
				</div>
			</div>
			<div class="float_l span3">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Phone no: </label>
					<div class="controls-input-data">
					<input type="checkbox" class="checkbox_set">
					</div>
				</div>
			</div>
			<div class="float_l span3">
				<div class="control-group">
					<label class="label-control-data blue" for="input01"> Email address: </label>
					<div class="controls-input-data">
					<input type="checkbox" class="checkbox_set">
					</div>
				</div>
			</div>
			<div class="float_r">
				<div class="control-group">
					<button type="button" class="search_btn">
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="bottom_line"></div>
		</div>
		<div class="margin_t">
			<div class="span1 float_l">
				<b>Sr.no</b>
			</div>
			<div class="span14 float_l">
				<b class="blue">FullName</b>
			</div>
			<div class="span14 float_l">
				<b class="green">Email</b>
			</div>
			<div class="span14 float_l">
				<b class="blue">Source</b>
			</div>
			<div class="span14 float_l">
				<b class="green">Phone</b>
			</div>
			<div class="clearfix"></div>
			<div class="dotted_line"></div>
		<div id="data_data1" class="old_data">
			<div class="span1 float_l">
					1
			</div>
			<div class="span14 float_l">
				Shweta
			</div>
			<div class="span14 float_l">
				s@gmail.com
			</div>
			<div class="span14 float_l">
				Source
			</div>
			<div class="span14 float_l">
				9810989789
			</div>
			<div class="clearfix"></div>
		</div>
		<div id="data_data1" class="old_data1">
			<div class="span1 float_l">
					2
			</div>
			<div class="span14 float_l">
				Shweta
			</div>
			<div class="span14 float_l">
				shwetabhatiya@gmail.com
			</div>
			<div class="span14 float_l">
				Source
			</div>
			<div class="span14 float_l">
				9810989789
			</div>
			<div class="clearfix"></div>
		</div>
		<div id="data_data1" class="old_data">
			<div class="span1 float_l">
					3
			</div>
			<div class="span14 float_l">
				Anusha
			</div>
			<div class="span14 float_l">
				s@gmail.com
			</div>
			<div class="span14 float_l">
				Source
			</div>
			<div class="span14 float_l">
				9810989789
			</div>
			<div class="clearfix"></div>
		</div><div id="data_data1" class="old_data1">
			<div class="span1 float_l">
					4
			</div>
			<div class="span14 float_l">
				Reema
			</div>
			<div class="span14 float_l">
				s@gmail.com
			</div>
			<div class="span14 float_l">
				Source
			</div>
			<div class="span14 float_l">
				9810989789
			</div>
			<div class="clearfix"></div>
		</div>
		</div>
	</div>
	
</body>
</html>
