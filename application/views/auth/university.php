<form class="form-horizontal" action="" method="post">
<div class="row" style="margin-top:-5px">
	<div class="span8 margin_l float_l margin_t">
		<div class="univ_content letter_first">
			<?php
			$univ_detail=str_replace("<div>","<p>",$university_details['about_us']);
			$univ_detail=str_replace("</div>","</p>",$univ_detail);
			echo substr($univ_detail,0,500);
			$count_view_more_string = strlen($university_details['about_us']);
			?>
			<?php
			if($count_view_more_string > 500)
			{
			echo '..';
			?>.
			</br>
			<a href="<?php echo $base; ?>about-<?php echo $university_details['univ_id']; ?>-university" class="float_r">View more detail</a>
			<?php } ?>
		</div>
		<div class="margin_t">
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
					<?php 		if($followers['user_pic_path']!='')  { ?>	
									<a href="<?php echo "$base"; ?>user/<?php echo $followers['id']; ?>">
									<img style='width:63px;height:55px;' src='<?php echo $base; ?>uploads/<?php echo$followers['user_pic_path']; ?>' /></a>
				<?php } else { ?>
						<a href="<?php echo "$base"; ?>user/<?php echo $followers['id']; ?>">
									<img style='width:63px;height:55px;' src='<?php echo $base; ?>images/user_model.png' /></a>
				<?php } ?>
									</br>
								</div>
							</div>
							
						<?php } } else { echo "<h3>Be the first follower...</h3>"; } ?>
						</li>
					</ul>
				</div>
				<div class="float_r" id="join_div">
				<?php
				if($is_already_follow == 0)
				{
				?>
				<input type="submit" name="join_now" class="btn btn-success" value="Follow !"/>
				<?php } else { ?>
				<input type="submit" name="unjoin_now" class="btn btn-success" value="UnFollow !"/>
				<?php } ?>
				</div>
				<div class="clearfix"></div>
		</div>
		<div class="margin_t">
			<div class="events_univ events_box event_height_uni">
				<h2>Events</h2>
				 <ul>
				 <?php
					if(!empty($events_of_univ))
					{
					foreach($events_of_univ as $events)
					{ 
					?>
					<li>
					<!-- Check upcoming events with date
					//$todays_date = date("Y M d");
					//$today = strtotime($todays_date);
					//$event_date = date("Y M d", strtotime($events_of_univ['event_date_time']));
					//echo $events_of_univ['event_date_time'];
					/* Check End Here */
					//if($event_date > $today)
					//{-->
					<?php if($events['event_type'] == 'univ_event' )
					{
						echo $events['event_title'].','. $events['event_date_time'];
					
					?>
				<a href="<?php echo $base ?>univ-<?php echo $university_details['univ_id'] ?>-event-<?php echo $events['event_id']; ?>"><img src="<?php echo "$base$img_path" ?>/event_arrow.png">
				</a>	<?php
					//}
					} ?>
					</li>
					<?php } ?>
					<?php } else { echo " <center><h3><span style='color:maroon'>No Recent Event Available</span></h3></center> "; }
					//}
					?>
					
				 </ul>
			</div>
		</div>
		<div class="margin_t">
			<div class="well margin_gamma padding_zero new_data">
				<div>
					<div class="float_l">
						<div class="letter_uni">
						<div>Q Go Ask </br><span>uestion</span></div>
						</div>
					</div>
					<div class="float_r have_data">
						<span>Have a Question?</span>
						<span>Ask our counselors!</span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="margin">
					<div>
						
						
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="margin">
					<div>
						<div class="float_l">
							<div class="input-append">
								<input style="width:262px" id="appendedInput" name="quest_on_univ" size="16" type="text" placeholder="Enter Your Qusetion">
								<input type="submit" id="ask_quest" name="ask_quest" class="add-on btn-info" style="padding: 3px 18px 6px 18px;color:#fff;font-size:16px;height:28px;" value="Ask">
							</div>
						</div>
						<div class="float_r"><button class="btn btn-success more_btn" href="#">More Q&amp;A</button></div>
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
						if(!empty($news_gallery))
						{
						foreach($news_gallery as $news)
						{
						
						?>
						<li><a href="<?php echo $base ?>univ-<?php echo $university_details['univ_id'] ?>-news-<?php echo $news['news_id']; ?>">
						<?php echo substr($news['news_detail'],0,300).'..'; ?>
						<img src="<?php echo "$base$img_path" ?>/event_arrow.png" class="news_arrow"></a>
						</li>
										<?php  } } else { echo " <center><h3><span style='color:maroon'>No Recent News Available</span></h3></center> "; }?>	
					</ul>
			</div>
		</div>
	</div>	
	<div class="span8 float_l" style="margin-top:-30px">
		<div>
			<div class="span4 float_l margin_zero">
				<div class="contact_detail">
					<h2>Contact Information</h2>
					<div>
						<div class="float_l"><h4>Office Address</h4></div>
						<div class="float_r span2 margin_zero contact_height"><?php echo $university_details['address_line1']; ?></div>
						<div class="clearfix"></div>
					</div>
					<div>
						<div class="float_l"><h4>Mobile Number</h4></div>
						<div class="float_l span3 margin_zero"><?php echo $university_details['phone_no']; ?></div>
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
			
			<?php $this->load->view('auth/univ-fb-sidebar'); ?>
			<div class="clearfix"></div>
		</div>
		<div class="artical_width float_l">
			<?php
			foreach($article_gallery as $article)
			{
			?>
				<div class="span4 float_l margin_t">
					<div class="index_sidebar_box">
							<div class="artical_heading"><a href="<?php echo $base ?>univ-<?php echo $university_details['univ_id'] ?>-article-<?php echo $article['article_id']; ?>"><?php echo $article['article_title']; ?></a></div>
						<div id="home" class="artical_box_data">
							<div class="float_l content_art">
								<?php
								if($article['article_image_path']!='')
								{
								echo "<img class='artical_img' src='".base_url()."uploads/news_article_images/".$article['article_image_path']."'/>";
								}
								else
								{
								echo "<img class='artical_img' src=".base_url()."images/default_logo.png />";
								}
								?>
							</div>
							<div>
								<?php echo substr($article['article_detail'],0,380).'....'; ?>
							</div>							
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				
			<?php  } ?>		
							
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</div>
</form>