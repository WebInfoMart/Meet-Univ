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
<form class="form-horizontal" action="" method="post" id="frm_university">
<div class="row" style="margin-top:-5px">
	<div class="span8 margin_l float_l margin_t">
		<div class="univ_content letter_first">
			<?php
			$univ_detail=str_replace("<div>","<p>",$university_details['univ_overview']);
			$univ_detail=str_replace("</div>","</p>",$univ_detail);
			if($university_details['univ_overview'] != '')
			{
			echo substr($univ_detail,0,500);
			}
			$count_view_more_string = strlen($university_details['univ_overview']);
			$univ_domain=$university_details['subdomain_name'];
			$subdomain=$this->subdomain->generate_univ_link_by_subdomain($univ_domain);								
		?>
			<?php
			if($count_view_more_string > 500)
			{
			echo '..';
			?>.
			</br>
			
			<a href="<?php echo $subdomain; ?>/about" class="float_r">View more detail</a>
			<?php } ?>
		</div>
		<div class="margin_t">
			<h3 class="heading_follow">Followe</h3>
				<div class="float_l span6 margin_zero">
					<ul class="follow">
						<li>
						<?php
						$logged_user_id = $this->tank_auth->get_user_id(); 
						if(!empty($followers_detail_of_univ))
						{
						foreach($followers_detail_of_univ as $followers)
						{
						//echo $followers['id'].'-----'.$followers['user_pic_path'];
						?>
							<div class="float_l">
								<div class="follow_img" style="width:50px;height:50px;">
								<?php
								if($logged_user_id==$followers['id'])
								{
								$link=base_url().'home';
								}
								else
								{
								$fullname =$this->subdomain->process_url_title($followers['fullname']);	
								$link = base_url().'user/'.$followers['id'].'/'.$fullname;								
								}
								if(file_exists(getcwd().'/uploads/user_pic/thumbs/'.$followers['user_thumb_pic_path']) && $followers['user_thumb_pic_path']!='' )
										{
										//echo $image_thumb = $profile_pic['user_pic_path'].'_thumb';
											echo "<a href=$link><img src='".base_url()."uploads/user_pic/thumbs/".$followers['user_thumb_pic_path']."' class='latest_img' style='width:63px;height:55px;'/></a>";
										}
										else if(file_exists(getcwd().'/uploads/user_pic/'.$followers['user_pic_path']) && $followers['user_pic_path']!='')
										{
											echo "<a href=$link><img src='".base_url()."uploads/user_pic/".$followers['user_pic_path']."' class='latest_img' style='width:63px;height:55px;'/></a>";
										}
										else if($user && $followers['id'] == $logged_user_id)
										{
										?>
											<a href="<?php echo $link; ?>"><img src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=small" class='latest_img' style='width:63px;height:55px;'></a>
										<?php
										}
										else{
											echo "<a href=$link><img class='latest_img' style='width:63px;height:55px;' src='".base_url()."images/profile_icon.png'/></a>";
										}
								?>
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
					$event_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'event',$events['event_title'],$events['event_id'])
					?>
				<a href="<?php echo $event_link; ?>"><img src="<?php echo "$base$img_path" ?>/event_arrow.png">
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
						$news_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'news',$news['news_title'],$news['news_id'])
					
						?>
						<li><a href="<?php echo $news_link; ?>">
						<?php echo substr($news['news_detail'],0,300).'..'; ?>
						<img src="<?php echo "$base$img_path" ?>/event_arrow.png" class="news_arrow"></a>
						</li>
										<?php  } } else { echo " <center><h3><span style='color:maroon'>No Recent News Available</span></h3></center> "; }?>	
					</ul>
			</div>
		</div>
	</div>	
	<div class="span8 float_l" style="margin-top:-30px">
		<div class="contact_detail">
			<h2>Contact Information</h2>
			<div>
				<div class="float_l"><h4>Office Address</h4></div>
				<div class="float_r span6 margin_zero contact_height">
				<?php
				if($university_details['address_line1']!='') {
				echo $university_details['address_line1']; } else { echo "&nbsp;Not Available"; } ?></div>
				<div class="clearfix"></div>
			</div>
			<div>
				<div class="float_l"><h4>Mobile Number </h4></div>
				<div class="float_l span3 margin_zero"><?php if($university_details['phone_no']!='' ) { echo '&nbsp;'.$university_details['phone_no']; }
		else { echo "Not Available"; } ?></div>
				<div class="clearfix"></div>
			</div>
			<div>
				<div class="float_l"><h4>Fax </h4></div>
				<div class="float_l span3 margin_zero"> <?php 
				if($university_details['univ_fax']!='' ) { 
				echo '&nbsp;'.$university_details['univ_fax']; } else { echo '&nbsp;Not Available'; } ?></div>
				<div class="clearfix"></div>
			</div>
						<div>
				<div class="float_l"><h4>Email </h4></div>
				<div class="float_l span3 margin_zero"> <?php
				if($university_details['univ_email']!='') { 
				echo '&nbsp;'.$university_details['univ_email']; } else { echo "&nbsp;Not Available"; }?></div>
				<div class="clearfix"></div>
			</div>
			<div>
				<div class="float_l"><h4>Website </h4></div>
				<div class="float_l span3 margin_zero"> <?php if($university_details['univ_web']!='') { 
				echo '&nbsp;'.$university_details['univ_web']; } else { echo "&nbsp;Not Available"; } ?></div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div>
			<div class="span4 float_l margin_zero">
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
			$ac=0;
			foreach($article_gallery as $article)
			{
			$ac++;
			$article_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'articles',$article['article_title'],$article['article_id']);
					
			?>
				<div class="span4 float_l margin_t">
					<div class="index_sidebar_box">
							<div class="artical_heading"><a href="<?php echo $article_link; ?>" ><?php echo $article['article_title']; ?></a></div>
						<div id="home" class="artical_box_data">
							<div class="float_l content_art">
								<?php
									$image_exist=0;	
									$article_img = $article['article_image_path'];	
									if(file_exists(getcwd().'/uploads/news_article_images/'.$article_img) && $article_img!='')	
									{
									$image_exist=1;
								    list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/news_article_images/'.$article_img);
									}
									else if( file_exists(getcwd().'/images/default_logo.png'))
									{
									$image_exist =2;
									list($width, $height, $type, $attr) = getimagesize(getcwd().'/images/default_logo.png');
									}
									else
									{
									list($width, $height, $type, $attr) = getimagesize(getcwd().'/images/logo.png');
									}
									if($article_img !='' && $image_exist==1)
									{
									$image=$base.'uploads/news_article_images/'.$article_img;
									}
									else if ($image_exist==2)
									{
									$image=$base.'images/default_logo.png';
									}
									else
									{
									$image=$base.'images/logo.png';
									}
									
									$img_arr=$this->searchmodel->set_the_image($width,$height,105,71,TRUE);
							?>

											<img style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" src="<?php echo $image; ?>" >
									
							</div>
							<div>
								<?php echo substr(strip_tags($article['article_detail']),0,380).'....'; ?>
							</div>							
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				
			<?php 
			if($ac==2)
			{
			break;
			}
			} ?>		
							
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</div>
</form>