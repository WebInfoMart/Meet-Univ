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

<div class="container">
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
							<input type="hidden" id="txt_cnt_comment_show" value="<?php if(!empty($question_comments)) { echo count($question_comments); } else { echo "0"; } ?>"/>
								<h3><span id="cnt_comment_show"><?php if(!empty($question_comments)) { echo count($question_comments); } else { echo "0"; } ?></span> Comments</h3>
							</div>
			
							
						</div>
						<!--<div class="fb-comments" data-href="http://<?php //echo $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"] ;?>" data-num-posts="2" data-width="500"></div>-->
				<div class="clearfix"></div>
				</div>
				</div>
				
				<div class="clearfix"></div>
			</div>
			<div class="float_r span3">
				<img src="<?php echo "$base$img_path"; ?>/banner_img.png">
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
		
</script>
<script>
/*input.focus(); //sets focus to element
var val = this.input.value; //store the value of the element
this.input.value = ''; //clear the value of the element
this.input.value = val; //set that value back.*/  
</script>