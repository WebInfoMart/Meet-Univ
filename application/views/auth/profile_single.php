<div>
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body_container">
			<div class="row show-grid">
				<div class="span13">
					<div class="float_l span15 margin_zero sidebar">
						<div class="margin_t50 single_sidebar">
							<ul>
								<li class="active_side"><div class="float_l"><img src="<?php echo "$base$img_path";  ?>/account.png" class="margin_l21"></div><div class="float_r span79 margin_zero">Account Information</div><div class="clearfix"></div></li>
								<li><div class="float_l"><img src="<?php echo "$base$img_path";  ?>/update.png" class="margin_l21"></div><div class="float_r span79 margin_zero">Update Password</div><div class="clearfix"></div></li>
								<li><div class="float_l"><img src="<?php echo "$base$img_path";  ?>/key.png" class="margin_l21"></div><div class="float_r span79 margin_zero">Update E-mail</div><div class="clearfix"></div></li>
							</ul>
						</div>
					</div>
					<div class="float_r span111">
						<div class="row">
							<div class="span71">
								<form class="form-horizontal form_data" action="user_profile_update" method="post" enctype="multipart/form-data">
									<h2 class="profile_heading">Update Account Information</h2>
									<div class="profile_border">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec faucibus, olor sit amet, consectetur adipiscing dolor ut posuere faucibus, nibh neque sollicitudin olor sit amet, consectetur adipiscing enim, non consectetur lorem odio eu lectus.
										<div class="contact_box margin_t">
											<div class="margin_l21 margin_t1">
												<h3>Personal Information <img src="<?php echo "$base$img_path";  ?>/ques_layer.png"></h3>
													<div class="form-horizontal form_data margin1">
														<div>
															<label class="control-label padding_alpha">
															<?php
															if($fetch_profile['user_pic_path'] != '')
															{
																echo "<img class='profile_img_width' src='".base_url()."uploads/".$fetch_profile['user_pic_path']."'/>";
															}
															else{
															?>
															<img class="profile_img_width" src="<?php echo "$base$img_path";  ?>/user_model.png">
															</label>
															<?php } ?>
															<div class="controls contact_box_content">
															
																<input type="file" name="userfile" class="button_profile"/><div class="span15 margin_zero change_profile">Change your pic</div>
															</div>
															<div class="clearfix"></div>
														</div>
														<div class="control-group">
															<label class="control-label">Full Name *</label>
															<div class="controls contact_box_content">
																<input type="text" class="input_xxxx-large" value="<?php echo $fetch_profile['full_name']; ?>" name="full_name" id="full_name" placeholder="Fullname">
															</div>
														</div>
														<div class="control-group">
															<div class="float_l span15 margin_zero"><h4>Gender</h4></div>
															
																<div class="float_l span2 margin_7"><input type="radio" name="sex" value="male" <?php if($fetch_profile['gender'] == "male") { echo 'checked'; } ?> /> Male
																	<input type="radio" name="sex" value="female" style="margin-left:20px;" <?php if($fetch_profile['gender'] == "female") { echo 'checked'; } ?> /> Female</div>
																<div class="clearfix"></div>
														</div>
														<div class="control-group">
															<label class="control-label">Country *</label>
															<div class="controls select_button">
															<?php $user_selected_country = $fetch_profile['country_id']; 
															$selected ='';
															?>
																<select name="country">
																<?php foreach($country as $countries) {
																if($countries['country_id'] == $user_selected_country) { $selected ='selected';} else { $selected =''; }
																?>
																	<option value="<?php echo $countries['country_id'] ;?>" <?php echo $selected; ?> ><?php echo $countries['country_name']; ?></option>
																<?php } ?>
																</select>
															</div>
														</div>
														<div class="control-group">
															<label class="control-label">Birth Date *</label>
															<div class="controls contact_box_content">
															<?php
															$dob = $fetch_profile['dob'];
															$dob_explode = explode("-",$dob);
															?>
																<input type="text" class="input-small margin_all" value="<?php echo $dob_explode[0] ?>" name="year" id="year" placeholder="Year">
																<input type="text" class="input-small margin_all" value="<?php echo $dob_explode[1] ?>" name="month" id="month" placeholder="Month">
																<input type="text" class="input-small margin_all" value="<?php echo $dob_explode[2] ?>" name="date" id="date" placeholder="Date">
															</div>
														</div>
														<div class="control-group">
															<label class="control-label">Alias *</label>
															<div class="controls contact_box_content">
																<input type="text" class="input_xxxx-large" value="<?php echo $fetch_profile['alias_name']; ?>" name="alias_name" id="alias_name" placeholder="Alias name">
															</div>
														</div>
													</div>
													<div class="clearfix"></div>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="contact_box margin_t">
											<div class="margin_l21 margin_t1">
												<h3>Contact Information</h3>
													<div class="margin1">
														<div class="control-group">
															<label class="control-label">Home Address *</label>
															<div class="controls contact_box_content">
																<input type="text" class="input_xxxx-large" value="<?php echo $fetch_profile['home_address']; ?>" name="home_adrs" id="home_adrs" placeholder="Home adress">
															</div>
														</div>
														<div class="control-group">
															<label class="control-label">Mobile Number *</label>
															<div class="controls contact_box_content">
																<input type="text" class="input_xxxx-large" value="<?php echo $fetch_profile['mob_no']; ?>" name="mob_no" id="mob_no" placeholder="Mobile number">
															</div>
														</div>
														<div class="control-group">
															<label class="control-label">Alternate Email *</label>
															<div class="controls contact_box_content">
																<input type="text" class="input_xxxx-large" value="<?php echo $fetch_profile['alt_email']; ?>" name="alt_email" id="alt_email" placeholder="Alt email">
															</div>
														</div>
													</div>
											</div>
										</div>	
										<div class="contact_box margin_t">
											<div class="margin_l21 margin_t1">
												<h3>Educational Information</h3>
													<div class="margin1">
														<div class="control-group">
															<label class="control-label">Current Qualification *</label>
															<div class="controls select_button">
															<?php $curent_quali = $fetch_profile['curr_educ_level']; ?>
																<select name="curnt_quali">
																<?php
																foreach($educ_level as $curnt_educ)
																{
																if($curnt_educ['prog_edu_lvl_id'] == $curent_quali) { $selected ='selected';} else { $selected =''; }
																?>
																	<option value="<?php echo $curnt_educ['prog_edu_lvl_id']; ?>" <?php echo $selected; ?> ><?php echo $curnt_educ['educ_level']; ?></option>
																<?php } ?>
																</select>
															</div>
														</div>
														<div class="control-group">
															<label class="control-label">Area Of Interest *</label>
															<div class="controls select_button">
															<?php $intrest_area_profile = $fetch_profile['prog_parent_id']; ?>
																<select name="area_intrst">
																	<?php
																foreach($area_interest as $area)
																{
																if($area['prog_parent_id'] == $intrest_area_profile) { $selected ='selected';} else { $selected =''; }
																?>
																	<option value="<?php echo $area['prog_parent_id']; ?>" <?php echo $selected; ?> > <?php echo $area['program_parent_name']; ?></option>
																<?php } ?>
																</select>
															</div>
														</div>
													</div>
											</div>
										</div>	
										<div class="clearfix"></div>
										<div class="margin_t">
										<input type="submit" class="btn btn-primary" value="Update"/>
											<!--<button class="btn btn-primary" href="#">Update</button>-->
										</div>
									</div>
								</form>
							</div>
							<div class="span15">
									<img src="<?php echo "$base$img_path";  ?>/banner_img.png">
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>