
	<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			
			
			<?php $this->load->view('auth/univ-header-gallery-logo'); ?>
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
											<?php
											if(!empty($followers_detail_of_univ))
											{
											foreach($followers_detail_of_univ as $followers)
											{
											//echo $followers['id'].'-----'.$followers['user_pic_path'];
											?>
												<div class="float_l">
													<div class="follow_img">
														<a href="<?php echo "$base"; ?>user/<?php echo $followers['id']; ?>"><?php echo "<img style='width:63px;height:55px;' src='".base_url()."uploads/".$followers['user_pic_path']."'/>"; ?></a> </br>
													</div>
												</div>
												
											<?php } } ?>
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
								<div class="map_layout">
								<?php echo $headerjs; ?>
							<?php echo $headermap; ?>
							<?php echo $onload; ?>
							<?php echo $map; ?>
							<?php echo $sidebar; ?>
								</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<?php $this->load->view('auth/univ-fb-sidebar'); ?>
			<div class="margin_t">
					<div class="span8 float_l margin_l">
						<div class="news_data_uni events_box event_height_uni">
								<h2>Events</h2>
								<ul>
									<li>
									<?php
									//foreach($events_of_univ as $events)
									//{
									//print_r($events_of_univ);
									if(!empty($events_of_univ))
									{
									if($events_of_univ['featured_home_event'] == '1' && $events_of_univ['event_type'] == 'univ_event' )
									{
										print_r($events_of_univ['event_title']);
									
									?>
									<img src="<?php echo "$base$img_path" ?>/event_arrow.png">
									<?php
									}
									}
									//}
									?>
									</li>
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
							<div class="margin_t">
								<div class="news_data_uni events_box news_box_uni">
									<h2>News</h2>
										<ul>
										<?php
										foreach($article_news_gallery as $news)
										{
										if($news['na_type'] == 'news' && $news['na_type_ud'] == 'univ_na')
										{
										?>
											<li><a href="#"><?php echo $news['na_detail']; ?><img src="<?php echo "$base$img_path" ?>/event_arrow.png" class="news_arrow"></a></li>
										<?php } } ?>	
									</ul>
								</div>
							</div>
					</div>
					<div class="span8 float_l">
					<?php
					foreach($article_news_gallery as $article)
					{
					if($article['na_type'] == 'article' && $article['na_type_ud'] == 'univ_na')
					{
					?>
						<div class="span4 float_l margin_zero">
							<div class="index_sidebar_box">
									<div class="artical_heading"><?php echo $article['na_title']; ?></div>
								<div id="home" class="box artical_box_data">
									<div class="float_l">
										<?php echo "<img src='".base_url()."uploads/news_article_images/".$article['na_image_path']."'/>"; ?>
									</div>
									<div>
										<?php echo $article['na_detail']; ?>
									</div>							
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						
					<?php } } ?>		
							
					</div>
					<div class="clearfix"></div>
				</div>
				
			</div>
		</div>
	</div>