<?php
$class_fullname='';
$class_email='';
$class_level_user='';
$class_confirm_password='';
$class_password='';
$error_fullname = form_error('fullname');
$error_email = form_error('email');
$error_level_user = form_error('level_user');
$error_confirm_pwd = form_error('confirm_password');
$error_pwd = form_error('password');

if($error_fullname != '') { $class_fullname = 'focused_error'; } else { $class_fullname='text'; }

if($error_email != '') { $class_email = 'focused_error'; } else { $class_email='text'; }
if($error_level_user != '') { $class_level_user = 'focused_error'; } else { $class_level_user='text'; }
if($error_confirm_pwd != '') { $class_password = 'focused_error'; } else { $class_confirm_password='text'; }
if($error_pwd != '') { $class_confirm_password = 'focused_error'; } else { $class_pass='text'; }
?>
<div id="content">
		
		<div class="breadcrumb">
			<a href="#">Admin</a> &raquo; <a href="#">Add user</a> &raquo; <!--<a href="#">Subsection title</a> &raquo; <a href="#">Page title</a>-->
		</div>	
		<div class="span8">
			<div id="steps">
				<div class="step first active">
					<div class="num"><h3>1</h3></div>
					<div class="name"><h3>Sign Up</h3></div>
					<img src="http://apply.learnhub.com/layouts/default/images/dark_arrow.png" width="19" height="50" alt="Grey Arrow">
				</div>
				
				<div class="step first">
					<div class="num margin_l2"><h3>2</h3></div>
					<div class="name"><h3>Privileges</h3></div>
					<img src="http://apply.learnhub.com/layouts/default/images/grey_arrow.png" width="19" height="50" alt="Grey Arrow">
				</div>
			</div>
			<div class="form span7">
				<form action="" method="post">
						<div>
							<label>FULLNAME:</label><br>
							<input type="text" size="30" class="<?php echo $class_fullname; ?>"value="<?php echo set_value('fullname') ?>" name="fullname"> 
								<span style="color: red;"> <?php echo form_error('fullname'); ?><?php echo isset($errors['fullname'])?$errors['fullname']:''; ?> </span>
							
						</div> 
						<!--<div>
							<label>USERNAME:</label><br>
							<input type="text" size="30" class="text" value="<?php //echo set_value('username') ?>" name="username"> 
								<span style="color: red;"> <?php //echo form_error('username'); ?><?php// echo isset($errors['username'])?$errors['username']:''; ?> </span>
						
						</div> 
						-->
						<div><label>USER ROLL</label></br>
						<select  class="<?php echo $class_level_user; ?> styled" name="level_user" id="level_user">
							<option value="">SELECT</option>
							<option value="4">ADMIN</option>
							<option value="3">UNIVERSITY ADMIN</option>
							<option value="2">COUNSELLOR</option>
							<option value="1">STUDENT</option>	
						</select>
						<span style="color: red;"> <?php echo form_error('level_user'); ?><?php echo isset($errors['level_user'])?$errors['level_user']:''; ?> </span>
					
						</div>
						<!--	<p>
							<label>SEX:</label><br>
							<label><input type="radio" class="radio" name="demo" checked="checked"> MALE</label>
							<label><input type="radio" class="radio" name="demo"> FEMALE</label>
						</p>-->
						
						<div>
							<label>EMAIL:</label><br>
							<input type="text" size="30" id="email" name="email" value="<?php echo set_value('email') ?>"class="<?php echo $class_email; ?>">
					<span style="color: red;"> <?php echo form_error('email'); ?><?php echo isset($errors['email'])?$errors['email']:''; ?> </span>
								
						</div> 
						<div>
							<label>PASSWORD:</label><br>
							<input type="password" size="30" name="password" class="<?php echo $class_password; ?>">
						    <span style="color: red;"> <?php echo form_error('password'); ?> </span>
								
						</div> 
						<div>
							<label>CONFIRM PASSWORD:</label><br>
							<input type="password" size="30" name="confirm_password" class="<?php echo $class_confirm_password; ?>"> 
							<span style="color: red;"> <?php echo form_error('confirm_password'); ?> </span>
							
						</div> 
						<input type="hidden" name="user_type" value="admin">
						<input type="hidden" value="admin" name="createdby" id="createdby"/>
						<input type="submit" class="submit" value="STEP2">
				</form>		
			</div>
		</div>
	</div>
