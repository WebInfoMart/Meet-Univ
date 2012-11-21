<?php 
foreach($news_info as $news_detail) { ?>
<div class="content">
    <div class="container-fluid"> 
<div class="responsible_navi">
        <div class="currentPage">
          <i class="icon-tasks icon-white"></i> Interface Elements - Tabs
          <div class="sorting">
            <img src="img/sort_both.png" alt="">
          </div>
        </div>
          <ul class='respNav'>
          <li>
            <a href="dash.html">
              <i class="icon-home"></i>
              Dashboard
              <span class="label label-important">16</span>
            </a>
          </li>
          <li>
            <a href="#" class='toggle-subnav'>
              <i class="icon-book"></i>
               Data Management Setting
              <span class="label label-toggle"><img src="img/toggle_minus.png" alt=""></span>
            </a>
            <ul class="collapsed-nav closed">
              <li>
			<a href="articles.html">Articles</a>
		  </li>
          <li><a href="news.html">News</a></li>
          <li><a href="events.html">Events</a></li>
		   <li><a href="question.html">Q & A Section</a></li>
            </ul>
          </li>
          <li>
            <a href="#" class='toggle-subnav'>
              <i class="icon-tasks"></i>
             General Setting
              <span class="label label-toggle"><img src="img/toggle_minus.png" alt=""></span>
            </a>
            <ul class="collapsed-nav closed">
               <li><a href="uni_gallery.html">University Gallery</a></li>
          <li><a href="pages.html">Pages</a></li>
          <li><a href="univ_courses.html">University Courses</a></li>
          <li><a href="update_university.html">Update University</a></li>
            </ul>
          </li>
		  <li>
            <a href="#" class='toggle-subnav'>
              <i class="icon-tasks"></i>
             Enagage
              <span class="label label-toggle"><img src="img/toggle_minus.png" alt=""></span>
            </a>
            <ul class="collapsed-nav closed">
              <li><a href="buttons.html">Promotional Panel</a></li>
          <li><a href="modals.html">Email Plans</a></li>
          <li><a href="engage.html">Engagement Panel</a></li>
            </ul>
          </li>
          <li>
            <a href="stats.html">
              <i class="icon-signal"></i>
              Statistics
            </a>
          </li>
        </ul>
    </div>		
      <div class="row-fluid">
        <div class="span12">
          <div class="page-header clearfix tabs">
            <h2>News</h2>
          </div>
          <div class="content-box">
            <div class="row-fluid">
				<div class="span12">
					 <form class="form-horizontal">
						<fieldset>
							<div class="row-fluid">
								<div class="span2">
									<div class="gallery">
										<ul class='clearfix'>
											
										<?php 
										if(file_exists(getcwd().'/uploads/news_article_images/'.$news_detail['news_image_path']) && $news_detail['news_image_path']!='') {
										$news_img_path=$base.'uploads/news_article_images/'.$news_detail['news_image_path'];
										}
										else
										{
										$news_img_path=$base.'images/default_logo.png';
										}
										?>
										<li>
												<a href="<?php echo $news_img_path; ?>" class='fancy'>
													<img src="<?php echo $news_img_path ?>" alt="" width="175" height="auto">
												</a>
											</li>  
										</ul>
									</div>
									<input type="file" style="display:none" class="inputElement">
									<!--<input type="submit" class="btn btn-success inputElement" value="Upload" style="display:none">-->
								</div>
								<div class="span9">
									<div class="control-group margin_b">
										<label for="username" class="control-label"><b>Title</b></label>
										<div class="controls">
										<div class="help-inline data1"><?php echo $news_detail['news_title']; ?></div>
										<!--<input type="text" style="display:none;" class="input-xlarge inputElement" value="">
										--></div>
									</div>
									<?php //if($admin_user_level=='5' || $admin_user_level=='4') {?>
									<div class="control-group margin_b">
										<label for="username" class="control-label"><b>University name</b></label>
										<div class="controls">
										<div class="help-inline data1"><?php echo $news_detail['univ_name']; ?></div>
										<!--<input type="text" style="display:none;" class="input-xlarge inputElement" value="">-->
										</div>
									</div>
									<?php //} ?>
									<div class="control-group margin_b">
										<label  class="control-label"><b>Detail</b></label>
										<div class="controls">
										<div class="help-inline data1"> <?php echo $news_detail['news_detail'];?></div>
										<!--<textarea  style="display:none;" name="text" id="input07" class="span12 inputElement" rows="4"></textarea>-->
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
							<!--	<div class="form-actions">
										<a id="edit" class='btn btn-success pover' data-placement="top" data-content="Want to change" title="Edit">Edit</a>
										<a href="#" class='btn btn-success pover' data-placement="top" data-content="Upload image and update data" title="Update">Update</a>
								</div>-->
							</div>
						</fieldset>
					</form>
				</div>
			</div>
          </div>
        </div>
      </div>
    </div><!-- close .container-fluid -->
  </div><!-- close .content -->
<?php } ?>
   <script>
$(document).ready(function(){
	//alert('fnslfc');
	$('.collapsed-nav').css('display','none');
	var url = window.location.pathname; 
	var activePage = url.substring(url.lastIndexOf('/')+1);
	$('.mainNav li a').each(function(){  
		var currentPage = this.href.substring(this.href.lastIndexOf('/')+1);
		if (activePage == currentPage) {
			$('.mainNav li').removeClass('active');
			$('li').find('span').removeClass('label-white');
			$('li').find('i').removeClass('icon-white');
			$(this).parent().addClass('active'); 
			$(this).parent().find('span').addClass('label-white');
			$(this).parent().find('i').addClass('icon-white');
				$(this).parent().parent().css('display','block');
				if($(this).parent().parent().css('display','block'))
				{
					$(this).parent().parent().prev().parent().addClass('active');
					$(this).parent().parent().prev().find('span img').attr('src', 'img/toggle_minus.png');
					$(this).parent().parent().prev().find('span').addClass('label-white');
					$(this).parent().parent().prev().find('i').addClass('icon-white');
				}
			} 
		});
	});
 </script>
  <script>
	$(document).ready(function(){
		$("#edit").click(function() {
			$('form').find('.control-group').removeClass('margin_b');
			$('form').find('.help-inline').css('display', 'none');
			$('form').find('.inputElement').css('display', 'block');
		});	
	});
 </script>
