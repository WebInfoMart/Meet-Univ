						<div class="search_bar_heading">
						<?php
						$count_array = count($get_university['university']);
						for($no_university = 0; $no_university<$count_array; $no_university++)
						{
						?>
							<div>
								<div class="college_head">
									<div class="float_l margin_zero">
										<h3><a href="<?php echo $base; ?>university/<?php echo $get_university['university'][$no_university]['univ_id']; ?>"><?php echo $get_university['university'][$no_university]['univ_name']; ?></a></h3>
									</div>
									<div class="float_r span4 margin_t1">
										<div class="float_l">
											<div class="float_l"><img src="<?php echo "$base$img_path"; ?>/user.png"></div>
											<div class="float_r margin_l"><small>Followers <?php echo $get_university['followers'][$no_university]; ?></small></div>
										</div>
										<div class="float_r">
											<div class="float_l"><img src="<?php echo "$base$img_path"; ?>/document.png"></div>
											<div class="float_r margin_l"><small>Articles <?php echo $get_university['article'][$no_university]; ?></small></div>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="padding">
									<div class="span7 margin_zero float_l">
										<div class="float_l span3 margin_zero">
												<div>
												<?php 
												$x = $get_university['university'][$no_university]['univ_logo_path'];
												if($x != '')
												{
												echo "<img class='univ_logo' src='".base_url()."uploads/univ_gallery/".$x."'/>"; 
												}
												else{
												echo "<img src='".base_url()."images/default_logo.png'/>";
												}
												?>
												</div>
										</div>
										<div class="float_r span4 margin_l data_limited">
											<?php echo substr($get_university['university'][$no_university]['about_us'],0,365).'..'; ?>
										</div>
									</div>
									<div class="float_l">
										<div class="college_data_right"></div>
									</div>
									<div class="float_r span5 margin_zero">
										<h3>Offering Courses in</h3>
											<ul class="question college_list_data margin_zero">
												<?php 
												if($get_university['program'][$no_university] != '')
												{
												foreach($get_university['program'][$no_university] as $prog) {
												if(is_array($prog))
													{ ?>
														
														
 <li><a href="<?php echo $base; ?>program_detail/<?php echo $get_university['university'][$no_university]['univ_id'].'/'.$prog['prog_id']; ?>"><?php echo $prog['course_name']; ?></a></li>
														<?php
														
													}
												}
												}
												?>
										</ul>
									</div>
									<div class="clearfix"></div>
									<div>
										<div class="float_l">
										<h4></h4>
										</div>
										<div class="float_r">
											<button class="btn btn-success" href="#">Request Information</button>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
									<div class="clearfix"></div>
							</div>
							<?php
							}
							?>
				
							</div>
						