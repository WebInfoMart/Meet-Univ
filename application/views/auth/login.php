<?php
/*$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);*/
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}
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

if($error_login != '') { $class_login = 'focused_error'; } else { $class_login='span4'; }

if($error_password != '') { $class_pass = 'focused_error'; } else { $class_pass='span4'; }
?>

	<div>
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body_container">
			<div class="row" style="display:"><!--LOGIN-->
				<div class="span5 round_box">
					<img src="<?php echo "$base$img_path" ?>/scholar.png" class="margin_delta float_l" />
					<h3 class="blue">Login</h3>
					<div class="notify_box">
						<a href="register" class="white">Dont have an account? Signup</a>
					</div>
					<form class="margin1" id="signup" method="post" action="">
						<div class="control-group">
							<label class="control-label" for="login">Email</label>
							<div class="controls">
								<input type="text" class="<?php echo $class_login; ?>" name="login" id="login" placeholder="Email" value="<?php echo set_value('login'); ?>">
								<span style="color:red;"> <?php echo form_error('login'); ?><?php echo isset($errors['login'])?$errors['login']:''; ?> </span>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="password">Password</label>
							<div class="controls">
								<input type="password" class="<?php echo $class_pass; ?>" name="password" id="password" placeholder="Password" value="<?php echo set_value('password'); ?>" >
								<span style="color:red;"> <?php echo form_error('password'); ?><?php echo isset($errors['password'])?$errors['password']:''; ?></td> </span>
							</div>
							<small><a href="#">Forgot your password?</a></small>
							<input type="hidden" name="user_type" id="student" value="student">
						</div>
						<button class="btn btn-primary" href="#">Login</button>
					</form>
					<span class="super">OR login with</span>

					<span id="fb_button">
							<fb:login-button   perms="email,user_checkins" id="fb_butonek" onlogin="window.location.reload(true);"></fb:login-button>
							</span>
					
					<span class="super">or</span> <img src="images/inconnect.png" />
				</div>
				<div class="row">
					<div class="span5">
						<h3>5 reasons to join Meet Universities</h3>
						<ul class="signup_benefits">
							<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
							<li>Duis pharetra eleifend sapien, id faucibus dolor rutrum et.</li>
							<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
							<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
							<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
						</ul>
					</div>
					<div class="span2 thumb_box">
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
					<div class="span7-1">
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
