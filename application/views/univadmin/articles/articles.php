<div class="modal hide" id="alert">
	<div class="modal-header">		
		<div align="center" style="color:red;" ><h3>You have reached maximum limit</h3></div>
	</div>
</div>
<div class="modal hide" id="delete">
	<div class="modal-header">		
		<div align="center"><h3>Article deleted successfully</h3></div>
	</div>
</div>
<div class="modal hide" id="approved">
	<div class="modal-header">		
		<div align="center"><h3>Article approved successfully</h3></div>
	</div>
</div>
<div class="modal hide" id="disapproved">
	<div class="modal-header">		
		<div align="center"><h3>Article disapproved successfully</h3></div>
	</div>
</div>
<div class="modal hide" id="featured">
	<div class="modal-header">		
		<div align="center"><h3>Article featured successfully</h3></div>
	</div>
</div>
<div class="modal hide" id="unfeatured">
	<div class="modal-header">		
		<div align="center"><h3>Article unfeatured successfully</h3></div>
	</div>
</div>
<div class="modal hide" id="denied">
	<div class="modal-header">		
		<div align="center" style="color:red;"><h3>Unable to perform action please contact admin</h3></div>
	</div>
</div>
<?php
$edit=0;
$delete=0;
$view=0;
$insert=0;
$event_edit_op=array('3','6','7','10');
$event_delete_op=array('5','7','8','10');
$event_insert_op=array('4','6','8','10');

foreach ($admin_priv as $admin_priv_res){ 
if($admin_priv_res['privilege_type_id']=='2' && $admin_priv_res['privilege_level']!=0)
{
$view=1;
if(in_array($admin_priv_res['privilege_level'],$event_edit_op))
{
$edit=1;
}
if(in_array($admin_priv_res['privilege_level'],$event_delete_op))
{
$delete=1;
}
if(in_array($admin_priv_res['privilege_level'],$event_insert_op))
{
$insert=1;
}
}
}
?>
  <!-- BEGIN Content -->
<div id="deleted" style="display:none;" class="alert alert-success" style="z-index:99999">
	<a class="close" data-dismiss="alert" href="#">×</a>
	<strong>Article deleted successfully</strong>
</div>
<div id="access" class="alert alert-success" style="display:none">
	<a class="close" data-dismiss="alert" href="#">×</a>
	<strong>Unable to perform action please contact admin</strong>
</div>
<div id="deleted" class="alert alert-success" style="display:none">
	<a class="close" data-dismiss="alert" href="#">×</a>
	<strong>Article Deleted Successfully</strong>
</div>
  <div class="content">
    <div class="container-fluid"> 
	<div class="responsible_navi"></div>	
      <div class="row-fluid">
        <div class="span12">
          <div class="page-header clearfix tabs">
            <h2>Articles</h2>
            <ul class="nav nav-pills">
              <li class='active'>
                <a href="#all" data-toggle="pill">All</a>
              </li>
              <li>
                <a href="#new" data-toggle="pill">New</a>
              </li>
			  <li>
                <a href="#create" data-toggle="pill" class="active_menu">Create Articles</a>
              </li>
            </ul>
          </div>
          <div class="content-box">
            <div class="tab-content">
              <div class="tab-pane active" id="all">
                <table class="table table-striped dataTable" id="media" >
                  <thead>
                    <tr>
                      <th width="5%"><input type="checkbox" class='sel_rows' data-targettable="media"></th>
                      <th width="20%">Article Title</th>
                      <th width="20%">University Name</th>
                      <th width="15%">Status</th>
					  <th width="20%">Featured/UnFeatured</th>
					   <th width="20%">Choose Option</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php foreach($article_info as $article)
					{ ?>
					<tr class="check_university_<?php echo $article->article_id;?>">
                       <td>
					   <input type="checkbox" value="<?php echo $article->article_id;?>" name="check_article_<?php echo $article->article_id; ?>" class='selectable_checkbox setchkval' id="check_article_<?php echo $article->article_id; ?>">
					   </td>
                       <td><?php echo ucwords(substr($article->article_title,0,50)); ?></td>
                       <td><?php echo ucwords($article->univ_name); ?></td>
                       <td id="ahc_td_<?php echo $article->article_id; ?>" class="center"><?php if($article->article_approve_status){ echo "Approved"; } else {  echo "Pending For Approve";} ?></td>
					   <td id="mhf_td_<?php echo $article->article_id; ?>"><?php if($article->featured_home_article){ echo "Featured"; } else {  echo "Unfeatured";} ?></td>
					   <td class="options">
							<div class="btn-group">
								<?php if($view==1) { ?>
								<a href="<?php echo $base; ?>newadmin/adminarticles/view_article/<?php echo $article->article_id; ?>" class="btn btn-icon tip" data-original-title="View">
									<i class="icon-ok"></i>
								</a>
								<?php } if($edit==1){ ?>
								<a href="<?php echo $base; ?>newadmin/adminarticles/edit_article/<?php echo $article->article_id; ?>" class="btn btn-icon tip" data-original-title="Edit">
									<i class="icon-pencil"></i>
								</a>
								<?php } if($delete==1)   {?>
								<div class="modal hide" id="myModal_<?php echo $article->article_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to delete?</h3>
									</div>
									<div class="modal-footer">
										<a href="javascript:void(0)" onclick="delete_confirm('<?php echo $article->article_id; ?>')" class="btn" data-dismiss="modal">Yes</a>
										<a href="javascript:void(0)" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>
								<a href="#myModal_<?php echo $article->article_id; ?>" class="btn btn-icon tip"  data-toggle="modal" data-original-title="Delete">
									<i class="icon-trash"></i>
								</a>
								<?php }	if(($edit==1 || $delete==1 || $insert==1)){  ?>								
								<div class="modal hide" id="myAppDisModal_<?php echo $article->article_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>										
											<h3>Do you want to change status ?</h3>	
									</div>
									<div class="modal-footer">										
										<a id="ahc_<?php echo $article->article_id; ?>_<?php echo $article->article_approve_status; ?>" href="javascript:void(0)" onclick="approve_home_confirm(this);" class="btn" data-dismiss="modal">Yes</a>
										<a href="javascript:void(0)" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>							
								<a id="a_<?php echo $article->article_id; ?>" href="#myAppDisModal_<?php echo $article->article_id; ?>" class="btn btn-icon tip" <?php if($article->article_approve_status == 1){ ?> data-original-title="Approved" <?php } else { ?> data-original-title="Disapproved" <?php } ?> data-toggle="modal" >
									<i id="icon_<?php echo $article->article_id; ?>" class="<?php if($article->article_approve_status == 1){ echo 'icon-blue'; }?> icon-fire"></i>
								</a>
								<?php 
									$article_title=$this->subdomain->process_url_title(substr($article->article_title,0,50));
									$article_link=$this->subdomain->genereate_the_subdomain_link($article->subdomain_name,'articles',$article_title,$article->article_id);				
								?>
								<a href="<?php echo $article_link ; ?>" class="btn btn-icon tip" data-original-title="Preview">
									<i class="icon-film"></i>
								</a>
								<div class="modal hide" id="myFeaUnfModal_<?php echo $article->article_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to change status ?</h3>											
									</div>
									<div class="modal-footer">
										<a id="mhf_<?php echo $article->article_id; ?>_<?php  echo $article->featured_home_article; ?>" href="javascript:void(0)" onclick="featured_home_confirm(this);" class="btn" data-dismiss="modal">Yes</a>
										<a href="javascript:void(0)" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>											
								<a id="mhf_a_<?php echo $article->article_id; ?>" href="#myFeaUnfModal_<?php echo $article->article_id; ?>"  class="btn btn-icon tip" <?php if($article->featured_home_article){ ?> data-original-title="Featured" <?php } else { ?> data-original-title="Unfeatured" <?php } ?> data-toggle="modal">
									<i id="mhf_icon_<?php echo $article->article_id; ?>" class="<?php if($article->featured_home_article){ echo 'icon-blue'; }?> icon-star"></i>
								</a>							
								<?php } ?>
							</div>
						</td>
                     </tr>
					 <?php } ?>         
                  </tbody>
                </table>
				<?php if($delete==1) { ?> 	
			<div class="tableactions" style="margin-top:70px;">
				<select name="univ_action" id="univ_action">
					<option value="">Actions</option>
					<option value="delete">Delete</option>
				</select>
				
				<input type="button" onclick="action_formsubmit(0,0)" class="submit tiny" value="Apply to selected" />
			</div>		<!-- .tableactions ends -->
		<?php  } ?>	
              </div>
			   <div class="tab-pane " id="new">
                <table class="table table-striped dataTable" id="media1">
                  <thead>
                    <tr>
                      <th width="5%"><input type="checkbox" class='sel_rows' data-targettable="media1"></th>
                      <th width="20%">Article Title</th>
                      <th width="20%">University Name</th>
                      <th width="15%">Status</th>
					  <th width="20%">Featured/UnFeatured</th>
					  <th width="20%">Choose Option</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php foreach($recent_articles as $recent)
					{ ?>
					<tr class="check_university_<?php echo $recent->article_id;?>">
                       <td>
					   <input type="checkbox" name="sel_row[]" value="<?php echo $recent->article_id;?>" class='selectable_checkbox setchkval' />
					   </td>
                       <td><?php echo ucwords(substr($recent->article_title,0,50)); ?></td>
                       <td><?php echo ucwords($recent->univ_name); ?></td>
                       <td id="ahc1_td_<?php echo $recent->article_id; ?>" class="center"> <?php if($recent->article_approve_status){ echo "Approved"; } else {  echo "Pending For Approve";} ?></td>
					   <td id="mhf1_td_<?php echo $recent->article_id; ?>"><?php if($recent->featured_home_article){ echo "Featured"; } else {  echo "Unfeatured";} ?></td>
					   <td class="options">
							<div class="btn-group">
								<?php if($view==1) { ?>
								<a href="<?php echo $base; ?>newadmin/adminarticles/view_article/<?php echo $recent->article_id; ?>" class="btn btn-icon tip" data-original-title="View">
									<i class="icon-ok"></i>
								</a>
								<?php } if($edit==1){ ?>
								<a href="<?php echo $base; ?>newadmin/adminarticles/edit_article/<?php echo $recent->article_id; ?>" class="btn btn-icon tip" data-original-title="Edit">
									<i class="icon-pencil"></i>
								</a>
								<?php } if($delete==1)   {?>
								<div class="modal hide" id="myModal1_<?php echo $recent->article_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to delete?</h3>
									</div>
									<div class="modal-footer">
										<a href="javascript:void(0);" onclick="delete_confirm('<?php echo $recent->article_id; ?>')" class="btn" data-dismiss="modal">Yes</a>
										<a href="javascript:void(0);" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>
								<a href="#myModal1_<?php echo $recent->article_id; ?>" class="btn btn-icon tip"  data-toggle="modal" data-original-title="Delete">
									<i class="icon-trash"></i>
								</a>
								<?php }
								if(($edit==1 || $delete==1 || $insert==1)){  ?>								
								<div class="modal hide" id="myAppDisModal1_<?php echo $recent->article_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>										
											<h3>Do you want to change status ?</h3>	
									</div>
									<div class="modal-footer">										
										<a id="ahc1_<?php echo $recent->article_id; ?>_<?php echo $recent->article_approve_status; ?>" href="javascript:void(0)" onclick="approve_home_confirm(this);" class="btn" data-dismiss="modal">Yes</a>
										<a href="javascript:void(0)" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>							
								<a id="a1_<?php echo $recent->article_id; ?>" href="#myAppDisModal1_<?php echo $recent->article_id; ?>" class="btn btn-icon tip" <?php if($recent->article_approve_status == 1){ ?> data-original-title="Approved" <?php } else { ?> data-original-title="Disapproved" <?php } ?> data-toggle="modal" >
									<i id="icon1_<?php echo $recent->article_id; ?>" class="<?php if($recent->article_approve_status == 1){ echo 'icon-blue'; }?> icon-fire"></i>
								</a>
								<?php 
									$article_title=$this->subdomain->process_url_title(substr($recent->article_title,0,50));
									$article_link=$this->subdomain->genereate_the_subdomain_link($recent->subdomain_name,'articles',$article_title,$recent->article_id);				
									?>
								<a href="<?php echo $article_link ; ?>" class="btn btn-icon tip" data-original-title="Preview">
									<i class="icon-film"></i>
								</a>							
								<div class="modal hide" id="myFeaUnfModal1_<?php echo $recent->article_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to change status ?</h3>											
									</div>
									<div class="modal-footer">
										<a id="mhf1_<?php echo $recent->article_id; ?>_<?php  echo $recent->featured_home_article; ?>" href="javascript:void(0)" onclick="featured_home_confirm(this);" class="btn" data-dismiss="modal">Yes</a>
										<a href="javascript:void(0)" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>											
								<a id="mhf_a1_<?php echo $recent->article_id; ?>" href="#myFeaUnfModal1_<?php echo $recent->article_id; ?>"  class="btn btn-icon tip" <?php if($recent->featured_home_article){ ?> data-original-title="Featured" <?php } else { ?> data-original-title="Unfeatured" <?php } ?> data-toggle="modal">
									<i id="mhf_icon1_<?php echo $recent->article_id; ?>" class="<?php if($recent->featured_home_article){ echo 'icon-blue'; }?> icon-star"></i>
								</a>
								<?php } ?>
							</div>
						</td>
                     </tr>
					 <?php }  ?>
                  </tbody>
                </table>
				<?php if($delete==1) { ?> 	
			<div class="tableactions" style="margin-top:70px;">
				<select name="univ_action" id="del_action">
					<option value="">Actions</option>
					<option value="delete">Delete</option>
				</select>
				
				<input type="button" onclick="action_formsubmit(0,0)" class="submit tiny" value="Apply to selected" />
			</div>		<!-- .tableactions ends -->
		<?php  } ?>	
              </div>
			  <div class="tab-pane" id="create">
				<div class="row-fluid">
					<div class="span9">
						<form class="form-horizontal" name="myform" onsubmit="return addArticle(this);" action="<?php echo $base; ?>newadmin/adminarticles/add_article" method="post" enctype="multipart/form-data">
							<fieldset>
								<div class="control-group">
								<label class="control-label" for="input01">Title</label>
								<div class="controls">
									<input type="text" class="input-xlarge" name="title" id="title">
								</div>
								</div>
								<?php if($admin_user_level=='5' || $admin_user_level=='4') {?>
								<div class="control-group">
								<label class="control-label" for="input06">Choose University</label>
								<div class="controls">
									<select name="univ" id="univ">
									<option value="0">- Please Select -</option>
								<?php foreach($univ_info as $univ_detail) 
									{ ?>
									<option value="<?php echo $univ_detail->univ_id; ?>" ><?php echo $univ_detail->univ_name; ?></option>
									<?php } ?>
									</select>
								</div>
								</div>
								<?php } else { ?>
									<input type="hidden" id="univ" name="univ" value="<?php echo $univ_info['univ_id']; ?>">		
									<?php }?>
								<div class="control-group">
									<label class="control-label" for="input04">Article Logo</label>
									<div class="controls">
										<input type="file" class="input-xlarge" id="userfile" name="userfile">
									</div>
								</div>
								<div class="control-group">
								<label class="control-label" for="input07">Detail</label>
								<div class="controls">
									<textarea name="detail" id="detail" class='span12' rows='8'></textarea>
								</div>
								</div>
								<div class="form-actions">
								<button type="submit" class='btn btn-primary'>Add Article</button>
								<a href="<?php echo $base; ?>newadmin/adminarticles/manage_articles" class='btn btn-danger'>Cancel</a>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
              </div>
			  
            </div>
          </div>
        </div>
      </div>
    </div><!-- close .container-fluid -->
  </div><!-- close .content -->
<!-- END Content -->
<script>
function addArticle()
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
function delete_confirm(id)
{	
	$.ajax({	
		type: "POST",
		url: "<?php echo $base; ?>newadmin/adminarticles/delete_single_article/"+id,
		async:false,
		data: '',
		cache: false,
		success: function(msg)
		{
			if(msg == 1)
			{
				$('.check_university_'+id).hide();
				$('.check_university1_'+id).hide();
				$('#delete').show();
				setTimeout(function(){$('#delete').hide('slow');},2000);		
			}
			else
			{
				$('#denied').show();
				setTimeout(function(){$('#denied').hide('slow');},2000);	
			}
		}
	});
}
function approve_home_confirm(id_sta)
{
	var arr = id_sta.id.split('_');	
	var c = arr[1];		//id
	var b = arr[2];		//status
	var data={'id':c,'status':b};	
	$.ajax({
		type: "POST",
		url: '<?php echo $base; ?>newadmin/adminarticles/approve_disapprove_article/'+b+'/'+c,
		async:false,
		data: data,
		cache: false,
		success: function(msg)
		{
			if(msg == '1')
			{				
				$('#icon_'+c).addClass('icon-blue');
				$('#icon1_'+c).addClass('icon-blue');
				$('#a_'+c).attr('data-original-title','Approved');
				$('#a1_'+c).attr('data-original-title','Approved');
				$('#ahc_'+c+'_'+b).attr('id','ahc_'+c+'_'+msg);
				$('#ahc1_'+c+'_'+b).attr('id','ahc1_'+c+'_'+msg);
				$('#ahc_td_'+c).text("Approved");
				$('#ahc1_td_'+c).text("Approved");				
				$('#approved').show();				
				setTimeout(function(){$('#approved').fadeOut('slow');},2000);				
			}
			else if(msg == '0')
			{				
				$('#icon_'+c).removeClass('icon-blue');
				$('#icon1_'+c).removeClass('icon-blue');
				$('#a_'+c).attr('data-original-title','Disapproved');			
				$('#a1_'+c).attr('data-original-title','Disapproved');			
				$('#ahc_'+c+'_'+b).attr('id','ahc_'+c+'_'+msg);				
				$('#ahc1_'+c+'_'+b).attr('id','ahc1_'+c+'_'+msg);
				$('#ahc_td_'+c).text("Pending For Approve");
				$('#ahc1_td_'+c).text("Pending For Approve");
				$('#disapproved').show();
				setTimeout(function(){$('#disapproved').fadeOut('slow');},2000);				
			}
			else
			{
				$('#denied').show();
				setTimeout(function(){$('#denied').fadeOut('slow');},2000);				
			}
		}
	});	
}
function featured_home_confirm(id_sta)
{
	var arr = id_sta.id.split('_');	
	var c = arr[1];		//id
	var b = arr[2];		//status
	if(b==1)
	{
		$.ajax({
			type: "POST",
			url: '<?php echo $base; ?>newadmin/adminarticles/featured_unfeatured_article/'+b+'/'+c,
			async:false,
			data: '',
			cache: false,
			success: function(msg)
			{
				if(msg==1)
				{
					$('#mhf_icon_'+c).addClass('icon-blue');
					$('#mhf_icon1_'+c).addClass('icon-blue');
					$('#mhf_a_'+c).attr('data-original-title','Featured');
					$('#mhf_a1_'+c).attr('data-original-title','Featured');
					$('#mhf_'+c+'_'+b).attr('id','mhf_'+c+'_'+msg);
					$('#mhf1_'+c+'_'+b).attr('id','mhf1_'+c+'_'+msg);
					$('#mhf_td_'+c).text("Featured");
					$('#mhf1_td_'+c).text("Featured");
					$('#featured').show();				
					setTimeout(function(){$('#featured').fadeOut('slow');},2000);
				}
				else if(msg==0)
				{
					$('#mhf_icon_'+c).removeClass('icon-blue');
					$('#mhf_icon1_'+c).removeClass('icon-blue');
					$('#mhf_a_'+c).attr('data-original-title','Featured');
					$('#a1_'+c).attr('data-original-title','Featured');
					$('#mhf_'+c+'_'+b).attr('id','mhf_'+c+'_'+msg);
					$('#mhf1_'+c+'_'+b).attr('id','mhf1_'+c+'_'+msg);
					$('#mhf_td_'+c).text("Unfeatured");
					$('#mhf1_td_'+c).text("Unfeatured");
					$('#unfeatured').show();				
					setTimeout(function(){$('#unfeatured').fadeOut('slow');},2000);
				}
				else
				{
					$('#denied').show();
					setTimeout(function(){$('#denied').fadeOut('slow');},2000);	
				}
			}
			
		});
	}
	else
	{
		$.ajax({
			type: "POST",
			url: "<?php echo $base; ?>newadmin/adminarticles/count_featured_articles/featured_home_article",
			async:false,
			data: '',
			cache: false,
			success: function(msg)
			{
				if(msg==1)
				{
					$.ajax({
						type: "POST",
						url: '<?php echo $base; ?>newadmin/adminarticles/featured_unfeatured_article/'+b+'/'+c,
						async:false,
						data: '',
						cache: false,
						success: function(msg)
						{
							if(msg==1)
							{
								$('#mhf_icon_'+c).addClass('icon-blue');
								$('#mhf_icon1_'+c).addClass('icon-blue');
								$('#mhf_a_'+c).attr('data-original-title','Featured');
								$('#mhf_a1_'+c).attr('data-original-title','Featured');
								$('#mhf_'+c+'_'+b).attr('id','mhf_'+c+'_'+msg);
								$('#mhf1_'+c+'_'+b).attr('id','mhf1_'+c+'_'+msg);
								$('#mhf_td_'+c).text("Featured");
								$('#mhf1_td_'+c).text("Featured");
								$('#featured').show();				
								setTimeout(function(){$('#featured').fadeOut('slow');},2000);
							}
							else if(msg==0)
							{
								$('#mhf_icon_'+c).removeClass('icon-blue');
								$('#mhf_icon1_'+c).removeClass('icon-blue');
								$('#mhf_a_'+c).attr('data-original-title','Featured');
								$('#a1_'+c).attr('data-original-title','Featured');
								$('#mhf_'+c+'_'+b).attr('id','mhf_'+c+'_'+msg);
								$('#mhf1_'+c+'_'+b).attr('id','mhf1_'+c+'_'+msg);
								$('#mhf_td_'+c).text("Unfeatured");
								$('#mhf1_td_'+c).text("Unfeatured");
								$('#unfeatured').show();				
								setTimeout(function(){$('#unfeatured').fadeOut('slow');},2000);
							}
							else
							{
								$('#denied').show();
								setTimeout(function(){$('#denied').fadeOut('slow');},2000);	
							}
						}
						
					});
				}				
				else
				{
					$('#alert').show();
					setTimeout(function(){$('#alert').hide('slow');},2000);					
				}
			}
		});
	}
}
var arr=new Array;

function action_formsubmit(id,flag)
{
	var action;
	if($('#univ_action').val()!='')
	{
		action=$('#univ_action').val();
	}
	if($('#del_action').val()!='')
	{
		action=$('#del_action').val();
	}
	
	if(action=='delete')
	{
		var atLeastOneIsChecked = $('.setchkval:checked').length > 0;
		if(atLeastOneIsChecked)
		{
			var r=confirm("Are you sure you want to delete selected article");
			set_chkbox_val();
			var data={'article_id':arr};

			if(r)
			{
				$.ajax({
					type:"post",
					url:'<?php echo $base ?>newadmin/adminarticles/delete_articles',
					async:false,
					data: data,
					cache: false,
					success: function(msg)
					{						
						$('.toremove').hide();
						$("#deleted").show();
						$("#deleted").delay(5000).hide("slow");
					}

				});
			}
		}
		else
		{
			alert("please select al least one article");
			return false;
		}
	}
	else
	{
		alert("please select the action");
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
</script>