<div id="content">		
	<h2 class="margin">Create Email Pack</h2>	
	<div class="form span8">	
		<form name="packs" class="form_horizontal_data">
			<div class="control-group1">
				<label class="control-label1" for="select01">Email Pack Name:</label>
				<div class="controls1">
					<input  type="text" id="pack_name" value=""/>		
				</div>
			</div>
			<div class="control-group1">
				<label class="control-label1" for="select01">Email Pack Cost:</label>
				<div class="controls1">
					<input type="text" id="pack_cost" value=""/>		
				</div>
			</div>
			<div class="control-group1">
				<label class="control-label1" for="select01">Number of Emails:</label>
				<div class="controls1">
					<input type="text" id="emails_in_pack" value=""/>		
				</div>
			</div>
			<div class="control-group1">
				<label class="control-label1" for="select01">Enabled:</label>
				<div class="controls1">
					<select id="enable" >
						<option value="">Please Select</option>
						<option value="1">Enable</option>
						<option value="0">Disable</option>
					</select>		
				</div>
			</div>
			<div class="control-group1">
				<div class="controls1">
					<input type="button" onclick="createPack()" class="submit" value="Add news">	
				</div>
			</div>									
		</form>		
	</div>					
</div>
<script>
function createPack()
{
	if($("#pack_name").val()=='')
	{
		$("#pack_name").addClass('needsfilled');		
	}
	if($("#pack_cost").val()=='')
	{
		$("#pack_cost").addClass('needsfilled');		
	}
	if($("#emails_in_pack").val()=='')
	{
		$("#emails_in_pack").addClass('needsfilled');		
	}	
	if($("#pack_name").val()!='' && $("#pack_cost").val()!='' && $("#emails_in_pack").val()!='')
	{
	var pack_name=$("#pack_name").val();
	var pack_cost=$("#pack_cost").val();
	var emails=$("#emails_in_pack").val();
	var enable=$('#enable option:selected').val();
	var data={pack_name:pack_name,pack_cost:pack_cost,emails:emails,enable:enable,ajax:'1'};
	url='<?php echo $base; ?>emailpacks/add_packs';
	$.ajax({
	   type: "POST",
	   url: url,
	   async:false,
	   data: data,
	   success:function(msg)
	   {
		if(msg==1)
		{
			window.location.href="<?php $base;?>manage_packs/cr";
		}		
	   }
		});
	}
}
</script>