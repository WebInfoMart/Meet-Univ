<div id="content">	
<h2>DETAIL OF USERS</h2>

			<form action="<?php echo $base ?>admin/deleteuser" method="post" id="deleteform">	
			<table cellpadding="0" cellspacing="0" width="100%" class="sortable">
			
				<thead>
					<tr>
						<th ><input type="checkbox" class="check_all" ></th>
					<!--	<th class="header" style="cursor: pointer; ">ID</th>-->
						<th class="header" style="cursor: pointer; ">FULLNAME</th>
					<!--	<th class="header" style="cursor: pointer; ">USERNAME</th>-->
						<th class="header" style="cursor: pointer; ">EMAIL</th>
						<th class="header" style="cursor: pointer; ">USER TYPE</th>
						<th class="header" style="cursor: pointer; ">MANAGE USER</th>
						<th></th>
					</tr>
				</thead>
				
				<tbody>
				<?php
foreach($user_detail as $row){
if($row->level!='5' && $row->level!='' && $row->level!='0'){
?>
					<tr class="even">
						<td><input type="checkbox" class="setchkval" value="" name="check_users_<?php echo $row->id; ?>" id="check_user_<?php echo $row->id; ?>">
						<input type="hidden" name="users_id[]" value="<?php echo $row->id ?>" >
						<input type="hidden" name="users_level[]" value="<?php echo $row->level ?>" >
						
						</td>
						
						<!--<td><strong><a href="#"><?php // echo $row->id; ?></a></strong></td>-->
						<td><?php echo $row->fullname; ?>
				
						</td>
						<!--<td><?php //echo $row->username; ?></td>-->
						<td><a href="#"><?php echo $row->email; ?></a></td>
						<td >
						<?php if($row->level=='1' )
{
echo "Student";
}
else if($row->level=='2')
{
echo "Counsellor";
}
else if($row->level=='3')
{
echo "University Admin";
}
else if($row->level=='4')
{
echo "Admin";
}

 ?>
						</td>
						<td>
<?php 
$user_can_delete=0;
$user_can_edit=0;
if($admin_user_level=='5' || $admin_user_level=='4') {
$user_edit_op=array('3','6','7','10');
$user_delete_op=array('5','7','8','10');

foreach ($admin_priv as $admin_priv_res){ 
if($admin_priv_res['privilege_type_id']=='1' && in_array($admin_priv_res['privilege_level'],$user_edit_op))
{
$user_can_edit=1;
?>	
      <ul class="nav">
          <li data-dropdown="dropdown" >  <a class="btn-primary button_cont" href="#"><i class="icon-user icon-white"></i> <?php echo $row->fullname; ?></a>
		  <a class="btn btn-primary dropdown-toggle arrow_but" data-toggle="dropdown" href="#"></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo "$base$admin"; ?>/edituser/<?php echo $row->id; ?>/<?php echo $row->level; ?>"><i class="icon-pencil"></i> Edit</a></li>
			 <li><a href="#" onclick="ban_confirm('<?php  echo "$base$admin";?>','<?php  echo $row->banned; ?>','<?php echo $row->id; ?>','<?php echo $row->level; ?>');"><i class="icon-ban-circle"></i><?php if($row->banned=='1'){?> Unban<?php } else {?> Ban <?php } ?></a></li>	
			 <?php } 
			  if($admin_priv_res['privilege_type_id']=='1' && in_array($admin_priv_res['privilege_level'],$user_delete_op))
				{
				//var for check that user can delete
				$user_can_delete=1;
				?>
			  <li><a href="#" onclick="delete_confirm('<?php echo $row->id; ?>','<?php echo $row->level; ?>');" ><i class="icon-trash"></i> Delete</a></li>
				<?php }?>
				
			<?php	} }?>
				</ul>
          </li>
        </ul>
</td>		
</tr>
<?php
}
}
?>					
					
				</tbody>
				
			</table>
		<?php if($user_can_delete==1)
			{ ?>
			<div class="tableactions">
				<select name="user_action" id="user_action">
					<option value="">Actions</option>
					<option value="delete">Delete</option>
				</select>
				
				<input type="button" onclick="action_formsubmit(0,0)" class="submit tiny" value="Apply to selected" />
			</div>		<!-- .tableactions ends -->
		<?php } ?>	
			<div id="pagination" class="table_pagination right paging-margin">
            <?php echo $this->pagination->create_links();?>
            </div> 		
			
		</form>
		</div>
		
<script>
function delete_confirm(userid,level)
{
$('#check_user_'+userid).attr('checked','checked')
var r=confirm("Are U sure u want to delete this user?");
if(r)
{
window.location.href="<?php echo $base ?>"+'admin/delete_single_user/'+userid+'/'+level;
}
else
{
$('#check_user_'+id).removeAttr('checked');
}
}

function ban_confirm(a,b,c,d)
{
if(b==0)
{
status='ban';
}
if(b==1)
{
status='unban';
}
var r=confirm("Are U sure u want to " +status+ " this user?");
if (r==true)
  {
  window.location.href=a+'/ban_unban_user/'+b+'/'+c+'/'+d;
  }
}

function action_formsubmit(id,flag)
{
var action=$('#user_action').val();
if(action=='delete')
{
var atLeastOneIsChecked = $('.setchkval:checked').length > 0;
if(atLeastOneIsChecked)
{
var r=confirm("Are U sure u want to delete this user?");
if(r)
{
set_chkbox_val();
$('#deleteform').submit();
}
}
else
{
alert("please select al least one user");
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