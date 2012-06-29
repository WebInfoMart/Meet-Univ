<div class="row" style="margin-top: -10px;">
	<div class="span16 margin_l">
				<div class="float_l span13 margin_zero">
					<div class="span9 margin_zero">
				<h2>Recent Articles</h2>
					<div>
				
					<ul class="event_new">
				<?php foreach($articles_list_detail as $articles_detail){ 
				$articles_link=$this->subdomain->genereate_the_subdomain_link($articles_detail['subdomain_name'],'articles',$articles_detail['article_title'],$articles_detail['article_id']);
					
				?>
						<li>
							<div class="float_l span5 margin_zero">
								<div class="margin_zero grid_3 fix_h3">
									<h3><a href="<?php echo $articles_link; ?>"><?php echo $articles_detail['article_title']; ?></a></h3>
								</div>
							</div>
								<div class="float_r span4 margin_zero">
									<div class="float_l fb_set"><div class="fb-like" style="width:66px;" data-href="<?php echo $base;?>univ-<?php echo $articles_detail['univ_id']; ?>-article-<?php echo $articles_detail['article_id']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div>
									</div>
									<div class="float_l" style="margin-left:1px;">
										<g:plusone size='medium' id='shareLink' annotation='none' href='<?php echo $base;?>univ-<?php echo $articles_detail['univ_id']; ?>-article-<?php echo $articles_detail['article_id']; ?>' callback='countGoogleShares' data-count="true"></g:plusone>
									</div>
									<div class="float_r tw" style="width:82px;"><div id="tw" ><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $base;?>univ-<?php echo $articles_detail['univ_id']; ?>-article-<?php echo $articles_detail['article_id']; ?>" data-via="munjal_sumit" data-lang="en">Tweet</a></div>
									</div>
								</div>
								<div class="clearfix"></div>
									<div class="margin_t1 img_height">
										<div class="float_l img_style img_r aspectcorrect" >
											<?php
									$image_exist=0;	
									$article_img = $articles_detail['article_image_path'];	
									$univ_image =$articles_detail['univ_logo_path'];
									if(file_exists(getcwd().'/uploads/news_article_images/'.$article_img) && $article_img!='')	
									{
									$image_exist=1;
								 list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/news_article_images/'.$article_img);
									}
									else if(file_exists(getcwd().'/uploads/univ_gallery/'.$univ_image) && $univ_image!='')
									{
									list($width, $height, $type, $attr) = getimagesize(getcwd().'/univ_gallery'.$img_path.'/default_logo.png');
								    }
									else
									{
									}
									if($article_img!='' && $image_exist==1)
									{
									$image=$base.'uploads/news_article_images/'.$article_img;
									}
									else
									{
									$image=$base.$img_path.'/default_logo.png';
									} 
									$img_arr=$this->searchmodel->set_the_image($width,$height,112,77,TRUE);
							?>

											<img style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" src="<?php echo $image; ?>" >
										</div>
										<div><img src="<?php echo "$base$img_path"; ?>/clock.png" class="line_img inline"><span class="blue line_time inline"><abbr class="timeago time_ago" title="<?php echo $articles_detail['publish_time']; ?>"></abbr>
										</span></div>
									<span class="wrap"><?php echo substr($articles_detail['article_detail'],0,250).'..'; ?></span>	
								
							</div>
						</li>
					<?php } ?>
					</ul>
				</div>
				</div>
				<div class="float_l span4">			
					<div class="back_up">
						<h3><img src="<?php echo base_url(); ?>images/home_cal.gif" class="pop_img"><span class="pop_data">Popular Articles</span></h3>
						<ul class="up_event">
							<?php if(!empty($popular_articles)){
								foreach($popular_articles as $popular_article_detail)
								{
								$article_link=$this->subdomain->genereate_the_subdomain_link(
								$popular_article_detail['subdomain_name'],'articles',$popular_article_detail['article_title'],$popular_article_detail['article_id']);
								?>
									<li><a href="<?php echo $article_link; ?>"><?php echo $popular_article_detail['article_title'];?></a></li>
								<?php } } ?>
						</ul>
					</div>
				</div>
			</div>
				<div class="float_r span3">
					<img src="<?php echo "$base$img_path"; ?>/banner_img.png">
				</div>
			</div>
				<div class="clearfix"></div>
			</div>
	</div>
</div>
	
					
					
					
					
					
					
					
					
					