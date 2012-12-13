<div class="modal hide" id="delete">
	<div class="modal-header">		
		<div align="center"><h3>Image deleted successfully</h3></div>
	</div>
</div>
<div class="modal hide" id="denied">
	<div class="modal-header">		
		<div align="center" style="color:red;"><h3>Unable to perform action please contact admin</h3></div>
	</div>
</div>
<div class="modal hide" id="sel_atl_one">
	<div class="modal-header">		
		<div align="center"><h3>Please select atleast one</h3></div>
	</div>
</div>
<div class="modal hide" id="sel_act">
	<div class="modal-header">		
		<div align="center"><h3>Please select the action</h3></div>
	</div>
</div>
<div class="content">
    <div class="container-fluid">      
		<div class="row-fluid">
			<div class="span12">
				<div class="page-header clearfix tabs">
					<h2>University Gallery</h2>
					<ul class="nav nav-pills">
					<li class='active'>
						<a href="#all" data-toggle="pill">All</a>
					</li>
					<li id="active_menu">
						<a href="#create" data-toggle="pill">Add Gallery</a>
					</li>
					</ul>
				</div>
				<?php
				if($admin_user_level!='5')
				{
				?>
					<div class="content-box">
						<div class="tab-content">
							<div class="tab-pane active" id="all">
								<table class="table table-striped table-media dataTable" id="media">
									<thead>
											<tr>
												<th><input type="checkbox" class='sel_rows' data-targettable="media"></th>
												<th>Image</th>							
												<th>Description</th>					<!-- Added by satbir on 11/08/2012 -->						
												<th>File info</th>
												<th>Options</th>
											</tr>
									</thead>
									<tbody>
									<?php
										foreach($gallery as $gal_images)
										{ 
											if(file_exists(getcwd().'/uploads/univ_gallery/'.$gal_images['g_image_path']) && $gal_images['g_image_path']!='')
											{
												$news_img_path=$base.'uploads/univ_gallery/'.$gal_images['g_image_path'];
												$type=getimagesize(getcwd().'/uploads/univ_gallery/'.$gal_images['g_image_path']);
												$size=filesize(getcwd().'/uploads/univ_gallery/'.$gal_images['g_image_path']);							
									?>
											<tr class="check_university_<?php echo $gal_images['gid']; ?>">
												<td>
													<input type="checkbox" value="<?php echo $gal_images['gid'];?>" class='selectable_checkbox setchkval'>
												</td>								
												<td>
													<a href="img/500.gif" class='fancy'><img style="width:50px;height:50px;" src="<?php echo $news_img_path; ?>" alt=""></a>
												</td>
												<td>													<!-- Added by satbir on 11/08/2012 -->
													<?php echo substr($gal_images['description'],0,60); ?>
												</td>								
										
												<td class='info'>
													<span><strong>Size:</strong> <?php echo number_format($size/1024,2).'  KB'; ?></span>
													<span><strong>Type:</strong> <?php  echo $type['mime'];?></span>
												</td>
												<td>									
													<div class="modal hide" id="myModal1_<?php echo $gal_images['gid']; ?>">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">x</button>
														<h3>Do you want to delete?</h3>
													</div>
													<div class="modal-footer">
														<a href="" onclick="delete_confirm('<?php echo $gal_images['gid']; ?>');" class="btn" data-dismiss="modal">Yes</a>
														<a href="#" class="btn" data-dismiss="modal">Close</a>
													</div>
												</div>
									
												<div class="modal hide" id="img_<?php echo $gal_images['gid']; ?>">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">x</button>
														<img width="526px" height="400px" src="<?php echo $news_img_path; ?>" />
													</div>
													
												</div>
												<a href="#img_<?php echo $gal_images['gid']; ?>" class="btn btn-icon"  data-toggle="modal" data-original-title="Delete">
													<i class="icon-search"></i>
												</a>
										
																		
												<a href="#myModal1_<?php echo $gal_images['gid']; ?>" class="btn btn-icon tip" data-toggle="modal" data-original-title="Delete"><i class="icon-trash"></i></a>
												</td>
											</tr>			
									<?php 
										} 
									} 
									?>
									</tbody>
								</table>
								<div class="tableactions" style="margin-top:70px;">
									<select name="univ_action" id="del_action">
										<option value="">Actions</option>
										<option value="delete">Delete</option>
									</select>
									<input type="button" onclick="action_formsubmit(0,0)" class="submit tiny" value="Apply to selected" />
								</div>	
							</div>
							<div class="tab-pane" id="create">
								<h3>Upload University Gallery</h3>
								<div class="row-fluid">
									<div class="span8">
										<div class="content-box">
											<div class="plupload">
											<?php if($admin_user_level=='3')
												{ ?>
												<form name="myform" onsubmit="return addgallery(this);" action="<?php echo $base; ?>admin/manage_univ_gallery" method="post" enctype="multipart/form-data">
												
												<h4 id="size" style="display:none;">File size must be less than 500kb</h4>	
														<?php if (isset($a)) echo $a;?>
												<input type="file" id="file" name="userfile1[]"  class="multi" multiple />
												<br /><br />
												<input type="submit" class="submit" name="upload">
												</form>
												<?php } ?>
											</div>
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
				}
				else
				{				
				?>
				<div class="content-box">
					<div class="tab-content">
						<div class="tab-pane active" id="all">						
							<table class="table table-striped table-media dataTable" id="media">
								<thead>
									<tr>
										<th><input type="checkbox" class='sel_rows' data-targettable="media"></th>
										<th>Image</th>							
										<th>University</th>					
										<th>File info</th>
										<th>Options</th>
									</tr>
								</thead>
								<tbody>
								<?php
									foreach($gallery as $gal_images)
									{ 
										if(file_exists(getcwd().'/uploads/univ_gallery/'.$gal_images['g_image_path']) && $gal_images['g_image_path']!='')
										{
											$news_img_path=$base.'uploads/univ_gallery/'.$gal_images['g_image_path'];
											$type=getimagesize(getcwd().'/uploads/univ_gallery/'.$gal_images['g_image_path']);
											$size=filesize(getcwd().'/uploads/univ_gallery/'.$gal_images['g_image_path']);							
								?>
										<tr class="check_university_<?php echo $gal_images['gid']; ?>">
											<td>
												<input type="checkbox" value="<?php echo $gal_images['gid'];?>" class='selectable_checkbox setchkval'>
											</td>								
											<td>
												<a href="img/500.gif" class='fancy'><img style="width:50px;height:50px;" src="<?php echo $news_img_path; ?>" alt=""></a>
											</td>
											<td>													
												<?php echo $gal_images['univ_name']; ?>
											</td>								
									
											<td class='info'>
												<span><strong>Size:</strong> <?php echo number_format($size/1024,2).'  KB'; ?></span>
												<span><strong>Type:</strong> <?php  echo $type['mime'];?></span>
											</td>
											<td>									
												<div class="modal hide" id="myModal1_<?php echo $gal_images['gid']; ?>">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">x</button>
														<h3>Do you want to delete?</h3>
													</div>
													<div class="modal-footer">
														<a href="" onclick="delete_confirm('<?php echo $gal_images['gid']; ?>');" class="btn" data-dismiss="modal">Yes</a>
														<a href="#" class="btn" data-dismiss="modal">Close</a>
													</div>
												</div>								
												<div class="modal hide" id="img_<?php echo $gal_images['gid']; ?>">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">x</button>
														<img width="526px" height="400px" src="<?php echo $news_img_path; ?>" />
													</div>											
												</div>
											<a href="#img_<?php echo $gal_images['gid']; ?>" class="btn btn-icon"  data-toggle="modal" data-original-title="Delete">
												<i class="icon-search"></i>
											</a>																
											<a href="#myModal1_<?php echo $gal_images['gid']; ?>" class="btn btn-icon tip" data-toggle="modal" data-original-title="Delete"><i class="icon-trash"></i></a>
											</td>
										</tr>			
								<?php 
									} 
								} 
								?>
								</tbody>
							</table>
							<div class="tableactions" style="margin-top:70px;">
								<select name="univ_action" id="del_action">
									<option value="">Actions</option>
									<option value="delete">Delete</option>
								</select>
								<input type="button" onclick="action_formsubmit(0,0)" class="submit tiny" value="Apply to selected" />
							</div>	
						</div>
						<div class="tab-pane" id="create">							
							<div class="row-fluid">
								<div class="span8">
									<div class="content-box">
										<form name="myform"  action="<?php echo $base; ?>admin/manage_univ_gallery" method="post" enctype="multipart/form-data">											
											<div class="float_l span3 margin_zero">
												<h4>Choose University</h4>
											</div>
											<select name="university" id="university">
													<option value="">Please Select</option>
													<?php 
													foreach($univ_info as $univ_detail) 
													{ 
													?>
														<option value="<?php echo $univ_detail->univ_id; ?>" ><?php echo $univ_detail->univ_name; ?></option>
													<?php 
													} 
													?>
											</select>
											<div class="plupload"></div>
											<input type="submit" class="submit" name="upload">	
										</form>
									</div>
									<p class="help-inline">File size must be less than 500kb</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				}
				?>
			</div>
		</div>        
	</div>
</div>
<script>
function delete_confirm(id)
{
	var data={id:id};
	$.ajax({	
	 type: "POST",
	   url: "<?php echo $base; ?>admin/delete_image",
	   async:false,
	   data: data,
	   cache: false,
		success: function(msg)
		{
			if(msg=='1')
			{
				$('.check_university_'+id).hide();
				$('#delete').show();
				setTimeout(function(){$('#delete').fadeOut('slow');},3000);		
			}
			else
			{			
				$('#denied').show();
				setTimeout(function(){$('#denied').fadeOut('slow');},3000);	
			}
		}
	
	});
}
var arr=new Array;
function action_formsubmit(id,flag)
{
	var action;	
	if($('#del_action option:selected').val()!='')
	{
		action=$('#del_action option:selected').val();
	}
	if(action=='delete')
	{
		var atLeastOneIsChecked = $('.setchkval:checked').length > 0;
		if(atLeastOneIsChecked)
		{
			var r=confirm("Are you sure you want to delete selected images");
			set_chkbox_val();			
			var data={'id':arr};
			if(r)
			{
				$.ajax({
					type:"post",
					url:'<?php echo $base ?>admin/delete_mul_images',
					async:false,
					data: data,
					cache: false,
					success: function(msg)
					{						
						$('.toremove').hide();
						$("#delete").show();
						$("#delete").delay(5000).hide("slow");
					}

				});
			}
		}
		else
		{
			$('#sel_atl_one').show();				
			setTimeout(function(){$('#sel_atl_one').fadeOut('slow');},2000);
			return false;
		}
	}
	else
	{
		$('#sel_act').show();				
		setTimeout(function(){$('#sel_act').fadeOut('slow');},2000);
		return false;
	}
}
function set_chkbox_val()
{
	$('.setchkval').each(function()
	{
		if($(this).attr('checked'))
		{
			$('.check_university_'+$(this).val()).addClass('toremove');
			arr.push($(this).val());
		}		
	});
}
function addgallery()
{
	var valid=true;
	if(document.getElementById("file").files.length < 1)
	{
		$("#file").addClass('needsfilled');
		valid=false;
	}
	else
	{
		$("#file").removeClass('needsfilled');
		valid=true;
	}			
	return valid;	
}
</script>
