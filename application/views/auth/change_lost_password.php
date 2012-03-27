
	<div>
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body_container">
			<div class="row show-grid">
				<div class="span13">
					<div class="float_l span15 margin_zero sidebar">
						<div class="margin_t50 single_sidebar">
							<ul>
								<li><a href="<?php echo "$base" ?>update_profile"><div class="float_l"><img src="images/account.png" class="margin_l21"></div><div class="float_r span79 margin_zero">Account Information</div></a><div class="clearfix"></div></li>
								<li class="active_side"><div class="float_l"><img src="images/update.png" class="margin_l21"></div><div class="float_r span79 margin_zero">Update Password</div><div class="clearfix"></div></li>
								<!--<li><div class="float_l"><img src="images/key.png" class="margin_l21"></div><div class="float_r span79 margin_zero">Update E-mail</div><div class="clearfix"></div></li>-->
							</ul>
						</div>
					</div>
					<div class="float_r span111">
						<div class="row">
							<div class="span71">
								<div>
									<h2 class="profile_heading">Update Account Information</h2>
									<div class="profile_border">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec faucibus, olor sit amet, consectetur adipiscing dolor ut posuere faucibus, nibh neque sollicitudin olor sit amet, consectetur adipiscing enim, non consectetur lorem odio eu lectus.
										<div class="contact_box margin_t">
											<div class="margin_l21 margin_t1">
												<h3> Change Password</h3>
													<form class="form-horizontal form_data margin1" method="post" >
														
														<div class="control-group">
															<label class="control-label">New Password *</label>
															<div class="controls contact_box_content">
																<input type="password" value="" class="input_xxxx-large" name="new_password" id="new_password">
																<span style="color:red;"> <?php echo form_error('new_password'); ?><?php echo isset($errors['new_password'])?$errors['new_password']:''; ?></td> </span>
							
															</div>
														</div>
														<div class="control-group">
															<label class="control-label">Re-enter Password *</label>
															<div class="controls contact_box_content">
																<input type="password"  value="" class="input_xxxx-large" name="confirm_new_password" id="confirm_new_password">
																<span style="color:red;"> <?php echo form_error('confirm_new_password'); ?><?php echo isset($errors['confirm_new_password'])?$errors['confirm_new_password']:''; ?></td> </span>
							
															</div>
														</div>
													
													<div class="clearfix"></div>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="clearfix"></div>
										<div class="margin_t">
											<input type="submit" class="btn btn-primary" name="update_for_lost_psw" value="update"/>
										</div>
										</form>
									</div>
								</div>
							</div>
							<div class="span15">
									<img src="images/banner_img.png">
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	