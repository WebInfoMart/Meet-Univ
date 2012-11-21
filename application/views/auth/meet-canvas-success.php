<?php
$facebook = new Facebook();
$user = $facebook->getUser();
//$this->load->model('users');
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

//$signed_request = $facebook->getSignedRequest();

// Return you the Page like status
//$like_stat = $signed_request["page"]["liked"];
?>
<html>
	<head>
<script>
/* <![CDATA[ */
window.fbAsyncInit = function() {
FB.init({
appId      : '301604353250300', // App ID
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
js.src = "//connect.facebook.net/en_US/all.js#appId=301604353250300&amp;xfbml=1";
d.getElementsByTagName('head')[0].appendChild(js);
}(document));
/* ]]> */
</script>
<script type="text/javascript">
var sUrl = window.location;
document.getElementById('fb').setAttribute('href', sUrl);
</script>

		<style> html,body{padding:0px;margin:0px;} </style>
	</head>
<body>

<center>
<div><img src="../images/thank-you.jpg"/></div>
	<div style="font-size: 21px;
margin-top: 0px;
width: 800px;
height: 115px;
border-radius: 14px;
background-color: aliceBlue;
padding-top: 1px;">
	<p>Thanks for registering with us. Meetuniversities expert will get in touch shortly.</p>
		<?php if($this->session->flashdata('like')!='') 
		{  } 
		else { ?>
		by the way <fb:like id="fb" style="width:46px;" href="http://www.facebook.com/pages/Rayan-Home-Community/270142466424403" layout="button_count"></fb:like>  to stay updated about your dream universities.
		<?php }  ?>
	</div>
</center>
</body>
</html>