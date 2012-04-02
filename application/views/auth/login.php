<?php
/*$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);*/
// if ($login_by_username AND $login_by_email) {
	// $login_label = 'Email or login';
// } else if ($login_by_username) {
	// $login_label = 'Login';
// } else {
	// $login_label = 'Email';
// }
/*$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);*/

$class_login='';
$class_pass='';
$error_login = form_error('login');
$error_password = form_error('password');

if($error_login != '') { $class_login = 'focused_error'; } else { $class_login='input-xlarge'; }

if($error_password != '') { $class_pass = 'focused_error'; } else { $class_pass='input-xlarge'; }
?>

<script>
$(document).ready(function(){
<?php if($msg == 1) { ?>
 $('#forget_model').modal('toggle');
 <?php } ?>
});
</script>
<div class="modal" id="show_success" style="display:none;" >
  <div class="modal-header">
    <a class="close" data-dismiss="modal"></a>
    <h3>Message For You</h3>
  </div>
  <div class="modal-body">
    <p><center><h4>An link has been emailed to you.....</h4></center></p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn">Close</a>
    <!--<a href="#" class="btn btn-primary">Save changes</a>-->
  </div>
</div>
<div id="forget_model" class="model_back modal hide fade" style="display: none; ">
<?php 
$class_modal_email='';
$error_modal_email = form_error('email');

if($error_modal_email != '') { $class_modal_email = 'focused_error_stepone'; } else { $class_modal_email='span3'; }
 ?>
					<div class="modal-header no_border forget_heading">
						<a class="close" data-dismiss="modal">x</a>
						<h3>Forget Password</h3>
					</div>
					<div class="forget_back">
					<div class="modal-body forget_height">
						<form class="form-horizontal" action="forgot_password" method="post">
							<fieldset>
								<div class="control-group">
									<label class="control-label" for="prependedInput">Enter Your Email</label>
									<div class="controls">
										<div class="input-prepend">
											<span class="add-on"><img src="<?php echo "$base$img_path" ?>/lock.png" class="email_forget"></span><input type="text" class="<?php echo $class_modal_email; ?>" name="email" size="16" >
											<span style="color:red;"> <?php echo form_error('email'); ?><?php echo isset($errors['email'])?$errors['email']:''; ?> </span>
										</div>
									</div>
								</div>
								<div class="controls">
									<input type="submit" value="Submit" class="btn btn-primary" name="reset_pass">
								</div>
							 </fieldset>
						</form>
					</div>
					</div>
				</div>




	<div>
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body_container">
			<div class="row" style="display:"><!--LOGIN-->
				<div class="span5 round_box margin_zero">
					<img src="<?php echo "$base$img_path" ?>/scholar.png" class="margin_delta float_l" />
					<h3 class="blue">Login</h3>
					<div class="notify_box">
						<a href="register" class="white">Dont have an account? Signup</a>
					</div>
					<form class="margin1" id="signup" method="post" action="">
						<div class="control-group">
							<label class="control-label" for="login">Email</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><img src="<?php echo "$base$img_path" ?>/at.png"></span><input class="<?php echo $class_login; ?>" name="login" id="prependedInput login" placeholder="Email" value="<?php echo set_value('login'); ?>" type="text">
										<span style="color:red;"> <?php echo form_error('login'); ?><?php echo isset($errors['login'])?$errors['login']:''; ?> </span>
									</div>
								</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="password">Password</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on"><img src="<?php echo "$base$img_path" ?>/lock.png"></span><input class="<?php echo $class_pass; ?>" name="password" id="prependedInput password" placeholder="Password" value="<?php echo set_value('password'); ?>" type="password">
									<span style="color:red;"> <?php echo form_error('password'); ?><?php echo isset($errors['password'])?$errors['password']:''; ?></td> </span>
								</div>
							</div>
							<small><a data-toggle="modal" style="cursor:pointer;" id="pulse">Forgot your password?</a></small>
							
							<input type="hidden" name="user_type" id="student" value="student">
						</div>
						<button class="btn btn-primary" href="#">Login</button>
					</form>
					<span class="super">OR login with</span>

					<span id="fb_button">
							<fb:login-button   perms="email,user_checkins" id="fb_butonek" onlogin="window.location.reload(true);"></fb:login-button>
							</span>
					
					<!--<span class="super">or</span> <img src="images/inconnect.png" />-->
				</div>
				<div class="row">
					<div class="span7">
						<h3>5 reasons to join Meet Universities</h3>
						<ul class="signup_benefits">
							<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
							<li>Duis pharetra eleifend sapien, id faucibus dolor rutrum et.</li>
							<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
							<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
							<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
						</ul>
					</div>
					<div class="span3 thumb_box">
						<h3>Newly Registered</h3>
						<img class="thumb margin_delta" src="<?php echo "$base$img_path" ?>/sumit.png" />
						<img class="thumb" src="<?php echo "$base$img_path" ?>/keshav.png" />
						<img class="thumb margin_beta" src="<?php echo "$base$img_path" ?>/keshav.png" />
						<img class="thumb margin_delta" src="<?php echo "$base$img_path" ?>/keshav.png" />
						<img class="thumb" src="<?php echo "$base$img_path" ?>/sumit.png" />
						<img class="thumb margin_beta" src="<?php echo "$base$img_path" ?>/sumit.png" />
						<img class="thumb margin_delta" src="<?php echo "$base$img_path" ?>/sumit.png" />
						<img class="thumb" src="<?php echo "$base$img_path" ?>/keshav.png" />
						<img class="thumb margin_beta" src="<?php echo "$base$img_path" ?>/sumit.png" />
					</div>
					<div class="span10">
						<h3>Upcoming Events</h3>
						<ul class="events">
							<li><img src="<?php echo "$base$img_path" ?>/bucks.png" /><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><h3>22-Feb<small>300 attending!</small></span></h3>
							<li><img src="<?php echo "$base$img_path" ?>/uds.png" /><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><h3>28-Feb<small>109 attending!</small></span></h3>
							<li><img src="<?php echo "$base$img_path" ?>/ls.png" /><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><h3>02-Mar<small>405 attending!</small></span></h3>
							<li><img src="<?php echo "$base$img_path" ?>/bucks.png" /><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><h3>19-Mar<small>67 attending!</small></span></h3>
							<li class="border_gamma"><img src="<?php echo "$base$img_path" ?>/middlesex.png" /><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><h3>07-Apr<small>191 attending!</small></span></h3>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
<?php if($email_send != 0) { ?>
$(document).ready(function(){
$('#show_success').css('display','block');
$("#show_success").delay(3000).fadeOut(200);
});
<?php } ?>
</script>