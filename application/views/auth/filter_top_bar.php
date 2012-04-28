<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row margin_t1">
				<div class="float_l span13 margin_l">
						<div class="search_box padding_lefty">
						<div class="float_l grid_1 margin_zero search_box_height">
							<h5>Filter by Country?</h5>
							<div id="scrollbar1">
								<div class="scrollbar" style="height: 70px!important;overflow: hidden;"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
								<div class="viewport">
									<div class="overview">
										<ul>
			<li <?php if($country_arrow=='' || $country_arrow==0) {  ?> class="filter_arrow" <?php } ?>><a href="<?php echo $base; ?>colleges/AllCountry-0">All</a></li>							
							<?php foreach($country as $countries) { ?>	
											<li   <?php if($country_arrow == $countries['country_id']) { ?> class="filter_arrow" <?php } ?>>
																					
	<a href="<?php echo $base; ?>colleges/<?php echo $countries['country_name']; ?>-<?php echo $countries['country_id']; ?>"><?php echo ucwords($countries['country_name']); ?></a>
											</li>	
							<?php } ?>				
										</ul>                 
									</div>
								</div>
							</div>
								<div class="clearfix"></div>
						</div>
						
							<div class="float_l grid_1 margin_zero search_box_height">
							<h5>Filter by Study Level</h5>
							<div id="scrollbar3">
								<div class="scrollbar" style="height: 70px!important;overflow: hidden;"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
								<div class="viewport">
									<div class="overview">
										<ul>
			<li <?php if($educ_arrow=='' || $educ_arrow==0) { ?> class="filter_arrow" <?php } ?>><a href="#" onclick="onstudylevel('0','AllLevel');">All</a></li>							
							
										<?php foreach($fetch_educ_level as $fetch_educ_levels) { ?>			
											<li <?php if($educ_arrow == $fetch_educ_levels['prog_edu_lvl_id']) { ?> class="filter_arrow" <?php } ?>>
<a href="#" onclick="onstudylevel('<?php echo $fetch_educ_levels['prog_edu_lvl_id']; ?>','<?php echo $fetch_educ_levels['educ_level']; ?>')"><?php echo ucwords($fetch_educ_levels['educ_level']); ?></a>
											</li>	
										<?php } ?>
											
										</ul>                 
									</div>
								</div>
							</div>
						</div>
						
						<div class="float_l grid_1 margin_zero search_box_height">
							<h5>Filter by Area Of Intrest</h5>
							<div id="scrollbar2">
								<div class="scrollbar" style="height: 70px!important;overflow: hidden;"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
								<div class="viewport">
									<div class="overview">
										<ul>
		<li <?php if($course_arrow=='' || $course_arrow==0) { ?> class="filter_arrow" <?php } ?>><a href="#" onclick="onareaintrest('AllAreas','0');">All</a></li>							
											
										<?php foreach($fetch_area_intrest as $fetch_area_intrest1) { ?>			
											<li <?php if($course_arrow == $fetch_area_intrest1['prog_parent_id']) { ?> class="filter_arrow" <?php } ?>>
								
	<a href="#" onclick="onareaintrest('<?php echo $fetch_area_intrest1['program_parent_name']; ?>','<?php echo $fetch_area_intrest1['prog_parent_id']; ?>')"><?php echo ucwords($fetch_area_intrest1['program_parent_name']); ?></a>
											</li>	
										<?php } ?>
											
											
										</ul>                 
									</div>
								</div>
							</div>
						</div>
										<?php if($prog_show=='1'){ ?>
						<div class="float_l grid_1 margin_zero search_box_height">
							<h5>Filter by Program</h5>
							<div id="scrollbar5">
								<div class="scrollbar" style="height: 70px!important;overflow: hidden;"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
								<div class="viewport">
									<div class="overview">
										<ul>
					<?php if($s_program>0) { ?>					
					<li <?php if($prog_arrow=='' || $prog_arrow==0) { ?> class="filter_arrow" <?php } ?>>
					<a href="#" onclick="onsubprogram('AllProgram','0')" >All</a></li>							
											
										<?php foreach($s_program as $search_program) { ?>			
											<li <?php if($prog_arrow == $search_program['program_id']) { ?> class="filter_arrow" <?php } ?>>
								
	<a href="#" onclick="onsubprogram('<?php echo $search_program['course_name']; ?>','<?php echo $search_program['program_id']; ?>')"><?php echo ucwords($search_program['course_name']); ?></a>
											</li>	
										<?php } ?>
					<?php } else { ?> <li class="filter_arrow"><a href="#" >No Program </a></li> <?php } ?>					
										</ul>                 
									</div>
								</div>
							</div>
						</div>
					
				<?php } ?>
				
				
				
				
						<div class="clearfix"></div>
					</div>
				<div class="float_l"><div class="row" style="margin-left:70px;">
				<div class="span10 margin_t1">
					<div class="back_img">
						<h2 class="border_bot_wel">Meet Univerties</h2>
						<div class="span8 margin_t alert alert-error">
							<center><?php echo $err_msg; ?></center>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div></div>	
				</div>	
			
				<div class="float_r span3">
					<img src="<?php echo "$base$img_path"; ?>/banner_img.png" />
				</div>
				
				<div class="clearfix"></div>
		</div>		
				<div id="pagination" class="table_pagination right paging-margin">
   
            <?php echo $this->pagination->create_links();?>
   
            </div>
				
			</div>
			
		</div>
	</div>
<script>
function onstudylevel(educ_lvl_id,educ_lvl_name)
{
educ_lvl_name=educ_lvl_name.replace(',','');

	var url=document.URL;
	var lcofurl=url.charAt(url.length-1);
	if(lcofurl=='/' || lcofurl=='#')
	{
	url = url.substring(0, url.length-1);
	}
	lcofurl=url.charAt(url.length-1);
	if(lcofurl=='/' || lcofurl=='#')
	{
	url = url.substring(0, url.length-1);
	}
	var spliturl;
	var nurl=url.indexOf("colleges/");
	if(nurl > -1)
	{
	
	spliturl=url.split('colleges/');
	if(spliturl[1]=='' || spliturl[1]==null)
	{
	window.location='<?php echo $base; ?>colleges/'+'Country-0/'+educ_lvl_name+'-'+educ_lvl_id+'/';
	}
	else
	{
	var surl=spliturl[1].split('/');
	var ul=surl.length;
	window.location='<?php echo $base; ?>colleges/'+surl[0]+'/'+educ_lvl_name+'-'+educ_lvl_id+'/';
	}
	}
	else
	{
	var lcofurl=url.charAt(url.length-1);
	if(lcofurl!='/')
	{
	url=url+'/';
	}
	window.location=url+'Country-0/'+educ_lvl_name+'-'+educ_lvl_id;
	//}
	//window.location='Country-0/'
	}
	
}

function onareaintrest(prog_parent_name,prog_parent_id)
{

	prog_parent_name=prog_parent_name.replace(',','');
	var url=document.URL;
	var lcofurl=url.charAt(url.length-1);
	if(lcofurl=='/' || lcofurl=='#')
	{
	url = url.substring(0, url.length-1);
	}
	lcofurl=url.charAt(url.length-1);
	if(lcofurl=='/' || lcofurl=='#')
	{
	url = url.substring(0, url.length-1);
	}
	var spliturl;
	var nurl=url.indexOf("colleges/");
	if(nurl > -1)
	{
	
	spliturl=url.split('colleges/');
	if(spliturl[1]=='' || spliturl[1]==null)
	{
	window.location=url+'Country-0/EducationLevel-0/'+prog_parent_name+'-'+prog_parent_id;
	}
	else
	{
	var surl=spliturl[1].split('/');
	var ul=surl.length;
	if(ul=='1' || ul=='0')
	{
	window.location='<?php echo $base; ?>colleges/'+surl[0]+'/EducationLevel-0/'+prog_parent_name+'-'+prog_parent_id;
	}
	if(ul=='2')
	{
	window.location=document.URL+prog_parent_name+'-'+prog_parent_id;
	}
	if(ul>2)
	{
	window.location='<?php echo $base; ?>colleges/'+surl[0]+'/'+surl[1]+'/'+prog_parent_name+'-'+prog_parent_id;
	}
	}
	}
	else
	{
	var lcofurl=url.charAt(url.length-1);
	if(lcofurl!='/')
	{
	url=url+'/';
	}
	window.location=url+'Country-0/EducationLevel-0/'+prog_parent_name+'-'+prog_parent_id;
	//}
	//window.location='Country-0/'
	}
}	
 function onsubprogram(prog_name,prog_id)
 {
	prog_name=prog_name.replace(',','');
	var url=document.URL;
	var lcofurl=url.charAt(url.length-1);
	if(lcofurl=='/' || lcofurl=='#')
	{
	url = url.substring(0, url.length-1);
	}
	lcofurl=url.charAt(url.length-1);
	if(lcofurl=='/' || lcofurl=='#')
	{
	url = url.substring(0, url.length-1);
	}
	var spliturl;
	var nurl=url.indexOf("colleges/");
	if(nurl > -1)
	{
	spliturl=url.split('colleges/');
	var surl=spliturl[1].split('/');
	var ul=surl.length;
	if(ul=='3')
	{
	window.location=url+'/'+prog_name+'-'+prog_id;
	}
	else if(ul>3)
	{
	window.location='<?php echo $base; ?>colleges/'+surl[0]+'/'+surl[1]+'/'+surl[2]+'/'+prog_name+'-'+prog_id;
	}
	}
	//window.location=url+'/'+prog_name+'-'+prog_id;
 }
</script>
	