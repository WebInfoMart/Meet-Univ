	<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row margin_t1">
				<div class="float_l span13 margin_l">
					<div class="float_l span10 margin_zero">
						<div class="step_back round_box ">
							<div class="center handle_img step3_posit">
							</div>
							<h2>Search & Apply to 100+ Colleges & Universities</h2>
							<div>
							<form action="" method="POST" name="frmSelectCoolege">
								<?php
								foreach($selected_college_step_three as $select_univ)
								{
								?>
								<div class="page3_step3_width float_l margin_t">
									<div class="page3_step3">
									<input type="checkbox" id="<?php echo $select_univ['univ_id']; ?>" class="check" name="select_id[]" value="<?php echo $select_univ['univ_id']; ?>">
										<h3><?php echo $select_univ['univ_name']; ?></h3>
										<div>
											<div class="float_l page3_step3_img">
												<?php
												if($select_univ['univ_logo_path'] != '')
												{
													echo "<img class='univ_page_logo_nw' src='".base_url()."uploads/univ_gallery/".$select_univ['univ_logo_path']."'/>"; 
												}
												else
												{
													echo "<img class='univ_page_logo_nw' src='".base_url()."uploads/univ_gallery/univ_logo.png'/>"; 
												}
												?>
											</div>
											<div id="content">
												<?php echo substr($select_univ['about_us'],0,100).'....'; ?>
											</div>
											<a href="<?php echo "$base"; ?>univ_programs/<?php echo $select_univ['univ_id']; ?>/program" class="float_r">View Courses</a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<?php } ?>
								<div class="controls">
									<input type="submit" class="btn btn-success" name="submit_step_three_data" value="Continue">
								</div>
								</form>
								<div class="clearfix"></div>
							</div>
							
						</div>
					</div>
					<div class="float_r span3">
						<img src="<?php echo "$base$img_path" ?>/banner_img.png">
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="float_r span3">
					<img src="<?php echo "$base$img_path" ?>/banner_img.png">
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>