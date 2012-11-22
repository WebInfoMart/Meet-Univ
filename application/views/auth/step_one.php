<?php
$class_email='';
$class_agree='';
$class_firstname=''; 
//$class_lastname='';				//Commented by Satbir on 19/10/2012
$class_dob_day='';
$class_dob_year='';
$class_phone='';
$error_email = form_error('step_email');
$error_agree = form_error('step_email');
$error_firstname = form_error('first_name');
//$error_lastname = form_error('last_name');		//Commented by Satbir on 19/10/2012
$error_dob_day = form_error('dob_day');
$error_dob_year = form_error('dob_year');
$error_phone = form_error('phone');

if($error_email != '') { $class_email = 'focused_error_stepone span3'; } else { $class_email='span3'; }

if($error_agree != '') { $class_agree = 'focused_error_stepone'; } else { $class_agree=''; }

if($error_firstname != '') { $class_firstname = 'focused_error_stepone span2'; } else { $class_firstname='span2'; }

//if($error_lastname != '') { $class_lastname = 'focused_error_stepone span2'; } else { $class_lastname='span2';}		//Commented by Satbir on 19/10/2012

if($error_dob_day != '') { $class_dob_day = 'focused_error_stepone span2'; } else { $class_dob_day='span2'; }

if($error_dob_year != '') { $class_dob_year = 'focused_error_stepone span2'; } else { $class_dob_year='span2'; }

if($error_phone != '') { $class_phone = 'focused_error_stepone span2'; } else { $class_phone='span2'; }

if (isset($user_data['dob']) && ($timestamp = strtotime($user_data['dob'])) !== false)
{
  $php_date = getdate($timestamp);
  $day = date("d", $timestamp); 
  $month = date("m", $timestamp);
  $year = date("Y", $timestamp); 
 }

?>
	<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row margin_t1">
				<div class="float_l span13 margin_l">
					<div class="float_l span10 margin_zero">
						<div class="step_back round_box ">
							<div class="center handle_img step1_posit">
							</div>
							<h2>Search & Apply to 100+ Colleges & Universities</h2>
							<div class="margin_t1">
								<form class="form-horizontal form_step_box" action="" method="post" id="frm_step_one">
									<div class="control-group">
										<label class="control-label">Your Name</label>
											<div class="controls docs-input-sizes">
												<select class="span2"name="title">
													<option value="Mr" <?php if(isset($user_data['gender']) && $user_data['gender']=='male'){ echo "selected='selected'";} ?>>Mr</option>
													<option value="Mrs"> Mrs</option>
													<option value="Ms" <?php if(isset($user_data['gender']) && $user_data['gender']=='female'){ echo "selected='selected'";} ?> >Ms</option>
												</select>
												<input class="<?php echo $class_firstname; ?>" type="text" placeholder="Full Name " name="first_name" id="so_first_name" value="<?php if(isset($user_data['fullname'])){ echo $user_data['fullname'];}else{ echo set_value('first_name'); }?>">   <!--Edit by Satbir on 19/10/2012 -->
											<!-- <input class="<?php echo $class_lastname; ?>" type="text" placeholder="Last Name" name="last_name" id="so_last_name" value="<?php echo set_value('last_name') ?>"> -->  
													<span style="color:red"> <?php echo form_error('first_name'); ?><?php echo isset($errors['first_name'])?$errors['first_name']:''; ?> </span>
											<!--	<span style="color:red"> <?php echo form_error('last_name'); ?><?php echo isset($errors['last_name'])?$errors['last_name']:''; ?> </span> -->
											</div>
									</div>
									<div class="control-group">
										<label class="control-label">Your Birth Date</label>
										<div class="controls docs-input-sizes">
											<select class="span2" name="dob_month" >
															<option value="1" <?php if(isset($month) && $month==1) echo "selected='selected'";?>>January</option>
															<option value="2" <?php if(isset($month) && $month==2) echo "selected='selected'";?>>February</option>
															<option value="3" <?php if(isset($month) && $month==3) echo "selected='selected'";?>>March</option>
															<option value="4" <?php if(isset($month) && $month==4) echo "selected='selected'";?>>April</option>
															<option value="5" <?php if(isset($month) && $month==5) echo "selected='selected'";?>>May</option>
															<option value="6" <?php if(isset($month) && $month==6) echo "selected='selected'";?>>June</option>
															<option value="7" <?php if(isset($month) && $month==7) echo "selected='selected'";?>>July</option>
															<option value="8" <?php if(isset($month) && $month==8) echo "selected='selected'";?>>August</option>
															<option value="9" <?php if(isset($month) && $month==9) echo "selected='selected'";?>>September</option>
															<option value="10" <?php if(isset($month) && $month==10) echo "selected='selected'";?> >October</option>
															<option value="11" <?php if(isset($month) && $month==11) echo "selected='selected'";?>>November</option>
															<option value="12" <?php if(isset($month) && $month==12) echo "selected='selected'";?>>December</option>
											</select>
											
											<select class="<?php  echo $class_dob_day;  ?>"  name="dob_day" id="so_dob_day"  >

												<option value="" >Date</option> 
												<?php

												for($count_date=1;$count_date<=31;$count_date++)
												{
												?>
												<option value="<?php  echo $count_date; ?>" <?php if(isset($day) && $count_date == $day){ echo "selected='selected'";} ?> ><?php echo $count_date; ?></option>
												<?php } ?>
											</select>
											
											<select  name="dob_year" id="so_dob_year" class="<?php echo $class_dob_day; ?>" >
											<option value="" >Year</option> 
											<?php
											for($count_year=1920;$count_year<=2005;$count_year++)
											{ ?>
											<option  value="<?php echo $count_year; ?>" <?php if(isset($year) && $count_year==$year){ echo "selected='selected'";} ?>  ><?php echo $count_year; ?></option>
											<?php } ?>
											</select>
											
											
											
											<!--<input class="<?php echo $class_dob_day; ?>" type="text" placeholder="Day" name="dob_day" id="so_dob_day" value="<?php echo set_value('dob_day') ?>">
														<input class="<?php echo $class_dob_year; ?>" type="text" placeholder="Year" name="dob_year" id="so_dob_year" value="<?php echo set_value('dob_year') ?>">
											-->			
														
														
														
														
														<span style="color:red"> <?php echo form_error('dob_day'); ?><?php echo isset($errors['dob_day'])?$errors['dob_day']:''; ?> </span> 
													<span style="color:red"> <?php echo form_error('dob_year'); ?><?php echo isset($errors['dob_year'])?$errors['dob_year']:''; ?> </span>
											<!--<input class="span2 margin_l" type="text" placeholder="Day">
											<input class="span2 margin_l" type="text" placeholder="Year">-->
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Phone Number</label>
										<div class="controls docs-input-sizes">
											<input class="<?php echo $class_phone; ?>" type="text" name="phone" id="so_phone" value="<?php if(isset($user_data['mob_no'])){ echo $user_data['mob_no'];}else{ echo set_value('phone'); }?>">
											<select class="span2 margin_l" name="phone_type">
												<option value="Mobile">Mobile</option>
												<option selected="selected" value="Home">Home</option>
												<option value="Work">Work</option>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Your Home Country</label>
										<div class="controls docs-input-sizes">
										<select class="span3" name="home_country" id="so_country">
											<option value=""> Select </option>
												<?php
												if(!empty($show_country_having_univ))
												{
												foreach($show_country_having_univ as $show_country)
												{														
												?>
													<option value="<?php echo $show_country['country_id']; ?>" <?php if($this->input->post('home_country')==$show_country['country_id'] || isset($user_data['country_id']) && $user_data['country_id']==$show_country['country_id']){ echo "selected='selected'"; }  ?> ><?php echo ucwords($show_country['country_name']); ?></option>
												<?php
												} 
												}
												?>					
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="inlineCheckboxes">Your Email Address</label>
											<div class="controls">
												<?php
														if($this->session->userdata('current_insert_lead_email')!= '')
														{
														$lead_email = $this->session->userdata('current_insert_lead_email');
														} else { $lead_email = ''; }
														?>
															<input class="<?php echo $class_email; ?>" type="text" name="step_email" id="so_email" value="<?php if(isset($user_data['email'])){ echo $user_data['email'];}else{ echo set_value('step_email'); }?>">
															<span style="color:red"><?php echo form_error('step_email'); ?><?php echo isset($errors['step_email'])?$errors['step_email']:''; ?></span>
											</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="inlineCheckboxes"></label>
										<div class="controls">
											<label class="checkbox inline" id="label_so_iagree">
												<input type="checkbox" name="iagree" id="so_iagree" value="agree">I agree to the  <a>Service Agreement</a>  &  <a>Privacy Policy</a>
											</label>
											<span style="color:red"><?php echo form_error('iagree'); ?><?php echo isset($errors['iagree'])?$errors['iagree']:''; ?></span>
										</div>
									</div>
									<div class="controls">
										<input type="submit" value="Continue" name="process_step_one" class="btn btn-success" >
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="float_r span3">
						<a href="http://university-of-greenwich.meetuniversities.com/university_events"><img src="<?php echo "$base$img_path" ?>/banner_img.png"></a>
					
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="float_r span3">
					<a href="http://university-of-greenwich.meetuniversities.com/university_events"><img src="<?php echo "$base$img_path" ?>/banner_img.png"></a>
					
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	