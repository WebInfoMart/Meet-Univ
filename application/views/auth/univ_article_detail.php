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
		<div class="float_l span13 margin_l">
			<div class="span9 margin_zero">
				<div class="fix_h3"><h3><?php echo $articles_detail['article_title']; ?></h3></div>
				<div><img src="<?php echo base_url(); ?>images/clock.png" class="line_img inline"><span class=" line_time"><abbr class="timeago time_ago inline" title="<?php echo $articles_detail['publish_time']; ?>"></span></abbr></div>
				<div class="margin_t1">
					<div class="float_l margin_r2 img_style aspectcorrect">
							<?php
							$image_exist=0;	
							$article_img = $articles_detail['article_image_path'];	
							if(file_exists(getcwd().'/uploads/news_article_images/'.$article_img) && $article_img!='')	
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
							$img_arr=$this->searchmodel->set_the_image($width,$height,106,71,TRUE);
							?>

					<img style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" src="<?php echo $image; ?>">
					</div>
					<div class="margin_l justify">
						<?php echo $articles_detail['article_detail']; ?>
					</div>
				</div>
						<div class="margin_t1">
						<div class="event_border">
						<input type="hidden" id="txt_cnt_comment_show" value="<?php echo $total_comment; ?>"/>
							<h3><span id="cnt_comment_show"><?php if($total_comment==0){ echo "No"; } else { echo $total_comment;} ?></span> Comments Yet</h3>
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
												<input type="button" onclick="post_comment();" class="btn btn-success" name="submit" value="Post Comment">
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
		<input type="hidden" name="commented_on_id" id="commented_on_id" value="<?php echo $articles_detail['article_id']; ?>" >
		<input type="hidden" name="commented_on" id="commented_on" value="article" >
		<input type="hidden"  id="lastcommentid" value="0" >
													
					</div>
			<div class="float_l span4">	
				<div class="social_set float_r">
					<div id="gp" class="float_l">
					<g:plusone size='medium' id='shareLink' annotation='none' href='<?php $_SERVER["REQUEST_URI"]; ?>' callback='countGoogleShares' data-count="true"></g:plusone>
					</div>
					<div id="tw" class="float_l tw"><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php $_SERVER["REQUEST_URI"]; ?>" data-via="munjal_sumit">Tweet</a>
					</div>
					<div id="fb" class="float_r fb"><div class="fb-like" data-href="<?php $_SERVER["REQUEST_URI"]; ?>" data-send="false" data-layout="button_count" data-width="10" data-show-faces="true" ></div></div>
				</div>
				
				
				<div class="clearfix"></div>
				<div class="back_up">
						<h3><img src="<?php echo base_url(); ?>images/home_cal.gif" style="z-index: 100;position: relative;top:6px;"><span style="position: relative;left: 10px;">Recently Added</span></h3>
						<ul class="up_event">
								<?php
								$articles=0;					
					foreach($recent_articles as $recent_articles_detail) {
					if($articles==5)
					{
					break;
					}					
					$article_link=$this->subdomain->genereate_the_subdomain_link(
								$recent_articles_detail['subdomain_name'],'articles',$recent_articles_detail['article_title'],$recent_articles_detail['article_id']);
								?>
									<li>
									
							<a href="<?php echo $article_link; ?>">
							<?php echo $recent_articles_detail['article_title']; ?>
							</a>		
									</li>
							<?php 
							$articles++;
							} ?>		
								</ul>
				</div>
			</div>
		<div class="clearfix"></div>
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
var span_comment_incr = parseInt(span_comment)+1;
var user_id='<?php echo $this->ci->session->userdata('user_id'); ?>';
var lastpostcommentid=$('#lastcommentid').val();
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
var r=confirm("Do you want to delete the comment?");
var span_comment = $('#txt_cnt_comment_show').val();
var span_comment_incr = parseInt(span_comment) - 1;
if(span_comment_incr=='0')
{
span_comment_incr='No';
}
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

$('#show_more').click(function()
{
$('#show_more').text('Loading..');
var commentd_on=$('#commented_on').val();
var commented_on_id=$('#commented_on_id').val();
var offset=$('#show_more_offset').val();
offset=parseInt(offset);
var lastpostcommentid=$('#lastcommentid').val();
$('#show_more_offset').val(offset+1);
var data={'commented_on':commentd_on,'commented_on_id':commented_on_id,'offset':offset,'lastpostcommentid':lastpostcommentid};
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
jQuery(document).ready(function() {
 jQuery("abbr.timeago").timeago();
});			
</script>