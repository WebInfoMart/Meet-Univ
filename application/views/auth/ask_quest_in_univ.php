<script type="text/javascript" src="<?php echo "$base$js";?>/jquery.sliderkit.1.9.2.pack.js"></script>
		<script type="text/javascript" src="<?php echo "$base$js";?>/jquery.easing.1.3.min.js"></script>
		<script type="text/javascript" src="<?php echo "$base$js";?>/jquery.mousewheel.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo "$base$css_path"?>/sliderkit-core.css" media="screen, projection" />
		<link rel="stylesheet" type="text/css" href="<?php echo "$base$css_path"?>/sliderkit-demos.css" media="screen, projection" />
		<link rel="stylesheet" type="text/css" href="<?php echo "$base$css_path"?>/sliderkit-site.css" media="screen, projection" />
		
			<script type="text/javascript">
			$(window).load(function(){ //$(window).load() must be used instead of $(document).ready() because of Webkit compatibility		
				
				// Photo slider > Minimal
				$(".contentslider-std").sliderkit({
					auto:0,
					tabs:1,
					circular:1,
					panelfx:"sliding",
					panelfxfirst:"fading",
					panelfxeasing:"easeInOutExpo",
					fastchange:0,
					keyboard:1
				});
				
			});	
		</script>
<div class="row" style="margin-top:-30px">
	<div class="float_l span13 margin_l margin_t">
		<div class="modal" id="show_success" style="display:none;" >
			<div class="modal-header">
			<a class="close" data-dismiss="modal"></a>
			<h3>Message For You</h3>
			</div>
			<div class="modal-body">
			<p><center><h4>Your Message Has been sent successfully.....</h4></center></p>
			</div>
			<div class="modal-footer">
			<!--<a href="#" class="btn">Close</a>-->
			<!--<a href="#" class="btn btn-primary">Save changes</a>-->
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
			<div class="sliderkit contentslider-std">
			<div class="sliderkit-nav">
					<div class="sliderkit-nav-clip">
						<ul>
							<li class="float_l"><a href="#tab1" title="[link title]">Ask a Question</a></li>
							<li class="float_l"><a href="#tab2" title="[link title]">Browse More Q & A</a></li>
							<li><div class="clearfix"></div></li>
						</ul>
					</div>
			</div>
			<div class="sliderkit-panels">
				<form action="" method="post">
					<div class="sliderkit-panel" id="tab1">
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
					</div>
					<div class="sliderkit-panel" id="tab2">
							<div class="float_l span6 margin_zero">
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
													}
											?>
												<ul>
													<li>
														<a href="<?php echo "$base$url"; ?>">Browse All Questions of University</a>
													</li>
													
												</ul>
								</div>
										
							</div>
					</div>
				</form>
			</div>
		</div>
	</div>	
	<div id="quest_div_1"  class="margin_t">
		<div id="quest_div_show_right">
			<h3 class="heading_follow"><?php echo $count_all_question_of_univ; ?> Questions asked on MeetUniversities</h3>
			<div>
				<ul class="course_list">
				<?php
				if(!empty($get_all_question_of_univ))
				{
				$a=0;
				foreach($get_all_question_of_univ['quest_detail'] as $quest_list)
				{
				if($quest_list['q_univ_id'] != '0')
				{
					$url = "UniversityQuest/$quest_list[q_univ_id]/$quest_list[que_id]/$quest_list[q_askedby]";
				}
				else if($quest_list['q_country_id'] != '0')
				{
					$url = "";
				}
				?>
					<li>
					
				<div class="quest_row_single">
				<div id="quest_pic" class="quest_pic float_l"> <?php echo "<img style='width:40px;height:40px;margin:0px 10px;' src='".base_url()."uploads/".$quest_list['user_pic_path']."'/>";  ?> </div>
				<div id="quest" class="quest_right">
				<a href="<?php echo "$base$url"; ?>">
				<h3>
				<?
				// Quickly calculate the timespan
					
	// $time = $quest_list['q_asked_time'];
	// $diferencia = time() - $quest_list['q_asked_time'];
    ?>
				
				
				<?php
				echo $quest_list['q_title']."</br>";?></h3>
				<span class="black"><?php echo "by&nbsp;".$quest_list['fullname']."&nbsp"; ?></span>
				</a>
				
				<?php  
				$exp = explode(" ",$quest_list['q_asked_time']);
				$create_month_format = explode('-',$exp[0]);
				$string_month = date("M", mktime(0, 0, 0, $create_month_format[1]));
				
				// Check if this time is above 24 hours...
								$starttime = $quest_list['q_asked_time']; 
								$starttime = strtotime($starttime); 
								$oneday = 60*60*24; 
								if( $starttime < (time()-$oneday) ) { 
								  // echo 'more than one day since start'; 
								echo $exp[1].'&nbsp;&nbsp;'.$create_month_format[0].'-'.$string_month.'-'.$create_month_format[2]; //$articles_detail['publish_time']; 
								}
								else {
								//Less than oneday from start
								//Time difference
								$date = date('Y-m-d H:i:s');
								$firstTime=strtotime($quest_list['q_asked_time']);
								$lastTime=strtotime($date);

								// perform subtraction to get the difference (in seconds) between times
								$timeDiff=$lastTime-$firstTime;
								
								// Convert Seconds to h:i:s format
								$init = $timeDiff;
								$hours = floor($init / 3600);
								$minutes = floor(($init / 60) % 60);
								$seconds = $init % 60;
								echo "$hours:$minutes:$seconds".'&nbsp;&nbsp;before';
								}
								?>
							-
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
							echo $get_all_question_of_univ['ans_count'][$a]."&nbsp;Answers&nbsp;" ;
				
				?> 
				
				
				</div>
				<div class="float_r">
				<!--<g:plusone size="medium" annotation="none"></g:plusone>-->
				<div class="fb-like" data-href="<?php echo "$base$url"; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div>
				<!--<a href="https://twitter.com/share" class="twitter-share-button" data-via="munjal_sumit" data-count="none">Tweet</a>-->
				</div>
				</div>
				<div class="clearfix"></div>
				
				</a>
				
				
			
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
		<img src="<?php echo "$base$img_path"; ?>/banner_img.png">
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

	<?php
	if($show_quest_send_msg == 1)
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
