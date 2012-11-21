<script src="<?php echo $base; ?>js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $base; ?>js/jquery-ui-custom-autosuggest.js" type="text/javascript" charset="utf-8"></script> 
<link rel="stylesheet" href="<?php echo $base; ?>css/admin/autocomplete.css" type="text/css" media="screen"  charset="utf-8" />
<link rel="stylesheet" href="<?php echo $base; ?>css/admin/jquery-ui-1.8.custom.css" type="text/css" media="screen"  charset="utf-8" /> 
<script type="text/javascript">
 var globalid=0;
$(document).ready(function(){
 $(".slidingDiv").hide();
 $(".load").hide();
	
    $('.show_hide').click(function(){
	//$(".hiding-effect").hide();
		//alert($(this).parent().prev().find('.slidingDiv').html());
		if($(this).parent().prev().find('.slidingDiv').is(':visible'))
		{
		$("#view_more_"+globalid).hide();
		$(".slidingDiv").slideUp('slow');
		//$(".hiding-effect").show();
		}
		else
		{
		//$(".hiding-effect").hide();
		$("#view_more_"+globalid).hide();
		$(".slidingDiv").slideUp('slow');
		//$(".hiding-effect").show();
		$(this).parent().prev().find('.slidingDiv').slideToggle();
		}
	
    });
	$('.abc').click(function(){
		  globalid=$(this).attr('id');
	      $("#img_"+globalid).show();
	      setTimeout('abc()',1000);
		
    });
	
	 $('.input-xlarge').keypress(function(e){
	
			if ( event.which == 13 ) {
			alert('enter');
			//event.preventDefault();
			}
    });
 
});
 function abc()
 {
 $("#img_"+globalid).hide();
 $("#view_more_"+globalid).show(1000);
 }
</script>
	<div id="content" class="data_shif">

		<div class="counsel_next_bg span13 margin_delta">
			<div class="float_l data2 margin_delta">
				<img src="../images/user_model.png" class="user_img"/>
			</div>
			<div class="float_r data12">
				<div class="float_l span16 margin_delta">
					<div class="control-group1">
						<label class="control-data12" for="input01">First Name: </label>
						<div class="input-data12">
							<span   class="selector"><?php echo $verify_teleleads['v_fullname'];  ?></span>
							<input type="hidden" id="lead_id" value="<?php echo $verify_teleleads['v_lead_id']; ?>"/>
							<input type="text" id="name" name="name" class="edit_box large_data" value="<?php echo $verify_teleleads['v_fullname'];  ?>" style="display:none"/>
						</div>
					</div>
				</div>
				<div class="float_l span16">
					<div class="control-group1">
						<label class="control-data12" for="input01">DOB:</label>
						<div class="input-data12">
						<?php 
					 $dob=$verify_teleleads['v_dob'];
					 if($dob=='' || $dob==NULL || $dob=='0' || $dob=='0-0-0' || $dob=='0000-00-00')
					 {
					 $dob='Not Available';
					 }
					 ?>
							<span  class="dob selector"><?php echo $dob; ?> </span>					
							<?php
					 $dob=$verify_teleleads['v_dob'];
					 if($dob=='' || $dob==NULL || $dob=='0' || $dob=='0-0-0')
					 {
					 $dob='0000-00-00';
					 }
					 $d_of_b=explode("-",$dob);	
					?> 
					<select name="year" id="year" class="margin-delta grid1 edit_box " style="display:none" >
					<option value="0" >Year</option> 
					<?php
					for($count_year=1920;$count_year<=2005;$count_year++)
					{ ?>
					<option  value="<?php echo $count_year; ?>" <?php if($count_year==$d_of_b[0]){ echo "selected"; } ?> ><?php echo $count_year; ?></option>
					<?php } ?>
					</select>
																		
						
					<select name="month"  id="month" class="grid1 margin_l6 edit_box" style="display:none">
					<option value="0" >Month</option> 
					<?php
					$arr_month = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'); 
					for($count_month=1;$count_month<=12;$count_month++)
					{
					?>
					<option value="<?php echo $count_month; ?>" <?php if($count_month==$d_of_b[1]){ echo "selected"; } ?>><?php echo $arr_month[$count_month-1]; ?></option>
					<?php } ?>
					</select>
				 
				 <select  name="date" id="date" class="grid1 margin_l6 edit_box" style="display:none">
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
				<div class="float_l span16">
					<div class="control-group1">
						<label class="control-data12" for="input01"> Email: </label>
						<div class="input-data12">
						
						<?php
						$v_email=$verify_teleleads['v_email'];
						if($v_email=='') 
						{
						$v_email='Not Available';
						}
						?>
						<span class="selector"><?php echo $v_email;  ?> </span>
						<input type="text"name="email" id="email" class="edit_box large_data" value="<?php echo $verify_teleleads['v_email'];  ?>" style="display:none"/>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="bottom_line_second margin_b"></div>
				<div class="float_l span16 margin_delta">
					<div class="control-group1">
						<label class="control-data12" for="input01">Country: </label>
						<div class="input-data12">
						<?php 
						$country_name=$verify_teleleads['country_name'];
						if($verify_teleleads['country_name']=='')
						{
						$country_name='Not Available';
						}
						?>
						<span class="country_drop selector"><?php echo $country_name;  ?> </span>
						<Select  name="country" id="country_id" class='edit_box large_data input-large_set' onchange="fetchstates()" style="display:none">
						<option value="">Select Country</option> 
						<?php foreach($country as $cntry){
						$selected='';
						if($cntry['country_name']==$verify_teleleads['country_name']) { 
						$selected='selected';
						}
						 ?>
						<option value="<?php echo $cntry['country_id']; ?>" <?php echo $selected;?> ><?php echo $cntry['country_name']; ?></option>
						<?php } ?>						
						</select>
						</div>
					</div>
				</div>
				<div class="float_l span16">
					<div class="control-group1">
						<?php 
						$state_name=$verify_teleleads['statename'];
						if($verify_teleleads['statename']=='')
						{
						$state_name='Not Available';
						}
						?>
						<label class="control-data12" for="input01">State: </label>
						<div class="input-data12">
						<span class="state_drop selector"><?php echo $state_name; ?> </span>			
						<Select  name="state" id="state_id" class='edit_box large_data input-large_set' onchange="fetchcities()" style="display:none">
						<option value="">Select state</option>
						
					<?php
					
					if($state!='0')
					{ 
						foreach($state as $st){
						$selected = '';
						if($st['statename']==$verify_teleleads['statename'])
						{
						$selected='selected';
						?>
						<option value="<?php echo $st['state_id']; ?>" <?php echo $selected; ?> ><?php echo $st['statename']; ?></option>
						<?php
						}
						
						}
					}
					?>	
					
						</select>
						</div>
					</div>
				</div>
				<div class="float_l span16">
					<div class="control-group1">
						<label class="control-data12" for="input01"> City: </label>
						<div class="input-data12">
						<?php 
						$city_name=$verify_teleleads['cityname'];
						if($verify_teleleads['cityname']=='')
						{
						$city_name='Not Available';
						}
						?>
						<span class="city_drop selector"><?php echo $city_name;  ?> </span>
						<Select  name="city" id="city_id" class='edit_box large_data input-large_set' style="display:none">
						<option value="">Select City</option>								
						<?php
						if($city!='0')
						{ 
							foreach($city as $ct){
							$selected = '';
							if($ct['cityname']==$verify_teleleads['cityname'])
							{
							$selected='selected';
							?>
							<option value="<?php echo $ct['city_id']; ?>" <?php echo $selected; ?> ><?php echo $ct['cityname']; ?></option>
							<?php
							}					
							}
						}
					?>							
						</select>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="bottom_line_second margin_b"></div>
				<div class="float_l span16 margin_delta">
					<div class="control-group1">
						<label class="control-data12" for="input01">Phone: </label>
						<div class="input-data12">
						<?php 
						$ver_phone=$verify_teleleads['v_phone'];
						if($ver_phone=='')
						{
						$ver_phone='Not Available';
						}
						?>
						<span  class="selector"><?php echo $ver_phone;  ?> </span>
						<input type="text" name="phone" id="phone" class="edit_box large_data" value="<?php echo $verify_teleleads['v_phone']; ?>" style="display:none"/>
						</div>
					</div>
				</div>
				<div class="float_l span16">
					<div class="control-group1">
						<label class="control-data12" for="input01"> Enroll K12: </label>
						<div class="input-data12">
						<?php 
						$v_enroll_key=$verify_teleleads['v_enroll_key'];
						if($v_enroll_key=='')
						{
						$v_enroll_key='Not Available';
						}
						?>
						<span  class="selector"><?php echo $v_enroll_key;  ?> </span>
						<input name="enroll" id="enroll" class="edit_box large_data" value="<?php echo $verify_teleleads['v_enroll_key']; ?>" style="display:none"/>
						</div>
					</div>
				</div>
				<div class="float_l span16">
				<div class="control-group1">
				<label class="control-data12" for="input01"> Intrested country: </label>
				<div id="intrested_countries" class="ui-helper-clearfix edit_box" style="width: 178px;">
					<?php 			
					if($verify_teleleads['v_interested_country']!='' && $verify_teleleads['v_interested_country']!='0')
					{
					$int_country=explode(",",$verify_teleleads['v_interested_country']);
					foreach($int_country as $int_country_id_list) { 
					if($int_country_id_list!='0' ){
					$cnt_name=$this->lead_tele_model->country_name_by_id($int_country_id_list);				
					?>
					<span id="remove_country_<?php echo $int_country_id_list; ?>" class="edit_box large_data"><?php echo ucwords($cnt_name['country_name']); ?><a class="remove edit_box" onclick="removecountry(this.id)" href="javascript:" title="Remove <?php echo ucwords($cnt_name['country_name']); ?>" id="<?php echo $int_country_id_list; ?>">x</a><input type="hidden" name="country_ids[]" id="country_<?php echo $int_country_id_list; ?>" value="<?php echo $int_country_id_list; ?>"></span>
					<?php
					}}
					}			
					?>			
					<input id="auto_intrested_countries" class="edit_box large_data" type="text" style="display:none">
				</div>
				</div>
				</div>
				<div class="clearfix"></div>
				<div class="bottom_line_second"></div>
			</div>
			
			<div class="float_l data7 margin_delta">
				<div class="control-group1">
					<label class="big-data padding_alpha" for="input01">Intrested in courses: </label>
					<div class="input-left">
					<span class="courses selector">
					<?php 
					$courses=array();
					if($verify_teleleads['v_program']!='0' && $verify_teleleads['v_program']!='' && $verify_teleleads['v_program']!='null')
					{//echo 'hhh'.$verify_teleleads['v_program'];
						$courses=explode(",",$verify_teleleads['v_program']);
						$count=count($courses);					
						for($i=0;$i<$count;$i++)
						{ 
							$sub=$this->admin_counsellor_model->fetch_program_model($courses[$i]); 
							//print_r($sub);
							echo $sub[0]['course_name'];if($i<$count-1){ echo ',';}
						}
					}
					else
					{
					echo "Not Available";
					}
					?>
					</span>
						<Select name="courses[]" id="courses" multiple="multiple" class='edit_box' style="height: 92px;display:none">
						 						
						<?php foreach($program_parent as $prog)
						{ ?>
						<optgroup label="<?php echo $prog['program_parent_name'];?>">
						 <?php 						 
						 $program=$this->admin_counsellor_model->program_model($prog['prog_parent_id']);					
						 if(count($program)>0)
						 {
							 foreach($program as $course)
							 {?>
							 <option value="<?php echo $course['prog_id'];?>" <?php if(in_array($course['prog_id'],$courses)) { ?> selected <?php } ?>><?php echo $course['course_name'];?></option>	
							 <?php
							 }
						 } 
						 
						 ?>
						 </optgroup>
						 <?php
						}
						?>
						</select>
						
					</div>
				</div>
			</div>
			<div class="float_l data7">
				<div class="control-group21">
					<label class="big-data padding_alpha" for="input01">When do you want to begin:  </label>
					<div class="input-left">
				<span name="begin" id="begin" class="selector2 selector"><?php echo $verify_teleleads['v_enroll_date'];?></span>
						<input name="enroll_date" id="enroll_date" class="edit_box large_box" value="<?php echo $verify_teleleads['v_enroll_date'];  ?>" style="display:none"/>
					</div>
				</div>
				<div class="control-group1" style="margin_t">
					<label class="big-data padding_alpha" for="input01">The last institution that you attended:  </label>
					<div class="input-left">
						<span class="selector2 selector"><?php echo $verify_teleleads['v_last_institute'];  ?></span>
							<input name="attended" id="attended" class="edit_box large_box" value="<?php echo $verify_teleleads['v_last_institute'];  ?>" style="display:none"/>
						
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="bottom_line1"></div>
			<div class="margin_delta">
				<div class="float_l data9">
				<label class="big-data1 padding_alpha" for="input01">Exam 1:  </label>
				<div class="input-left1">
						<?php 
						$ver_acedmic_exam_score_type1=$verify_teleleads['v_acedmic_exam_score_type1'];
						if($ver_acedmic_exam_score_type1=='' || $ver_acedmic_exam_score_type1=='0')
						{
						$ver_acedmic_exam_score_type1='Not Available';
						}
						?>
					<span class="selector2 selector"><?php echo $ver_acedmic_exam_score_type1;  ?></span>				
					<select id="exam1"  class="edit_box large_data_value" style="display:none">
					<option value="">Select</option>
					<option value="SAT" <?php if($verify_teleleads['v_acedmic_exam_score_type1']=='SAT'){ ?> selected <?php } ?>>SAT</option>
					<option value="ACT" <?php if($verify_teleleads['v_acedmic_exam_score_type1']=='ACT'){ ?> selected <?php } ?>>ACT</option>
					<option value="GRE" <?php if($verify_teleleads['v_acedmic_exam_score_type1']=='GRE'){ ?> selected <?php } ?>>GRE</option>
					<option value="GMAT" <?php if($verify_teleleads['v_acedmic_exam_score_type1']=='GMAT'){ ?> selected <?php } ?>>GMAT</option>	
					</select>					
				</div>			
				</div>
			<div class="float_l data9">
			<label class="big-data1 padding_alpha" for="input01">Score Exam 1:  </label>
			<div class="input-left1">
						<?php 
						$ver_acedmic_exam_score1=$verify_teleleads['acedmic_exam_score1'];
						if($ver_acedmic_exam_score1=='' || $ver_acedmic_exam_score1=='0')
						{
						$ver_acedmic_exam_score1='Not Available';
						}
						?>
				<span class="selector2 selector"><?php echo $ver_acedmic_exam_score1;  ?></span>						
				<input type="text" id="exam1_score" class="edit_box large_data_value"  value="<?php echo $verify_teleleads['acedmic_exam_score1']; ?>" style="display:none">		
			</div>			
			</div>
			<div class="float_l data9">
			<label class="big-data1 padding_alpha" for="input01">Exam 2:  </label>
			<div class="input-left1">
						<?php 
						$ver_acedmic_exam_score_type2=$verify_teleleads['v_acedmic_exam_score_type2'];
						if($ver_acedmic_exam_score_type2=='' || $ver_acedmic_exam_score_type2=='0')
						{
						$ver_acedmic_exam_score_type2='Not Available';
						}
						?>
				<span class="selector2 selector"><?php echo $ver_acedmic_exam_score_type2;  ?></span>				
				<select id="exam2"  class="edit_box large_data_value" style="display:none">
				<option value="">Select</option>
				<option value="SAT" <?php if($verify_teleleads['v_acedmic_exam_score_type2']=='SAT'){ ?> selected <?php } ?>>SAT</option>
				<option value="ACT" <?php if($verify_teleleads['v_acedmic_exam_score_type2']=='ACT'){ ?> selected <?php } ?>>ACT</option>
				<option value="GRE" <?php if($verify_teleleads['v_acedmic_exam_score_type2']=='GRE'){ ?> selected <?php } ?>>GRE</option>
				<option value="GMAT" <?php if($verify_teleleads['v_acedmic_exam_score_type2']=='GMAT'){ ?> selected <?php } ?>>GMAT</option>	
				</select>					
			</div>			
			</div>
			<div class="float_l data9">
				<label class="big-data1 padding_alpha" for="input01">Score Exam 2:  </label>
			<div class="input-left1">
						<?php 
						$ver_acedmic_exam_score2=$verify_teleleads['v_acedmic_exam_score2'];
						if($ver_acedmic_exam_score2=='' || $ver_acedmic_exam_score2=='0')
						{
						$ver_acedmic_exam_score2='Not Available';
						}
						?>
				<span class="selector2 selector"><?php echo $ver_acedmic_exam_score2;  ?></span>						
				<input type="text" id="exam2_score" class="edit_box large_data_value"  value="<?php echo $verify_teleleads['v_acedmic_exam_score2']; ?>" style="display:none" />		
			</div>			
			</div>
			<div class="clearfix"></div>
			</div>
			<div class="bottom_line1"></div>
			<div class="float_l data7 margin_delta">
				<div class="control-group1">
					<label class="big-data padding_alpha" for="input01">Other exams if any:  </label>
					<div class="input-left">
						<?php 
						$ver_other_exam_score=$verify_teleleads['v_other_exam_score'];
						if($ver_other_exam_score=='' || $ver_other_exam_score=='0')
						{
						$ver_other_exam_score='Not Available';
						}
						?>
						<span  class="selector2 selector"><?php echo $verify_teleleads['v_other_exam'];  ?></span>
						<input name="other_exam_name" id="other_exam_name"  class="edit_box small_box" value="<?php echo $verify_teleleads['v_other_exam']; ?>" style="display:none"/>
						<span  class="selector2 selector"><?php echo $ver_other_exam_score;  ?></span>
						
						<input name="other_exam_score" id="other_exam_score"  class="edit_box small_box" value="<?php echo $verify_teleleads['v_other_exam_score']; ?>" style="display:none"/>
					</div>
				</div>
			</div>
			<div class="float_l data7">
				<div class="control-group1">
					<label class="big-data padding_alpha" for="input01">Status:  </label>
					<div class="input-left">
					   <?php 
						$ver_status=$verify_teleleads['v_status'];
						if($ver_status=='' || $ver_status=='0')
						{
						$ver_status='Not Available';
						}
						?>
						<span class="Status selector"><?php echo $ver_status;  ?></span>						
						<select name="status" id="status"  class="edit_box large_box" style="display:none">
						<option value="">--Please Select--</option>
						<option value="Valid" <?php if($verify_teleleads['v_status']=='Valid'){ ?> selected="selected" <?php } ?>>Valid</option>
						<optgroup label="Invalid Reason">
						<option value="None Given" <?php if($verify_teleleads['v_status']=='None Given'){ ?> selected="selected" <?php } ?>>None Given</option>
						<option value="Poor Candidate Data" <?php if($verify_teleleads['v_status']=='Poor Candidate Data'){ ?> selected="selected" <?php } ?>>Poor Candidate Data</option>
						<option value="Incorrect Academic Level" <?php if($verify_teleleads['v_status']=='Incorrect Academic Level'){ ?> selected="selected" <?php } ?>>Incorrect Academic Level</option>
						<option value="Program/School Fit" <?php if($verify_teleleads['v_status']=='Program/School Fit'){ ?> selected="selected" <?php } ?>>Program/School Fit</option>
						<option value="No Reply" <?php if($verify_teleleads['v_status']=='No Reply'){ ?> selected="selected" <?php } ?>>No Reply</option>
						<option value="Spammers/Agents" <?php if($verify_teleleads['v_status']=='Spammers/Agents'){ ?> selected="selected" <?php } ?>>Spammers/Agents</option>
						<option value="Invalid Contact Details" <?php if($verify_teleleads['v_status']=='Invalid Contact Details'){ ?> selected="selected" <?php } ?>>Invalid Contact Details</option>
						<option value="Looking For Different Country" <?php if($verify_teleleads['v_status']=='Looking For Different Country'){ ?> selected="selected" <?php } ?>>Looking For Different Country</option>
						<option value="Fail to meet filters" <?php if($verify_teleleads['v_status']=='Fail to meet filters'){ ?> selected="selected" <?php } ?>>Fail to meet filters</option>
						<option value="Duplicate" <?php if($verify_teleleads['v_status']=='Duplicate'){ ?> selected="selected" <?php } ?>>Duplicate</option>
						<option value="Incomplete" <?php if($verify_teleleads['v_status']=='Incomplete'){ ?> selected="selected" <?php } ?>>Incomplete</option>
						<option value="Cap met" <?php if($verify_teleleads['v_status']=='Cap met'){ ?> selected="selected" <?php } ?>>Cap met</option>
						<option value="Velocity limit met" <?php if($verify_teleleads['v_status']=='Velocity limit met'){ ?> selected="selected" <?php } ?>>Velocity limit met</option>
						<option value="Because of year" <?php if($verify_teleleads['v_status']=='Because of year'){ ?> selected="selected" <?php } ?>>Because of year</option>
						<option value="Unable to Establish Contact- 3 Attempts"<?php if($verify_teleleads['v_status']=='Unable to Establish Contact- 3 Attempts'){ ?> selected="selected" <?php } ?> >Unable to Establish Contact- 3 Attempts</option>
						<option value="Incorrect/Wrong Number" <?php if($verify_teleleads['v_status']=='Incorrect/Wrong Number'){ ?> selected="selected" <?php } ?>>Incorrect/Wrong Number</option>
						<option value="Hasn't Decided yet" <?php if($verify_teleleads['v_status']=="Hasn't Decided yet"){ ?> selected="selected" <?php } ?>>Hasn't Decided yet</option>
						<option value="Looking for Different Course" <?php if($verify_teleleads['v_status']=='Looking for Different Course'){ ?> selected="selected" <?php } ?>>Looking for Different Course</option>
						<option value="Not Looking for further studies" <?php if($verify_teleleads['v_status']=='Not Looking for further studies'){ ?> selected="selected" <?php } ?>>Not Looking for further studies</option>
						<option value="Due to Location of the colllege" <?php if($verify_teleleads['v_status']=='Due to Location of the colllege'){ ?> selected="selected" <?php } ?>>Due to Location of the colllege</option>
						<option value="Looking for Part-time Course" <?php if($verify_teleleads['v_status']=='Looking for Part-time Course'){ ?> selected="selected" <?php } ?>>Looking for Part-time Course</option>
						<option value="Poor Lead Quality" <?php if($verify_teleleads['v_status']=='Poor Lead Quality'){ ?> selected="selected" <?php } ?>>Poor Lead Quality</option>
						<option value="Looking for Lateral entry" <?php if($verify_teleleads['v_status']=='Looking for Lateral entry'){ ?> selected="selected" <?php } ?>>Looking for Lateral entry</option>
						<option value="Already applied/Enrolled" <?php if($verify_teleleads['v_status']=='Already applied/Enrolled'){ ?> selected="selected" <?php } ?>>Already applied/Enrolled</option>
						<option value="Language Problem" <?php if($verify_teleleads['v_status']=='Language Problem'){ ?> selected="selected" <?php } ?>>Language Problem</option>
						<option value="Just Browsing/Looking for information only" <?php if($verify_teleleads['v_status']=='Just Browsing/Looking for information only'){ ?> selected="selected" <?php } ?>>Just Browsing/Looking for information only</option>
						<option value="Looking for Different college" <?php if($verify_teleleads['v_status']=='Looking for Different college'){ ?> selected="selected" <?php } ?>>Looking for Different college</option>						
						</optgroup>
						</select>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="bottom_line1"></div>
				<div class="float_l data7 margin_delta">
				<div class="control-group1">
					<label class="big-data padding_alpha" for="input01">Current education level:  </label>
					<div class="input-left">
						<?php 
						$ver_current=$verify_teleleads['current'];
						if($ver_current=='' || $ver_current=='0')
						{
						$ver_current='Not Available';
						}
						?>
						<span  class="current selector"><?php echo $ver_current;  ?></span>
						<select name="c_educ_level" id="c_educ_level" class="edit_box large_box" style="display:none">
						<option value="">Select Level</option>
						<?php foreach($program_level as $level)
						{?>
						<option value="<?php echo $level['prog_edu_lvl_id']; ?>" <?php if($level['educ_level']==$verify_teleleads['current']) { ?> selected <?php } ?> ><?php echo $level['educ_level'];?></option>
						<?php } ?>
						</select>					
						</div>
				</div>
			</div>
			<div class="float_l data7">
				<div class="control-group1">
					<label class="big-data padding_alpha" for="input01">Stage:  </label>
					<div class="input-left">
					    <?php 
						$ver_stage=$verify_teleleads['v_stage'];
						if($ver_stage=='' || $ver_stage=='0')
						{
						$ver_stage='Not Available';
						}
						?>
						<span  class="Stage selector"><?php echo $ver_stage;  ?></span>
						<select name="stage" id="stage"  class="edit_box large_box" style="display:none">
						<option value="">--Please Select--</option>
						<option value="1:New" <?php if($verify_teleleads['v_stage']=='1:New'){ ?> selected="selected" <?php } ?>>1:New</option>
						<option value="2:Invalid" <?php if($verify_teleleads['v_stage']=='2:Invalid'){ ?> selected="selected" <?php } ?>>2:Invalid</option>
						<option value="3:Call 1 - Ongoing" <?php if($verify_teleleads['v_stage']=='3:Call 1 - Ongoing'){ ?> selected="selected" <?php } ?>>3:Call 1 - Ongoing</option>
						<option value="4:Call 1 - Rejected" <?php if($verify_teleleads['v_stage']=='4:Call 1 - Rejected'){ ?> selected="selected" <?php } ?>>4:Call 1 - Rejected</option>
						<option value="5:Sent" <?php if($verify_teleleads['v_stage']=='5:Sent'){ ?> selected="selected" <?php } ?>>5:Sent</option>
						<option value="6:Sent - Call 2 Attemp Pending" <?php if($verify_teleleads['v_stage']=='6:Sent - Call 2 Attemp Pending'){ ?> selected="selected" <?php } ?>>6:Sent - Call 2 Attemp Pending</option>
						<option value="7:Sent - Call 2 Ongoing" <?php if($verify_teleleads['v_stage']=='7:Sent - Call 2 Ongoing'){ ?> selected="selected" <?php } ?>>7:Sent - Call 2 Ongoing</option>
						<option value="8:Sent - Call 2 Rejected" <?php if($verify_teleleads['v_stage']=='8:Sent - Call 2 Rejected'){ ?> selected="selected" <?php } ?>>8:Sent - Call 2 Rejected</option>
						<option value="9:Sent - Call 3 Attemp Pending" <?php if($verify_teleleads['v_stage']=='9:Sent - Call 3 Attemp Pending'){ ?> selected="selected" <?php } ?>>9:Sent - Call 3 Attemp Pending</option>
						<option value="10:Sent - Call 3 Ongoing" <?php if($verify_teleleads['v_stage']=='10:Sent - Call 3 Ongoing'){ ?> selected="selected" <?php } ?>>10:Sent - Call 3 Ongoing</option>
						<option value="11:Sent - Call 3 Rejected" <?php if($verify_teleleads['v_stage']=='11:Sent - Call 3 Rejected'){ ?> selected="selected" <?php } ?>>11:Sent - Call 3 Rejected</option>
						<option value="12:Completed - Dropped after counseling" <?php if($verify_teleleads['v_stage']=='12:Completed - Dropped after counseling'){ ?> selected="selected" <?php } ?>>12:Completed - Dropped after counseling</option>
						<option value="13:Completed - Filled the application form" <?php if($verify_teleleads['v_stage']=='13:Completed - Filled the application form'){ ?> selected="selected" <?php } ?>>13:Completed - Filled the application form</option>
						<option value="14:Completed - Joined other school" <?php if($verify_teleleads['v_stage']=='14:Completed - Joined other school'){ ?> selected="selected" <?php } ?>>14:Completed - Joined other school</option>
						<option value="15:Completed - Joined our school" <?php if($verify_teleleads['v_stage']=='15:Completed - Joined our school'){ ?> selected="selected" <?php } ?>>15:Completed - Joined our school</option>
						
						
						
						</select>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
				<div class="bottom_line1"></div>
			<div class="float_l data7 margin_delta">
				<div class="control-group1">
					<label class="big-data padding_alpha" for="input01">Next education level:  </label>
					<div class="input-left">
					    <?php 
						$ver_next=$verify_teleleads['next'];
						if($ver_next=='' || $next=='0')
						{
						$ver_next='Not Available';
						}
						?>
						<span  class="next selector"><?php echo $ver_next;  ?></span>
						<select name="next_educ_level" id="next_educ_level" class="edit_box large_box" style="display:none">
						<option value="">Select Level</option>
						<?php foreach($program_level as $level)
						{?>
						<option value="<?php echo $level['prog_edu_lvl_id']; ?>" <?php if($level['educ_level']==$verify_teleleads['next']) { ?> selected <?php } ?> ><?php echo $level['educ_level'];?></option>
						<?php } ?>
						</select>	
					</div>
				</div>
			</div>
			<div class="float_l data7">
				<div class="control-group1">
					<label class="big-data padding_alpha" for="input01">Priority:  </label>
					<div class="input-left">
					    <?php 
						$ver_priority=$verify_teleleads['v_priority'];
						if($ver_priority=='' || $ver_priority=='0')
						{
						$ver_priority='Not Available';
						}
						?>
						<span class="Priority selector"><?php echo $verify_teleleads['v_priority'];  ?></span>
						<select name="priority" id="priority"  class="edit_box large_box" style="display:none">
						<option value="">--Please Select--</option>
						<option value="1" <?php if($verify_teleleads['v_priority']==1){ ?> selected="selected" <?php } ?> >1</option>
						<option value="2" <?php if($verify_teleleads['v_priority']==2){ ?> selected="selected" <?php } ?> >2</option>
						<option value="3" <?php if($verify_teleleads['v_priority']==3){ ?> selected="selected" <?php } ?> >3</option>
						<option value="4" <?php if($verify_teleleads['v_priority']==4){ ?> selected="selected" <?php } ?> >4</option>
						<option value="5" <?php if($verify_teleleads['v_priority']==5){ ?> selected="selected" <?php } ?> >5</option>
						</select>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
				<div class="bottom_line1"></div>
			<div class="float_l data7 margin_delta">
				<div class="control-group1">
					<label class="big-data padding_alpha" for="input01">Most Recent Overall Academic Percentage:  </label>
					<div class="input-left">
					    <?php 
						$ver_aggregate_percentage=$verify_teleleads['v_aggregate_percentage'];
						if($ver_aggregate_percentage=='' || $ver_aggregate_percentage=='0')
						{
						$ver_aggregate_percentage='Not Available';
						}
						?>
						<span  class="selector2 selector"><?php echo $ver_aggregate_percentage;  ?></span>
						<input name="academic" id="academic" class="edit_box large_box" value="<?php echo $verify_teleleads['v_aggregate_percentage'];  ?>" style="display:none"/>
					</div>
				</div>
			</div>
			
			<div class="clearfix"></div>
				<div class="bottom_line1"></div>
			<div class="margin_delta">
				<div class="control-group1">
					<label class="big-data padding_alpha" for="input01">Notes:  </label>
					<div class="input_post">						
						<?php 
						$note_info=$this->lead_tele_model->v_note($verify_teleleads['v_lead_id']);
						?>
						<div class="controls-input" >
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
						<textarea name="notes" id="notes" rows="2" cols="50" class="edit_box" style="width:506px;display:none"></textarea>
						</div>
				</div>
			</div>
			</div>
			<div class="span21" style="margin-left: 406px;">
					<button onclick="verifyLead('<?php echo $verify_teleleads['v_id'];  ?>')" class="btn_img edit_box" style="display:none">Save now</button>
					<button onclick="cancel()" class="btn_img edit_box">Cancel</button>
				</div>
	</div>
</div>	
<script type="text/javascript">
$(document).ready(function() {
	  $(".counsel_next_bg").click(function(){
	  $(".selector").hide();
	   $(".edit_box").show();
	 });
});	 
function fetchstates()
{
var e = document.getElementById("country_id");
var cid=e.options[e.selectedIndex].value;
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>admin/state_list_ajax/",
   data: 'country_id='+cid,
   cache: false,
   success: function(msg)
   {    
	$("#state_id").html(msg);	
	$('#city_id').html('<option value="0">select city</option>')
   }
   });
}

function fetchcities()
{
var cityid=0;
var e = document.getElementById("state_id");
var state_id=e.options[e.selectedIndex].value;
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>admin/city_list_ajax/",
   data: 'state_id='+state_id+'&sel_city_id='+cityid,
   cache: false,
   success: function(msg)
   {
    //$('#'+cityID).attr('disabled', false);
	$('#city_id').html(msg);
   }
   });  
}
 $(function()
 {
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

function verifyLead(id)
{
	var id=id;
	var lead_id=$('#lead_id').val();	
	var name=$('#name').val();	
	var year=$('#year').val();
	var month=$('#month').val();
	var date=$('#date').val();
	var email=$('#email').val();
	var phone=$('#phone').val();
	var country=$('#country_id').val();
	var state=$('#state_id').val();	
	var city=$('#city_id').val();
	var enroll=$('#enroll').val();
	var auto_intrested_countries=$('#auto_intrested_countries').val();
	var courses=$('#courses').val();
	var enroll_date=$('#enroll_date').val();
	var exam1=$('#exam1').val();
	var exam1_score=$('#exam1_score').val();
	var exam2=$('#exam2').val();
	var exam2_score=$('#exam2_score').val();
	var attended=$('#attended').val();
	var other_exam_name=$('#other_exam_name').val();
	var other_exam_score=$('#other_exam_score').val();
	var status=$('#status').val();
	var stage=$('#stage').val();
	var priority=$('#priority').val();
	var next_educ_level=$('#next_educ_level').val();
	var c_educ_level=$('#c_educ_level').val();
	var academic=$('#academic').val();
	var notes=$('#notes').val();	 
	  var interested_cont=0;
		$("input[name^=country_ids]").each(function() {
		var val=$(this).val();
		val=val.trim();
		interested_cont=interested_cont+','+val;
							
		});
	var data='id='+id+'&lead_id='+lead_id+'&name='+name+'&year='+year+'&month='+month+'&date='+date+'&email='+email+'&phone='+phone+'&country='+country+'&state='+state+'&city='+city+'&enroll='+enroll+'&auto_intrested_countries='+auto_intrested_countries+'&courses='+courses+'&enroll_date='+enroll_date+'&exam1='+exam1+'&exam1_score='+exam1_score+'&exam2='+exam2+'&exam2_score='+exam2_score+'&attended='+attended+'&other_exam_name='+other_exam_name+'&other_exam_score='+other_exam_score+'&status='+status+'&stage='+stage+'&priority='+priority+'&next_educ_level='+next_educ_level+'&c_educ_level='+c_educ_level+'&academic='+academic+'&notes='+notes+'&interested_cont='+interested_cont;
	//alert(data);
	$.ajax({
	type:"POST",
	url:"<?php echo $base; ?>admin_counsellor/verified_lead",
	data: data,
	cache: false,
	async:false,
	success:function(msg)
	{
		$("#c_edit").hide();
		$("#content").show();
		$("#lead_edit_msg").show();
		setInterval(function(){$("#lead_edit_msg").hide(3000)},5000);
		
	}
	
	});
	
}
 
</script>
