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
							<?php foreach($country as $countries) { ?>			
											<li>
	<a href="<?php echo $base; ?>all_colleges?country_id=<?php echo $countries['country_id']; ?>"><?php echo $countries['country_name']; ?></a>
											</li>	
							<?php } ?>				
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
										<?php foreach($fetch_area_intrest as $fetch_area_intrest1) { ?>			
											<li>
								
	<a href="<?php echo $base; ?>all_colleges?area_intrest=<?php echo $fetch_area_intrest1['prog_parent_id']; ?>"><?php echo $fetch_area_intrest1['program_parent_name']; ?></a>
											</li>	
										<?php } ?>
											
											
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
										<?php foreach($fetch_educ_level as $fetch_educ_levels) { ?>			
											<li>
<a href="<?php echo $base; ?>all_colleges?area_intrest=<?php echo $fetch_educ_levels['prog_edu_lvl_id']; ?>"><?php echo $fetch_educ_levels['educ_level']; ?></a>
											</li>	
										<?php } ?>
											
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
						
					</div>
				<div class="float_l"><div class="row" style="margin-left:70px;">
				<div class="span10 margin_t1">
					<div class="back_img">
						<h2 class="border_bot_wel">Meet Univerties</h2>
						<div class="span8 margin_t alert alert-error">
							<center><?php echo $err_msg; ?></center>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div></div>	
				</div>	
			
				<div class="float_r span3">
					<img src="<?php echo "$base$img_path"; ?>/banner_img.png" />
				</div>
				
				<div class="clearfix"></div>
		</div>		
				<div id="pagination" class="table_pagination right paging-margin">
   
            <?php echo $this->pagination->create_links();?>
   
            </div>
				
			</div>
			
		</div>
	</div>