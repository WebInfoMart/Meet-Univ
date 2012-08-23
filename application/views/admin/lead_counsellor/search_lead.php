<div class="margin_t" id="main_content">
			<div class="span1 float_l">
				<b>Sr.no</b>
			</div>
			<div class="span14 float_l">
				<b class="blue">FullName</b>
			</div>
			<div class="span14 float_l">
				<b class="green">Email</b>
			</div>
			<div class="span14 float_l">
				<b class="blue">Source</b>
			</div>
			<div class="span14 float_l">
				<b class="green">Phone</b>
			</div>
			<div class="clearfix"></div>
			<div class="dotted_line"></div>
			<?php 
			//print_r($verify_teleleads);
			$sr_no=0;
			foreach($verify_teleleads as $result)
			{ ?>
			<div id="c_lead_<?php echo $result['v_id']; ?>" class="old_data update_verify_lead">
			<div class="span1 float_l">
					<?php $sr_no++; echo $sr_no; ?>
			</div>
			<div class="span14 float_l">
				<?php  echo $result['v_fullname']; ?>
			</div>
			<div class="span14 float_l">
				<?php  echo $result['v_email']; ?>
			</div>
			<div class="span14 float_l">
				<?php echo $result['v_user_type']; ?>
			</div>
			<div class="span14 float_l">
				<?php  echo $result['v_phone'];  ?>
			</div>
			
			<div class="clearfix"></div>
			</div>
			<?php } ?>
		
</div>
<script type="text/javascript">
$('.update_verify_lead').click(function(){
var id=$(this).attr("id");
id=id.replace("c_lead_","");
$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admin_counsellor/counsellor",
	   async:false,
	   data: 'id='+id,
	   cache: false,
	   success: function(msg)
	   {//alert(msg);
	    $('#content').hide();
		$("#c_edit").show();
		$('#c_edit').html(msg);		 
	   }
	   });
});
function cancel()
{
	$("#c_edit").hide();
	//$('#c_edit').replaceWith('');
	$('#content').show();
	//$("#data_"+id).show('slow');
}

</script>	
