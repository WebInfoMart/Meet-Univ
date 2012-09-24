<div id="content">	
<h2>Details Of Email Packs</h2>
<!--<input type="button" onclick="home()" class="submit tiny float_r" value="Reset" />-->	
<table cellpadding="0" cellspacing="0" width="100%" class="sortable">			
				<thead>
					<tr>
						
						<th class="header" style="cursor: pointer; ">Pack Title</th>
						<th class="header" style="cursor: pointer; ">( $ ) Pack Cost</th>
						<th class="header" style="cursor: pointer; ">Number of Emails</th>						
						<th class="header" style="cursor: pointer; ">Purchase</th>
						<th></th>
					</tr>
				</thead>
				
				<tbody>
				<?php 
				if(!empty($packs))
				{
				foreach($packs as $row){
				?>
					<tr class="even">
					
												
						<td>
						<?php echo ucwords(substr($row['email_pack_name'],0,50)); ?>
						</td>
						<td id="cost_<?php echo $row['email_pack_id'];?>"><?php echo ucwords($row['email_pack_cost']); ?></td>
						<td id="emails_<?php echo $row['email_pack_id'];?>"><?php echo ucwords($row['pack_contains_email']); ?></span></td>
						<td><input onclick="purchase(<?php echo $row['email_pack_id'];?>)" type="button" value="Purchase"</td>
						</tr>
			<?php } }else { echo "<tr><td>".'No Result Found!'."<td></tr>"; } ?>		
				</tbody>
				
			</table>			
</div>	
<script>
function purchase(id)
{
var cost=$("#cost_"+id).html();
var emails=$("#emails_"+id).html();
data={packid:id,emails:emails,cost:cost};
url='<?php echo $base; ?>emailpacks/purchase';
$.ajax({
	   type: "POST",
	   url: url,
	   async:false,
	   data: data,
	   success: function(msg)
	   {
	    if(msg=='1')
		{
			window.location.href="<?php echo $base;?>/emailpacks/user_email_packs";
		}
	   }
});
}
</script>	