<?php
$class_email='';
$class_agree='';
$class_firstname=''; 
$class_lastname='';
$class_dob_day='';
$class_dob_year='';
$class_phone='';
$error_email = form_error('step_email');
$error_agree = form_error('step_email');
$error_firstname = form_error('first_name');
$error_lastname = form_error('last_name');
$error_dob_day = form_error('dob_day');
$error_dob_year = form_error('dob_year');
$error_phone = form_error('phone');

if($error_email != '') { $class_email = 'focused_error_stepone span3'; } else { $class_email='span3'; }

if($error_agree != '') { $class_agree = 'focused_error_stepone'; } else { $class_agree=''; }

if($error_firstname != '') { $class_firstname = 'focused_error_stepone span2'; } else { $class_firstname='span2'; }

if($error_lastname != '') { $class_lastname = 'focused_error_stepone span2'; } else { $class_lastname='span2';}

if($error_dob_day != '') { $class_dob_day = 'focused_error_stepone span2'; } else { $class_dob_day='span2'; }

if($error_dob_year != '') { $class_dob_year = 'focused_error_stepone span2'; } else { $class_dob_year='span2'; }

if($error_phone != '') { $class_phone = 'focused_error_stepone span2'; } else { $class_phone='span2'; }
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
													<option value="Mr">Mr</option>
													<option value="Mrs">Mrs</option>
													<option value="Ms">Ms</option>
												</select>
												<input class="<?php echo $class_firstname; ?>" type="text" placeholder="First Name" name="first_name" id="so_first_name" value="<?php echo set_value('first_name') ?>">
													<input class="<?php echo $class_lastname; ?>" type="text" placeholder="Last Name" name="last_name" id="so_last_name" value="<?php echo set_value('last_name') ?>">
													<span style="color:red"> <?php echo form_error('first_name'); ?><?php echo isset($errors['first_name'])?$errors['first_name']:''; ?> </span>
													<span style="color:red"> <?php echo form_error('last_name'); ?><?php echo isset($errors['last_name'])?$errors['last_name']:''; ?> </span>
											</div>
									</div>
									<div class="control-group">
										<label class="control-label">Your Birth Date</label>
										<div class="controls docs-input-sizes">
											<select class="span2" name="dob_month">
															<option value="1">January</option>
															<option value="2">February</option>
															<option value="3">March</option>
															<option value="4">April</option>
															<option value="5">May</option>
															<option value="6">June</option>
															<option value="7">July</option>
															<option value="8">August</option>
															<option value="9">September</option>
															<option value="10">October</option>
															<option value="11">November</option>
															<option value="12">December</option>
											</select>
											
											<select class="<?php echo $class_dob_day; ?>"  name="dob_day" id="so_dob_day"  >

												<option value="" >Date</option> 
												<?php

												for($count_date=1;$count_date<=31;$count_date++)
												{
												?>
												<option value="<?php echo $count_date; ?>" ><?php echo $count_date; ?></option>
												<?php } ?>
											</select>
											
											<select  name="dob_year" id="so_dob_year" class="<?php echo $class_dob_day; ?>" >
											<option value="" >Year</option> 
											<?php
											for($count_year=1920;$count_year<=2005;$count_year++)
											{ ?>
											<option  value="<?php echo $count_year; ?>"><?php echo $count_year; ?></option>
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
											<input class="<?php echo $class_phone; ?>" type="text" name="phone" id="so_phone" value="<?php echo set_value('phone') ?>">
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
															<option value="<?php echo $show_country['country_id']; ?>" <?php echo ($this->input->post('home_country')==$show_country['country_id']?"selected='selected'":'') ?> ><?php echo ucwords($show_country['country_name']); ?></option>
														<?php
														} }
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
															<input class="<?php echo $class_email; ?>" type="text" name="step_email" id="so_email" value="<?php echo $lead_email; ?>" value="<?php echo set_value('step_email') ?>">
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
						<img src="<?php echo "$base$img_path" ?>/banner_img.png">
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="float_r span3">
					<img src="<?php echo "$base$img_path" ?>/banner_img.png">
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	