<?php
//$this->load->library('facebook'); 
/****************************************** 
 *  Load Model and session library and    *
 *  Object                                *
 ******************************************/ 
  
  $this->load->model('users');
  $this->ci =& get_instance();
  $this->ci->load->config('tank_auth', TRUE);
  $this->ci->load->library('session');
 
$facebook = new Facebook(array(
  'appId'  => '358428497523493',
  'secret' => '497eb1b9decd06c794d89704f293afdd',
));
$base = base_url();
//$base['fb_redirect'] = "'".base_url()."'/auth/facebook";
$user = $facebook->getUser();
if ($user) {
//$logoutUrl2 = $this->tank_auth->logout();
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}
if ($user) {
/****************************************** 
 * Logout Link for Facebook and MU site   *
 ******************************************/
	/******* Logout Link of Facebook and Site *******/
	$params = array( 'next' => $base.'/logout' );
  $logoutUrl = $facebook->getLogoutUrl($params);
  
  
  /********************************************* 
 * Session start for validate in welcome Model *
 *  facebbok login                             *
 ***********************************************/
  $_SESSION['fb'] = 'Facebook';
  
  /****************************************** 
 * Set session and Loged in user after      *
 *  facebbok login                          *
 ******************************************/
  
  $fbdata = array(
  'fullname'	=> $user_profile['name'],
  'createdby' => 'self',
  'level'     => '1',
  'email'		=> $user_profile['email'],
  'activated'  => '1', 
  'createdby_user_id'  => '0',
   'fb_user' =>'1',
  //'last_ip'	=> $this->ci->input->ip_address(),
  );
  $fb_email = $user_profile['email'];
  $fb_name = $user_profile['name'];

/**************************************** 
 *  Check if current facebook uesr      *
 *  email is available or not           *
 ****************************************/
  $fb_return_num_rows = $this->users->check_facebook_email($fb_email);
  if($fb_return_num_rows == 0)
  {
  /**************************************** 
 *  Insert data from facebook             *
 *  if user is new for this site from FB  *
 ****************************************/
  $data['fb_user_id'] = $this->users->facebook_insert($fbdata);
  $data_fb_id = trim($data['fb_user_id']);
  $this->ci->session->set_userdata(array(
						 'user_id'	=> $data_fb_id,
						 'username'	=> $fb_name,
						 'status'	=> STATUS_ACTIVATED,
						 ));
						 
  }
  else if($fb_return_num_rows > 0)
  {
  /**************************************** 
 *  Fetch facebook user id from db        *
 *  for store in session                  *
 ****************************************/
 //echo $fb_email;
	$get_fb_user_id['query'] = $this->users->fetch_fb_user_id($fb_email);
	//print_r($get_fb_user_id);
	$fb_user_id = $get_fb_user_id['query']['id'];
	//echo $fb_user_id;
	$this->ci->session->set_userdata(array(
						 'user_id'	=> $fb_user_id,
						 'username'	=> $fb_name,
						 'status'	=> STATUS_ACTIVATED,
						 ));
						 //redirect('');
  } //redirect('');
} else {
/**************************************** 
 *  Login URL of Facebook with perms    *
 *                                      *
 ****************************************/
  $loginUrl = $facebook->getLoginUrl(array(
                'scope'         => 'email,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown',
                //'next' => $base['url']
				//'redirect_uri'      => $base['url'],
            ));
	$_SESSION['fb'] = '';
	   }
	  //print_r($this->session->userdata);
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="keywords" content="">
<meta name="description" content="">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="author" content="WebInfoMart.com">
<title>Meet Universities</title>
<link rel="stylesheet" href="<?php echo "$base$css_path"?>/bootstrap.css">
<link rel="stylesheet" href="<?php echo "$base$css_path"?>/style.css">
<link rel="stylesheet" href="<?php echo "$base$css_path"?>/style_sh.css">
<link rel="stylesheet" href="<?php echo "$base$css_path"?>/style-avia.css">
<link rel="stylesheet" href="<?php echo "$base$css_path"?>/style-editor.css" />
<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
  FB.init({appId: '358428497523493', status: true, cookie: true, xfbml: true});
  FB.Event.subscribe('auth.sessionChange', function(response) {
    if (response.session) {
      // A user has logged in, and a new cookie has been saved
        window.location.reload(true);
    } else {
      // The user has logged out, and the cookie has been cleared
    }
  });
</script>
<script src="<?php echo "$base$js";?>/jquery.js"></script>
<script type="text/javascript" src="<?php echo "$base$js";?>/bootstrap-collapse.js"></script>
<script type="text/javascript" src="<?php echo "$base$js";?>/bootstrap-dropdown.js"></script>
<script src="<?php echo "$base$js";?>/bootstrap-alerts.js"></script>
<script type="text/javascript" src="<?php echo "$base$js";?>/bootstrap-modal.js"></script>
<script type="text/javascript" src="<?php echo "$base$js";?>/pic_upload_js.js"></script>
<script type="text/javascript" src="<?php echo "$base$js";?>/bootstrap-button.js"></script>

<script type="text/javascript" src="<?php echo "$base$js";?>/avia-custom.js"></script>
<script type="text/javascript" src="<?php echo "$base$js";?>/jquery.tinyscrollbar.min.js"></script>
<script type="text/javascript" src="<?php echo "$base$js";?>/tinyeditor.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
   $('#scrollbar1').tinyscrollbar(); 
  });
  $(document).ready(function(){
   $('#scrollbar2').tinyscrollbar(); 
  });
  $(document).ready(function(){
   $('#scrollbar3').tinyscrollbar(); 
  });
  $(document).ready(function(){
   $('#scrollbar4').tinyscrollbar(); 
  });
  $(document).ready(function(){
   $('#scrollbar5').tinyscrollbar(); 
  });
 </script>
<script type="text/javascript">
$(document).ready(function(){
 $('#pulse').click(function(){
$('#myModal').modal('toggle');});
 });
 
 $(document).ready(function(){
 $('#pulse').click(function(){
$('#forget_model').modal('toggle');});
 });
</script>

<script type="text/javascript">
$(document).ready(function(){
 $('#pulse2').click(function(){
$('#myModal2').modal('toggle');});
 });

</script>
<script type="text/javascript">
$(document).ready(function(){


    var url = window.location.pathname, 
        urlRegExp = new RegExp(url.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
        // now grab every link from the navigation
        $('.menu a').each(function(){
            // and test its normalized href against the url pathname regexp
            if(urlRegExp.test(this.href.replace(/\/$/,''))){
                $(this).addClass('active');
            }
        });

});
</script>
<script type="text/javascript">
$(document).ready(function(){


    var url = window.location.pathname, 
        urlRegExp = new RegExp(url.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
        // now grab every link from the navigation
        $('.cat_list a').each(function(){
            // and test its normalized href against the url pathname regexp
            if(urlRegExp.test(this.href.replace(/\/$/,''))){
                $(this).addClass('cat_list_select');
            }
        });

});
</script>
<!-- ===================start slider_kit=================== -->
		<script type="text/javascript" src="<?php echo "$base$js";?>/jquery.sliderkit.1.9.2.pack.js"></script>
		<script type="text/javascript" src="<?php echo "$base$js";?>/jquery.easing.1.3.min.js"></script>
		<script type="text/javascript" src="<?php echo "$base$js";?>/jquery.mousewheel.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo "$base$css_path"?>/sliderkit-core.css" media="screen, projection" />
		<link rel="stylesheet" type="text/css" href="<?php echo "$base$css_path"?>/sliderkit-demos.css" media="screen, projection" />
		<link rel="stylesheet" type="text/css" href="<?php echo "$base$css_path"?>/sliderkit-site.css" media="screen, projection" />
		
			<script type="text/javascript">
			$(window).load(function(){ //$(window).load() must be used instead of $(document).ready() because of Webkit compatibility		
				
				// Photo slider > Minimal
				$(".contentslider-std").sliderkit({
					auto:0,
					tabs:1,
					circular:1,
					panelfx:"sliding",
					panelfxfirst:"fading",
					panelfxeasing:"easeInOutExpo",
					fastchange:0,
					keyboard:1
				});
				
			});	
		</script>
	<!-- ===================end slider_kit=================== -->
</head>
<body>
<div id="fb-root"></div> 
	<header>
		<div class="header_bar">	
			<div class="container">
				<div class="row">
					<div class="span5 offset9">
						<div class="bar">
						<?php
						if($this->ci->session->userdata('status')){ ?>
						<?php if($user) { ?>
						<a href="<?php echo $base?>home"><div class="login">Hi <?php echo ucwords($this->ci->session->userdata('username')); ?></div></a>
						<a href="<?=$logoutUrl ?>"><img src="<?php echo "$base$img_path" ?>/facebook_logout_button.png"/> </a>
						<?php } else { ?>	
						<a href="<?php echo $base?>home"><div class="login">Hi <?php echo ucwords($this->ci->session->userdata('fullname')); ?></div></a>
						<a href="<?php echo $base ?>logout"> <div class="login">Logout</div></a>
						<?php } } else { ?>
							<a href="<?php echo $base ?>login"><div class="login">Login</div></a>
							<a href="<?php echo $base ?>register"><div class="signup">Signup</div></a>
							<span id="fb_button">
							<fb:login-button   perms="email,user_checkins" id="fb_butonek" onlogin="window.location.reload(true);"></fb:login-button>
							<!--<img src="<?php echo "$base$img_path" ?>/inconnect.png" />-->
							</span>
							<?php } ?>
						
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="logo_holder">
			<div class="container">
				<div class="margin">
					<div class="row"><!--LOGO-->
						<div class="span5 margin_zeros">
						<a href="<?php echo $base; ?>">	<img src="<?php echo "$base$img_path" ?>/logo.png" /></a>
						</div>
						<div class="span7 float_r">
							<img src="<?php echo "$base$img_path" ?>/banner.png" />
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="row">
						<div class="main_menu">
							<div class="float_r span11">
								<ul class="menu">
									<li><a href="<?php echo $base; ?>">Home</a></li>
									<li><a href="<?php echo "$base"; ?>all_colleges">Colleges</a></li>
									<li><a href="<?php echo "$base"; ?>QuestandAns">Questions & Answers</a></li>
									<li><a href="<?php echo $base; ?>events">Events</a></li>
									<li><a href="<?php echo $base; ?>articles">Articles</a></li>
									<li class="padding_beta" style="border:none;"><a href="<?php echo $base; ?>news">News</a></li>
								</ul>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<style>
#fb_butonek a
{
background: url("<?php echo "$base$img_path" ?>/icon_facebook_login.png") no-repeat;

width:70px; /*my image width*/

height:22px; /*my image height*/
}

#fb_butonek a span
{
border:0px none;
background: none;
display:none;
}
	</style>
	<!--<div>
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body"> -->