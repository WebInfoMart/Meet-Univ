<div class="row" style="margin-top:-25px">
				<div class="float_l span13 margin_l">
					<div class="margin_t">
						
	
	<div>
		<div class="float_l span8 margin_zero about_depend">
		<?php
		//print_r($view_overview_detail);
		//echo $overview_type;
		$overview_cond = '';
		$overvew_text = '';
		if(trim($overview_type) == "univ_alumni"){ $overview_cond = "univ_alumni"; $overvew_text = 'Alumini Details';}
		else if(trim($overview_type) == "univ_faculties"){ $overview_cond = "univ_faculties"; $overvew_text = 'Faculties Details';}
		else if(trim($overview_type) == "univ_slife"){ $overview_cond = "univ_slife";$overvew_text = 'Student Life Details';}
		else if(trim($overview_type) == "univ_interstudents"){ $overview_cond = "univ_interstudents"; $overvew_text = 'International Student Details';}
		else if(trim($overview_type) == "univ_expertise"){ $overview_cond = "univ_expertise"; $overvew_text = 'Expertise Details';}
		else if(trim($overview_type) == "univ_departments"){ $overview_cond = "univ_departments"; $overvew_text = 'Departments Details';}
		else if(trim($overview_type) == "univ_services"){ $overview_cond = "univ_services"; $overvew_text = 'Facilities & Services / Accommodation';}
		
		//echo $overvew_text;
		?>
		<h3><?php echo $overvew_text; ?></h3><div class='course_cont'><?php echo $view_overview_detail[$overview_cond]; ?></div>
		</div>
		
	<div class="margin_t">
	
	</div>
	<div class="span13 margin_delta margin_b">
	
	
		</div>
	
	
	
	
		<div class="clearfix"></div>
	</div>
	<?php
	
	
	
	//echo "<h3>University Facilities & Services / Accommodation</h3><div class='course_cont'>".$university_details['univ_services']."I tried viewing the demo using ietester for 5.5, 6, and 7. Doesn’t seem to be working. Is the demo set to work in IE?I tried viewing the demo using ietester for 5.5, 6, and 7. Doesn’t seem to be working. Is the demo set to work in IE?I tried viewing the demo using ietester for 5.5, 6, and 7. </div>";
	
//}
?>
					</div>
				</div>
				<div class="float_r span3" style="margin-top: -5px;">
					<a href="<?php echo $base; ?>register/british_council"><img src="<?php echo "$base$img_path" ?>/banner_img.png"></a>
				</div>
				<div class="clearfix"></div>
				
</div>
</div>








