<div class="row" style="margin-top:-40px">
				<div class="span12 float_l margin_l margin_t">	
				
					<h2><?php echo $detail_of_course['course_name']!='' ? $detail_of_course['course_name']:'Course Name Not Found!!!'; ?></h3>
					<h4><?php echo $detail_of_course['prog_title']!='' ? $detail_of_course['prog_title']:'Title Not Found!!!'; ?></h4>
					<div class="course_cont"><?php echo $detail_of_course['program_detail']!='' ? $detail_of_course['program_detail']:'We currently have no information for this program.'; ?></div>
					<h3>Educational Level</h3>
					<div class="course_cont"><?php echo $detail_of_course['educ_level']!='' ? $detail_of_course['educ_level']:'Education Level Not Found!!!'; ?></div>
					<h3>Duration</h3><div class="course_cont"><?php echo $detail_of_course['program_duration1']!='' ? $detail_of_course['program_duration1']:'Program Duration Not Found!!!'; ?></div>
				</div>
				<?php $this->load->view('auth/univ-fb-sidebar'); ?>
				<div class="clearfix"></div>
			</div>
</div>
	</div>
		