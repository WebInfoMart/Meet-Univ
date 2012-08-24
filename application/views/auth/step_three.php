
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
							<?php
							if(!empty($selected_university_name_by_step))
							{
								echo "<h4>Yoh have Choose    ".$selected_university_name_by_step['title']."</h4></br>";
								echo "<h4>Want to Register with more university...Select Universitys</h4>";
							}
							?>
							<form action="" method="POST" name="frmSelectCoolege">
								<?php
								if(!empty($selected_college_step_three))
								{
								$clear_even_odd = 1;
								$apply_by_univ_id = $this->session->userdata('apply_college');
								foreach($selected_college_step_three as $select_univ)
								{
								if($select_univ['univ_id'] == $apply_by_univ_id)
								{
									$check = 'checked=checked';
								}
								else{
								$check='';
								}
								$cnt_cont = strlen($select_univ['univ_overview']);
								if($cnt_cont > 100)
								{
									$univ_detail=str_replace("<div>","<p>",$select_univ['univ_overview']);
									$univ_detail=str_replace("</div>","</p>",$univ_detail);
									$content = substr($univ_detail,0,100).'....';
								}
								else{ $content = $select_univ['univ_overview']; }
								$programs_link=$this->subdomain->genereate_the_subdomain_link($select_univ['subdomain_name'],'programs','','');
								 if($clear_even_odd % 2 == 0) {
								$class_left_margin = 'style="margin-left:7px;"';
								}
								else { $class_left_margin = ''; }
								?>
								
								<div class="page3_step3_width float_l margin_t"<?php echo $class_left_margin; ?>>
									<div class="page3_step3">
									<input type="checkbox" id="<?php echo $select_univ['univ_id']; ?>" class="check" name="select_id[]" value="<?php echo $select_univ['univ_id']; ?>" <?php echo $check; ?>>
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
											<?php echo $content; ?>
											</div>
											<a href="<?php echo $programs_link; ?>" class="float_r" target="_blank">View Courses</a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<?php if($clear_even_odd % 2 == 0) { ?>
								<div class="clearfix"></div>
								<?php } $clear_even_odd++; ?>
							<?php } } else { echo "<h3> No Results Found According Search Criteria... </h3>"; } ?>
							<div class="clearfix"></div>
							<div class="controls" style="margin-top: 12px;">
								<?php if(empty($selected_college_step_three)) { ?>
								<input type="submit" class="btn btn-success" name="edit_search" value="Modify Your search">
								<?php } else { ?>
									<input type="submit" class="btn btn-success" name="submit_step_three_data" value="Continue">
									<?php } ?>
								</div>
								</form>
						</div>
					</div>
					<div class="float_r span3">
						<img src="images/banner_img.png">
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="float_r span3">
					<img src="images/banner_img.png">
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	