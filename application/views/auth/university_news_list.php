<div class="row margin_t1">
				<div class="float_l span13 margin_l">
				<!--<div class="float_r">
				<div class="float_l" style="margin-right:15px;"><g:plusone size="medium" annotation="none"></g:plusone></div>
				<div class="float_l" style="margin-right:10px;"><div class="fb-like" data-href="<?php $_SERVER['REQUEST_URI']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div></div>
	
				<div class="float_l">
					<a href="https://twitter.com/share" class="twitter-share-button" data-via="munjal_sumit" data-count="none">Tweet</a>
				</div>
				</div>-->
					<h2 class="course_txt">Recent News</h2>
					<div class="margin_t1">
					<?php foreach($news_list_detail as $news_detail){ ?>
						<div class="event_border">
							<div class="float_l">
							<?php if($news_detail['news_image_path']!=""){?>
<img src="<?php echo $base; ?>uploads/news_article_images/<?php echo $news_detail['news_image_path']; ?>" style="width:80px;height:80px;margin-right:20px">
								<?php } else if($news_detail['univ_logo_path']==''){?>
								<img src="<?php echo "$base$img_path"; ?>/default_logo.png" style="width:80px;height:80px;margin-right:20px">
								<?php } else {?>
								<img src="<?php echo $base; ?>/uploads/univ_gallery/<?php echo $news_detail['univ_logo_path']; ?>" style="width:80px;height:80px;margin-right:20px" >
								<?php } ?>	
							</div>
							<div class="dsolution">
								<div>
									<div class="float_l">
<h3><a href="<?php echo $base;?>univ-<?php echo $news_detail['univ_id']; ?>-news-<?php echo $news_detail['news_id']; ?>"><?php echo $news_detail['news_title']; ?>
						
										<span><?php echo $news_detail['publish_time']; ?></span></a><br/>
									</div>
						<div class="float_r">
						<div class="fb-like " data-href="<?php echo $base;?>univ-<?php echo $news_detail['univ_id']; ?>-news-<?php echo $news_detail['news_id']; ?>" data-send="false" data-layout="button_count" data-width="10" data-show-faces="true" >
						
						</div>
						<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $base;?>univ-<?php echo $news_detail['univ_id']; ?>-news-<?php echo $news_detail['news_id']; ?>" data-via="munjal_sumit" data-lang="en">Tweet</a>
						</div>
									<div class="clearfix"></div>
								</div>
								<div class="course_cont"><?php echo substr($news_detail['news_detail'],0,250).'..'; ?></div>
							</div>
							<div class="clearfix"></div>
						</div>
					<?php } ?>	
					</div>
				</div>
			
				<div class="float_r span3">
					<img src="<?php echo "$base$img_path"; ?>/banner_img.png">
				</div>
				<div id="pagination" class="table_pagination right paging-margin">
            <?php echo $this->pagination->create_links();?>
            </div>
				<div class="clearfix"></div>
			</div>
	