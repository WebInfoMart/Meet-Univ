<?php 
foreach($news_info as $news_detail) { ?>
<div id="content">
		<h2 class="margin">View News Details</h2>
		<div class="form span8">
			<form action="<?php echo $base; ?>adminnews/view_news" method="post" class="caption_form">
				<ul>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Title</label>
							</div>
							<div class="float_l span3">
								<input type="text" disabled="disabled" size="30" class="text" value="<?php echo $news_detail['news_title']; ?>" >
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
								<input type="text" disabled="disabled" size="30" class="text" value="<?php echo $news_detail['univ_name']; ?>" >
							</div>
							
							<div class="clearfix"></div>
						</div>
					</li>
					<?php } ?>
		    
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>news Logo</label>
							</div>
							<div class="float_l span3">
							<?php 
							if(file_exists(getcwd().'/uploads/news_news_images/'.$news_detail['news_image_path']) && $news_detail['news_image_path']!='') {
							$news_img_path=$base.'uploads/news_news_images/'.$news_detail['news_image_path'];
							}
							else
							{
							$news_img_path=$base.'images/default_logo.png';
							}
							?>
							<img src="<?php echo $news_img_path ?>" class="logo_img">
				
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
								<textarea rows="12" disabled="disabled" name="detail"  cols="103"><?php echo $news_detail['news_detail'];?></textarea>
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
				</ul>
						
			</form>
		</div>
	</div>
<?php } ?>	