<?php
$class_email='';
$class_agree='';
$error_email = form_error('step_email');
$error_agree = form_error('step_email');

if($error_email != '') { $class_email = 'focused_error_stepone'; } else { $class_email='span3'; }

if($error_agree != '') { $class_agree = 'focused_error_stepone'; } else { $class_agree=''; }
?>
	<div>
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body_container">
			<div class="row">
				<div class="span16 margin_zero">
					<div class="alert alert-message message" data-alert="alert">
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
					<div>
						<div class="span9 margin_zero">
							<div class="step_box">
									<h1>Search & Apply to 100+ Colleges & Universities</h1>
										<div class="margin_t">
											<h2>Basic Info</h2>
											<form class="form-horizontal form_step_box" action="" method="post">
												<div class="control-group">
													<label class="control-label">Your Home Country</label>
													<div class="controls docs-input-sizes">
														<select class="span3" name="home_country">
														<option value=""> Please select </option>
														<?php
														if(!empty($show_country_having_univ))
														{
														foreach($show_country_having_univ as $show_country)
														{
														?>
															<option value="<?php echo $show_country['country_id']; ?>"><?php echo $show_country['country_name']; ?></option>
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
															<input class="<?php echo $class_email; ?>" type="text" name="step_email" value="<?php echo $lead_email; ?>">
															<span style="color:red"><?php echo form_error('step_email'); ?><?php echo isset($errors['step_email'])?$errors['step_email']:''; ?></span>
														</div>
												</div>
												<div class="control-group">
													<label class="control-label" for="inlineCheckboxes"></label>
													<div class="controls">
														<label class="checkbox inline">
															<input type="checkbox" name="iagree" id="iagree" value="agree">I agree to the  <a>Service Agreement</a>  &  <a>Privacy Policy</a>
														</label>
														<span style="color:red"><?php echo form_error('iagree'); ?><?php echo isset($errors['iagree'])?$errors['iagree']:''; ?></span>
													</div>
												</div>
												<div class="controls">
													<input type="submit" value="Continue" name="process_step_one" class="btn btn-success" >
												</div>
											</form>
										</div>
									<div class="clearfix"></div>
							</div>
						</div>
						<div class="span3 float_r">
							<img src="images/banner_img.png">
						</div>
					<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	