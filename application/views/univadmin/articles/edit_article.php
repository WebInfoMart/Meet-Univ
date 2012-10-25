<?php 
foreach($article_info as $article_detail) { ?>
<div class="content">
    <div class="container-fluid">      
      <div class="row-fluid">
        <div class="span12">
          <div class="page-header clearfix tabs">
            <h2>article</h2>
          </div>
          <div class="content-box">
            <div class="row-fluid">
				<div class="span12">
					 <form class="form-horizontal" onsubmit="return addarticle(this);" id="myform" action="<?php echo $base; ?>newadmin/adminarticles/edit_article/<?php echo $article_detail['article_id']; ?>" method="post" enctype="multipart/form-data">
						<fieldset>
							<div class="row-fluid">
								<div class="span2">
									<div class="gallery">
										<ul class='clearfix'>
											
										<?php 
										if(file_exists(getcwd().'/uploads/news_article_images/'.$article_detail['article_image_path']) && $article_detail['article_image_path']!='') {
										$article_img_path=$base.'uploads/news_article_images/'.$article_detail['article_image_path'];
										}
										else
										{
										$article_img_path=$base.'images/default_logo.png';
										}
										?>
										<li>
										
												<a href="<?php echo $article_img_path; ?>" class='fancy'>
													<img src="<?php echo $article_img_path ?>" alt="">
												</a>
											</li>  
										</ul>
									</div>
									<input type="file" id="userfile" name="userfile" style="display:none" class="inputElement">
									<span id="wrongfile">Only jpg,jpeg,gif,png </span>
								
								</div>
								<div class="span9">
									<div class="control-group margin_b">
										<label for="username" class="control-label"><b>Title</b></label>
										<div class="controls">
										<div class="help-inline data1"><?php echo $article_detail['article_title']; ?></div>
										<input type="text" name="title" id="title" style="display:none;"  class="input-xlarge inputElement" value="<?php echo $article_detail['article_title']; ?>">
									</div>
									</div>
									<?php if($admin_user_level=='5' || $admin_user_level=='4') {?>
									<div class="control-group margin_b">
										<label for="username" class="control-label"><b>University name</b></label>
										<div class="controls">
								<div class="help-inline data1"><?php echo $article_detail['univ_name']; ?></div>
								<select style="display:none" class="input-xlarge inputElement"  id="univ" name="univ">
								<option value="">Please Select</option>
								<?php foreach($univ_info as $univ_detail) { ?>
								<option value="<?php echo $univ_detail->univ_id; ?>" <?php if($univ_detail->univ_id==$article_detail['article_univ_id']) { ?> selected <?php } ?> ><?php echo $univ_detail->univ_name; ?></option>
								<?php } ?>
								</select>
								</div>
									</div>
									<?php }else { ?>
	 			<input type="hidden" name="univ" value="<?php echo $article_detail['article_univ_id']; ?>">
					<?php }?>
					<input type="hidden" name="article_type" value="univ_article"/>
									<div class="control-group margin_b">
										<label  class="control-label"><b>Detail</b></label>
										<div class="controls">
										<div class="help-inline data1"> <?php echo $article_detail['article_detail'];?></div>
										<textarea  style="display:none;" name="detail" id="detail" class="span12 inputElement" rows="4"><?php echo $article_detail['article_detail'];?></textarea>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
							<div class="form-actions">
										<a id="edit" class='btn btn-success pover' data-placement="top" data-content="Want to change" title="Edit">Edit</a>
										
										<input type="submit" name="submit"  class='btn btn-success pover' data-placement="top" data-content="Upload image and update data" value="Update"/>
								</div>
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
function addarticle()
{   
    var valid=true;
	if($('#univ option:selected').val()=='')
	{
		$("#univ").addClass('needsfilled');
		valid=false;
	}
	if($("#title").val()=='')
	{
		$("#title").addClass('needsfilled');
		valid=false;		
	}
	if($("#detail").val()=='')
	{
		$("#detail").addClass('needsfilled');		
		valid=false;
	}	
	return valid;	
	
}

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
