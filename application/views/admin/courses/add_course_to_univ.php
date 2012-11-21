<?php

$class_course_name='';
$class_univ_name='';
$class_educ_level='';
$class_area_interest='';
$class_tution_fee1='';
$class_tution_fee2='';
$class_per_required='';

$class_currency1='';
$class_currency2='';
$error_univ_name = form_error('university');
$error_course_name = form_error('program');
$error_educ_level = form_error('educ_level');
$error_area_interest = form_error('area_interest');
$error_tution_fee2 = form_error('tution_fee1');
$error_tution_fee2 = form_error('tution_fee2');
$error_per_required = form_error('per_required');
$error_currency1 = form_error('currency1');
$error_currency2 = form_error('currency2');

if($error_univ_name != '') { $class_univ_name = 'focused_error_univ'; } else { $class_univ_name='text'; }
if($error_course_name != '') { $class_course_name = 'focused_error_univ'; } else { $class_course_name='text'; }
if($error_educ_level != '') { $class_educ_level = 'focused_error_univ'; } else { $class_educ_level='text'; }
if($error_area_interest != '') { $class_area_interest = 'focused_error_univ'; } else { $class_area_interest='text'; }
if($error_tution_fee2 != '') { $class_tution_fee1 = 'focused_error_univ'; } else { $class_tution_fee1='text'; }
if($error_tution_fee2 != '') { $class_tution_fee2 = 'focused_error_univ'; } else { $class_tution_fee2='text'; }
if($error_per_required != '') { $class_per_required = 'focused_error_univ'; } else { $class_per_required='text'; }
if($error_currency1 != '') { $class_currency1 = 'focused_error_univ'; } else { $class_currency1='text'; }
if($error_currency2 != '') { $class_currency2= 'focused_error_univ'; } else { $class_currency2='text'; }

?>


	<div id="content">
			
		<h2 class="margin">Add Course</h2>
		<span style="color: red;"> <?php echo form_error('program'); ?><?php echo isset($errors['program'])?$errors['program']:''; ?> </span>

		<div class="form span8">
<form action="<?php echo $base; ?>admincourses/university_addcourse/submit" method="post" class="caption_form" onsubmit="return chk_prog_to_univ();" >
					<ul>
					<li style="margin-left:80px;">
						<div>
						<div class="float_l span3 margin_zero">
							<label>Education Level</label>
						</div>
						<div class="float_l span3 margin_zero">
							<label>Area Of Interest</label>
						</div>
						<div class="float_l span3 margin_zero program_label" style="display:none" >
							<label  style="color:red;">Select the Course</label>
						</div>
						<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
						<div class="float_l span3">
							<select class="<?php echo $class_educ_level; ?> styled span3 margin_zero" name="educ_level" id="educ_level" onchange="populate_courses();">
								<option value="">Please Select</option>
				<?php foreach($educ_level as $education_level) { ?>	
				<option value="<?php echo $education_level['prog_edu_lvl_id']; ?>"><?php echo $education_level['educ_level']; ?></option>
				<?php } ?>			
							</select>
	<span style="color: red;"> <?php echo form_error('educ_level'); ?><?php echo isset($errors['educ_level'])?$errors['educ_level']:''; ?> </span>
	
						</div>
					<div class="float_l span3">
							<select class="<?php echo $class_area_interest; ?> styled span3 margin_zero" name="area_interest" id="area_interest" onchange="populate_courses()";>
								<option value="">Please Select</option>
				<?php foreach($area_interest as $area_of_interest) { ?>	
			<option value="<?php echo $area_of_interest['prog_parent_id']; ?>"><?php echo $area_of_interest['program_parent_name']; ?></option>
				<?php } ?>		
							</select>
<span style="color: red;"> <?php echo form_error('area_interest'); ?><?php echo isset($errors['area_interest'])?$errors['area_interest']:''; ?> </span>
	
						</div>
						<div class="float_l span3">
							<select class="<?php echo $class_course_name; ?>  styled span3 margin_zero"  style="display:none" name="program" id="program">
								
							</select>
	
						</div>
						
						<div class="clearfix"></div>
					</div>
					</li>
					</ul>
					<ul id="prog_data" style="display:none;">
					<?php if($admin_user_level=='5' || $admin_user_level=='4') {?>
					<li>
						<div>
						<div class="float_l span3 margin_zero">
							<label>Choose University</label>
						</div>
						<div class="float_l span3">
							<select class="<?php echo $class_univ_name; ?> styled span3 margin_zero" name="university" id="university">
								<option value="">Please Select</option>
									<?php foreach($univ_info as $univ_detail) { ?>
										<option value="<?php echo $univ_detail->univ_id; ?>" ><?php echo $univ_detail->univ_name; ?></option>
										<?php } ?>
							</select>
		<span style="color: red;"> <?php echo form_error('university'); ?><?php echo isset($errors['university'])?$errors['university']:''; ?> </span>
		
						</div>
						<div class="clearfix"></div>
						</div>
					</li>
				
					<?php } else { ?>
	 				<input type="hidden" name="university" id="university" value="<?php echo $univ_info['univ_id']; ?>">
					
					<?php }?>
						<div>
						<div class="float_l span3 margin_zero">
							<label>Intake1</label>
						</div>
						<div class="float_l span3" >
							<input type="text" size="30" name="intake1" value="<?php echo set_value('intake1'); ?>" class="text">
						</div>
						<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
						<div class="float_l span3 margin_zero">
							<label>Intake2</label>
						</div>
						<div class="float_l span3">
							<input type="text" size="30" name="intake2" value="<?php echo set_value('intake2'); ?>" class="text" >
						</div>
						<div class="clearfix"></div>
						</div>
					
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Course duration1</label>
							</div>
							<div class="float_l span3">
				<input type="text" size="30" name="course_duration1" value="<?php echo set_value('course_duration1'); ?>" class="text">
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Tution Fee1</label>
							</div>
						<div class="float_l span3">
			<input type="text" size="30" value="<?php echo set_value('tution_fee1'); ?>" name="tution_fee1" class="<?php echo $class_tution_fee1; ?>">
			<span style="color: red;"> <?php echo form_error('tution_fee1'); ?><?php echo isset($errors['tution_fee1'])?$errors['tution_fee1']:''; ?> </span>
					
						</div>
						<div class="float_l span3">
						<select class="<?php echo $class_currency1; ?> styled span3 margin_zero" name="currency1" style="width:80px;">
								<option value="">Currency</option>
							<option value="$">$</option>
							<option value="&pound">&pound</option>
							<option value="Rs">Rs</option>
							</select>
							<span style="color: red;"> <?php echo form_error('currency1'); ?><?php echo isset($errors['currency1'])?$errors['currency1']:''; ?> </span>
			
						</div>
						
					</li>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Course duration2</label>
							</div>
							<div class="float_l span3">
			<input type="text" size="30" name="course_duration2" value="<?php echo set_value('course_duration2'); ?>" class="text">
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Tution Fee2</label>
							</div>
							<div class="float_l span3">
			<input type="text" size="30" value="<?php echo set_value('tution_fee2'); ?>" name="tution_fee2" class="<?php echo $class_tution_fee2; ?>">
			<span style="color: red;"> <?php echo form_error('tution_fee2'); ?><?php echo isset($errors['tution_fee2'])?$errors['tution_fee2']:''; ?> </span>
					
						</div>
						<div class="float_l span3">
						<select class="<?php echo $class_currency2; ?> styled span3 margin_zero" name="currency2" style="width:80px;">
								<option value="">Currency</option>
							<option value="$">$</option>
							<option value="&pound">&pound</option>
							<option value="Rs">Rs</option>
						</select>
					<span style="color: red;"> <?php echo form_error('currency2'); ?><?php echo isset($errors['currency2'])?$errors['currency2']:''; ?> </span>		
						</div>
							<div class="clearfix"></div>
						</div>
					</li>
					
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Experience Required</label>
							</div>
							<div class="float_l span3">
			<input type="text" size="30" name="exp_required" value="<?php echo set_value('exp_required'); ?>" class="text">
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
					<li>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>GPA Required</label>
							</div>
							<div class="float_l span3">
				<input type="text" size="30" name="gpa_required" value="<?php echo set_value('gpa_required'); ?>" class="text">
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Percantage Required</label>
							</div>
							<div class="float_l span3">
				<input type="text" size="30" name="per_required" value="<?php echo set_value('per_required'); ?>" class="<?php echo $class_per_required; ?>">
							</div>
							<div class="float_l span2">
							<label style="color:blue">%</label>
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
	<span style="color: red;"> <?php echo form_error('per_required'); ?><?php echo isset($errors['per_required'])?$errors['per_required']:''; ?> </span>
	
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Program Detail</label>
							</div>
							<div class="float_l">
								<textarea rows="6" cols="80" name="prog_detail"></textarea>
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
						<input type="submit" class="submit" value="SUBMIT">
						
				</ul>
					
			</form>
		</div>
		
		
	</div>
<script>
$(document).ready(function()
{
<?php if($submit_attemp=='1') {?>
$('#prog_data').show(0);
<?php }?>
});
function populate_courses()
{
var educ_level=$("#educ_level option:selected").val();
var area_interest=$("#area_interest option:selected").val();
if(educ_level!='' && area_interest!='')
{
$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admincourses/fetch_programs",
	   async:false,
	   data: 'educ_level='+educ_level+'&area_interest='+area_interest,
	   cache: false,
	   success: function(msg)
	   {
	  $('#program').css('display','block');
	   $('.program_label').css('display','block');
	   $('#program').html(msg);
	   $('#prog_data').show(1000);
	   }
	   });

}
else
{
$('#program').css('display','none');
$('.program_label').css('display','none');
$('#prog_data').hide(500);
}
}
function chk_prog_to_univ()
{
<?php if($admin_user_level=='5') { ?>
var university=$("#university option:selected").val();
<?php } else if($admin_user_level=='3'){ ?>
var university=$("#university").val();
<?php } ?>
var program=$("#program option:selected").val();
var f=0;
if(program=='' || program=='0' || program==null)
{
alert("Please select the Program");
return false;
}
else if(university=='' || university==null )
{
alert("Please Select the University");
return false;
}
else {
$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admincourses/check_univ_course_ajax",
	   async:false,
	   data: 'university='+university+'&program='+program,
	   cache: false,
	   success: function(msg)
	   {
	   if(msg =='1')
		{
		f=1;
		}
	   }
	   });
		if(f==1)
		{
		alert("Selected Program is Alredy Exist in this university");
		return false;
		}
		else
		{
		return true;
		}
}

}	
</script>	
	