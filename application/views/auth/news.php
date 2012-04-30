<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row margin_t1">
				<div class="float_l span13 margin_l">
				<!--<div class="float_r">
				<div class="float_l" style="margin-right:15px;"><g:plusone size="medium" annotation="none"></g:plusone></div>
				<div class="float_l" style="margin-right:10px;"><div class="fb-like" data-href="<?php $_SERVER['REQUEST_URI']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div>
									
				</div>
				<div class="float_l">
					<a href="https://twitter.com/share" class="twitter-share-button" data-via="munjal_sumit" data-count="none">Tweet</a>
				</div>
				</div>-->
					<h2 class="course_txt">Recent News</h2>
					
					<div class="margin_t1">
					<?php foreach($news as $news_detail){ ?>
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
<h3><a href="<?php echo $base;?>univ-<?php echo $news_detail['univ_id']; ?>-news-<?php echo $news_detail['news_id']; ?>"><?php echo $news_detail['news_title']; ?></a></h3>
										<span>
										<?php 
										$exp = explode(" ",$news_detail['publish_time']);
				$create_month_format = explode('-',$exp[0]);
				$string_month = date("M", mktime(0, 0, 0, $create_month_format[1]));
				
				// Check if this time is above 24 hours...
								$starttime = $news_detail['publish_time']; 
								$starttime = strtotime($starttime); 
								$oneday = 60*60*24; 
								if( $starttime < (time()-$oneday) ) { 
								  // echo 'more than one day since start'; 
								echo $exp[1].'&nbsp;&nbsp;'.$create_month_format[0].'-'.$string_month.'-'.$create_month_format[2]; //$articles_detail['publish_time']; 
								}
								else {
								//Less than oneday from start
								//Time difference
								$date = date('Y-m-d H:i:s');
								$firstTime=strtotime($news_detail['publish_time']);
								$lastTime=strtotime($date);

								// perform subtraction to get the difference (in seconds) between times
								$timeDiff=$lastTime-$firstTime;
								
								// Convert Seconds to h:i:s format
								$init = $timeDiff;
								$hours = floor($init / 3600);
								$minutes = floor(($init / 60) % 60);
								$seconds = $init % 60;
								echo "$hours:$minutes:$seconds".'&nbsp;&nbsp;before';
								}
										
										?></span><br/>
									</div>
									<div class="float_r">
				<!--<div class="float_l" style="margin-right:15px;"><g:plusone size="medium" annotation="none"></g:plusone></div>-->
				<div class="float_l" style="margin-right:10px;"><div class="fb-like" data-href="<?php echo $base;?>univ-<?php echo $news_detail['univ_id']; ?>-news-<?php echo $news_detail['news_id']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div>
									
				</div>
				<div class="float_l">
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $base;?>univ-<?php echo $news_detail['univ_id']; ?>-news-<?php echo $news_detail['news_id']; ?>" data-via="munjal_sumit" data-lang="en">Tweet</a>
				</div>
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
		</div>
	</div>
	