<?php
 date_default_timezone_set('Asia/Kolkata');
$facebook = new Facebook();
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
}	if($comments!=0){
						foreach($comments as $comments_detail){ ?>
						<div class="event_border find_comment hover_delete_comment_<?php echo $comments_detail['comment_id']; ?>">
							<div class="float_l">
								<div class="comment_img">
									<?php if($comments_detail['user_pic_path'] !=''){ ?>
									<img src="<?php echo "$base"; ?>uploads/<?php echo $comments_detail['user_pic_path']; ?>" />
									<?php } 
									else if($user) { ?>
								<img src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=small">
								<?php } 
									else { ?>		
									<img src="<?php echo "$base$img_path"; ?>/user_model.png" />
									<?php } ?>
								</div>
							</div>
							<div>
							<?php if($user_is_logged_in ){
			if($user_detail['user_id']==$comments_detail['user_id'])
			{
			?>					
			<!--<span class="float_r delete_comment">
					<img style="cursor:pointer;" class="del_icon" onclick='delete_this_comment("<?php //echo $comments_detail['comment_id']; ?>")' src="<?php //echo "$base$img_path";?>/close.jpg">
			</span>-->
			<?php	} } ?>	
								
								<?php echo $comments_detail['commented_text'];?>
								<div style="font-size;color:black;" class="float_r">
								<abbr class="timeago time_ago" title="<?php echo $comments_detail['comment_time']; ?>"></abbr>
								</div>
							</div>
							<div class="clearfix"></div>
							<h4><span class="course_txt">
								<?php if($comments_detail['commented_by_user_name'] !=''){
									echo $comments_detail['commented_by_user_name']; 
									}
									else if($comments_detail['fullname'] !='')
									{
										echo $comments_detail['fullname'];
									}
									else if($user)
									{
										echo $user_profile['name'];
									} ?>
								</span></h4>
</div> <?php } } ?>
<script>
jQuery(document).ready(function() {
  jQuery("abbr.timeago").timeago();
});
</script>