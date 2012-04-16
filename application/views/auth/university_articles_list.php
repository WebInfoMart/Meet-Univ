<div class="row" style="margin-top:-25px">
				<div class="float_l span13 margin_l">
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
								<h3><a href="<?php echo $base;?>univ-<?php echo $articles_detail['univ_id']; ?>-articles-<?php echo $articles_detail['article_id']; ?>"><?php echo $articles_detail['article_title']; ?></a></h3>
								<span><?php echo $articles_detail['publish_time']; ?></span><br/>
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
