<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=255162604516860";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>
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
				<div id="slider_slides"  class='gallery_div'>
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
				<form class="form-horizontal form_horizontal_home" id="search_form" action="" method="get">
					<input type="hidden" name="type_search" id="type_search" value="0"/>
					<input type="hidden" name="educ_level" id="educ_level" value="All"/>
					
					<div class="control-group">
						<label class="control-label" for="focusedInput"><h4 class="white">Explore</h4></label>
						<div class="controls">
							<div id="explore_button" class="btn-group" data-toggle="buttons-radio">
								<button type="button" class="btn active" id="events">Events</button>
								<button type="button" class="btn" id="colleges">Colleges</button>
							</div>
							<p class="help-block white form_height">colleges by programs, country and course level</p>
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
										<li class="li2 openddli" id="alumuni" ><a href="#" id="alu_dd">Alumuni</a></li>
									</ul>
								</div>	
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="focusedInput"><h4 class="white">in City</h4></label>
							<div class="dropdown_box">
								<div>
									<span id="selected_value">All</span>
									<span id="city_dropdown" class="caret" style="float: right;margin-top: 7px;"></span>
								</div>
								<div id="open_box">
									<input type="text" name="event_city" id="city" value=""/>
								</div>
							</div>
							<?php
									//foreach($cities as $city)
									//{ ?>
									 <?php //echo "value".$city['city_id']."<br/>"; ?><?php //echo ucwords($city['cityname']); ?>
								
								<?php //} ?>	
							<!--<div class="controls">
								<select name="event_city" id="city">
									<option value="">All</option>
									<?php
									foreach($cities as $city)
									{ ?>
									<option value="<?php echo $city['city_id']; ?>"><?php echo ucwords($city['cityname']); ?></option>
								
								<?php } ?>	
								</select>
							</div>-->
							<div class="controls">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="focusedInput"><h4 class="white">in the Month of</h4></label>
							<div class="float_l span4 margin_zero">
								<!--<input class="input-xlarge focused" id="focusedInput" type="text" value="" placeholder="Month">-->
								<input type="text" id="last_widget" class="btn_cal"> <img src="images/cal_img.png" id="last_widget_button" class="cal_style">
							</div>
							<div class="float_l span1">
									<input type="button" onclick="serch_events();" name="btn_evet_search" class="btn" value="Search"/>
									<input type="hidden" name="btn_event_serch" value="">
								</div>
								<div class="clearfix"></div>
						</div>
					</div>
					<div class="college" id="col">
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
								<!--<select id="search_country" name="search_country">
									<option value="">Select Country</option>
										<?php
										foreach($country as $srch_country)
										{
										?>
											<option value="<?php echo $srch_country['country_id'] ?>"><?php echo ucwords($srch_country['country_name']); ?></option>
										<?php
										}
										?>
								</select>-->
								<div class="dropdown_box_country">
									<div>
										<span id="selected_country">Selected Country</span>
										<span id="country_dropdown" class="caret" style="float: right;margin-top: 7px;"></span>
									</div>
									<div id="open_box_country">
										<input type="text" name="search_country" id="search_country" value=""/>
									</div>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="focusedInput"><h4 class="white">Course</h4></label>
							<div class="controls">
								<div class="dropdown_box_course">
									<div>
										<span id="selected_course">Select</span>
										<span id="course_dropdown" class="caret" style="float: right;margin-top: 7px;"></span>
									</div>
									<div id="open_box_course">
										<input type="text" name="search_program" id="search_program" value=""/>
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
			<div class="row">
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
			<div class="row">
				<div class="span16 margin_t margin_delta">
					<div class="float_l span7 margin_delta">
						<h2>Upcoming Events</h2>
						<div class="fix-height">
							<ul class="event_new">
								<li>
									<div>
										<div class="float_l">
											<div class="title_style"><h3 class="inline">University of Greenwich</h3><span class="inline"> &raquo; </span><h4 class="inline">Spot Admission British Council British Council</h4></div>
										</div>
										<div class="float_r">
											<a href="#"><img src="images/call.png" title="Reminder Call" alt="Reminder Call"></a>
												<a href="#"><img src="images/sms.png" title="Send SMS" alt="Send SMS"></a>
												<!--<a href="#"><img src="images/msg_box.png" title="Send Meassage" alt="Send Meassage"></a>-->
												<a href="#"><img src="images/map.png" title="Map" alt="Map"></a>
										</div>
										<div>
											<div class="img_style float_l">
												<img src="http://workforcetrack.in/uploads/univ_gallery/uog20logo1.jpg" style="width: 100px;"/>
											</div>
											<div class="float_l text-width" style="font-size:14px;">
												<h4 class="blue line_time">25 June, 2012</h4>
												<h4 class="line_time">British Council, New Delhi, India</h4>
												<button class="btn btn-primary" href="#">Register</button>
											</div>
											<div class="float_r registered">
													<h2 class="blue">15</h2>	
													<h4 class="blue">Registered</h4>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</li>
								<li>
									<div>
										<div class="float_l">
											<div class="title_style"><h3 class="inline">University of Greenwich</h3><span class="inline"> &raquo; </span><h4 class="inline">Spot Admission British Council British Council</h4></div>
										</div>
										<div class="float_r">
											<a href="#"><img src="images/call.png" title="Reminder Call" alt="Reminder Call"></a>
												<a href="#"><img src="images/sms.png" title="Send SMS" alt="Send SMS"></a>
												<!--<a href="#"><img src="images/msg_box.png" title="Send Meassage" alt="Send Meassage"></a>-->
												<a href="#"><img src="images/map.png" title="Map" alt="Map"></a>
										</div>
										<div>
											<div class="img_style float_l">
												<img src="http://workforcetrack.in/uploads/univ_gallery/uog20logo1.jpg" style="width: 100px;"/>
											</div>
											<div class="float_l text-width" style="font-size:14px;">
												<h4 class="blue line_time">25 June, 2012</h4>
												<h4 class="line_time">British Council, New Delhi, India</h4>
												<button class="btn btn-primary" href="#">Register</button>
											</div>
											<div class="float_r registered">
													<h2 class="blue">15</h2>	
													<h4 class="blue">Registered</h4>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</li>
								<li>
									<div>
										<div class="float_l">
											<div class="title_style"><h3 class="inline">University of Greenwich</h3><span class="inline"> &raquo; </span><h4 class="inline">Spot Admission British Council British Council</h4></div>
										</div>
										<div class="float_r">
											<a href="#"><img src="images/call.png" title="Reminder Call" alt="Reminder Call"></a>
												<a href="#"><img src="images/sms.png" title="Send SMS" alt="Send SMS"></a>
												<!--<a href="#"><img src="images/msg_box.png" title="Send Meassage" alt="Send Meassage"></a>-->
												<a href="#"><img src="images/map.png" title="Map" alt="Map"></a>
										</div>
										<div>
											<div class="img_style float_l">
												<img src="http://workforcetrack.in/uploads/univ_gallery/uog20logo1.jpg" style="width: 100px;"/>
											</div>
											<div class="float_l text-width" style="font-size:14px;">
												<h4 class="blue line_time">25 June, 2012</h4>
												<h4 class="line_time">British Council, New Delhi, India</h4>
												<button class="btn btn-primary" href="#">Register</button>
											</div>
											<div class="float_r registered">
													<h2 class="blue">15</h2>	
													<h4 class="blue">Registered</h4>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="float_l">
						<div class="float_l span5">
							<h2>News</h2>
							<div id="slides_content">
								<div class="slides_container">
									<div>
										<h3>Study Aboard</h3>
										<span class="float_l" style="line-height: 8px;border: 2px solid #DDD;margin-right:15px;padding: 2px">
											<img src="images/layer.png" style="width: 70px;height: 70px;">
										</span>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
										Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
									
									</div>
									<div>
										<h3>Spot Admission</h3>
										<span class="float_l" style="line-height: 8px;border: 2px solid #DDD;margin-right:15px;padding: 2px">
											<img src="images/layer.png" style="width: 70px;height: 70px;">
										</span>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
										Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
									</div>
									<div>
										<h3>Spot Admission</h3>
										<span class="float_l" style="line-height: 8px;border: 2px solid #DDD;margin-right:15px;padding: 2px">
											<img src="images/layer.png" style="width: 70px;height: 70px;">
										</span>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
										Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
									</div>
									<div>
										<h3>Spot Admission</h3>
										<span class="float_l" style="line-height: 8px;border: 2px solid #DDD;margin-right:15px;padding: 2px">
											<img src="images/layer.png" style="width: 70px;height: 70px;">
										</span>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
										Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
									</div>
								</div>
							</div>
						</div>
						<div class="float_l span4">
							<h2>Featured Colleges</h2>
							<div>
							<ul class="col_img">
								<li>
									<div class="float_l featured_art">
										<a href="#"><img src="http://workforcetrack.in//uploads/univ_gallery/250px-Aberdeen_university_logo.gif" class="college_img_center"></a>
									</div>
									<div class="float_l featured_art" style="margin-right: 0px;">
										<a href="#"><img src="http://workforcetrack.in/uploads/univ_gallery/logo.jpg" class="college_img_center"></a>
									</div>
									<div class="float_l featured_art ">
										<a href="#"><img src="http://workforcetrack.in//uploads/univ_gallery/250px-Aberdeen_university_logo.gif" class="college_img_center"></a>
									</div>
									<div class="float_l featured_art" style="margin-right: 0px;">
										<a href="#"><img src="http://workforcetrack.in//uploads/univ_gallery/250px-Aberdeen_university_logo.gif" class="college_img_center"></a>
									</div>
									<div class="float_l featured_art ">
										<a href="#"><img src="http://workforcetrack.in//uploads/univ_gallery/250px-Aberdeen_university_logo.gif" class="college_img_center"></a>
									</div>
									<div class="float_l featured_art" style="margin-right: 0px;">
										<a href="#"><img src="http://workforcetrack.in//uploads/univ_gallery/250px-Aberdeen_university_logo.gif" class="college_img_center"></a>
									</div>
								</li>
							</ul>
							<div class="clearfix"></div>
							</div>
							<div>
								<div style="padding-top: 8px;">
									<div class="btn-group">
										<button class="btn status_bg" style="height: 43px;font-size: 24px;border: 1px solid 
										#FDD69E;padding: 4px 32px 4px;">8999</button>
										<button class="btn status_bg" style="height: 43px;font-size: 24px;border: 1px solid 
										#FDD69E;padding: 4px 32px 4px;">2225</button>
									</div>
									<div class="label_text">
										<ul>
											<li><a href="#">EVENTS</a></li>
											<li><a href="#">ANSWERS</a></li>
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
					<div style="padding:10px;background:#f1f7b4;-webkit-box-shadow: 0px 0px 6px
					#999;-moz-box-shadow: 0px 0px 6px #888;">
							<ul class="yellow yellow_nav">
						<li><a href="#">Engineering</a></li>
						<li><a href="#">Medical</a></li>
						<li><a href="#">Media &amp; Journalism</a></li>
						<li><a href="#">Hospitality </a></li>
						<li><a href="#">Technology  </a></li>
						<li><a href="#">Science</a></li>
						<li><a href="#">Animation</a></li>
						<li><a href="#" style="border:none;">MBA</a></li>
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
							<h3>what are the type of questions they ask in iit?</h3>
							<div class="margin_t1">
								<div class="input-append">
									<form action="http://workforcetrack.in/QuestandAns" method="post">
										<input class="span4 margin_zero" id="appendedInput" name="quest_on_univ" size="16" type="text" placeholder="Enter Your Qusetion">
										<input type="submit" id="ask_quest" name="ask_quest" class="add-on btn-info" style="padding: 3px 18px 6px 18px;color:#fff;font-size:16px;height:28px;" value="Ask">
									</form>
								</div>
							</div>
							<div class="margin_t1">
								<h2>Latest Q&A</h2>
								<ul class="prof_data">	
									<li>
										<div style="width: 34px;margin-right:20px" class="float_l"><img src="images/stud.png" style="width:34px;height:34px;border: 2px solid #DDD;padding:2px;"></div>
										<span class="black">Fees of plane bsc at fergusson college</span>
										<div style="font-size: 11px;line-height: 12px;">Asked by Neha Sharma</div>
										<div style="font-size: 11px;line-height: 12px;">25 June, 2011</div>
									</li>
									<li>
										<div style="width: 34px;margin-right:20px" class="float_l"><img src="images/stud.png" style="width:34px;height:34px;border: 2px solid #DDD;padding:2px;"></div>
										<span class="black">Fees of plane bsc at fergusson college</span>
										<div style="font-size: 11px;line-height: 12px;">Asked by Neha Sharma</div>
										<div style="font-size: 11px;line-height: 12px;">25 June, 2011</div>
									</li>
									<li>
										<div style="width: 34px;margin-right:20px" class="float_l"><img src="images/stud.png" style="width:34px;height:34px;border: 2px solid #DDD;padding:2px;"></div>
										<span class="black">Fees of plane bsc at fergusson college</span>
										<div style="font-size: 11px;line-height: 12px;">Asked by Neha Sharma</div>
										<div style="font-size: 11px;line-height: 12px;">25 June, 2011</div>
									</li>
									<li>
										<div style="width: 34px;margin-right:20px" class="float_l"><img src="images/stud.png" style="width:34px;height:34px;border: 2px solid #DDD;padding:2px;"></div>
										<span class="black">Fees of plane bsc at fergusson college</span>
										<div style="font-size: 11px;line-height: 12px;">Asked by Neha Sharma</div>
										<div style="font-size: 11px;line-height: 12px;">25 June, 2011</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="float_l">
						<div class="float_l span5" style="text-align:justify">
							<h2 style="line-height: 20px;">Article</h2>
							<div class="margin_t1 part_art">
								<h3>Spot Admission</h3>
									<span class="float_l" style="line-height: 8px;border: 2px solid #DDD;margin-right:15px;padding: 2px">
										<img src="images/layer.png" style="width: 70px;height: 70px;">
									</span>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.Ut enim ad minim veniam, quis nostrud exercitation ullamco.Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
							</div>
							<div class="margin_t1 part_art">
								<h3>Spot Admission</h3>
								<span class="float_l" style="line-height: 8px;border: 2px solid #DDD;margin-right:15px;padding: 2px">
									<img src="images/layer.png" style="width: 70px;height: 70px;">
								</span>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.Ut enim ad minim veniam, quis nostrud exercitation ullamco.Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
							</div>
						</div>
						<div class="float_l span4">
							<img src="images/facebook_img.png">
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
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
<script type="text/javascript">
$(document).ready(function(){
	$("#open_box").hide();
	
	$("#city").autocomplete({
		source: ["All", "BBSR", "New Delhi", "Southdelhi", "Jwala Heri", "Demo", "Sdsd"],
		width: 260,
		//matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false,
		minLength: 0,
		}).focus(function() {
	$(this).autocomplete('search', '')
	});
		
	$(document).keydown(function(event) {
    if(event.keyCode == 13) {
        var value = $("#city").val();
		$("#selected_value").html(value);
		$("#open_box").hide();
		$("#city").val("");	
    }
	});
	
	$("html").click(function(e){
		if((e.target.id == "city_dropdown")){
			$("#open_box").show();
			$("#city").trigger('focus');
			$("#city").val("");
		}else if(e.target.id == "city"){
			$("#open_box").show();
			$("#city").trigger('focus');
			$("#city").val("");
		}else{
			$("#open_box").hide();
		}
	});
	
	
	$(".ui-corner-all").click(function(){
		var value = $("#city").val();
		$("#selected_value").html(value);
		$("#open_box").hide();
		$("#city").val("");
	});
	
	$("#open_box_country").hide();
	
	$("#search_country").autocomplete({
		source: ["India", "U.K."],
		width: 260,
		//matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false,
		minLength: 0,
		}).focus(function() {
	$(this).autocomplete('search', '')
	});
		
	$(document).keydown(function(event) {
    if(event.keyCode == 13) {
        var value = $("#search_country").val();
		$("#selected_country").html(value);
		$("#open_box_country").hide();
		$("#search_country").val("");	
    }
	});
	
	$("html").click(function(e){
		if((e.target.id == "country_dropdown")){
			$("#open_box_country").show();
			$("#search_country").trigger('focus');
			$("#search_country").val("");
		}else if(e.target.id == "search_country"){
			$("#open_box_country").show();
			$("#search_country").trigger('focus');
			$("#search_country").val("");
		}else{
			$("#open_box_country").hide();
		}
	});
	
	
	$(".ui-corner-all").click(function(){
		var value = $("#search_country").val();
		$("#selected_country").html(value);
		$("#open_box_country").hide();
		$("#search_country").val("");
	});

	
	$("#open_box_course").hide();
	
	$("#search_program").autocomplete({
		source: ["Agriculture, Environment And Related Subjects", "Applied And Pure Sciences", "Architecture", "Building And Planning", "Creative Arts And Design", "Education And Teacher Training", "Engineering And Technology", "Humanities", "Health And Medicine"],
		width: 260,
		//matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false,
		minLength: 0,
		}).focus(function() {
	$(this).autocomplete('search', '')
	});
		
	$(document).keydown(function(event) {
    if(event.keyCode == 13) {
        var value = $("#search_program").val();
		$("#selected_course").html(value);
		$("#open_box_course").hide();
		$("#search_program").val("");	
    }
	});
	
	$("html").click(function(e){
		if((e.target.id == "course_dropdown")){
			$("#open_box_course").show();
			$("#search_program").trigger('focus');
			$("#search_program").val("");
		}else if(e.target.id == "search_program"){
			$("#open_box_course").show();
			$("#search_program").trigger('focus');
			$("#search_program").val("");
		}else{
			$("#open_box_course").hide();
		}
	});
	
	
	$(".ui-corner-all").click(function(){
		var value = $("#search_program").val();
		$("#selected_course").html(value);
		$("#open_box_course").hide();
		$("#search_program").val("");
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
<SCRIPT LANGUAGE="JavaScript">     
 function popup(id) {
 /* $('#myModal').modal({
        keyboard: false
    }) */
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
	  //$('#search_program').html(msg);
	   }
	   }) 
//alert(id);
/* var URL = "<?php echo site_url('leadcontroller/sms_me_event');?>";
//window.open("<?php echo site_url('controller/method/param1/param2/etc');?>", 'width=150,height=150'); 
day = new Date();
id = day.getTime();
window.open(URL, 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=880,height=300'); */
} 

//Code For Voice API

function voicepopup(id) {
 /* $('#myModal').modal({
        keyboard: false
    }) */
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
	  //$('#search_program').html(msg);
	   }
	   }) 
//alert(id);
/* var URL = "<?php echo site_url('leadcontroller/sms_me_event');?>";
//window.open("<?php echo site_url('controller/method/param1/param2/etc');?>", 'width=150,height=150'); 
day = new Date();
id = day.getTime();
window.open(URL, 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=880,height=300'); */
} 

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
   });
   $('#events').click(function() {
		$("#col").hide();
		$("#events_col").show();
   });
});
</script>	
<script>
$(document).ready(function(){
$('#allcollege').click(function(){
$('#type_search').val('0');
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
var country=$('#search_country option:selected').text();
country=country.replace(' ','_');
var prog= $('#search_program option:selected').text();
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
$("#search_form").attr("action","events_search");
$('#btn_event_serch').val('event_search');
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
			$('#slider_slides').slides({
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

