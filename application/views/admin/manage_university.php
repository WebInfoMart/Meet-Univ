<?php 
$edit=0;
$delete=0;
$view=0;
$univ_edit_op=array('3','6','7','10');
$univ_delete_op=array('5','7','8','10');
foreach ($admin_priv as $admin_priv_res){ 
if($admin_priv_res['privilege_type_id']=='5' && $admin_priv_res['privilege_level']!=0)
{
$view=1;
if(in_array($admin_priv_res['privilege_level'],$univ_edit_op))
{
$edit=1;
}
if(in_array($admin_priv_res['privilege_level'],$univ_delete_op))
{
$delete=1;
}
}
}
?>

<div id="content">	

<h2>DETAIL OF UNIVERSITY</h2>
			<div id="search_university" style="width: 425px;"> 
			<div class="float_l"><input type="text" name="txt_search_univ" id="txt_search_univ" style="width: 331px;height: 29px;margin-left: 11px;"/></div>
			<div class="float_r"><input type="button" class="btn btn-primary" value="Search" name="btnUnivSearch" id="btnUnivSearch" onclick="search_university();"></div> 
			 <div class="clearfix"></div>
			 </div> 
			
			<form action="<?php echo $base ?>admin/delete_universities" method="post" id="deleteform">	
			<div id="content_search">
			<div id="pagination" class="table_pagination right paging-margin">
			
            <?php echo $this->pagination->create_links();?>
			</div>
			<table cellpadding="0" cellspacing="0" width="100%" class="sortable">
			
			
           <thead>
					<tr>
						<th ><input type="checkbox" class="check_all" ></th>
					<!--	<th class="header" style="cursor: pointer; ">ID</th>-->
						<th class="header" style="cursor: pointer; ">University Logo</th>
					<!--	<th class="header" style="cursor: pointer; ">USERNAME</th>-->
						<th class="header" style="cursor: pointer; ">University Name</th>
						<th class="header" style="cursor: pointer; ">University Admin</th>
						<th class="header" style="cursor: pointer; ">University Country</th>
						<th></th>
					</tr>
		</thead>
				
				<tbody>
				<?php
				foreach($univ_info as $row){
				?>
					<tr class="even">
					
						<td>
						<input type="checkbox" class="setchkval" value="" name="check_university_<?php echo $row->univ_id; ?>" id="check_university_<?php echo $row->univ_id; ?>">
						<input type="hidden" name="univ_id[]" value="<?php echo $row->univ_id ?>" >
						</td>
						<!--<td><strong><a href="#"><?php // echo $row->id; ?></a></strong></td>-->
						<td>
						
						<img src="<?php echo $base ?>uploads/univ_gallery/<?php if($row->univ_logo_path==''){ echo "univ_logo.png" ;} else { echo $row->univ_logo_path;} ?>" class="univ_logo_size">
						</td>
						<td><?php echo ucwords($row->univ_name); ?></td>
						<td><a href="#"><?php if($row->fullname==''){ echo "Not assigned Yet";}else{ echo ucwords($row->fullname);} ?></a></td>
						<td >
					<?php echo $row->country_name; ?>
						</td>
						<td>
			
      <ul class="nav">
          <li data-dropdown="dropdown" >  <a class="btn-primary button_cont" href="#"><i class="icon-univ icon-white"></i>University</a>
		  <a class="btn btn-primary dropdown-toggle arrow_but" data-toggle="dropdown" href="#"></a>
            <ul class="dropdown-menu">
			<?php if($view==1) { ?>
              <li><a href="<?php echo "$base$admin"; ?>/univ_detail/<?php echo $row->univ_id; ?>"><i class="icon-view" ></i> View</a></li>
			<?php } if($edit==1) { ?>
              <li><a href="<?php echo "$base$admin"; ?>/update_university/<?php echo $row->univ_id; ?>">
			  <i class="icon-pencil"></i> Edit</a></li>
			  <?php } if($edit==1 || $delete==1) { ?>
			 <li><a href="#" onclick="ban_confirm('<?php echo "$base$admin";?>','<?php  echo $row->switch_off_univ; ?>','<?php echo $row->univ_id; ?>');"><i class="<?php if($row->switch_off_univ=='1'){ echo "icon-unban-circle"; } else { echo "icon-ban-circle"; }?>"></i><?php  if($row->switch_off_univ=='1'){?> Unban<?php } else {?> Ban <?php } ?></a></li>	
			<?php }	 if($delete==1) { ?>
			 <li><a href="#" onclick="delete_confirm('<?php echo $row->univ_id; ?>');" ><i class="icon-trash"></i> Delete</a></li>
				<?php }
				if($admin_user_level==5) {?>
				<li><a href="javascript:void(0);" onclick="featured_home_confirm('<?php echo "$base$admin";?>','<?php  echo $row->featured_college; ?>','<?php echo $row->univ_id; ?>');" ><i class="icon-view"></i> <?php  if($row->featured_college=='1'){?> Make Home Unfeatured <?php } else {?> Make Home Featured <?php } ?></a></li>
			
				<?php } ?>
				
				
			<?php	//} }?>
				</ul>
          </li>
        </ul>
</td>		
</tr>
				
			<?php } ?>		
				</tbody>
			
			</table>
			<div id="pagination" class="table_pagination right paging-margin">
			
            <?php echo $this->pagination->create_links();?>
			</div>
			</div>
		<?php if($delete==1) { ?> 	
			<div class="tableactions" style="margin-top:40px;">
				<select name="univ_action" id="univ_action">
					<option value="">Actions</option>
					<option value="delete">Delete</option>
				</select>
				
				<input type="button" onclick="action_formsubmit(0,0)" class="submit tiny" value="Apply to selected" />
			</div>		<!-- .tableactions ends -->
		<?php  } ?>	
		
				
			
		</form>
		</div>
		
<script>
function search_university()
{
	var search_box_val = $('#txt_search_univ').val();
	
	var search_url = "<?php echo $base; ?>admin/ManageUniversitySearch";
	//var search_url = "/index.php/control_form/get_selected_member/" + selected_member_id;
	if(search_box_val != '' || search_box_val != null) 
	{
	$.ajax({
    type: "POST",
    url: search_url,
	data:'univ_name='+search_box_val,
    success: function(response)
    {
		$('#content_search').html(response);
    }
});
}
}
function delete_confirm(univid)
{
$('#check_university_'+univid).attr('checked','checked')
var r=confirm("Are U sure u want to DELETE ALL RECORD this University?");
if(r)
{
window.location.href="<?php echo $base ?>"+'admin/delete_single_university/'+univid;
}
else
{
$('#check_university_'+univid).removeAttr('checked');
}
}
function ban_confirm(a,b,c)
{
var status;
if(b==0)
{
status='ban';
}
if(b==1)
{
status='unban';
}
var r=confirm("Are U sure u want to " +status+ " this university?");
if (r==true)
  {
  window.location.href=a+'/ban_unban_university/'+b+'/'+c;
  }
}

function action_formsubmit(id,flag)
{
var action=$('#univ_action').val();
if(action=='delete')
{
var atLeastOneIsChecked = $('.setchkval:checked').length > 0;
if(atLeastOneIsChecked)
{
var r=confirm("Are U sure u want to delete all the recoeds of selected university");
if(r)
{
set_chkbox_val();
$('#deleteform').submit();
}
}
else
{
alert("please select al least one university");
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
function featured_home_confirm(a,b,c)
{
var status;
if(b==0)
{
status='make home featured';
}
if(b==1)
{
status='make home unfeatured';
}
var r=confirm("Are U sure u want to " +status+ " to this university?");
if (r==true)
{
  window.location.href=a+'/featured_unfeatured_university/'+b+'/'+c+'/';
}
}

</script>		