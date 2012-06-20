<?php
//$this->load->library('facebook'); 
 
  $this->load->model('users');
  $this->ci =& get_instance();
  $this->ci->load->config('tank_auth', TRUE);
  $this->ci->load->library('session');
 
$facebook = new Facebook();
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
  
  
  if($user_profile['gender'] != ''){ $fb_gender = $user_profile['gender']; } else{$fb_gender='';}
  if($user_profile['email'] != ''){ $fb_email = $user_profile['email']; } else{$fb_email='';}
  if($user_profile['name'] != ''){ $fb_name = $user_profile['name']; } else{$fb_name='';}

/**************************************** 
 *  Check if current facebook uesr      *
 *  email is available or not           *
 ****************************************/
  $fb_return_num_rows = $this->users->check_facebook_email($fb_email);
  if(!$fb_return_num_rows)
  {
  /**************************************** 
 *  Insert data from facebook             *
 *  if user is new for this site from FB  *
 ****************************************/
 $fbdata = array(
  'fullname'	=> $user_profile['name'],
  'createdby' => 'self',
  'level'     => '1',
  'email'		=> $user_profile['email'],
  'activated'  => '1', 
  'createdby_user_id'  => '0',
   'fb_user' =>'1'
  //'last_ip'	=> $this->ci->input->ip_address(),
  );
  if($user_profile['name']!='' && $user_profile['name']!=NULL)
  {
  $data['fb_user_id'] = $this->users->facebook_insert($fbdata);
  $user_id = $data['fb_user_id'];
  if($data['fb_user_id']!=''){
  $data['fb_user_profile_insert'] = $this->users->facebook_profile_insert($user_id,$fb_gender);}
  $attachment = array('message' => $user_profile['name'].' has joined Meet Universities.',
 'link' => 'http://meetuniversities.com');
 $sendMessage = $facebook->api('/me/feed/','post',$attachment);
  }
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
                'scope'         => 'email,offline_access,publish_actions,user_birthday,user_location,user_work_history,user_about_me,user_hometown',
                //'next' => $base['url']
				//'redirect_uri'      => $base['url'],
            ));
	$_SESSION['fb'] = '';
	   }
	  //print_r($this->session->userdata);
	  function currentPageURL() {
    $curpageURL = 'http';
    //if ($_SERVER["HTTPS"] == "on") {$curpageURL.= "s";}
    $curpageURL.= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
    $curpageURL.= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
    $curpageURL.= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $curpageURL;
    }

    $curURL = currentPageURL();
?>
<?php

$title_of_event = "Meet Universities-List your global events.";
$img_src = base_url()."uploads/univ_gallery/univ_logo.png";
$detail_of_event="List your global events.Let the international student community know about when you are visiting near them.";
if(!empty($university_details) && ($university_details['univ_logo_path'] !=0 || $university_details['univ_logo_path'] != ''))
{
$img_src = base_url()."uploads/univ_gallery/".$university_details['univ_logo_path'];
}
if(!empty($event_detail) && ($event_detail['event_title'] != 0 || $event_detail['event_title'] != ''))
{
$title_of_event = $event_detail['event_title']; 
}
if(!empty($event_detail) && ($event_detail['event_detail'] != 0 || $event_detail['event_detail'] != ''))
{
$detail_of_event = $event_detail['event_detail'];
}

?>

<!DOCTYPE html>
<html lang="en-US">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# meetuniversities: http://ogp.me/ns/fb/meetuniversities#">
  <meta property="fb:app_id" content="415316545179174" /> 
  <meta property="og:type"   content="meetuniversities:event" /> 
  <meta property="og:url"    content="<?php echo $curURL; ?>" /> 
  <meta property="og:title"  content="<?php echo $title_of_event; ?>" /> 
  <meta property="og:image"  content="<?php echo $img_src; ?>" />
  <meta property="og:description"  content="<?php echo $detail_of_event; ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="keywords" content="">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="author" content="WebInfoMart.com">
<title><?php echo $title_of_event; ?></title>
<link rel="stylesheet" href="<?php echo "$base$css_path"?>/bootstrap.css">
<link rel="stylesheet" href="<?php echo "$base$css_path"?>/style.css">
<link rel="stylesheet" href="<?php echo "$base$css_path"?>/style_sh.css">
<link rel="stylesheet" href="<?php echo "$base$css_path"?>/home_slider.css">
<link rel="stylesheet" href="<?php echo "$base$css_path"?>/style-editor.css" />
<link rel="stylesheet" href="<?php echo "$base$css_path"?>/popover.css" />
<link rel="stylesheet" href="<?php echo "$base$css_path"?>/thingerly-calendar.css" />
<link rel="icon" type="image/png" href="<?php echo"$base$img_path"; ?>/fav_icon.png"/>
<link href="<?php echo "$base$css_path"?>/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo "$base$js";?>/jquery.js"></script>
<script src="<?php echo "$base$js";?>/jquery-ui.min.js"></script>
<script src="<?php echo "$base$js";?>/all_validation.js"></script>
<script type="text/javascript" src="<?php echo "$base$js";?>/jquery.popover-1.1.0.js"></script>
<script>  <!-- for IE8, IE7 -->
document.createElement('header');
document.createElement('nav');
document.createElement('section');
document.createElement('article');
document.createElement('aside');
document.createElement('footer');
document.createElement('hgroup');
</script>
<?php
$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
if ($_SERVER["SERVER_PORT"] != "80")
{
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
} 
else 
{
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}
?>
<script type="text/javascript">
 jQuery(document).ready(function() {
  jQuery("abbr.timeago").timeago();
});
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
var TheP   = window.location.pathname.split('/');
var HeRe   = '<?php echo $base; ?>'+TheP[TheP.length-1];
$('.menu a').each(function(){
 var Link  = $(this).attr('href');
      if (Link == HeRe){ $(this).addClass('active');}
 });

});
</script>
</head>
<body>
<div id="fb-root"></div>
<script>
/* <![CDATA[ */
window.fbAsyncInit = function() {
FB.init({
appId      : '415316545179174', // App ID
status     : true, // check login status
cookie     : true, // enable cookies to allow the server to access the session
xfbml      : true,  // parse XFBML
oauth      : true
});	 		 
};
// Load the SDK Asynchronously
(function(d){
var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
js = d.createElement('script'); js.id = id; js.async = true;
js.src = "//connect.facebook.net/en_US/all.js#appId=415316545179174&amp;xfbml=1";
d.getElementsByTagName('head')[0].appendChild(js);
}(document));
/* ]]> */
</script>
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
							<fb:login-button   perms="email,user_checkins,publish_actions" id="fb_butonek" onlogin="window.location.reload(true);"></fb:login-button>
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
									<li><a href="<?php echo "$base"; ?>colleges">Colleges</a></li>
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
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<!-- Place this render call where appropriate -->
<script type="text/javascript" src="http://apis.google.com/js/plusone.js">
  {lang: 'en-GB'}
</script>

<script>
function postCook(url)
  {
  FB.getLoginStatus(function(response) {
  if (response.status === 'connected') {  
      FB.api(
       'me/meetuniversities:view?event='+url,
        'post',
        function(response) {
		//alert(response.toSource());
           if (!response || response.error) {
     
           } else {     
     id_pro = response.id;       
     }
        });
  } 
   });
}
</script>