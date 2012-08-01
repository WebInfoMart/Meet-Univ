<link rel="stylesheet" href="<?php echo $base; ?>css/admin/autosuggest.css" type="text/css" media="screen" title="Test Stylesheet" charset="utf-8" />
<script src="<?php echo $base; ?>js/jquery.js" type="text/javascript" charset="utf-8"></script>
 <script src="<?php echo $base; ?>js/admin/fcbkcomplete.js" type="text/javascript" charset="utf-8"></script>    
 
 
 
 
 
 
 <div id="edit_data_<?php echo $lead_info['id']; ?>" class="data update_lead_data" style="display:none">
			<div>
				<div class="control_full float_l">
					<label class="label_data">Sr No</label>
					<div class="controls_data">
						1
					</div>
				</div>
				<div class="control_full float_l">
					<label class="label_data">FullName</label>
					<div class="controls_data">
					<input type="text" class="input_text"  name="full_name" id="lead_full_name_<?php echo $lead_info['id']; ?>" value=" <?php echo $lead_info['fullname']; ?>">

						
					</div>
				</div>
				<div class="control_full float_l">
					<label class="label_data">Email</label>
					<div class="controls_data">
						<input type="text" class="input_text" name="email" id="lead_user_email_<?php echo $lead_info['id']; ?>" value="<?php echo $lead_info['email']; ?>">

					</div>
				</div>
				<div class="control_full float_l">
					<label class="label_data">Source</label>
					<div class="controls_data">
					<?php
					if($lead_info['lead_source']=='site_user'){ 
					$lead_source="Site User"; }
					else if($lead_info['lead_source']=='fb_login'){ $lead_source="FB Login(Site User)"; }
					else if($lead_info['lead_source']=='android_user'){ $lead_source="Mobile App"; }
					else if($lead_info['lead_source']=='event_user'){ $lead_source="Event Registration"; }
					else if($lead_info['lead_source']=='fb_canvas'){ $lead_source="FB Application"; }
					else if($lead_info['lead_source']=='college_request') { $lead_source="Request College"; }
					else{$lead_source="Other";};
					echo $lead_source;
					?>
						
					</div>
				</div>
				<div class="control_full float_l">
					<label class="label_data">Phone</label>
					<div class="controls_data">
						<?php if($lead_info['phone_no1']=='0' || $lead_info['phone_no1']==NULL)
						{
						$mobile='';
						}
						else
						{
						$mobile=$lead_info['phone_no1'];
						}?>
						<input type="text" class="input_text" name="phone" id="phone_<?php echo $lead_info['id']; ?>" value="<?php echo $mobile; ?>">

					</div>
				</div>
				<div class="control_full float_l">
					<label class="label_data">DOB</label>
					
					<div class="controls_data">
					<?php
					$dob=$lead_info['dob'];
					 if($dob=='' || $dob==NULL || $dob=='0')
					 {
					 $dob='0000-00-00';
					 }
					 $d_of_b=explode("-",$dob);	
					?> 
					<select name="year" id="year_<?php echo $lead_info['id']; ?>" class="<?php //echo $class_year_name; ?>" >
					<option value="0" >Year</option> 
					<?php
					for($count_year=1920;$count_year<=2005;$count_year++)
					{ ?>
					<option  value="<?php echo $count_year; ?>" <?php if($count_year==$d_of_b[0]){ echo "selected"; } ?> ><?php echo $count_year; ?></option>
					<?php } ?>
					</select>
																		
						
					<select name="month"  id="month_<?php echo $lead_info['id']; ?>" >

					<option value="" >Month</option> 

					<?php
					$arr_month = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'); 
					for($count_month=1;$count_month<=12;$count_month++)
					{
					?>
					<option value="<?php echo $count_month; ?>" <?php if($count_month==$d_of_b[1]){ echo "selected"; } ?>><?php echo $arr_month[$count_month-1]; ?></option>
					<?php } ?>
					</select>
				 
				 <select  name="date" id="date_<?php echo $lead_info['id']; ?>" >

					<option value="" >Date</option> 
				<?php

				for($count_date=1;$count_date<=31;$count_date++)
				{
				?>
				<option value="<?php echo $count_date; ?>" <?php if($count_date==$d_of_b[2]){ echo "selected"; } ?> ><?php echo $count_date; ?></option>
				<?php } ?>
				</select>
					</div>
					
				</div>
	
				<div class="control_full float_l">
					<label class="label_data">Country</label>
					<div class="controls_data">
						<select name="country" id="country" onchange="fetchstates('<?php echo $lead_info['id']; ?>')">
						<option value="">country</option>
					<?php	foreach($country_res as $country_result) { 
					$selected='';
					if($country_result['country_id']==$lead_info['home_country_id']) { 
					$selected='selected';
					}
					?>	
					<option value="<?php echo $country_result['country_id']; ?>" <?php echo $selected; ?>><?php echo $country_result['country_name']; ?></option>
					<?php } ?>
						</select>
						
					</div>
				</div>
				
				<div class="control_full float_l">
					<label class="label_data">State</label>
					<select name="country" id="state" onchange="">
							
					</select>
				</div>
				
				<div class="control_full float_l">
					<label class="label_data">City</label>
					<div class="controls_data">
						<select name="city" id="city">
						</select>
					</select>
					</div>
				</div>
				<div class="control_full float_l">
					<label class="label_data">Enroll K12</label>
					<div class="controls_data">
						<input type="text" class="input_text" id="input01">
					</div>
				</div>
				<div class="control_full float_l">
					<label class="label_data">Interested Courses</label>
					<div class="controls_data">
						<input type="text" class="input_text" id="input01">
					</div>
				</div>
				<div class="control_full float_l">
					<label class="label_data">Interested Country</label>
					<div class="controls_data">
						<input type="text" class="input_text" id="input01">
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="float_r">
			<label class="label_data">Add Notes</label>
					
				<textarea cols="52" rows="4"></textarea>
				<br/>
				<input type="button" name="cancel" class="margin_l1 margin_t btn_save float_r cancel_update" id="cancel_data_<?php echo $lead_info['id']; ?>" value="Cancel" onclick="canceldata('<?php echo $lead_info['id']; ?>')">
				<input type="button" name="save" class="margin_t margin_l1 btn_save float_r save" id="save_data_<?php echo $lead_info['id']; ?>" value="save">
				<div class="float_r margin_t ajax_loading_img_<?php echo $lead_info['id']; ?>" style="display:none;" ><img src="<?php echo $base; ?>images/ajax_loader.gif"></div>
			</div>
			<div class="clearfix"></div>
		</div>
 
 
 