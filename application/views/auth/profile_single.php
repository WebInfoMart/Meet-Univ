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
	<div>
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body_container">
			<div class="row">
				<div class="span16 margin_zero">
					<div class="float_l span3 margin_zero sidebar">
						<div class="margin_t50 single_sidebar">
							<ul>
								<li class="active_side"><div class="float_l"><img src="<?php echo "$base$img_path";  ?>/account.png" class="margin_l"></div><div class="float_l margin_l">Account Information</div><div class="clearfix"></div></li>
		<?php if(!$fetch_profile['fb_user']) { ?>						<li><a href="<?php echo "$base" ?>update_password"><div class="float_l"><img src="<?php echo "$base$img_path";  ?>/update.png" class="margin_l"></div><div class="float_l margin_l">Update Password</div></a><div class="clearfix"></div></li>
						<?php } ?>		<!--<li><div class="float_l"><img src="images/key.png" class="margin_l"></div><div class="float_l margin_l">Update E-mail</div><div class="clearfix"></div></li>-->
							</ul>
						</div>
					</div>
					<div class="float_l span13 margin_zero">
						<div class="span10 margin_zero">
							<form class="form-horizontal form_data" action="update_profile" method="post" enctype="multipart/form-data">
								<h2 class="profile_heading">Update Account Information</h2>
								<div class="profile_border">
									We will not share your information without your permission.
									<div class="contact_box margin">
										<div class="margin_l margin_t">
											<h3>Personal Information <img src="<?php echo "$base$img_path";  ?>/ques_layer.png"></h3>
											<div class="margin1">
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
													
														<input type="file" name="userfile" class="button_profile"/><div class="change_profile">Change your pic</div>
													</div>
													<div class="clearfix"></div>
												</div>
												<div class="control-group">
													<label class="control-label">Full Name *</label>
													<div class="controls contact_box_content">
														<input type="text" class="input_xxxx-large" value="<?php echo $fetch_profile['fullname']; ?>" name="full_name" id="full_name" placeholder="Fullname">
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Gender *</label>
												
														<div class="controls">
														<div class="float_l span3"><input type="radio" name="sex" value="male" <?php if($fetch_profile['gender'] == "male") { echo 'checked'; } ?> /> Male
															<input type="radio" name="sex" value="female" style="margin-left:20px;" <?php if($fetch_profile['gender'] == "female") { echo 'checked'; } ?> /> Female</div>
														<span style="color:red;"> <?php echo form_error('sex'); ?><?php echo isset($errors['sex'])?$errors['sex']:''; ?> </span>
														<div class="clearfix"></div>
														</div>
												</div>
												<div class="control-group">
													<label class="control-label">Country </label>
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
													<label class="control-label">Birth Date </label>
													<div class="controls contact_box_content">                
													<?php
													$dob = $fetch_profile['dob'];
													$dob_explode = explode("-",$dob);   
													?>
														<input type="text" class="input-small margin_all" value="<?php if($dob_explode[0] == '0000' ){ echo ''; } else { echo $dob_explode[0]; } ?>" name="year" id="year" placeholder="Year">/
														<input type="text" class="input-small margin_all" value="<?php if($dob_explode[1] == '00' ){ echo ''; } else { echo $dob_explode[1]; } ?>" name="month" id="month" placeholder="Month">/
														<input type="text" class="input-small margin_all" value="<?php if($dob_explode[2] == '00' ){ echo ''; } else { echo $dob_explode[2]; } ?>" name="date" id="date" placeholder="Date">
														<!--<span style="color:red;"> <?php //echo form_error('year'); ?><?php //echo isset($errors['year'])?$errors['year']:''; ?> </span>
														<span style="color:red;"> <?php //echo form_error('month'); ?><?php //echo isset($errors['month'])?$errors['month']:''; ?> </span>
														<span style="color:red;"> <?php //echo form_error('date'); ?><?php //echo isset($errors['date'])?$errors['date']:''; ?> </span>-->
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Alias </label>
													<div class="controls contact_box_content">
														<input type="text" class="input_xxxx-large" value="<?php echo $fetch_profile['alias_name']; ?>" name="alias_name" id="alias_name" placeholder="Alias name">
													</div>
												</div>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="contact_box margin">
										<div class="margin_t margin_l">
											<h3>Contact Information</h3>
												<div class="margin1">
													<div class="control-group">
														<label class="control-label">Home Address </label>
														<div class="controls contact_box_content">
															<input type="text" class="input_xxxx-large" value="<?php echo $fetch_profile['home_address']; ?>" name="home_adrs" id="home_adrs" placeholder="Home adress">
														</div>
													</div>
													<div class="control-group">
														<label class="control-label">Mobile Number </label>
														<div class="controls contact_box_content">
															<input type="text" class="input_xxxx-large" value="<?php if($fetch_profile['mob_no'] == '0'){echo '';} else { echo $fetch_profile['mob_no']; } ?>" name="mob_no" id="mob_no" placeholder="Mobile number">
															<span style="color:red;"> <?php echo form_error('mob_no'); ?><?php echo isset($errors['mob_no'])?$errors['mob_no']:''; ?> </span>
														</div>
													</div>
													<div class="control-group">
														<label class="control-label">Alternate Email </label>
														<div class="controls contact_box_content">
															<input type="text" class="input_xxxx-large" value="<?php echo $fetch_profile['alt_email']; ?>" name="alt_email" id="alt_email" placeholder="Alt email">
															<span style="color:red;"> <?php echo form_error('alt_email'); ?><?php echo isset($errors['alt_email'])?$errors['alt_email']:''; ?> </span>
														</div>
													</div>
												</div>
										</div>
									</div>
									<div class="contact_box margin">
										<div class="margin_t margin_l">
											<h3>Educational Information</h3>
												<div class="margin1">
													<div class="control-group">
														<label class="control-label">Current Qualification *</label>
														<div class="controls select_button">
														<?php $curent_quali = $fetch_profile['curr_educ_level']; ?>
															<select name="curnt_quali">
															<?php
															foreach($educ_level as $curnt_educ)
															{
															if($curnt_educ['prog_edu_lvl_id'] == $curent_quali) { $selected ='selected';} else { $selected =''; }
															?>
																<option value="<?php echo $curnt_educ['prog_edu_lvl_id']; ?>" <?php echo $selected; ?> ><?php echo $curnt_educ['educ_level']; ?></option>
															<?php } ?>
															</select>
														</div>
													</div>
													<div class="control-group">
														<label class="control-label">Area Of Interest *</label>
														<div class="controls select_button">
														<?php $intrest_area_profile = $fetch_profile['prog_parent_id']; ?>
															<select name="area_intrst">
																<?php
															foreach($area_interest as $area)
															{
															if($area['prog_parent_id'] == $intrest_area_profile) { $selected ='selected';} else { $selected =''; }
															?>
																<option value="<?php echo $area['prog_parent_id']; ?>" <?php echo $selected; ?> > <?php echo $area['program_parent_name']; ?></option>
															<?php } ?>
															</select>
														</div>
													</div>
												</div>
										</div>
									</div>
									<div class="margin_t margin_l">
										<input type="submit" name="update" class="btn btn-primary" value="Update"/>
									</div>
								</div>
							</form>
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
	<script type="text/javascript">
    $("[rel=tooltip]").tooltip();
// </script>