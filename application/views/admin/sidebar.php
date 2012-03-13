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
		<?php if($admin_user_level=='5' || $admin_user_level=='4') {
		$admin_add_op=array('4','6','8','10');
		
foreach ($admin_priv as $admin_priv_res){
if($admin_priv_res['privilege_type_id']=='1' && $admin_priv_res['privilege_level']!='0')
{?>

			<li><a href="#"><img src="<?php echo "$base$admin_img" ?>/nav/users.png" alt="" /> Users</a>
				<ul>
		<?php
		if(in_array($admin_priv_res['privilege_level'],$admin_add_op))
		{?>
					<li><?php echo anchor('admin/adduser', 'Add new User'); ?></li>
					
		<?php }?>			
					<li><?php echo anchor('admin/manageusers', 'Manage User'); ?></li>
					<li><a href="#">User groups</a></li>
				</ul>
			</li>			
			<?php
			
}	

			
			if($admin_priv_res['privilege_type_id']=='3' && $admin_priv_res['privilege_level']!='0')
			{?>
			<li><a href="#"><img src="<?php echo "$base$admin_img" ?>/nav/support.png" alt="" /> Events</a>
			<ul>
			<?php
			if(in_array($admin_priv_res['privilege_level'],$admin_add_op))
			{?>
			<li><?php echo anchor('admin/addevents', 'Add Events'); ?></li>
			<?php } ?>
			<li><?php echo anchor('admin/manageevents', 'Manage Events'); ?></li></ul></li>
			<?php
			}
			
			if($admin_priv_res['privilege_type_id']=='2' && $admin_priv_res['privilege_level']!='0')
			{?>
			<li><a href="#"><img src="<?php echo "$base$admin_img" ?>/nav/support.png" alt="" /> Articles News</a>
			<ul><?php
			if(in_array($admin_priv_res['privilege_level'],$admin_add_op))
			{?>
			<li><?php echo anchor('admin/addevents', 'Add News & Article'); ?></li>
			<?php } ?>
			<li><?php echo anchor('admin/manageevents', 'Manage News & Article'); ?></li></ul>
			
			</li>
			<?php
			}
			if($admin_priv_res['privilege_type_id']=='6' && $admin_priv_res['privilege_level']!='0')
			{
			?>
			
		<li><a href="#"> <img src="<?php echo "$base$admin_img" ?>/nav/support.png" alt="" /> Q & A</a>
		<ul><?php
		if($admin_priv_res['privilege_type_id']=='6' && $admin_priv_res['privilege_level']!='0')
			{
			?>
		<li><?php echo anchor('admin/addevents', 'Add Que'); ?></li> <?php } ?>
			<li><?php echo anchor('admin/manageevents', 'Manage Q & A'); ?></li></ul></li>
	<?php 
	}
	}?>		
			
		<li><a href="#"><span>12</span><img src="<?php echo "$base$admin_img" ?>/nav/settings.png" alt="" /> Settings</a></li>
			<li><a href="#"><img src="<?php echo "$base$admin_img" ?>/nav/support.png" alt="" /> Support</a></li>
			
		</ul>
		
<?php } ?>		
		<div class="status_box">
			<ul>
				<li><a href="#" class="online" title="Online">Web server 1</a></li>
				<li><a href="#" class="online" title="Online">Web server 2</a></li>
				<li><a href="#" class="warning" title="Warning">DB server</a></li>
				<li><a href="#" class="offline" title="Offline">Mail server</a></li>
			</ul>
		</div>
		
	</div>		<!-- #sidebar ends -->
	
	
	