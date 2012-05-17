<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row margin_t1">
				<div class="float_l span13 margin_l">
<form action="" method="post">		
		
FullName<input type="text" name="event_fullname" value="<?php if(!empty($get_info_logged_user)){echo $get_info_logged_user['fullname']? $get_info_logged_user['fullname']:''; }?>"/>
<span style="color:red;"> <?php echo form_error('event_fullname'); ?> <?php echo isset($errors['event_fullname'])? $errors['event_fullname'] : ''; ?> </span>
Email<input type="text" name="event_email" value="<?php if(!empty($get_info_logged_user)){echo $get_info_logged_user['email']? $get_info_logged_user['email']:''; }?>"/>
<span style="color:red;"> <?php echo form_error('event_email'); ?> <?php echo isset($errors['event_email'])? $errors['event_email'] : ''; ?> </span>
Phone<input type="text" name="event_phone" value="<?php if(!empty($get_info_logged_user)){echo $get_info_logged_user['mob_no']? $get_info_logged_user['mob_no']:'';} ?>"/>
<span style="color:red;"> <?php echo form_error('event_phone'); ?> <?php echo isset($errors['event_phone'])?$errors['event_phone'] : ''; ?>  </span>

<input type="submit" name="submit_event_register" value="Register"/>
</form>
</div>
</div>
</div>
</div>