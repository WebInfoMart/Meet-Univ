<?php 
foreach($article_info as $article_detail) { ?>
<div id="content">
		<h2 class="margin">View Articles Details</h2>
		<div class="form span8">
			<form action="<?php echo $base; ?>adminarticles/view_article" method="post" class="caption_form">
				<ul>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Title</label>
							</div>
							<div class="float_l span3">
								<input type="text" disabled="disabled" size="30" class="text" value="<?php echo $article_detail['article_title']; ?>" >
							</div>
							
							<div class="clearfix"></div>
						</div>
					</li>
					<?php if($admin_user_level=='5' || $admin_user_level=='4') {?>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>University Name</label>
							</div>
							<div class="float_l span3">
								<input type="text" disabled="disabled" size="30" class="text" value="<?php echo $article_detail['univ_name']; ?>" >
							</div>
							
							<div class="clearfix"></div>
						</div>
					</li>
					<?php } ?>
		    
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Article Logo</label>
							</div>
							<div class="float_l span3">
							<?php 
							if(file_exists(getcwd().'/uploads/news_article_images/'.$article_detail['article_image_path']) && $article_detail['article_image_path']!='') {
							$article_img_path=$base.'uploads/news_article_images/'.$article_detail['article_image_path'];
							}
							else
							{
							$article_img_path=$base.'images/default_logo.png';
							}
							?>
							<img src="<?php echo $article_img_path ?>" class="logo_img">
				
							</div>
							
							<div class="clearfix"></div>
						</div>
					</li>
					
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Detail</label>
							</div>
							<div class="">
								<textarea rows="12" disabled="disabled" name="detail"  cols="103"><?php echo $article_detail['article_detail'];?></textarea>
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
				</ul>
						
			</form>
		</div>
	</div>
<?php } ?>	