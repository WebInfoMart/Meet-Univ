<div id="search_manage">
<script type="text/javascript" src="<?php echo "$base$js";?>/custom.js"></script>
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
if($univ_name==''){ $univ_name=0;}
if($sel_id==''){ $sel_id=0;}
if($search_box==''){ $search_box=0;}
?>

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
				if($univ_info_search!='0')
				{
				foreach($univ_info_search as $row){
				?>
					<tr class="even">
					
						<td>
						<input type="checkbox" class="setchkval" value="" name="check_university_<?php echo $row->univ_id; ?>" id="check_university_<?php echo $row->univ_id; ?>">
						<input type="hidden" name="univ_id[]" value="<?php echo $row->univ_id ?>" >
						</td>
						<!--<td><strong><a href="#"><?php // echo $row->id; ?></a></strong></td>-->
						<td>
						<?php	
						$image_exist=0;
						$univ_img = $row->univ_logo_path;	
						    if(file_exists(getcwd().'/uploads/univ_gallery/'.$univ_img) && $univ_img!='')	
							{ $image_exist=1; }?>
						<img src="<?php echo $base ?>uploads/univ_gallery/<?php if($row->univ_logo_path=='' || $image_exist!=1){ echo "univ_logo.png" ;} else { echo $row->univ_logo_path;} ?>" class="univ_logo_size">
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
				<?php }if($admin_user_level==5) {?>
				<li><a href="javascript:void(0);" onclick="featured_home_confirm('<?php echo "$base$admin";?>','<?php  echo $row->featured_college; ?>','<?php echo $row->univ_id; ?>');" ><i class="icon-view"></i> <?php  if($row->featured_college=='1'){?> Make Home Unfeatured <?php } else {?> Make Home Featured <?php } ?></a></li>
			
				<?php } ?>
				<li><a target="_blank" href="<?php echo 'http://'.$row->subdomain_name.$domain_name; ?>"><i class="icon-view" ></i> Front View</a></li>
				</ul>
          </li>
        </ul>
</td>		
</tr>
				
			<?php } } 
			else
			{ ?>
				<tr>
				<td> No Result found </td>
				</tr>
				<?php
			}
			?>		
				</tbody>
				
</table>
</div>
<script>
$(function() {   
      $("#pagination a").click(function() {	
        var url = $(this).attr("href");
        var univ_name='<?php echo $univ_name; ?>';
		var search_box='<?php echo $search_box; ?>';
		var sel_id='<?php echo $sel_id; ?>';	
        $.ajax({
          type:"POST",
          data:"univ_name="+univ_name+"&search_box="+search_box+"&sel_id="+sel_id+"&ajax=1",
          url: url,        
		  beforeSend: function() {
   		  $("#ajax_load").css("opacity","0.5");
          },
          success: function(msg) {
			 $("#ajax_load").css("opacity","1");
		    $("#search_manage").html(msg);          
          }
        });
        return false;
      });    
  });
</script>