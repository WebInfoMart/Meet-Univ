<div id="content">		
	<h2 class="margin">Create Promocode</h2>	
	<div class="span8">	
		<form name="packs" class="form_horizontal_data">
			<div class="control-group1">
				<label class="control-label1" for="select01">Promocode:</label>
				<div class="controls1">
					<input type="text" id="promo_name" value=""/>		
				</div>
			</div>
			<div class="control-group1">
				<label class="control-label1" for="select01">Applied On Pack:</label>
				<div class="controls1">
					<select id="applied_on" >
						<option value="">Please Select</option>
						<?php 
						$data['user_id'] = $this->tank_auth->get_admin_user_id();
						$query=$this->db->query("select email_pack_id,email_pack_name from email_pack");
						$packs=$query->result_array();
						foreach($packs as $pack)
						{ ?>
						<option value="<?php echo $pack['email_pack_id']; ?>"><?php echo $pack['email_pack_name']; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="control-group1">
				<label class="control-label1" for="select01">Discount:</label>
				<div class="controls1">
					<input type="text" id="disc" value=""/>		
				</div>
			</div>
			<div class="control-group1">
				<label class="control-label1" for="select01">Discount On:</label>
				<div class="controls1">
					<select id="discount" >
						<option value="">Please Select</option>
						<option value="email">Emails</option>
						<option value="price">Price</option>
					</select>	
				</div>
			</div>
			<div class="control-group1">
				<label class="control-label1" for="select01">Discount Type:</label>
				<div class="controls1">
					<select id="type" >
						<option value="">Please Select</option>
						<option value="per">Percentage</option>
						<option value="num">Number</option>
					</select>
				</div>
			</div>
			<div class="control-group1">
				<div class="controls1">
						<input type="button" onclick="createPromo()" class="submit" value="Add news">	
				</div>
			</div>
		</form>		
	</div>					
</div>
<span id="pp" style="display:none">Promocode</span>	
<input type="text" style="display:none;" id="promo" value=""/>	
<script>
function createPromo()
{
	var promo_name=$("#promo_name").val();
	var applied_on=$('#applied_on option:selected').val();
	var disc=$("#disc").val();
	var discount=$('#discount option:selected').val();
	var type=$('#type option:selected').val();
	data={promo_name:promo_name,applied_on:applied_on,disc:disc,discount:discount,type:type,ajax:1};
	url='<?php echo $base; ?>emailpacks/add_promocode';
	$.ajax({
	   type: "POST",
	   url: url,
	   async:false,
	   data: data,
	   success: function(msg)
	   {
	   $("#promo").val(msg);
		$("#promo").show();
		$("#pp").show();
		$("#content").hide();		
		}
		});
}
</script>