
	<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row">
				<div class="span10">
					<h2><?php echo $university_details['univ_name']; ?> - <small><?php echo $country_name_university['country_name']; ?>
					, <?php echo $city_name_university['cityname']; ?></small></h2>
				</div>
				<div class="span4 float_r margin_t">
					<div class="margin_zero float_l">
						<div class="float_l"><img src="<?php echo "$base$img_path" ?>/user.png"></div>
						<div class="float_r margin_l"><small>Followers <?php print_r($count_followers); ?></small></div>
					</div>
					<div class="margin_zero float_r">
						<div class="float_l"><img src="<?php echo "$base$img_path" ?>/document.png"></div>
						<div class="float_r margin_l"><small>Articles <?php print_r($count_articles); ?></small></div>
					</div>
				</div>
			</div>
			<ul class="uni_gallery">
				<li><?php echo "<img src='".base_url()."uploads/univ_gallery/".$university_details['univ_logo_path']."'/>"; ?></li>
				<li><img src="<?php echo "$base$img_path" ?>/uni1-1.jpg" /></li>
				<li><img src="<?php echo "$base$img_path" ?>/uni1-2.jpg" /></li>
				<li><img src="<?php echo "$base$img_path" ?>/uni1-3.jpg" /></li>
				<li><img src="<?php echo "$base$img_path" ?>/uni1-4.jpg" /></li>
				<li><img src="<?php echo "$base$img_path" ?>/uni1-5.jpg" /></li>
				<li><img src="<?php echo "$base$img_path" ?>/uni1-6.jpg" /></li>
				<li class="clearfix"></li>
			</ul>
			<div class="row uni_menu_placeholder">
				<div class="span7 float_r">
					<ul class="uni_menu">
						<li>Home</li>
						<li>About</li>
						<li>Programs</li>
						<li>Events</li>
						<li>Questions & Answers</li>
						<li class="border_beta">News</li>
					</ul>
				</div>
			</div>
			<div class="clearfix"></div>
			<form class="form-horizontal" action="" method="post">
			<div class="row" style="margin-top:-25px">
				<div>
					<div class="span12 float_l margin_l margin_t">
						<div class="span8 margin_zero">
							<div class="letter_first">
									<div>
									<?php
									echo $university_details['about_us'];
									?>
								</div>
							</div>
							<!--<div id="show_popup_success_join" class="success_modal">
							You have Joined Successfully
							</div>-->
							<div>
								<h3 class="heading_follow">Followers</h3>
									<div class="float_l span6 margin_zero">
										<ul class="follow">
											<li>
												<div class="float_l">
													<div class="follow_img">
														<img src="<?php echo "$base$img_path" ?>/stud.jpg"> </br>
													</div>
												</div>
												<div class="float_l">
													<div class="follow_img">
														<img src="<?php echo "$base$img_path" ?>/stud.jpg"> </br>
													</div>
												</div>
												<div class="float_l">
													<div class="follow_img">
														<img src="<?php echo "$base$img_path" ?>/stud.jpg"> </br>
													</div>
												</div>
												<div class="float_l">
													<div class="follow_img">
														<img src="<?php echo "$base$img_path" ?>/stud.jpg"> </br>
													</div>
												</div>
												<div class="float_l">
													<div class="follow_img">
														<img src="<?php echo "$base$img_path" ?>/stud.jpg"> </br>
													</div>
												</div>
												<div class="float_l">
													<div class="follow_img">
														<img src="<?php echo "$base$img_path" ?>/stud.jpg"> </br>
													</div>
												</div>
												<div class="float_l">
													<div class="follow_img">
														<img src="<?php echo "$base$img_path" ?>/stud.jpg"> </br>
													</div>
												</div>
												<div class="float_l">
													<div class="follow_img">
														<img src="<?php echo "$base$img_path" ?>/stud.jpg"> </br>
													</div>
												</div>
												<div class="float_l">
													<div class="follow_img">
														<img src="<?php echo "$base$img_path" ?>/stud.jpg"> </br>
													</div>
												</div>
												<div class="float_l">
													<div class="follow_img">
														<img src="<?php echo "$base$img_path" ?>/stud.jpg"> </br>
													</div>
												</div>
											</li>
										</ul>
									</div>
									<div class="float_r" id="join_div">
									<?php
									if($is_already_follow == 0)
									{
									?>
									<input type="submit" name="join_now" class="btn btn-success" value="Join Now!"/>
									<?php } else { ?>
									<input type="submit" name="unjoin_now" class="btn btn-success" value="Unjoin Now!"/>
									<?php } ?>
									</div>
									
							</div>
						</div>
						<div class="span4 float_r">
								<div class="contact_detail">
									<h2>Contact Information</h2>
									<div>
										<div class="float_l"><h4>Office Address</h4></div>
										<div class="float_r span2 margin_zero"><?php echo $university_details['address_line1']; ?></div>
										<div class="clearfix"></div>
									</div>
									<div>
										<div class="float_l"><h4>Mobile Number</h4></div>
										<div class="float_r span2 margin_zero"><?php echo $university_details['phone_no']; ?></div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="map_layout"><img src="<?php echo "$base$img_path" ?>/map.png"/></div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="span4 float_r margin_t">
								<div class="college_form">
							<div>
							<h2 class="text_align">I AM INTERESTED</h2>
								<span>Interested in studying at Manipal University, Dubai Campus (RCPL)</span>
								<div class="fcnt_signBtn"></div>or Fill details for the institute to counsel you
								<div class="margin_t text_align"> 
									
										<fieldset>
											<div class="control-group">
												<input type="text" name="apply_name" class="input-medium" placeholder="Name">
											</div>
											<div class="control-group">
												<select name="apply_course_interest" id="apply_course_interest" class="span2">
													<option value="">Course of interest</option>
													<?php
													foreach($area_interest as $apply_interest)
													{
														echo "<option value=$apply_interest[prog_parent_id]> $apply_interest[program_parent_name] </option>";
													}
													?>
												</select>
											</div>
											<div class="control-group">
												<input type="text" name="apply_email" id="apply_email" class="input-medium" placeholder="Email Id">
											</div>
											<div class="control-group">
												<input type="text" name="apply_mobile" class="input-medium" placeholder="Mobile Number">
											</div>
											<!--<div class="control-group">
													<p class="help-block margin_alpha margin_b">Type in the characters you see below</p>
												<div class="float_l">
													<img src="<?php echo "$base$img_path" ?>/Captcha.jpg">
												</div>
												<div class="float_r margin_t">
													<input type="text" class="input_small">
												</div>
												<div class="clearfix"></div>
											</div>-->
											<div class="control-group">
												<input type="submit" name="apply_now" id="apply_now" value="Apply Now!" class="btn btn-primary"/>
											</div>
										 </fieldset>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="margin_t">
					<div class="span8 float_l margin_l">
						<div class="news_data_uni events_box event_height_uni">
								<h2>Events</h2>
								<ul>
									<li>Barnes, H.M. 2012. Durable composites: An overview. Proceedings, American Wood in floodplain lakes of the Mississippi Alluvial Valley. Durable composites: An overview. Proceedings, American Wood in floodplain lakes of the Mississippi<img src="<?php echo "$base$img_path" ?>/event_arrow.png"></li>
								</ul>
							</div>
							<div class="margin_t">
								<div class="well margin_gamma padding_zero" style="background-color: #DFF0D8;border: 1px solid #DDD;">
									<div>
										<div class="float_l">
											<div class="letter_uni">
											<div>Q Go Ask </br><span>uestion</span></div>
											</div>
										</div>
										<div class="float_r" style="width:348px;font-size:20px;margin: 25px 0px 0px 0px;color: #333;">
											<span>Have a Question?</span>
											<span>Ask our counselors!</span>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="margin">
										<div>
											<div class="float_l" style="font-size: 24px;margin-bottom:10px;color: #333;">what are the type of questions they ask in iit?</div>
											
											<div class="clearfix"></div>
										</div>
									</div>
									<div class="margin">
										<div>
											<div class="float_l">
												<div class="input-append">
													<input style="width:262px" id="appendedInput" size="16" type="text" placeholder="Enter Your Qusetion"><span class="add-on btn-info" style="padding: 3px 18px 6px 18px;color:#fff;font-size:16px;">Ask</span>
												</div>
											</div>
											<div class="float_r"><button class="btn btn-success" href="#" style="padding: 5px 20px;">More Q&amp;A</button></div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							</div>
							
					</div>
					<div class="span4 float_l">
						<div class="index_sidebar_box">
								<div class="artical_heading">Article</div>
							<div id="home" class="box artical_box_data">
								<div class="float_l">
									<img src="<?php echo "$base$img_path" ?>/layer.png">
								</div>
								<div>
									Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od vestibulum felis aesent eu.Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od vestibulum felis aesent eu nisl at eros vulputate fringilla uismod dictum. 
								</div>							
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="span4 float_l">
						<div class="index_sidebar_box">
							<div class="artical_heading">Article</div>
								<div id="home" class="box artical_box_data">
									<div class="float_l">
										<img src="<?php echo "$base$img_path" ?>/layer.png">
									</div>
									<div>
										Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od vestibulum felis aesent eu.Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od vestibulum felis aesent eu nisl at eros vulputate fringilla uismod dictum. 
									</div>							
								</div>
								<div class="clearfix"></div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="margin_t">
					<div class="span8 float_l margin_l">
						<div class="news_data_uni events_box news_box_uni">
							<h2>News</h2>
								<ul>
									<li><a>Barnes, H.M. 2012. Durable composites: An overview. Proceedings, American Wood.<img src="<?php echo "$base$img_path" ?>/event_arrow.png" class="news_arrow"></a></li>
									<li><a>Dembkowski, D.J., L.E. Miranda. 2012. Hierarchy in factors affecting fish biodiversity.<img src="<?php echo "$base$img_path" ?>/event_arrow.png" class="news_arrow"></a></li>
									<li><a>Barnes, H.M. 2012. Durable composites: An overview. Proceedings, American Wood.<img src="<?php echo "$base$img_path" ?>/event_arrow.png" class="news_arrow"></a></li>
									<li><a>Dembkowski, D.J., L.E. Miranda. 2012. Hierarchy in factors affecting fish biodiversity.<img src="<?php echo "$base$img_path" ?>/event_arrow.png" class="news_arrow"></a></li>
							</ul>
						</div>
					</div>
					<div class="span4 float_l">
						<div class="index_sidebar_box">
							<div class="artical_heading">Article</div>
								<div id="home" class="box artical_box_data">
									<div class="float_l">
										<img src="<?php echo "$base$img_path" ?>/layer.png">
									</div>
									<div>
										Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od vestibulum felis aesent eu.Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od vestibulum felis aesent eu nisl at eros vulputate fringilla uismod dictum. 
									</div>							
								</div>
								<div class="clearfix"></div>
						</div>
					</div>
					<div class="span4 float_l">
						<div class="index_sidebar_box">
							<div class="artical_heading">Article</div>
								<div id="home" class="box artical_box_data">
									<div class="float_l">
										<img src="<?php echo "$base$img_path" ?>/layer.png">
									</div>
									<div>
										Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od vestibulum felis aesent eu.Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od vestibulum felis aesent eu nisl at eros vulputate fringilla uismod dictum. 
									</div>							
								</div>
								<div class="clearfix"></div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>