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
							<?php
									$image_exist=0;	
									$news_img = $news_detail['news_image_path'];	
									if(file_exists(getcwd().'/uploads/news_article_images/'.$news_img) && $news_img!='')	
									{
									$image_exist=1;
									list($width, $height, $type, $attr) = getimagesize($base.'uploads/news_article_images/'.$news_img);
									}
									else
									{
									list($width, $height, $type, $attr) = getimagesize($base.$img_path.'/news_default_image.jpg');
								    }
									if($news_img!='' && $image_exist==1)
									{
									$image=$base.'uploads/news_article_images/'.$news_img;
									}
									else
									{
									$image=$base.$img_path.'/news_default_image.jpg';
									} 
									$img_arr=$this->searchmodel->set_the_image($width,$height,84,84,TRUE);
							?>
<img src="<?php echo $image; ?>" style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;margin-right:20px">	
							</div>
							<div class="dsolution">
								<div>
									<div class="float_l">
<h3><a href="<?php echo $base;?>univ-<?php echo $news_detail['univ_id']; ?>-news-<?php echo $news_detail['news_id']; ?>"><?php echo $news_detail['news_title']; ?></a></h3>
										<abbr class="timeago time_ago" title="<?php echo $news_detail['publish_time']; ?>"></abbr>
							
										<br/>
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
	