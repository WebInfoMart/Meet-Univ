<div class="modal hide" id="alert">
	<div class="modal-header">		
		<div align="center" style="color:red;"><h3>You have reached maximum limit for show ques</h3></div>
	</div>
</div>
<div class="modal hide" id="deleted">
	<div class="modal-header">		
		<div align="center"><h3>Question deleted successfully</h3></div>
	</div>
</div>
<div class="modal hide" id="approved">
	<div class="modal-header">		
		<div align="center"><h3>Question approved successfully</h3></div>
	</div>
</div>
<div class="modal hide" id="disapproved">
	<div class="modal-header">		
		<div align="center"><h3>Question disapproved successfully</h3></div>
	</div>
</div>
<div class="modal hide" id="featured">
	<div class="modal-header">		
		<div align="center"><h3>Question featured successfully</h3></div>
	</div>
</div>
<div class="modal hide" id="unfeatured">
	<div class="modal-header">		
		<div align="center"><h3>Question unfeatured successfully</h3></div>
	</div>
</div>
<div class="modal hide" id="addques">
	<div class="modal-header">		
		<div align="center"><h3>Question Added Successfully</h3></div>
	</div>
</div>
<div class="modal hide" id="sel_atl_one">
	<div class="modal-header">		
		<div align="center"><h3>please select atleast one question</h3></div>
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
            <h2>Question</h2>
            <ul class="nav nav-pills">
              <li class='active'>
                <a href="#all" data-toggle="pill">All</a>
              </li>
              <li>
                <a href="#new" data-toggle="pill">New</a>
              </li>
			  <li>
                <a href="#create" data-toggle="pill" class="active_menu">Add Question</a>
              </li>
            </ul>
          </div>
          <div class="content-box">
            <div class="tab-content">
              <div class="tab-pane active" id="all">
                <table class="responsive table table-striped dataTable" id="media">
                  <thead>
                    <tr>
                      <th width="5%"><input type="checkbox" class='sel_rows' data-targettable="media"></th>
                      <th width="20%">Questions Title</th>
                      <th width="20%">University Name</th>
                      <!--<th>Status</th>-->
					  <th width="15%">Featured</th>
					  <th width="20%">Answers Count</th>
					   <th width="20%">Choose Option</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
				if(!empty($ques_info))
				{
				foreach($ques_info as $row){
				?>
					<tr class="check_university_<?php echo $row->que_id;?>" >
						<td><input type="checkbox" class="selectable_checkbox setchkval" value="<?php echo $row->que_id;?>"></td>
						<td><?php echo ucwords(substr($row->q_title,0,50)); ?></td>
						<td><?php echo ucwords($row->univ_name); ?></td>					   
						<!--<td class="center"><?php //if($row->q_approve){ echo "Disapprove"; } else { echo "Approve";} ?></td>-->
						<td id="mhf_td_<?php echo $row->que_id; ?>"><?php if($row->q_featured_home_que){ echo "Featured"; } else {  echo"Unfeatured";} ?></td>
						<td id="count_<?php echo $row->que_id; ?>"><?php $count=$this->ques_model->ans_count($row->que_id); echo $count; ?></td>	
						<td class="options">
							<div class="btn-group">
							<!--
								<a href="<?php //echo "$base"; ?>newadmin/admin_ques/edit_ques/<?php //echo $row->que_id; ?>" class="btn btn-icon tip" data-original-title="View">
									<i class="icon-ok"></i>
								</a>-->
								<?php   if($view==1 || $edit==1) { ?>
								<a href="<?php echo "$base"; ?>newadmin/admin_ques/edit_ques/<?php echo $row->que_id; ?>" class="btn btn-icon tip" data-original-title="View">
									<i class="icon-pencil"></i>
								</a>
								<?php } if($delete==1){ ?>
								<div class="modal hide" id="myModal_<?php echo $row->que_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to delete?</h3>
									</div>
									<div class="modal-footer">
										<a href="javascript:void(0);" onclick="delete_confirm('<?php echo $row->que_id; ?>');" class="btn" data-dismiss="modal">Yes</a>
										<a href="javascript:void(0);" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>
								<a href="#myModal_<?php echo $row->que_id; ?>" class="btn btn-icon tip" data-toggle="modal" data-original-title="Delete">
									<i class="icon-trash"></i>
								</a>
								<?php }								
								$ques_title=$this->subdomain->process_url_title(substr($row->q_title,0,50));
								$ques_link=$this->subdomain->genereate_the_subdomain_link($row->subdomain_name,'ques',$ques_title,$row->que_id);
								?>
								<a href="<?php echo $ques_link; ?>" class="btn btn-icon tip" data-original-title="Preview">
									<i class="icon-film"></i>
								</a>
								<?php if(($edit==1 || $delete==1 || $insert==1) ) 
								{ ?>
								<div class="modal hide" id="myAppDisModal_<?php echo $row->que_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to change status ?</h3>	
									</div>
									<div class="modal-footer">
										<a id="ahc_<?php echo $row->que_id; ?>_<?php echo $row->q_approve; ?>" href="javascript:void(0)" onclick="approve_home_confirm(this);" class="btn" data-dismiss="modal">Yes</a>
										<a href="javascript:void(0)" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>
								<a id="a_<?php echo $row->que_id; ?>" href="#myAppDisModal_<?php echo $row->que_id; ?>" class="btn btn-icon tip" <?php if($row->q_approve == 1){ ?> data-original-title="Approved" <?php } else { ?> data-original-title="Disapproved" <?php } ?> data-toggle="modal" >
									<i id="icon_<?php echo $row->que_id; ?>" class="<?php if($row->q_approve == 1){ echo 'icon-blue'; }?> icon-fire"></i>
								</a>								
								<div class="modal hide" id="myFeaUnfModal_<?php echo $row->que_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to change status ?</h3>											
									</div>
									<div class="modal-footer">
										<a id="mhf_<?php echo $row->que_id; ?>_<?php  echo $row->q_featured_home_que; ?>" href="javascript:void(0)" onclick="featured_home_confirm(this);" class="btn" data-dismiss="modal">Yes</a>
										<a href="javascript:void(0)" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>											
								<a id="mhf_a_<?php echo $row->que_id; ?>" href="#myFeaUnfModal_<?php echo $row->que_id; ?>"  class="btn btn-icon tip" <?php if($row->q_featured_home_que){ ?> data-original-title="Featured" <?php } else { ?> data-original-title="Unfeatured" <?php } ?> data-toggle="modal">
									<i id="mhf_icon_<?php echo $row->que_id; ?>" class="<?php if($row->q_featured_home_que){ echo 'icon-blue'; }?> icon-star"></i>
								</a>
								<?php } ?>
							</div>
						</td>
                     </tr>
					 <?php } } ?>
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
				 <table class="responsive  table table-striped dataTable" id="media1">
                  <thead>
                    <tr>
                      <th><input type="checkbox" class='sel_rows' data-targettable="media1"></th>
                      <th>Questions Title</th>
                      <th>University Name</th>
                      <!--<th>Status</th>-->
					  <th>Featured</th>
					  <th>Answers Count</th>
					   <th style="width:16%!important;">Choose Option</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
				if(!empty($latest_ques))
				{
				foreach($latest_ques as $latest){
				?>
					<tr class="check_university_<?php echo $latest->que_id;?>" >
                      <td>
					  <input type="checkbox" class="selectable_checkbox setchkval" value="<?php echo $latest->que_id;?>">
					  </td>
                      <td><?php echo ucwords(substr($latest->q_title,0,50)); ?></td>
                       <td><?php echo ucwords($latest->univ_name); ?></td>					   
                      <!-- <td class="center"><?php //if($latest->q_approve){ echo "Disapprove"; } else { echo "Approve";} ?></td>-->
					   <td id="mhf1_td_<?php echo $latest->que_id; ?>"><?php if($latest->q_featured_home_que){ echo "Featured"; } else {  echo "Unfeatured";} ?></td>
					   <td id="count_<?php echo $latest->que_id; ?>"><?php $count=$this->ques_model->ans_count($latest->que_id); echo $count; ?></td>	
					    <td class="options">
							<div class="btn-group">
							<!--
								<a href="<?php //echo "$base"; ?>newadmin/admin_ques/edit_ques/<?php //echo $latest->que_id; ?>" class="btn btn-icon tip" data-original-title="View">
									<i class="icon-ok"></i>
								</a>-->
								<?php  if($view==1 || $edit==1) { ?>
								<a href="<?php echo "$base"; ?>newadmin/admin_ques/edit_ques/<?php echo $latest->que_id; ?>" class="btn btn-icon tip" data-original-title="View">
									<i class="icon-pencil"></i>
								</a>
								<?php } if($delete==1){ ?>
								<div class="modal hide" id="myModal1_<?php echo $latest->que_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to delete?</h3>
									</div>
									<div class="modal-footer">
										<a href="javascript:void(0);" onclick="delete_confirm('<?php echo $latest->que_id; ?>');" class="btn" data-dismiss="modal">Yes</a>
										<a href="javascript:void(0);" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>
								<a href="#myModal1_<?php echo $latest->que_id; ?>" class="btn btn-icon tip" data-toggle="modal" data-original-title="Delete">
									<i class="icon-trash"></i>
								</a>
								<?php }								
								$ques_title=$this->subdomain->process_url_title(substr($latest->q_title,0,50));
								$ques_link=$this->subdomain->genereate_the_subdomain_link($latest->subdomain_name,'ques',$ques_title,$latest->que_id);
								?>
								<a href="<?php echo $ques_link; ?>" class="btn btn-icon tip" data-original-title="Preview">
									<i class="icon-film"></i>
								</a>
								<?php if(($edit==1 || $delete==1 || $insert==1)) 
								{ ?>
								<div class="modal hide" id="myAppDisModal1_<?php echo $latest->que_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to change status ?</h3>	
									</div>
									<div class="modal-footer">
										<a id="ahc1_<?php echo $latest->que_id; ?>_<?php echo $latest->q_approve; ?>" href="javascript:void(0)" onclick="approve_home_confirm(this);" class="btn" data-dismiss="modal">Yes</a>
										<a href="javascript:void(0)" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>
								<a id="a1_<?php echo $latest->que_id; ?>" href="#myAppDisModal1_<?php echo $latest->que_id; ?>" class="btn btn-icon tip" <?php if($latest->q_approve == 1){ ?> data-original-title="Approved" <?php } else { ?> data-original-title="Disapproved" <?php } ?> data-toggle="modal" >
									<i id="icon1_<?php echo $latest->que_id; ?>" class="<?php if($latest->q_approve == 1){ echo 'icon-blue'; }?> icon-fire"></i>
								</a>
								<div class="modal hide" id="myFeaUnfModal1_<?php echo $latest->que_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to change status ?</h3>											
									</div>
									<div class="modal-footer">
										<a id="mhf1_<?php echo $latest->que_id; ?>_<?php  echo $latest->q_featured_home_que; ?>" href="javascript:void(0)" onclick="featured_home_confirm(this);" class="btn" data-dismiss="modal">Yes</a>
										<a href="javascript:void(0)" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>											
								<a id="mhf_a1_<?php echo $latest->que_id; ?>" href="#myFeaUnfModal1_<?php echo $latest->que_id; ?>"  class="btn btn-icon tip" <?php if($latest->q_featured_home_que){ ?> data-original-title="Featured" <?php } else { ?> data-original-title="Unfeatured" <?php } ?> data-toggle="modal">
									<i id="mhf_icon1_<?php echo $latest->que_id; ?>" class="<?php if($latest->q_featured_home_que){ echo 'icon-blue'; }?> icon-star"></i>
								</a>
								<?php } ?>
							</div>
						</td>
                     </tr>
					 <?php } } ?>
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
						<form class="form-horizontal" >
							<fieldset>							
								<div class="control-group">
								<input type="hidden" name="ques_type_ud" value="univ_ques"/>
								<label class="control-label" >Title</label>
								<div class="controls">
								<input type="text" id="title"  class="input-xlarge ">
								</div>
								</div>
								<?php if($admin_user_level['admin_user_level']!='3')
								{ ?>
								<div class="control-group">
								<label class="control-label" for="select01">Select Categories:</label>
								<div class="controls">
								<select id="category" name="category" onchange="fetch_collage(this);">
								<option value="general">Choose Type</option>			
								<option value="univ">College</option>			
								</select>		
								</div>
								</div>
								<div class="control-group">
								<label class="control-label" for="select0">Choose University:</label>
								<div class="controls">
								<select id="colleges" name="colleges" >
								<option value="0"> select </option>	
								</select>
								</div>
								</div>			
								<?php }
								else
								{ ?>
									<input type="hidden" id="category" value="univ" />	
									<input type="hidden" id="colleges" value="<?php echo $univ_info['univ_id']; ?>" />
								<?php
								}
								?>
								<div class="control-group">
								<label class="control-label" for="input07">Detail</label>
								<div class="controls">
									<textarea name="detail" id="detail" class='span12' rows='8'></textarea>
								</div>
								</div>
								<div class="form-actions">
								<input type="button"  onclick="addQues()" class='btn btn-primary' value="Add Question" />
								<a href="#" class='btn btn-danger'>Cancel</a>
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


 <script type="text/javascript">
function fetch_collage(values)
{
var type = values.value;
if(type == 'univ')
{
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>quest_ans_controler/collage_list_ajax",
   data: '',
   cache: false,
   success: function(msg)
   {
	$('#colleges').html(msg);
   }
   });
 }
 else if(type == 'sa')
 {
	$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>quest_ans_controler/country_list_ajax",
   data: '',
   cache: false,
   success: function(msg)
   {
	$('#colleges').html(msg);
   }
   });
 }
}
function addQues()
{
	if($("#title").val()=='')
	{
		$("#title").addClass('needsfilled');		
	}
	if($("#detail").val()=='')
	{
		$("#detail").addClass('needsfilled');		
	}
		
	if($("#title").val()!='' && $("#detail").val()!='' )
	{
	
	var title=$('#title').val();
	var colleges=$('#colleges').val();
	var category=$('#category').val();
	var type=$('#ques_type_ud').val();
	var detail=$('#detail').val();
	var data={type:type,title:title,colleges:colleges,detail:detail,category:category};
	$.ajax({
	type:"POST",
	url:"<?php echo $base; ?>newadmin/admin_ques/add_ques",
	data:data,
	cache:false,
	success:function(msg)
	{
		if(msg=='1')
		{
			$('#addques').show();
			setTimeout(function(){$('#addques').fadeOut('slow');},3000);
		}
	}
	});
	}
}
function delete_confirm(id)
{
	$.ajax({	
		type: "POST",
		url: "<?php echo $base; ?>newadmin/admin_ques/delete_single_ques/"+id,
		async:false,
		data: '',
		cache: false,
		success: function(msg)
		{
			if(msg=='1')
			{
				$('.check_university_'+id).hide();
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
		url: '<?php echo $base; ?>newadmin/admin_ques/approve_disapprove_ques/'+b+'/'+c,
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
			url: '<?php echo $base; ?>newadmin/admin_ques/featured_unfeatured_ques/'+b+'/'+c,
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
			url: "<?php echo $base; ?>newadmin/admin_ques/count_featured_ques/q_featured_home_que",
			async:false,
			data: '',
			cache: false,
			success: function(msg)
			{
				if(msg==1)
				{
					$.ajax({
						type: "POST",
						url: '<?php echo $base; ?>newadmin/admin_ques/featured_unfeatured_ques/'+b+'/'+c,
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
	
	if($("#univ_action option:selected").val()!='')
	{
		action=$("#univ_action option:selected").val();
	}
	if($("#del_action option:selected").val()!='')
	{
		action=$("#del_action option:selected").val();
	}
		
	if(action=='delete')
	{
		var atLeastOneIsChecked = $('.setchkval:checked').length > 0;
		if(atLeastOneIsChecked)
		{
			var r=confirm("Are you sure you want to delete selected questions");
			set_chkbox_val();			
			var data={'que_id':arr};

			if(r)
			{
				$.ajax({
					type:"post",
					url:'<?php echo $base ?>newadmin/admin_ques/delete_ques',
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
</body>
</html>