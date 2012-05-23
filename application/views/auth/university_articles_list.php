<div class="row margin_t1">
<div class="row margin_t1">
				<div class="float_l span13 margin_l">
				<!--<div class="float_r">
				<div class="float_l" style="margin-right:15px;">
				<g:plusone size='medium' id='shareLink' annotation='none' href='<?php $_SERVER['REQUEST_URI']; ?>' callback='countGoogleShares' data-count="true"></g:plusone>
				</div>
				<div class="float_l" style="margin-right:10px;"><div class="fb-like" data-href="<?php $_SERVER['REQUEST_URI']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div></div>
	
				<div class="float_l">
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php $_SERVER['REQUEST_URI']; ?>" data-via="munjal_sumit" data-count="none">Tweet</a>
				</div>
				</div>-->
				<h2 class="course_txt">Recent Articles</h2>
					<div class="margin_t1">
				<?php foreach($articles_list_detail as $articles_detail){ ?>
						<div class="event_border">
								<div class="float_l">
									<?php
									$image_exist=0;	
									$article_img = $articles_detail['article_image_path'];	
									if(file_exists(getcwd().'/uploads/univ_gallery/'.$article_img) && $article_img!='')	
									{
									$image_exist=1;
									list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/news_article_images/'.$article_img);
									}
									else
									{
									list($width, $height, $type, $attr) = getimagesize(getcwd().'/'.$img_path.'/default_logo.png');
								    }
									if($article_img!='' && $image_exist==1)
									{
									$image=$base.'uploads/news_article_images/'.$article_img;
									}
									else
									{
									$image=$base.$img_path.'/default_logo.png';
									} 
									$img_arr=$this->searchmodel->set_the_image($width,$height,80,80,TRUE);
							?>

							<img style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" src="<?php echo $image; ?>">
							
								</div>
							<div class="dsolution">
	<div class="float_r">
	<div class="float_l"><div class="fb-like" style="width:66px;" data-href="<?php echo $base;?>univ-<?php echo $articles_detail['univ_id']; ?>-article-<?php echo $articles_detail['article_id']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div>
	</div>
	<div class="float_l" style="margin-left:15px;">
				<g:plusone size='medium' id='shareLink' annotation='none' href='<?php echo $base;?>univ-<?php echo $articles_detail['univ_id']; ?>-article-<?php echo $articles_detail['article_id']; ?>' callback='countGoogleShares' data-count="true"></g:plusone>

				</div>
				<div class="float_r"><div id="tw" class="float_r tw"><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $base;?>univ-<?php echo $articles_detail['univ_id']; ?>-article-<?php echo $articles_detail['article_id']; ?>" data-via="munjal_sumit" data-lang="en">Tweet</a></div>
	</div></div>
								
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
