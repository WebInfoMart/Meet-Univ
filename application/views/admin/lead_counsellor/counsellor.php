<link rel="stylesheet" href="<?php echo $base; ?>css/admin/engage/style.css">
<script src="<?php echo $base; ?>js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $base; ?>js/jquery-ui-custom-autosuggest.js" type="text/javascript" charset="utf-8"></script>  
<div class="body" style="margin-left: 200px;">
		<div class="big_width margin_delta">
			<div class="counsel_bg">
			<div class="float_l span3 margin_delta">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Source country: </label>
					<div class="controls-input-data">
					<input type="text" class="large" id="input01">
					</div>
				</div>
			</div>
			<div class="float_l span3">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Source city: </label>
					<div class="controls-input-data">
					<input type="text" class="large" id="input01">
					</div>
				</div>
			</div>
			<div class="float_l span3">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Leads: </label>
					<div class="controls-input-data">
					<input type="text" class="large" id="input01">
					</div>
				</div>
			</div>
			<div class="float_l span3">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Next action: </label>
					<div class="controls-input-data">
					<input type="text" class="large" id="input01">
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="bottom_line"></div>
			<div class="float_l span3 margin_delta">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Source: </label>
					<div class="controls-input-data">
					<input type="text" class="large" id="input01">
					</div>
				</div>
			</div>
			<div class="float_l span3">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Phone no: </label>
					<div class="controls-input-data">
					<input type="checkbox" class="checkbox_set">
					</div>
				</div>
			</div>
			<div class="float_l span3">
				<div class="control-group">
					<label class="label-control-data blue" for="input01"> Email address: </label>
					<div class="controls-input-data">
					<input type="checkbox" class="checkbox_set">
					</div>
				</div>
			</div>
			<div class="float_r">
				<div class="control-group">
					<button type="button" class="search_btn">
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="bottom_line"></div>
		</div>
		<!--
		<pre>
		<?php print_r($verify_teleleads); ?>
		</pre> -->
		<div class="margin_t">
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
				<?php  echo $result['v_user_type'];  ?>
			</div>
			<div class="span14 float_l">
				<?php  echo $result['v_phone'];  ?>
			</div>
			
			<div class="clearfix"></div>
			</div>
			<?php } ?>
		
		</div>
	</div>
</div>	
	<div id="c_edit"></div>
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
	   {alert(msg);
	    $('.body').hide();
		$('#c_edit').html(msg);		 
	   }
	   });
});
</script>	

