		<div class="margin_t " id="main_content" >
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
			//print_r($serial);
			$sno=$sr_id+1;
			foreach($verify_teleleads as $result)
			{if($sno % 2) {
			$class = 'back_diff';
			} else {
			$class = '';
			} ?>
  			
				<div id="c_lead_<?php echo $result['v_id']; ?>" class="old_data update_verify_lead" style="cursor:pointer;">
				<div class="span1 float_l">
						<?php echo $sno++; ?>
				</div>
				<div class="span14 float_l">
					<?php  echo $result['v_fullname']; ?>
				</div>
				<div class="data4 float_l">
					<?php  if($result['v_email']==""){ echo 'Not Available';} else { echo $result['v_email'];} ?>
				</div>
				<div class="span14 float_l">
					<?php if($result['v_user_type']=="")
					{ 
						echo 'Not Available';
					} 
					else 
					{ 
						if($result['v_user_type']=='site_user')
						{
							echo 'Site User';
						}
						else if($result['v_user_type']=='fb_login')
						{
							echo 'Facebook User';
						}
						else if($result['v_user_type']=='fb_canvas')
						{
							echo 'Facebook application';
						}
						else if($result['v_user_type']=='android_user')
						{
							echo 'Android User';
						}
						else if($result['v_user_type']=='event_user')
						{
							echo 'Event User';
						}
						else if($result['v_user_type']=='offline')
						{
							echo 'Offline';
						}
						else
						{
							echo 'Other';
						}
					}
					?>
				</div>
				<div class="data2 float_l">
					<?php  if($result['v_phone']=="" || $result['v_phone']=="0"){ echo 'Not Available';} else { echo $result['v_phone'];}  ?>
				</div>				
				<div class="clearfix"></div>
			</div>
			</div>
			<?php } ?>
					<div id="pagination" class="table_pagination right paging-margin float_r" style="margin-right:50px;">
            <?php echo $this->pagination->create_links();?>          
			</div>

		</div>
<script>
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

</script>