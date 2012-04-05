<script>
	$(document).ready(function(){
	<?php if($send_message_to_user_error == 1) { ?>
	$('#myModal2').modal('toggle');
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
						if($detail_visited_user['user_pic_path'] != '')
						{
						echo "<img style='width:224px;height:224px;' src='".base_url()."uploads/".$detail_visited_user['user_pic_path']."'/>"; 
						}
						?>
							
							<h3 class="text_align">
							<?php 
							if($detail_visited_user['fullname'] != '')
							{
							echo $detail_visited_user['fullname']; 
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
									if($dob_explode[0] == 0000 || $dob_explode[0] == '')
									{ echo '0000'.'&nbsp;'; } else {
									echo $dob_explode[0].',';
									}
									if($detail_visited_user['gender'] != '') { echo $detail_visited_user['gender']; }
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
										<?php echo $area_interest['program_parent_name']; ?>
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
										<li><a href="http://workforcetrack.in/update_profile">Ramjas College, University of Delhi</a></li>
										<li><a href="http://workforcetrack.in/update_password">Indian Institute of Technology Bombay</a></li>
									</ul>
								</div>
							</div>
						</div>
						
						
						
						<div class="part_second font_sidebar">
							<div class="index_sidebar_content invite">
								<div class="index_sidebar_header">
									<a style="cursor:pointer;" id="pulse2" data-toggle="modal"><span class="orange"><img src="<?php echo "$base$img_path"; ?>/mail.png"> &nbsp; Send Message</span></a>
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
						</div>
					</div>
					
					
					<div class="span13 float_r">
						<div class="span10 margin_zero">
							<div class="events_box">
								<h2>About Me</h2>
								M a simple gal wid complicated attitude...infact m like an open book but no1 can read me so easily..In short M A TOUGH GAL!!!!!!
							</div>
							<div class="margin_t">
								<div class="green_box margin_gamma padding_zero">
									<div class="padding">
										<div class="float_l">
											<div class="letter_uni">
											<div>Q Go Ask <br><span>uestion</span></div>
											</div>
										</div>
										<div class="float_r span6 margin_zero uesr_question">
											<span>4 Questions asked about </span>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="question_data">
										<span>Bcom without maths is it possible?</span></br>30 March,2011</br>
										<p>You are currently doing one of the most secure and interesting course that generally people are advised to do. MCA after B.Com sounds very unusual. As you are currently doing B com and also you didn't have maths in 12th so you would not be very good in technical maths except statistics and math is very much important in MCA.<p>Reply by HansRaj Hans</p></p>
										<span>Admission in journalism course?</span></br>30 March,2011</br>
										<p>You are currently doing one of the most secure and interesting course that generally people are advised to do. MCA after B.Com sounds very unusual. As you are currently doing B com and also you didn't have maths in 12th so you would not be very good in technical maths except statistics and math is very much important in MCA.<p>Reply by HansRaj Hans</p></p>
									</div>
								</div>
							</div>
							<div class="margin_t">
								<div class="span6 margin_zero padding_lefty">
									<h2>Followers</h2>
										<ul class="follow">
											<li>
												<div class="float_l">
													<div class="follow_img">
													<?php 
													if($follower_detail != '')
													{
													foreach($follower_detail as $followers) { ?>
														<a href="<?php echo "$base"; ?>user/<?php echo $followers['id']; ?>"><?php echo "<img style='width:63px;height:55px;' src='".base_url()."uploads/".$followers['user_pic_path']."'/>"; ?></a>
													<?php } } ?>
													</div>
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
							<img src="http://workforcetrack.in/images/banner_img.png">
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
	
	<?php
	//if($follow_own == 1)
	//{
	?>
	<script>
	// $(document).ready(function(){
	// $('#show_error').css('display','block');
	// $("#show_error").delay(3000).fadeOut(200);
	// });
	</script>
	<?php
	//}
	?>
	