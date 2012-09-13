
<?php
$facebook = new Facebook();
$user = $facebook->getUser();
$this->load->model('users');
if ($user) {
//$logoutUrl2 = $this->tank_auth->logout();
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me'); 
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}
if($user)
{
if(!empty($user_profile['location']['name']))
{
$fb_user_country_city = explode(",",$user_profile['location']['name']);
$city_fb_user = trim($fb_user_country_city[0]);

$country_fb_user = trim($fb_user_country_city[1]);
}
else{
$city_fb_user = " ";
$country_fb_user = " ";
}

$fetch_country_result = $this->users->fetch_country_id($country_fb_user);

$fetch_city_result = $this->users->fetch_city_id($city_fb_user);

//$country = $fetch_country_result['country']['country_id'];

//$city = $fetch_city_result['city']['city_id'];

$update_fb_profile = array(
'country_id' => $fetch_country_result,
'city_id' => $fetch_city_result,
'full_name' => $user_profile['name'] 
);
$update['facebook'] = $this->users->update_facebook_profile($update_fb_profile);
}
//print_r($this->session->userdata);
?>
<body>
<!-- Load Pop-up for pic upload -->
<?php //echo $fb_user = $facebook->getUser(); ?>

<?php if($profile_pic['curr_educ_level'] == '0' || $profile_pic['prog_parent_id'] == '0' || $profile_pic['country_id'] == '0') { ?>
<script>
$(window).load(function(){
    $('#myModal').modal({
        keyboard: false
    })
});
</script>

<?php
$select_male='';
$select_female='';
if($fetch_profile['gender'] != '' || $fetch_profile['gender']=0)
{
if($fetch_profile['gender'] == 'male')
{
	$select_male = 'checked';
}
else if($fetch_profile['gender'] == 'female')
{
	$select_female = 'checked';
}
else{
$select_male='';
$select_female='';
}
}
?>



<div id="myModal" class="model_back modal hide fade">
	<div class="modal-header no_border model_heading">
		<a class="close" data-dismiss="modal">x</a>
		<h3>Your Profile Information</h3>
	</div>
	<div class="modal-body model_body_height">
		<form method="post" action="<?php echo $base; ?>home" enctype="multipart/form-data">
			<div>
				<div class="float_l span2 margin_zero">
				
				<?php
							if(file_exists(getcwd().'/uploads/user_pic/'.$profile_pic['user_pic_path']) && $profile_pic['user_pic_path']!='')
							{
								echo "<img style='max-height:100px;' src='".base_url()."uploads/user_pic/".$profile_pic['user_pic_path']."'/>";
							}
							
							else if(file_exists(getcwd().'/uploads/user_pic/thumbs/'.$profile_pic['user_thumb_pic_path']) && $profile_pic['user_thumb_pic_path']!='' )
							{
							//echo $image_thumb = $profile_pic['user_pic_path'].'_thumb';
							
								echo "<img style='max-height:100px;' src='".base_url()."uploads/user_pic/thumbs/".$profile_pic['user_thumb_pic_path']."'/>";
							}
							
							else if($user)
							{
							?>
								<img style='max-height:100px;' src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=large">
							<?php
							}
							else{
							echo "<img style='max-height:100px;' src='".base_url()."images/profile_icon.png'/>";
							}
							?>
				</div>
				<div class="float_l span3 margin_l12 margin_t50"><h4>Upload Your Picture</h4><div class="span2 margin_zero"><input type="file" name="userfile" /><br />
			</div>
			</div>
				<div class="clearfix"></div>
			</div>
			<div id="show_img_bar" class="img_bar_profile_modal">
			<img src="<?php echo "$base$img_path" ?>/ajax-loader.gif"/>
			</div>
			<span style="color:red"> 
				<?php
				if($this->session->flashdata('upload_pic_error')!='')
				{
					echo $this->session->flashdata('upload_pic_error');
				}
				?>
			</span>
			<div class="margin_t">
				<div class="float_l span2 margin_zero"><h4>Gender</h4></div>
				<div class="float_l span3 margin_l12"><input type="radio" name="sex" value="male" <?php echo $select_male; ?> /> Male
					<input type="radio" name="sex" value="female" <?php echo $select_female; ?> /> Female</div>
				<div class="clearfix"></div>
			</div>
			<div class="margin_t">
				<div class="float_l span2 margin_zero"><h4>Current Educational level</h4></div>
				<div class="float_l span3">
				<div class="controls">
					<!--<input type="text" class="input-medium" id="input01">-->
					<?php $curent_quali = $fetch_profile['curr_educ_level']; ?>
					<select name="educ_level">
					<option value="">Select</option>
					<?php
									foreach($educ_level as $level)
									{
									if($level['prog_edu_lvl_id'] == $curent_quali) { $selected ='selected';} else { $selected =''; }
									?>
									<option value="<?php echo $level['prog_edu_lvl_id']; ?>" <?php echo $selected; ?> > <?php echo $level['educ_level']; ?>  </option>
									<?php } ?>
					</select>
				</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="margin_t">
				<div class="float_l span2 margin_zero"><h4>Area of Interest</h4></div>
				<div class="float_l span3 margin_l12">
					<div class="controls">
					<?php $intrest_area_profile = $fetch_profile['prog_parent_id']; ?>
					<select name="area_interest">
					<option value="0">Select</option>
					<?php foreach($area_interest as $interest) 
						{
						if($interest['prog_parent_id'] == $intrest_area_profile) { $selected ='selected';} else { $selected =''; }
					?>
					<option value="<?php echo $interest['prog_parent_id']; ?>" <?php echo $selected; ?>><?php echo $interest['program_parent_name']; ?></option>
										
					<?php } ?>
					</select>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="margin_t">
				<div class="float_l span2 margin_zero"><h4>Country</h4></div>
				<div class="float_l span3 margin_l12">
					<div class="controls">
					<?php $user_selected_country = $fetch_profile['country_id']; 
						$selected ='';
						?>
					<select name="countries">
					<option value="">Select</option>
					<?php
										//print_r($country);
										foreach($country as $countries)
										{
										if($countries['country_id'] == $user_selected_country) { $selected ='selected';} else { $selected =''; }
									?>
										<option value="<?php echo $countries['country_id'] ;?>" <?php echo $selected; ?>><?php echo $countries['country_name']; ?></option>
										
										<?php } ?>
					</select>
						</div>
				</div>
					<div class="clearfix"></div>
			</div>
			
			<div class="margin_t">
				<div class="controls">
					<input type="submit" class="btn btn-primary" name="upload" id="upload" value="Continue" >
				</div>
			</div>
		</form>
	</div>
</div>

</div>
</div>

				<!--<div id="mask"></div>-->


<?php } ?>
<!-- Start of Login Dialog -->  

<!-- Load Pop-up for pic upload End Here -->

<div class="modal" id="show_success_update_profile" style="display:none;" >
  <div class="modal-header">
    <a class="close" data-dismiss="modal"></a>
    <h3>Message For You</h3>
  </div>
  <div class="modal-body">
    <p><center><h4>Your Profile has been updated.....</h4></center></p>
  </div>
  <div class="modal-footer">
    <!--<a href="#" class="btn">Close</a>-->
    <!--<a href="#" class="btn btn-primary">Save changes</a>-->
  </div>
</div>



	<div>
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body_container">
			<div class="row">
				<div class="margin_zero span16">
					<!--<div class="alert alert-message message" data-alert="alert">
								<a class="close" data-dismiss="alert">&times;</a>
								<div>
									<div class="float_l"><h2>Welcome! Let&#8217;s get started by</h2></div>
									<div class="float_r close_cont"> <span> Don't want our help? </span> Close Tips </div>
									<div class="clearfix"></div>
								</div>
								<nav id="help-tools">
									<ul>
										<li class="text_dec">1) Step 1</li>
										<li><a href="#">2) Step 2</a></li>
										<li><a href="#">3) Step 3</a></li>
										<li><a href="#">4) Step 4</a></li>
									</ul>
								</nav>
					</div>
					-->
					<?php $this->load->view('user/profile-sidebar.php'); ?>
					<div class="span13 float_r">
						<div class="span10 margin_zero">
						<!--	<div class="search_box_profile">
								<span class="">My Country</span>
								<input type="text" class="input_xxx-large search-query">
								<button class="btn btn-success margin_l21" href="#">Search</button>
							</div>
						-->	
							<div class="events_box">
								<h3>Events</h3>
								<ul>
							 <?php
							if(!empty($featured_events))
							{
							 foreach($featured_events as $featured_events_detail) { 
							$univ_domain=$featured_events_detail['subdomain_name'];
							$event_title=$featured_events_detail['event_title'];
							if($event_title=='')
							{
							$event_title='event';
							}
							$event_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'event',$event_title,$featured_events_detail['event_id']);
							 ?>							
				<li>
				<a style="color:#666;" href="<?php echo $event_link; ?>">
				<?php if($featured_events_detail['event_title']!=''){ ?>
				
				<?php echo substr($featured_events_detail['event_title'],0,100).'..'; } else { ?>
				
				<?php echo $featured_events_detail['univ_name']; } ?>
				</a>
				&nbsp; &raquo;
				<?php 
				} 
				
				} else { echo " No Upcoming Events Available... "; } ?>
									
								</ul>
							</div>
							<div class="margin_t events_box">
									<div class="margin_zero">
									<h3>News</h3>
										<ul>
				 <?php	
				 if(!empty($recent_news))
				 {
				 foreach($recent_news as $recent_news_detail) {
				$univ_domain=$recent_news_detail['subdomain_name'];
				$news_title=$recent_news_detail['news_title'];
				$news_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'news',$news_title,$recent_news_detail['news_id']);
								
				 ?>					
				<li>
				<a style="color:#666;" href="<?php echo $news_link; ?>">
				<?php echo substr($recent_news_detail['news_title'],0,100); ?> &nbsp; &raquo;
										</a>	</li>
											
					<?php } } else { echo "No News Available..."; } ?>						
										</ul>
								`	</div>
								<div class="clearfix"></div>
								</div>
								<div class="margin_t">
									<div>
										<div class="span7 float_l margin_zero green_qust12">
											<div>
												<div class="float_l">
													<div class="letter_uni">
													<div>Q Go Ask <br><span>uestion</span></div>
													</div>
												</div>
												<div class="float_r Qust_content">
													<span>Have a Question?</span>
													<span>Ask our counselors!</span>
												</div>
												<div class="clearfix"></div>
											</div>
											<div class="margin_t1">
												<div class="input-append">
													<form action="<?php echo $base; ?>QuestandAns" method="post">
														<input class="span4 margin_zero" id="appendedInput" name="quest_on_univ" size="16" type="text" placeholder="Enter Your Qusetion">
														<input type="submit" id="ask_quest" name="ask_quest" class="add-on btn-info" style="padding: 3px 18px 6px 18px;color:#fff;font-size:16px;height:28px;" value="Ask">
													</form>
												</div>
											</div>
											<div class="margin_t1">
								<h2>Latest Q&A</h2>
								<ul class="prof_data">
								<?php
								if(!empty($featured_question_profile))
								{
								$a=0;
								$url = "";
								foreach($featured_question_profile['quest_detail'] as $quest_list)
								{
								if($quest_list['q_univ_id'] != '0')
								{
									$question_title = str_replace(' ','-',$quest_list['q_title']);
									$univ_domain=$quest_list['subdomain_name'];
									$quest_title=$quest_list['q_title'];
									$que_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'question',$quest_title,$quest_list['que_id']);
									$url = $que_link;
								}
								else if($quest_list['q_country_id'] != '0')
								{
									$url = "";
								}
								else if($quest_list['q_category'] == 'general' && $quest_list['q_country_id'] == '0' && $quest_list['q_univ_id'] == '0')
								{
									$url = $base.'otherQuestion/'.$quest_list['que_id'].'/'.$quest_list['q_title'];
								}
								$q_date = explode(" ",$quest_list['q_asked_time']);
								$quest_ask_date = explode("-",$q_date[0]);
								$q_month = $quest_ask_date[1]; ?>
						
									<li>
										<div style="width: 34px;margin-right:20px" class="float_l">
										<?php
							$logged_user_id = $this->tank_auth->get_user_id();
							if(file_exists(getcwd().'/uploads/user_pic/thumbs/'.$quest_list['user_thumb_pic_path']) && $quest_list['user_thumb_pic_path']!='' )
							{
							//echo $image_thumb = $profile_pic['user_pic_path'].'_thumb';
							
								echo "<img style='height:35px;width:35px;' src='".base_url()."uploads/user_pic/thumbs/".$quest_list['user_thumb_pic_path']."'/>";
							}
							else if(file_exists(getcwd().'/uploads/user_pic/'.$quest_list['user_pic_path']) && $quest_list['user_pic_path']!='')
							{
								echo "<img style='height:35px;width:35px;' src='".base_url()."uploads/user_pic/".$quest_list['user_pic_path']."'/>";
							}
							
							else if($user && $quest_list['q_askedby'] == $logged_user_id)
							{
							?>
								<img style='height:35px;width:35px;' src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=large">
							<?php
							}
							else{
							echo "<img style='height:35px;width:35px;' src='".base_url()."images/profile_icon.png'/>";
							}
							?>
										</div>
										<a href="<?php echo $url; ?>"><div class="black height_setup"><?php echo $quest_list['q_title']?$quest_list['q_title']:''; ?></div>
										
										</a><div style="font-size: 11px;line-height: 12px;"><?php echo $quest_list['fullname']?'Asked by '.$quest_list['fullname']:'Name Not Available'; ?>
										</div>
										<div style="font-size: 11px;line-height: 12px;">
										<?php
										$q_date = explode(" ",$quest_list['q_asked_time']);
										$quest_ask_date = explode("-",$q_date[0]);
										$q_month = $quest_ask_date[1];
										$quest_month = date('M', strtotime($q_month . '01'));
										 echo $quest_ask_date[0]?$quest_ask_date[0].' ':'';
										echo $quest_month?$quest_month.', ':'';
										echo $quest_ask_date[2]?$quest_ask_date[2].' ':'';
										?></div>
									</li>
							<?php } $a++; } else { echo "No Latest Questions Available"; }
				?>
							
								</ul>
							</div>
										</div>
										
										<div class="span2 float_l margin_zero">
										
										</div>
										<div class="clearfix"></div>
											
				<?php /*if(!empty($featured_question_profile))
				{
				$a=0;
				$url = "";
				foreach($featured_question_profile['quest_detail'] as $quest_list)
				{
				if($quest_list['q_univ_id'] != '0')
				{
					$question_title = str_replace(' ','-',$quest_list['q_title']);
					$univ_domain=$quest_list['subdomain_name'];
					$quest_title=$quest_list['q_title'];
					$que_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'question',$quest_title,$quest_list['que_id']);
					$url = $que_link;
				}
				else if($quest_list['q_country_id'] != '0')
				{
					$url = "";
				}
				else if($quest_list['q_category'] == 'general' && $quest_list['q_country_id'] == '0' && $quest_list['q_univ_id'] == '0')
				{
					$url = $base.'otherQuestion/'.$quest_list['que_id'].'/'.$quest_list['q_title'];
				}
				$q_date = explode(" ",$quest_list['q_asked_time']);
				$quest_ask_date = explode("-",$q_date[0]);
				$q_month = $quest_ask_date[1];
				$quest_month = date('M', strtotime($q_month . '01'));
				
				//print_r($quest_ask_date[2]);
				?>
				

										
										<a href="<?php echo $url; ?>"><?php echo $quest_list['q_title']?$quest_list['q_title']:''; ?></a>
										<?php echo $quest_list['fullname']?'Asked by '.$quest_list['fullname']:'Name Not Available'; ?>
										<div>
										<?php echo $quest_ask_date[0]?$quest_ask_date[0].' ':'';
										echo $quest_month?$quest_month.', ':'';
										echo $quest_ask_date[2]?$quest_ask_date[2].' ':'';
										echo "Totoal Answer - ".$featured_question_profile['ans_count'][$a];
										?><
										/div>
									
									
				
				<?php
					} $a++; } else { echo "No Latest Questions Available"; } */
				?>
										
									</div>
								</div>
						</div>
						<div class="span3 float_l">
							<img src="<?php echo "$base$img_path";  ?>/banner_img.png">
						</div>
						<div class="clearfix"></div>
						<div class="margin_t">
						<?php foreach($recent_articles as $recent_articles_detail){ ?>
							<div class="grid_2 margin_zero artical_box">
								<div class="index_sidebar_box">
				<div class="artical_heading"><a href="<?php echo $base; ?>univ-<?php echo $recent_articles_detail['article_univ_id']; ?>-article-<?php echo $recent_articles_detail['article_id']; ?>"><?php echo $recent_articles_detail['article_title']; ?></a>
				</div>
										<div id="home" class="box artical_box_data">
											<div class="float_l margin_r1">
								<?php if($recent_articles_detail['article_image_path']!=""){?>
									<img src="<?php echo $base; ?>uploads/news_article_images/<?php echo $recent_articles_detail['article_image_path']; ?>" style="width:80px;height:80px;margin-right:20px">
									<?php } else if($recent_articles_detail['univ_logo_path']==''){?>
									<img src="<?php echo "$base$img_path"; ?>/default_logo.png" style="width:80px;height:80px;margin-right:20px">
									<?php } else {?>
									<img src="<?php echo $base; ?>/uploads/univ_gallery/<?php echo $news_detail['univ_logo_path']; ?>" style="width:80px;height:80px;margin-right:20px" >
									<?php } ?>
											</div>
											<div class="margin_l8">
												<?php echo substr($recent_articles_detail['article_detail'],0,420).'..'; ?>
											</div>							
										</div>
									<div class="clearfix"></div> 
								</div>
							</div>
						<?php } ?>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<div>
    <div id="pwd-change-msg" class="modal hide fade" style="display: none; ">
     <div class="modal-header ">
      <a class="close" data-dismiss="modal">x</a>
      <h3>Your Password hash been changed successfully </h3>
     </div>
    </div>
   </div> 
   
<script>
<?php if($pwd_change=='pwd_change'){ ?>
$('#pwd-change-msg').modal('toggle');
<?php } ?>

<?php if($pwd_change=='pus'){ ?>
$('#show_success_update_profile').css('display','block');
$("#show_success_update_profile").delay(2500).fadeOut(200);
<?php } ?>
</script>
<script>
$('#upload').click(function(){
$('.img_bar_profile_modal').css('display','block').css('z-index','999').css('position','absolute');
});
</script>