<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row margin_t1">
				<div class="float_l span13 margin_l">
					
				<!--<div class="float_r" >
				<div class="float_l" style="margin-right:15px;"><g:plusone size="medium" annotation="none"></g:plusone></div>
				<div class="float_l" style="margin-right:10px;"><div class="fb-like" data-href="<?php $_SERVER['REQUEST_URI']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div></div>
				<div class="float_l">
					<a href="https://twitter.com/share" class="twitter-share-button" data-via="munjal_sumit" data-count="none">Tweet</a>
				</div>
				<div class="clearfix"></div>
				</div>-->
				<div class="span9 margin_zero float_l">
					<h3>Recent Articles</h3>
					<div class="margin_t1">
				
					<ul class="event_new">
					<?php
					foreach($articles as $articles_detail){
					$univ_domain=str_replace(' ','-',$articles_detail['subdomain_name']);
							$article_title =$this->subdomain->process_url_title($articles_detail['article_title']);	
$article_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'articles',$article_title,$articles_detail['article_id']);							
					$image_exist=0;	
									$article_img = $articles_detail['article_image_path'];	
									if(file_exists(getcwd().'/uploads/news_article_images/'.$article_img) && $article_img!='')	
									{
									$image_exist=1;
								   list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/news_article_images/'.$article_img);
									}
									else if(file_exists(getcwd().'/uploads/univ_gallery/'.$articles_detail['univ_logo_path']) && $articles_detail['univ_logo_path']!='')
									{
									$image_exist=2;
								   list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/univ_gallery/'.$articles_detail['univ_logo_path']);			
									}
									else
									{
									list($width, $height, $type, $attr) = getimagesize(getcwd().'/'.$img_path.'/default_logo.png');
								    }
									if($article_img!='' && $image_exist==1)
									{
									$image=$base.'uploads/news_article_images/'.$article_img;
									}
									else if($articles_detail['univ_logo_path']!='' && $image_exist==2)
									{
									$image=$base.'uploads/univ_gallery/'.$articles_detail['univ_logo_path'];
									}
									else
									{
									$image=$base.$img_path.'/default_logo.png';
									} 
									$img_arr=$this->searchmodel->set_the_image($width,$height,106,71,TRUE);
									
				?>
						<li>
							<div class="float_l span5 margin_zero">
								<h3><a href="<?php echo $article_link; ?>"><?php echo $articles_detail['article_title']; ?></a></h3>
							</div>
							<div class="float_r span4 margin_zero">
								<!--<div class="social_set float_r">
									<div id="gp" class="float_l">
										<g:plusone size='medium' id='shareLink' annotation='none' href='<?php echo $article_link; ?>' callback='countGoogleShares' data-count="true"></g:plusone>
									</div>
									<div id="tw" class="float_l tw"><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $article_link; ?>" data-via="munjal_sumit" data-lang="en">Tweet</a>
									</div>
									<div id="fb" class="float_r fb"><div class="fb-like" data-href="<?php echo $article_link; ?>" data-send="false" data-layout="button_count" data-width="10" data-show-faces="true" data-font="arial"></div>
									</div>
								</div>-->
							</div>
								<div class="clearfix"></div>
							<div class="margin_t1 img_height">
								<div class="img_style float_l img_r aspectcorrect">
									<img style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" src="<?php echo $image; ?>" class="img_event">
								</div>
								<div><img src="<?php echo "$base$img_path"; ?>/clock.png" class="line_img inline"><span class="blue line_time inline"><abbr class="timeago time_ago" title="<?php echo $articles_detail['publish_time']; ?>"></abbr>
								</span></div>
								<?php echo substr($articles_detail['article_detail'],0,420).'..';
								if((strlen($articles_detail['article_detail'])>420))
								{?>
								<a href="<?php echo $article_link; ?>" style="font-size:13px;font-weight:bold">view more</a>
								<?php
								}
								?>
							</div>
						</li>
						<?php } ?>
					</ul>
					<?php /*foreach($articles as $articles_detail){
					
				?>
					<div id="effect-style">
						<div class="event_border ">
							<div class="float_l event_border_div aspectcorrect">
									<?php
									$image_exist=0;	
									$article_img = $articles_detail['article_image_path'];	
									if(file_exists(getcwd().'/uploads/news_article_images/'.$article_img) && $article_img!='')	
									{
									$image_exist=1;
								   list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/news_article_images/'.$article_img);
									}
									else if(file_exists(getcwd().'/uploads/univ_gallery/'.$articles_detail['univ_logo_path']) && $articles_detail['univ_logo_path']!='')
									{
									$image_exist=2;
								   list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/univ_gallery/'.$articles_detail['univ_logo_path']);			
									}
									else
									{
									list($width, $height, $type, $attr) = getimagesize(getcwd().'/'.$img_path.'/default_logo.png');
								    }
									if($article_img!='' && $image_exist==1)
									{
									$image=$base.'uploads/news_article_images/'.$article_img;
									}
									else if($articles_detail['univ_logo_path']!='' && $image_exist==2)
									{
									$image=$base.'uploads/univ_gallery/'.$articles_detail['univ_logo_path'];
									}
									else
									{
									$image=$base.$img_path.'/default_logo.png';
									} 
									$img_arr=$this->searchmodel->set_the_image($width,$height,80,80,TRUE);
									?>
								<img style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" src="<?php echo $image; ?>">
							</div>
							<div class="dsolution" style="padding-left:20px;">
								<div>
									<div class="float_l span7 margin_zero">
												<?php
												$univ_domain=str_replace(' ','-',$articles_detail['subdomain_name']);
$article_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'articles',$articles_detail['article_title'],$articles_detail['article_id']);							
	
												?>									
		<a href="<?php echo $article_link; ?>" class="txt_three"><?php echo $articles_detail['article_title']; ?></a>
									<br/>	<span>
									<abbr class="timeago time_ago" title="<?php echo $articles_detail['publish_time']; ?>"></abbr>
						
										</span><br/>
									</div>
									
									<div class="float_r" >
										<!--<div class="float_l" style="margin-right:15px;"><g:plusone size="medium" annotation="none"></g:plusone></div>-->
										<div id="fbc" class="float_l" style="width:57px;"><div class="fb-like" data-href="<?php echo $base;?>univ-<?php echo $articles_detail['univ_id']; ?>-article-<?php echo $articles_detail['article_id']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div></div>
										<div class="float_l">
										<g:plusone size='medium' id='shareLink' annotation='none' href='<?php echo $base;?>univ-<?php echo $articles_detail['univ_id']; ?>-article-<?php echo $articles_detail['article_id']; ?>' callback='countGoogleShares' data-count="true"></g:plusone>
							
										</div>
										<div id="tw" class="float_r tw" style="width:82px;"><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $base;?>univ-<?php echo $articles_detail['univ_id']; ?>-article-<?php echo $articles_detail['article_id']; ?>" data-via="munjal_sumit" data-lang="en">Tweet</a></div>
									<div class="clearfix"></div>
									</div>	
									<div class="clearfix"></div>
								</div>
								<div class="course_cont"><?php echo substr($articles_detail['article_detail'],0,250).'..'; ?></div>
							</div>
							<div class="clearfix"></div>
						</div>
						</div>
					<?php }*/ ?>
						
					</div>
					
				</div>
				<div class="float_l span4">
					<div class="back_up">
						<h3><img src="<?php echo base_url(); ?>images/home_cal.gif" style="z-index: 100;position: relative;top:6px;"><span style="position: relative;left: 10px;">Popular Articles</span></h3>
								<ul class="up_event">
								<?php if(!empty($popular_articles)){
								foreach($popular_articles as $popular_articles_detail)
								{
								$article_title =$this->subdomain->process_url_title($popular_articles_detail['article_title']);	
								$article_link=$this->subdomain->genereate_the_subdomain_link(
								$popular_articles_detail['subdomain_name'],'articles',$article_title,$popular_articles_detail['article_id']);
								?>
									<li><a href="<?php echo $article_link; ?>"><?php echo $popular_articles_detail['article_title']; ?></a></li>
								<?php } } ?>	
								
								</ul>
					</div>
				</div>
			</div>
				<div class="float_r span3">
					<a href="http://university-of-greenwich.meetuniversities.com/university_events"><img src="<?php echo "$base$img_path" ?>/banner_img.png"></a>
				</div>
				
			<div id="pagination" class="table_pagination right paging-margin">
            <?php echo $this->pagination->create_links(); ?>
            </div>
			
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
