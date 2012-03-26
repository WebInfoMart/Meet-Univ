<<<<<<< HEAD
	<div>
=======
<?php
$facebook = new Facebook(array(
  'appId'  => '358428497523493',
  'secret' => '497eb1b9decd06c794d89704f293afdd',
));
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
<div>
>>>>>>> 8eacc04f9ef4b31343a356983cf16f12c0355f69
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body_container">
			<div class="row">
				<div class="span16 margin_zero">
					<div class="float_l span3 margin_zero sidebar">
						<div class="margin_t50 single_sidebar">
							<ul>
<<<<<<< HEAD
								<li class="active_side"><div class="float_l"><img src="images/account.png" class="margin_l"></div><div class="float_l margin_l">Account Information</div><div class="clearfix"></div></li>
								<li><div class="float_l"><img src="images/update.png" class="margin_l"></div><div class="float_l margin_l">Update Password</div><div class="clearfix"></div></li>
								<li><div class="float_l"><img src="images/key.png" class="margin_l"></div><div class="float_l margin_l">Update E-mail</div><div class="clearfix"></div></li>
							</ul>
						</div>
					</div>
					<div class="float_l span13 margin_zero">
						<div class="span10 margin_zero">
							<div>
								<h2 class="profile_heading">Update Account Information</h2>
								<div class="profile_border">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec faucibus, olor sit amet, consectetur adipiscing dolor ut posuere faucibus, nibh neque sollicitudin olor sit amet, consectetur adipiscing enim, non consectetur lorem odio eu lectus.
									<div class="contact_box margin">
										<div class="margin_l margin_t">
											<h3>Personal Information <img src="<?php echo "$base$img_path";  ?>/ques_layer.png"></h3>
											<div class="form-horizontal form_data margin1">
												<div>
													<label class="control-label padding_alpha">
													<?php
													if($fetch_profile['user_pic_path'] != '')
													{
														echo "<img class='profile_img_width' src='".base_url()."uploads/".$fetch_profile['user_pic_path']."'/>";
													}
													else{
													?>
													<img class="profile_img_width" src="<?php echo "$base$img_path";  ?>/user_model.png">
													
													
													<?php } ?></label>
													<div class="controls contact_box_content">
													
														<input type="file" name="userfile" class="button_profile"/><div class="span15 margin_zero change_profile">Change your pic</div>
=======
								<li class="active_side"><div class="float_l"><img src="<?php echo "$base$img_path";  ?>/account.png" class="margin_l21"></div><div class="float_r span79 margin_zero">Account Information</div><div class="clearfix"></div></li>
								<li><a href="<?php echo "$base" ?>update_password"><div class="float_l"><img src="<?php echo "$base$img_path";  ?>/update.png" class="margin_l21"></div><div class="float_r span79 margin_zero">Update Password</div></a><div class="clearfix"></div></li>
								<!--<li><div class="float_l"><img src="<?php echo "$base$img_path";  ?>/key.png" class="margin_l21"></div><div class="float_r span79 margin_zero">Update E-mail</div><div class="clearfix"></div></li>-->
							</ul>
						</div>
					</div>
					<div class="float_r span111">
						<div class="row">
							<div class="span71">
								<form class="form-horizontal form_data" action="update_profile" method="post" enctype="multipart/form-data">
									<h2 class="profile_heading">Update Account Information</h2>
									<div class="profile_border">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec faucibus, olor sit amet, consectetur adipiscing dolor ut posuere faucibus, nibh neque sollicitudin olor sit amet, consectetur adipiscing enim, non consectetur lorem odio eu lectus.
										<div class="contact_box margin_t">
											<div class="margin_l21 margin_t1">
												<h3>Personal Information <img src="<?php echo "$base$img_path";  ?>/ques_layer.png"></h3>
													<div class="form-horizontal form_data margin1">
														<div>
															<label class="control-label padding_alpha">
															<?php
															if($fetch_profile['user_pic_path'] != '')
															{
																echo "<img class='profile_img_width' src='".base_url()."uploads/".$fetch_profile['user_pic_path']."'/>";
															}
															else if($user) { ?>
															<img src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=large">
															<?php
															}
															
															else{
															?>
															<img class="profile_img_width" src="<?php echo "$base$img_path";  ?>/user_model.png">
															
															
															<?php } ?></label>
															<div class="controls contact_box_content">
															
																<input type="file" name="userfile" class="button_profile"/><div class="span15 margin_zero change_profile">Change your pic</div>
															</div>
															<div class="clearfix"></div>
														</div>
														<div class="control-group">
															<label class="control-label">Full Name *</label>
															<div class="controls contact_box_content">
																<input type="text" class="input_xxxx-large" value="<?php echo $fetch_profile['full_name']; ?>" name="full_name" id="full_name" placeholder="Fullname">
															</div>
														</div>
														<div class="control-group">
															<div class="float_l span15 margin_zero"><h4>Gender</h4></div>
															
																<div class="float_l span2 margin_7"><input type="radio" name="sex" value="male" <?php if($fetch_profile['gender'] == "male") { echo 'checked'; } ?> /> Male
																	<input type="radio" name="sex" value="female" style="margin-left:20px;" <?php if($fetch_profile['gender'] == "female") { echo 'checked'; } ?> /> Female</div>
																<span style="color:red;"> <?php echo form_error('sex'); ?><?php echo isset($errors['sex'])?$errors['sex']:''; ?> </span>
																<div class="clearfix"></div>
														</div>
														<div class="control-group">
															<label class="control-label">Country *</label>
															<div class="controls select_button">
															<?php $user_selected_country = $fetch_profile['country_id']; 
															$selected ='';
															?>
																<select name="country">
																<?php foreach($country as $countries) {
																if($countries['country_id'] == $user_selected_country) { $selected ='selected';} else { $selected =''; }
																?>
																	<option value="<?php echo $countries['country_id'] ;?>" <?php echo $selected; ?> ><?php echo $countries['country_name']; ?></option>
																<?php } ?>
																</select>
															</div>
														</div>
														<div class="control-group">
															<label class="control-label">Birth Date *</label>
															<div class="controls contact_box_content">
															<?php
															$dob = $fetch_profile['dob'];
															$dob_explode = explode("-",$dob);
															?>
																<input type="text" class="input-small margin_all" value="<?php echo $dob_explode[0] ?>" name="year" id="year" placeholder="Year">/
																<input type="text" class="input-small margin_all" value="<?php echo $dob_explode[1] ?>" name="month" id="month" placeholder="Month">/
																<input type="text" class="input-small margin_all" value="<?php echo $dob_explode[2] ?>" name="date" id="date" placeholder="Date">
																<!--<span style="color:red;"> <?php //echo form_error('year'); ?><?php //echo isset($errors['year'])?$errors['year']:''; ?> </span>
																<span style="color:red;"> <?php //echo form_error('month'); ?><?php //echo isset($errors['month'])?$errors['month']:''; ?> </span>
																<span style="color:red;"> <?php //echo form_error('date'); ?><?php //echo isset($errors['date'])?$errors['date']:''; ?> </span>-->
															</div>
														</div>
														<div class="control-group">
															<label class="control-label">Alias *</label>
															<div class="controls contact_box_content">
																<input type="text" class="input_xxxx-large" value="<?php echo $fetch_profile['alias_name']; ?>" name="alias_name" id="alias_name" placeholder="Alias name">
															</div>
														</div>
>>>>>>> 8eacc04f9ef4b31343a356983cf16f12c0355f69
													</div>
													<div class="clearfix"></div>
												</div>
												<div class="control-group">
													<label class="control-label">Full Name *</label>
													<div class="controls contact_box_content">
														<input type="text" class="input_xxxx-large" value="<?php echo $fetch_profile['full_name']; ?>" name="full_name" id="full_name" placeholder="Fullname">
													</div>
												</div>
												<div class="control-group">
													<div class="float_l"><h4>Gender</h4></div>
														<div class="controls">
														<div class="float_l span3"><input type="radio" name="sex" value="male" <?php if($fetch_profile['gender'] == "male") { echo 'checked'; } ?> /> Male
															<input type="radio" name="sex" value="female" style="margin-left:20px;" <?php if($fetch_profile['gender'] == "female") { echo 'checked'; } ?> /> Female</div>
														<span style="color:red;"> <?php echo form_error('sex'); ?><?php echo isset($errors['sex'])?$errors['sex']:''; ?> </span>
														<div class="clearfix"></div>
														</div>
												</div>
												<div class="control-group">
													<label class="control-label">Country *</label>
													<div class="controls select_button">
													<?php $user_selected_country = $fetch_profile['country_id']; 
													$selected ='';
													?>
														<select name="country">
														<?php foreach($country as $countries) {
														if($countries['country_id'] == $user_selected_country) { $selected ='selected';} else { $selected =''; }
														?>
															<option value="<?php echo $countries['country_id'] ;?>" <?php echo $selected; ?> ><?php echo $countries['country_name']; ?></option>
														<?php } ?>
														</select>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Birth Date *</label>
													<div class="controls contact_box_content">
													<?php
													$dob = $fetch_profile['dob'];
													$dob_explode = explode("-",$dob);
													?>
														<input type="text" class="input-small margin_all" value="<?php echo $dob_explode[0] ?>" name="year" id="year" placeholder="Year">/
														<input type="text" class="input-small margin_all" value="<?php echo $dob_explode[1] ?>" name="month" id="month" placeholder="Month">/
														<input type="text" class="input-small margin_all" value="<?php echo $dob_explode[2] ?>" name="date" id="date" placeholder="Date">
														<!--<span style="color:red;"> <?php //echo form_error('year'); ?><?php //echo isset($errors['year'])?$errors['year']:''; ?> </span>
														<span style="color:red;"> <?php //echo form_error('month'); ?><?php //echo isset($errors['month'])?$errors['month']:''; ?> </span>
														<span style="color:red;"> <?php //echo form_error('date'); ?><?php //echo isset($errors['date'])?$errors['date']:''; ?> </span>-->
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Alias *</label>
													<div class="controls contact_box_content">
														<input type="text" class="input_xxxx-large" value="<?php echo $fetch_profile['alias_name']; ?>" name="alias_name" id="alias_name" placeholder="Alias name">
													</div>
												</div>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="clearfix"></div>
									<div class="margin_t">
										<button class="btn btn-primary" href="#">Update</button>
									</div>
								</div>
							</div>
						</div>
							<div class="span3">
									<img src="images/banner_img.png">
							</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	
