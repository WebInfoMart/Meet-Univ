<div class="row margin_t1">
				<div class="float_l span13 margin_l">
				<div class="float_r">
				<div class="float_l" style="margin-right:15px;"><g:plusone size="medium" annotation="none"></g:plusone></div>
				<div class="float_l" style="margin-right:10px;"><div class="fb-like" data-href="<?php $_SERVER['REQUEST_URI']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div></div>
	
				<div class="float_l">
					<a href="https://twitter.com/share" class="twitter-share-button" data-via="munjal_sumit" data-count="none">Tweet</a>
				</div>
				</div>
				<h2 class="course_txt">Recent Articles</h2>
					<div class="margin_t1">
				<?php foreach($articles_list_detail as $articles_detail){ ?>
						<div class="event_border">
								<div class="float_l">
									<?php if($articles_detail['article_image_path']!=""){?>
									<img src="<?php echo $base; ?>uploads/news_article_images/<?php echo $articles_detail['article_image_path']; ?>" style="width:80px;height:80px;margin-right:20px">
									<?php } else if($articles_detail['univ_logo_path']==''){?>
									<img src="<?php echo "$base$img_path"; ?>/default_logo.png" style="width:80px;height:80px;margin-right:20px">
									<?php } else {?>
									<img src="<?php echo $base; ?>/uploads/univ_gallery/<?php echo $news_detail['univ_logo_path']; ?>" style="width:80px;height:80px;margin-right:20px" >
									<?php } ?>	
								</div>
							<div class="dsolution">
	<div class="float_r"><div class="fb-like" data-href="<?php echo $base;?>univ-<?php echo $articles_detail['univ_id']; ?>-article-<?php echo $articles_detail['article_id']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div></div>
								
								<h3><a href="<?php echo $base;?>univ-<?php echo $articles_detail['univ_id']; ?>-article-<?php echo $articles_detail['article_id']; ?>"><?php echo $articles_detail['article_title']; ?></a></h3>
								<span><abbr class="timeago time_ago" title="<?php echo $articles_detail['publish_time']; ?>"></abbr>
							</span><br/>
								
								<div class="course_cont"><?php echo substr($articles_detail['article_detail'],0,250).'..'; ?></div>
								<div class="clearfix"></div>
							</div>
						</div>
					<?php } ?>
					</div>
				</div>	
				<div class="float_r span3 margin_t">
					<img src="images/banner_img.png">
				</div>
				<div class="clearfix"></div>
			</div>
</div>			
