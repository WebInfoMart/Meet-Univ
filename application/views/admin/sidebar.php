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
		<?php 
		if($admin_user_level=='5' || $admin_user_level=='4' || $admin_user_level=='3') {
		$admin_add_op=array('4','6','8','10');
		
foreach ($admin_priv as $admin_priv_res){
if($admin_priv_res['privilege_type_id']=='6' && $admin_priv_res['privilege_level']!='0')
{
?>


<li><a href="#" class="collapse"> <img src="<?php echo "$base$admin_img" ?>/nav/qna.gif" alt="" /> Q & A</a>
		<ul><?php
		if(in_array($admin_priv_res['privilege_level'],$admin_add_op))
		{?>
		<li><?php echo anchor("$base".'admin/addevents', 'Add Que'); ?></li> <?php } ?>
			<li><?php echo anchor("$base".'admin/manageevents', 'Manage Q & A'); ?></li></ul></li>

					
			<?php
			
}	

			
			if($admin_priv_res['privilege_type_id']=='3' && $admin_priv_res['privilege_level']!='0')
			{?>
			<li><a href="#" class="collapse"><img src="<?php echo "$base$admin_img" ?>/nav/event.jpg" alt="" /> Events</a>
			<ul>
			<?php
			if(in_array($admin_priv_res['privilege_level'],$admin_add_op))
			{?>
			<li><?php echo anchor("$base".'adminevents/add_event', 'Add Events'); ?></li>
			<?php } ?>
			<li><?php echo anchor("$base".'adminevents', 'Manage Events'); ?></li></ul></li>
			<?php
			}
			
			if($admin_priv_res['privilege_type_id']=='2' && $admin_priv_res['privilege_level']!='0')
			{?>
			<li><a href="#" class="collapse"><img src="<?php echo "$base$admin_img" ?>/nav/nna.gif" alt="" /> Articles & News</a>
			<ul><?php
			if(in_array($admin_priv_res['privilege_level'],$admin_add_op))
			{?>
			<li><?php echo anchor("$base".'news_article', 'Add News & Article'); ?></li>
			<?php } ?>
			<li><?php echo anchor("$base".'admin/manageevents', 'Manage News & Article'); ?></li></ul>
			
			</li>
			<?php
			}
			if($admin_priv_res['privilege_type_id']=='1' && $admin_priv_res['privilege_level']!='0')
			{
			?>
			<li><a href="#" class="collapse"><img src="<?php echo "$base$admin_img" ?>/nav/users.png" alt="" /> Users</a>
				<ul>
		<?php
		if(in_array($admin_priv_res['privilege_level'],$admin_add_op))
		{?>
					<li><?php echo anchor("$base".'admin/adduser', 'Add new User'); ?></li>
					
		<?php }?>			
					<li><?php echo anchor("$base".'admin/manageusers', 'Manage User'); ?></li>
				
				</ul>
			</li>	
		
	<?php 
	}
	
		if($admin_priv_res['privilege_type_id']=='11' && $admin_priv_res['privilege_level']!='0' && $admin_user_level!='3')
		{
			?>
		<li><a href="#" class="collapse"><img src="<?php echo "$base$admin_img" ?>/nav/gallery.jpg" alt="" />  Manage Home Gallery</a>
		<ul>
		<?php
		if(in_array($admin_priv_res['privilege_level'],$admin_add_op))
		{?>
		<li><?php echo anchor("$base".'admin/home_gallery', 'Add Images'); ?></li>
		<?php } ?>
		<li><?php echo anchor("$base".'admin/manage_home_gallery', 'Manage Home Gallery'); ?></li>
		</ul>
		</li>
		
		<?php
		} 
		if($admin_priv_res['privilege_type_id']=='5' && $admin_priv_res['privilege_level']!='0')
			{
			?>
			
		<li><a href="#"  class="collapse"><img src="<?php echo "$base$admin_img" ?>/nav/univ.png" alt="" />  Manage University</a>
		<ul><?php
		if(in_array($admin_priv_res['privilege_level'],$admin_add_op))
		{?>
		<li><?php echo anchor("$base".'admin/create_university', 'Create University'); ?></li>
		<?php } ?>
		<li><?php echo anchor("$base".'admin/manage_university', 'Manage University'); ?></li>
		</ul>
		</li>
		
		<?php }} ?>
			<?php if($admin_user_level=='5'){ ?>
		<li><a href="#"  class="collapse"><img src="<?php echo "$base$admin_img" ?>/nav/book.jpg" alt="" /> Program/Courses</a>
		<ul>
		<li><?php echo anchor("$base".'admincourses/upload_courses', 'Add Bulk Courses'); ?></li>
		<li><?php echo anchor("$base".'admincourses/add_course', 'Add SIngle Course'); ?></li>
		<li><?php echo anchor("$base".'admincourses/manage_courses', 'Manage Course'); ?></li>
		
		</ul>
		</li>
		<?php } if($admin_user_level=='3' || $admin_user_level=='5'){  ?>
		
		<li><a href="#"  class="collapse"><img src="<?php echo "$base$admin_img" ?>/nav/book.jpg" alt="" />University/Courses</a>
		<ul>
		<li><?php echo anchor("$base".'admincourses/university_addcourse', 'Add Courses To University'); ?></li>
		<li><?php echo anchor("$base".'admincourses/manage_univ_course', 'Manage Courses'); ?></li>
		
		</ul>
		</li>
		<?php }if($admin_priv_res['privilege_type_id']=='11' && $admin_priv_res['privilege_level']!='0') {?>
		<li>
		<a href="#"  class="collapse" ><img src="<?php echo "$base$admin_img" ?>/nav/gallery.jpg" alt="" />University Gallery</a>
		<ul><?php
		if(in_array($admin_priv_res['privilege_level'],$admin_add_op))
		{?>
		<li><?php echo anchor("$base".'admin/add_univ_gallery', 'Add Images'); ?></li>
		<?php } ?>
		<li><?php echo anchor("$base".'admin/manage_univ_gallery', 'Manage Gallery'); ?></li>
		</ul>
		</li>
		<?php } ?>
		<?php
		if( $admin_user_level=='5'){
		?>
		<li>
		<a href="#"  class="collapse" ><img src="<?php echo "$base$admin_img" ?>/nav/book.jpg" alt="" />Manage Univ/Program</a>
		<ul>
		<li><?php echo anchor("$base".'admincourses/map_program_and_university', 'Area Of Intrest/Program'); ?></li>
		</ul>
		</li>
		<!--<li>
		<a href="#"  class="collapse" ><img src="<?php echo "$base$admin_img" ?>/nav/book.jpg" alt="" />Manage Progrmas</a>
		<ul>
		<li><?php echo anchor("$base".'admincourses/map_area_interest_and_progrmas', 'Area Of Intrest/Program'); ?></li>
		</ul>
		</li>-->
		<?php } ?>
		<li><a href="#"><span>12</span><img src="<?php echo "$base$admin_img" ?>/nav/settings.png" alt="" /> Settings</a></li>
			<li><a href="#"><img src="<?php echo "$base$admin_img" ?>/nav/support.png" alt="" /> Support</a></li>
			
		</ul>
		
<?php } ?>		
		<!--<div class="status_box">
			<ul>
				<li><a href="#" class="online" title="Online">Web server 1</a></li>
				<li><a href="#" class="online" title="Online">Web server 2</a></li>
				<li><a href="#" class="warning" title="Warning">DB server</a></li>
				<li><a href="#" class="offline" title="Offline">Mail server</a></li>
			</ul>
		</div>-->
		
	</div>		<!-- #sidebar ends -->
	
	
	