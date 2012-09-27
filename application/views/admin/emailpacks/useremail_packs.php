<style>
#content_msg {
	overflow: hidden;
	padding: 0 20px;
	left: 220px;
	width: 40%;
	position:absolute;
	}
#content_verify_message {
	overflow: hidden;
	padding: 0 20px;
	left: 220px;
	width: 82%;
	}
#content_drop_msg {
	overflow: hidden;
	padding: 0 20px;
	left: 220px;
	width: 35%;
	position:absolute;
	}		
.message.info {
	border: 1px solid #bbdbe0;
	background: #ecf9ff url(../../images/admin/info.gif) 12px 12px no-repeat;
	color: #0888c3;
	}
	
	.message {
	padding: 10px 15px 10px 40px;
	margin-bottom: 15px;
	font-weight: bold;
	overflow: hidden;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	}
	
</style>
<div id="content_msg" class="content_msg" style="display:none;">
<div class="message info"><p>Promo Added Successfully</p></div> 
</div>
<div id="content_msg2" class="content_msg" style="display:none;">
<div class="message info"><p>Invalid Promocode!! </p></div> 
</div>
<div id="content">
	<div class="data7 float_l">
		<div class="plan_holder">	
			<ul class="menu_list">
				<li><a href="#"><img src="../images/admin/mail.png" class="img_plan_type"/><b class="blue">Email Packs</b></a></li>
				<!--<li class="bg_none"><a href="#"><img src="../images/admin/images/mbl_icon.png"/><b>SMS</b></a></li>-->
				<div class="clearfix"></div>
			</ul>
		</div>
		<div class="plan_box">
			<div class="float_l data3 plan_border">
			<?php 
			if(!empty($email_packs))
			{
			foreach($email_packs as $packs)
			{ $user_pack_id=$packs['applied_for_pack']; 
			$promos_used=$packs['user_promo_id'];			
			?>
				<div class="control_input">
					<label class="label_txt blue">
						Name:
					</label>
					<div class="input_right">
						<?php echo $packs['email_pack_name'];?>
					</div>
				</div>
				<div class="control_input">
					<label class="label_txt blue">
						Total Emails:
					</label>
					<div class="input_right" id="total_emails">
						<?php $total_emails=$packs['total_emails']; echo $total_emails;?>
					</div>
				</div>						
			</div>
			<div class="float_l data3">
				<div class="control_input">
					<label class="label_txt blue">
						Used:
					</label>
					<div class="input_right" >
						<?php echo $packs['total_emails']-$packs['email_balance'];?>
					</div>
				</div>
				<div class="control_input">
					<label class="label_txt blue">
						Remaining: 
					</label>
					<div class="input_right" id="bal">
						<?php $balance=$packs['email_balance']; echo $balance; ?>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
				<div>
		<br/>
		<label class="label_txt blue">
						Apply Promocode
					</label>		
				<input type="text" id="new_promo" value="" />
				<input type="button" value="Submit" onclick="submit();" />
				
		</div>
		
			<?php } } else { ?>	
			
			<b><h3><span>No Email Pack Available</span></h3></b>
			<?php }
			?>	
			
		</div>
	<div class="clearfix"></div>
	</div>
	
</div>
<script>
function submit()
{
	var promocode=$('#new_promo').val();
	var user_pack_id='<?php echo $user_pack_id; ?>';
	var total_emails='<?php echo $total_emails; ?>';
	var balance='<?php echo $balance; ?>';
var promos_used='<?php echo $promos_used; ?>';	
	data={promocode:promocode,user_pack_id:user_pack_id,total_emails:total_emails,balance:balance,promos_used:promos_used};
url='<?php echo $base; ?>emailpacks/add_promo';
$.ajax({
	   type: "POST",
	   url: url,
	   async:false,
	   data: data,
	   success: function(msg)
	   {//alert(msg);
	    if(msg!=0)
		{
			$("#content_msg2").hide();
			$("#content_msg").show('slow');
			var total=parseInt(total_emails)+parseInt(msg);
			$('#total_emails').html(total);
			var bal=parseInt(balance)+parseInt(msg);
			$('#bal').html(bal);
		}
		if(msg==0)
		{
			$("#content_msg").hide();
			$("#content_msg2").show('slow');
		}
	   }
});
}
</script>