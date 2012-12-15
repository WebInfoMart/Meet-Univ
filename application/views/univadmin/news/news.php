<div class="modal hide" id="alert">
	<div class="modal-header">		
		<div align="center" style="color:red;"><h3>You have reached maximum limit</h3></div>
	</div>
</div>
<div class="modal hide" id="deleted">
	<div class="modal-header">		
		<div align="center"><h3>News deleted successfully</h3></div>
	</div>
</div>
<div class="modal hide" id="approved">
	<div class="modal-header">		
		<div align="center"><h3>News approved successfully</h3></div>
	</div>
</div>
<div class="modal hide" id="disapproved">
	<div class="modal-header">		
		<div align="center"><h3>News disapproved successfully</h3></div>
	</div>
</div>
<div class="modal hide" id="featured">
	<div class="modal-header">		
		<div align="center"><h3>News featured successfully</h3></div>
	</div>
</div>
<div class="modal hide" id="unfeatured">
	<div class="modal-header">		
		<div align="center"><h3>News unfeatured successfully</h3></div>
	</div>
</div>
<div class="modal hide" id="sel_atl_one">
	<div class="modal-header">		
		<div align="center"><h3>please select atleast one news</h3></div>
	</div>
</div>
<div class="modal hide" id="sel_act">
	<div class="modal-header">		
		<div align="center"><h3>please select the action</h3></div>
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
            <ul class="nav nav-pills">
              <li class='active'>
                <a href="#all" data-toggle="pill">All</a>
              </li>
              <li>
                <a href="#new" data-toggle="pill">New</a>
              </li>
			  <li>
                <a href="#create" data-toggle="pill" class="active_menu">Create News</a>
              </li>
            </ul>
          </div>
          <div class="content-box">
            <div class="tab-content">
              <div class="tab-pane active" id="all">
                <table class="responsive table table-striped dataTable" id="allcheck">
                  <thead>
                    <tr>
                      <th width="5%"> 
					  <input type="checkbox" name="sel_row" class='sel_rows' data-targettable="allcheck"></th>
                      <th width="20%">News Title</th>
                      <th width="20%">University Name</th>
                      <th width="15%">Status</th>
					  <th width="20%">Featured/NotFeatured</th>
					  <th width="20%">Choose Option</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php foreach($news_info as $news)
				  { ?>
					<tr class="check_university_<?php echo $news->news_id;?>">
                      <td> <input type="checkbox" name="sel_row[]" value="<?php echo $news->news_id;?>" class='selectable_checkbox setchkval' /></td>
                      <td><?php echo ucwords(substr($news->news_title,0,50)); ?></td>
                       <td><?php echo ucwords($news->univ_name); ?></td>
					   <td id="ahc_td_<?php echo $news->news_id; ?>"><?php if($news->news_approve_status){ echo "Approved"; } else {  echo "Disapproved";} ?></td>
                       <td id="mhf_td_<?php echo $news->news_id; ?>" class="center"> <?php if($news->featured_home_news){ echo "Featured"; } else {  echo "Unfeatured";} ?></td>
					   <td class="options">
							<div class="btn-group">
							<?php if($view==1) { ?>
								<a href="<?php echo $base; ?>newadmin/admin_news/view_news/<?php echo $news->news_id; ?>" class="btn btn-icon tip" data-original-title="View">
									<i class="icon-ok"></i>
								</a>
								<?php } if($edit==1) { ?>
								<a href="<?php echo $base; ?>newadmin/admin_news/edit_news/<?php echo $news->news_id; ?>" class="btn btn-icon tip" data-original-title="Edit">
									<i class="icon-pencil"></i>
								</a>
								<?php } if($delete==1) { ?>
								<div class="modal hide" id="myModal_<?php echo $news->news_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to delete?</h3>
									</div>
									<div class="modal-footer">
										<a href="javascript:void(0);" onclick="delete_confirm('<?php echo $news->news_id; ?>')" class="btn" data-dismiss="modal">Yes</a>
										<a href="javascript:void(0);" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>
								<a href="#myModal_<?php echo $news->news_id; ?>" class="btn btn-icon tip" data-toggle="modal" data-original-title="Delete">
									<i class="icon-trash"></i>
								</a>
								<?php }if($edit==1 ){ ?>								
								<div class="modal hide" id="myAppDisModal_<?php echo $news->news_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to change status ?</h3>	
									</div>
									<div class="modal-footer">
										<a id="ahc_<?php echo $news->news_id; ?>_<?php echo $news->news_approve_status; ?>" href="javascript:void(0)" onclick="approve_home_confirm(this);" class="btn" data-dismiss="modal">Yes</a>
										<a href="javascript:void(0)" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>
								<a id="a_<?php echo $news->news_id; ?>" href="#myAppDisModal_<?php echo $news->news_id; ?>" class="btn btn-icon tip" <?php if($news->news_approve_status == 1){ ?> data-original-title="Approved" <?php } else { ?> data-original-title="Disapproved" <?php } ?> data-toggle="modal" >
									<i id="icon_<?php echo $news->news_id; ?>" class="<?php if($news->news_approve_status == 1){ echo 'icon-blue'; }?> icon-fire"></i>
								</a>
								<?php 
								$news_title=$this->subdomain->process_url_title(substr($news->news_title,0,50));
								$news_link=$this->subdomain->genereate_the_subdomain_link($news->subdomain_name,'news',$news_title,$news->news_id);
								?>
								<a href="<?php echo $news_link; ?>" class="btn btn-icon tip" data-original-title="Preview">
									<i class="icon-film"></i>
								</a>
								<div class="modal hide" id="myFeaUnfModal_<?php echo $news->news_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to change status ?</h3>										
									</div>
									<div class="modal-footer">
										<a id="mhf_<?php echo $news->news_id; ?>_<?php  echo $news->featured_home_news; ?>" href="javascript:void(0)" onclick="featured_home_confirm(this);" class="btn" data-dismiss="modal">Yes</a>
										<a href="javascript:void(0)" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>
								<a id="mhf_a_<?php echo $news->news_id; ?>" href="#myFeaUnfModal_<?php echo $news->news_id; ?>"  class="btn btn-icon tip" <?php if($news->featured_home_news){ ?> data-original-title="Featured" <?php } else { ?> data-original-title="Unfeatured" <?php } ?> data-toggle="modal">
									<i id="mhf_icon_<?php echo $news->news_id; ?>" class="<?php if($news->featured_home_news){ echo 'icon-blue'; }?> icon-star"></i>
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
              <div class="tab-pane" id="new">
				<table class="responsive table table-striped dataTable" id="targetSample2">
                  <thead>
                    <tr>
                      <th width="10%"><input type="checkbox" name="sel_row" class='sel_rows' data-targettable="targetSample2"></th>
                      <th width="25%">News Title</th>
                      <th width="25%">University Name</th>
                      <th width="20%">Status</th>
					  <th width="20%">Featured/NotFeatured</th>
					   <th width="20%">Choose Option</th>
                    </tr>
                  </thead>
                  <tbody>
				   <?php foreach($latest_news as $row)
				  { ?>
					<tr class="check_university_<?php echo $row->news_id;?>">
                      <td> <input type="checkbox" name="sel_row[]" value="<?php echo $row->news_id; ?>" class='selectable_checkbox setchkval'></td>
                      <td><?php echo ucwords(substr($row->news_title,0,50)); ?></td>
                       <td><?php echo ucwords($row->univ_name); ?></td>
					   <td id="ahc1_td_<?php echo $row->news_id; ?>"><?php if($row->news_approve_status){ echo "Approve"; } else {  echo "Disapproved";} ?></td>
                       <td id="mhf1_td_<?php echo $row->news_id; ?>" class="center"> <?php if($row->featured_home_news){ echo "Make Unfeatured"; } else {  echo "Make Featured";} ?></td>
					   <td class="options">
							<div class="btn-group">
							<?php if($view==1){ ?>
								<a href="<?php echo $base; ?>newadmin/admin_news/view_news/<?php echo $row->news_id; ?>" class="btn btn-icon tip" data-original-title="View">
									<i class="icon-ok"></i>
								</a>
								<?php }if($edit==1) { ?>
								<a href="<?php echo $base; ?>newadmin/admin_news/edit_news/<?php echo $row->news_id; ?>" class="btn btn-icon tip" data-original-title="Edit">
									<i class="icon-pencil"></i>
								</a>
								<?php }if($delete==1){ ?>
								<div class="modal hide" id="myModal1_<?php echo $row->news_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to delete?</h3>
									</div>
									<div class="modal-footer">
										<a href="" onclick="delete_confirm('<?php echo $row->news_id; ?>');" class="btn" data-dismiss="modal">Yes</a>
										<a href="#" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>
								<a href="#myModal1_<?php echo $row->news_id; ?>" class="btn btn-icon tip" data-toggle="modal" data-original-title="Delete">
									<i class="icon-trash"></i>
								</a>
								<?php }if($edit==1) { ?>
								<div class="modal hide" id="myAppDisModal1_<?php echo $row->news_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to change status ?</h3>	
									</div>
									<div class="modal-footer">
										<a id="ahc1_<?php echo $row->news_id; ?>_<?php echo $row->news_approve_status; ?>" href="javascript:void(0)" onclick="approve_home_confirm(this);" class="btn" data-dismiss="modal">Yes</a>
										<a href="javascript:void(0)" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>
								<a id="a1_<?php echo $row->news_id; ?>" href="#myAppDisModal1_<?php echo $row->news_id; ?>" class="btn btn-icon tip" <?php if($row->news_approve_status == 1){ ?> data-original-title="Approved" <?php } else { ?> data-original-title="Disapproved" <?php } ?> data-toggle="modal" >
									<i id="icon1_<?php echo $row->news_id; ?>" class="<?php if($row->news_approve_status == 1){ echo 'icon-blue'; }?> icon-fire"></i>
								</a>								
								<?php 
								$news_title=$this->subdomain->process_url_title(substr($row->news_title,0,50));
								$news_link=$this->subdomain->genereate_the_subdomain_link($row->subdomain_name,'news',$news_title,$row->news_id);
								?>
								<a href="<?php echo $news_link; ?>" class="btn btn-icon tip" data-original-title="Preview">
									<i class="icon-film"></i>
								</a>
								<div class="modal hide" id="myFeaUnfModal1_<?php echo $row->news_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to change status ?</h3>										
									</div>
									<div class="modal-footer">
										<a id="mhf1_<?php echo $row->news_id; ?>_<?php  echo $row->featured_home_news; ?>" href="javascript:void(0)" onclick="featured_home_confirm(this);" class="btn" data-dismiss="modal">Yes</a>
										<a href="javascript:void(0)" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>
								<a id="mhf_a1_<?php echo $row->news_id; ?>" href="#myFeaUnfModal1_<?php echo $row->news_id; ?>"  class="btn btn-icon tip" <?php if($row->featured_home_news){ ?> data-original-title="Featured" <?php } else { ?> data-original-title="Unfeatured" <?php } ?> data-toggle="modal">
									<i id="mhf_icon1_<?php echo $row->news_id; ?>" class="<?php if($row->featured_home_news){ echo 'icon-blue'; }?> icon-star"></i>
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
						<form class="form-horizontal" method="post" name="myform" action="<?php echo $base; ?>newadmin/admin_news/add_news" enctype="multipart/form-data">
							<fieldset>
								<div class="control-group">
								<label class="control-label"  for="input01">Title</label>
								<div class="controls">
									<input type="text" class="input-xlarge" name="title" id="title">
								</div>
								</div>
								<?php if($admin_user_level=='5' || $admin_user_level=='4') {?>
								<div class="control-group">
								<label class="control-label" for="input06">Choose University</label>
								<div class="controls">
									<select id="univ" name="univ" id="input06">
									<option value="0">- Please Select  -</option>
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
									<label class="control-label" for="input04">News Logo</label>
									<div class="controls">
										<input type="file" class="input-xlarge" name="userfile" id="userfile"><br />										
										<span id="wrongfile">Only jpg,jpeg,gif,png </span>
									</div>
								</div>
								<div class="control-group">
								<label class="control-label" for="input07">Detail</label>
								<div class="controls">
									<textarea name="detail" id="detail" class='span12' rows='8'></textarea>
								</div>
								</div>
								<div class="form-actions">
								<button type="button" onclick="addNews()" class='btn btn-primary'>Add News</button>
								<input type="button"  onclick="cancel()" class='btn btn-success pover' data-placement="top" data-content="Want to cancel" title="Cancel" value="Cancel" />
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
function cancel()							//added by satbir 12/14/2012
{
	$("#title").val('');
	$("#title").removeClass('needsfilled');
	$("#univ").removeClass('needsfilled');
	$("#detail").val('');
	$("#detail").removeClass('needsfilled');	
}
function addNews()
{
	if($('#univ option:selected').val()=='0')
	{
		$("#univ").addClass('needsfilled');
	}
	else
	{
		$("#univ").removeClass('needsfilled');
	}
	if($("#title").val()=='')
	{
		$("#title").addClass('needsfilled');		
	}
	else
	{
		$("#title").removeClass('needsfilled');
	}
	if($("#detail").val()=='')
	{
		$("#detail").addClass('needsfilled');		
	}
	else
	{
		$("#detail").removeClass('needsfilled');
	}
		
	if($("#title").val()!='' && $("#detail").val()!='' )
	{
		document.forms["myform"].submit();
	}
}
function delete_confirm(newsid)
{
	$.ajax({	
		type: "POST",
		url: "<?php echo $base; ?>newadmin/admin_news/delete_single_news/"+newsid,
		async:false,
		data: '',
		cache: false,
		success: function(msg)
		{
			if(msg=='1')
			{
				$('.check_university_'+newsid).hide();
				$('#deleted').show();
				setTimeout(function(){$('#deleted').fadeOut('slow');},3000);		
			}
			else
			{
				
				$('#denied').show();
				setTimeout(function(){$('#denied').fadeOut('slow');},3000);	
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
		url: '<?php echo $base; ?>newadmin/admin_news/approve_disapprove_news/'+b+'/'+c,
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
				$('#ahc_td_'+c).text("Disapproved");
				$('#ahc1_td_'+c).text("Disapproved");
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
			url: '<?php echo $base; ?>newadmin/admin_news/featured_unfeatured_news/'+b+'/'+c,
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
			url: "<?php echo $base; ?>newadmin/admin_news/count_featured_news/featured_home_news",
			async:false,
			data: '',
			cache: false,
			success: function(msg)
			{
				if(msg==1)
				{
					$.ajax({
						type: "POST",
						url: '<?php echo $base; ?>newadmin/admin_news/featured_unfeatured_news/'+b+'/'+c,
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
					setTimeout(function(){$('#alert').fadeOut('slow');},2000);					
				}
			}
		});
	}
}
var arr=new Array;
function action_formsubmit(id,flag)
{
	var action;
	if($('#univ_action option:selected').val()!='')
	{
		action=$('#univ_action option:selected').val();
	}
	if($('#del_action option:selected').val()!='')
	{
		action=$('#del_action option:selected').val();
	}
	if(action=='delete')
	{
		var atLeastOneIsChecked = $('.setchkval:checked').length > 0;
		if(atLeastOneIsChecked)
		{
			var r=confirm("Are you sure you want to delete selected news");
			set_chkbox_val();
			
			var data={'news_id':arr};

			if(r)
			{
				$.ajax({
					type:"post",
					url:'<?php echo $base ?>newadmin/admin_news/delete_news',
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
 </script>
