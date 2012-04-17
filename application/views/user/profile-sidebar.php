<?php
$facebook = new Facebook(array(
  'appId'  => '358428497523493',
  'secret' => '497eb1b9decd06c794d89704f293afdd',
));
$user = $facebook->getUser();
$this->load->model('users');
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
?>
<div class="span3 margin_zero float_l">
						<div class="sidebar_profic_pic">
							<?php
							if($profile_pic['user_pic_path'] != '')
							{
							echo "<img src='".base_url()."uploads/".$profile_pic['user_pic_path']."'/>";
							}
							else if($user)
							{
							?>
								<img src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=large">
							<?php
							}
							else{
							echo "<img src='".base_url()."images/profile_icon.png'/>";
							}
							?>
								<!--<src="<?php echo "$base$img_path";  ?>profile_pic.png">-->
								<h3 class="text_align"><?php echo $query['fullname']; ?></h3>
								<div>
									<div class="margin_all">
									<?php
										$dob = $profile_pic['dob'];
										$dob_explode = explode("-",$dob);
									?>
										<h4><?php 
									if($dob_explode[2] == 00 || $dob_explode[2] == '')
									{ echo '';} else {
									echo $dob_explode[2].'&nbsp;';
									}
										 if($dob_explode[1] ==00) { echo '';} 
										 else if($dob_explode[1] ==01) { echo 'Jan';} 
										 else if($dob_explode[1] ==02) { echo 'Feb';} 
										 else if($dob_explode[1] ==03) { echo 'March';} 
										 else if($dob_explode[1] ==04) { echo 'April';} 
										 else if($dob_explode[1] ==05) { echo 'May';} 
										 else if($dob_explode[1] ==06) { echo 'June';} 
										 else if($dob_explode[1] ==07) { echo 'July';} 
										 else if($dob_explode[1] ==08) { echo 'Aug';} 
										 else if($dob_explode[1] ==09) { echo 'Sept';} 
										 else if($dob_explode[1] ==10) { echo 'Oct';} 
										 else if($dob_explode[1] ==11) { echo 'Nov';} 
										 else if($dob_explode[1] ==12) { echo 'Dec';} ?>
									<?php
									if($dob_explode[0] == 0000 || $dob_explode[0] == '')
									{ echo ''; } else {
									echo $dob_explode[0].',';
									}
									if($profile_pic['gender'] != '') { echo $profile_pic['gender']; } else { echo " "; }
									?> </h4>
										
									</div>
								</div>
								<div class="part_second" style="">
								<div class="index_sidebar_progress">
									<div class="index_sidebar_body">
										<h4 class="font_sidebar">Your Profile Completes 25%</h4>
										<div class="progress_outline progress_out">
											<div class="progress progress_bar">
												<div class="bar margin_zero" style="width: 50%;">
												</div>
											</div>
										</div>
									</div>
								</div>
								</div>
							</div>
							
							<div class="part_second">
								<div class="index_sidebar_box">
									<div class="index_sidebar_header font_sidebar">
										My Colleges
									</div>
									<div class="index_sidebar_body">
									<ul class="links">
										<li><a href="#">MBA</a></li>
										<li><a href="#">Engineering</a></li>
										<li><a href="#">Info Tech</a></li>
										<li><a href="#">Education</a></li>
										<li><a href="#">Aviation</a></li>
										<li><a href="#">Science</a></li>
									</ul>
									</div>
								</div>
							</div>
							<div class="part_second">
								<div class="index_sidebar_box">
									<div class="index_sidebar_header font_sidebar">
										Messages
									</div>
									<div class="index_sidebar_content">
										<ul class="links1">
           <li><a href="#">Composer</a></li>
           <li><div><div ><a href="inbox">Inbox </a></div><div class="float_r"><!--<span class="badge badge-warning">68</span>==></div><div class="clearfix"></div></div></li><!--29-->
           <li><div><div ><a href="#">Outbox </a></div><div class="float_r"><!--<span class="badge badge-warning">8</span>--></div><div class="clearfix"></div></div></li><!--29-->
          </ul>
									</div>
								</div>
							</div>
							<div class="part_second">
								<div class="index_sidebar_box">
									<div class="index_sidebar_header font_sidebar">
										Account Settings
									</div>
									<div class="index_sidebar_content">
										<ul class="links1">
											<li><a href="<?php echo "$base" ?>update_profile">Update profile</a></li>
											<?php if(!$user) { ?>
											<li><a href="<?php echo "$base" ?>update_password">Change password</a></li>
											<?php } ?>
											
										</ul>
									</div>
								</div>
							</div>
							<div class="part_second font_sidebar">
								<div class="index_sidebar_content invite">
									<div class="index_sidebar_header">
										<a data-toggle="modal" href="#myModal" id="pulse"><span class="orange">+  Invite Friends</span></a>
										<div id="myModal" class="modal hide fade" style="display: none; ">
											<div class="modal-header">
												<a class="close" data-dismiss="modal">×</a>
												<h3>thank you</h3>
											</div>
											<div class="modal-footer">
											<a href="#" class="btn btn-primary">Save changes</a>
											<a href="#" class="btn" data-dismiss="modal">Close</a>
											</div>
										</div>
									</div>
								</div>
							</div>
					</div>