<?php
/*if ($use_username) {
	$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => set_value('username'),
		//'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'size'	=> 30,
	);
}
$fullname = array(
		'name'	=> 'fullname',
		'id'	=> 'fullname',
		'value' => set_value('fullname'),
		'maxlength'	=> 80,
		'size'	=> 30,
	);
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
);

$phone = array(
	'name'	=> 'phone',
	'id'	=> 'phone',
	'value'	=> set_value('phone'),
	'maxlength'	=> 80,
	'size'	=> 30,
);

$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'value' => set_value('confirm_password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);

$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);*/
?>

	<!--<div>
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">-->
			<div class="row">
				<div class="span5 round_box">
					<img src="<?php echo "$base$img_path" ?>/scholar.png" class="margin_delta float_l" />
					<div class="notify_box _float_r">
						<a href="login" class="white">Already a member? Sign in</a>
					</div>
					<h3 class="blue">Signup</h3>
					<form class="margin1" id="signup" method="post" action="">
					
						<div class="control-group">
							<label class="control-label" for="fullname">Full Name</label>
							<div class="controls">
								<input type="text" class="span4" name="fullname" id="fullname" value="<?php echo set_value('fullname') ?>"  placeholder="Full Name">
								<span style="color: red;"> <?php echo form_error('fullname'); ?><?php echo isset($errors['fullname'])?$errors['fullname']:''; ?> </span>
							</div>
						</div>
						<!--<div class="control-group">
							<label class="control-label" for="username">Username</label>
							<div class="controls">
								<input type="text" class="span4" name="username" id="username" placeholder="Username" value="<?php //echo set_value('username') ?>">
								
								<span style="color: red;"> <?php //echo form_error('username'); ?><?php// echo isset($errors['username'])?$errors['username']:''; ?> </span>
							</div>
						</div>
						-->
						<div class="control-group">
						
						<input type="hidden" value="self" name="createdby" id="createdby"/>
						<input type="hidden" value="1" name="level_user" id="level_user"/>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="email">Email</label>
							<div class="controls">
								<input type="text" class="span4" name="email" id="email" value="<?php echo set_value('email') ?>" placeholder="Email">
							    <span style="color: red;"> <?php echo form_error('email'); ?><?php echo isset($errors['email'])?$errors['email']:''; ?> </span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="password">Password</label>
							<div class="controls">
								<input type="password" name="password" id="password" class="span4" placeholder="Password" value="<?php echo set_value('password') ?>">
								<span style="color: red;"> <?php echo form_error('password'); ?> </span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="confirm_password">Confirm Password</label>
							<div class="controls">
								<input type="password" class="span4" name="confirm_password" id="confirm_password" placeholder="Confirm Password" value="<?php echo set_value('confirm_password') ?>">
								<span style="color: red;"> <?php echo form_error('confirm_password'); ?> </span>
							</div>
						</div>
						
						
											
						<div class="control-group">
							<label class="checkbox">
								<input type="checkbox" name="agree_term" id="agree_term" value="1">
								I agree to the <a href="href">terms and conditions</a> of Meet Universities.
							</label>
							<span style="color: red;"> <?php echo form_error('agree_term'); ?><?php echo isset($errors['agree_term'])?$errors['agree_term']:''; ?> </span>
						</div>
						
						<input type="hidden" name="user_type" value="student">
						<button class="btn btn-primary" href="#">Join in!</button>
					</form>
					<span class="super">OR signup with</span> 
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
							<li class="border_gamma"><img src="<?php echo "$img_path" ?>/middlesex.png" /><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><h3>07-Apr<small>191 attending!</small></span></h3>
						</ul>
					</div>
				</div>
			</div>
			<div class="row" style="display:none"><!--LOGIN-->
				<div class="span5 round_box">
					<img src="<?php echo "$base$img_path" ?>/images/scholar.png" class="margin_delta float_l" />
					<h3 class="blue">Login</h3>
					<div class="notify_box">
						<a href="#" class="white">Dont have an account? Signup</a>
					</div>
					<form class="margin1" id="signup">
						<div class="control-group">
							<label class="control-label" for="input02">Username</label>
							<div class="controls">
								<input type="text" class="span4" id="input02" placeholder="Username">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="input03">Password</label>
							<div class="controls">
								<input type="text" class="span4" id="input03" placeholder="Password">
							</div>
							<small><a href="#">Forgot your password?</a></small>
						</div>
						<button class="btn btn-primary" href="#">Login</button>
					</form>
					<span class="super">OR login with</span> <img src="<?php echo "$base$img_path" ?>/fbconnect.png" /> <span class="super">or</span> <img src="images/inconnect.png" />
				</div>
			</div>
		<!--</div>
	</div>-->
	
