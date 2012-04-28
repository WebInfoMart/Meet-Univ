<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row margin_t1">
				<div class="float_l span13 margin_l">
					
				<div class="float_r" >
				<div class="float_l" style="margin-right:15px;"><g:plusone size="medium" annotation="none"></g:plusone></div>
				<div class="float_l" style="margin-right:10px;"><div class="fb-like" data-href="<?php $_SERVER['REQUEST_URI']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div></div>
				<div class="float_l">
					<a href="https://twitter.com/share" class="twitter-share-button" data-via="munjal_sumit" data-count="none">Tweet</a>
				</div>
				<div class="clearfix"></div>
				</div>	
					<h2 class="course_txt">Recent Articles</h2>
					<div class="margin_t1">
					<?php foreach($articles as $articles_detail){ ?>
						<div class="event_border">
							<div class="float_l">
							<?php if($articles_detail['article_image_path']!=""){?>
<img src="<?php echo $base; ?>uploads/news_article_images/<?php echo $articles_detail['article_image_path']; ?>">
								
								<?php } else if($articles_detail['univ_logo_path']==''){?>
								<img src="<?php echo "$base$img_path"; ?>/default_logo.png">
								<?php } else {?>
								<img src="<?php echo $base; ?>/uploads/univ_gallery/<?php echo $articles_detail['univ_logo_path']; ?>">
								<?php } ?>	
							</div>
							<div class="dsolution">
								<div>
									<div class="float_l">
<a href="<?php echo $base;?>univ-<?php echo $articles_detail['univ_id']; ?>-article-<?php echo $articles_detail['article_id']; ?>" class="txt_three"><?php echo $articles_detail['article_title']; ?></a>
									<br/>	<span>
										<?php 
										$exp = explode(" ",$articles_detail['publish_time']);
				$create_month_format = explode('-',$exp[0]);
				$string_month = date("M", mktime(0, 0, 0, $create_month_format[1]));
				
				// Check if this time is above 24 hours...
								$starttime = $articles_detail['publish_time']; 
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
								$firstTime=strtotime($articles_detail['publish_time']);
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
										
										
										?>
										</span><br/>
									</div>
									<div class="float_r"><div class="fb-like" data-href="<?php echo $base;?>univ-<?php echo $articles_detail['univ_id']; ?>-article-<?php echo $articles_detail['article_id']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div></div>
									<div class="clearfix"></div>
								</div>
								<div class="course_cont"><?php echo substr($articles_detail['article_detail'],0,250).'..'; ?></div>
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
	