<link rel="stylesheet" href="<?php echo $base; ?>css/admin/autocomplete.css" type="text/css" media="screen"  charset="utf-8" />
<link rel="stylesheet" href="<?php echo $base; ?>css/admin/jquery-ui-1.8.custom.css" type="text/css" media="screen"  charset="utf-8" />

<script src="<?php echo $base; ?>js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $base; ?>js/jquery-ui-custom-autosuggest.js" type="text/javascript" charset="utf-8"></script>    
 
 <div id="edit_data_<?php echo $lead_info['v_id']; ?>" class="open_box data update_lead_data" style="display:block">
 <div class="open_form_holder">
			<div>
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Full Name: </label>
							<div class="controls-input">
							<input type="text" class="input-large"  name="full_name" id="lead_full_name_<?php echo $lead_info['v_id']; ?>" value="<?php echo $lead_info['v_fullname']; ?>">
							</div>
						</div>
				</div>
				<div class="mail_set float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Email: </label>
							<div class="controls-input">
							<input type="text" class="input-large inline" name="email" id="lead_user_email_<?php echo $lead_info['v_id']; ?>" value="<?php echo $lead_info['v_email']; ?>">
							<input type="hidden" class="input-large inline" id="current_email_<?php echo $lead_info['v_id']; ?>" value="<?php echo $lead_info['v_email']; ?>">
							<?php
							if(!$lead_info['v_verified_email'])
							{ ?>
							<input type="checkbox" class="inline" name="<?php echo $lead_info['v_id']; ?>" id="check_verify_lead_email_<?php echo $lead_info['v_id']; ?>" value="0" onclick="verify_unverify_lead(this,'email');" />
							<span class="inline" id="verify_img_email_<?php echo $lead_info['v_id']; ?>"> <img src="<?php echo base_url(); ?>images/admin/error.gif"/> </span>
							<?php 
							} 
							else
							{ ?>
							<span class="inline" id="verify_img_email_<?php echo $lead_info['v_id']; ?>"> <img src="<?php echo base_url(); ?>images/admin/success.gif"/> </span>
							<input type="hidden" id="check_verify_lead_email_<?php echo $lead_info['v_id']; ?>" value="1">
							
							<?php }
							?>
							</div>
						</div>
				</div>
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Source: </label>
							<div class="controls-input">
	<input type="hidden" class="input-large" id="lead_source_<?php echo $lead_info['v_id']; ?>" value="<?php echo $lead_info['v_user_type'] ?>"/>
					<?php
					if($lead_info['v_user_type']=='site_user'){ 
					$lead_source="Site User"; }
					else if($lead_info['v_user_type']=='fb_login'){ $lead_source="FB Login(Site User)"; }
					else if($lead_info['v_user_type']=='android_user'){ $lead_source="Mobile App"; }
					else if($lead_info['v_user_type']=='event_user'){ $lead_source="Event Registration"; }
					else if($lead_info['v_user_type']=='fb_canvas'){ $lead_source="FB Application"; }
					else if($lead_info['v_user_type']=='college_request') { $lead_source="Request College"; }
					else{$lead_source="Other";};
					echo $lead_source;
					?>
													</div>
						</div>
				</div>
				<div class="mail_set float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Phone: </label>
							<div class="controls-input">
						<?php if($lead_info['v_phone']=='0' || $lead_info['v_phone']==NULL)
						{
						$mobile='';
						}
						else
						{
						$mobile=$lead_info['v_phone'];
						}?>
							<input type="text" class="input-large inline" name="phone" id="lead_user_phone_<?php echo $lead_info['v_id']; ?>" value="<?php echo $mobile; ?>">
							<input type="hidden" class="input-large inline" id="current_phone_<?php echo $lead_info['v_id']; ?>" value="<?php echo $lead_info['v_phone']; ?>">
							<?php
							if(!$lead_info['v_verified_phone'])
							{ ?>
							<input type="checkbox" class="inline" name="<?php echo $lead_info['v_id']; ?>" id="check_verify_lead_phone_<?php echo $lead_info['v_id']; ?>" value="0" onclick="verify_unverify_lead(this,'phone');" />
							<span class="inline" id="verify_img_phone_<?php echo $lead_info['v_id']; ?>"> <img src="<?php echo base_url(); ?>images/admin/error.gif"/> </span>
							<?php 
							} 
							else
							{ ?>
							<span class="inline" id="verify_img_phone_<?php echo $lead_info['v_id']; ?>"> <img src="<?php echo base_url(); ?>images/admin/success.gif"/> </span>
							<input type="hidden" id="check_verify_lead_phone_<?php echo $lead_info['v_id']; ?>" value="1">
							
							<?php }
							?>
							</div>
						</div>
				</div>
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">DOB: </label>
							<div class="controls-input select_width">
							<?php
					$dob=$lead_info['v_dob'];
					 if($dob=='' || $dob==NULL || $dob=='0')
					 {
					 $dob='0000-00-00';
					 }
					 $d_of_b=explode("-",$dob);	
					?> 
					<select name="year" id="year_<?php echo $lead_info['v_id']; ?>" class="margin-delta grid1 <?php //echo $class_year_name; ?>" >
					<option value="0" >Year</option> 
					<?php
					for($count_year=1920;$count_year<=2005;$count_year++)
					{ ?>
					<option  value="<?php echo $count_year; ?>" <?php if($count_year==$d_of_b[0]){ echo "selected"; } ?> ><?php echo $count_year; ?></option>
					<?php } ?>
					</select>
																		
						
					<select name="month"  id="month_<?php echo $lead_info['v_id']; ?>" class="grid1 margin_l6" >

					<option value="0" >Month</option> 

					<?php
					$arr_month = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'); 
					for($count_month=1;$count_month<=12;$count_month++)
					{
					?>
					<option value="<?php echo $count_month; ?>" <?php if($count_month==$d_of_b[1]){ echo "selected"; } ?>><?php echo $arr_month[$count_month-1]; ?></option>
					<?php } ?>
					</select>
				 
				 <select  name="date" id="date_<?php echo $lead_info['v_id']; ?>" class="grid1 margin_l6" >

					<option value="0" >Date</option> 
				<?php

				for($count_date=1;$count_date<=31;$count_date++)
				{
				?>
				<option value="<?php echo $count_date; ?>" <?php if($count_date==$d_of_b[2]){ echo "selected"; } ?> ><?php echo $count_date; ?></option>
				<?php } ?>
				</select>
							</div>
						</div>
				</div>
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Country: </label>
							<div class="controls-input select_width">
							<select name="country" id="country_<?php echo $lead_info['v_id']; ?>" onchange="fetchstates('<?php echo $country_result['country_id']; ?>')" class="select_width">
								<option value="">Select country</option>
					<?php foreach($country_res as $country_result) { 
					$selected='';
					if($country_result['country_id']==$lead_info['v_country']) { 
					$selected='selected';
					}
					?>	
					<option value="<?php echo $country_result['country_id']; ?>" <?php echo $selected; ?>><?php echo $country_result['country_name']; ?></option>
					<?php } ?>
							</select>
							</div>
						</div>
				</div>
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">State: </label>
							<div class="controls-input select_width">
							<select name="state" id="state_<?php echo $lead_info['v_id']; ?>" onchange="fetchcities(<?php echo $lead_info['v_id']; ?>);" class="select_width">
								<option> Select State </option>	
					
					<?php
					$state_list=$this->lead_tele_model->fetch_states_by_country_ajax($lead_info['v_country']);
					if($state_list!='0')
					{ 
					foreach($state_list as $state_list_ajax){
					$selected = '';
					if($state_list_ajax['state_id']==$lead_info['v_state'])
					{
					$selected='selected';
					}
					?>
					<option value="<?php echo $state_list_ajax['state_id']; ?>" <?php echo $selected; ?> ><?php echo $state_list_ajax['statename']; ?></option>
					<?php
					}
					}
					?>	
					
					</select>
							</div>
						</div>
				</div>
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">City: </label>
							<div class="controls-input select_width">
							<select name="city" id="city_<?php echo $lead_info['v_id']; ?>" class="select_width">
								<option> Select City </option>
								
						<?php
					$city_list=$this->lead_tele_model->fetch_cities_by_state_ajax($lead_info['v_state']);
					if($city_list!='0')
					{ 
					foreach($city_list as $city_list_ajax){
					$selected = '';
					if($city_list_ajax['city_id']==$lead_info['v_city'])
					{
					$selected='selected';
					}
					?>
					<option value="<?php echo $city_list_ajax['city_id']; ?>" <?php echo $selected; ?> ><?php echo $city_list_ajax['cityname']; ?></option>
					<?php
					}
					}
					?>		
					
					</select>
							</div>
						</div>
				</div>
				<div class="clearfix"></div>
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Enroll K12: </label>
							<div class="controls-input">
							<input type="text" class="input-large" id="lead_tele_enroll_<?php echo $lead_info['v_id']; ?>" value="<?php echo $lead_info['v_enroll_key']; ?>">
							</div>
						</div>
				</div>
				
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Interested Country: </label>
							
							<div id="intrested_countries" class="ui-helper-clearfix">
				<?php 			
				if($lead_info['v_interested_country']!='' && $lead_info['v_interested_country']!='0')
				{
				$studying_country_id_list=explode(",",$lead_info['v_interested_country']);
				foreach($studying_country_id_list as $studying_country_id_list_arr) { 
				if($studying_country_id_list_arr!='0' ){
				$cnt_name=$this->lead_tele_model->country_name_by_id($studying_country_id_list_arr);
				
				?>
							<span id="remove_country_<?php echo $studying_country_id_list_arr; ?>"><?php echo ucwords($cnt_name['country_name']); ?><a class="remove" onclick="removecountry(this.id)" href="javascript:" title="Remove <?php echo ucwords($cnt_name['country_name']); ?>" id="<?php echo $studying_country_id_list_arr; ?>">x</a><input type="hidden" name="country_ids[]" id="country_<?php echo $studying_country_id_list_arr; ?>" value="<?php echo $studying_country_id_list_arr; ?>"></span>
				<?php
				}}
				}			
				?>			
							<input id="auto_intrested_countries" type="text">
							</div>
						</div>
						<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
				
					<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Lead Status</label>
							<div class="controls-input">
							<select id="lead_status_<?php echo $lead_info['v_id']; ?>" name="lead_status_<?php echo $lead_info['v_id']; ?>" class="select_width">
							<option value="">--Please Select--</option>
						<option value="Valid" <?php if($lead_info['lead_status']=='Valid'){ ?> selected="selected" <?php } ?>>Valid</option>
						<optgroup label="Invalid Reason">
						<option value="None Given" <?php if($lead_info['lead_status']=='None Given'){ ?> selected="selected" <?php } ?>>None Given</option>
						<option value="Poor Candidate Data" <?php if($lead_info['lead_status']=='Poor Candidate Data'){ ?> selected="selected" <?php } ?>>Poor Candidate Data</option>
						<option value="Incorrect Academic Level" <?php if($lead_info['lead_status']=='Incorrect Academic Level'){ ?> selected="selected" <?php } ?>>Incorrect Academic Level</option>
						<option value="Program/School Fit" <?php if($lead_info['lead_status']=='Program/School Fit'){ ?> selected="selected" <?php } ?>>Program/School Fit</option>
						<option value="No Reply" <?php if($lead_info['lead_status']=='No Reply'){ ?> selected="selected" <?php } ?>>No Reply</option>
						<option value="Spammers/Agents" <?php if($lead_info['lead_status']=='Spammers/Agents'){ ?> selected="selected" <?php } ?>>Spammers/Agents</option>
						<option value="Invalid Contact Details" <?php if($lead_info['lead_status']=='Invalid Contact Details'){ ?> selected="selected" <?php } ?>>Invalid Contact Details</option>
						<option value="Looking For Different Country" <?php if($lead_info['lead_status']=='Looking For Different Country'){ ?> selected="selected" <?php } ?>>Looking For Different Country</option>
						<option value="Fail to meet filters" <?php if($lead_info['lead_status']=='Fail to meet filters'){ ?> selected="selected" <?php } ?>>Fail to meet filters</option>
						<option value="Duplicate" <?php if($lead_info['lead_status']=='Duplicate'){ ?> selected="selected" <?php } ?>>Duplicate</option>
						<option value="Incomplete" <?php if($lead_info['lead_status']=='Incomplete'){ ?> selected="selected" <?php } ?>>Incomplete</option>
						<option value="Cap met" <?php if($lead_info['lead_status']=='Cap met'){ ?> selected="selected" <?php } ?>>Cap met</option>
						<option value="Velocity limit met" <?php if($lead_info['lead_status']=='Velocity limit met'){ ?> selected="selected" <?php } ?>>Velocity limit met</option>
						<option value="Because of year" <?php if($lead_info['lead_status']=='Because of year'){ ?> selected="selected" <?php } ?>>Because of year</option>
						<option value="Unable to Establish Contact- 3 Attempts"<?php if($lead_info['lead_status']=='Unable to Establish Contact- 3 Attempts'){ ?> selected="selected" <?php } ?> >Unable to Establish Contact- 3 Attempts</option>
						<option value="Incorrect/Wrong Number" <?php if($lead_info['lead_status']=='Incorrect/Wrong Number'){ ?> selected="selected" <?php } ?>>Incorrect/Wrong Number</option>
						<option value="Hasn't Decided yet" <?php if($lead_info['lead_status']=="Hasn't Decided yet"){ ?> selected="selected" <?php } ?>>Hasn't Decided yet</option>
						<option value="Looking for Different Course" <?php if($lead_info['lead_status']=='Looking for Different Course'){ ?> selected="selected" <?php } ?>>Looking for Different Course</option>
						<option value="Not Looking for further studies" <?php if($lead_info['lead_status']=='Not Looking for further studies'){ ?> selected="selected" <?php } ?>>Not Looking for further studies</option>
						<option value="Due to Location of the colllege" <?php if($lead_info['lead_status']=='Due to Location of the colllege'){ ?> selected="selected" <?php } ?>>Due to Location of the colllege</option>
						<option value="Looking for Part-time Course" <?php if($lead_info['lead_status']=='Looking for Part-time Course'){ ?> selected="selected" <?php } ?>>Looking for Part-time Course</option>
						<option value="Poor Lead Quality" <?php if($lead_info['lead_status']=='Poor Lead Quality'){ ?> selected="selected" <?php } ?>>Poor Lead Quality</option>
						<option value="Looking for Lateral entry" <?php if($lead_info['lead_status']=='Looking for Lateral entry'){ ?> selected="selected" <?php } ?>>Looking for Lateral entry</option>
						<option value="Already applied/Enrolled" <?php if($lead_info['lead_status']=='Already applied/Enrolled'){ ?> selected="selected" <?php } ?>>Already applied/Enrolled</option>
						<option value="Language Problem" <?php if($lead_info['lead_status']=='Language Problem'){ ?> selected="selected" <?php } ?>>Language Problem</option>
						<option value="Just Browsing/Looking for information only" <?php if($lead_info['lead_status']=='Just Browsing/Looking for information only'){ ?> selected="selected" <?php } ?>>Just Browsing/Looking for information only</option>
						<option value="Looking for Different college" <?php if($lead_info['lead_status']=='Looking for Different college'){ ?> selected="selected" <?php } ?>>Looking for Different college</option>						
						</optgroup>

							</select>
							</div>
					</div>
				</div>
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Next Action</label>
							<div class="controls-input select_width">
							<select id="next_action_<?php echo $lead_info['v_id']; ?>" name="next_action_<?php echo $lead_info['v_id']; ?>" class="select_width">
							<option value="none">select</option>
							<option value="counsellor" <?php if($lead_info['v_next_action']=='counsellor') { echo "selected"; } ?> >Counsellor</option>
							<option value="paused" <?php if($lead_info['v_next_action']=='paused') { echo "selected"; } ?>>Paused</option>
							<option value="hot" <?php if($lead_info['v_next_action']=='hot') { echo "selected"; } ?>>Hot</option>
							</select>
							</div>
					</div>
				</div>
				
			
					<div class="float_l">
						<div class="control-group">
							<label class="label-control" for="input01"><img src="../images/admin/images/note_icon.png" class="note_img">Note:</label>
							<div class="controls-input">
							 <div class="v_notes">
								<?php if($note_info!='')
								{						
								 foreach($note_info as $n)
								  { echo $n['v_note']; ?>								  
								<div>
									
								<div class="notes_data"></div>
								<div class="notes_d"><?php $d=$n['updated_on'];
											$d1=strtotime($d);
											$date=date('h:m d M Y ',$d1);											
											echo $date;?></div>
								<div class="clearfix"></div>
								</div>
								<?php }} ?>
								
							 </div>							
							<textarea  class="input-xlarge" id="notes_<?php echo $lead_info['v_id']; ?>" rows="1"></textarea>											
							</div>
						</div>
					</div>
					<div class="span2 float_l">
						<div class="control-group">
							<button class="btn_img" name="<?php echo $lead_info['v_id']; ?>" id="save_data_<?php echo $lead_info['v_id']; ?>" value="save" onclick="save_form(this);">Save now</button>
							<button class="btn_img" name="cancel" id="cancel_data_<?php echo $lead_info['v_id']; ?>" value="Cancel" onclick="canceldata('<?php echo $lead_info['v_id']; ?>')">Cancel</button>
							<div class="float_r margin_t ajax_loading_img_<?php echo $lead_info['v_id']; ?>" style="display:none;" ><img src="<?php echo $base; ?>images/ajax_loader.gif"></div>
						</div>
					</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
 
 <!-- Form for Add Country, State and City -->	
	
	<div class="modal-lightsout" id="add-country">
				<div class="modal-profile" id="add-country1">
					<h2>Add Your Place</h2>
					<a href="#" title="Close profile window" class="modal-close-profile">
					<img src="<?php echo "$base$img_path/$admin"; ?>/close_model.png" class="closeimagesize" alt="Close window"/></a>
					<form action="" method="post" id="form_country" id="add_country_form" >
						<p>
							<label>Country:</label><br>
							<input type="text" size="30" class="text" name="country_model" id="country_model" value=""> 
							<label class="form_error"  id="country_error"></label>
						</p>
						<p>
							<label>State:</label><br>
							<input type="text" size="30" class="text" name="state_model" id="state_model" value=""> 
							<label class="form_error"  id="state_error"></label>
						</p>
						<p>
							<label>City:</label><br>
							<input type="text" size="30" class="text" name="city_model" id="city_model" value=""> 
							<label class="form_error"  id="city_error"></label>
						</p>
						<p>
							<input type="button" class="submit" name="addcountry" id="addcountry" value="Submit">
						</p>
					</form>
				</div>
			</div>
			
			<div class="modal-lightsout" id="add-state">
				<div class="modal-profile" id="add-state1">
					<h2>Add Your Place</h2>
					<a href="#" title="Close profile window" class="modal-close-profile">
					<img src="<?php echo "$base$img_path/$admin"; ?>/close_model.png" class="closeimagesize" alt="Close window"/></a>
						<form action="" method="post" id="form_state" id="add_state_form">
						<p>
							<label>Country:</label><br>
						<select class="text country_select margin_zero" name="country_model1" id="country_model1" >
										<option value="">Select Country</option>
							<?php foreach($country_res as $country) { ?>
										<option value="<?php echo $country['country_id']; ?>" ><?php echo $country['country_name']; ?></option>
										<?php } ?>
						</select>
							<label class="form_error"  id="country_error1"></label>
						
						</p>
							
						<p>
							<label>State:</label><br>
							<input type="text" size="30" class="text" name="state_model1" id="state_model1" value=""> 
								<label class="form_error"  id="state_error1"></label>
						
						</p>
						<p>
							<label>City:</label><br>
							<input type="text" size="30" class="text" name="city_model1" id="city_model1" value=""> 
								<label class="form_error"  id="city_error1"></label>
						
						</p>
						<p>
							<input type="button" class="submit" name="addstate" id="addstate" value="Submit">
						</p>
					</form>
					
				</div>
			</div>
			</div>
			
			
			
			
			
			
			
			
			
			
			
 
 <script>
 var current_lead_id = <?php echo $lead_info['v_id']; ?>;
 function save_form(control){
 var form_id = control.name;
 var fullname = $('#lead_full_name_'+form_id).val();
 var email = $('#lead_user_email_'+form_id).val();
 email=email.trim();
 var phone = $('#lead_user_phone_'+form_id).val();
 var phone_digit=phone.length;
 var country = $('#country_'+form_id).val();
 var state = $('#state_'+form_id).val();
 var city = $('#city_'+form_id).val();
 var enroll = $('#lead_tele_enroll_'+form_id).val();
 var notes = $('#notes_'+form_id).val();
 var year = $('#year_'+form_id).val();
 var month = $('#month_'+form_id).val();
 var date = $('#date_'+form_id).val(); 
 var lead_source = $("#lead_source_"+form_id).val();
 var lead_status= $('#lead_status_'+form_id).val();
 var next_action=$('#next_action_'+form_id).val();
 var current_email = $("#current_email_"+form_id).val();
 current_email=current_email.trim();
 var current_phone= $("#current_phone_"+form_id).val();
 
 current_phone=current_phone.trim();
 var p_err=0;
 var success=1;
 var interested_cont=0;
 $("input[name^=country_ids]").each(function() {
var val=$(this).val();
						val=val.trim();
						interested_cont=interested_cont+','+val;
						
});
 if(year==0 || month==0 || date==0)
 {
	success=0;
	if(year==0)
	{
	$("#year_"+form_id).css("border-color","red");
	}
	else
	{
	$("#year_"+form_id).css("border-color","#ccc");
	}
	if(month==0)
	{
	$("#month_"+form_id).css("border-color","red");
	}
	else
	{
	$("#month_"+form_id).css("border-color","#ccc");
	}
	if(date==0)
	{
	$("#date_"+form_id).css("border-color","red");
	}
	else
	{
	$("#date_"+form_id).css("border-color","#ccc");
	}
	if(year==0 && month==0 && date==0)
	{
	success=1;
	$("#year_"+form_id).css("border-color","#ccc");
	$("#month_"+form_id).css("border-color","#ccc");
	$("#date_"+form_id).css("border-color","#ccc");
	}
	
}
 else
 {
 success=1;
 $("#year_"+form_id).css("border-color","#ccc");
	$("#month_"+form_id).css("border-color","#ccc");
	$("#date_"+form_id).css("border-color","#ccc");
 }
if(!success)
 {
 }
else if((phone_digit<10 && phone_digit>0)  || phone_digit>10)
{
 
	$("#lead_user_phone_"+form_id).css("border-color","red");
	$('#error_message').html("Phone number should be 10 digit");
	$('#error_message').css("display","block");
	success=0;
}	
else if(validate_email(email)=='0')
{
$("#lead_user_phone_"+form_id).css("border-color","#ccc");
success=0;
$("#lead_user_email_"+form_id).css("border-color","red");
}
else if(current_email!=email || current_phone!=phone)
{
$("#lead_user_email_"+form_id).css("border-color","#ccc");
var dataemail_phone=
{
'email':email,
'phone':phone,
'cur_email':current_email,
'cur_phone':current_phone
};
$.ajax({
type: "POST",
url: "<?php echo $base; ?>adminleads/chk_email_phone_exists",
async: false,
data: dataemail_phone,
cache: false,
success: function(msg)
{
if(msg=='1')
{
alert("Can not save this Lead.This Email or Phone No is already Exists");
success=0;
}
else
{
success=1;
}
}
});
}

if($('#check_verify_lead_phone_'+form_id).val()=='1')
{
var verified_phone=1;
}
else
{
var verified_phone=0;
}
if($('#check_verify_lead_email_'+form_id).val()=='1')
{
verified_email=1;
}
else
{
verified_email=0;
}
if(success)
{
var data={
current_lead_id :current_lead_id,
interested_cont :interested_cont,
fullname: fullname,
email : email,
phone:phone,
country:country,
state:state,
city :city,
enroll:enroll,
notes:notes,
year:year,
month:month,
date:date,
lead_source:lead_source,
lead_status:lead_status,
next_action:next_action,
verified_email:verified_email,
verified_phone:verified_phone
};
 $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>adminleads/update_verify_leads",
	   async:false,
	   data: data,
	   cache: false,
	   success: function(msg)
	   {
		/* if($("#check_verify_lead_email_"+current_lead_id).is(':checked'))
		{
		$("#span_not_verified_"+current_lead_id).css("color","green");
		$("#span_not_verified_"+current_lead_id).html('Verified');
		}
		if($("#check_verify_lead_phone_"+current_lead_id).is(':checked'))
		{
		$("#span_not_verified_phone_"+current_lead_id).css("color","green");
		$("#span_not_verified_phone_"+current_lead_id).html('Verified');
		} */
		
	    $("#edit_data_"+form_id).hide(1000);
	    $('#edit_data_'+form_id).replaceWith('');
	    $('#data_'+form_id).show();
	   
		$("#lead_fname_"+current_lead_id).html(fullname);
		$("#lead_phone_"+current_lead_id).html(phone);
		$("#lead_email_"+current_lead_id).html(email);
		if(verified_email=='1')
		{
		 $("#span_verified_email_"+current_lead_id+ ' img').attr('src','<?php echo $base; ?>images/admin/success.gif');
		}
		else
		{
		 $("#span_verified_email_"+current_lead_id+ ' img').attr('src','<?php echo $base; ?>images/admin/error.gif');
		
		}
		if(verified_phone=='1')
		{
		$("#span_verified_phone_"+current_lead_id+ ' img').attr('src','<?php echo $base; ?>images/admin/success.gif');
		}
		else
		{
		$("#span_verified_phone_"+current_lead_id+ ' img').attr('src','<?php echo $base; ?>images/admin/error.gif');
		
		}
		//$("#content_verify_message").css("display","none");
		$("#content_msg").css("display","block");
		
	   }
});
}
 //var interested_country = $('#interested_country').val();
 //alert(interested_country);
 }
 
function fetchcountry(cid)
{
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>admin/country_list_ajax",
   data: 'country_id='+cid,
   cache: false,
   async:false,
   success: function(msg)
   {
   // $('#state').attr('disabled', false);
	$('#country').html(msg);
   }
   });
}

function fetchstates(sid)
{
var cont_id = "country_"+sid;
var stid=sid;
var cid;
if(sid=='-1')
{
stid='0';
cid=$("#"+cont_id).val();
}
else
{
var cid=$("#"+cont_id).val();
}
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>admin/state_list_ajax/",
   data: 'country_id='+cid+'&sel_state_id='+stid,
   cache: false,
   success: function(msg)
   {
    if(sid=='-1')
	{
	$('#state_model2').attr('disabled', false);
	$('#state_model2').html(msg);
	}
	else
	{
    $('#state_'+sid).attr('disabled', false);
	$('#state_'+sid).html(msg);

	}
	$('#city_'+sid).html('<option value="0">select city</option>')
   }
   });
 }



function fetchcities(state_id,cityid)
{
var stateID = "state_"+state_id;
var cityID = "city_"+state_id;

state_id=$("#"+stateID).val();
 $.ajax({
   type: "POST",
   url: "<?php echo $base; ?>admin/city_list_ajax/",
   data: 'state_id='+state_id+'&sel_city_id='+cityid,
   cache: false,
   success: function(msg)
   {
    $('#'+cityID).attr('disabled', false);
	$('#'+cityID).html(msg);
   }
   });  
}

function verify_unverify_lead(val,type)
{
if(type=='email' && val.value=='0')
 {
 $('#verify_img_email_'+val.name+' img' ).attr('src','<?php echo $base; ?>images/admin/success.gif');
 $('#check_verify_lead_email_'+val.name).val('1');
 }
 else if(type=='email' && val.value=='1')
 {
 $('#verify_img_email_'+val.name+' img' ).attr('src','<?php echo $base; ?>images/admin/error.gif');
 $('#check_verify_lead_email_'+val.name).val('0');
 }
 else if(type=='phone' && val.value=='0')
 {
 $('#verify_img_phone_'+val.name+' img' ).attr('src','<?php echo $base; ?>images/admin/success.gif');
 $('#check_verify_lead_phone_'+val.name).val('1');
 }
 else if(type=='phone' && val.value=='1')
 {
 $('#verify_img_phone_'+val.name+' img' ).attr('src','<?php echo $base; ?>images/admin/error.gif');
 $('#check_verify_lead_phone_'+val.name).val('0');
 }
}

 $(function(){
				var suggest_country_ids = new Array();
				//attach autocomplete
				$("#auto_intrested_countries").autocomplete({
					
					//define callback to format results
					source: function(req, add){
						var c_id_list=0;
						$("input[name^=country_ids]").each(function() {
						var val=$(this).val();
						val=val.trim();
						c_id_list=c_id_list+','+val;
					});
						//pass request to server
						$.getJSON("<?php echo $base; ?>adminleads/get_country_list/"+c_id_list+"?callback=?", req, function(data) {
							
							//create array for response objects
							var suggestions = [];
							
							//process response
							$.each(data, function(i, val){	
								suggestions.push(val.name);
								suggest_country_ids[val.name]=val.id;
							});
							
							//pass array to callback
							add(suggestions);
						});
					},
					
					//define select handler
					select: function(e, ui) {
						//create formatted friend
						var country_name = ui.item.value;
						var country_id=suggest_country_ids[country_name];
						var exist_int_c_list=$('#intrested_country_list').val();
						
							var span = $("<span id='remove_country_"+country_id+"' onclick='removecountry("+country_id+")'>").text(country_name);
							var a = $("<a>").addClass("remove").attr({
								href: "javascript:",
								title: "Remove " + country_name,
								id: country_id
							}).text("x");
							var h= $('<input/>',{type:'hidden',name:'country_ids[]',id:'country_'+country_id,value:country_id});
							
							//var h='<input type="hidden" name="country_ids" id="country" value="">';	
							a.appendTo(span);
						  h.appendTo(span);
						//add friend to friend div
//auto_intrested_countries').val('');
						span.insertBefore("#auto_intrested_countries");
						
						//alert("hi");
					},
					
					//define select handler
					change: function() {
						
						//prevent 'to' field being updated and correct position
						$("#auto_intrested_countries").val("").css("top", 2);
					}
				});
				
				//add click handler to friends div
				$("#intrested_countries").click(function(){
					
					//focus 'to' field
					$("#auto_intrested_countries").focus();
				});
				
				//add live handler for clicks on remove links
							
			});
			function removecountry(id){
					$('#remove_country_'+id).replaceWith('');
					//$(this).parent().remove();
					//correct 'to' field position
					if($("#intrested_countries span").length === 0) {
					$("#auto_intrested_countries").css("top", 0);
					}				
				}
function validate_email(email)
{
 var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   if(reg.test(email) == false) {
      return 0;
   }
}
				
 </script>