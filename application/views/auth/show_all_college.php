<script type="text/javascript" src="<?php echo "$base$js";?>/jquery.tinysort.js"></script>
<script>
$(document).ready(function(){
			FixImages(true);
});			
</script>
<?php
$count_array = count($get_university['university']);						
$this->session->unset_userdata('follow_to_univ');
//print_r($get_university['university']); ?>
<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row margin_t1">
				<div class="float_l span12 margin_l">
					<div class="start_bar">
						<div class="float_l"><h3>Viewing 1 - <span id="listed_currently_univ"><?php echo count($get_university['university']); ?></span> universities of <span id="red_total_univ"> <?php echo $get_university['total_res']; ?></span>.</h3></div>
						<div class="float_r">
							<div class="sort_contanier">
								<ul class="sort_list">
									<li><h4>Sort By:</h4></li>
									<li id="sort_country"><a href="javascript:void(0)" class="active" onclick="sortBy('country','desc','sort_country','Country')">Country</a>
									</li>
									
									<li id="sort_univ_name"><a href="javascript:void(0)" onclick="sortBy('univ_name','desc','sort_univ_name','University Name')">University Name</a></li>
									<li id="sort_event_date"><a href="javascript:void(0)" onclick="sortBy('date','desc','sort_event_date','Events')">Events</a></li>
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
							<?php 
							foreach($country as $countries) { 
							$sel='';
							$country_name=str_replace(' ','_',$countries['country_name']);	
							//$country_name=str_replace(' ','_',$country_name);	
							?>	
											<li  href="/<?php echo $country_name; ?>">
		<?php 
		
		if(in_array($countries['country_id'],$get_university['filter_country']))
		{
		$sel='checked';
		}
		?>									
		<input type="checkbox" class="search_chkbox" <?php echo $sel; ?>> <?php echo ucwords($countries['country_name']);;
							 ?></li>
								<?php } ?>					
									</ul>
									
								</div>
								<div class="margin_t">
									<h4>Education Level</h4>
									<ul class="col_filter_list">
										<?php foreach($fetch_educ_level as $fetch_educ_levels) {
							$educ_sel='';			
							if(in_array($fetch_educ_levels['prog_edu_lvl_id'],$get_university['filter_educ_level']))
							{
							$educ_sel='checked';
							}						
							$educ_level=str_replace(' ','_',$fetch_educ_levels['educ_level']);	
							//$educ_level=str_replace(' ','_',$educ_level);		
										?>			
			<li href="/<?php echo $educ_level; ?>"><input type="checkbox" class="search_chkbox" <?php echo $educ_sel; ?>> 
			<?php echo ucwords($fetch_educ_levels['educ_level']); ?></li>	
										<?php } ?>
											
										  
									</ul>
									
								</div>
								<div class="margin_t">
									<h4>Area of Interest</h4>
									<ul class="col_filter_list">
										<?php foreach($fetch_area_intrest as $fetch_area_intrest1) { 
							$area_interest_sel='';			
							if(in_array($fetch_area_intrest1['prog_parent_id'],$get_university['filter_area_intrest']))
							{
							$area_interest_sel='checked';
							}			
										$area_intrest=str_replace(' ','_',$fetch_area_intrest1['program_parent_name']);	
										?>			
		<li href="/<?php echo $area_intrest; ?>"><input type="checkbox" class="search_chkbox" <?php echo $area_interest_sel; ?>><?php echo ucwords($fetch_area_intrest1['program_parent_name']); ?></li>	
										<?php } ?>
									</ul>
									
								</div>
							</div>
						</div>
						<div class="float_r" id="search_results">
						<?php if(!($count_array)){ ?>
						<div class="events_holder_box margin_t"><h3>Sorry,NO Result Found</h3></div>
						<?php } ?>
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
						 <a style="cursor:pointer" id="paging_<?php echo $z; ?>" <?php if($z==0){ ?> class="add_paging_background_class paging_<?php echo $z; ?>" <?php }else { ?> class="paging_<?php echo $z; ?>" <?php } ?> onclick="ajax('<?php echo ($rl*$z); ?>','paging_<?php echo $z; ?>')"><?php echo ++$z; ?></a>
						 <?php 
						   }
						   }
						   ?>
						   <input type="hidden" id="current_paging_value" value="0">	
							</div>
						<div class="clearfix"></div>
						<div id="col_paging">
						
						<?php
						$map_address='';
						
						for($no_university = 0; $no_university<$count_array; $no_university++)
						{
						?>
		<div class="events_holder_box margin_t" date="<?php echo date("m-d-Y", strtotime($get_university['univ_event'][$no_university][0]['event_date_time'])); ?>" country="<?php echo $get_university['university'][$no_university]['country_name']; ?>" univ_name="<?php echo $get_university['university'][$no_university]['univ_name']; ?>">
								<div class="row">
									<div class="span6 float_l margin_l margin_t1">
										<h3><span><a href="<?php echo $base; ?>university/<?php echo $get_university['university'][$no_university]['univ_id']; ?>" >
										
										<?php echo $get_university['university'][$no_university]['univ_name']; ?></a></span>- 
										<?php echo $get_university['university'][$no_university]['country_name']; ?></h3>
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
											<div class="col_list_logo aspectcorrect" style="position: absolute;z-index: 100;>
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
											<div class="apply">
												<span class="green"><img src="<?php echo $base; ?>	images/tick.gif"><a href="#">Apply</a></span>
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
											<div class="events_dates float_l" onclick="gotoevent('<?php echo $get_university['university'][$no_university]['univ_id']  ;?>','<?php echo $get_university['univ_event'][$no_university][0]['event_id']; ?>');" style="cursor:pointer;">
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
												<?php if($get_university['is_already_follow'][$no_university]=='0'){ ?>Follow<?php } else { ?>Unfollow<?php } ?>
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
					<img src="<?php echo "$base$img_path" ?>/banner_img.png">
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
		   $('.follow_univ_'+univ_id).html('Unfollow');
		   }
		   else if(msg=='nowunfollowed')
		   {
		   follow_count=parseInt(follow_count)-1;
		   $('#follow_count_'+univ_id).val(follow_count);
		   $('.follow_univ_'+univ_id).html('Follow');
		   }
		   $('.followers_'+univ_id).html(follow_count);
		   }
		   
	   }
	   });
}
function ajax(a,pid)
{

	cpage=$('#current_paging_value').val();
	if(a!=cpage)	
	{
	var url=document.URL;
	var change_url=url.split('colleges/');
	if(!(change_url.length>1 && change_url[1]!=''))
	{
	url='<?php echo $base; ?>colleges';
	}
	$('#pagination a').removeClass('add_paging_background_class');
	 $('.'+pid).addClass('add_paging_background_class');
	//$('#ajax_loader_paging').css('z-index','9');
	$('#col_paging').css('opacity','0.4');
	$('#current_paging_value').val(a);
 	   $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>auth/all_colleges_paging",
	   async:false,
	   data: 'offset='+a+'&current_url='+url,
	   cache: false,
	   success: function(r)
	   {
	    res=r.split('!@#$%^&*');
		$('#col_paging').animate({
		'opacity':1
		},1000,function(){
		});
		$('#col_paging').html(res[0]);
		$('#listed_currently_univ').html(res[1]);
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
	   success: function(r)
	   {
	   res=r.split('!@#$%^&*');
	   $('#search_results').animate({
		'opacity':1
		},1000,function(){
		});
		if(res[2]!='0' && res[1]!='0')
		{
		$('#search_results').html(res[0]);
		}
		else
		{
		$('#search_results').html('<div class="events_holder_box margin_t"><h3>Sorry,NO Result Found</h3></div>');	
		}
	  	$('#listed_currently_univ').html(res[2]);
	    $('#red_total_univ').html(res[1]);
	   }
	   })
}
function sortBy(what,orderBy,id,text){
$('.sort_list a').removeClass('active');
var od='desc';
if(orderBy=='desc')
{
od='asc';
}
$('#'+id).html('<a href="javascript:void(0)" class="active" onclick="sortBy(\''+what+'\',\''+od+'\',\''+id+'\',\''+text+'\')">'+text+'</a>');

 $('.events_holder_box').tsort('',{attr:what,order:orderBy});

}

function gotoevent(univ_id,event_id)
{
if(univ_id!='' && event_id!='')
{
window.location='<?php echo $base; ?>univ-'+univ_id+'-event-'+event_id;
}
}

</script>	 