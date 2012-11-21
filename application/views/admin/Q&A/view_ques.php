<?php 
//print_r($ans_info);
foreach($ques_info as $ques_detail) { ?>
<div id="content">
	<h2 class="margin">View ques Details</h2>
		<div class="form span8">
			<form action="<?php echo $base; ?>adminques/view_ques" method="post" class="caption_form form_horizontal_data margin_t">
				<div class="control-group1">
					<label class="control-label1" for="select01">Title:</label>
					<div class="controls1">
						<input type="text" disabled="disabled" size="30" class="text back_view" value="<?php echo $ques_detail['q_title']; ?>" >
					</div>
				</div>
				<?php if($admin_user_level=='5' || $admin_user_level=='4' && $ques_detail['univ_name']!='') {?>
				<div class="control-group1">
					<label class="control-label1" for="select01">University Name:</label>
					<div class="controls1">
						<input type="text" disabled="disabled" size="30" class="text back_view" value="<?php echo $ques_detail['univ_name']; ?>" >
					</div>
				</div>
				<?php } ?>
				<div class="control-group1">
					<label class="control-label1" for="select01">Detail:</label>
					<div class="controls1">
						<textarea rows="5" disabled="disabled" name="detail" class="back_view" cols="50"><?php echo $ques_detail['q_detail'];?></textarea>
					</div>
				</div>
				<div class="control-group1">
					<label class="control-label1" for="select01">Answers:</label>
					<div class="controls1">
						<?php foreach($ans_info as $ans)
					{ ?>
								<textarea class="back_view" rows="5" disabled="disabled" name="detail"  cols="50"><?php echo $ans['commented_text'];?></textarea>
							<?php } ?>	
					</div>
				</div>
			</form>
		</div>
	</div>
<?php } ?>	