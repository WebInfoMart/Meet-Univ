	<div>
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body_container">
			<div class="row">
				<div class="span16 margin_zero">
					<div class="float_l span3 margin_zero sidebar">
						<div class="margin_t50 single_sidebar">
							<ul>
								<li><div class="float_l"><a href="<?php echo "$base" ?>update_profile"><img src="<?php echo "$base$img_path";  ?>/user.png" class="margin_l"></div><div class="float_l margin_l text-update">Account Information</div></a><div class="clearfix"></div></li>
								<li class="active_side"><div class="float_l"><img src="<?php echo "$base$img_path";  ?>/key.png" class="margin_l"></div><div class="float_l margin_l text-update update_info">Update Password</div><div class="clearfix"></div></li>
								<!--<li><div class="float_l"><img src="images/key.png" class="margin_l"></div><div class="float_l margin_l">Update E-mail</div><div class="clearfix"></div></li>-->
							</ul>
						</div>
					</div>
					<div class="float_l span13 margin_zero">
						<div class="span10 margin_zero">
							<div>
								<h3 class="profile_heading">Update Password</h3>
								<div class="profile_border">
								To make your Password more secure,it contains a special character and a digit.
									<div class="contact_box margin1">
										<div class="margin_l margin_t">
											<h4> Change Password</h4>
											
									<form class="form-horizontal form_data margin1" method="post" >
													<div class="control-group">
														<label class="control-label">Current Password *</label>
														<div class="controls contact_box_content">
									<input type="password" value="<?php echo set_value('current_password'); ?>" class="input_xxxx-large" name="current_password" id="input01">
									<span style="color:red;"> <?php echo form_error('current_password'); ?><?php echo isset($errors['current_password'])?$errors['current_password']:''; ?></td> </span>
							
														</div>
													</div>
													<div class="control-group">
														<label class="control-label">New Password *</label>
														<div class="controls contact_box_content">
									<input type="password" value="<?php echo set_value('new_password'); ?>" class="input_xxxx-large" name="new_password" id="input01">
									<span style="color:red;"> <?php echo form_error('new_password'); ?><?php echo isset($errors['new_password'])?$errors['new_password']:''; ?></td> </span>
							
														</div>
													</div>
													<div class="control-group">
														<label class="control-label">Re-enter Password *</label>
														<div class="controls contact_box_content">
									<input type="password"  value="<?php echo set_value('confirm_new_password'); ?>" class="input_xxxx-large" name="confirm_new_password" id="input01">
									<span style="color:red;"> <?php echo form_error('confirm_new_password'); ?><?php echo isset($errors['confirm_new_password'])?$errors['confirm_new_password']:''; ?></td> </span>
							
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
								</form>
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
	