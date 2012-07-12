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
		<div class="float_l span13 margin_l">
			<div class="float_l span9 margin_delta margin_t">
				<div class="float_l comment_img margin_delta" style="margin-right:10px;">
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
					<span class="heading_follow"> <?php echo $single_quest['q_title'] ? $single_quest['q_title'] : 'Question Has been removed !' ; ?></span>
					<h4 style="margin-left: 12px;"><?php echo "Asked By : "; echo $single_quest['fullname'] ? $single_quest['fullname'] : 'Name Not available'; ?></h4>
					<div style="margin-left: 12px;"><img src="<?php echo "$base$img_path" ?>/clock.png" class="line_img inline"><span class="line_time"><abbr class="timeago time_ago" title="<?php echo $single_quest['q_asked_time'] ?>"></abbr></span>
					</div>
				</div>
				<div class="margin1">
						<?php echo $single_quest['q_detail']; ?><br/>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="float_l span4">
				<div class="social_set">
					<div class="float_l">	
						<g:plusone size='medium' id='shareLink' annotation='none' href='<?php $_SERVER["REQUEST_URI"]; ?>' callback='countGoogleShares' data-count="true"></g:plusone>
					</div>
					<div class="float_l tw">
						<a href="https://twitter.com/share" class="twitter-share-button" data-via="munjal_sumit">Tweet</a>
					</div>
					<div class="float_r fb"><div class="fb-like" data-href="<?php $_SERVER["REQUEST_URI"]; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div></div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div>
				
						<div class="margin_t" id="add_more_comment">
						<!--<div class="event_border">
							<input type="hidden" id="txt_cnt_comment_show" value="<?php //if(!empty($question_comments)) { echo count($question_comments); } else { echo "0"; } ?>"/>
								<h3><span id="cnt_comment_show"><?php //if(!empty($question_comments)) { echo count($question_comments); } else { echo "0"; } ?></span> Comments</h3>
							</div> -->
						
						</div>
						<div class="fb-comments" data-href="http://<?php echo $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"] ;?>" data-num-posts="2" data-width="500"></div>			
							<!--<fb:comments href="http://<?php echo $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"] ;?>" width='640' publish_feed='true' migrated='1'></fb:comments>-->
		
					</div>
			</div>
				<div class="float_r span3">
					
					<img src="<?php echo $base; ?>images/banner_img.png">
				</div>

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