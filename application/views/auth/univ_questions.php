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
<!--<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=255162604516860";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>-->

<div class="row" style="margin-top:-20px">
	<div>
	
		<div class="float_l span13 margin_l">
		<div class="float_r" >
				<div class="float_l" style="margin-right:20px;">	
				<g:plusone size='medium' id='shareLink' annotation='none' href='<?php $_SERVER["REQUEST_URI"]; ?>' callback='countGoogleShares' data-count="true"></g:plusone>
				</div>
				
				<div class="float_l" style="margin-left:10px;"><div class="fb-like" data-href="<?php $_SERVER["REQUEST_URI"]; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div></div>
				<div class="float_l">
				<a href="https://twitter.com/share" class="twitter-share-button" data-via="munjal_sumit" data-count="none">Tweet</a>
				</div>
				<div class="clearfix"></div>
				</div>
			<div>
				<div class="float_l span12 margin_zero">
				<h3>Question:<span class="heading_follow"> <?php echo $single_quest['q_title'] ? $single_quest['q_title'] : 'Question Has been removed !' ; ?></span></h3>
				<?php echo "Asked By : "; echo $single_quest['fullname'] ? $single_quest['fullname'] : 'Name Not available'; ?>
				</div>
				
				<div class="clearfix"></div>
			</div>
			<div>
				<div class="margin_t1">
					<div class="float_l span1" style="margin-right:20px;">
						<?php 
						if($single_quest['user_pic_path']!= '')
						{
						
						echo "<img class='question_user' src='".base_url()."uploads/".$single_quest['user_pic_path']."'/>";
						}
						else {
						echo "<img style='width:40px;height:40px;' src='".base_url()."images/user_model.png'/>" ;
						}
						?>
					</div>
					<div>
						<?php echo $single_quest['q_detail']; ?><br/>
						<div class="float_r margin_t1" style="color:#000" >
						<abbr class="timeago time_ago" title="<?php echo $single_quest['q_asked_time'] ?>"></abbr>
				
						</div>
					</div>
				<div class="clearfix"></div>
				</div>
				
				
				<div class="clearfix"></div>
						<div class="margin_t" id="add_more_comment">
							<div class="event_border">
							<input type="hidden" id="txt_cnt_comment_show" value="<?php if(!empty($question_comments)) { echo count($question_comments); } else { echo "0"; } ?>"/>
								<h3><span id="cnt_comment_show"><?php if(!empty($question_comments)) { echo count($question_comments); } else { echo "0"; } ?></span> Comments</h3>
							</div> 
				<?php 
				if(!empty($question_comments))
				{
				if(count($question_comments)>0){
						foreach($question_comments as $question_comments_detail){ ?>
							<div class="event_border hover_delete_comment_<?php echo $question_comments_detail['comment_id']; ?>" >
								<div class="float_l">
									<div class="comment_img">
									<?php if($question_comments_detail['user_pic_path'] !=''){ ?>
									<img src="<?php echo "$base"; ?>uploads/<?php echo $question_comments_detail['user_pic_path']; ?>" />
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
			if($user_detail['user_id']==$question_comments_detail['user_id'])
			{
			?>					
			<span class="float_r delete_comment" >
					<img style="cursor:pointer" class="del_icon" onclick='delete_this_comment("<?php echo $question_comments_detail['comment_id']; ?>")' src="<?php echo "$base$img_path";?>/close.jpg">
			</span>
			<?php	} } ?>				
									<h4 ><a href="#" class="course_txt">
									<?php if($question_comments_detail['commented_by_user_name'] !=''){
									echo $question_comments_detail['commented_by_user_name']; 
									}
									else if($question_comments_detail['fullname'] !='')
									{
										echo $question_comments_detail['fullname'];
									}
									else if($user)
									{
										echo $user_profile['name'];
									} ?>
									</a>
									</h4>
									<?php echo $question_comments_detail['commented_text'];?>

									<div style="font-size;color:black;" class="float_r"><?php
									echo substr($question_comments_detail['comment_time'],0,16);?></div>
									<div class="float_r">
									<div class="float_l">
									<div class="fb-like" data-href="<?php $_SERVER["REQUEST_URI"]; ?>/que_commentid/<?php echo $question_comments_detail['comment_id']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div>
									</div>
									<div class="float_l" style="margin-right: 22px;">
									<g:plusone size='medium' id='shareLink' annotation='none' href='<?php $_SERVER["REQUEST_URI"]; ?>/que_commentid/<?php echo $question_comments_detail['comment_id']; ?>' callback='countGoogleShares' data-count="true"></g:plusone>
									</div>
									<div class="float_r">
									<a href="https://twitter.com/share" style="width: 82px;" class="twitter-share-button" data-url="<?php $_SERVER["REQUEST_URI"]; ?>/que_commentid/<?php echo $question_comments_detail['comment_id']; ?>" data-via="munjal_sumit" data-lang="en">Tweet</a>
									</div>
								</div>
								</div>
								<div class="clearfix"></div>
							</div>
				<?php }
				} }				
				?>			
						</div>
			<?php 
			//if(!empty($user_is_logged_in)) {
			if($user_is_logged_in == 0){ ?>		
			<div class="events_box" style="height: 53px;">
				<div class="float_r">
					Have an account? <a href="<?php echo $base; ?>login">Log In</a> OR <a href="<?php echo $base; ?>register">Sign Up</a>
				</div>
				<div class="float_l" style="margin-top: 30px; margin-left: 311px;">
				<center><h3>Please Login for comment</h3></center>
				</div>
				</div>			
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
								<?php } ?>
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
									<input type="hidden" name="commented_on_id" id="commented_on_id" value="<?php echo $single_quest['que_id']; ?>" >
									<input type="hidden" name="commented_on" id="commented_on" value="qna" >
										<div class="control-group">
											<div class="my_form_controls">
												<textarea class="<?php echo $class_commented_text; ?>" id="commented_text" name="commented_text" rows="3"></textarea>
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
		<?php } //} ?>
					</div>
				</div>
				<div class="float_r span3">
					
					<img src="<?php echo $base; ?>images/banner_img.png">
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
var user_id='<?php echo $this->ci->session->userdata('user_id'); ?>';
if($('#commented_text').val()!='')
{
	$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>univ/post_comment",
	   async:false,
	   data: 'commented_text='+commentedtext+'&commentd_on='+commentd_on+'&commented_on_id='+commented_on_id+'&user_id='+user_id,
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
var user_id='<?php echo $this->ci->session->userdata('user_id'); ?>';
if(r)
{
$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>univ/delete_comment",
	   async:false,
	   data: 'comment_id='+comment_id+'&user_id='+user_id,
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