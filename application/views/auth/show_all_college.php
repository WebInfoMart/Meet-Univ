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
						<div class="float_l grid_1 margin_zero search_box_height">
							<h5>Filter by Program</h5>
							<div id="scrollbar5">
								<div class="scrollbar" style="height: 70px!important;overflow: hidden;"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
								<div class="viewport">
									<div class="overview">
									
										<ul>
					<?php if($prog_show=='1'){ ?>
										
					<?php if($s_program>0) { ?>					
					<li <?php if($prog_arrow=='' || $prog_arrow==0) { ?> class="filter_arrow" <?php } ?>>
					<a href="#" onclick="onsubprogram('AllProgram','0')" >All</a></li>							
											
										<?php foreach($s_program as $search_program) { ?>			
											<li <?php if($prog_arrow == $search_program['program_id']) { ?> class="filter_arrow" <?php } ?>>
								
	<a href="#" onclick="onsubprogram('<?php echo $search_program['course_name']; ?>','<?php echo $search_program['program_id']; ?>')"><?php echo ucwords($search_program['course_name']); ?></a>
											</li>	
										<?php } ?>
					<?php } else { ?> <li class="filter_arrow"><a href="#" >No Program </a></li> <?php } ?>	
							<?php } else { ?>
					<li><a>Select Area of Interest</a></li>					
								<?php } ?>
										</ul> 
								
									</div>
								</div>
							</div>
						</div>
					
				
				
				
				
						<div class="clearfix"></div>
					</div>
	<div id="ajax_loader_paging"><img src="<?php echo "$base$img_path"; ?>/ajax-loader.gif"></div>
					<div id="pagination" style="margin-top:15px;" class="table_pagination right paging-margin">
   
					   <?php
					   $cc=$get_university['total_res'];
					   $rl=$get_university['limit_res']; 
					   if($cc>$rl)
					   {
					   $z=0;
					   for($c=$cc;$c>0;$c=$c-$rl)
					   {
					   ?>
					 <a href="#" id="paging_<?php echo $z; ?>" <?php if($z==0){ ?> class="add_paging_background_class paging_<?php echo $z; ?>" <?php }else { ?> class="paging_<?php echo $z; ?>" <?php } ?> onclick="ajax('<?php echo ($rl*$z); ?>','paging_<?php echo $z; ?>')"><?php echo ++$z; ?></a>
					 <?php 
					   }
					   }
					   ?>
   
					</div>
					<div class="margin_t" id="col_paging" style="margin-top:37px;">
					
						<div class="search_bar_heading">
						<?php
						$count_array = count($get_university['university']);
						$map_address='';
						for($no_university = 0; $no_university<$count_array; $no_university++)
						{
						?>
							<div>
								<div class="college_head">
									<div class="float_l margin_zero">
										<h3><a href="<?php echo $base; ?>university/<?php echo $get_university['university'][$no_university]['univ_id']; ?>"><?php echo $get_university['university'][$no_university]['univ_name']; ?></a></h3>
									</div>
									<div class="float_r span4 margin_t1">
										<div class="float_l">
											<div class="float_l"><img src="<?php echo "$base$img_path"; ?>/user.png"></div>
											<div class="float_r margin_l"><small>Followers <?php echo $get_university['followers'][$no_university]; ?></small></div>
										</div>
										<div class="float_r">
											<div class="float_l"><img src="<?php echo "$base$img_path"; ?>/document.png"></div>
											<div class="float_r margin_l"><small>Articles <?php echo $get_university['article'][$no_university]; ?></small></div>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="padding">
									<div class="span7 margin_zero float_l">
										<div class="float_l span3 margin_zero">
												<div>
												<?php 
												$x = $get_university['university'][$no_university]['univ_logo_path'];
												if($x != '')
												{ ?>
							<a href="<?php echo $base; ?>university/<?php echo $get_university['university'][$no_university]['univ_id']; ?>"><img class='univ_logo' src='<?php echo $base; ?>uploads/univ_gallery/<?php echo $x; ?>'></a>
											<?php	}
												else{ ?>
											<a href="<?php echo $base; ?>university/<?php echo $get_university['university'][$no_university]['univ_id']; ?>"><img class='university_logo' src='<?php echo "$base"; ?>uploads/univ_gallery/univ_logo.png'></a>
							
											<?php	}
												?>
												</div>
										</div>
										<div class="float_r span4 margin_l data_limited">
											<?php
					/*$univ_detail=str_replace("<div>","<p>",$get_university['university'][$no_university]['about_us']);
					$univ_detail=str_replace("</div>","</p>",$univ_detail);
					echo $univ_detail;*/
											?>
										</div>
									</div>
									<div class="float_l">
										<div class="college_data_right"></div>
									</div>
									<div class="float_r span5 margin_zero">
										<h3>Offering Courses in</h3>
											<ul class="question college_list_data margin_zero">
												<?php 
												if($get_university['program'][$no_university] != '')
												{
												foreach($get_university['program'][$no_university] as $prog) {
												if(is_array($prog))
													{ ?>
														
														
 <li><a href="<?php echo $base; ?>program_detail/<?php echo $get_university['university'][$no_university]['univ_id'].'/'.$prog['prog_id']; ?>"><?php echo $prog['course_name']; ?></a></li>
														<?php
														
													}
												}
												}
												?>
										</ul>
									</div>
									<div class="clearfix"></div>
									<div>
										<div class="float_l">
										<h4></h4>
										</div>
										<div class="float_r">
											<input type="submit" value="Request Information" class="btn btn-success" name="request_information_submit" />
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
									<div class="clearfix"></div>
							</div>
							<?php
							$map_address.=  $get_university['university'][$no_university]['univ_name'].'univ_name#@$%univ_name'.$get_university['university'][$no_university]['address_line1'].'map#@$%map';
							}
							?>
				
							</div>
						</div>
					</div>
			
				<div class="float_r span3">
					<img src="<?php echo "$base$img_path"; ?>/banner_img.png" />
				</div>
			
				<div class="clearfix"></div>
		
			</div>
			<div id="pagination" style="margin-top:15px;" class="table_pagination paging-margin">
   
           <?php
		   $cc=$get_university['total_res'];
		   $rl=$get_university['limit_res']; 
		   if($cc>$rl)
		   {
		   $z=0;
		   for($c=$cc;$c>0;$c=$c-$rl)
		   {
		   ?>
		  <a href="#" id="paging_<?php echo $z; ?>" <?php if($z==0){ ?> class="add_paging_background_class paging_<?php echo $z; ?>" <?php }else { ?> class="paging_<?php echo $z; ?>" <?php } ?> onclick="ajax('<?php echo ($rl*$z); ?>','paging_<?php echo $z; ?>')"><?php echo ++$z; ?></a>
		 <?php 
		   }
		   }
		   ?>
   
            </div>
			</div>
		</div>
	</div>
<div id="map_address_list" style="display:none"><?php echo $map_address; ?></div>
<script>
var cpage=0;
function onstudylevel(educ_lvl_id,educ_lvl_name)
{
educ_lvl_name =  educ_lvl_name.replace(/[^a-zA-Z 0-9]+/g,'');
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

	prog_parent_name =  prog_parent_name.replace(/[^a-zA-Z 0-9]+/g,'');

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
	prog_name =  prog_name.replace(/[^a-zA-Z 0-9]+/g,'');
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
 
 function ajax(a,pid)
{
	
	if(a!=cpage)	
	{
	$('#pagination a').removeClass('add_paging_background_class');
	 $('.'+pid).addClass('add_paging_background_class');
	$('#ajax_loader_paging').css('z-index','9');
	$('#col_paging').css('opacity','0.4');
	cpage=a;
 	   $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>auth/all_colleges_paging/<?php echo $country_arrow;?>/<?php echo $educ_arrow;?>/<?php echo $course_arrow;?>/<?php echo $prog_arrow;?>",
	   async:false,
	   data: 'offset='+a,
	   cache: false,
	   success: function(msg)
	   {
	   	
		$('#col_paging').animate({
		'opacity':1
		},1000,function(){
		});
		$('#ajax_loader_paging').animate({
		'z-index':'-9'
		},800,function(){
		});
		$('#col_paging').html(msg);
	   }
	   })
	   
   }
 }
 
</script>
	