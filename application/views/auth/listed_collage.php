<?php
// echo $get_university['university']['0']['univ_name'];
 //print_r($get_university);
?>
<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row margin_t1">
				<div class="float_l span13 margin_l">
					<div class="search_box padding_lefty">
						<div class="float_l grid_1 margin_zero search_box_height">
							<h5>Filter by Country?</h5>
							<div id="scrollbar1">
								<div class="scrollbar" style="height: 70px!important;overflow: hidden;"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
								<div class="viewport">
									<div class="overview">
										<ul>
											<li>
												<a>United Kingdam</a>
											</li>
											<li>
												<a>India</a>
											</li>
											<li>
												<a>United State</a>
											</li>
											<li>
												<a>Canada</a>
											</li><li>
												<a>Korea</a>
											</li>
											<li>
												<a>Ireland</a>
											</li>
										</ul>                 
									</div>
								</div>
							</div>
								<div class="clearfix"></div>
						</div>
						<div class="float_l grid_1 margin_zero search_box_height">
							<h5>Filter by Study Subject</h5>
							<div id="scrollbar2">
								<div class="scrollbar" style="height: 70px!important;overflow: hidden;"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
								<div class="viewport">
									<div class="overview">
										<ul>
											<li>
												<a>Business, Finance & Management</a>
											</li>
											<li>
												<a>Arts & Humanities</a>
											</li>
											<li>
												<a>Science</a>
											</li>
											<li>
												<a>Computers & Information Technology</a>
											</li><li>
												<a>Engineering</a>
											</li>
											<li>
												<a>Health Sciences & Medical</a>
											</li>
										</ul>                 
									</div>
								</div>
							</div>
						</div>
						<div class="float_l grid_1 margin_zero search_box_height">
							<h5>Filter by Study Level</h5>
							<div id="scrollbar3">
								<div class="scrollbar" style="height: 70px!important;overflow: hidden;"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
								<div class="viewport">
									<div class="overview">
										<ul>
											<li>
												<a>Bachelors Degree</a>
											</li>
											<li>
												<a>Masters Degree</a>
											</li>
											<li>
												<a>College Diploma</a>
											</li>
											<li>
												<a>Ph.D. or Doctoral Degree</a>
											</li>
											<li>
												<a>Post-Graduate Certificate</a>
											</li>
											<li>
												<a>Certificate</a>
											</li>
											<li>
												<a>Associate Degree</a>
											</li>
											<li>
												<a>High School</a>
											</li>
										</ul>                 
									</div>
								</div>
							</div>
						</div>
						<div class="float_l grid_1 margin_zero search_box_height">
							<h5>Filter by Course Duration </h5>
							<div id="scrollbar4">
								<div class="scrollbar" style="height: 70px!important;overflow: hidden;"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
								<div class="viewport">
									<div class="overview">
										<ul>
											<li>
												<a>Business, Finance & Management</a>
											</li>
											<li>
												<a>Arts & Humanities</a>
											</li>
											<li>
												<a>Science</a>
											</li>
											<li>
												<a>Computers & Information Technology</a>
											</li><li>
												<a>Engineering</a>
											</li>
											<li>
												<a>Health Sciences & Medical</a>
											</li>
										</ul>                 
									</div>
								</div>
							</div>
						</div>
						<div class="float_l grid_1 margin_zero search_box_height">
							<h5>Filter by Course Duration </h5>
							<div id="scrollbar5">
								<div class="scrollbar" style="height: 70px!important;overflow: hidden;"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
								<div class="viewport">
									<div class="overview">
										<ul>
											<li>
												<a>Business, Finance & Management</a>
											</li>
											<li>
												<a>Arts & Humanities</a>
											</li>
											<li>
												<a>Science</a>
											</li>
											<li>
												<a>Computers & Information Technology</a>
											</li><li>
												<a>Engineering</a>
											</li>
											<li>
												<a>Health Sciences & Medical</a>
											</li>
										</ul>                 
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<?php echo $headerjs; ?>
						<?php echo $headermap; ?>
						<?php echo $onload; ?>
						<?php echo $map; ?>
						<?php echo $sidebar; ?>
					</div>
					<div class="margin_t">
						<div class="search_bar_heading">
						<?php
						// foreach($get_university as $university_detail)
						// {
						// if(is_array($university_detail))
						// {
						// foreach($university_detail as $sub_university_detail)
						// {
						$count_array = count($get_university['university']);
						for($no_university = 0; $no_university<$count_array; $no_university++)
						{
						?>
							<div>
								<div class="college_head">
									<div class="float_l margin_zero">
										<h3><a href="university/<?php echo $get_university['university'][$no_university]['univ_id']; ?>"><?php echo $get_university['university'][$no_university]['univ_name']; ?></a></h3>
									</div>
									<div class="float_r span4 margin_t1">
										<div class="float_l">
											<div class="float_l"><img src="<?php echo "$base$img_path" ?>/user.png"></div>
											<div class="float_r margin_l"><small>Followers <?php echo $get_university['followers'][$no_university]; ?></small></div>
										</div>
										<div class="float_r">
											<div class="float_l"><img src="<?php echo "$base$img_path" ?>/document.png"></div>
											<div class="float_r margin_l"><small>Articles <?php echo $get_university['article'][$no_university]; ?></small></div>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="padding">
									<div class="span7 margin_zero float_l">
										<div class="float_l span3 margin_zero">
												<div><?php 
												$x = $get_university['university'][$no_university]['univ_logo_path'];
												if($x != '')
												{
												echo "<img class='univ_logo' src='".base_url()."uploads/univ_gallery/".$x."'/>"; 
												}
												else{
												echo "<img src='".base_url()."images/default_logo.png'/>";
												}
												?></div>
										</div>
										<div class="float_r span4 margin_l data_limited">
											<?php echo $get_university['university'][$no_university]['about_us']; ?>
										</div>
									</div>
									<div class="float_l">
										<div class="college_data_right"></div>
									</div>
									<div class="float_r span5 margin_zero">
										<h3>Offering Courses in</h3>
											<ul class="question college_list_data margin_zero">
												<?php foreach($get_university['program'][$no_university] as $prog) {
												if(is_array($prog))
													{
								
														?>
															<li><a href="<?php echo $base; ?>program_detail/<?php echo $get_university['university'][$no_university]['univ_id'].'/'.$prog['prog_id']; ?>"><?php echo $prog['course_name']; ?></a></li>
														<?php
														
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
							<?php } //} } ?>	
						</div>
					</div>
				</div>
				<div class="float_r span3">
					<img src="<?php echo "$base$img_path" ?>/banner_img.png" />
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>