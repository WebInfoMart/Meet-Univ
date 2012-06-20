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
					
					<div class="span9 margin_zero">
						<h3><?php echo $news_detail['news_title']; ?></h3>
						<!--<div><img src="<?php echo base_url(); ?>images/group.png" class="line_img inline"><span class="blue line_time inline">Total Registered Users:<?php echo $total_register_user; ?></span></div>-->
						<div><img src="<?php echo base_url(); ?>images/clock.png" class="line_img inline"><span class=" line_time"><abbr class="timeago time_ago inline" title="<?php echo $news_detail['publish_time']; ?>"></span></abbr></div>
						<?php echo $news_detail['news_detail']; ?>
						
						<div class="clearfix"></div>
						<div class="margin_t" id="add_more_comment">
							<div class="event_border">
							<input type="hidden" id="txt_cnt_comment_show" value="<?php if($news_comments!=0){ echo count($news_comments); } else { echo "0";}; ?>"/>
								<h3><span id="cnt_comment_show"><?php if($news_comments!=0){ echo count($news_comments); } else { echo "0";}; ?></span> Comments</h3>
							</div> 
				<?php if($news_comments!=0){
						foreach($news_comments as $news_comments_detail){ ?>
							<div class="event_border hover_delete_comment_<?php echo $news_comments_detail['comment_id']; ?>" >
								<div class="float_l comment_img center">
									<?php if($news_comments_detail['user_pic_path'] !=''){ ?>
									<img src="<?php echo "$base"; ?>uploads/<?php echo $news_comments_detail['user_pic_path']; ?>" />
									<?php } 
									else if($user) { ?>
								<img src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=small">
								<?php } 
									else { ?>		
									<img src="<?php echo "$base$img_path"; ?>/user_model.png" />
									<?php } ?>
									<h4 ><span>
									<?php 
									if($news_comments_detail['commented_by_user_name'] !=''){
									echo $news_comments_detail['commented_by_user_name']; 
									}
									else if($news_comments_detail['fullname'] !='')
									{
										echo $news_comments_detail['fullname'];
									}
									else if($user)
									{
										echo $user_profile['name'];
									}
									?>
									</span>
									</h4>
								</div>
								<?php if($user_is_logged_in ){
			if($user_detail['user_id']==$news_comments_detail['user_id'])
			{
			?>	
			
			<span class="float_r delete_comment" >
					<img style="cursor:pointer" class="del_icon" onclick='delete_this_comment("<?php echo $news_comments_detail['comment_id']; ?>")' src="<?php echo "$base$img_path";?>/close.jpg">
			</span>
			<div>
									<abbr class="timeago time_ago" title="<?php echo $news_comments_detail['comment_time']; ?>"></abbr></div>
			<?php	} } ?>	
								<div class="span6 margin_zero">
									<?php echo $news_comments_detail['commented_text'];?>
								</div>
								<div class="clearfix"></div>
							</div>
				<?php }
}				?>			
						</div>
			<?php if($user_is_logged_in==0){ ?>	
		<div class="margin_t margin_b">
			<div class="events_box" style="height: 53px;">
				<div>
					<div class="float_r">
						Have an account? <a href="<?php echo $base; ?>login">Log In</a> OR <a href="<?php echo $base; ?>register">Sign Up</a>
					</div>
					<div class="clearfix"></div>
				</div>
				<h3 class="center">Please Login for comment</h3>
			</div>	
		</div>
		<?php } else { ?>	
			<div class="margin_t margin_b">
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
								<?php }  ?>
								<div class="center comment_style">
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
								</div>
									</div>
								<p>		
								</div>
								<div class="float_l span6 margin_zero">
									<form class="form-horizontal" method="post" action="">
									<input type="hidden" name="commented_on_id" id="commented_on_id" value="<?php echo $news_detail['news_id']; ?>" >
									<input type="hidden" name="commented_on" id="commented_on" value="news" >
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
		<?php } ?>
					</div>
					<div class="span4">
						<div class="float_r">
							<div class="float_l fb_set"><div class="fb-like" data-href="<?php $_SERVER["REQUEST_URI"]; ?>" data-send="false" data-layout="button_count" data-width="10" data-show-faces="true" ></div></div>
							<div class="float_l">
							<!--<g:plusone size="medium" annotation="none"></g:plusone>-->
							<g:plusone size='medium' id='shareLink' annotation='none' href='<?php $_SERVER["REQUEST_URI"]; ?>' callback='countGoogleShares' data-count="true"></g:plusone>
							</div>
							<div class="float_r tw" style="width:82px;">
								<a href="https://twitter.com/share" class="twitter-share-button" data-via="munjal_sumit" data-count="none">Tweet</a>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
						<div class="back_up">
						<h3><img src="<?php echo base_url(); ?>images/home_cal.gif" style="z-index: 100;position: relative;top:6px;"><span style="position: relative;left: 10px;">Recently Added</span></h3>
								<ul class="up_event">
								<?php
								$news=0;					
					foreach($recent_news as $recent_news_detail) {
					if($news==6)
					{
					break;
					}					
					$news_link=$this->subdomain->genereate_the_subdomain_link(
								$recent_news_detail['subdomain_name'],'news',$recent_news_detail['news_title'],$recent_news_detail['news_id']);
								?>
									<li>
									
							<a href="<?php echo $news_link; ?>">
							<?php echo substr($recent_news_detail['news_title'],0,60).'..'; ?>
							</a>		
									</li>
							<?php 
							$news++;
							} ?>		
								</ul>
					</div>
					</div>
				</div>
				<div class="float_r span3">
					<img src="<?php echo "$base$img_path"; ?>/banner_img.png">
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
jQuery(document).ready(function() {
 jQuery("abbr.timeago").timeago();
});			
</script>