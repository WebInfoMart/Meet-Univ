<div class="row" style="margin-top:-25px">
				<div class="float_l span13 margin_l">
					<div class="margin_t1">
						<h2 class="course_txt"><?php echo $university_details['univ_name']; ?></h2>
						<div class="margin_t1"><?php echo $university_details['about_us']; ?></div>
					</div>
					<div class="margin_t1">
						<h3 class="course_txt">Interesting Facts</h3>
						<ul>
							<li>400 international students</li>
							<li>U.S. News & World Report ranked UW-L second among Midwestern public universities offering bachelor's and master's degrees in 2005, 2006, and 2007, and third in 2008</li>
							<li>In 2007, the Princeton Review named UW-La Crosse one of America's "Best Midwestern Colleges" and an "America's Best Value College"</li>
						</ul>
					</div>
<br></br>
<br></br>
<?php
//foreach($university_details as $univ_detail)
//{
	echo "<h3>University Name</h3>----".$university_details['univ_name'].'</br>';
	/*echo "<h3>University title</h3>----".$university_details['title'].'</br>';
	echo "<h3>University keyword</h3>----".$university_details['keyword'].'</br>';
	echo "<h3>University description</h3>----".$university_details['description'].'</br>';
	echo "<h3>University latitude</h3>----".$university_details['latitude'].'</br>';
	echo "<h3>University longitude</h3>----".$university_details['longitude'].'</br>';
	echo "<h3>University univ_logo_path</h3>----".$university_details['univ_logo_path'].'</br>';
	echo "<h3>University address_line1</h3>----".$university_details['address_line1'].'</br>';
	echo "<h3>University address_line2</h3>----".$university_details['address_line2'].'</br>';
	echo "<h3>University user_id</h3>----".$university_details['user_id'].'</br>';
	echo "<h3>University city_id</h3>----".$university_details['city_id'].'</br>';
	echo "<h3>University state_id</h3>----".$university_details['state_id'].'</br>';
	echo "<h3>University country_id</h3>----".$university_details['country_id'].'</br>';
	echo "<h3>University phone_no</h3>----".$university_details['phone_no'].'</br>';
	echo "<h3>University switch_off_univ</h3>----".$university_details['switch_off_univ'].'</br>';
	echo "<h3>University univ_is_client</h3>----".$university_details['univ_is_client'].'</br>';
	echo "<h3>University univ_ranking</h3>----".$university_details['univ_ranking'].'</br>';
	echo "<h3>University subdomain_name</h3>----".$university_details['subdomain_name'].'</br>';
	echo "<h3>University univ_ranking</h3>----".$university_details['univ_ranking'].'</br>';
	echo "<h3>University about_us</h3>----".$university_details['about_us'].'</br>';
	echo "<h3>University contact_us</h3>----".$university_details['contact_us'].'</br>';
	echo "<h3>University createdon</h3>----".$university_details['createdon'].'</br>';
	echo "<h3>University createdby</h3>----".$university_details['createdby'].'</br>';
	echo "<h3>University univ_fax</h3>----".$university_details['univ_fax'].'</br>';
	echo "<h3>University univ_email</h3>----".$university_details['univ_email'].'</br>';
	echo "<h3>University univ_web</h3>----".$university_details['univ_web'].'</br>';
	echo "<h3>University featured_college</h3>----".$university_details['featured_college'].'</br>';
	echo "<h3>University salient_features</h3>----".$university_details['salient_features'].'</br>';*/
	echo "<h3>Overview University</h3>----".$university_details['univ_overview'].'</br>';
	echo "<h3>University Campus Overview</h3>----".$university_details['univ_campus'].'</br>';
	echo "<h3>University Facilities & Services / Accommodation</h3>----".$university_details['univ_services'].'</br>';
	echo "<h3>University Faculties</h3>----".$university_details['univ_faculties'].'</br>';
	echo "<h3>University Research Expertise</h3>----".$university_details['univ_expertise'].'</br>';
	echo "<h3>University Student Life</h3>----".$university_details['univ_slife'].'</br>';
	echo "<h3>University For International Students</h3>----".$university_details['univ_interstudents'].'</br>';
	echo "<h3>University Awarded Alumni</h3>----".$university_details['univ_alumni'].'</br>';
	echo "<h3>University Departments</h3>----".$university_details['univ_departments'].'</br>';
	echo "<h3>University Insights</h3>----".$university_details['univ_insights'].'</br>';
//}
?>

				</div>
				<div class="float_r span3 margin_t">
					<img src="<?php echo $base; ?>images/banner_img.png">
				</div>
				<div class="clearfix"></div>
				
</div>








