<div id="content" class="content_msg" style="display:none;">
<div class="span8 margin_t">
  <div class="message success"><p class="info_message"></p>
</div>
  </div>
  </div>
  
<?php
$class_old_pwd='';
$class_new_pwd='';
$class_confirm_pwd='';
$error_old_pwd = form_error('current_password');
$error_new_pwd = form_error('new_password');
$error_new_pwd = form_error('confirm_new_password');

if($error_old_pwd != '') { $class_old_pwd = 'focused_error_univ'; } else { $class_old_pwd='text'; }

if($error_new_pwd != '') { $class_new_pwd = 'focused_error_univ'; } else { $class_new_pwd='text'; }
if($error_new_pwd != '') { $class_confirm_pwd = 'focused_error_univ'; } else { $class_confirm_pwd='text'; }
?>
	<div id="content">
			
		<h2 class="margin">Change Your Password</h2>
			<div class="form span8">
				<form action="" method="post" class="caption_form" enctype="multipart/form-data">
					<ul>
						<li>
							<div>
							<div class="float_l span3 margin_zero">
								<label>Old Password</label>
							</div>
							<div class="float_l span3">
								<input type="password" value="<?php echo set_value('current_password'); ?>" class="<?php echo $class_old_pwd; ?>" name="current_password" >
									<span style="color:red;"> <?php echo form_error('current_password'); ?><?php echo isset($errors['current_password'])?$errors['current_password']:''; ?></td> </span>
							
							</div>
							<div class="clearfix"></div>
						</div>
						</li>
						<li>
							<div>
							<div class="float_l span3 margin_zero">
								<label>New Password</label>
							</div>
							<div class="float_l span3">
								<input type="password" value="<?php echo set_value('new_password'); ?>"  class="<?php echo $class_new_pwd; ?>" name="new_password" >
									<span style="color:red;"> <?php echo form_error('new_password'); ?><?php echo isset($errors['new_password'])?$errors['new_password']:''; ?></td> </span>
							
							
							</div>
							<div class="clearfix"></div>
						</div>
						</li>
						<li>
							<div>
							<div class="float_l span3 margin_zero">
								<label>Re-Enter Password</label>
							</div>
							<div class="float_l span3">
		<input type="password"  value="<?php echo set_value('confirm_new_password'); ?>" class="<?php echo $class_confirm_pwd; ?>" name="confirm_new_password">
									<span style="color:red;"> <?php echo form_error('confirm_new_password'); ?><?php echo isset($errors['confirm_new_password'])?$errors['confirm_new_password']:''; ?></td> </span>
							
							</div>
							<div class="clearfix"></div>
						</div>
						</li>
					</ul>	
					<input type="submit" class="submit" name="submit" value="UPDATE">
						
				</form>
			</div>
			
				
	</div>
</script>	