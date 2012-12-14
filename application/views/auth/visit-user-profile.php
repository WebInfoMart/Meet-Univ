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
?>
<script>
	$(document).ready(function(){
	<?php if($send_message_to_user_error == 1) { ?>
	$('#myModal2').modal('toggle');
	//$('#myModal3').modal('toggle');
	<?php } ?>
	
	});
	</script>
	<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body_container">
			<div class="row margin_t1">
				<div class="margin_zero span16 margin_ts">
					<div class="span3 margin_zero float_l">
					
					<!-- send message successfully box -->
					<div class="modal" id="show_success" style="display:none;" >
					  <div class="modal-header">
						<a class="close" data-dismiss="modal"></a>
						<h3>Message For You</h3>
					  </div>
					  <div class="modal-body">
						<p><center><h4>Your Message Has been sent successfully.....</h4></center></p>
					  </div>
					  <div class="modal-footer">
						<!--<a href="#" class="btn">Close</a>-->
						<!--<a href="#" class="btn btn-primary">Save changes</a>-->
					  </div>
				</div>
					<!-- End here -->
					
					<!-- Show Error Message box -->
					<div class="modal" id="show_error" style="display:none;" >
					  <div class="modal-header">
						<a class="close" data-dismiss="modal"></a>
						<h3>Alert</h3>
					  </div>
					  <div class="modal-body">
						<p><center><h4>You Can't be follower of your own !!!</h4></center></p>
					  </div>
					  <div class="modal-footer">
						<img src="<?php echo "$base$img_path" ?>/error.png" />
					  </div>
				</div>
					<!-- End here -->
					
					
					
					
						<div class="sidebar_profic_pic">
						
						<?php 
						if(file_exists(getcwd().'/uploads/user_pic/'.$detail_visited_user['user_pic_path']) && $detail_visited_user['user_pic_path']!='')
						{
							echo "<img style='width:224px;height:224px;' src='".base_url()."uploads/user_pic/".$detail_visited_user['user_pic_path']."' class='latest_img'/>";
						}
						else if(file_exists(getcwd().'/uploads/user_pic/thumbs/'.$detail_visited_user['user_thumb_pic_path']) && $detail_visited_user['user_thumb_pic_path']!='' )
						{
						//echo $image_thumb = $profile_pic['user_pic_path'].'_thumb';
						
							echo "<img style='width:224px;height:224px;' src='".base_url()."uploads/user_pic/thumbs/".$detail_visited_user['user_thumb_pic_path']."' class='latest_img'/>";
						} 
						else{
							echo "<img class='profile_img_width' src='".base_url()."images/profile_icon.png'/>";
						}
						
						?>
							
							<h3 class="text_align">
							<?php 
							if($detail_visited_user['fullname'] != '')
							{
							echo ucwords($detail_visited_user['fullname']); 
							}
							?>
							</h3>
							<div>
								<div class="margin_all">
									<h4 class="text_align">
									<?php
									//02 Aug 2012,
										$dob = $detail_visited_user['dob'];
										$dob_explode = explode("-",$dob);
									?>
									<h4><?php 
									if($dob=='0000-00-00' || $dob=='0-0-0')
									{
									}
									else {
									if($dob_explode[2] == 00 || $dob_explode[2] == '')
									{ echo '00'.'&nbsp;';} else {
									echo $dob_explode[2].'&nbsp;';
									}
										 if($dob_explode[1] ==00) { echo '00';} 
										 else if($dob_explode[1] ==01) { echo 'Jan';} 
										 else if($dob_explode[1] ==02) { echo 'Feb';} 
										 else if($dob_explode[1] ==03) { echo 'March';} 
										 else if($dob_explode[1] ==04) { echo 'April';} 
										 else if($dob_explode[1] ==05) { echo 'May';} 
										 else if($dob_explode[1] ==06) { echo 'June';} 
										 else if($dob_explode[1] ==07) { echo 'July';} 
										 else if($dob_explode[1] ==08) { echo 'Aug';} 
										 else if($dob_explode[1] ==09) { echo 'Sept';} 
										 else if($dob_explode[1] ==10) { echo 'Oct';} 
										 else if($dob_explode[1] ==11) { echo 'Nov';} 
										 else if($dob_explode[1] ==12) { echo 'Dec';} ?>
									<?php
									if($dob_explode[0] == '0000' || $dob_explode[0] == '')
									{ echo '0000'.'&nbsp;'; } else {
									echo $dob_explode[0].',';
									}
									}
									if($detail_visited_user['gender'] != '') { echo ucwords($detail_visited_user['gender']); }
									?> </h4>
								</div>
							</div>
						</div>
						<div class="part_second">
							<div class="index_sidebar_box">
								<div class="index_sidebar_header font_sidebar">
									Current Educational Level
								</div>
								<div class="index_sidebar_content">
									<ul class="links1">
										<?php 
										if($educ_level['educ_level'] != '')
										{
										echo $educ_level['educ_level']; 
										}
										else
										{
										 echo "Not Mentioned Yet";
										}
										?>
									</ul>
								</div>
							</div>
						</div>
						<div class="part_second">
							<div class="index_sidebar_box">
								<div class="index_sidebar_header font_sidebar">
									Area of Interest
								</div>
								<div class="index_sidebar_content">
									<ul class="links1">
										<?php
										if($area_interest['program_parent_name']!='') {
										echo $area_interest['program_parent_name']; }
										else { echo "Not Mentioned Yet"; }
										?>
									</ul>
								</div>
							</div>
						</div>
						<div class="part_second">
							<div class="index_sidebar_box">
								<div class="index_sidebar_header font_sidebar">
									Colleges
								</div>
								<div class="index_sidebar_content">
									<ul class="links1">
									<?php
									if(!empty($my_collage_of_user_visited))
									{
									foreach($my_collage_of_user_visited as $my_collage)
									{
									$univ_link=$this->subdomain->generate_univ_link_by_subdomain($my_collage['subdomain_name']);
									?>
									<li><a target="_blank" href="<?php echo  $univ_link; ?>"><?php echo $my_collage['univ_name']; ?></a></li>
										<!--<li><a href="http://workforcetrack.in/update_profile">Ramjas College, University of Delhi</a></li>-->
									<?php } } else { echo "No Activity Yet."; } ?>	
									</ul>
								</div>
							</div>
						</div>
						
						
						
						<div class="part_second font_sidebar">
							<div class="index_sidebar_content invite">
								<div class="index_sidebar_header">
								<?php if($logged_user_id) { ?>
									<a style="cursor:pointer;" id="pulse2" data-toggle="modal"><span class="orange"><img src="<?php echo "$base$img_path"; ?>/mail.png"> &nbsp; Send Message</span></a>
								<?php } else {  ?>
									<a style="cursor:pointer;" id="pulse3" data-toggle="modal">
									<span class="orange"><img src="<?php echo "$base$img_path"; ?>/mail.png"> &nbsp; Send Message</span>
									</a>
								<?php } ?>	
								</div>
							</div>
							<div id="myModal2" class="model_back modal hide fade" style="display: none; ">
								<div class="modal-header no_border model_heading">
									<a class="close" data-dismiss="modal">x</a>
									<h3>Send Message</h3>
								</div>
								<div class="margin_t">
									<form class="form-horizontal" action="" method="post">
										<div class="control-group">
											<label class="control-label" for="input01">Subject</label>
											<div class="controls">
												<input type="text" class="input-xlarge" name="subject_message">
												<span style="color:red;"> <?php echo form_error('subject_message'); ?><?php echo isset($errors['subject_message'])?$errors['subject_message']:''; ?></span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="textarea">Body</label>
											<div class="controls">
												<textarea class="input-xlarge" name="message_body" rows="5"></textarea>
												<span style="color:red;"> <?php echo form_error('message_body'); ?><?php echo isset($errors['message_body'])?$errors['message_body']:''; ?></span>
											</div>
										</div>
										<div class="margin_t">
											<div class="controls">
											<input type="submit" class="btn btn-primary" name="btn_msg_send" value="Send"/>
												
												</div>
										</div>
									</form>
								</div>
							</div>
							<div id="myModal3" class="model_back modal hide fade" style="display: none; ">
								<div class="modal-header no_border model_heading">
									<a class="close" data-dismiss="modal">x</a>
									<h3>Send Message</h3>
								</div>
								<div class="margin_t">
									<h3>Please <a href="<?php echo $base; ?>login" style="color:green;">Login</a>/<a style="color:green;" href="<?php echo $base; ?>">Signup</a> for send message.</h3>
								</div>
							</div>
						</div>
					</div>
					
					
					<div class="span13 float_r">
						<div class="span10 margin_zero">
							
							<div class="span7 margin_delta">
						<div class="green_qust">
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
									<form action="<?php echo $base; ?>questandans" method="post">
										<input class="span4 margin_zero" id="appendedInput" name="quest_on_univ" size="16" type="text" placeholder="Enter Your Qusetion">
										<input type="submit" id="ask_quest" name="ask_quest" class="add-on btn-info btn_tab"  value="Ask">
									</form>
								</div>
							</div>
							<div class="margin_t1">
								<h2>Latest Q&A </h2>
								<ul class="prof_data">	
								
				<?php
								if(!empty($featured_question_visited_profile))
								{
								$a=0;
								$url = "";
								foreach($featured_question_visited_profile['quest_detail'] as $quest_list)
								{
								if($quest_list['q_univ_id'] != '0')
								{
									$univ_domain=$quest_list['subdomain_name'];
									$quest_title=$quest_list['q_title'];
									$quest_title = str_replace(' ','-',$quest_list['q_title']);									$quest_title = str_replace('[','',$quest_title);									$quest_title = str_replace(']','',$quest_title);									$quest_title = str_replace('{','',$quest_title);									$quest_title = str_replace('}','',$quest_title);									$quest_title = str_replace('(','',$quest_title);									$quest_title = str_replace(')','',$quest_title);									$quest_title = str_replace('?','',$quest_title);
									$quest_title=$this->subdomain->process_url_title($quest_title);
									$que_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'question',$quest_title,$quest_list['que_id']);
									$url = $que_link;
								}
								else if($quest_list['q_country_id'] != '0')
								{
									$url = "";
								}
								else if($quest_list['q_category'] == 'general' && $quest_list['q_country_id'] == '0' && $quest_list['q_univ_id'] == '0')
								{
									$quest_title = str_replace(' ','',$quest_list['q_title']);									$quest_title = str_replace('[','',$quest_title);									$quest_title = str_replace(']','',$quest_title);									$quest_title = str_replace('(','',$quest_title);									$quest_title = str_replace(')','',$quest_title);									$quest_title = str_replace('{','',$quest_title);									$quest_title = str_replace('}','',$quest_title);									$quest_title = str_replace('?','',$quest_title);
									$url = $base.'otherquestion/'.$quest_list['que_id'].'/'.$quest_title;
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
							?>
								<a href="<?php echo $base; ?>user/<?php echo $quest_list['id'];?>/<?php echo $quest_list['fullname'];?>"><img style='height:35px;width:35px;' src="<?php echo base_url(); ?>uploads/user_pic/thumbs/<?php echo $quest_list['user_thumb_pic_path']; ?>" title="<?php if(!empty($quest_list['fullname'])){ echo $quest_list['fullname']; } else{ echo 'No name'; } ?>"/></a>
							<?php								
							}
							else if(file_exists(getcwd().'/uploads/user_pic/'.$quest_list['user_pic_path']) && $quest_list['user_pic_path']!='')
							{ ?>
								<a href="<?php echo $base; ?>user/<?php echo $quest_list['id'];?>/<?php echo $quest_list['fullname'];?>"><img style='height:35px;width:35px;' src="<?php  echo base_url(); ?>uploads/user_pic/<?php echo $quest_list['user_pic_path']; ?>" title="<?php if(!empty($quest_list['fullname'])){ echo ucwords($quest_list['fullname']); } else{ echo 'No name'; } ?>" /></a>
							<?php
							}
							
							else if($user && $quest_list['q_askedby'] == $logged_user_id)
							{
							?>
								<a href="<?php echo $base; ?>user/<?php echo $quest_list['id'];?>/<?php echo $quest_list['fullname'];?>"><img style='height:35px;width:35px;' src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=large" title="<?php if(!empty($quest_list['fullname'])){ echo ucwords($quest_list['fullname']); } else{ echo 'No name'; } ?>" /></a>
							<?php
							}
							else							
							{ ?>
							<a href="<?php echo $base; ?>user/<?php echo $quest_list['id'];?>/<?php echo $quest_list['fullname'];?>"><img style='height:35px;width:35px;' src="<?php echo base_url();?>images/profile_icon.png" title="<?php if(!empty($quest_list['fullname'])){ echo ucwords($quest_list['fullname']); } else{ echo 'No name'; } ?>"/></a>
							<?php
							}
							?>
										</div>
										<a href="<?php echo $url; ?>"><div class="black height_setup"><?php echo $quest_list['q_title']?$quest_list['q_title']:''; ?></div>
										
										</a><div style="font-size: 11px;line-height: 12px;">
										<?php 
										$fullname =$this->subdomain->process_url_title($quest_list['fullname']);
										if($logged_user_id==$quest_list['id'])		
										{
										$user_link=$base.'home';
										}
										else
										{
										$user_link=$base.'user/'.$quest_list['id'].'/'.$fullname;
										}
										if($quest_list['fullname']!='') {
										echo 'Asked by :';
										?>
										<a href="<?php echo  $user_link;?>" target="_blank"><?php echo ucwords($quest_list['fullname']); ?></a>
										<?php }
										else
										{
										echo 'Asked by :Name Not Available'; 
										}
										 ?>
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
										echo "Total Answers - ".$featured_question_visited_profile['ans_count'][$a];
										?></div>
									</li>
							<?php $a++; } } else { echo "No Latest Questions Available"; }
				?>
								
							</ul>
							</div>
						</div>
					</div>
							<div class="margin_t">
								<div class="span6 margin_zero padding_lefty">
									<h2>Followers</h2>
										<ul class="follow">
											<li>
												<div class="float_l">
												<?php 
													if(!empty($follower_detail))
													{ ?>
													<div class="follow_img">
													<?php
													foreach($follower_detail as $followers) {
													//$link = base_url().'user/'.$followers['id'];
													$fullname =$this->subdomain->process_url_title($followers['fullname']);	
													if($logged_user_id==$followers['id'])
													{
													$user_link=$base.'home';
													}
													else {
													$user_link=$base.'user/'.$followers['id'].'/'.$fullname;
													}
													if(file_exists(getcwd().'/uploads/user_pic/thumbs/'.$followers['user_thumb_pic_path']) && $followers['user_thumb_pic_path']!='' )
													{
													//echo $image_thumb = $profile_pic['user_pic_path'].'_thumb';
													
														$user_image=base_url()."uploads/user_pic/thumbs/".$followers['user_thumb_pic_path'];
													}
													else if(file_exists(getcwd().'/uploads/user_pic/'.$followers['user_pic_path']) && $followers['user_pic_path']!='')
													{
														$user_image==base_url()."uploads/user_pic/".$followers['user_pic_path'];
													}
													else if($user && $followers['followed_by'] == $logged_user_id)
													{
													
														$user_image="https://graph.facebook.com/".$user."/picture?type=small";
													
													}
													else{
													$user_image=base_url()."images/profile_icon.png";
													}
													} 
													?>
										<a href="<?php echo $user_link;?>" target="_blank" title="<?php echo $followers['fullname']; ?>"><img class="latest_img" style="width:55px;height:55px;"  src="<?php echo $user_image; ?>"/></a>													</div>
												<?php } else 
													{
														echo "No Follower yet";
													}
													?>													
												</div>
											</li>
										</ul>
										<div class="clearfix"></div>
								</div>
							</div>
							<!-- Follow and Unfollow -->
							<form class="form-horizontal" action="" method="post">
						<div class="float_r" id="join_div">
									<?php
									if($follow_own == 0)
									{
									if($is_already_follow == 0)
									{
									?>
									<input type="submit" name="follow_now" class="btn btn-success" value="Follow!"/>
									<?php } else { ?>
									<input type="submit" name="unfollow_now" class="btn btn-success" value="Unfollow!"/>
									<?php } } ?>
									</div>
						</form>
						<!-- End Here -->
						</div>
						<div class="span3 float_l">
							<a href="http://university-of-greenwich.meetuniversities.com/university_events"><img src="<?php echo "$base$img_path" ?>/banner_img.png"></a>
						</div>
						<div class="clearfix"></div>
					</div>
					
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	
	<?php
	if($send_message_to == 1)
	{
	?>
	<script>
	$(document).ready(function(){
	$('#show_success').css('display','block');
	$("#show_success").delay(3000).fadeOut(200);
	});
	</script>
	<?php
	}
	?>
	
	
<script type="text/javascript">
$(document).ready(function(){
 $('#pulse2').click(function(){
$('#myModal2').modal('toggle');});
 });
$(document).ready(function(){
 $('#pulse3').click(function(){
// alert("hii");
$('#myModal3').modal('toggle');});
 });
</script>
	