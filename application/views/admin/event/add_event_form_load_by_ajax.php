<?php
echo '<div id="left_cont" class="left_content"> 
	 <div class="box_top_margin">
		<div class="float_l">
								<label>Title</label>
							</div>
							<div class="float_r">
								<input type="text" size="30" class="<?php echo $class_title; ?>" value="<?php echo set_value("title"); ?>" name="title">
								
		
							</div>
							
							<div class="clearfix"></div>
							</div>
							<div class="box_top_margin">
							<?php if($admin_user_level=="5" || $admin_user_level=="4") {?>
							<div class="float_l">
								<label>Choose University</label>
							</div>
							<div class="float_r">
							<select class="<?php echo $class_univ_name; ?> styled span3 margin_zero" name="university">
								<option value="">Please Select</option>
									<?php foreach($univ_info as $univ_detail) { ?>
										<option value="<?php echo $univ_detail->univ_id; ?>" ><?php echo $univ_detail->univ_name; ?></option>
										<?php } ?>
							</select>
		
		
						</div>
						<div class="clearfix"></div>
							<?php } else { ?>
							<input type="hidden" name="university" value="<?php echo $univ_info["univ_id"]; ?>">
					<?php }?>
					</div>
					<div class="box_top_margin">
					<div class="float_l">
								<label>Country</label>
							</div>
					<div class="float_r" >
								<select class="<?php echo $class_country; ?> styled span3 margin_zero styled_overwrite" name="country" id="country" onchange="fetchstates(0)">
									<option value="">Please Select</option>
									<?php foreach($countries as $country) { ?>
										<option value="<?php echo $country["country_id"]; ?>" ><?php echo $country["country_name"]; ?></option>
										<?php } ?>
	
								</select>

							
						</div> 
					<div class="float_r">
								<a rel="modal-profile" href="#" id="add_country" class="tdn">Add New Country</a>
								</div>
					<div class="clearfix"></div>
					</div>
					
					<div class="box_top_margin">
					<div class="float_l">
							<label>State</label>
						</div>
						<div class="float_r">
							<select class="<?php echo $class_state; ?> styled span3 margin_zero styled_overwrite" name="state" onchange="fetchcities(0,0)" id="state" disabled="disabled">
								<option value="">Please Select</option>
							</select>

		
						</div>
						<div class="float_r">
							<a id="add_state" href="#" class="tdn">Add New State</a>
						</div>
						<div class="clearfix"></div>
					</div>
					
					<div class="box_top_margin">
						<div class="float_l">
							<label>City</label>
						</div>
						<div class="float_r">
							<select class="<?php echo $class_city; ?> styled span3 margin_zero styled_overwrite"  name="city" id="city" disabled="disabled">
								<option value="">Please Select</option>
							</select>

				
						</div><div class="clearfix"></div>
						<div class="float_r">
						<a id="add_city" href="#" class="tdn">Add New City</a>
						</div>
						<div class="clearfix"></div>
					</div>
					
					
							
	 </div>
	 <!--------------- Middle Div ----------------->
	 <div id="middle_cont" class="mid_content">  
		<div class="box_top_margin">
			<div class="float_l">
							<label>Event Place</label>
						</div>
						<div class="float_r">
						<input type="text" size="30" class="text" value="<?php echo set_value("event_place"); ?>" name="event_place">	
				
						</div>
						<div class="clearfix"></div>
		</div>
		
		<div class="box_top_margin">
			<div class="float_l">
							<label>Event Type</label>
						</div>
						<div class="float_r">
							<select class="text styled span3 margin_zero styled_overwrite"  name="event_type">
								<option value="all">Select</option>
								<option value="spot_admission">Spot Admission</option>
								<option value="fairs">Fairs</option>
								<option value="alumuni">Counselling-Alumuni</option>
								<option value="others">Counselling-Others</option>
								
							</select>

				
						</div>
						
						<div class="clearfix"></div>
		</div>
		
		<div class="box_top_margin">
			<div class="float_l">
								<label>Event Date</label>
							</div>
							<div class="float_r">
								<input type="text" size="30" class="date_picker" value="<?php echo set_value("event_time"); ?>" name="event_time">

		
							</div>
							
							<div class="clearfix"></div>
		</div>
		
		<div class="box_top_margin">
		<div class="float_l">
								<label>Event Time</label>
							</div>
							<div class="float_r">
								<input type="text" class="text" size="30" value="<?php echo set_value("event_timing"); ?>" name="event_timing">
	
							</div>
							
							<div class="clearfix"></div>
		</div>
		
	 </div>
	 
	 
	 <!--------------- Right Div ----------------->
	 <div id="right_cont" class="right_content"> 
		<div class="float_l">
								<label>Detail</label>
							</div>
							<div class="float_l">
								<textarea rows="6" name="detail" class="wysiwyg" cols="20"><?php echo set_value("detail"); ?></textarea>
							</div>
							<div class="clearfix"></div>
							
	 </div>
	 </div>';
?>	 