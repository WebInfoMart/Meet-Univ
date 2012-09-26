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
<h2>DETAIL OF EMAIL PACKS</h2>
	<div class="float_r">
		<input type="button" onclick="home()" class="submit tiny" value="Reset" />
	</div>
	
			<form action="<?php echo $base ?>adminarticles/delete_articles" method="post" id="deletearticleform" >	
				<table cellpadding="0" cellspacing="0" width="100%" class="sortable">
					<thead>
						<tr>
							
							<th class="header" style="cursor: pointer; ">Pack Name</th>
							<th class="header" style="cursor: pointer; ">( $ )Pack Cost</th>
							<th class="header" style="cursor: pointer; ">Number of emails</th>
							<th class="header" style="cursor: pointer; ">Enabled</th>
							
							<!--<th class="header" style="cursor: pointer; ">Event's Place</th>-->
							<th></th>
						</tr>
					</thead>
					<tbody>							
						<?php 
				if(!empty($email_packs))
				{
				foreach($email_packs as $row){
				?>
						<tr class="even">							
							<td><?php echo ucwords(substr($row['email_pack_name'],0,50)); ?></td>
							<td><?php echo ucwords($row['email_pack_cost']); ?></td>
							<td><?php echo ucwords($row['pack_contains_email']); ?></td>
							<td><?php if($row['enabled']==1){ echo 'Enabled';}else { echo 'Disabled';} ?></td>
							<td>
								<ul class="nav">
          <li data-dropdown="dropdown"><a class="btn-primary button_cont" href="#"><i class="icon-univ-event icon-white"></i>Email Packs</a>
		  <a class="btn btn-primary dropdown-toggle arrow_but" data-toggle="dropdown" href="#"></a>
            <ul class="dropdown-menu">
				<?php if($edit==1) { ?>
              <li><a href="<?php echo "$base"; ?>emailpacks/update_email_pack/<?php echo $row['email_pack_id']; ?>">
			  <i class="icon-pencil"></i> Edit</a></li>
			  <?php } if($delete==1) { ?>
			 <li><a href="#" onclick="delete_confirm('<?php echo $row['email_pack_id']; ?>');" ><i class="icon-trash"></i> Delete</a></li>
				<?php }
				?>
			</ul>
          </li>
        </ul>
		</td>
		</tr>
		<?php } }else { echo "<tr><td>".'No Result Found!'."<td></tr>"; } ?>	
		</tbody>
		</table>
			</form>
</div>	
<script>
function home()
{	
	var search_url = "<?php echo $base; ?>emailpacks/manage_packs";
	$.ajax({
    type: "POST",
    url: search_url,
	data:"ajax=1",	
      success: function(msg) {		  
            $("#ajax_load").html(msg);           
          }
	});
}
function delete_confirm(id)
{
var r=confirm("Are you sure you want to DELETE this Email Pack?");
if(r)
{
window.location.href="<?php echo $base ?>"+'emailpacks/delete_pack/'+id;
}
}
</script>	