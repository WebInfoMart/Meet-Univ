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
$class_modal_email='';
$error_login = form_error('login');
$error_password = form_error('password');
$error_modal_email = form_error('email');

if($error_modal_email != '') { $class_modal_email = 'focused_error_stepone'; } else { $class_modal_email='span3'; }
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
<div class="modal" id="activated_user" style="display:none;" >
  <div class="modal-header">
    <a class="close" data-dismiss="modal"></a>
    <h3>Congratulations! Your account has been successfully activated. Please login with your credentials.</h3>
  </div>
</div>

<div class="modal" id="link_send_for_fpass" style="display:none;" >
  <div class="modal-header">
    <a class="close" data-dismiss="modal"></a>
    <h3>An Email has been sent to Your E-mail Id.For Change Password Please Activate your Account</h3>
  </div>
</div>

<!-- Css For Login Validation -->
<div class="modal" id="show_success" style="display:none;" >
  <div class="modal-header">
    <a class="close" data-dismiss="modal"></a>
    <h3>You are one step away from signing up at Meet Universities. Please check your email and activate your account.</h3>
  </div>
</div>
<div id="forget_model" class="model_back modal hide fade" style="display: none; ">

					<div class="modal-header no_border forget_heading">
						<a class="close" data-dismiss="modal">x</a>
						<h3>Forget Password</h3>
					</div>
					<div class="forget_back">
					<div class="modal-body forget_height">
						<form class="form-horizontal" action="forgot_password" method="post" onsubmit="return validateform();">
							<fieldset>
								<div class="control-group">
									<label class="control-label" for="prependedInput">Enter Your Email</label>
									<div class="controls">
										<div class="input-prepend">
											<span class="add-on"><img src="<?php echo "$base$img_path" ?>/lock.png" ></span><input type="text" class="<?php echo $class_modal_email; ?>" name="email" id="forgot_pwd_email" size="16" >
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
					<form class="margin1" id="login_form" method="post" action="">
						<div class="control-group">
							<label class="control-label" for="login">Email</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><img src="<?php echo "$base$img_path" ?>/at.png"></span><input class="<?php echo $class_login; ?>" name="login" id="email_login" placeholder="Email" value="<?php echo set_value('login'); ?>" type="text">
										<span style="color:red;"> <?php echo form_error('login'); ?><?php echo isset($errors['login'])?$errors['login']:''; ?> </span>
									</div>
								</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="password">Password</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on"><img src="<?php echo "$base$img_path" ?>/lock.png"></span><input type="password" class="<?php echo $class_pass; ?>" name="password" id="pass_login" placeholder="Password" value="" onfocus="$(this).prop('type','password');">
									<span style="color:red;"> <?php echo form_error('password'); ?><?php echo isset($errors['password'])?$errors['password']:''; ?></td> </span>
								</div>
							</div>
							<small><a style="cursor:pointer;" id="forgot_pass">Forgot your password?</a></small>
							
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
						$user_pic='';
						if(!empty($new_users))
						{
						foreach($new_users as $newly_registered){
						$x++; 
					    if(file_exists(getcwd().'/uploads/user_pic/thumbs/'.$newly_registered['user_thumb_pic_path']) && $newly_registered['user_thumb_pic_path']!='')
						{
						if(filesize(getcwd().'/uploads/user_pic/thumbs/'.$newly_registered['user_thumb_pic_path']))
						{
						 $user_pic =  base_url()."uploads/user_pic/thumbs/".$newly_registered['user_thumb_pic_path'];
						}
						//echo $image_thumb = $profile_pic['user_pic_path'].'_thumb';	
						}
						if(file_exists(getcwd().'/uploads/user_pic/'.$newly_registered['user_pic_path']) && $newly_registered['user_pic_path']!='' && $user_pic=='')
						{
						if(filesize(getcwd().'/uploads/user_pic/'.$newly_registered['user_pic_path']))
						{
						 $user_pic =  base_url()."uploads/user_pic/".$newly_registered['user_pic_path'];
						}
						}
						if($user_pic==''){
						$user_pic = base_url()."images/profile_icon.png";
						}
						$fullname =$this->subdomain->process_url_title($newly_registered['fullname']);	
						?>
<a href="<?php echo $base; ?>user/<?php echo $newly_registered['id'];?>/<?php echo $fullname;?>">
<img style="width:50px;height:51px;" class="thumb <?php if(($x-1)%3){ echo "margin_delta";} else if(($x+1%3)){ echo "margin_beta";} ?>" src="<?php echo $user_pic; ?>"/>
</a>				
		
					<?php
					$user_pic='';
					} } else { echo "No New Users Available"; } ?>	
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
								$event_title =$this->subdomain->process_url_title($event_title);	
								$event_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'event',$event_title,$home_feature_event['event_id']);					
								?>
								<li>
									<div class="event_meth float_l">
										<h3 class="inline"><a href="<?php echo $event_link; ?>"><?php echo $home_feature_event['univ_name']; ?></a></h3><span class="inline"> &raquo; </span><h4 class="inline"><?php echo $cat; ?></h4>
										<div class="margin_t1">
											<div class="img_style float_l img_r">
												<img src=" <?php echo $image ?>" style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" >
											</div>
											<div><img src="<?php echo $base; ?>images/city.png" class="line_img inline"><span class="blue line_time inline">
											<?php 
											echo $home_feature_event['event_place']? ucwords($home_feature_event['event_place']):''; 
											if($home_feature_event['event_place']!='' && $home_feature_event['cityname']!='')
											{
											echo ', '.ucwords($home_feature_event['cityname']);
											} else { echo $home_feature_event['cityname']; }
											//echo $home_feature_event['cityname']?', '.ucwords($home_feature_event['cityname']):''; 
											if($home_feature_event['country_name']!='' && $home_feature_event['event_place']!='' || $home_feature_event['cityname']!='')
											{
												echo ', '.ucwords($home_feature_event['country_name']);
											} else { echo $home_feature_event['country_name']; }
											?></span></div>
											<div><img src="<?php echo "$base$img_path" ?>/clock.png" class="line_img inline"><span class="blue line_time inline"><?php echo $date[0].'  '.$date[1].', '.$date[2];?></span></div>
											<?php
											$event_detail=str_replace('<div>','',$home_feature_event['event_detail']);
											$event_detail=str_replace('</div>','',$event_detail);
											//echo substr($event_detail,0,180); ?>
										</div>
									</div>
									<div class="float_r">
											<!--<a onClick="voicepopup('<?php //echo $home_feature_event['event_id']; ?>')" style="cursor:pointer;"><img src="images/call.png" title="Reminder Call" alt="Reminder Call"></a>
											<a onClick="popup('<?php //echo $home_feature_event['event_id']; ?>')" style="cursor:pointer;"><img src="images/sms.png" title="Send SMS" alt="Send SMS"></a>
											<a href="<?php //echo $event_link; ?>"><img src="images/map.png" title="Map" alt="Map"></a>
											-->
										<div class="margin_t1 registered">		
											<h2 class="blue"><?php echo $event_register_user; ?></h2>	
											<h5 class="blue">Registered</h5>
										</div>
									</div>
									<div class="clearfix"></div>
								</li>
								<?php } } else { echo "No Upcoming Events Available"; } ?>
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
<?php if($this->session->flashdata('activated')!="") { ?>
$("#activated_user").css("display","block");
$("#activated_user").delay(7000).fadeOut(200);
<?php } ?>
</script>	
<script>
<?php if($this->session->flashdata('registeration_success')) { ?>
$(document).ready(function(){
$('#show_success').css('display','block');
$("#show_success").delay(7000).fadeOut(200);
});
<?php } ?>
	

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

function validateform()
{
var email=$('#forgot_pwd_email').val();
if (!validateEmail(email)) {
    $('#forgot_pwd_email').addClass('needsfilled');
	return false;
  }
}
function validateEmail(email) { 

    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

$('#forgot_pass').click(function(){
$('#forget_model').modal('toggle');
});
<?php
 if($email_send) { ?>
 $('#link_send_for_fpass').css('display','block');
$("#link_send_for_fpass").delay(7000).fadeOut(200);
 <?php }  if($msg == 1) { ?>
 $('#forget_model').css('display','block');
 $('#forget_model').addClass('in');
 <?php } ?>
</script>