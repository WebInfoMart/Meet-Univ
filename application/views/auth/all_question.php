
	<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div>
				<div class="clearfix"></div>
			</div>
			<div class="row">
				<div class="float_l span13 margin_l margin_t1">
				
				<!-- Question send success -->
				<div class="modal" id="show_success" style="display:none;" >
								  <div class="modal-header">
									<a class="close" data-dismiss="modal"></a>
									<h3>Your Question Has been sent successfully.....</h3>
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
						<div class="sliderkit contentslider-std">
							<div class="sliderkit-nav">
								<div class="sliderkit-nav-clip">
									<ul>
										<li class="float_l"><a href="#tab1" title="[Ask a Question]">Ask a Question</a></li>
										<li class="float_l"><a href="#tab2" title="[Browse More Q & A]">Browse More Q & A</a></li>
										
											<li class="clearfix"></li>
									</ul>
								</div>
							</div>
					<div class="sliderkit-panels">
								<form action="QuestandAns" method="post">
									<div class="sliderkit-panel" id="tab1">
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
												<select id="colleges" name="colleges">
												<option value="0"> select </option>	
												</select>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="control-group margin_t1">
											<input type="submit" class="btn btn-success" name="post_quest" value="Post Question" />
										</div>
									</div>
									<div class="sliderkit-panel" id="tab2">
										<div class="float_l span6 margin_zero">
											<h3>Collages Q&A </h3>
											<div class="margin_t1">
												<ul class="browse_list">
													<li>
														<a href="Browse_Question/All">Browse All Questions</a>
													</li>
													
												</ul>
											</div>
										</div>
										
										<div class="clearfix"></div>
									</div>
									
								</form>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
							<!-- Added by Subh -->
				<div id="quest_div_1" class="margin_t">
				<div id="quest_div_show_right" class="float_l">
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
				<div>
				<ul class="course_list">
				<?php
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
					$question_title = str_replace(' ','-',$quest_list['q_title']);
					$url = "MeetQuest/$quest_list[que_id]/$question_title/$quest_list[q_askedby]";
					$url = $base.'otherQuestion'.'/'.$quest_list['que_id'].'/'.$question_title;
				}
				?>

				<li>
				<div>
				<div class="quest_row_single">
				<div id="quest_pic" class="quest_pic">
				
				<?php if($quest_list['user_pic_path']!='')
				{
				echo "<img style='width:40px;height:40px;margin-right:10px;' src='".base_url()."uploads/".$quest_list['user_pic_path']."'/>"; 
				} else
				{
				echo "<img style='width:40px;height:40px;margin-right:10px;' src='".base_url()."images/user_model.png'/>"; 
				} ?>
				</div>
				
				<div id="quest" class="quest_right">
				<div class="float_l span10 margin_zero">
				<a href="<?php echo $url; ?>">
				<h3><?php
				echo $quest_list['q_title']."</br>";?>
				</h3>
				<span class="black"><?php echo "by&nbsp;".$quest_list['fullname']."&nbsp,";?>
				</span>
				</a>
					<abbr class="timeago time_ago" title="<?php echo $quest_list['q_asked_time']; ?>"></abbr>,
							
							<?php
							if($quest_list['q_country_id'] == '0' and $quest_list['q_univ_id'] != '0')
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
							<?php
							echo $get_all_question['ans_count'][$a]."&nbsp;Answers&nbsp;";
							
				?> 
				
				</div>
				
				</div>
				<div class="float_r">
				<!--<g:plusone size="medium" annotation="none"></g:plusone>-->
				<div id="gp" class="float_l gp"><g:plusone size='medium' id='shareLink' annotation='none' href='<?php echo "$base$url"; ?>' callback='countGoogleShares' data-count="true"></g:plusone>
				</div>
				<div id="fb" class="float_l"> <div class="fb-like" data-href="<?php echo "$base$url"; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div> </div>
				<div id="tw" class="float_r"><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo "$base$url"; ?>" data-via="your_screen_name" data-lang="en">Tweet</a></div>
				<!--<a href="https://twitter.com/share" class="twitter-share-button" data-via="munjal_sumit" data-count="none">Tweet</a>-->
				</div>
				<div class="clearfix"></div>
				<div class="clearfix"></div>
				</div>
			
				</div>
				</li>
				
				<?php
				$a=$a+1;
				}
				}
				?>
				</ul>
				</div>
				
				</div>
				<div class="clearfix"></div>
				</div>
				<!-- End Here -->
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
<!-- ===================start slider_kit=================== -->
		<script type="text/javascript" src="js/jquery.sliderkit.1.9.2.pack.js"></script>
		<script type="text/javascript" src="js/jquery.easing.1.3.min.js"></script>
		<script type="text/javascript" src="js/jquery.mousewheel.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/sliderkit-core.css" media="screen, projection" />
		<link rel="stylesheet" type="text/css" href="css/sliderkit-demos.css" media="screen, projection" />
		<link rel="stylesheet" type="text/css" href="css/sliderkit-site.css" media="screen, projection" />
		
			<script type="text/javascript">
			$(window).load(function(){ 
				$(".contentslider-std").sliderkit({
					auto:0,
					tabs:1,
					circular:1,
					panelfx:"sliding",
					panelfxfirst:"fading",
					panelfxeasing:"easeInOutExpo",
					fastchange:0
					
				});
				
			});	
		</script>
	<!-- ===================end slider_kit=================== -->
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
	
	
</body>
</html>