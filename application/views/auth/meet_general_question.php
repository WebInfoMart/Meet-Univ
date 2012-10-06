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

<div id="id_for_news_comment" class="row" style="margin-top:-10px">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
		<div class="row margin_t1">
			<div class="float_l span13 margin_l">
				<div class="float_l span9 margin_zero">
					<div>
						<div class="float_l comment_img margin_delta" style="margin-right:10px;">
							<?php
							$logged_user_id = $this->tank_auth->get_user_id();
							if(file_exists(getcwd().'/uploads/user_pic/thumbs/'.$single_quest['user_thumb_pic_path']) && $single_quest['user_thumb_pic_path']!='' )
							{
							//echo $image_thumb = $profile_pic['user_pic_path'].'_thumb';
							
								echo "<img class='question_user' src='".base_url()."uploads/user_pic/thumbs/".$single_quest['user_thumb_pic_path']."'/>";
							}
							else if(file_exists(getcwd().'/uploads/user_pic/'.$single_quest['user_pic_path']) && $single_quest['user_pic_path']!='')
							{
								echo "<img class='question_user' src='".base_url()."uploads/user_pic/".$single_quest['user_pic_path']."'/>";
							}
							else if($user && $single_quest['q_askedby'] == $logged_user_id)
							{
							?>
								<img src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=small">
							<?php
							}
							else{
							echo "<img style='width:40px;height:40px;' src='".base_url()."images/profile_icon.png'/>";
							}
							?>
						</div>
						<div class="float_l span8 margin_delta">
							<span class="heading_follow"> <?php echo $single_quest['q_title'] ? $single_quest['q_title'] : 'Question Has been removed !' ; ?></span>
							<h4 style="margin-left: 12px;"><?php echo "Asked By : "; echo $single_quest['fullname'] ? $single_quest['fullname'] : 'Name Not available'; ?></h4>
							<div style="margin-left: 12px;"><img src="<?php echo "$base$img_path" ?>/clock.png" class="line_img inline"><span class="line_time"><abbr class="timeago time_ago" title="<?php echo $single_quest['q_asked_time'] ?>"></abbr></span>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
						<?php echo $single_quest['q_detail']; ?><br/>
					<div class="margin_t1">
					<div class="clearfix"></div>
					<div class="margin_t" id="add_more_comment">
							<div class="event_border">
						<input type="hidden" id="txt_cnt_comment_show" value="<?php echo $total_comment; ?>"/>
							<h3><span id="cnt_comment_show"><?php if($total_comment==0){ echo "No"; } else { echo $total_comment;} ?></span> Answers Yet</h3>
						</div>		
							
						</div>
						
				<div class="span9 margin_delta">
						<?php 
							if($article_comments!=0){
							$logged_user_id = $this->tank_auth->get_user_id(); 
						foreach($article_comments as $article_comment_detail){ ?>
						<div class="event_border find_comment hover_delete_comment_<?php echo $article_comment_detail['comment_id']; ?>">
							<div class="float_l comment_img">
								<?php
							if(file_exists(getcwd().'/uploads/user_pic/thumbs/'.$article_comment_detail['user_thumb_pic_path']) && $article_comment_detail['user_thumb_pic_path']!='' )
							{
							//echo $image_thumb = $profile_pic['user_pic_path'].'_thumb';
							
								echo "<img src='".base_url()."uploads/user_pic/thumbs/".$article_comment_detail['user_thumb_pic_path']."'/>";
							}
							else if(file_exists(getcwd().'/uploads/user_pic/'.$article_comment_detail['user_pic_path']) && $article_comment_detail['user_pic_path']!='')
							{
								echo "<img src='".base_url()."uploads/user_pic/".$article_comment_detail['user_pic_path']."'/>";
							}
							else if($user && $article_comment_detail['commented_by'] == $logged_user_id)
							{
							?>
								<img src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=small">
							<?php
							}
							else{
							echo "<img src='".base_url()."images/profile_icon.png'/>";
							}
							?>
							<h4 class="center">
								<?php if($article_comment_detail['commented_by_user_name'] !=''){
									echo $article_comment_detail['commented_by_user_name']; 
									}
									else if($article_comment_detail['fullname'] !='')
									{
										echo $article_comment_detail['fullname'];
									}
									else if($user)
									{
										echo $user_profile['name'];
									} ?>
							</h4>
							</div>
							<div class="word">
							<?php if($user_is_logged_in ){
			if($user_detail['user_id']==$article_comment_detail['user_id'])
			{
			?>					
			<!--<span class="float_r delete_comment">
					<img style="cursor:pointer;" class="del_icon" onclick='delete_this_comment("<?php //echo $article_comment_detail['comment_id']; ?>")' src="<?php //echo "$base$img_path";?>/close.jpg">
			</span>-->
			<?php	} } ?>	
								
								<?php echo $article_comment_detail['commented_text'];?>
								
							</div><br/>
							<div class="float_r span2 margin_delta">
								<abbr class="timeago time_ago" title="<?php echo $article_comment_detail['comment_time']; ?>"></abbr>
							</div>
							<div class="clearfix"></div>
							
						</div> <?php } } ?>
					</div>
					</div>
					<?php if($total_comment>4) { ?>
					<div  id="show_more">show more comment</div>
					<input type="hidden" id="show_more_offset" value="1">
					<?php } ?>
					<div class="clearfix"></div>
					<div class="margin_t margin_b">
						<?php if($user_is_logged_in==0){ ?>		
						<div class="events_box" style="height: 53px;">
							<div>
							<div class="float_r">
								Have an account? <a href="<?php echo $base; ?>login">Log In</a> OR <a href="<?php echo $base; ?>register">Sign Up</a>
							</div>
							<div class="clearfix"></div>
							</div>
								<h3 class="center">Please Login for comment</h3>
						</div>
						<?php } else { ?>
							<div class="events_box">
							<div class="float_l">
									<div class="comment_img">
									
									<?php
							if(file_exists(getcwd().'/uploads/user_pic/thumbs/'.$user_detail['user_thumb_pic_path']) && $user_detail['user_thumb_pic_path']!='' )
							{
							//echo $image_thumb = $profile_pic['user_pic_path'].'_thumb';
							
								echo "<img src='".base_url()."uploads/user_pic/thumbs/".$user_detail['user_thumb_pic_path']."'/>";
							}
							else if(file_exists(getcwd().'/uploads/user_pic/'.$user_detail['user_pic_path']) && $user_detail['user_pic_path']!='')
							{
								echo "<img src='".base_url()."uploads/user_pic/".$user_detail['user_pic_path']."'/>";
							}
							else if($user)
							{
							?>
								<img src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=small">
							<?php
							}
							else{
							echo "<img src='".base_url()."images/profile_icon.png'/>";
							}
							?>
								<div style='width: 46px;position: absolute;' class="center">
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
								</div>
								<div class="float_l span6 margin_zero">
									<form class="form-horizontal" method="post" action="">
									<div class="control-group">
											<div class="my_form_controls">
												<textarea class="<?php echo $class_commented_text; ?>" id="commented_text" name="commented_text" rows="3"></textarea>
											</div>
										</div>
										<div class="control-group">
											<div class="my_form_controls">
												<input type="button" onclick="post_comment();" class="btn btn-success" name="submit" value="Post Comment">&nbsp;&nbsp;
												<img id="ajax_loader" src="<?php echo $base;?>images/ajax_loader.gif" style="display:none;"/>
											</div>
										</div>
									</form>
								</div>
								<div class="clearfix"></div>
							</div>
						 <?php } ?>	
								<div class="clearfix"></div>
						</div>
		<?php // } ?>
		<input type="hidden" name="commented_on_id" id="commented_on_id" value="<?php echo $single_quest['que_id']; ?>" >
		<input type="hidden" name="commented_on" id="commented_on" value="qna" >
		<input type="hidden"  id="lastcommentid" value="0" >													
					</div>			
			</div>
			<div class="float_r span3">
				<a target="_blank" href="http://university-of-greenwich.meetuniversities.com/university_events"><img src="<?php echo "$base$img_path" ?>/banner_img.png"></a>
			</div>
			
				</div>				
				<div class="clearfix"></div>
				
</div>
<script>

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

function post_comment()
{var url=document.URL;
var commentedtext=$('#commented_text').val();
var commentd_on=$('#commented_on').val()
var commented_on_id=$('#commented_on_id').val();
var span_comment = $('#txt_cnt_comment_show').val();
var span_comment_incr = parseInt(span_comment)+1;
var user_id='<?php echo $this->ci->session->userdata('user_id'); ?>';
var fb_user_id='<?php echo $user; ?>';
var lastpostcommentid=$('#lastcommentid').val();
var data={commented_text:commentedtext,commentd_on:commentd_on,commented_on_id:commented_on_id,user_id:user_id,fb_user_id:fb_user_id,url:url}
if($('#commented_text').val()!='')
{
	$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>univ/post_comment",
	   data: data,
	   beforeSend: function() {
		$("#ajax_loader").show();
          },
	   success: function(msg)
	   {$("#ajax_loader").hide();
	    msgarr=msg.split('!@#$%^&*');
		var lastinsid=parseInt(msgarr[0]);
		if(lastpostcommentid=='0')
		{
		$('#lastcommentid').val(lastinsid);
		}
		$(".event_border:last").after(msgarr[1]);
		$('#commented_text').val('');
		$('#txt_cnt_comment_show').val(parseInt(span_comment)+1);
		$('#cnt_comment_show').html(span_comment_incr);
		}
	   });
}
   
}
$('#show_more').click(function()
{
$('#show_more').text('Loading..');
var commentd_on=$('#commented_on').val();
var commented_on_id=$('#commented_on_id').val();
var offset=$('#show_more_offset').val();
offset=parseInt(offset);
var lastpostcommentid=$('#lastcommentid').val();
$('#show_more_offset').val(offset+1);
var fb_user_id='<?php echo $user; ?>';

var user_id='<?php echo $this->ci->session->userdata('user_id'); ?>';
var data={'user_id':user_id,'commented_on':commentd_on,'commented_on_id':commented_on_id,'offset':offset,'lastpostcommentid':lastpostcommentid,'fb_user_id':fb_user_id };
$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>univ/show_more_comment",
	   async:false,
	   data: data,
	   cache: false,
	   success: function(msg)
	   {
	   msgarr=msg.split('!@#$%^&*');
	   $('#id_for_news_comment').find('.find_comment:last').after(msgarr[1]);
	   if(msgarr[0]=='0')
	   {
	   $('#show_more').hide();
	   }
	   
	   $('#show_more').text('show more comment');

		//	alert(msg.toSource());
	}
	   });
});	
		
</script>
<script>
/*input.focus(); //sets focus to element
var val = this.input.value; //store the value of the element
this.input.value = ''; //clear the value of the element
this.input.value = val; //set that value back.*/  
</script>