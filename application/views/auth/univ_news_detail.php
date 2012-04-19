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
$class_fullname='';
$class_email='';
$class_commented_text='';
$error_fullname = form_error('full_name');
$error_email = form_error('email');
$error_commented_text = form_error('commented_text');

if($error_fullname != '') { $class_fullname = 'focused_error'; } else { $class_fullname='input-xlarge'; }

if($error_email != '') { $class_email = 'focused_error'; } else { $class_email='input-xlarge'; }

if($error_commented_text != '') { $class_commented_text = 'focused_error'; } else { $class_commented_text='input-xxlarge'; }
?>	
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=255162604516860";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	<div class="row ">
				<div class="float_l span13 margin_l">
					
					<div class="">
						<h2 class="course_txt"><?php echo $news_detail['news_title']; ?></h2>
						<div class="float_r"><div class="fb-like" data-href="<?php $_SERVER["REQUEST_URI"]; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div></div>
						<div class="float_l span9 margin_zero">
							<div>
								<h3>Posted Time</h3>
								<div class="date_heading"><?php echo $news_detail['publish_time']; ?></div>
								<h3>Details</h3>
								<?php echo $news_detail['news_detail']; ?>
							</div>
						</div>
						
						<div class="clearfix"></div>
						<div class="margin_t" id="add_more_comment">
							<div class="event_border">
								<h3><?php echo count($news_comments); ?> Comments</h3>
							</div> 
				<?php if(count($news_comments)>0){
						foreach($news_comments as $news_comments_detail){ ?>
							<div class="event_border hover_delete_comment_<?php echo $news_comments_detail['comment_id']; ?>" >
								<div class="float_l">
									<div class="comment_img">
									<?php if($news_comments_detail['user_pic_path']==''){?>
										<img src="<?php echo "$base$img_path"; ?>/user_model.png" />
								<?php } else { ?>		
								<img src="<?php echo "$base"; ?>uploads/<?php echo $news_comments_detail['user_pic_path']; ?>" />
								<?php } ?>
									</div>
								</div>
								<div>
			<?php if($user_is_logged_in ){
			if($user_detail['user_id']==$news_comments_detail['user_id'])
			{
			?>					
			<span class="float_r delete_comment" >
					<img style="cursor:pointer" onclick='delete_this_comment("<?php echo $news_comments_detail['comment_id']; ?>")' src="<?php echo "$base$img_path";?>/close.jpg">
			</span>
			<?php	} } ?>				
									<h4 ><a href="#" class="course_txt">
									<?php if($news_comments_detail['commented_by_user_name']==''){
									echo $news_comments_detail['fullname'];
									}else{
									echo $news_comments_detail['commented_by_user_name']; 
									} ?>
									</a>
									</h4>
									<?php echo $news_comments_detail['commented_text'];?>
<div class="fb-like float_l" data-href="<?php $_SERVER["REQUEST_URI"]; ?>/news_commentid/<?php echo $news_comments_detail['comment_id']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div>
									<div style="font-size;color:black;" class="float_r"><?php
									echo substr($news_comments_detail['comment_time'],0,16);?></div>
								</div>
								<div class="clearfix"></div>
							</div>
				<?php }
}				?>			
						</div>
			<?php if($user_is_logged_in==0){ ?>			
						<div class="margin_t margin_bs">
							<div class="events_box">
								<h3>Your Comment</h3>
								<div class="float_l span9 margin_zero">
									<form class="form-horizontal" method="post" action="">
									<input type="hidden" name="commented_on_id" value="<?php echo $news_detail['news_id']; ?>" >
									<input type="hidden" name="commented_on" value="news" >
									
										<div class="control-group">
											<label class="control-label" for="input01">Name:</label>
											<div class="controls">
												<input type="text" value="<?php if($clear_comment==1){ echo ""; } else{ echo set_value('full_name');} ?>" class="<?php echo $class_fullname; ?>" id="input01" name="full_name">
												<span style="color: red;"> <?php echo form_error('full_name'); ?><?php echo isset($errors['full_name'])?$errors['full_name']:''; ?> </span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="input01">Email:</label>
											<div class="controls">
												<input type="text" value="<?php if($clear_comment==1){ } else{ echo set_value('email');} ?>" class="<?php echo $class_email; ?>" id="input01" name="email">
												<span style="color: red;"> <?php echo form_error('email'); ?><?php echo isset($errors['email'])?$errors['email']:''; ?> </span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="textarea">Comment:</label>
											<div class="controls">
												<textarea class="<?php echo $class_commented_text; ?>" id="textarea" name="commented_text" rows="3">
												<?php if($clear_comment==1){ echo ""; } else{ echo set_value('commented_text');} ?></textarea>
												<span style="color: red;"> <?php echo form_error('commented_text'); ?><?php echo isset($errors['commented_text'])?$errors['commented_text']:''; ?> </span>
											</div>
										</div>
										<div class="control-group">
											<div class="controls">
												<input type="submit" class="btn btn-success" name="submit" value="Post Comment">
											</div>
										</div>
									</form>
								</div>
								<div class="float_r">
									Have an account? <a href="<?php echo $base; ?>login">Log In</a> OR <a href="<?php echo $base; ?>register">Sign Up</a>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
		<?php } else { ?>	
			<div class="margin_t margin_bs">
							<div class="events_box">
							<div class="float_l">
									<div class="comment_img">
									<?php if($user)
									{ ?>
									<img src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=small">
									<?php }
									else if($user_detail['user_pic_path']==''){?>
										<img src="<?php echo "$base$img_path"; ?>/user_model.png" />
								<?php } else { ?>		
								<img src="<?php echo "$base"; ?>uploads/<?php echo $user_detail['user_pic_path']; ?>" />
								<?php } ?>
									</div>
								</div>
								<div class="float_l span9 margin_zero">
									<form class="form-horizontal" method="post" action="">
									<input type="hidden" name="commented_on_id" id="commented_on_id" value="<?php echo $news_detail['news_id']; ?>" >
									<input type="hidden" name="commented_on" id="commented_on" value="news" >
										<div class="control-group">
											<div class="my_form_controls">
												<textarea class="<?php echo $class_commented_text; ?>" id="commented_text" name="commented_text" rows="3">
												</textarea>
											</div>
										</div>
										<div class="control-group">
											<div class="my_form_controls">
												<input type="button" onclick="post_comment();" class="btn btn-success" name="submit" value="Post Comment">
											</div>
										</div>
									</form>
								</div>
								
								<div class="clearfix"></div>
							</div>
						</div>
		<?php } ?>
					</div>
				</div>
				<div class="float_r span3">
					<img src="images/banner_img.png">
				</div>
				<div class="clearfix"></div>
				
</div>
</div>
<script>
function post_comment()
{
var commentedtext=$('#commented_text').val();
var commentd_on=$('#commented_on').val()
var commented_on_id=$('#commented_on_id').val();
if($('#commented_text').val()!='')
{
	$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>univ/post_comment",
	   async:false,
	   data: 'commented_text='+commentedtext+'&commentd_on='+commentd_on+'&commented_on_id='+commented_on_id,
	   cache: false,
	   success: function(msg)
	   {
		
		$(".event_border:last").after(msg);
		$('#commented_text').val('');
		}
	   });
}	   
}

/*$('.hover_delete_comment').hover(
                function () {
                 $(this).find('.delete_comment').css('display','block'); 				 
                },
                function () {
				 $(this).find('.delete_comment').css('display','none');  	   	
                }
            );*/
function delete_this_comment(comment_id)
{
var r=confirm("Want to Delete this comment");
if(r)
{
$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>univ/delete_comment",
	   async:false,
	   data: 'comment_id='+comment_id,
	   cache: false,
	   success: function(msg)
	   {
		$('.hover_delete_comment_'+comment_id).replaceWith('');
		}
	   });
}
}			
</script>