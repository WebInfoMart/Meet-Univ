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
<h2>DETAIL OF PROMOCODES</h2>
	<div class="float_r">		
	</div>
	
			<form action="<?php echo $base ?>adminarticles/delete_articles" method="post" id="deletearticleform" >	
				<table cellpadding="0" cellspacing="0" width="100%" class="sortable">
					<thead>
						<tr>
							
							<th class="header" style="cursor: pointer; ">Promocode</th>
							<th class="header" style="cursor: pointer; ">Promo Email Pack</th>
							<th class="header" style="cursor: pointer; ">Discount</th>
							<th class="header" style="cursor: pointer; ">Discount On</th>
							<th class="header" style="cursor: pointer; ">Discount Type</th>
							<th class="header" style="cursor: pointer; ">Enabled</th>
							
							<!--<th class="header" style="cursor: pointer; ">Event's Place</th>-->
							<th></th>
						</tr>
					</thead>
					<tbody>							
						<?php 
				if(!empty($promocode))
				{
				foreach($promocode as $promo){
				?>
						<tr class="even">							
							<td><?php echo ucwords(substr($promo['promo_name'],0,50)); ?></td>
							<td><?php echo ucwords($promo['email_pack_name']); ?></td>
							<td><?php echo ucwords($promo['discount']); ?></td>
							<td><?php echo ucwords($promo['discount_on']); ?></td>
							<td><?php echo ucwords($promo['disc_type']); ?></td>
							<td><?php if($promo['en']==1){ echo 'Enabled';}else { echo 'Disabled';} ?></td>
							<td>
								<ul class="nav">
          <li data-dropdown="dropdown"><a class="btn-primary button_cont" href="#"><i class="icon-univ-event icon-white"></i>Promocode</a>
		  <a class="btn btn-primary dropdown-toggle arpromo_but" data-toggle="dropdown" href="#"></a>
            <ul class="dropdown-menu">
				<?php if($edit==1) { ?>
              <li><a href="#" onclick="enable(<?php echo $promo['promocode_id'].','.$promo['en'];?>)">
			  <i class="icon-pencil"></i> <?php if($promo['en']==1){ echo 'Disable'; } else { echo 'Enable'; } ?></a></li>
			  <?php } if($delete==1) { ?>
			 <li><a href="#" onclick="delete_confirm('<?php echo $promo['promocode_id']; ?>');" ><i class="icon-trash"></i> Delete</a></li>
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
function delete_confirm(id)
{
	var r=confirm("Are you sure you want to DELETE this Email Promo?");
	if(r)
	{
	window.location.href="<?php echo $base ?>"+'emailpacks/delete_promo/'+id;
	}
}
function enable(id,sts)
{
	var status;
	if(sts==1)
	{
		status='Disable';
	}
	else
	{
		status='Enable';
	}
	var r=confirm("Are you sure you want to "+status+" this Email Promo?");
	if(r)
	{
	window.location.href="<?php echo $base ?>"+'emailpacks/update_promo/'+id+'/'+sts;
	}
}
</script>	