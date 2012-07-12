<!--<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=255162604516860";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>-->
<?php
$sms_suc_sess_val = $this->session->userdata('msg_send_suc');
$sms_voice_suc_sess_val = $this->session->userdata('msg_send_suc_voice');
if($sms_suc_sess_val == 1)
{
	$show_suc_msg = "A Event Details has been send to you successfully.....";
}
else if($sms_voice_suc_sess_val == 1)
{
	$show_suc_msg = "A Reminder Voice SMS has been send to you successfully.....";
}
if($sms_suc_sess_val == '1' || $sms_voice_suc_sess_val == '1')
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
$this->session->unset_userdata('msg_send_suc');
$this->session->unset_userdata('msg_send_suc_voice');
?>
<div class="container">

	<div class="body_bar"></div>
	<div class="body_header"></div>
	<div class="form">
		<div class="row">
		<div class="modal" id="show_success" style="display:none;" >
					  <div class="modal-header">
						<a class="close" data-dismiss="modal"></a>
						<h3>Message For You</h3>
					  </div>
					  <div class="modal-body">
						<p><center><h4><?php echo $show_suc_msg; ?></h4></center></p>
					  </div>
					  <div class="modal-footer">
						<!--<a href="#" class="btn">Close</a>-->
						<!--<a href="#" class="btn btn-primary">Save changes</a>-->
					  </div>
				</div>
			<div class="span8 real margin_t">
				<div id="slider_img"  class='gallery_div'>
				<div class="slides_container">
				<?php
					foreach($gallery_home as $galery_images)
					{
						if(!empty($galery_images['image_path']))
					{
					?>			
					<div class="slide">
						<a href="#" title=""><img src="<?php echo "$base"; ?>uploads/home_gallery/<?php echo $galery_images['image_path']; ?>" alt="" width="700" height="360" title="" alt="" rel=" "></a>
						<div class="slider_caption" style="bottom:0">
							<p><?php echo $galery_images['title'].'</br>'.$galery_images['image_caption']; ?></p>
						</div>
					</div>	
				
				<?php
				  }
				  }
				?>
				</div>	
				</div>				
			</div>
			<div class="float_r span8 margin_t margin_l">
				<form class="form-horizontal form_horizontal_home" id="search_form" action="" method="post">
					<input type="hidden" name="type_search" id="type_search" value=""/>
					<input type="hidden" name="educ_level" id="educ_level" value="All"/>
					
					<div class="control-group">
						<label class="control-label" for="focusedInput"><h4 class="white">Explore</h4></label>
						<div class="controls">
							<div id="explore_button" class="btn-group" data-toggle="buttons-radio">
								<button type="button" class="btn active" id="events">Events</button>
								<button type="button" class="btn" id="colleges">Colleges</button>
							</div>
							<p class="help-block white help_line" id="sub-title">Events by country, city and months</p>
						</div>
						
						
					</div>
					<div class="events" id="events_col">
						<div class="control-group">
							<label class="control-label" for="focusedInput"><h4 class="white">Events</h4></label>
							<div class="controls">
								<div class="btn-group" id="event_button" data-toggle="buttons-radio">
									<!--<a class="btn" href="#">All</a>
									<a class="btn" href="#">Postgraduate</a>
									<a class="btn" href="#">Undergraduate</a>
									<a class="btn" href="#">Foundation</a>-->
									<button type="button" class="btn btnop active" id="all">All</button>
									<button type="button" class="btn btnop" id="spot">Spot Admission</button>
									<button type="button" class="btn btnop" id="fairs">Fairs</button>
									<button type="button" class="btn btnop" id="opendd">Counselling</button>
								</div>
								<div class="ddposition">
									<ul class="ddclass">
										<li class="li1 openddli" id="others"><a href="#" id="other_dd">Others</a></li>
										<li class="li2 openddli" id="alumuni" ><a href="#" id="alu_dd">Alumni</a></li>
									</ul>
								</div>	
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="focusedInput"><h4 class="white">in City</h4></label>
							<div class="dropdown_box">
								<div id="select_city">
									<span id="selected_value">All</span>
									<span id="city_dropdown" class="caret" style="float: right;margin-top: 7px;"></span>
								</div>
								<input type="hidden" name="event_city" id="city" value=""/>
								<div id="open_box">
									<input type="text" name="selected_event_city" id="selected_event_city" style="width:249px;" value=""/>
								</div>
							</div>
							
							<div class="controls">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="focusedInput"><h4 class="white">in the Month of</h4></label>
							<div class="controls">
								<div class="float_l span3 margin_zero">
									<!--<input class="input-xlarge focused" id="focusedInput" type="text" value="" placeholder="Month">-->
									<input type="text" id="last_widget" class="btn_cal" name="event_month" onkeydown="return false;"> <img src="images/home_cal.gif" id="last_widget_button"  class="cal_style" >
								</div>
								<div class="float_l span1 cal_align">
										<input type="button" onclick="serch_events();" name="btn_evet_search" class="btn" value="Search"/>
										<input type="hidden" name="btn_event_serch" value="">
								</div>
									<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<div class="college" id="col"  style="display:none">
						<div class="control-group">
							<label class="control-label" for="focusedInput"><h4 class="white">Type</h4></label>
							<div class="controls">
								<div id="college_button" class="btn-group" data-toggle="buttons-radio">
									<!--<a class="btn" href="#">All</a>
									<a class="btn" href="#">Postgraduate</a>
									<a class="btn" href="#">Undergraduate</a>
									<a class="btn" href="#">Foundation</a>-->
									<button type="button" id="allcollege" class="btn active">All</button>
									<button type="button" id="pg" class="btn">PostGraduate</button>
									<button type="button" id="ug" class="btn">UnderGraduate</button>
									<button type="button" id="found" class="btn">Foundation</button>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="focusedInput"><h4 class="white">in Country</h4></label>
							<div class="controls">
								
								<div class="dropdown_box_country">
									<div id="select_country">
										<span id="selected_country">Select Country</span>
										<span id="country_dropdown" class="caret" style="float: right;margin-top: 7px;"></span>
									</div>
									<input type="hidden" name="search_country" id="search_country" value=""/>
									<div id="open_box_country">
										<input type="text" name="selected_college_country" style="width:220px;" id="selected_college_country" value=""/>
									</div>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="focusedInput"><h4 class="white">Course</h4></label>
							<div class="controls">
								<div class="dropdown_box_course">
									<div id="select_course">
										<span id="selected_course">Select</span>
										<span id="course_dropdown" class="caret" style="float: right;margin-top: 7px;"></span>
									</div>
									<input type="hidden" name="search_program" id="search_program" value=""/>
									<div id="open_box_course">
										<input type="text" style="width:220px;" name="selected_college_course" id="selected_college_course" value=""/>
									</div>
								</div>
								<!--<div class="float_l span4 margin_zero">
									<select id="search_program" name="search_program">
										<option value="">Select</option>
										<?php
										foreach($area_interest as $srch_course)
										{
										?>
											<option value="<?php echo $srch_course['prog_parent_id']; ?>"><?php echo ucwords($srch_course['program_parent_name']); ?></option>
										<?php
										}
										?>
									</select>
								</div>-->
								<div class="float_l span1">
									<input type="button" onclick="serach_results()" name="serach_col_btn" class="btn" value="Search"/>
									<input type="hidden" name="btn_search" id="btn_col_search">
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<!--<div class="search_layout">
						<div class="control-group">
							<label class="control-label" for="focusedInput"><h3 class="white">City</h3></label>
							<div class="controls">
								<select id="select01">
									<option>Select City</option>
									<option>India</option>
									<option>USA</option>
									<option>Canada</option>
									<option>New york</option>
								</select>
							</div>
						</div>
						<div class="control-group">
							<div class="margin_b2">
								<div class="float_l">
									<img src="images/form_line_breaker.png">
								</div>
								<div class="float_l style_or">OR</div>
								<div class="float_l"><img src="images/form_line_breaker2.png"></div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>-->
					<!--<div class="control-group">
						<label class="control-label" for="focusedInput"><h3 class="white">Search</h3></label>
						<div class="controls">
							<div class="float_l span4 margin_zero">
								<input class="input-xlarge focused" id="focusedInput" type="text" value="" placeholder="Search here...">
								<p class="help-block ex_univ"><span class="white">ex:</span> mba, university of sydney, undergraduate course</p>
							</div>
							<div class="float_l span1">
								<button class="btn" href="#">Submit</button>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					-->
				</form>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="body_container">
			<!--<div class="row">
				<div class="span16 margin_zero">
					<div style="padding:10px;background:#f1f7b4;-webkit-box-shadow: 0px 0px 6px
					#999;-moz-box-shadow: 0px 0px 6px #888;">
							<ul class="new_list">
								<li><a>Lorem Ipsum has been the industry's standard dummy text.</a> </li>
								<li><a>Lorem Ipsum has been the industry's standard dummy text.</a> </li>
								<li><a>Lorem Ipsum has been standard dummy text.</a> </li>
							</ul>
					</div>
				</div>
			</div>
			-->
			<div class="row">
				<div class="span16 margin_t margin_delta">
					<div class="float_l span7 margin_delta">
						<h3>Upcoming Events</h3>
						<div class="fix-height ">
							<ul class="event_new">
							
							<?php 
						if(!empty($featured_events))
						{
						$rc=9;
						foreach($featured_events as $events) {
						$univ_domain=$events['subdomain_name'];
		$event_title=$events['event_title'];
		$event_id=$events['event_id'];
		
		$event_link_register=$this->subdomain->genereate_the_subdomain_link($univ_domain,'event','','');		
						?>
						<?php
						//if($featured_events != '' || $featured_events != '0') {
						$date = explode(" ",$events['event_date_time']);
						$image_exist=0;		
						if(file_exists(getcwd().'/uploads/univ_gallery/'.$events['univ_logo_path']))	
						{
						$image_exist=1;
						list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/univ_gallery/'.$events['univ_logo_path']);
						}
						else
						{
						list($width, $height, $type, $attr) = getimagesize(getcwd().$img_path.'/calendar.png');
						}
						if($events['univ_logo_path']!='' && $image_exist==1)
						{
						$image=$base.'uploads/univ_gallery/'.$events['univ_logo_path'];
						}
						else
						{
						$image=$base.$img_path.'/calendar.png';
						} 
						$img_arr=$this->searchmodel->set_the_image($width,$height,110,75,TRUE);
						$event_register_user = $this->frontmodel->count_event_register($events['event_id']);
						
		$univ_name=$events['univ_name'];
		$univ_domain=$events['subdomain_name'];
		$event_title=$events['event_title'];
		$event_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'event',$event_title,$events['event_id']);
						?>
								<li onclick="gotoevent('<?php echo $event_link; ?>');" style="cursor:pointer;">
								<form action="<?php echo $event_link_register; ?>/EventRegistration" method="post" class="margin_zero">
						
									<div>
										<div class="float_l">
		<div class="title_style">
		
		<a class="" href="<?php echo $event_link ?>">
		
		<h4 class="inline"><?php echo $events['univ_name']; ?></h4>
		</a><span class="inline"> &raquo; </span>
		<h4 class="inline">
		<?php if($events['event_category']=='spot_admission'){
		echo "Spot Admission";
		}
		else if($events['event_category']=='fairs')
		{
			echo "Fairs";
		}
		else if($events['event_category']=='others')
		{
			echo "Counselling";
		}
		else if($events['event_category']=='alumuni')
		{
			echo "Counselling";
		}
		else
		{
		echo $events['event_category'];
		}
		?>
		</h4></div>
										</div>
										<div class="float_r">
										<!-- For VoiceCall PopOver -->
										<!--<a href="#" id="ex6b" class="ex6b_ccc inline" name="event-get-detail_<?php echo $events['event_id']; ?>"><img src="images/call.png" title="Reminder Call" alt="Reminder Call"></a>
											<span id="event_pop_<?php //echo $events['event_id']; ?>" class="ex6a_ccc" ></span>
												<a href="#" id="ex6b2" class="ex6b_ccc2 inline" name="event-get-detail2_<?php echo $events['event_id']; ?>"><img src="images/sms.png" title="Send SMS" alt="Send SMS"></a>
											<span id="event_pop2_<?php //echo $events['event_id']; ?>" class="ex6a_ccc2" ></span>
											<a href="<?php echo $event_link; ?>" class="inline"><img src="images/map.png" title="Map" alt="Map"></a>-->
										</div>
										<div>
											<div class="img_style float_l aspectcorrect" >
												<img src=" <?php echo $image ?>" style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" >
											</div>
											<div class="float_l text-width" style="font-size:14px;">
												<h4 class="blue home_line"><?php 
												echo $date[0]?$date[0]:'';
												echo $date[1]?'&nbsp;'.$date[1]:'';
												if($date[0]!='' || $date[1]!='') { echo ',&nbsp;&nbsp;'.$date[2];} else { echo ''; }
												?></h4>
												<h4 class="home_line"><?php echo $events['event_place']?$events['event_place']:''; 
												if($events['event_place']!='' && $events['cityname']!=''){ echo ',&nbsp;&nbsp;'.$events['cityname']; } else{ echo $events['cityname']; }
												if($events['country_name']!='' && $events['event_place']!='' || $events['cityname']!=''){ echo ',&nbsp;&nbsp;'.$events['country_name']; } else{ echo $events['country_name']; }
												?> </h4>
												<!-- Hidden field for event registration -->
												<input type="hidden" name="event_register_of_univ_id" value="<?php echo $events['univ_id']; ?>"/>
												<input type="hidden" name="event_register_id" value="<?php echo $events['event_id']; ?>"/>
												<input type="submit" name="btn_event_register" id="<?php echo $events['event_id']; ?>" value="Register" class="btn btn-success" />
												
											</div>
											<div class="float_r registered">
													<h2 class="blue"><?php
													//commented by sumit munjal now shoing here static user
													//echo $event_register_user;
													echo $event_register_user;
													$rc=$rc+4; 
													?>
													
													</h2>	
													<h5 class="blue">Registered</h5>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									</form>
								
								</li>
								<?php } } ?>
								
							</ul>
						</div>
					</div>
					<div class="float_l">
						<div class="float_l span5">
							<h3>News</h3>
							<div id="slides_content">
								<div class="slides_container">
								<?php if(!empty($featured_news_show)) {
								foreach($featured_news_show as $f_news)
								{
									$image_exist=0;	
									$news_img = $f_news['news_image_path'];	
									if(file_exists(getcwd().'/uploads/news_article_images/'.$news_img) && $news_img!='')	
									{
									$image_exist=1;
									list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/news_article_images/'.$news_img);
									}
									else if(file_exists(getcwd().'/uploads/univ_gallery/'.$f_news['univ_logo_path']) && $f_news['univ_logo_path']!='')
									{
									$image_exist=2;
									list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/univ_gallery/'.$f_news['univ_logo_path']);
								    }
									else
									{
									list($width, $height, $type, $attr) = getimagesize(getcwd().'/'.$img_path.'/news_default_image.jpg');
								    }
									if($news_img!='' && $image_exist==1)
									{
									$image=$base.'uploads/news_article_images/'.$news_img;
									}
									else if($f_news['univ_logo_path']!='' && $image_exist==2)
									{
									$image=$base.'uploads/univ_gallery/'.$f_news['univ_logo_path'];
									}
									else
									{
									$image=$base.$img_path.'/news_default_image.jpg';
									} 
									$img_arr=$this->searchmodel->set_the_image($width,$height,88,88,TRUE);
									$univ_domain=$f_news['subdomain_name'];
    $news_title=$f_news['news_title'];	
	$news_id=$f_news['news_id'];
	$news_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'news',$news_title,$news_id);							
	
							?>
									<div>
										<h4><a href="<?php echo $news_link; ?>"><?php echo substr($f_news['news_title'],0,35); ?></a></h4>
										<span class="float_l aspectcorrect home_art">
											<img style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" src="<?php echo $image; ?>">
											
										</span>
										<p><?php echo substr($f_news['news_detail'],0,600).'...'; 
										if(strlen($f_news['news_detail'])>600)
										{
		echo "...";?><br/><a href="<?php echo $news_link; ?>" class="float_r view_back">View more&raquo;</a>
								<?php		}
										?>	 </p>
									
									</div>
									<?php } } ?>
									
								</div>
							</div>
						</div>
						<div class="float_l span4">
							<h3>Featured Colleges</h3>
							<div id="slides_news">
								<div class="slides_container"  style="width:237px!important;">
									
								<?php 
				$f_coll=0;
				if(!empty($featured_college))
				{
				$total_featured_clg=count($featured_college);
				foreach($featured_college as $featured_clg) {
				if(!($f_coll%6)) { ?>
				<div>
				<ul class="col_img">
				<li>
				<?php }
				$fc=0;
				$image_exist=0;		
				if(file_exists(getcwd().'/uploads/univ_gallery/'.$featured_clg['univ_logo_path']) && $featured_clg['univ_logo_path']!='')	
				{
				$image_exist=1;
				list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/univ_gallery/'.$featured_clg['univ_logo_path']);
				}
				else
				{
				list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/univ_gallery/univ_logo.png');
				}
				if($featured_clg['univ_logo_path']!='' && $image_exist==1)
				{
				$image=$featured_clg['univ_logo_path'];
				}
				else
				{
				$image='univ_logo.png';
				} 
				$img_arr=$this->searchmodel->set_the_image($width,$height,114,79,TRUE);
				?>
									<div class="float_l featured_art aspectcorrect <?php if($f_coll%2) { echo "margin_zero"; } ?>">
									 
		<?php $univ_link=$this->subdomain->generate_univ_link_by_subdomain($featured_clg['subdomain_name']);
			
									?>
										<a href="<?php echo $univ_link; ?>">	<img style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" src="<?php echo $base; ?>/uploads/univ_gallery/<?php echo $image; ?>" ></a>
									</div>
				<?php 
				$f_coll++;
				if((!($f_coll%6)) || $f_coll==$total_featured_clg) { ?>	
				</li></ul></div>	
								
				<?php }
				}
				}   
				else 
				{ 
				echo "No Featured Colleges Available"; 
				} ?>					
								
								</div>
								
							<div class="clearfix"></div>
							</div>
							<div>
								<div class="home_padding">
									<div class="btn-group">
										<button class="btn status_bg number_bar"><?php echo $total_poste_event_count?$total_poste_event_count:'0'; ?></button>
										<button class="btn status_bg number_bar status_numb"><span id="tot_reg_user"></span></button>
										<div class="clearfix"></div>
									</div>
									<div class="label_text" style="width:350px;height:20px;">
										<ul>
											<li style="margin-left:20px;"><a href="#">EVENTS</a></li>
											<li><a href="#">Registered User</a></li>
										</ul>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="row">
				<div class="span16 margin_delta margin_t">
					<div class="center_bar">
							<ul class="yellow yellow_nav">
						<li><a href="<?php echo $base; ?>colleges/Applied_and_pure_sciences ">Applied and pure sciences</a></li>
						<li><a href="<?php echo $base; ?>colleges/Education_and_teacher_training">Education and teacher training</a></li>
						<li><a href="<?php echo $base; ?>colleges/Engineering_and_technology">Engineering and technology</a></li>
						<li><a href="<?php echo $base; ?>colleges/Health_and_medicine">Health and medicine</a></li>
						<li><a href="<?php echo $base; ?>colleges/Creative_arts_and_design" style="border-right-style:none;">Creative arts and design</a></li>
						
					</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span16 margin_delta margin_t">
					<div class="span7 margin_delta">
						<div class="green_qust">
							<div>
								<div class="float_l">
									<div class="letter_uni">
									<div>Q Go Ask <br><span>uestion</span></div>
									</div>
								</div>
								<div class="float_r Qust_content">
									<span>Have a Question?</span>
									<span>Ask our counselors!</span>
								</div>
								<div class="clearfix"></div>
							</div>
							<!--<h3>what are the type of questions they ask in iit?</h3>-->
							<div class="margin_t1">
								<div class="input-append">
									<form action="<?php echo $base; ?>QuestandAns" method="post">
										<input class="span4 margin_zero" id="appendedInput" name="quest_on_univ" size="16" type="text" placeholder="Enter Your Qusetion">
										<input type="submit" id="ask_quest" name="ask_quest" class="add-on btn-info btn_tab"  value="Ask">
									</form>
								</div>
							</div>
							<div class="margin_t1">
								<h3>Latest Q&A </h3>
								<ul class="prof_data">	
								<?php 
								
				if(!empty($get_latest_question_home))
				{
				$a=0;
				$q_count = 0;
				foreach($get_latest_question_home['quest_detail'] as $quest_list)
				{
				if($q_count < 4)
				{
				if($quest_list['q_univ_id'] != '0')
				{
					$univ_domain=$quest_list['subdomain_name'];
					$quest_title=$quest_list['q_title'];
					$que_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'question',$quest_title,$quest_list['que_id']);
					$url = $que_link;
				}
				else if($quest_list['q_country_id'] != '0')
				{
					$url = "";
				}
				else if($quest_list['q_category'] == 'general' && $quest_list['q_country_id'] == '0' && $quest_list['q_univ_id'] == '0')
				{
					$question_title = str_replace(' ','-',$quest_list['q_title']);
					$url = $base.'otherQuestion/'.$quest_list['que_id'].'/'.$question_title;
				}
				else
				{
				$url='';
				}
				$q_date = explode(" ",$quest_list['q_asked_time']);
				//print_r($q_date[0]);
				$quest_ask_date = explode("-",$q_date[0]);
				//print_r($quest_ask_date[0]);
				$q_month = $quest_ask_date[1];
				//$quest_month = date('M', strtotime($q_month . '01'));
				$quest_month = date( 'F', mktime(0, 0, 0, $q_month) );
				//print_r($quest_ask_date[2]);
				?>
								
									<li>

										<div class="float_l green_box_img">
										<?php if($quest_list['user_pic_path'] !='' && file_exists(getcwd().'/uploads/'.$quest_list['user_pic_path'])) { ?> 
										<img src="<?php echo "$base"; ?>uploads/<?php echo $quest_list['user_pic_path']; ?>" class="latest_img" />
										<?php } else { ?>
										<img src="<?php echo "$base$img_path"; ?>/user_model.png" class="latest_img">
										<?php } ?>
										</div>
										<div class="quest_fix">
											<span><a href="<?php echo $url; ?>" class="black"><?php echo $quest_list['q_title']?$quest_list['q_title']:''; ?></a></span>
										</div>
										<div class="asked_home"><?php echo $quest_list['fullname']?'Asked by '.$quest_list['fullname']:'Name Not Available'; ?></div>
										<div class="asked_home">
										<?php
										echo $quest_ask_date[2]?$quest_ask_date[2].' ':'';
										
										echo $quest_month?$quest_month.', ':'';
										 echo $quest_ask_date[0]?$quest_ask_date[0].' ':'';
										?></div>
										<div class="clearfix"></div>
									</li>
									<?php } $q_count++; } } ?>
								</ul>
							</div>
						</div>
					</div>
					<div class="float_l">
						<div class="float_l span5" style="text-align:justify">
							<h3 style="line-height: 20px;">Article</h3>
							<?php 
							$article_count = 0;
							if(!empty($featured_article))
							{
							foreach($featured_article as $article){ 
							if($article_count < 2) {
							$image_exist=0;		
							if(file_exists(getcwd().'/uploads/news_article_images/'.$article['article_image_path']) && $article['article_image_path']!='' )	
							{
							$image_exist=1;
							list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/news_article_images/'.$article['article_image_path']);
							}
							else if(file_exists(getcwd().'/uploads/univ_gallery/'.$article['univ_logo_path'] && $article['univ_logo_path']!=''))
							{
							$image_exist=2;
							list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/univ_gallery/'.$article['univ_logo_path']);
							}
							else
							{
							list($width, $height, $type, $attr) = getimagesize(getcwd().'/'.$img_path.'/default_logo.png');
							}
							if($article['article_image_path']!='' && $image_exist==1)
							{
							$image=$base.'uploads/news_article_images/'.$article['article_image_path'];
							}
							else if($article['univ_logo_path']!='' && $image_exist==2)
							{
							$image=$base.'uploads/univ_gallery/'.$article['univ_logo_path'];
							}
							else
							{
							$image=$base.$img_path.'/default_logo.png';
							} 
							$img_arr=$this->searchmodel->set_the_image($width,$height,84,84,TRUE);
							
							?>
							<div>
								<h4><?php echo substr($article['article_title'],0,45).'...'; ?></h4>
									<span class="float_l aspectcorrect home_art">
										
											<img style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" src="<?php echo $image; ?>">
											
										
									</span>
									<p><?php
									echo substr($article['article_detail'],0,325); 
									if(strlen($article['article_detail'])>325){ 
			$article_link=$this->subdomain->genereate_the_subdomain_link($article['subdomain_name'],'articles',$article['article_title'],$article['article_id']);
			?>
	..<br/>
	<div class="margin_b"><a href="<?php echo $article_link; ?>" class="float_r view_back">View More&raquo;</a>	</div>
									<?php }
									?>	
									
									</p>
							</div>
							<?php 
							$article_count++; } } } else { echo "No Recent Articles Available"; } ?>
						</div>
						<div class="float_l span4">
							<div class="fb-like-box" data-href="http://www.facebook.com/MeetUniversities" data-width="240" data-height="440" data-show-faces="true" data-stream="true" data-header="true"></div>		
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
		
		<!--<div id="myModal" class="model_back modal hide fade">
	<div class="modal-header no_border model_heading">
		<a class="close" data-dismiss="modal">x</a>
		<h3>Event Information</h3>
	</div>
	<div id="event_det" class="modal-body model_body_height">
	
	</div>
	</div>-->
	
	<!-- Div For Voice SMS -->
	<!--<div id="myModal-voice" class="model_back modal hide fade">
	<div class="modal-header no_border model_heading">
		<a class="close" data-dismiss="modal">x</a>
		<h3>Event Information</h3>
	</div>
	<div id="event_det_voice" class="modal-body model_body_height">
	
	</div>
	</div>-->
	<!-- End Here -->
	<!-- Anusha
	<div class="dropdown_box">
							<div id="hello">
								<span id="selected_value">All</span>
								<span class="caret" style="float: right;margin-top: 7px;"></span>
							</div>
							<div id="open_box">
								<input type="text" name="course" id="course" value=""/>
								
							</div>
						</div>--->
	<!-- End Here -->
<?php
$arr='[';
$i=1;
foreach($cities as $city)
{
$arr.='{label: "'.$city['cityname'].'"}';
if($i!=count($cities))
{
$arr.=',';
}
$i++;
//$city=$city['city_id'];

} $arr.=']';
$countrylist='[';
$c=1;
foreach($country as $srch_country)
{
$countrylist.='{label: "'.$srch_country['country_name'].'"}';
if($c!=count($country))
{
$countrylist.=',';
}
$c++;
//$city=$city['city_id'];
}
 $countrylist.=']';
 
$area_interest_list='[';
$ai=1;
foreach($area_interest as $srch_course)
{
$area_interest_list.='{label: "'.$srch_course['program_parent_name'].'"}';
if($ai!=count($area_interest))
{
$area_interest_list.=',';
}
$ai++;
}
 $area_interest_list.=']'; 
?>	
<style type="text/css">	
.ddclass{
list-style:none;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;
border:1px solid #ccc;width:86px;position:relative;left:186px;top:1px;display:none;
}
.ddclass li{background-color:#F5F5F5;}
.ddclass li:hover{background-color:#ccc;cursor:pointer;}
.li1 a {color:#000;}
.li2 a {color:#000;}
.li1{padding-left:10px;padding-top:5px;}
.li1 a:hover{text-decoration:none;}
.li2 a:hover{text-decoration:none;}
.li2{padding-left:10px;margin-bottom:0px;padding-right:5px;padding-top:5px;}
</style>
<SCRIPT LANGUAGE="JavaScript">     
 /*function popup(id) {
  $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>leadcontroller/sms_me_event_ajax",
	   async:false,
	   data: 'event_id='+id,
	   cache: false,
	   success: function(msg)
	   {
	   $('#event_det').html(msg);
		$('#sms_form').append('<input type="hidden" name="page_status" value="home"/>');
		$('#myModal').modal({
        keyboard: false
    })
	   }
	   }) 
} 

//Code For Voice API

function voicepopup(id) {
  $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>leadcontroller/sms_voice_me_event_ajax",
	   async:false,
	   data: 'event_id='+id,
	   cache: false,
	   success: function(msg)
	   {
	   $('#event_det_voice').html(msg);
		$('#sms_form_voice').append('<input type="hidden" name="page_status_voice" value="home"/>');
		$('#myModal-voice').modal({
        keyboard: false
    })
	   }
	   }) 
}*/ 

</script>

<script type="text/javascript">
$(document).ready(function(){
	$("#open_box").hide();
	
	$("#selected_event_city").autocomplete({
		source:<?php echo $arr; ?>,
		select: function( event, ui ) {
			$("#city").val(ui.item.value);
			$("#selected_value").html(ui.item.label);
			$("#open_box").hide();
			$("#selected_event_city").val('');
			event.preventDefault();
		},
		focus:function( event, ui ) {
			$("#city").val(ui.item.value);
			$("#selected_event_city").val(ui.item.label);
			event.preventDefault();
		},
		open:function( event, ui ) {
			$("#selected_event_city").val('');
			event.preventDefault();
		},
		width: 260,
		selectFirst: false,
		minLength: 0,
		}).focus(function() {
			$(this).autocomplete('search', '')
		});
	
	$("html").click(function(e){
		if((e.target.id == "select_city")){
			$("#open_box").show();
			$("#selected_event_city").trigger('focus');
			$("#selected_event_city").val("");
		}else if((e.target.id == "city_dropdown")){
			$("#open_box").show();
			$("#selected_event_city").trigger('focus');
			$("#selected_event_city").val("");
		}else if(e.target.id == "selected_event_city"){
			$("#open_box").show();
			$("#selected_event_city").trigger('focus');
			$("#selected_event_city").val("");
		}else{
			$("#open_box").hide();
		}
	});
	
	$("#open_box_country").hide();
	
	$("#selected_college_country").autocomplete({
		source: <?php echo $countrylist; ?>,
		select: function( event, ui ) {
			$("#search_country").val(ui.item.value);
			$("#selected_country").html(ui.item.label);
			$("#open_box_country").hide();
			$("#selected_college_country").val('');	
			event.preventDefault();
		},
		focus:function( event, ui ) {
			$("#search_country").val(ui.item.value);
			$("#selected_country").val(ui.item.label);
			event.preventDefault();
		},
		open:function( event, ui ) {
			$("#selected_college_country").val('');	
			event.preventDefault();
		},
		width: 260,
		selectFirst: false,
		minLength: 0,
		}).focus(function() {
	$(this).autocomplete('search', '')
	});
		
	$("html").click(function(e){
		if((e.target.id == "select_country")){
			$("#open_box_country").show();
			$("#selected_college_country").trigger('focus');
			$("#selected_college_country").val("");
		}else if((e.target.id == "city_dropdown")){
			$("#open_box_country").show();
			$("#selected_college_country").trigger('focus');
			$("#selected_college_country").val("");
		}else if(e.target.id == "selected_college_country"){
			$("#open_box_country").show();
			$("#selected_college_country").trigger('focus');
			$("#selected_college_country").val("");
		}else{
			$("#open_box_country").hide();
		}
	});
	
	$("#open_box_course").hide();
	
	$("#selected_college_course").autocomplete({
		source: <?php echo $area_interest_list; ?>,
		select: function( event, ui ) {
			$("#search_program").val(ui.item.value);
			$("#selected_course").html(ui.item.label);
			$("#open_box_country").hide();
			$("#selected_college_course").val('');	
			event.preventDefault();
		},
		focus:function( event, ui ) {
			$("#search_program").val(ui.item.value);
			$("#selected_course").val(ui.item.label);
			event.preventDefault();
		},
		open:function( event, ui ) {
			$("#selected_college_course").val('');
			event.preventDefault();
		},
		width: 215,
		selectFirst: false,
		minLength: 0,
		}).focus(function() {
	$(this).autocomplete('search', '')
	});
		
	$("html").click(function(e){
		if((e.target.id == "select_course")){
			$("#open_box_course").show();
			$("#selected_college_course").trigger('focus');
			$("#selected_college_course").val("");
		}else if((e.target.id == "course_dropdown")){
			$("#open_box_course").show();
			$("#selected_college_course").trigger('focus');
			$("#selected_college_course").val("");
		}else if(e.target.id == "selected_college_course"){
			$("#open_box_course").show();
			$("#selected_college_course").trigger('focus');
			$("#selected_college_course").val("");
		}else{
			$("#open_box_course").hide();
		}
	});
	
	$("#event_button :button").click(function(){
		if ($("#event_button :button").is('.active')) {
			$("#event_button :button").removeClass("active");
		//$(":button").addClass("active");
			var id =$(this).attr('id');
			$('#'+id).addClass("active");
		}
		
	});
	
	$("#explore_button :button").click(function(){
		if ($("#explore_button :button").is('.active')) {
			$("#explore_button :button").removeClass("active");
		//$(":button").addClass("active");
			var id =$(this).attr('id');
			$('#'+id).addClass("active");
		}
		
	});
	
	$("#college_button :button").click(function(){
		if ($("#college_button :button").is('.active')) {
			$("#college_button :button").removeClass("active");
		//$(":button").addClass("active");
			var id =$(this).attr('id');
			$('#'+id).addClass("active");
		}
		
	});
});
</script>

<script>
//$('#opendd').mouseenter(/*Commented by Anusha*/
$('#opendd').click(function(){
	$('.ddclass').css('display','block');
	//$('#opendd').removeClass('active');
});
$('.openddli').click(function()
{
	 $('.btnop').each(function()
	 {
	   $(this).removeClass('active');
	 });
	 $('#opendd').addClass('active');
	 $('.ddclass').css('display','none');
	 $('#opendd').html($(this).text());
	  if($(this).attr("id")=='others')
	  {
	  $('#type_search').val('others');
	  }
	  else
	  {
	  $('#type_search').val('alumuni');
	  
	  }
});
	
	/*$("body").click Commented by Anusha*/
	$("html").click
	(
	function(e)
	{
		/*if(e.target.className !== "ddclass")Commented by Anusha*/
		if(e.target.id !== "opendd")
		{
		$('.ddclass').css('display','none');
		//$('#opendd').removeClass('active');
		}
	}
	);
	
	
$(document).ready(function() {
			$("#col").hide();
	$('#colleges').click(function() {
		$("#events_col").hide();
		$("#col").show();
		$('p').replaceWith('<p class="help-block white help_line" id="sub-title">colleges by programs, country and course level</p>');
   });
   $('#events').click(function() {
		$("#col").hide();
		$("#events_col").show();
		$('p').replaceWith('<p class="help-block white help_line" id="sub-title">Events by country, city and months</p>');
   });
});
</script>	
<script>
$(document).ready(function(){
$('#allcollege').click(function(){
$('#type_search').val('');
fetch_programs(0);
});

$('#found').click(function(){
$('#type_search').val(2);
$('#educ_level').val('Foundation');

fetch_programs(2);
});

$('#pg').click(function(){
$('#type_search').val(4);
$('#educ_level').val('PostGraduate');
fetch_programs(4);
});
$('#ug').click(function(){
$('#type_search').val(3);
$('#educ_level').val('UnderGraduate');
fetch_programs(3);
});

$('#spot').click(function(){
$('#type_search').val('spot_admission');
});

$('#fairs').click(function(){
$('#type_search').val('fairs');
});


});

function serach_results()
{
var url='<?php echo $base; ?>colleges/';
var country;
var educ_level;
var area_interest;
var country=$('#selected_country').html();
country=country.replace(' ','_');
var prog= $('#selected_course').html();
prog=prog.replace(/ /g,'_');
var educ_level=$('#educ_level').val();
if(country!='Select_Country')
{
url=url+country+'/';
}
if(prog!='Select' && prog!='Select_Program')
{
url=url+prog+'/';
}
if(educ_level!='All')
{
url=url+educ_level;
}
window.location=url;
}
function serch_events()
{
var event_type=$('#type_search').val();
var city=$('#selected_value').text();
url='<?php echo $base; ?>events'
if(event_type!='')
{
url=url+'/'+event_type;
}
if(city != 'All')
{
city=city.replace(' ','_');
url=url+'/'+city;
}
$("#search_form").attr("action",url);
$('#search_form').submit();
}

function fetch_programs(educ_level)
{
	   $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>search/fetch_parent_progrmas_on_home_ajax",
	   async:false,
	   data: 'educ_level='+educ_level,
	   cache: false,
	   success: function(msg)
	   {
	  $('#search_program').html(msg);
	   }
	   })
}
		$(function(){
			$('#slider_img').slides({
				play: 5000,
				pause: 2500,
				hoverPause: true,
				animationStart: function(current){
					$('.slider_caption').animate({
						bottom:-35
					},100);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationStart on slide: ', current);
					};
				},
				animationComplete: function(current){
					$('.slider_caption').animate({
						bottom:0
					},200);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationComplete on slide: ', current);
					};
				},
				slidesLoaded: function() {
					$('.slider_caption').animate({
						bottom:0
					},200);
				}
			});
		});
</script>
<script type="text/javascript">
      $(function () {
        $('#default_widget').monthpicker();

        $('#custom_widget').monthpicker({
            pattern: 'yyyy-mm',
            selectedYear: 2010,
            startYear: 2008,
            finalYear: 2012,
            monthNames: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
        });

        $('#events_widget').monthpicker().bind('monthpicker-click-month', function (e, month) {
            alert('You clicked on month ' + month);

        }).bind('monthpicker-change-year', function (e, year) {
            alert('You chosed the year ' + year);

        }).bind('monthpicker-show', function () {
            alert('showing... ' + $(this).attr('id'));
            
        }).bind('monthpicker-hide', function () {
            alert('hiding... ' + $(this).attr('id'));
        });

        $('#last_widget').monthpicker({selectedYear: 2009, startYear: 2008, finalYear: 2010, openOnFocus: false});

        $('#last_widget').monthpicker().bind('monthpicker-change-year', function (e, year) {
            $('#last_widget').monthpicker('disableMonths', []);
            if (year === '2008') {
                $('#last_widget').monthpicker('disableMonths', [1, 2, 3, 4]);
            }
            if (year === '2010') {
                $('#last_widget').monthpicker('disableMonths', [9, 10, 11, 12]);
            }
        });

        $('#last_widget_button').bind('click', function () {
            $('#last_widget').monthpicker('show');
        });

      });
    </script>


    <style type="text/css">
#marquee {position:relative;

overflow:hidden;

width:1000px;

height:22px;

}

#marquee span {white-space:nowrap;}

</style>
<script>
		$(function(){
			$('#slides_content').slides({
				play: 5000,
				pause: 2500,
				hoverPause: true,
				preload: true,
				generateNextPrev: true
			});
		});
	</script>
<script>
		$(function(){
			$('#slides_news').slides({
				effect: 'fade',
				play: 6500,
				pause: 10000,
				hoverPause: true,
				preload: true,
				generateNextPrev: true
			});
		});
	</script>

<script>
noofregister();
var delay = 5000; //5 minutes counted in milliseconds.
var cval=0;
setInterval(function(){
 noofregister()   
}, delay);
function noofregister()
{
$.ajax({
      type: 'POST',
      url: '<?php echo base_url().'auth/auto_count_register_user';?>',
	  async:false,
      success: function(response){
	  response=parseFloat(response);
	  response = Math.floor( response );
	  if(cval==0 || cval!=response || cval==null)
	  {
	  $('#tot_reg_user').html(response);
	  $('#tot_reg_user').show("slide", { direction: "down" }, 1000);
	  $('#tot_reg_user').html(response);
	  cval=response;
      }
    }
	});
}
</script>

<!-- Script For PopOver Ajax Content -->
<script>
var currentid=0;
$(".ex6a_ccc").popover({
	title: "Remind Me With Call",
	content: "At least a popover that makes some sense..."
});
$(".ex6b_ccc").mouseover(function(event) {
var id = $(this).attr('name');
var array = id.split('_');
var e_id = array[1];
	event.preventDefault();
	event.stopPropagation();
	if(currentid!=0)
		  {
		$("#event_pop_"+currentid).popover(
		'content',
		''
		).popover('hide');
		$("#event_pop2_"+currentid).popover(
		'content',
		''
		).popover('hide');
		  }
		  currentid=e_id;
	$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>leadcontroller/sms_voice_me_event_ajax",
	   async:false,
	   data: 'event_id='+e_id,
	   cache: false,
	   success: function(msg)
	   {
	   $(".wrap").css("margin-left","193px");
	      $(this).removeClass("left-arrow"); 
          $(this).addClass("left-arrow-overwrite"); 
	   $("#event_pop_"+e_id).popover(
		'content',
		msg
	).popover('show');
	$("#event_pop_"+e_id).append('<input type="hidden" name="page_status_voice" value="home"/>');
	   }
	   }) 
});

<!------------------ ------------------------>
$(".ex6a_ccc2").popover({
	title: "SMS Me This Event",
	content: "At least a popover that makes some sense..."
});
$(".ex6b_ccc2").mouseover(function(event) {


var id = $(this).attr('name');
var array = id.split('_');
var e_id = array[1];
	event.preventDefault();
	event.stopPropagation();
	if(currentid!=0)
		  {   //$("#selector").popover('hide');
		  //alert(currentid);
		  $("#event_pop_"+currentid).popover(
		  'content',
		  ''
	).popover('hide');
		  
		  $("#event_pop2_"+currentid).popover(
		  'content',
		  ''
	).popover('hide');
		  //$("#event_pop2_"+currentid).popover('hide');
		  // $("#event_pop2_"+currentid).popover('setTrigger', 'click');
          //$("#event_pop2_"+currentid).popover(["init", ] { title: "SMS Me This Event" });
		  }
		  currentid=e_id;
	$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>leadcontroller/sms_me_event_ajax",
	   async:false,
	   data: 'event_id='+e_id,
	   cache: false,
	   success: function(msg)
	   {
	   $(".wrap").css("margin-left","193px");
	      //$(this).removeClass("left-arrow"); 
          //$(this).addClass("left-arrow-overwrite"); 
		  
	   $("#event_pop2_"+e_id).popover(
		'content',
		msg
	).popover('show');
	$("#event_pop2_"+e_id).append('<input type="hidden" name="page_status" value="home"/>');
	   }
	   }) 
});
function gotoevent(go)
{
window.location.href=go;
}
</script>



