<div id="content">
	<div class="data7 float_l">
		<div class="plan_holder">
			<ul class="menu_list">
				<li><!--<a href="#"><img src="../images/admin/images/mail.png"/>.--><b class="blue">Email</b></a></li>
				<!--<li class="bg_none"><a href="#"><img src="../images/admin/images/mbl_icon.png"/><b>SMS</b></a></li>-->
				<div class="clearfix"></div>
			</ul>
		</div>
		<div class="plan_box">
			<div class="float_l data3 plan_border">
			<?php foreach($email_packs as $packs)
			{ ?>
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
					<div class="input_right">
						<?php echo $packs['total_emails'];?>
					</div>
				</div>						
			</div>
			<div class="float_l data3">
				<div class="control_input">
					<label class="label_txt blue">
						Used:
					</label>
					<div class="input_right">
						<?php echo $packs['total_emails']-$packs['email_balance'];?>
					</div>
				</div>
				<div class="control_input">
					<label class="label_txt blue">
						Remaining: 
					</label>
					<div class="input_right">
						<?php echo $packs['email_balance'];?>
					</div>
				</div>
			</div>
			<?php } ?>	
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
