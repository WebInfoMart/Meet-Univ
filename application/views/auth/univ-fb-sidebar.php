<?php
$class_name='';
$class_course='';
$class_email='';
$class_mobile='';
$error_name = form_error('apply_name');
$error_course = form_error('apply_course_interest');
$error_email = form_error('apply_email');
$error_mobile = form_error('apply_mobile');

if($error_name != '') { $class_name = 'university_side_bar'; } else { $class_name=''; }

if($error_course != '') { $class_course = 'university_side_bar'; } else { $class_course=''; }

if($error_email != '') { $class_email = 'university_side_bar'; } else { $class_email=''; }

if($error_mobile != '') { $class_mobile = 'university_side_bar'; } else { $class_mobile=''; }
?>
<div class="span4 float_r">
								<div class="college_form">
							<div>
							<h2 class="text_align">I AM INTERESTED</h2>
								<span>in studying at <?php echo ucwords($university_details['univ_name']);?></span>
								Fill details for the institute to counsel you
								<div class="margin_t text_align"> 
									 <form class="form-horizontal" action="" method="post">
										<fieldset>
											<div class="control-group">
												<input type="text" name="apply_name" class="input-medium <?php echo $class_name; ?>" placeholder="Name">
												<span style="color:red"><?php echo form_error('apply_name'); ?><?php echo isset($errors['apply_name'])?$errors['apply_name']:''; ?></span>
											</div>
											<div class="control-group">
												<select name="apply_course_interest" style="width:172px;" id="apply_course_interest" class="grid_1 box_select <?php echo $class_course; ?>">
													<option value="">Course of interest</option>
													<?php
													if(!empty($area_interest))
													{
													foreach($area_interest as $apply_interest)
													{
														echo "<option value=$apply_interest[prog_parent_id]> $apply_interest[program_parent_name] </option>";
													}
													}
													?>
												</select>
												<span style="color:red"><?php echo form_error('apply_course_interest'); ?><?php echo isset($errors['apply_course_interest'])?$errors['apply_course_interest']:''; ?></span>
											</div>
											<div class="control-group">
												<input type="text" name="apply_email" id="apply_email" class="input-medium <?php echo $class_email; ?>" placeholder="Email Id">
												<span style="color:red"><?php echo form_error('apply_email'); ?><?php echo isset($errors['apply_email'])?$errors['apply_email']:''; ?></span>
											</div>
											<div class="control-group">
												<input type="text" name="apply_mobile" class="input-medium <?php echo $class_mobile; ?>" placeholder="Mobile Number">
												<span style="color:red"><?php echo form_error('apply_mobile'); ?><?php echo isset($errors['apply_mobile'])?$errors['apply_mobile']:''; ?></span>
											</div>
											<!--<div class="control-group">
													<p class="help-block margin_alpha margin_b">Type in the characters you see below</p>
												<div class="float_l">
													<img src="<?php echo "$base$img_path" ?>/Captcha.jpg">
												</div>
												<div class="float_r margin_t">
													<input type="text" class="input_small">
												</div>
												<div class="clearfix"></div>
											</div>-->
											<div class="control-group">
												<input type="submit" name="apply_now" id="apply_now" value="Apply Now!" class="btn btn-primary"/>
											</div>
										 </fieldset>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>