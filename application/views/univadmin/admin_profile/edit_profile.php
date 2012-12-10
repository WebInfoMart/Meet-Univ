<?php
foreach($admin_profile as $profile_detail)
{
?>
<div class="content">
    <div class="container-fluid">
	<div class="responsible_navi"></div>		
      <div class="row-fluid">
        <div class="span12">
          <div class="content-box">
            <div class="row-fluid">
				<div class="span12">
					 <form class="form-horizontal" onsubmit="return updateProfile(this);" id="myform" action="<?php echo $base; ?>admin/edit_profile/<?php echo $profile_detail['id']; ?>" method="post" enctype="multipart/form-data">
						<fieldset>
							<div class="row-fluid">
								<div class="span2">
									<div class="gallery">
										<ul class='clearfix'>											
											<?php 
											if(file_exists(getcwd().'/uploads/user_pic/'.$profile_detail['user_pic_path']) && $profile_detail['user_pic_path']!='') 
											{
												$profile_img_path=$base.'uploads/user_pic/'.$profile_detail['user_pic_path'];
											}
											else
											{
												$profile_img_path=$base.'images/profile_icon.png';
											}
											?>
											<li>
												<a href="<?php echo $profile_img_path; ?>" class='fancy'>
													<img src="<?php echo $profile_img_path ?>" alt=""  width="100" height="auto">
												</a>
											</li>  
										</ul>
									</div>
									<input type="file" id="userfile" name="userfile" style="display:none" class="inputElement">
									<span id="wrongfile" style="display:none" class="inputElement">Only jpg,jpeg,gif,png </span>
								
								</div>
								<div class="span9">
									<div class="control-group margin_b">
										<label for="username" class="control-label"><b>Fullname</b></label>
										<div class="controls">
										<div class="help-inline data1"><?php echo $profile_detail['fullname']; ?></div>
										<input type="text" name="fullname" id="fullname" style="display:none;"  class="input-xlarge inputElement" value="<?php echo $profile_detail['fullname']; ?>">
									</div>
									</div>
									<div class="control-group margin_b">
										<label  class="control-label"><b>Email</b></label>
										<div class="controls">
										<div class="help-inline data1"> <?php echo $profile_detail['email'];?></div>
										<input type="text" name="detail" id="detail" style="display:none;"  class="input-xlarge inputElement" value="<?php echo $profile_detail['email']; ?>" disabled="disabled">
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="form-actions">
									<a id="edit" class='btn btn-success pover' data-placement="top" data-content="Want to change" title="Edit">Edit</a>
									<a id="cancel" href="javascript:void(0);" style="display:none" class='btn btn-success pover' data-placement="top" data-content="Want to Cancel" title="Cancel">Cancel</a>
									<input id="update" style="display:none" type="submit" name="submit"  class='btn btn-success pover' data-placement="top" data-content="Upload image and update data" value="Update"/>
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
<?
}
?> 
<script>
function updateProfile()
{   
    var valid=true;
	if($("#fullname").val()=='')
	{
		$("#fullname").addClass('needsfilled');
		valid=false;		
	}
	return valid;	
}
</script>
<script>
	$(document).ready(function(){
		$("#edit").click(function() {
			$('#cancel').show();
			$('#update').show();
			$('#edit').hide();
			$('form').find('.control-group').removeClass('margin_b');
			$('form').find('.help-inline').css('display', 'none');
			$('form').find('.inputElement').css('display', 'block');
		});
		$("#cancel").click(function() {
			$('#cancel').hide();
			$('#update').hide();
			$('#edit').show();
			$('form').find('.control-group').addClass('margin_b');
			$('form').find('.help-inline').css('display', 'block');
			$('form').find('.inputElement').css('display', 'none');
		});	
	});
 </script>
 