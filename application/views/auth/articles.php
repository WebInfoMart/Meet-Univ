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
					<h2 class="course_txt">Recent Articles</h2>
				<div class="margin_t1">
					<?php foreach($articles as $articles_detail){
					
				?>
						<div class="event_border ">
							<div class="float_l event_border_div aspectcorrect">
									<?php
									$image_exist=0;	
									$article_img = $articles_detail['article_image_path'];	
									if(file_exists(getcwd().'/uploads/univ_gallery/'.$article_img) && $article_img!='')	
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
$univ_name=str_replace(' ','-',$articles_detail['univ_name']);
									$univ_name=strtolower($univ_name);
									$univ_name=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $univ_name);	
									$article_title=str_replace(' ','-',$articles_detail['article_title']);
									$article_title=strtolower($article_title);
									$article_title=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $article_title);	
?>									
<a href="<?php echo $base.'university/'.$articles_detail['univ_id'].'/'.$univ_name.'/article/'.$articles_detail['article_id'].'/'.$article_title;?>
" class="txt_three">
<?php echo $articles_detail['article_title']; ?></a>
									<br/>	<span>
									<abbr class="timeago time_ago" title="<?php echo $articles_detail['publish_time']; ?>"></abbr>
							
										</span><br/>
									</div>
									
									<div class="float_r" >
				<!--<div class="float_l" style="margin-right:15px;"><g:plusone size="medium" annotation="none"></g:plusone></div>-->
				<div id="fbc" class="float_l" style="width: 66px;margin-right:13px;"><div class="fb-like" data-href="<?php echo $base;?>univ-<?php echo $articles_detail['univ_id']; ?>-article-<?php echo $articles_detail['article_id']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div></div>
				<div class="float_l">
				<g:plusone size='medium' id='shareLink' annotation='none' href='<?php echo $base;?>univ-<?php echo $articles_detail['univ_id']; ?>-article-<?php echo $articles_detail['article_id']; ?>' callback='countGoogleShares' data-count="true"></g:plusone>

				</div>
				<div id="tw" class="float_r tw"><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $base;?>univ-<?php echo $articles_detail['univ_id']; ?>-article-<?php echo $articles_detail['article_id']; ?>" data-via="munjal_sumit" data-lang="en">Tweet</a></div>
				<div class="clearfix"></div>
				</div>	
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
