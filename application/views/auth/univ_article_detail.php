<?php
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
	<div class="row" style="margin-top:-10px">
				<div class="float_l span13 margin_l">
				
						<div class="">
						<h2 class="course_txt span10 margin_delta"><?php echo $articles_detail['article_title']; ?></h2>
						<div class="float_r" style="margin-top:25px;">
						<div class="float_l" style="margin-right:-25px;">
						<g:plusone size='medium' id='shareLink' annotation='none' href='<?php $_SERVER["REQUEST_URI"]; ?>' callback='countGoogleShares' data-count="true"></g:plusone>
						</div>
						<div class="float_l"><div class="fb-like" data-href="<?php $_SERVER["REQUEST_URI"]; ?>" data-send="false" data-layout="button_count" data-width="10" data-show-faces="true" ></div></div>
						<div class="float_l">
							<a href="https://twitter.com/share" class="twitter-share-button" data-via="munjal_sumit" data-count="none">Tweet</a>
						
						</div>
						</div>
						<div class="float_l span9 margin_zero">
							<div>
								<div class="date_heading">
								<span><abbr class="timeago time_ago" title="<?php echo $articles_detail['publish_time']; ?>"></abbr>
							</span></div>
							</div>
						</div>
						<div class="clearfix"></div>
						<div>
							<h3>Details</h3>
							<div class="float_l margin_r2">
							<?php
									$image_exist=0;	
									$article_img = $articles_detail['article_image_path'];	
									if(file_exists(getcwd().'/uploads/univ_gallery/'.$article_img) && $article_img!='')	
									{
									$image_exist=1;
								   list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/news_article_images/'.$article_img);
									}
									else if(file_exists(getcwd().'/uploads/univ_gallery/'.$articles_detail['univ_logo_path']) && $articles_detail['univ_logo_path']!='')
									{
									$image_exist=2;
								   list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/univ_gallery/'.$articles_detail['univ_logo_path']);
									
									}
									else
									{
									list($width, $height, $type, $attr) = getimagesize(getcwd().'/'.$img_path.'/default_logo.png');
								    }
									if($article_img!='' && $image_exist==1)
									{
									$image=$base.'uploads/news_article_images/'.$article_img;
									}
									else if($articles_detail['univ_logo_path']!='' && $image_exist==2)
									{
									$image=$base.'uploads/univ_gallery/'.$articles_detail['univ_logo_path'];
									}
									else
									{
									$image=$base.$img_path.'/default_logo.png';
									} 
									$img_arr=$this->searchmodel->set_the_image($width,$height,80,80,TRUE);
									?>

							<img style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" src="<?php echo $image; ?>">
							
								
							</div>
							<div>
								<?php echo $articles_detail['article_detail']; ?>
								
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="margin_t" id="add_more_comment">
							<div class="event_border">
							<input type="hidden" id="txt_cnt_comment_show" value="<?php echo count($article_comments); ?>"/>
								<h3><span id="cnt_comment_show"><?php if($article_comments!=0) { count($article_comments); }
								else { echo "0"; }
								?></span> Comments</h3>
							</div> 
				<?php if($article_comments!=0){
						foreach($article_comments as $article_comments_detail){ ?>
							<div class="event_border hover_delete_comment_<?php echo $article_comments_detail['comment_id']; ?>" >
								<div class="float_l">
									<div class="comment_img">
									<?php if($article_comments_detail['user_pic_path'] !=''){ ?>
									<img src="<?php echo "$base"; ?>uploads/<?php echo $article_comments_detail['user_pic_path']; ?>" />
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
			if($user_detail['user_id']==$article_comments_detail['user_id'])
			{
			?>					
			<span class="float_r delete_comment" >
					<img style="cursor:pointer;width: 10px;height: 10px;" class="del_icon" onclick='delete_this_comment("<?php echo $article_comments_detail['comment_id']; ?>")' src="<?php echo "$base$img_path";?>/close.jpg">
			</span>
			<?php	} } ?>				
									<h4 ><a href="#" class="course_txt">
									<?php 
									if($article_comments_detail['commented_by_user_name'] !=''){
									echo $article_comments_detail['commented_by_user_name']; 
									}
									else if($article_comments_detail['fullname'] !='')
									{
										echo $article_comments_detail['fullname'];
									}
									else if($user)
									{
										echo $user_profile['name'];
									}
									?>
									</a>
									</h4>
									<span><?php echo $article_comments_detail['commented_text'];?></span>
									
									<div style="font-size;color:black;" class="float_r">
									<abbr class="timeago time_ago" title="<?php echo $article_comments_detail['comment_time']; ?>"></abbr></div>
								</div>
								<div class="clearfix"></div>
							</div>
				<?php }
}				?>			
						</div>
			<?php if($user_is_logged_in==0){ ?>			
			<div class="events_box" style="height: 53px;">
				<div class="float_r">
					Have an account? <a href="<?php echo $base; ?>login">Log In</a> OR <a href="<?php echo $base; ?>register">Sign Up</a>
				</div>
				<div class="float_l" style="margin-top: 30px; margin-left: 311px;">
				<center><h3>Please Login for comment</h3></center>
				</div>
				</div>
						<!--<div class="margin_t margin_bs">
							<div class="events_box">
								<h3>Your Comment</h3>
								<div class="float_l span9 margin_zero">
									<form class="form-horizontal" method="post" action="">
									<input type="hidden" name="commented_on_id" value="<?php echo $articles_detail['article_id']; ?>" >
									<input type="hidden" name="commented_on" value="article" >
									
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
						</div>-->
		<?php } else { ?>	
			<div class="margin_t margin_bs">
							<div class="events_box">
							<div class="float_l">
									<div class="comment_img">
									<?php if($user_detail['user_pic_path'] !=''){?>
									<img src="<?php echo "$base"; ?>uploads/<?php echo $user_detail['user_pic_path']; ?>" />
										
									<?php }
									else if($user)
									{ ?>
									<img src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=small">
									<?php } else { ?>		
								<img src="<?php echo "$base$img_path"; ?>/user_model.png" />
								<?php }  ?></br>
								<span style='float: left;width: 46px;position: absolute;'>
								<?php
								if($user_detail['fullname'] !='')
								{
									echo $user_detail['fullname'];
								}
								else if($user)
								{
									echo $user_profile['name'];
								}
								?>
								</span>
									</div>
								</div>
								<div class="float_l span9 margin_zero">
									<form class="form-horizontal" method="post" action="">
									<input type="hidden" name="commented_on_id" id="commented_on_id" value="<?php echo $articles_detail['article_id']; ?>" >
									<input type="hidden" name="commented_on" id="commented_on" value="article" >
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
var span_comment = $('#txt_cnt_comment_show').val();
var span_comment_incr = parseInt(span_comment) + 1;
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
		$('#txt_cnt_comment_show').val(parseInt(span_comment)+1);
		$('#cnt_comment_show').html(span_comment_incr);
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
var span_comment = $('#txt_cnt_comment_show').val();
var span_comment_incr = parseInt(span_comment) - 1;
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
		$('#txt_cnt_comment_show').val(parseInt(span_comment)-1);
		$('#cnt_comment_show').html(span_comment_incr);
		}
	   });
}
}			
</script>	