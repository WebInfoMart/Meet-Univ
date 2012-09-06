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
?>	
	<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row">
				<div class="float_l span13 margin_l margin_t1">
				
				<!-- Question send success -->
				<div class="modal" id="show_success" style="display:none;" >
					<div class="modal-header">
						<a class="close" data-dismiss="modal"></a>
						<h3>Your Question Has been Submitted successfully.....</h3>
					</div>
				</div>
	
	<!-- End Here -->
				
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
							<div id="slides_boxes">
							<ul class="slider_pagination"><li class="current"><a href="#0">Ask a Question </span></a></li><li><a href="#1">Browse More Q & A</a></li>
							</ul>
							<div class="clearfix"></div>
							<div class="slides_container">
								<div>
									<form action="QuestandAns" method="post" class="margin_t">
									<div class="control-group">
											<input class="input-xxlarge focused" id="quest_title" name="quest_title" type="text" value="<?php echo $quest_var; ?>">
											<span style="color:red;"> <?php echo form_error('quest_title'); ?><?php echo isset($errors['quest_title'])?$errors['quest_title']:''; ?> </span>
										</div>
										<div class="control-group">
											<label>Describe your question in more detail (optional) </label>
											<textarea class="input-xxlarge" id="quest_detail" name="quest_detail" rows="5"></textarea>
										</div>
										<span style="color:red;"> <?php echo form_error('colleges'); ?><?php echo isset($errors['colleges'])?$errors['colleges']:''; ?> </span>
										<span>Select Category  <a href="#" id="cat">Category</a></span>
										<div id="change" class="form-inline">
											<div class="control-group margin_t1">
												<label>Choose Category</label>
												<select class="span3" id="category" name="category" onchange="fetch_collage(this);">
													<option value="gen">Choose Type</option>
													<!--<option value="sa">Study Abroad</option>-->
													<option value="col">College</option>
													
												</select>
												<select id="colleges" name="colleges" class="colege_set">
												<option value="0"> select </option>	
												</select>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="control-group margin_t1">
											<input type="submit" class="btn btn-success" name="post_quest" value="Post Question" />
										</div>
										</form>
								</div>
								<div>
									<div class="float_l span6 margin_delta margin_t">
											<h3>Collages Q&A </h3>
											<div class="margin_t1">
												<ul class="browse_list">
													<li>
														<a href="Browse_Question/All">Browse All Questions</a>
													</li>
													
												</ul>
											</div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
							<!-- Added by Subh -->
				<div id="quest_div_1" class="margin_t">
					<div id="quest_div_show_right">
						<h3 class="heading_follow">Recent 
						<?php 
						if($get_all_question!=0)
						{ 
						echo $get_all_question['no_of_que'];
						}
						else
						{ 
						echo "0"; 
						} ?> 
						Questions asked on MeetUniversities</h3>
					</div>
						<ul class="course_list">
							<?php
				$logged_user_id = $this->tank_auth->get_user_id();
				if(!empty($get_all_question))
				{
				$a=0;
				foreach($get_all_question['quest_detail'] as $quest_list)
				{
				
				if($quest_list['q_univ_id'] != '0')
				{
					$question_title = str_replace(' ','-',$quest_list['q_title']);
					$univ_domain=$quest_list['subdomain_name'];
					$quest_title=$quest_list['q_title'];
					$que_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'question',$quest_title,$quest_list['que_id']);
					$url = $que_link;
				}
				else if($quest_list['q_country_id'] != '0')
				{
					$url = "";
				}
				else
				{
					//$univ_title = str_replace(' ','_',$quest_list['title']);
					//$question_title = str_replace(' ','-',$quest_list['q_title']);
					$question_title =$this->subdomain->process_url_title($quest_list['q_title']);	
					$url = "MeetQuest/$quest_list[que_id]/$question_title/$quest_list[q_askedby]";
					$url = $base.'otherQuestion'.'/'.$quest_list['que_id'].'/'.$question_title;
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
						<img src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=small">
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
									<span><?php
									echo $quest_list['q_title']."</br>";?>
									</span></a>
							</div>
								<div class="blue">
									<span><?php echo "by&nbsp;".$quest_list['fullname']."&nbsp,";?>
									</span>
										
											<abbr class="timeago time_ago" title="<?php echo $quest_list['q_asked_time']; ?>"></abbr>,
											<?php
											/*if($quest_list['q_country_id'] == '0' and $quest_list['q_univ_id'] != '0')
											{
												echo 'Category- Colleges,';
											}
											else if($quest_list['q_country_id'] != '0' and $quest_list['q_univ_id'] == '0') 
											{
												echo 'Category- Study Abroad, ';
											}
											else{
											echo 'Category- General Question,';
											}
											?>
											-
											*/
											echo $get_all_question['ans_count'][$a]."&nbsp;Answers&nbsp;";
											
												?> 
				
										</div>
									
				
				</div>
				<div class="float_r">
					<div class="social_set float_r">
						<div id="gp" class="float_l">
							<g:plusone size='medium' id='shareLink' annotation='none' href='<?php echo "$base$url"; ?>' callback='countGoogleShares' data-count="true"></g:plusone>
						</div>
						<div id="tw" class="float_l tw">
							<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo "$base$url"; ?>" data-via="your_screen_name" data-lang="en">Tweet</a>
						</div>
						<div id="fb" class="float_r fb">
							<div class="fb-like" data-href="<?php echo "$base$url"; ?>" data-send="false" data-layout="button_count" data-width="10" data-show-faces="true" data-font="arial"></div> 
						</div>
					</div>
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
					<div class="clearfix"></div>
				</div>
				
				
				<div class="float_r span3 margin_t1">
					<img src="<?php echo $base; ?>images/banner_img.png">
				</div>
		
			<div id="pagination" class="table_pagination right paging-margin">
            <?php echo $this->pagination->create_links();?>
            </div>
				
			</div>
		</div>
	</div>
	
	
	<!--<script src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.4.min.js"></script>-->
<script type="text/javascript">
$(document).ready(function() {
	var fixed = false;

$(document).scroll(function() {
    if( $(this).scrollTop() >= 50 ) {
        if( !fixed ) {
            fixed = true;
            $('#main-nav-holder').css({position:'fixed',top:140,left:476});
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
<script>
		
		$(function(){
			jQuery('#slides_boxes').slides({
			effect:'fade',
				play: 0,
				pause: 2500,
				hoverPause: false,
				preload: true,
				generateNextPrev: true
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#change').hide();
			$('#cat').click(function() {
				$('#change').show();
			});
		});
	</script>	
	<script type="text/javascript">
function fetch_collage(values)
{
var type = values.value;
if(type == 'col')
{
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>quest_ans_controler/collage_list_ajax",
   data: '',
   cache: false,
   success: function(msg)
   {
	$('#colleges').html(msg);
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
	$('#colleges').html(msg);
   }
   });
 }
}
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
	?>
	
