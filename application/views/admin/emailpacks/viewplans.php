<div id="content">
<input type="button" onclick="window.location.href='<?php echo $base; ?>emailpacks/user_email_packs'" class="submit tiny float_r" value="View Your Plans" />
	
	<?php 
	if(!empty($packs))
	{
	foreach($packs as $row){
	?>	
	<div class="blue_div">
		<div class="blue_holder">
			<div class="plan_padding">
			<div class="plan_heading"><?php echo ucwords(substr($row['email_pack_name'],0,50)); ?></div></br/>
			<div class="price_txt">$
			<div id="cost_<?php echo $row['email_pack_id'];?>" class="inline"><?php echo ucwords($row['email_pack_cost']); ?></div>
			</div>
			</div>
			<div class="plan_text"><div id="emails_<?php echo $row['email_pack_id'];?>" class="inline"> <?php echo ucwords($row['pack_contains_email']); ?>  </div><span class="inline"> &nbsp; Emails </span></div>
			<button onclick="purchase(<?php echo $row['email_pack_id'];?>)" class="plan_btn">Purchase</button>
		</div>
	</div>
	<?php } }else { echo "<tr><td>".'No Result Found!'."<td></tr>"; } ?>

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
