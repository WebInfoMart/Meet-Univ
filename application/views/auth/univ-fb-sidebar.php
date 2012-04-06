<div class="span4 float_r margin_t">
								<div class="college_form">
							<div>
							<h2 class="text_align">I AM INTERESTED</h2>
								<span>Interested in studying at Manipal University, Dubai Campus (RCPL)</span>
								<div class="fcnt_signBtn"></div>or Fill details for the institute to counsel you
								<div class="margin_t text_align"> 
									
										<fieldset>
											<div class="control-group">
												<input type="text" name="apply_name" class="input-medium" placeholder="Name">
											</div>
											<div class="control-group">
												<select name="apply_course_interest" id="apply_course_interest" class="span2">
													<option value="">Course of interest</option>
													<?php
													if(!empty($area_interest))
													{
													foreach($area_interest as $apply_interest)
													{
														echo "<option value=$apply_interest[prog_parent_id]> $apply_interest[program_parent_name] </option>";
													}
													}
													?>
												</select>
											</div>
											<div class="control-group">
												<input type="text" name="apply_email" id="apply_email" class="input-medium" placeholder="Email Id">
											</div>
											<div class="control-group">
												<input type="text" name="apply_mobile" class="input-medium" placeholder="Mobile Number">
											</div>
											<!--<div class="control-group">
													<p class="help-block margin_alpha margin_b">Type in the characters you see below</p>
												<div class="float_l">
													<img src="<?php echo "$base$img_path" ?>/Captcha.jpg">
												</div>
												<div class="float_r margin_t">
													<input type="text" class="input_small">
												</div>
												<div class="clearfix"></div>
											</div>-->
											<div class="control-group">
												<input type="submit" name="apply_now" id="apply_now" value="Apply Now!" class="btn btn-primary"/>
											</div>
										 </fieldset>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>