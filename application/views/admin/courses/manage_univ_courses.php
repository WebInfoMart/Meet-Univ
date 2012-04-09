<?php if($admin_user_level=='3') { ?>
<div id="content">	

<h2>DETAIL OF COURSES</h2>
			<form action="<?php echo $base ?>admincourses/delete_univ_courses" method="post" id="deleteform">	
			<table cellpadding="0" cellspacing="0" width="100%" class="sortable">
			
				<thead>
					<tr>
						<th ><input type="checkbox" class="check_all" ></th>
						<th class="header" style="cursor: pointer; ">Program Title</th>
						<th class="header" style="cursor: pointer; ">Education Level</th>
						<th class="header" style="cursor: pointer; ">Course Name</th>
						<th class="header" style="cursor: pointer; ">Area of Interest</th>
						<th></th>
					</tr>
				</thead>
				
				<tbody>
				<?php
				foreach($course_info as $row){
				?>
					<tr class="even">
					
						<td>
						<input type="checkbox" class="setchkval" value="" name="check_course_<?php echo $row->prog_id; ?>" id="check_course_<?php echo $row->prog_id; ?>">
						<input type="hidden" name="course_id[]" value="<?php echo $row->prog_id ?>" >
						</td>
						<!--<td><strong><a href="#"><?php // echo $row->id; ?></a></strong></td>-->
						<td>
						<?php echo ucwords($row->prog_title); ?>
						<td><?php echo ucwords($row->educ_level); ?></td>
						<td><a href="#"><?php echo ucwords($row->course_name); ?></a></td>
						<td >
					<?php echo $row->program_parent_name; ?>
						</td>
						<td>
			
      <ul class="nav">
          <li data-dropdown="dropdown" >  <a class="btn-primary button_cont" href="#"><i class="icon-course-univ icon-white"></i>COURSE</a>
		  <a class="btn btn-primary dropdown-toggle arrow_but" data-toggle="dropdown" href="#"></a>
            <ul class="dropdown-menu">
			<li><a href="#" onclick="delete_confirm('<?php echo $row->prog_id; ?>');" ><i class="icon-trash"></i> Delete</a></li>
			</ul>
          </li>
        </ul>
</td>		
</tr>
				
			<?php } ?>		
				</tbody>
				
			</table>
		<div class="tableactions" style="margin-top:10px;">
				<select name="univ_action" id="course_action">
					<option value="">Actions</option>
					<option value="delete">Delete</option>
				</select>
				
				<input type="button" onclick="action_formsubmit(0,0)" class="submit tiny" value="Apply to selected" />
			</div>		<!-- .tableactions ends -->
		
		
			<div id="pagination" class="table_pagination right paging-margin">
			
            <?php echo $this->pagination->create_links();?>
			
            </div> 		
			
		</form>
		</div>
<?php } else if($admin_user_level=='5') {?>	

<div id="content">	

<h2>DETAIL OF COURSES</h2>
			<form action="<?php echo $base ?>admincourses/delete_univ_courses" method="post" id="deleteform">
				<ul >
						<li>
						<div>
						<div class="float_l span3 margin_zero">
							<label>Choose University</label>
						</div>
						<div class="float_l span3">
							<select class="text styled span3 margin_zero" name="university" id="university" onchange="get_univ_course_detail();">
								<option value="">Please Select</option>
									<?php foreach($univ_info as $univ_detail) { ?>
										<option value="<?php echo $univ_detail->univ_id; ?>" ><?php echo $univ_detail->univ_name; ?></option>
										<?php } ?>
							</select>
		
						</div>
						<div class="clearfix"></div>
						</div>
					</li>
				</ul>	
				<div id="choose_univ" >
				
				</div>		
			</form>	
</div>
<?php } ?>	
<script>

function get_univ_course_detail()
{
var univ_id=$("#university option:selected").val();
$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admincourses/fetch_univ_course_ajax",
	   async:false,
	   data: 'university='+univ_id,
	   cache: false,
	   success: function(msg)
	   {
	  $('#choose_univ').html(msg);
	   }
});
}
function delete_confirm(progid)
{
var univid=$("#university option:selected").val();
$('#check_course_'+progid).attr('checked','checked')
var r=confirm("Are U sure u want to DELETE this Course?");
if(r)
{
window.location.href="<?php echo $base ?>"+'admincourses/delete_single_course_univ/'+progid+'/'+univid;
}
else 
{
$('#check_course_'+progid).removeAttr('checked');
}
}


function action_formsubmit(id,flag)
{
var action=$('#course_action').val();
if(action=='delete')
{
var atLeastOneIsChecked = $('.setchkval:checked').length > 0;
if(atLeastOneIsChecked)
{
var r=confirm("Are U sure u want to delete selected Courses");
if(r)
{
set_chkbox_val();
$('#deleteform').submit();
}
}
else
{
alert("please select al least one course for delete");
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
$(this).val('checked');
}
else
{
$(this).val('');
}
});
}


</script>		