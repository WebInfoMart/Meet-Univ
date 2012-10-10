<?php
date_default_timezone_set('Asia/Kolkata'); 
$user=null; 
$facebook = new Facebook();
$user = $facebook->getUser();
if($this->ci->session->userdata('login_by_fb') && (! $this->ci->session->userdata('status'))){
if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}
if ($user) {
  if($user_profile['gender'] != ''){ $fb_gender = $user_profile['gender']; } else{$fb_gender='';}
  if($user_profile['email'] != ''){ $fb_email = $user_profile['email']; } else{$fb_email='';}
  if($user_profile['name'] != ''){ $fb_name = $user_profile['name']; } else{$fb_name='';}
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
  'fb_user' =>'1',
  'user_type' =>'fb_login'
  //'last_ip'	=> $this->ci->input->ip_address(),
  );
  if($user_profile['name']!='' && $user_profile['name']!=NULL)
  {
  $email = $user_profile['email'];
  $data['fb_user_id'] = $this->users->facebook_insert($fbdata);
  $user_id = $data['fb_user_id'];
  $small_fb_pic_url = 'http://graph.facebook.com/'.$user.'/picture?type=small';
  $large_fb_pic_url = 'http://graph.facebook.com/'.$user.'/picture?type=large';
  $thumb_img_name='user_'.$user_id.'_thumb.jpg';
  $large_img_name='user_'.$user_id.'.jpg';
  $thumb_img = 'uploads/user_pic/thumbs/'.$thumb_img_name;
  $large_img=  'uploads/user_pic/'.$large_img_name;
  $thumb_img_file=file_get_contents($small_fb_pic_url);
  $large_img_file=file_get_contents($large_fb_pic_url);
  if($thumb_img_file && $large_img_file)
  {
  file_put_contents($thumb_img,$thumb_img_file);
  file_put_contents($large_img,$large_img_file);
  }
  if($data['fb_user_id']!=''){
  $data['fb_user_profile_insert'] = $this->users->facebook_profile_insert($user_id,$fb_gender,$large_img_name,$thumb_img_name);}
  $attachment = array('message' => $user_profile['name'].' has joined Meet Universities.',
 'link' => 'http://meetuniversities.com/register');
  $sendMessage = $facebook->api('/me/feed/','post',$attachment);
  }
  $data_fb_id = trim($data['fb_user_id']);			 
  }
  else if($fb_return_num_rows > 0)
  {
  /**************************************** 
 *  Fetch facebook user id from db        *
 *  for store in session                  *
 ****************************************/
 	$get_fb_user_id['query'] = $this->users->fetch_fb_user_id($fb_email);
	$user_id = $get_fb_user_id['query']['id'];
  } 
  $this->ci->session->set_userdata(array(
						 'user_id'	=> $user_id,
						 'fullname'	=> $fb_name,
						 'status'	=> STATUS_ACTIVATED
						 ));
} 

}
	   
	  function currentPageURL() {
    $curpageURL = 'http';
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

 if(empty($header_title)){$header_title = "Meet Universities - Get connected to your dream university.";}
 if(empty($img_src)){ $img_src = base_url()."uploads/univ_gallery/univ_logo.png";}
 if(empty($header_detail)) { $header_detail = "Study Abroad - Research, Connect &  Meet Your Dream University.";}
 $header_detail=str_replace('"',"'",$header_detail);
/*if(!empty($university_details) && ($university_details['univ_logo_path'] !=0 || $university_details['univ_logo_path'] != ''))
{
$img_src = base_url()."uploads/univ_gallery/".$university_details['univ_logo_path'];
}
if(!empty($event_detail) && ($event_detail['event_title'] != 0 || $event_detail['event_title'] != ''))
{
$title_of_event = $event_detail['event_title']; 
}
if(!empty($event_detail) && ($event_detail['event_detail'] != 0 || $event_detail['event_detail'] != ''))
{ 
$event_details=str_replace('<div>','',$event_detail['event_detail']);
$event_details=str_replace('</div>','',$event_details);
$detail_of_event = $event_details; 
} */

if(empty($keyword_content)) { $keyword_content="higher studies,  international students, upcoming events, global events, universities events, study in UK, UK scholarship, higher education, uk student visa, sponsorship, study in Canada, expenditure, Counselling."; }
if(empty($description_content)) { $description_content="Attend Events, Study Abroad - Research, Connect & Meet Your Dream University"; }
?>
<!DOCTYPE html>
<html lang="en-US">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# meetuniversities: http://ogp.me/ns/fb/meetuniversities#">
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="author" content="WebInfoMart.com">
	<meta charset="utf-8">
	<meta property="fb:app_id" content="415316545179174" /> 
	<meta property="og:type"   content="meetuniversities:event" /> 
	<meta property="og:url"    content="<?php echo $curURL; ?>" /> 
	<meta property="og:title"  content="<?php echo $header_title; ?>" /> 
	<meta property="og:image"  content="<?php echo $img_src; ?>" />
	<meta property="og:description"  content="<?php echo $header_detail; ?>" />
	<meta name="description" content="<?php echo $description_content; ?>">
	<meta name="keywords" content="<?php echo $keyword_content; ?>">
<title><?php echo $header_title; ?></title>
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
<!--<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>-->
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
					<div class="span6 offset8">
						<div class="bar">
						<?php
						if($this->ci->session->userdata('status')){ ?>
						
						<a href="<?php echo $base?>home"><div class="login">Hi <?php echo ucwords($this->ci->session->userdata('fullname')); ?></div></a>
						<a href="<?php echo $base ?>logout"> <div class="login">Logout</div></a>
						<?php 
						} 
						else { ?>
							<a href="<?php echo $base ?>login"><div class="login">Login</div></a>
							<a href="<?php echo $base ?>register"><div class="signup">Signup</div></a>
							<span id="fb_button">
							<fb:login-button   perms="email,user_checkins,publish_actions" id="fb_butonek" onlogin="reload_and_set_session()"></fb:login-button>
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
						<a href="<?php echo $base; ?>">	<img src="<?php echo "$base$img_path" ?>/logo.png" alt="Meet Universities" title="Meet Universities"/></a>
						</div>
						<div class="span7 float_r">					
						<a  href="<?php echo $base; ?>register/british_council"><img src="<?php echo "$base$img_path" ?>/banner.png" alt="Meet Universities" title="Meet Universities"/></a>
						</div>
						<!--<div class="span7 ">
						<form method="get" action="http://www.google.com/search"> 
						<div style="border:1px solid black;padding:4px;width:20em;"> 
						<table border="0" cellpadding="0"> 
						<tr><td> 
						<input type="text" name="q" size="25" maxlength="255" value="" /></td><td> <input type="submit" value="Google Search" /></td>
						</tr>
						<tr>
						<td align="center" style="font-size:75%"> 
						<input type="checkbox" name="sitesearch" value="meetuniversities.com" checked /> only search Meet Universities<br /> 
						</td></tr>
						</table> 
						</div> 
						</form>
						</div>-->
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
function reload_and_set_session()
{
window.location.replace("<?php echo $base; ?>home");
}	
</script>
<!--[if IE 7]>
<script type="text/javascript">
$(document).ready(function() {
window.location.href = "<?php echo "$base"; ?>use_higer_browser";
});
</script>
<![endif]-->
<?php $this->session->set_userdata('login_by_fb',1); ?>
