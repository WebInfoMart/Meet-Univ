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
	function gotoevent(url)
	{
	window.location.href=url;
	//alert("hi");
	}
	</script>
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
				<div class="span16 margin_zero">
				<div class="span5 margin_zero">	
					<div class="round_box">
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
				</div>
				<div class="span11">
					<div class="span7 margin_zero">
						<div class="center_bar">
							<span class="float_l reason">5</span>
							<div class="margin_n">
								<h3>Reasons to join Meet Universities</h3>
								<ul class="signup_benefits">
									<li>Single largest University Event listing in the world.</li>
									<li>Meet your dream university : Offline | Online</li>
									<li>Free university information.</li>
									<li>Free Career advice from experts.</li>
									<li>One Click , dream university match engine.</li>
									<li>Guidance on visa ,immigration , education loans</li>
								</ul>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="span4 thumb_box">
						<h3>Just Joined in</h3>
						<?php
						$x=0;
						foreach($new_users as $newly_registered){ $x++; ?>
<a href="<?php echo $base; ?>user/<?php echo $newly_registered['id'];?>"><img style="width:50px;height:51px;" class="thumb <?php if($x==1 || $x==4 || $x==7){ echo "margin_delta";} else if($x==2 || $x==5 || $x==8){ echo "margin_beta";} ?>" src="<?php if($newly_registered['user_pic_path']==''){ echo $base; ?>images/user_model.png <?php } else { echo $base; ?>uploads/<?php echo $newly_registered['user_pic_path'];} ?> " /></a>				
		
					<?php } ?>	
					</div>
					<div class="span11 margin_delta margin_t">
						<h3>Upcoming Events</h3>
						<div>
							<ul class="event_new">
								<li>
									<div class="event_meth float_l">
										<h3 class="inline">University of Greenwich</h3><span class="inline"> &raquo; </span><h4 class="inline">Spot Admission</h4>
										<div class="margin_t1">
											<div class="img_style float_l img_r">
												<img src="http://workforcetrack.in/uploads/univ_gallery/uog20logo1.jpg" class="img_event"/>
											</div>
											<div><img src="http://meetuniv.com/images/city.png" class="line_img inline"><span class="blue line_time inline">British Council, New Delhi, India</span></div>
											<div><img src="http://meetuniv.com/images/clock.png" class="line_img inline"><span class="blue line_time inline">25 June, 2012</span></div>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
										</div>
									</div>
									<div class="float_r">
											<a href="#"><img src="images/call.png" title="Share" alt="Share"></a>
											<a href="#"><img src="images/sms.png" title="Send SMS" alt="Send SMS"></a>
											<a href="#"><img src="images/map.png" title="Map" alt="Map"></a>
										<div class="margin_t1 registered">		
											<h2 class="blue">15</h2>	
											<h5 class="blue">Registered</h5>
										</div>
									</div>
									<div class="clearfix"></div>
								</li>
								<li>
									<div class="event_meth float_l">
										<h3 class="inline">University of Greenwich</h3><span class="inline"> &raquo; </span><h4 class="inline">Spot Admission</h4>
										<div class="margin_t1">
											<div class="img_style float_l img_r">
												<img src="http://workforcetrack.in/uploads/univ_gallery/uog20logo1.jpg" class="img_event"/>
											</div>
											<div><img src="http://meetuniv.com/images/city.png" class="line_img inline"><span class="blue line_time inline">British Council, New Delhi, India</span></div>
											<div><img src="http://meetuniv.com/images/clock.png" class="line_img inline"><span class="blue line_time inline">25 June, 2012</span></div>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
										</div>
									</div>
									<div class="float_r">
											<a href="#"><img src="images/call.png" title="Share" alt="Share"></a>
											<a href="#"><img src="images/sms.png" title="Send SMS" alt="Send SMS"></a>
											<a href="#"><img src="images/map.png" title="Map" alt="Map"></a>
										<div class="margin_t1 registered">		
											<h2 class="blue">15</h2>	
											<h5 class="blue">Registered</h5>
										</div>
									</div>
									<div class="clearfix"></div>
								</li>
								<li>
									<div class="event_meth float_l">
										<h3 class="inline">University of Greenwich</h3><span class="inline"> &raquo; </span><h4 class="inline">Spot Admission</h4>
										<div class="margin_t1">
											<div class="img_style float_l img_r">
												<img src="http://workforcetrack.in/uploads/univ_gallery/uog20logo1.jpg" class="img_event"/>
											</div>
											<div><img src="http://meetuniv.com/images/city.png" class="line_img inline"><span class="blue line_time inline">British Council, New Delhi, India</span></div>
											<div><img src="http://meetuniv.com/images/clock.png" class="line_img inline"><span class="blue line_time inline">25 June, 2012</span></div>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
										</div>
									</div>
									<div class="float_r">
											<a href="#"><img src="images/call.png" title="Share" alt="Share"></a>
											<a href="#"><img src="images/sms.png" title="Send SMS" alt="Send SMS"></a>
											<a href="#"><img src="images/map.png" title="Map" alt="Map"></a>
										<div class="margin_t1 registered">		
											<h2 class="blue">15</h2>	
											<h5 class="blue">Registered</h5>
										</div>
									</div>
									<div class="clearfix"></div>
								</li>
							</ul>
						<?php
						/*if(!empty($featured_events))
						{
						$c=0;
						foreach($featured_events as $events) { $c=$c+1; ?>
							<li <?php if($c==count($featured_events)){ echo "class='border_gamma' ";} ?>   style="cursor:pointer;"  onclick="gotoevent('<?php echo $base;?>univ-<?php echo $events['univ_id'];?>-event-<?php echo $events['event_id'];?>')">
							<img src="<?php if($events['univ_logo_path']!=''){ echo "$base";?>/uploads/univ_gallery/<?php echo $events['univ_logo_path'];} else { echo "$base$img_path";?>/default_logo.png<?php } ?>" class="events_img" >
							<span><?php echo ucwords(substr($events['event_detail'],0,176)); ?></span><h3><?php $date=explode(" ",$events['event_date_time']); echo $date[0]."-".$date[1]; ?><small>300 attending!</small></span></h3>
							</li>
						<?php } } else { echo "No Upcoming Events !!!"; } */?>	
					</div>
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