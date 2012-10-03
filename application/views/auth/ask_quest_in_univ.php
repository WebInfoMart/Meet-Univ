<?php
 //date_default_timezone_set('Asia/Kolkata');
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
?>
<div class="row" style="margin-top:-30px">
	<div class="float_l span13 margin_l margin_t">
		<h3 class="heading_follow"><?php echo $count_all_question_of_univ; ?> Questions asked on 
	<?php
	echo $get_all_question_of_univ['quest_detail'][0]['univ_name']; ?></h3>
		<div class="modal" id="show_success" style="display:none;" >
			<div class="modal-header">
			<a class="close" data-dismiss="modal"></a>
			<h3>Your Question Has been posted successfully..</h3>
			</div>
		</div>
		<div class="green_box">
			<div>
				<div class="float_l">
					<div class="letter_uni">
					<div>Q Go Ask <br><span>uestion</span></div>
					</div>
				</div>
				<div class="float_r question_ask">
					<span>Have a Question about your career or course?</span>
					<span>Ask our counselors!</span>
				</div>
				<div class="clearfix"></div>
			</div>
			<div id="slides_boxes2">
				<ul class="slider_pagination">
					<li class="current"><a href="#0">Ask a Question </span></a></li><li><a href="#1">Browse More Q & A</a></li>
				</ul>
				<div class="clearfix"></div>
				<div class="slides_container">
					<div>
						<form action="" method="post" class="margin_t">
							<div class="control-group">
								<?php
									if($this->session->userdata('ask_quest_on_univ_page') != '');
									{
									$quest_title = $this->session->userdata('ask_quest_on_univ_page');
									}
									?>
										<input class="input-xxlarge focused" id="quest_title" name="quest_title" type="text" value="<?php echo $quest_title ? $quest_title : ''; ?>">
										<span style="color:red;"> <?php echo form_error('quest_title'); ?><?php echo isset($errors['quest_title'])?$errors['quest_title']:''; ?> </span>
							</div>
							<div class="control-group">
								<label>Describe your question in more detail (optional) </label>
									<textarea class="input-xxlarge" id="quest_detail" name="quest_detail" rows="5"></textarea>
							</div>
							<div class="control-group margin_t1">
								<input type="submit" class="btn btn-success" name="post_quest_on_univ" value="Post Question" />
							</div>
						</form>
					</div>
					<div class="float_l span6 margin_delta margin_t">
						<h3>University Q&A </h3>
						<div class="margin_t1">
							<?php
								if(!empty($get_all_question_of_univ['quest_detail']))
								{
									foreach($get_all_question_of_univ['quest_detail'] as $quest_list)
									{
									if($quest_list['q_univ_id'] != '0')
									{
										$url = "BrowseQuestion/univquest/$quest_list[q_univ_id]";
									}
									else if($quest_list['q_country_id'] != '0')
									{
										$url = "";
									}
									}
									$univ_domain=$this->subdomain->generate_univ_link_by_subdomain($get_all_question_of_univ['quest_detail'][0]['subdomain_name'])	
								?>
							<ul>
								<li>
									<a href="<?php echo $univ_domain; ?>/Browse_Question/All_Questions">Browse All Questions of <?php echo $get_all_question_of_univ['quest_detail'][0]['univ_name']; ?></a>
								</li>
													
							</ul>
							<?php } else { echo "NO More Questions Available..."; } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="quest_div_1" class="margin_t">
			<div id="quest_div_show_right">
				<div>
					<ul class="course_list">
					<?php
					$logged_user_id = $this->tank_auth->get_user_id();
					if(!empty($get_all_question_of_univ))
					{
					$a=0;
					foreach($get_all_question_of_univ['quest_detail'] as $quest_list)
					{
					if($quest_list['q_univ_id'] != '0')
					{
					$univ_domain=$quest_list['subdomain_name'];
					$quest_title=$quest_list['q_title'];
					$quest_title =$this->subdomain->process_url_title($quest_title);	
					$que_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'question',$quest_title,$quest_list['que_id']);
					$url = $que_link;
					}
					else if($quest_list['q_country_id'] != '0' && $quest_list['q_country_id'] != '')
					{
						$url = "";
					}
					?>
					<li>
						<div id="quest_pic" class="float_l">
						
						<?php
							if(file_exists(getcwd().'/uploads/user_pic/thumbs/'.$quest_list['user_thumb_pic_path']) && $quest_list['user_thumb_pic_path']!='' )
							{
							//echo $image_thumb = $profile_pic['user_pic_path'].'_thumb';
							
								echo "<img style='width:40px;height:40px;margin-right:10px;' src='".base_url()."uploads/user_pic/thumbs/".$quest_list['user_thumb_pic_path']."'/>";
							}
							else if(file_exists(getcwd().'/uploads/user_pic/'.$quest_list['user_pic_path']) && $quest_list['user_pic_path']!='')
							{
								echo "<img style='width:40px;height:40px;margin-right:10px;' src='".base_url()."uploads/user_pic/".$quest_list['user_pic_path']."'/>";
							}
							else if($user && $quest_list['q_askedby'] == $logged_user_id)
							{
							?>
								<img style='width:40px;height:40px;margin-right:10px;' src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=small">
							<?php
							}
							else{
							echo "<img style='width:40px;height:40px;margin-right:10px;' src='".base_url()."images/profile_icon.png'/>";
							}
							?>
						
						</div>
						<div class="float_l span8 margin_zero">
							<div class="quest_fix">
								<a href="<?php echo $url; ?>">
									<span>
									<?php
											echo $quest_list['q_title']."</br>";?></span>	
								</a>
											
							</div>
							<div class="blue">
								<span><?php echo "by&nbsp;".$quest_list['fullname']."&nbsp"; ?></span>
							<abbr class="timeago time_ago" title="<?php echo $quest_list['q_asked_time'] ?>"></abbr>
							
							<?php
							if($quest_list['q_country_id'] == '0' and $quest_list['q_univ_id'] != '0')
							{
								echo 'Colleges Category';
							}
							else {
								echo 'Study Abroad Category';
							}?>
							-
							<?php
							$count=$this->quest_ans_model->get_noof_comments($quest_list['que_id']);
							echo $count."&nbsp;Answers&nbsp;" ;
				
				?> 
				
				
						</div>
						</div>	
						<div class="float_r">
							<!--<div class="social_set">
								<div class="float_l">	
									<g:plusone size='medium' id='shareLink' annotation='none' href='<?php echo "$base$url"; ?>' callback='countGoogleShares' data-count="true"></g:plusone>
								</div>
								<div class="float_l tw">
									<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo "$base$url"; ?>" data-via="munjal_sumit" data-count="none">Tweet</a>
								</div>
								<div class="float_r fb"><div class="fb-like" data-href="<?php echo "$base$url"; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div></div>
								<div class="clearfix"></div>
							</div>-->
							<!--<g:plusone size="medium" annotation="none"></g:plusone>-->
						</div>
						<div class="clearfix"></div>
					</li>
					<?php
				$a=$a+1;
				}
				}
				?>
					</ul>
				</div>	
			</div>	
		</div>	
	</div>	
	
	<div class="float_r span3 margin_t">
		<a href="<?php echo $base; ?>register/british_council"><img src="<?php echo "$base$img_path" ?>/banner_img.png"></a>
	</div>
	<div class="clearfix"></div>
</div>	
</div>	
<script type="text/javascript">
$(document).ready(function() {
	var fixed = false;

$(document).scroll(function() {
    if( $(this).scrollTop() >= 50 ) {
        if( !fixed ) {
            fixed = true;
            $('#main-nav-holder').css({position:'fixed',top:140,left:476});
			 $('.row').css({margin-top:0px;});
			// Or set top:20px; in CSS
        }                                           // It won't matter when static
    } else {
        if( fixed ) {
            fixed = false;
            $('#main-nav-holder').css({position:'static'});
        }
    }
});

});

</script>


	<script type="text/javascript">
function fetch_collage(values)
{
var type = values.value;
//alert(type);
//var cid=$("#interest_study_country option:selected").val();
//alert('asas');
if(type == 'col')
{
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>quest_ans_controler/collage_list_ajax",
   data: '',
   cache: false,
   success: function(msg)
   {
	//alert(msg.toSource());
	//alert('sadadsad');
    //$('#collages').attr('disabled', false);
	$('#collages').html(msg);
   }
   });
 }
 else if(type == 'sa')
 {
	$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>quest_ans_controler/country_list_ajax",
   data: '',
   cache: false,
   success: function(msg)
   {
	//alert(msg.toSource());
	//alert('sadadsad');
    //$('#collages').attr('disabled', false);
	$('#collages').html(msg);
   }
   });
 }
}
	</script>
	<script>
		
		$(function(){
			jQuery('#slides_boxes2').slides({
			effect:'fade',
				play: 0,
				pause: 2500,
				hoverPause: false,
				preload: true,
				generateNextPrev: true
			});
		});
	</script>

	<?php
	if($this->session->flashdata('success'))
	{
	?>
	<script>
	$(document).ready(function(){
	$('#show_success').css('display','block');
	$('#show_success').hide();
	$('#show_success').show("show");
	$("#show_success").delay(3000).fadeOut(200);
	});
	</script>
	<?php
	}
	$show_quest_send_msg = '';
	?>
