<?php
$this->session->unset_userdata('follow_to_univ');
//print_r($get_university['university']); ?>
<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row margin_t1">
				<div class="float_l span12 margin_l">
					<div class="start_bar">
						<div class="float_l"><h3>Viewing 1 - <?php echo count($get_university['university']); ?> universities of 350<?php //print_r($get_university['total_univ']); ?>.</h3></div>
						<div class="float_r">
							<div class="sort_contanier">
								<ul class="sort_list">
									<li><h4>Sort By:</h4></li>
									<li><a href="#" class="active">Country</a></li>
									<li><a href="#">University Name</a></li>
									<li><a href="#">Events</a></li>
								</ul>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="margin_t">
						<div class="float_l">
							<div class="fliters_data">
								<h3>Filter your Search</h3>
								<div class="margin_t">
									<h4>Country</h4>
									<ul class="col_filter_list">
							<?php foreach($country as $countries) { 
							$country_name=str_replace(',','_',$countries['country_name']);	
							//$country_name=str_replace(' ','_',$country_name);	
							?>	
											<li  href="/<?php echo $country_name; ?>"><input type="checkbox" class="search_chkbox"> <?php echo ucwords($countries['country_name']); ?></li>
								<?php } ?>					
									</ul>
									
								</div>
								<div class="margin_t">
									<h4>Education Level</h4>
									<ul class="col_filter_list">
										<?php foreach($fetch_educ_level as $fetch_educ_levels) { 
							$educ_level=str_replace(',','_',$fetch_educ_levels['educ_level']);	
							//$educ_level=str_replace(' ','_',$educ_level);		
										?>			
			<li href="/<?php echo $educ_level; ?>"><input type="checkbox" class="search_chkbox"> <?php echo ucwords($fetch_educ_levels['educ_level']); ?></li>	
										<?php } ?>
											
										  
									</ul>
									
								</div>
								<div class="margin_t">
									<h4>Area of Interest</h4>
									<ul class="col_filter_list">
										<?php foreach($fetch_area_intrest as $fetch_area_intrest1) { 
										$area_intrest=str_replace(',','_',$fetch_area_intrest1['program_parent_name']);	
									//	$area_intrest=str_replace(' ','_',$area_intrest);	
										?>			
		<li href="/<?php echo $area_intrest; ?>"><input type="checkbox" class="search_chkbox"><?php echo ucwords($fetch_area_intrest1['program_parent_name']); ?></li>	
										<?php } ?>
									</ul>
									
								</div>
							</div>
						</div>
						<div class="float_r" id="search_results">
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
						<div class="clearfix"></div>
						<div id="col_paging">
						<?php
						$count_array = count($get_university['university']);
						$map_address='';
						for($no_university = 0; $no_university<$count_array; $no_university++)
						{
						?>
							<div class="events_holder_box margin_t">
								<div class="row">
									<div class="span6 float_l margin_l margin_t1">
										<h3><span><a href="<?php echo $base; ?>university/<?php echo $get_university['university'][$no_university]['univ_id']; ?>" >
										<?php echo $get_university['university'][$no_university]['univ_name']; ?></a></span>- 
										United Kingdom</h3>
									</div>
									<div class="float_r">
										<!--<div class="box_col">
										<div class="fb-like float_l" data-href="<?php echo $base;?>university/<?php echo $get_university['university'][$no_university]['univ_id']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div>
										<div class="float_r">
										<a href="https://twitter.com/share" data-url="<?php echo $base;?>university/<?php echo $get_university['university'][$no_university]['univ_id']; ?>"  class="twitter-share-button" data-count="none">Tweet</a>
										</div>
										<div class="clearfix"></div>
										</div>-->
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="margin_t1"> 
									<div class="float_l margin_zero">
										<div class="float_l span2 margin_zero">
											<div class="col_list_logo">
												<?php 
												$x = $get_university['university'][$no_university]['univ_logo_path'];
												if($x != '')
												{ ?>
							<a href="<?php echo $base; ?>university/<?php echo $get_university['university'][$no_university]['univ_id']; ?>"><img  title="<?php echo $get_university['university'][$no_university]['univ_name']; ?>" src='<?php echo $base; ?>uploads/univ_gallery/<?php echo $x; ?>'></a>
											<?php	}
												else{ ?>
											<a href="<?php echo $base; ?>university/<?php echo $get_university['university'][$no_university]['univ_id']; ?>"><img title="<?php echo $get_university['university'][$no_university]['univ_name']; ?>" src='<?php echo "$base"; ?>uploads/univ_gallery/univ_logo.png'></a>
							
											<?php	}
												?>
											</div>
										</div>
										<div class="float_r courses_data margin_l">
											<h4>Courses Offered</h4>
											<ul class="courses_list_style">
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
											<div class="float_r more_style"><a href="<?php echo $base; ?>univ_programs/<?php echo $get_university['university'][$no_university]['univ_id']  ;?>/program">View all&raquo;</a></div>
										</div>
									</div>
									<div class="float_r page2_col">
										<div class="float_l done margin_l">
											<div class="events_dates float_l">
												<div class="red_box">
													Events
												</div>
												<div>
													<div class="float_l margin_t">
													<?php 
													if($get_university['univ_event'][$no_university]!=0)
													{
													$event_has=1;
													$date=$get_university['univ_event'][$no_university][0]['event_date_time']; 
													$date_part=explode(' ',$date);
													
													?>
														<span class="date"><?php echo $date_part[0]; ?></span>
													</div>
													<div class="float_l margin_t1">
														<span style="font-size:18px;">
														<?php if($event_has) { echo $date_part[1]; ?> <br/>
											<?php if($get_university['univ_event'][$no_university][0]['country_name']!='') {
											echo ucwords($get_university['univ_event'][$no_university][0]['country_name']);
											} ?><br />
													
											<?php if($get_university['univ_event'][$no_university][0]['cityname']!='') {
											echo ucwords($get_university['univ_event'][$no_university][0]['cityname']); }
											} ?><br />
														</span>
											<?php } else { ?>
											
											<div class="float_l margin_t1">
														<span style="font-size:18px;">No Recent Event </span> </div><?php } ?>			
													</div>
													</div>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="float_r page4_col margin_l">
											<ul>
												<li><a href="<?php echo $base; ?>univ-<?php echo $get_university['university'][$no_university]['univ_id']; ?>-articles">Articles (<span class="blue"><?php echo $get_university['article'][$no_university]; ?></span>)</a></li>
												<li><a href="<?php echo $base; ?>UniversityQuestSection/<?php echo $get_university['university'][$no_university]['univ_id']; ?>">Q/A (<span class="blue"><?php echo $get_university['questions'][$no_university]; ?></span>)</a></li>
												<li><a href="#">Followers (<span class="blue followers_<?php echo $get_university['university'][$no_university]['univ_id']; ?>"><?php echo $get_university['followers'][$no_university]; ?></span>)</a></li>
												<li><a href="#">E-Brochure</a></li>
											</ul>
										</div>
										<div class="clearfix"></div>
										<div>
											<div class="float_l top_page">
												Views: <span class="blue"><?php echo $get_university['university'][$no_university]['univ_views_count']; ?></span>
											</div>
											<div class="float_l top_page margin_l">
												&nbsp;&nbsp;Listed: <span class="blue">2980</span>
											</div>
											<div class="last_box_col float_r">
												<img src="<?php echo "$base$img_path"; ?>/add.PNG"/>
				<span class="green follow_univ_<?php echo $get_university['university'][$no_university]['univ_id']; ?>" onclick="follow_university('<?php echo $get_university['university'][$no_university]['univ_id']; ?>','<?php echo $get_university['followers'][$no_university]; ?>')" style="cursor:pointer;">
												<?php if($get_university['is_already_follow'][$no_university]=='0'){ ?>Follow University<?php } else { ?>Unfollow University <?php } ?>
									   </span>
		<input type="hidden" id="follow_count_<?php echo $get_university['university'][$no_university]['univ_id']; ?>" value="<?php echo $get_university['followers'][$no_university]; ?>">								
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="clearfix"></div>
							</div>
					<?php } ?>	
						</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="span4 float_r">
					<div class="college_form">
						<div>
						<h2 class="text_align">I AM INTERESTED</h2>
							<span>Interested in studying at Manipal University, Dubai Campus (RCPL)</span>
							<div class="fcnt_signBtn"></div>or Fill details for the institute to counsel you
							<div class="margin_t text_align"> 
								<form class="form-horizontal">
									<fieldset>
										<div class="control-group">
											<input type="text" class="input-medium" placeholder="Name">
										</div>
										<div class="control-group">
											<select name="apply_course_interest" style="width:162px;" id="apply_course_interest" class="grid_1 box_select ">
												<option>Department of Engineering</option>
												<option>Department of Information Technology</option>
												<option>Department of Management</option>
												<option>Department of Bio Technology</option>
											</select>
										</div>
										<div class="control-group">
											<input type="text" class="input-medium" placeholder="Email Id">
										</div>
										<div class="control-group">
											<input type="text" class="input-medium" placeholder="Mobile Number">
										</div>
										<div class="control-group">
												<p class="help-block margin_alpha margin_b">Type in the characters you see below</p>
											<div class="float_l">
												<img src="<?php echo "$base$img_path"; ?>/Captcha.jpg">
											</div>
											<div class="float_r margin_t">
												<input type="text" class="input_small">
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="control-group">
											<button class="btn btn-primary" href="#">Apply Now!</button>
										</div>
									</fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			
		</div>
		<!--<div id="pagination" style="margin-top:15px;margin-left:410px;" class="table_pagination paging-margin">
   
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
						</div>-->
	</div>
<script>
var cpage=0;
function follow_university(univ_id,follow_count)
{	
 follow_count=$('#follow_count_'+univ_id).val();
	$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>univ/follow_to_univ",
	   data: 'univ_id='+univ_id,
	   cache: false,
	   success: function(msg)
	   {
		   if(msg=='login')
		   {
		   window.location='<?php echo $base; ?>login';
		   }
		   else 
		   {
		   if(msg=='nowfollowed')
		   {
		   follow_count=parseInt(follow_count)+1;
		   $('#follow_count_'+univ_id).val(follow_count);
		   $('.follow_univ_'+univ_id).html('Unfollow Univeristy');
		   }
		   else if(msg=='nowunfollowed')
		   {
		   follow_count=parseInt(follow_count)-1;
		   $('#follow_count_'+univ_id).val(follow_count);
		   $('.follow_univ_'+univ_id).html('Follow Univeristy');
		   }
		   $('.followers_'+univ_id).html(follow_count);
		   }
		   
	   }
	   });
}
function ajax(a,pid)
{
	if(a!=cpage)	
	{
	$('#pagination a').removeClass('add_paging_background_class');
	 $('.'+pid).addClass('add_paging_background_class');
	//$('#ajax_loader_paging').css('z-index','9');
	$('#col_paging').css('opacity','0.4');
	cpage=a;
 	   $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>auth/all_colleges_paging",
	   async:false,
	   data: 'offset='+a,
	   cache: false,
	   success: function(msg)
	   {
	   $('#col_paging').animate({
		'opacity':1
		},1000,function(){
		});
		$('#col_paging').html(msg);
	   }
	   })
	   
   }
 }
		var href=document.URL;;
		$(function() {
			$('.search_chkbox').click(function(e) {
			if($(this).is(':checked'))
			{
			lastcharhref=href.charAt( href.length-1); 
			addhref=$(this).closest("li").attr("href");
			if(lastcharhref=='/')
			{
			addhref=addhref.substr(1);
			}
			href = href+addhref;
			}
			else
			{
			//alert($(this).closest("li").attr("id"));
			href=href.replace($(this).closest("li").attr("href"),'');
			}
			history.pushState('',href,href);
			get_college_result_by_ajax();
			});

			


		});
function get_college_result_by_ajax()
{
	var url=document.URL;
	var change_url=url.split('colleges/');
	if(!(change_url.length>1 && change_url[1]!=''))
	{
	url='<?php echo $base; ?>colleges';
	}
	
	$('#search_results').css('opacity','0.4');
	   $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>auth/all_colleges_search",
	   data: 'current_url='+url,
	   cache: false,
	   success: function(msg)
	   {
	    $('#search_results').animate({
		'opacity':1
		},1000,function(){
		});
	 $('#search_results').html(msg);	
	   }
	   })
}

</script>	 