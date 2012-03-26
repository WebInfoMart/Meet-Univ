<div id="content">	
<h2>DETAIL OF USERS</h2>
  <div class="pull-leftt btn-group">
        <ul class="nav">
          <li data-dropdown="dropdown" >  <a class="btn-primary button_cont" href="#"><i class="icon-user icon-white"></i> User</a>
		  <a class="btn btn-primary dropdown-toggle arrow_but" data-toggle="dropdown" href="#"></a>
            <ul class="dropdown-menu">
              <li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
				<li><a href="#"><i class="icon-trash"></i> Delete</a></li>
				<li><a href="#"><i class="icon-ban-circle"></i> Ban</a></li>
				<li class="divider"></li>
				<li><a href="#"><i class="i"></i> Make admin</a></li>
            </ul>
          </li>
        </ul>
      </div>
	  
	 
			<form action="" method="post">	
			<table cellpadding="0" cellspacing="0" width="100%" class="sortable">
			
				<thead>
					<tr>
						<!--<th width="10"><input type="checkbox" class="check_all"></th>-->
						<th class="header" style="cursor: pointer; ">ID</th>
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
						<!--<td><input type="checkbox"></td>-->
						<td><strong><a href="#"><?php echo $row->id; ?></a></strong></td>
						<td><?php echo $row->fullname; ?></td>
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
<?php if($admin_user_level=='5' || $admin_user_level=='4') {
$user_edit_op=array('3','6','7','10');
$user_delete_op=array('5','7','8','10');
foreach ($admin_priv as $admin_priv_res){ 
if($admin_priv_res['privilege_type_id']=='1' && in_array($admin_priv_res['privilege_level'],$user_edit_op))
{?>					
<a href="<?php echo "$base$admin"; ?>/edituser/<?php echo $row->id; ?>/<?php echo $row->level; ?>"><img src="<?php echo "$base$admin_img" ?>/b_edit.png" alt="EDIT" title="edit" /></a></a>
<?php 

}
if($admin_priv_res['privilege_type_id']=='1' && in_array($admin_priv_res['privilege_level'],$user_delete_op))
{

?>
<a href="#" style="margin-left:40px;" onclick="delete_confirm('<?php  echo "$base$admin";?>','<?php  echo $row->level; ?>','<?php echo $row->id; ?>');" ><img src="<?php echo "$base$admin_img" ?>/close.png" alt="Delete" title="Delete" /></a>
	
<?php }}
} ?>
</td>		
</tr>
<?php
}
}
?>					
					
				</tbody>
				
			</table>
			
			
			
			<!--<div class="tableactions">
				<select>
					<option>Actions</option>
					<option>Delete</option>
					<option>Edit</option>
				</select>
				
				<input type="submit" class="submit tiny" value="Apply to selected">
			</div>-->		<!-- .tableactions ends -->
			
			
			<!--<div class="table_pagination right">
				<a href="#">«</a>
				<a href="#" class="active">1</a>
				<a href="#">2</a>
				<a href="#">3</a>
				<a href="#">4</a>
				<a href="#">5</a>
				<a href="#">6</a>
				<a href="#">»</a>
			</div>-->		<!-- .pagination ends -->
						
		</form>
		</div>
<script>
function delete_confirm(adminbase,userlevel,userid)
{
var r=confirm("Are U sure u want to delete this user?");
if (r==true)
  {
  window.location.href=adminbase+'/deleteuser/'+userlevel+'/'+userid;
  }

}

</script>
