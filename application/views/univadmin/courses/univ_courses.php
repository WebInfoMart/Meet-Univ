<div class="modal hide" id="delete">
	<div class="modal-header">		
		<div align="center"><h3>Course deleted successfully</h3></div>
	</div>
</div>
<div class="modal hide" id="sel_atl_one">
	<div class="modal-header">		
		<div align="center"><h3>Please select atleast one course</h3></div>
	</div>
</div>
<div class="modal hide" id="sel_act">
	<div class="modal-header">		
		<div align="center"><h3>Please select the course</h3></div>
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
	<div class="responsible_navi"></div>
      <div class="row-fluid">
        <div class="span12">
          <div class="page-header clearfix tabs">
            <h2>Courses</h2>
            <ul class="nav nav-pills">
              <li class='active'>
                <a href="#all" data-toggle="pill">All</a>
              </li>
              <li>
                <a href="#new" data-toggle="pill">New</a>
              </li>
			  <li id="active_menu">
                <a href="#create" data-toggle="pill" class="active_menu">Create Courses</a>
              </li>
            </ul>
          </div>
          <div class="content-box">
            <div class="tab-content">
              <div class="tab-pane active" id="all">
                <table class="table table-striped dataTable" id="media" >
                  <thead>
                    <tr>
                      <th><input type="checkbox" class='sel_rows' data-targettable="media"></th>
                      <th>Program Title</th>
                      <th>Education Level</th>
                      <th>Course Name</th>
					  <th>Area of Interest</th>
					  <th>Choose Option</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php			  
				  foreach($course_info as $row)
				  {  ?>
					<tr class="check_university_<?php echo $row->id; ?>">
                      <td><input type="checkbox" value="<?php echo $row->id;?>" name="check_course_<?php echo $row->id; ?>" id="check_course_<?php echo $row->id; ?>" class='selectable_checkbox setchkval'></td>
                      <td><?php echo ucwords($row->prog_title); ?></td>
                       <td><?php echo ucwords($row->educ_level); ?></td>
                       <td class="center"> <?php echo ucwords($row->course_name); ?></td>
					   <td class="center"> <?php echo $row->program_parent_name; ?></td>	
						<td class="center">
							<div class="btn-group">
								<?php  if($delete==1)   {?>
								<div class="modal hide" id="myModal_<?php echo $row->id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to delete?</h3>
									</div>
									<div class="modal-footer">
										<a href="#" onclick="delete_confirm('<?php echo $row->id; ?>')" class="btn" data-dismiss="modal">Yes</a>
										<a href="#" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>
								<a href="#myModal_<?php echo $row->id; ?>" class="btn btn-icon tip"  data-toggle="modal" data-original-title="Delete">
									<i class="icon-trash"></i>
								</a>
								<?php }	  ?>
							
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
              <div class="tab-pane" id="new">
				 <table class="table table-striped dataTable" id="media1" >
                  <thead>
                    <tr>
                      <th><input type="checkbox" class='sel_rows' data-targettable="media1"> </th>
                      <th>Program Title</th>
                      <th>Education Level</th>
                      <th>Course Name</th>
					  <th>Area of Interest</th>
					  <th>Choose Option</th>
                    </tr>
                  </thead>
                 <tbody>
				  <?php				  
				  foreach($course_latest as $row)
				  {  ?>
					<tr class="check_university_<?php echo $row->id; ?>">
                      <td><input type="checkbox" value="<?php echo $row->id;?>" name="check_course_<?php echo $row->id; ?>" id="check_course_<?php echo $row->id; ?>" class='selectable_checkbox setchkval'></td>
                      <td><?php echo ucwords($row->prog_title); ?></td>
                       <td><?php echo ucwords($row->educ_level); ?></td>
                       <td class="center"> <?php echo ucwords($row->course_name); ?></td>
					   <td class="center"> <?php echo $row->program_parent_name; ?></td>	
						<td class="center">
							<div class="btn-group">
								<?php  if($delete==1)   {?>
								<div class="modal hide" id="myModal_<?php echo $row->id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to delete?</h3>
									</div>
									<div class="modal-footer">
										<a href="#" onclick="delete_confirm('<?php echo $row->id; ?>')" class="btn" data-dismiss="modal">Yes</a>
										<a href="#" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>
								<a href="#myModal_<?php echo $row->id; ?>" class="btn btn-icon tip"  data-toggle="modal" data-original-title="Delete">
									<i class="icon-trash"></i>
								</a>
								<?php }	  ?>
							
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
				</div>
		<?php  } ?>
              </div>
			  <div class="tab-pane" id="create">
				<div class="row-fluid">
					<div class="span9">
						<form class="form-horizontal" onsubmit="return createCourse(this);">
							<fieldset>
								<div class="control-group">
								<label class="control-label" for="input01">Title</label>
								<div class="controls">
									<input type="text" class="input-xlarge" id="title" name="title">
								</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="input04">News Logo</label>
									<div class="controls">
										<input type="file" class="input-xlarge" id="input04">
									</div>
								</div>
								<div class="control-group">
								<label class="control-label" for="input07">Detail</label>
								<div class="controls">
									<textarea name="text" id="detail" name="detail" class='span12' rows='8'></textarea>
								</div>
								</div>
								<div class="form-actions">
								<button type="submit" class='btn btn-primary'>Create</button>								
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
    </div>
</div>
<script>
function cancel()							//added by satbir 12/14/2012
{
	$("#title").val('');
	$("#title").removeClass('needsfilled');
	$("#detail").val('');
	$("#detail").removeClass('needsfilled');	
}
function createCourse()
{
	var valid=true;	
	if($("#title").val()=='')
	{
		$("#title").addClass('needsfilled');
		valid=false;		
	}
	else
	{
		$("#title").removeClass('needsfilled');
	}
	if($("#detail").val()=='')
	{
		$("#detail").addClass('needsfilled');	
		valid=false;
	}
	else
	{
		$("#detail").removeClass('needsfilled');
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
function delete_confirm(id)
{
	$.ajax({	
	 type: "POST",
	   url: "<?php echo $base; ?>newadmin/admin_courses/delete_single_course_univ/"+id,
	   async:false,
	   data: '',
	   cache: false,
	   success: function(msg)
	   {
	    if(msg=='1')
		{
			$('.check_university_'+id).hide();
			$('.check_university1_'+id).hide();
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
			var data={'course_id':arr};
			if(r)
			{
				$.ajax({
					type:"post",
					url:'<?php echo $base ?>newadmin/admin_courses/delete_univ_courses',
					async:false,
					data: data,
					cache: false,
					success: function(msg)
					{	
						if(msg==1)
						{
							$('.toremove').hide();
							$("#delete").show();
							$("#delete").delay(5000).fadeOut("slow");
						}
						else
						{
							$('#denied').show();
							setTimeout(function(){$('#denied').fadeOut('slow');},3000);	
						}
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