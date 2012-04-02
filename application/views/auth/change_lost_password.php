<?php 
$class_pass='';
$class_cpass='';
$error_pass = form_error('new_password');
$error_cpass = form_error('confirm_new_password');

if($error_pass != '') { $class_pass = 'focused_error_lost_pass_page'; } else { $class_pass='input-xlarge'; }

if($error_pass != '') { $class_cpass = 'focused_error_lost_pass_page'; } else { $class_cpass='input-xlarge'; }
?>
	<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row offset2">
				<div class="span10 margin_t1">
					<div class="back_img">
						<h2 class="border_bot_wel">Meet Univerties</h2>
						<div class="alert alert-error margin_t">
							<strong>Fixed Misspelling</strong><br/>
							Please reset your password(make sure your caps lock is off).
						</div>
						<form class="form-horizontal" method="post">
							<div class="control-group">
								<label class="control-label" for="input01">User:</label>
								<div class="controls">
									<div class="span2 margin_zero">
									<div class="float_l" style="width:100px;">
									<?php
									if($user_detail['user_pic_path'] != '')
									{
									echo "<img src='".base_url()."uploads/".$user_detail['user_pic_path']."'/>";
									}
									else{
									?>
									<img src="<?php echo "$base$img_path" ?>/user_model.png">
									<?php } ?>
									</div>
									<div class="float_r"><span>
									<?php if($user_detail['fullname'] != '') { echo $user_detail['fullname'] ; } else { echo 'No Name'; } ?>
									</span><div class="span15 margin_zero change_profile">
									<?php if($user_detail['email'] != '') { echo $user_detail['email'] ; } else { echo 'No Email'; } ?>
									</div></div>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">Password</label>
								<div class="controls">
									<input type="password" value="" class="<?php echo $class_pass; ?>" name="new_password" id="new_password">
									<span style="color:red;"> <?php echo form_error('new_password'); ?><?php echo isset($errors['new_password'])?$errors['new_password']:''; ?></span>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">Confirm Password</label>
								<div class="controls">
									<input type="password"  value="" class="<?php echo $class_cpass; ?>" name="confirm_new_password" id="confirm_new_password">
									<span style="color:red;"> <?php echo form_error('confirm_new_password'); ?><?php echo isset($errors['confirm_new_password'])?$errors['confirm_new_password']:''; ?></span>
								</div>
							</div>
							<div class="controls">
								<input type="submit" class="btn btn-primary" name="update_for_lost_psw" value="update"/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>