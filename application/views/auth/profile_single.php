	<?php
	
$class_year_name='';
$class_month_name='';
$class_day_name='';
if(form_error('year')!='')
{
$class_year_name='focuse_red_err';
}
if(form_error('month')!='')
{
$class_month_name='focuse_red_err';
}
if(form_error('date')!='')
{
$class_day_name='focuse_red_err';

}

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
								<li class="active_side"><div class="float_l"><img src="<?php echo "$base$img_path";  ?>/user.png" class="margin_l"></div><div class="float_l margin_l text-update">Account Information</div><div class="clearfix"></div></li>
		<?php if(!$fetch_profile['fb_user']) { ?>						<li><a href="<?php echo "$base" ?>update_password"><div class="float_l"><img src="<?php echo "$base$img_path";  ?>/key.png" class="margin_l"></div><div class="float_l margin_l text-update update_info">Update Password</div></a><div class="clearfix"></div></li>
						<?php } ?>		<!--<li><div class="float_l"><img src="images/key.png" class="margin_l"></div><div class="float_l margin_l">Update E-mail</div><div class="clearfix"></div></li>-->
							</ul>
						</div>
					</div>
					<div class="float_l span13 margin_zero">
						<div class="span10 margin_zero">
							<form class="form-horizontal form_data" action="update_profile" method="post" enctype="multipart/form-data">
								<h3 class="profile_heading">Update Account Information</h3>
								<div class="profile_border">
									<span>We will not share your information without your permission.</span>
									<div class="contact_box margin1">
										<div class="margin_l margin_t">
											<h4>Personal Information<img src="<?php echo "$base$img_path";  ?>/ques_layer.png"></h4>
											<div class="margin1">
												<div>
													<label class="control-label padding_alpha">
													<?php
													if(file_exists(getcwd().'/uploads/user_pic/thumbs/'.$fetch_profile['user_thumb_pic_path']) && $fetch_profile['user_thumb_pic_path']!='' )
													{
													//echo $image_thumb = $fetch_profile['user_pic_path'].'_thumb';
													
														echo "<img src='".base_url()."uploads/user_pic/thumbs/".$fetch_profile['user_thumb_pic_path']."'/>";
													}
													else if(file_exists(getcwd().'/uploads/user_pic/'.$fetch_profile['user_pic_path']) && $fetch_profile['user_pic_path']!='')
													{
														echo "<img src='".base_url()."uploads/user_pic/".$fetch_profile['user_pic_path']."'/>";
													}
													
													else if($user)
													{
													?>
														<img src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=large">
													<?php
													}
													else{
													echo "<img src='".base_url()."images/profile_icon.png'/>";
													}		
													?></label>
													<div class="controls contact_box_content">
													
														<input type="file" name="userfile" class="button_profile"/><div class="change_profile">Change your pic</div>
													</div>
													<div class="clearfix"></div>
													<span style="color:red;">
													<?php
													if($this->session->flashdata('update_upload_pic_error')!='')
													{
														echo $this->session->flashdata('update_upload_pic_error');
													}
													?>
													</span>
												</div>
												<div class="control-group">
													<label class="control-label">Full Name *</label>
													<div class="controls contact_box_content">
														<input type="text" class="input_xxxx-large" value="<?php echo $fetch_profile['fullname']; ?>" name="full_name" id="full_name" placeholder="Fullname">
														<span style="color:red;"> <?php echo form_error('full_name'); ?><?php echo isset($errors['full_name'])?$errors['full_name']:''; ?> </span>
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
															<option value="0"> Select </option>
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
													<div class="controls controls select_button">                
													<?php
													$dob = $fetch_profile['dob'];
													$dob_explode = explode("-",$dob);
													?>
														<!--<input type="text" class="input-small margin_all" value="<?php if($dob_explode[0] == '0000' ){ echo ''; } else { echo $dob_explode[0]; } ?>" name="year" id="year" placeholder="Year">/-->
														
													
													<?php //echo $dob_explode[0]; ?>
													<select name="year" id="year" class="<?php echo $class_year_name; ?>" style="width:110px;">
													<?php
													$selected_year='';
													$selected_default_year='';
													if($class_year_name!='')
													{
													$selected_default_year='selected';
													}
													?>
														<option value="-1" <?php echo $selected_default_year; ?> >Select Year</option> 
													<?php
													$year_status=0;
													for($count_year=1980;$count_year<=2005;$count_year++)
													{
													if($selected_default_year=='') {
													if(set_value('year')==$count_year)
													{
													$selected_year='selected';
													$year_status=1;
													}
													else if($year_status==0)
													{
													$selected_year='';
													if($count_year == $dob_explode[0]) { $selected_year ='selected';} else { $selected_year =''; }
													}
													else
													{
													$selected_year='';
													}
													}
													?>
													<option  value="<?php echo $count_year; ?>" <?php echo $selected_year; ?>><?php echo $count_year; ?></option>
													<?php } ?>
													</select>
													
														<!--<input type="text" class="input-small margin_all" value="<?php if($dob_explode[1] == '00' ){ echo ''; } else { echo $dob_explode[1]; } ?>" name="month" id="month" placeholder="Month">/-->
													<?php $arr_month = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'); ?>	
														<select name="month" class="<?php echo $class_month_name; ?>" id="month" style="width:110px;">
														<?php
													$selected_month='';
													$selected_default_month='';
													if($class_month_name != '')
													{
													$selected_default_month='selected';
													}
													?>
													<option value="-1" <?php echo $selected_default_month; ?> >Select Month</option> 
											
													<?php
													$month_status=0;
													for($count_month=1;$count_month<=12;$count_month++)
													{
													if($selected_default_month =='') {
													if(set_value('month')==$count_month)
													{
													$selected_month='selected';
													$month_status=1;
													}
													else if($month_status==0)
													{
													$selected_month='';
													if($count_month == $dob_explode[1]) { $selected_month ='selected';} else { $selected_month =''; }
													}
													else
													{
													$selected_month='';
													}
													}
													?>
													<option value="<?php echo $count_month; ?>" <?php echo $selected_month; ?>><?php echo $arr_month[$count_month-1]; ?></option>
													<?php } ?>
													</select>
														
														<!--<input type="text" class="input-small margin_all" value="<?php if($dob_explode[2] == '00' ){ echo ''; } else { echo $dob_explode[2]; } ?>" name="date" id="date" placeholder="Date">-->
														<select class="<?php echo $class_day_name; ?>" name="date" id="date" style="width:110px;">
													<?php
													$selected_date='';
													$selected_default_date='';
													if($class_day_name!='')
													{
													$selected_default_date='selected';
													}
													?>
														<option value="-1" <?php echo $selected_default_date; ?> >Select Date</option> 
													<?php
													$date_status=0;
													for($count_date=1;$count_date<=31;$count_date++)
													{
													if($selected_default_date=='') {
													if(set_value('date')==$count_date)
													{
													$selected_date='selected';
													$date_status=1;
													}
													else if($date_status==0)
													{
													$selected_date='';
													if($count_date == $dob_explode[2]) { $selected_date ='selected';} else { $selected_date =''; }
													}
													else
													{
													$selected_date='';
													}
													}
													?>
													<option value="<?php echo $count_date; ?>" <?php echo $selected_date; ?>><?php echo $count_date; ?></option>
													<?php } ?>
													</select>
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
									<div class="contact_box margin1">
										<div class="margin_t margin_l">
											<h4>Contact Information</h4>
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
									<div class="contact_box margin1">
										<div class="margin_t margin_l">
											<h4>Educational Information</h4>
												<div class="margin1">
													<div class="control-group">
														<label class="control-label">Current Qualification *</label>
														<div class="controls select_button">
														<?php $curent_quali = $fetch_profile['curr_educ_level']; ?>
															<select name="curnt_quali">
															<option value="0"> Select </option>
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
															<option value="0"> Select </option>
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
									<div class="margin_t">
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
<style type="text/css">
.focuse_red_err{border:1px solid red;}
</style>