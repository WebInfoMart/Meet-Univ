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
								<?php $logged_user_id = $this->tank_auth->get_user_id(); 
									if(file_exists(getcwd().'/uploads/user_pic/thumbs/'.$comments_detail['user_thumb_pic_path']) && $comments_detail['user_thumb_pic_path']!='' )
							{
							//echo $image_thumb = $profile_pic['user_pic_path'].'_thumb';
							
								echo "<img style='max-height:100px;' src='".base_url()."uploads/user_pic/thumbs/".$comments_detail['user_thumb_pic_path']."'/>";
							}
							else if(file_exists(getcwd().'/uploads/user_pic/'.$comments_detail['user_pic_path']) && $comments_detail['user_pic_path']!='')
							{
								echo "<img style='max-height:100px;' src='".base_url()."uploads/user_pic/".$comments_detail['user_pic_path']."'/>";
							}
							
							else if($user && $comments_detail['q_askedby'] == $logged_user_id)
							{
							?>
								<img style='max-height:100px;' src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=large">
							<?php
							}
							else{
							echo "<img style='max-height:100px;' src='".base_url()."images/profile_icon.png'/>";
							}
							?>
									<h4 class="center">
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
								</h4>
								</div>
								
							</div>
							<div class="word">
							<?php if($user_is_logged_in ){
			if($user_detail['user_id']==$comments_detail['user_id'])
			{
			?>					
			<!--<span class="float_r delete_comment">
					<img style="cursor:pointer;" class="del_icon" onclick='delete_this_comment("<?php //echo $comments_detail['comment_id']; ?>")' src="<?php //echo "$base$img_path";?>/close.jpg">
			</span>-->
			<?php	} } ?>	
								
								<?php echo $comments_detail['commented_text'];?>
								
							</div><br/>
							<div class="float_r span2 margin_delta">
									<abbr class="timeago time_ago" title="<?php echo $comments_detail['comment_time']; ?>"></abbr>
								</div>
							<div class="clearfix"></div>
							
</div> <?php } } ?>
<script>
jQuery(document).ready(function() {
  jQuery("abbr.timeago").timeago();
});
</script>