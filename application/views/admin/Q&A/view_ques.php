<?php 
foreach($ques_info as $ques_detail) { ?>
<div id="content">
		<h2 class="margin">View ques Details</h2>
		<div class="form span8">
			<form action="<?php echo $base; ?>adminques/view_ques" method="post" class="caption_form">
				<ul>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Title</label>
							</div>
							<div class="float_l span3">
								<input type="text" disabled="disabled" size="30" class="text" value="<?php echo $ques_detail['q_title']; ?>" >
							</div>
							
							<div class="clearfix"></div>
						</div>
					</li>
					<?php if($admin_user_level=='5' || $admin_user_level=='4' && $ques_detail['univ_name']!='') {?>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>University Name</label>
							</div>
							<div class="float_l span3">
								<input type="text" disabled="disabled" size="30" class="text" value="<?php echo $ques_detail['univ_name']; ?>" >
							</div>
							
							<div class="clearfix"></div>
						</div>
					</li>
					<?php } ?>   
					
					
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Detail</label>
							</div>
							<div class="">
								<textarea rows="12" disabled="disabled" name="detail"  cols="103"><?php echo $ques_detail['q_detail'];?></textarea>
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
				</ul>
						
			</form>
		</div>
	</div>
<?php } ?>	