<div id="ajax"/>
<div id="content">		
	<h2 class="margin">Create Email Pack</h2>	
	<div class="form span8">	
		<form name="packs" class="form_horizontal_data">
		<?php 
		foreach($pack as $row )
		{
		?>
			<div class="control-group1">
				<label class="control-label1" for="select01">Email Pack Name:</label>
				<div class="controls1">
					<input type="text" id="pack_name" value="<?php echo $row['email_pack_name'];?>"/>		
				</div>
			</div>
			<div class="control-group1">
				<label class="control-label1" for="select01">Email Pack Cost:</label>
				<div class="controls1">
					<input type="text" id="pack_cost" value="<?php echo $row['email_pack_cost'];?>"/>		
				</div>
			</div>
			<div class="control-group1">
				<label class="control-label1" for="select01">Number of Emails:</label>
				<div class="controls1">
					<input type="text" id="emails_in_pack" value="<?php echo $row['pack_contains_email'];?>"/>		
				</div>
			</div>
			<div class="control-group1">
				<label class="control-label1" for="select01">Enabled:</label>
				<div class="controls1">
					<select id="enable" >
						<option value="">Please Select</option>
						<option value="1" <?php if($row['enabled']==1)echo 'selected';?>>Enable</option>
						<option value="0" <?php if($row['enabled']==0)echo 'selected';?>>Disable</option>
					</select>		
				</div>
			</div>
			<div class="control-group1">
				<div class="controls1">
					<input type="button" onclick="editPack(<?php echo $row['email_pack_id'];?>)" class="submit" value="Edit">	
				</div>
			</div>	
<?php } ?>			
		</form>		
	</div>					
</div>
</div>
<script>
function editPack(id)
{
	var pack_name=$("#pack_name").val();
	var pack_cost=$("#pack_cost").val();
	var emails=$("#emails_in_pack").val();
	var enable=$('#enable option:selected').val();
	var data={pack_name:pack_name,pack_cost:pack_cost,emails:emails,enable:enable,ajax:'1'};
	url='<?php echo $base; ?>emailpacks/update_email_pack/'+id;
	$.ajax({
	   type: "POST",
	   url: url,
	   async:false,
	   data: data,
	   success: function(msg)
	   {
		if(msg)
		{
		window.location.href="<?php echo $base;?>emailpacks/manage_packs/edt";
		}
	   }
		});
}
</script>