<?php
$class_course_name='';
$class_prog_title='';
$class_educ_level='';
$class_area_interest='';

$error_course_name = form_error('course_name');
$error_prog_title = form_error('prog_title');
$error_educ_level = form_error('educ_level');
$error_area_interest = form_error('area_interest');

if($error_course_name != '') { $class_course_name = 'focused_error_univ'; } else { $class_course_name='text'; }

if($error_prog_title != '') { $class_prog_title = 'focused_error_univ'; } else { $class_prog_title='text'; }
if($error_educ_level != '') { $class_educ_level = 'focused_error_univ'; } else { $class_educ_level='text'; }
if($error_area_interest != '') { $class_area_interest = 'focused_error_univ'; } else { $class_area_interest='text'; }



?>




	<div id="content">
			
		<h2 class="margin">Add Course</h2>
		<div class="form span8">
			<form action="" method="post" class="caption_form">
				<ul>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Course Name</label>
							</div>
							<div class="float_l span3">
	<input type="text" size="30" name="course_name" value="<?php echo set_value('course_name'); ?>" class="<?php echo $class_course_name; ?>" >
	<span style="color: red;"> <?php echo form_error('course_name'); ?><?php echo isset($errors['course_name'])?$errors['course_name']:''; ?> </span>
							
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Program Title</label>
							</div>
							<div class="float_l span3">
	<input type="text" size="30" name="prog_title" value="<?php echo set_value('prog_title'); ?>" class="<?php echo $class_prog_title; ?>" >
	<span style="color: red;"> <?php echo form_error('prog_title'); ?><?php echo isset($errors['prog_title'])?$errors['prog_title']:''; ?> </span>
	
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
					
					<li>
						<div>
						<div class="float_l span3 margin_zero">
							<label>Education Level</label>
						</div>
						<div class="float_l span3">
							<select class="<?php echo $class_educ_level; ?> styled span3 margin_zero" name="educ_level">
								<option value="">Please Select</option>
				<?php foreach($educ_level as $education_level) { ?>	
				<option value="<?php echo $education_level['prog_edu_lvl_id']; ?>"><?php echo $education_level['educ_level']; ?></option>
				<?php } ?>			
							</select>
	<span style="color: red;"> <?php echo form_error('educ_level'); ?><?php echo isset($errors['educ_level'])?$errors['educ_level']:''; ?> </span>
	
						</div>
						<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
						<div class="float_l span3 margin_zero">
							<label>Area Of Interest</label>
						</div>
						<div class="float_l span3">
							<select class="<?php echo $class_educ_level; ?> styled span3 margin_zero" name="area_interest">
								<option value="">Please Select</option>
				<?php foreach($area_interest as $area_of_interest) { ?>	
			<option value="<?php echo $area_of_interest['prog_parent_id']; ?>"><?php echo $area_of_interest['program_parent_name']; ?></option>
				<?php } ?>		
							</select>
<span style="color: red;"> <?php echo form_error('area_interest'); ?><?php echo isset($errors['area_interest'])?$errors['area_interest']:''; ?> </span>
	
						</div>
						<div class="clearfix"></div>
						</div>
					</li>
					
				</ul>
						<input type="submit" class="submit" value="SUBMIT">
						
			</form>
		</div>
		
		
	</div>