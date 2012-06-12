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
<style>
.focused_error
{
	width: 252px !important;
}
</style>
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
				<div class="span16 margin_zero">
				<div class="span5 margin_zero">
					<div class="round_box">
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
						if(!empty($new_users))
						{
						foreach($new_users as $newly_registered){ $x++; 
						if($newly_registered['user_pic_path'] != '')
						{ $user_pic = $newly_registered['user_pic_path']; }
						else { $user_pic = 'user_model.png'; }
						?>
<a href="<?php echo $base; ?>user/<?php echo $newly_registered['id'];?>">
<img style="width:50px;height:51px;" class="thumb <?php if($x==1 || $x==4 || $x==7){ echo "margin_delta";} else if($x==2 || $x==5 || $x==8){ echo "margin_beta";} ?>" src="<?php if($newly_registered['user_pic_path']==''){ echo $base; ?>images/<?php echo $user_pic; ?> <?php } else { echo $base; ?>uploads/<?php echo $user_pic; }?>"/>
</a>				
		
					<?php } } else { "No New Users Available"; } ?>	
					</div>
					<div class="span11 margin_delta margin_t">
						<h3>Upcoming Events</h3>
						<div>
							<ul class="event_new">
								<?php 
								if(!empty($featured_events))
								{
									foreach($featured_events as $home_feature_event) 
									{ 
										if($home_feature_event['event_category'] == 'spot_admission') { $cat = 'Spot Admission'; }
										else if($home_feature_event['event_category'] == 'fairs') { $cat = 'Fairs'; }
										else if($home_feature_event['event_category'] == 'others') { $cat = 'Others'; }
										else if($home_feature_event['event_category'] == 'alumuni') { $cat = 'Alumuni'; }
									/* Extract Date and Time */
									$date = explode(" ",$home_feature_event['event_date_time']);
									/* Code For Center Image */
									$image_exist=0;		
									if(file_exists(getcwd().'/uploads/univ_gallery/'.$home_feature_event['univ_logo_path']))	
									{
									$image_exist=1;
									list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/univ_gallery/'.$home_feature_event['univ_logo_path']);
									}
									else
									{
									list($width, $height, $type, $attr) = getimagesize(getcwd().$img_path.'/calendar.png');
									}
									if($home_feature_event['univ_logo_path']!='' && $image_exist==1)
									{
									$image=$base.'uploads/univ_gallery/'.$home_feature_event['univ_logo_path'];
									}
									else
									{
									$image=$base.$img_path.'/calendar.png';
									} 
									$img_arr=$this->searchmodel->set_the_image($width,$height,100,50,TRUE);
									$event_register_user = $this->frontmodel->count_event_register($home_feature_event['event_id']);
								?>
								<?php
								/* Code For Create Link Of Event */
								$univ_name=$home_feature_event['univ_name'];
								$univ_domain=$home_feature_event['subdomain_name'];
								$event_title=$home_feature_event['event_title'];
								$event_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'event',$event_title,$home_feature_event['event_id']);					
								?>
								<li>
									<div class="event_meth float_l">
										<h3 class="inline"><a href="<?php echo $event_link; ?>"><?php echo $home_feature_event['univ_name']; ?></a></h3><span class="inline"> &raquo; </span><h4 class="inline"><?php echo $cat; ?></h4>
										<div class="margin_t1">
											<div class="img_style float_l img_r">
												<img src=" <?php echo $image ?>" style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" >
											</div>
											<div><img src="http://meetuniv.com/images/city.png" class="line_img inline"><span class="blue line_time inline"><?php echo $home_feature_event['event_place']? ucwords($home_feature_event['event_place']):''; echo $home_feature_event['cityname']?', '.ucwords($home_feature_event['cityname']):''; echo $home_feature_event['country_name']?', '.ucwords($home_feature_event['country_name']):''; ?></span></div>
											<div><img src="http://meetuniv.com/images/clock.png" class="line_img inline"><span class="blue line_time inline"><?php echo $date[0].'  '.$date[1].', '.$date[2];?></span></div>
											<?php echo substr($home_feature_event['event_detail'],0,180); ?>
										</div>
									</div>
									<div class="float_r">
											<a onClick="voicepopup('<?php echo $home_feature_event['event_id']; ?>')" style="cursor:pointer;"><img src="images/call.png" title="Reminder Call" alt="Reminder Call"></a>
											<a onClick="popup('<?php echo $home_feature_event['event_id']; ?>')" style="cursor:pointer;"><img src="images/sms.png" title="Send SMS" alt="Send SMS"></a>
											<a href="<?php echo $event_link; ?>"><img src="images/map.png" title="Map" alt="Map"></a>
										<div class="margin_t1 registered">		
											<h2 class="blue"><?php echo $event_register_user; ?></h2>	
											<h5 class="blue">Registered</h5>
										</div>
									</div>
									<div class="clearfix"></div>
								</li>
								<?php } } else { echo " No Upcoming Events Available "; } ?>
							</ul>
						<?php
						/*
						$c=0;
						if(!empty($featured_events))
						{
						foreach($featured_events as $events) { $c=$c+1; ?>
							<li <?php if($c==count($featured_events)){ echo "class='border_gamma' ";} ?>   style="cursor:pointer;"  onclick="gotoevent('<?php echo $base;?>univ-<?php echo $events['univ_id'];?>-event-<?php echo $events['event_id'];?>')">
							<img src="<?php if($events['univ_logo_path']!=''){ echo "$base";?>/uploads/univ_gallery/<?php echo $events['univ_logo_path'];} else { echo "$base$img_path";?>/default_logo.png<?php } ?>" class="events_img" >
							<span><?php echo ucwords(substr($events['event_detail'],0,176)); ?></span><h3><?php $date=explode(" ",$events['event_date_time']); echo $date[0]."-".$date[1]; ?><small>300 attending!</small></span></h3>
							</li>
						<?php } } else { echo "NO Upcoming Events Available..."; }; */?>	
					</div>
				</div>
			</div>
			<div class="row" style="display:none"><!--LOGIN-->
				<div class="span5">
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
	</div>
<!-- Div For Voice and SMS Popup -->	
<div id="myModal" class="model_back modal hide fade">
	<div class="modal-header no_border model_heading">
		<a class="close" data-dismiss="modal">x</a>
		<h3>Event Information</h3>
	</div>
	<div id="event_det" class="modal-body model_body_height">
	
	</div>
	</div>
	
	<!-- Div For Voice SMS -->
	<div id="myModal-voice" class="model_back modal hide fade">
	<div class="modal-header no_border model_heading">
		<a class="close" data-dismiss="modal">x</a>
		<h3>Event Information</h3>
	</div>
	<div id="event_det_voice" class="modal-body model_body_height">
	
	</div>
	</div>	
	<script>
	function gotoevent(url)
	{
	window.location.href=url;
	//alert("hi");
	}
	</script>

<script>
function popup(id) {
  $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>leadcontroller/sms_me_event_ajax",
	   async:false,
	   data: 'event_id='+id,
	   cache: false,
	   success: function(msg)
	   {
	   $('#event_det').html(msg);
		$('#sms_form').append('<input type="hidden" name="page_status" value="home"/>');
		$('#myModal').modal({
        keyboard: false
    })
	   }
	   }) 
} 

//Code For Voice API

function voicepopup(id) {
  $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>leadcontroller/sms_voice_me_event_ajax",
	   async:false,
	   data: 'event_id='+id,
	   cache: false,
	   success: function(msg)
	   {
	   $('#event_det_voice').html(msg);
		$('#sms_form_voice').append('<input type="hidden" name="page_status_voice" value="home"/>');
		$('#myModal-voice').modal({
        keyboard: false
    })
	   }
	   }) 
}
</script>