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

<?php
$class_fullname='';
$class_email='';
$class_pass='';
$class_cpass='';
$class_iagree='';
$error_fullname = form_error('fullname');
$error_email = form_error('email');
$error_pass = form_error('password');
$error_cpass = form_error('confirm_password');
$error_iagree = form_error('agree_term');

if($error_fullname != '') { $class_fullname = 'focused_error'; } else { $class_fullname='input-xlarge'; }

if($error_email != '') { $class_email = 'focused_error'; } else { $class_email='input-xlarge'; }

if($error_pass != '') { $class_pass = 'focused_error'; } else { $class_pass='input-xlarge'; }

if($error_cpass != '') { $class_cpass = 'focused_error'; } else { $class_cpass='input-xlarge'; }

if($error_iagree != '') { $class_iagree = 'focused_error'; } else { $class_iagree=''; }
?>
	<div>
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body_container">
			<div class="row">
				<div class="span5 margin_zero round_box">
					<img src="<?php echo "$base$img_path" ?>/scholar.png" class="margin_delta float_l" />
					<div class="notify_box _float_r">
						<a href="login" class="white">Already a member? Sign in</a>
					</div>
					<h3 class="blue">Signup</h3>
					<form class="margin1" id="signup" method="post" action="">
					
						<div class="control-group">
							<label class="control-label" for="fullname">Full Name</label>
							<div class="controls">
								<div class="input-prepend">
										<span class="add-on"><img src="<?php echo "$base$img_path" ?>/user-male.png"></span><input class="<?php echo $class_fullname; ?>" name="fullname" id="fullname" value="<?php echo set_value('fullname') ?>"  placeholder="Full Name" type="text">
										<span style="color: red;"> <?php echo form_error('fullname'); ?><?php echo isset($errors['fullname'])?$errors['fullname']:''; ?> </span>
								</div>
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
								<div class="input-prepend">
									<span class="add-on"><img src="<?php echo "$base$img_path" ?>/at.png"></span><input class="<?php echo $class_email; ?>" name="email" id="email" value="<?php echo set_value('email') ?>"  placeholder="Email" type="text">
									 <span style="color: red;"> <?php echo form_error('email'); ?><?php echo isset($errors['email'])?$errors['email']:''; ?> </span>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="password">Password</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on"><img src="<?php echo "$base$img_path" ?>/lock.png"></span><input class="<?php echo $class_pass; ?>" name="password" id="password" placeholder="Password" value="<?php echo set_value('password') ?>" type="password">
									<span style="color: red;"> <?php echo form_error('password'); ?> </span>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="confirm_password">Confirm Password</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on"><img src="<?php echo "$base$img_path" ?>/lock.png"></span><input class="<?php echo $class_cpass; ?>" name="confirm_password" id="confirm_password" placeholder="Confirm Password" value="<?php echo set_value('confirm_password') ?>" type="password">
									<span style="color: red;"> <?php echo form_error('confirm_password'); ?> </span>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label class="checkbox <?php echo $class_iagree; ?>">
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
					<!--<span class="super">or</span> <img src="images/inconnect.png" />-->
				</div>
				<div>
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
					<div class="span4 thumb_box">
						<h3>Newly Registered</h3>
						<?php
						$x=0;
						foreach($new_users as $newly_registered){ $x++; ?>
<a href="<?php echo $base; ?>user/<?php echo $newly_registered['id'];?>"><img style="width:50px;height:51px;" class="thumb <?php if($x==1 || $x==4 || $x==7){ echo "margin_delta";} else if($x==2 || $x==5 || $x==8){ echo "margin_beta";} ?>" src="<?php if($newly_registered['user_pic_path']==''){ echo $base; ?>images/user_model.png <?php } else { echo $base; ?>uploads/<?php echo $newly_registered['user_pic_path'];} ?> " /></a>				
		
					<?php } ?>	
					</div>
					<div class="span10">
						<h3>Upcoming Events</h3>
						<ul class="events">
						<?php
						$c=0;
						foreach($featured_events as $events) { $c=$c+1; ?>
							<li <?php if($c==count($featured_events)){ echo "class='border_gamma' ";} ?>   style="cursor:pointer;"  onclick="gotoevent('<?php echo $base;?>univ-<?php echo $events['univ_id'];?>-event-<?php echo $events['event_id'];?>')">
							<img src="<?php if($events['univ_logo_path']!=''){ echo "$base";?>/uploads/univ_gallery/<?php echo $events['univ_logo_path'];} else { echo "$base$img_path";?>/default_logo.png<?php } ?>" class="events_img" >
							<span><?php echo ucwords(substr($events['event_detail'],0,176)); ?></span><h3><?php $date=explode(" ",$events['event_date_time']); echo $date[0]."-".$date[1]; ?><small>300 attending!</small></span></h3>
							</li>
						<?php } ?>	
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
		</div>
	</div>
	<script>
	function gotoevent(url)
	{
	window.location.href=url;
	//alert("hi");
	}
	</script>
