<?php
$flag=1;
  if($admin_user_level=='3')
  {
  $univ_detail_edit=$this->adminmodel->fetch_univ_detail($user_id);
  if($univ_detail_edit==0)
  {
  $flag=0;
  }
  }
 if($flag==1) { ?> 
  <!-- BEGIN Left Navigation -->
  <div class="navleft">
    <div class="search">
      <form action="#">
        <input type="text" name="search" placeholder="Search here..." autocomplete="off" data-placement="top" class='tip' title="Enter search phrase">
        <button class='btn btn-icon tip' title="Search now!" data-placement="right" type='submit'><i class="icon-search"></i></button>
      </form>
    </div>
    <div class="user-profile clearfix">
      <div class="user-image">
        <img src="<?php echo $base;?>newadmin/img/profile.png" alt="">
      </div>
      <div class="user-details">
        <div class="user-username">
          <?php echo ucwords($this->session->userdata('admin_fullname')); ?>
        </div>
        <div class="user-userrole">
          Administrator
        </div>
        <div class="user-links">
          <a href="#">Account</a> | 
          <a href="edit_profile.html">Edit Profile</a>
        </div>
      </div>
    </div>   
    <ul class='mainNav'>
      <li class='active'>
        <a href="<?php echo $base; ?>admin">
          <i class="icon-home icon-white"></i>
          Dashboard
          <span class="label label-important">16</span>
        </a>
      </li>	  
	  	<?php 
		if($admin_user_level=='5' || $admin_user_level=='4' || $admin_user_level=='3') {
		$admin_add_op=array('4','6','8','10');
		
foreach ($admin_priv as $admin_priv_res){
if($admin_priv_res['privilege_type_id']=='6' && $admin_priv_res['privilege_level']!='0')
{
?>
      <li>
        <a href="#" class='toggle-subnav'>
          <i class="icon-book"></i>
         Data Management Setting
          <span class="label label-toggle"><img src="<?php echo $base;?>newadmin/img/toggle_minus.png" alt=""></span>
        </a>
        <ul class="collapsed-nav closed">
		<?php if(($admin_priv_res['privilege_type_id']=='2' || $admin_priv_res['privilege_type_id']=='6') && $admin_priv_res['privilege_level']!='0')
		{  if(in_array($admin_priv_res['privilege_level'],$admin_add_op))
			{?>
          <li>
			<a href="<?php echo $base;?>newadmin/adminarticles/manage_articles">Articles</a>
		  </li>
		  <?php } } 
		  if(($admin_priv_res['privilege_type_id']=='2' || $admin_priv_res['privilege_type_id']=='6') && $admin_priv_res['privilege_level']!='0')
			 {  
			 if(in_array($admin_priv_res['privilege_level'],$admin_add_op))
			 {?>		  
			  <li><a href="<?php echo $base;?>newadmin/admin_news/manage_news">News</a></li>
			  <?php }} 
		  if($admin_priv_res['privilege_type_id']=='6' && $admin_priv_res['privilege_level']!='0')
		   {   
			if(in_array($admin_priv_res['privilege_level'],$admin_add_op))
		   {?>		 
		   <li><a href="<?php echo $base;?>newadmin/admin_ques/manage_ques">Q & A Section</a></li>
		   <?php } }?>
        </ul>
      </li>
	  <li>
        <a href="<?php echo $base; ?>newadmin/admin_events">
          <i class="icon-calendar"></i>
         Events
        </a>
      </li>
      <li>
        <a href="#" class='toggle-subnav'>
          <i class="icon-tasks"></i>
          General Setting
          <span class="label label-toggle"><img src="<?php echo $base;?>newadmin/img/toggle_minus.png" alt=""></span>
        </a>
		<?php 
		if($admin_user_level=='3') { ?>
        <ul class="collapsed-nav closed">
          <li><a href="<?php echo $base; ?>admin/manage_univ_gallery">University Gallery</a></li>
          <li><a href="pages.html">Pages</a></li>		  
          <li><a href="<?php echo $base; ?>newadmin/admin_courses/manage_univ_course">University Courses</a></li>
          <li><?php echo anchor("$base".'admin/update_university_detail', 'Update University'); ?></li>
        </ul>
		<?php } ?>
      </li>
	   <li>
        <a href="#" class='toggle-subnav'>
          <i class=" icon-share"></i>
         Enagage
          <span class="label label-toggle"><img src="<?php echo $base;?>newadmin/img/toggle_minus.png" alt=""></span>
        </a>
        <ul class="collapsed-nav closed">
          <li><a href="promotional.html">Promotional Panel</a></li>
          <li><a href="email_pack.html">Email Plans</a></li>
		  <?php if($admin_user_level=='3')
			{ ?>
          <li><a href="<?php echo $base; ?>newadmin/engagement">Engagement Panel</a></li>
		  <?php } ?>
        </ul>
      </li>
      <li>
        <a href="stats.html">
          <i class="icon-signal"></i>
          Statistics
        </a>
      </li>
	  <?php }}} ?>
    </ul> 
    <div class="clear"></div>
  </div>
  
  <!-- End Left Navigation -->
  <?php } ?>
     <script>
$(document).ready(function(){	
	$('.collapsed-nav').css('display','none');
	var url = window.location.pathname; 	
	var activePage = url.substring(url.lastIndexOf('/')+1);
	//alert(activePage);
	$('.mainNav li a').each(function(){  
		var currentPage = this.href.substring(this.href.lastIndexOf('/')+1);
		//alert(currentPage);
		if (activePage == currentPage) {
			$('.mainNav li').removeClass('active');
			$('li').find('span').removeClass('label-white');
			$('li').find('i').removeClass('icon-white');
			$(this).parent().addClass('active'); 
			$(this).parent().find('span').addClass('label-white');
			$(this).parent().find('i').addClass('icon-white');
				$(this).parent().parent().css('display','block');
				if($(this).parent().parent().css('display','block'))
				{//alert('hello');
					$(this).parent().parent().prev().parent().addClass('active');
					$(this).parent().parent().prev().find('span img').attr('src', baseurl+'/img/toggle_minus.png');
					$(this).parent().parent().prev().find('span').addClass('label-white');
					$(this).parent().parent().prev().find('i').addClass('icon-white');
				}
			} 
		});
	});
 </script>