<script type="text/javascript">
jQuery(document).ready(function(){			 
	 jQuery("#drop").change(function()
		{  
			 var e = document.getElementById("drop");
			 var dataString = e.options[e.selectedIndex].value
			 if(dataString==1 || dataString==2)
				{							  
				  $("#name").show();
				  $("#search").show();
				}	
				if(dataString==3)
				{
				  $("#name").hide();							
				  $("#search").hide();
				  var banned='1';
						var url='<?php echo $base;?>admin/manageusers';
						$.ajax({
							  type: "POST",
							  data: "banned="+banned+"&ajax=1",
							  url: url,
							  beforeSend: function() {
								 $("#ajax_load").css("opacity","0.5");
							   },
							  success: function(msg) {
							  //alert(msg);
								$("#ajax_load").html(msg);    
								$("#ajax_load").css("opacity","1");								
							  }
							});
				}								
		});
});
function search()
{	
	var toSearch=$("#name").val();
	var url='<?php echo $base;?>admin/manageusers';
	$.ajax({
          type: "POST",
          data: "toSearch="+toSearch+"&ajax=1",
          url: url,
          beforeSend: function() {
		   $("#ajax_load").css("opacity","0.5");
           // $("#ajax_load").html("");
          },
          success: function(msg) {
		  //alert(msg);
            $("#ajax_load").html(msg); 
			$("#ajax_load").css("opacity","1");			
          }
        });
	
}
</script>
<div id="ajax_load">
<div id="content">	
	<h2>DETAIL OF USERS</h2>
	<div class="float_r">
	<input type="button" onclick="fetch(0)" class="submit tiny" value="Reset" />
</div>
	<div style="margin-left: 15px; font-size: 20px; margin-top: 15px;">
	<span >Filter</span>
	<select id="drop" name="drop" >
	<option>Select to Search</option>
	<option value="1">Name</option>														
	<option value="2">Email Id</option>
	<option value="3">Ban</option>
	</select>
	<input id="name"  style="height: 30px;margin-left: 10px;margin-top: 4px;display:none;" type="text" name="fullname" />
	<input type="button" id="search" style="margin-top: 4px;display:none;"  value="search" onclick="search()" />
	</div>
<div class="margin_t">

<?php 
$user_can_delete=0;
if($level==''){ $level=0;}
$no_of_admin=0;
$no_of_university_admin=0;
$no_of_counsellor=0;
$no_of_telecallers=0;
$no_of_student=0;
 foreach($no_of_users as $no_of_user){
if($no_of_user['level']=='4')
{
$no_of_admin++;
}
if($no_of_user['level']=='3')
{
$no_of_university_admin++;
}
if($no_of_user['level']=='2')
{
$no_of_counsellor++;
}
if($no_of_user['level']=='1')
{
$no_of_student++;
}
if($no_of_user['level']=='6')
{
$no_of_telecallers++;
}
}
?>
<div class="float_r">
<ul>
<li onclick="fetch('4')" style="cursor:pointer;" class="small_size">Admin<span class="badge badge-info"><?php echo $no_of_admin;?></span> </li>
<li  onclick="fetch('3')" style="cursor:pointer;" class="small_size">University Admin<span class="badge"><?php echo $no_of_university_admin;?></span> </li>
<li onclick="fetch('2')" style="cursor:pointer;" class="small_size">Counsellor<span class="badge badge-warning"><?php echo $no_of_counsellor; ?></span></li>
<li onclick="fetch('6')" style="cursor:pointer;" class="small_size">Telecallers<span class="badge badge-warning"><?php echo $no_of_telecallers; ?></span></li>
<li onclick="fetch('1')" style="cursor:pointer;" class="small_size">Student<span class="badge badge-success"><?php echo $no_of_student;?></span></li>
</ul>
</div>
<div class="clearfix"></div>
</div>

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
				if($user_detail!='0')
				{
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
if($row->univ_name!='')
{
$univ_name=$row->univ_name;
}
else
{
$univ_name='No University Assigned Yet';
}
echo "University Admin<br />(".$univ_name.")";
}
else if($row->level=='4')
{
echo "Admin";
}
else if($row->level=='6')
{
echo "Telecaller";
}

 ?>
						</td>
						<td>
<?php 

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
          <li data-dropdown="dropdown" >  <a class="btn-primary button_cont" href="#"><i class="icon-user icon-white"></i>User</a>
		  <a class="btn btn-primary dropdown-toggle arrow_but" data-toggle="dropdown" href="#"></a>
            <ul class="dropdown-menu">
			 <li><a href="<?php echo "$base$admin"; ?>/user_detail/<?php echo $row->id; ?>/<?php echo $row->level; ?>">
			 <i class="icon-view" ></i> View</a></li>
              <li><a href="<?php echo "$base$admin"; ?>/update-<?php echo $row->id; ?>-user-<?php echo $row->level; ?>">
			  <i class="icon-pencil"></i> Edit</a></li>
			 <li><a href="#" onclick="ban_confirm('<?php  echo "$base$admin";?>','<?php  echo $row->banned; ?>','<?php echo $row->id; ?>','<?php echo $row->level; ?>');">
			 
			 
			 <i class="<?php if($row->banned=='1'){ echo "icon-unban-circle"; } else { echo "icon-ban-circle"; }?>"></i>
			 <?php if($row->banned=='1'){?> Unban<?php } else {?> Ban <?php } ?></a></li>	
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
}
else
{
	echo 'no record found';
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
$('#check_user_'+userid).removeAttr('checked');
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

$(function() {
    //applyPagination();

    //function applyPagination() {
      $("#pagination a").click(function() {
        var url = $(this).attr("href");
		var level='<?php echo $level; ?>';
		var toSearch='<?php echo $toSearch; ?>';
		var banned='<?php echo $banned; ?>';
		//alert(level);
        $.ajax({
          type: "POST",
          data: "level="+level+"&toSearch="+toSearch+"&banned="+banned+"&ajax=1",
          url: url,
          beforeSend: function() {
		  $("#ajax_load").css("opacity","0.5");
            //$("#ajax_load").html("");
          },
          success: function(msg) {
		  //alert(msg);
		  $("#ajax_load").css("opacity","1");
            $("#ajax_load").html(msg);
            //applyPagination();
          }
        });
        return false;
      });
    //}
  });
function fetch(level)
{
	//alert(level);
	 //var data={level :level,ajax:'1'};
	//alert(data);
	var url='<?php echo $base;?>admin/manageusers';
	$.ajax({
          type: "POST",
          data: "level="+level+"&ajax=1",
          url: url,
          beforeSend: function() {
		  $("#ajax_load").css("opacity","0.5");
           // $("#ajax_load").html("");
          },
          success: function(msg) {
		  //alert(msg);
		  $("#ajax_load").css("opacity","1");
            $("#ajax_load").html(msg);           
          }
        });
}
</script>		