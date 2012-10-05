<div class="row" style="margin-top:-25px">	
<div class="float_l span13 margin_l">		
<div class="margin_t">			
<?php 
if($university_details['univ_overview'] == "" && $university_details['univ_campus'] == "" 
&& $university_details['univ_departments'] == "" && $university_details['univ_expertise'] == ""		
&& $university_details['univ_interstudents'] == "" && $university_details['univ_slife'] == ""		
&& $university_details['univ_faculties'] == "" && $university_details['univ_alumni'] == "") 
{ ?>
<div class="float_l">		
<?php		
echo "<h2>";		
echo "We are gathering information about the ".$university_details['univ_name'].". Please visit back soon...";		
echo "</h2>";		
?></div>	    
<?php }  
else 
{ 									
$univ_alumni=$this->subdomain->genereate_the_subdomain_link($university_details['subdomain_name'],'alumini-detail','','');							
$univ_faculties=$this->subdomain->genereate_the_subdomain_link($university_details['subdomain_name'],'faculties-detail','','');							
$univ_slife=$this->subdomain->genereate_the_subdomain_link($university_details['subdomain_name'],'studentlife-detail','','');							
$univ_interstudents=$this->subdomain->genereate_the_subdomain_link($university_details['subdomain_name'],'internationalstudent-detail','','');							
$univ_expertise=$this->subdomain->genereate_the_subdomain_link($university_details['subdomain_name'],'expertise-detail','','');							
$univ_departments=$this->subdomain->genereate_the_subdomain_link($university_details['subdomain_name'],'departments-detail','','');							
$univ_services=$this->subdomain->genereate_the_subdomain_link($university_details['subdomain_name'],'univ-services','','');								
 if($university_details['univ_overview'] != '')
 { ?>			
 <div class="float_l span8 margin_zero about_depend">							
 <?php	echo "<h3>Overview</h3><div class='course_cont'>".strip_tags($university_details['univ_overview'])."</div>";?>			
 </div>			
 <?php } 			 
 if($university_details['univ_insights']!='') { ?>				
 <div class="float_l span5">				
 <div class="about_round">				
 <?php							
 echo "<h3>University Insights:</h3><div class='course_cont'>".$university_details['univ_insights']."</div>";?>				
 </div>			
 </div>			
 <?php } ?>			
 <div class="clearfix"></div>			
 <div class="margin_t">		
 <?php	if($university_details['univ_campus']!='')
 {	
 echo "<h3>University Campus Overview</h3><div class='course_cont'>".$university_details['univ_campus']."</div>"; 
 } 		
 ?>	</div>						
 <div class="span13 margin_delta margin_b">				
 <?php if($university_details['univ_departments'] != '') { ?>				
 <div class="float_l grid_2 margin_delta margin_t left_about">					
 <?php echo "<div class='about_fix'><h3>University Departments</h3>".substr(strip_tags($university_details['univ_departments']),0,250)."</div>";			
		
 if(strlen($university_details['univ_departments']) > 250) 
 { 		
 ?>		
 <a href="<?php echo $univ_departments; ?>" class="float_r ">View more&raquo;</a>		
 <?php		
 }				
 ?>									
 </div>		
 <?php } 		
 if($university_details['univ_expertise'] != '') { ?>				
 <div class="float_l grid_2 margin_delta margin_t left_about">					
 <?php			
 echo "<div class='about_fix'><h3>University Research Expertise</h3>".substr(strip_tags($university_details['univ_expertise']),0,250)."</div>";			
if(strlen($university_details['univ_expertise']) > 250) 
{ 		
?>		
<a href="<?php echo $univ_expertise; ?>" class="float_r ">View more&raquo;</a>		
<?php		
}				
?>				
</div>				
<?php } 				
if(strip_tags($university_details['univ_interstudents']) != '') 
{ ?>				
<div class="float_l grid_2 margin_delta margin_t left_about">							
<?php echo "<div class='about_fix'><h3>International Students</h3>".substr(strip_tags($university_details['univ_interstudents']),0,250)."</div>";
if(strlen($university_details['univ_interstudents']) > 250)
 { 	?>		
 <a href="<?php echo $univ_interstudents; ?>" class="float_r ">View more&raquo;</a>		
 <?php		
 }				
 ?>				
 </div>			
 <?php } 				
 if(strip_tags($university_details['univ_slife']) != '') 
 { 			
 ?>				
 <div class="float_l grid_2 margin_delta margin_t left_about">					
 <?php 			
 echo "<div class='about_fix'><h3>University Student Life</h3>".substr(strip_tags($university_details['univ_slife']),0,250)."</div>";	
 if(strlen($university_details['univ_slife']) > 250) 
 { 		?>		
 <a href="<?php echo $univ_slife; ?>" class="float_r ">View more&raquo;</a>		
 <?php		
 }				
 ?>				
 </div>				
 <?php } 				
 if(strip_tags($university_details['univ_faculties']) != '') 
 { ?>				
 <div class="float_l grid_2 margin_delta margin_t left_about">					
 <?php		
 echo "<div class='about_fix'><h3>University Faculties</h3>".substr(strip_tags($university_details['univ_faculties']),0,250)."</div>"; 	
 if(strlen($university_details['univ_faculties']) > 250)
 { 		
 ?>		
 <a href="<?php echo $univ_faculties; ?>" class="float_r ">View more&raquo;</a>	
 <?php		
 }				
 ?>				
 </div>				
 <?php } 
 
	 if(strip_tags($university_details['univ_alumni']) != '') {
	 ?>		


	 <div class="float_l grid_2 margin_delta margin_t left_about">	
	 <?php echo "<div class='about_fix'><h3>University Awarded Alumni</h3>".substr(strip_tags($university_details['univ_alumni']),0,250)."</div>";
	 if(strlen($university_details['univ_alumni']) > 250) {
	 ?>		<a href="<?php echo $univ_alumni; ?>" class="float_r ">View more&raquo;</a>	
	 <?php	
	 }			
	 ?>		
	 </div>	
	 <?php }
	 
	 
	 
	  if(strip_tags($university_details['univ_services']) != '') {
	 ?>		


	 <div class="float_l grid_2 margin_delta margin_t left_about">	
	 <?php echo "<div class='about_fix'><h3>Facilities & Services / Accommodation</h3>".substr(strip_tags($university_details['univ_services']),0,190)."</div>";
	 if(strlen($university_details['univ_services']) > 250) {
	 ?>		<a href="<?php echo $univ_services; ?>" class="float_r ">View more&raquo;</a>	
	 <?php	
	 }			
	 ?>		
	 </div>	
	 <?php } ?>	
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 </div>		
	 <?php 
	 } ?>	
	 </div>	<!--marin_t div close -->	
	 </div>	
	 <div class="float_r span3" style="margin-top: -5px;">		<img src="<?php echo $base; ?>images/banner_img.png">	</div>	<div class="clearfix"></div></div></div>








