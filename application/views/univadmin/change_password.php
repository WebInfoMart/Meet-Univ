<?php
$class_old_pwd='';
$class_new_pwd='';
$class_confirm_pwd='';
$error_old_pwd = form_error('current_password');
$error_new_pwd = form_error('new_password');
$error_new_pwd = form_error('confirm_new_password');

if($error_old_pwd != '') { $class_old_pwd = 'needsfilled'; } else { $class_old_pwd='input-xlarge'; }

if($error_new_pwd != '') { $class_new_pwd = 'needsfilled'; } else { $class_new_pwd='input-xlarge'; }
if($error_new_pwd != '') { $class_confirm_pwd = 'needsfilled'; } else { $class_confirm_pwd='input-xlarge'; }
?>
<div class="content">
    <div class="container-fluid">
	<div class="responsible_navi"></div>
     <div class="row-fluid">
		<div class="span12">
			<div class="page-header">
				<h2>Change Password</h2>
			</div>
			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
				<fieldset>
					<div class="span6">
						<div class="control-group">
						<label class="control-label" for="input01">Old Password</label>
						<div class="controls">
							<input type="text" value="<?php echo set_value('current_password'); ?>" class="<?php echo $class_old_pwd; ?>" name="current_password">
							<span style="color:red;"> <?php echo form_error('current_password'); ?><?php echo isset($errors['current_password'])?$errors['current_password']:''; ?></td> </span>
						</div>
						</div>
						<div class="control-group">
						<label class="control-label" for="input01">New Password</label>
						<div class="controls">
							<input type="text" value="<?php echo set_value('new_password'); ?>"  class="<?php echo $class_new_pwd; ?>" name="new_password" >
							<span style="color:red;"> <?php echo form_error('new_password'); ?><?php echo isset($errors['new_password'])?$errors['new_password']:''; ?></td> </span>
						</div>
						</div>
						<div class="control-group">
						<label class="control-label" for="input01">Confirm Password</label>
						<div class="controls">
							<input type="text"  value="<?php echo set_value('confirm_new_password'); ?>" class="<?php echo $class_confirm_pwd; ?>" name="confirm_new_password">
							<span style="color:red;"> <?php echo form_error('confirm_new_password'); ?><?php echo isset($errors['confirm_new_password'])?$errors['confirm_new_password']:''; ?></td> </span>
						</div>
						</div>
						<div class="form-actions">
							<button type="submit" name="submit" class="btn btn-primary">Update</button>
							<a href="javascript:void(0);" class="btn btn-danger">Cancel</a>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
      </div>
    </div><!-- close .container-fluid -->
  </div><!-- close .content -->
  <!-- END Content -->
