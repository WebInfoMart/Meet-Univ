
	
	<div id="sidebar">
	
		<ul id="nav">
			<li><a href="#"><strong><img src="<?php echo "$base$admin_img" ?>/nav/dashboard.png" alt="" /> Dashboard</strong></a></li>
			<li><a href="#"><img src="<?php echo "$base$admin_img" ?>/nav/pages.png" alt="" /> Pages</a></li>
		<!--	<li><a href="#" class="collapse"><img src="<?php echo "$base$admin_img" ?>/nav/media.png" alt="" /> Media</a>
				<ul>
					<li><a href="#">Photos</a></li>
					<li><a href="#">Video</a></li>
					<li><a href="#">Audio</a></li>
				</ul>
			</li>
			<li><a href="#"><img src="<?php echo "$base$admin_img" ?>/nav/calendar.png" alt="" /> Calendar</a></li>
		-->	
			<li><a href="#"><img src="<?php echo "$base$admin_img" ?>/nav/users.png" alt="" /> Users</a>
				<ul>
					<li><?php echo anchor('admin/adduser', 'Add new User'); ?></li>
					<li><?php echo anchor('admin/manageusers', 'Manage User'); ?></li>
					<li><a href="#">User groups</a></li>
				</ul>
			</li>
			<li><a href="#"><img src="<?php echo "$base$admin_img" ?>/nav/settings.png" alt="" /> Settings</a></li>
			<li><a href="#"><span>12</span> <img src="<?php echo "$base$admin_img" ?>/nav/support.png" alt="" /> Support</a></li>
		</ul>
		
		
		<div class="status_box">
			<ul>
				<li><a href="#" class="online" title="Online">Web server 1</a></li>
				<li><a href="#" class="online" title="Online">Web server 2</a></li>
				<li><a href="#" class="warning" title="Warning">DB server</a></li>
				<li><a href="#" class="offline" title="Offline">Mail server</a></li>
			</ul>
		</div>
		
	</div>		<!-- #sidebar ends -->
	
	
	