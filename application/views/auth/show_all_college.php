<script type="text/javascript" src="<?php echo "$base$js";?>/jquery.tinysort.js"></script>
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
						<div class="float_l"><h3>Viewing 1 - <span id="listed_currently_univ"><?php echo $get_university['per_page_res']; ?></span> universities of <span id="red_total_univ"> <?php echo $get_university['total_res']; ?></span>.</h3></div>
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
									<?php $count_country = count($country); ?>
									<input type="hidden" id="total_records_country" value="<?php echo $count_country; ?>"/>
							<?php 
							foreach($country as $countries) { 
							$sel='';
							$country_name=str_replace(' ','_',$countries['country_name']);	
							//$country_name=str_replace(' ','_',$country_name);	
							?>	
											<li class="listitem_country"  href="/<?php echo $country_name; ?>">
		<?php 
		
		if(in_array($countries['country_id'],$get_university['filter_country']))
		{
		$sel='checked';
		}
		?>									
		<label class="checkbox"><input type="checkbox" class="search_chkbox" <?php echo $sel; ?>> <?php echo $countries['country_name'];
							 ?></label></li>
								<?php } ?>	
		<?php if($count_country > 5) { ?>											
		<li class="more_country"> <div style="cursor:pointer; width:60px;height:20px;background-color: whiteSmoke;"> showmore </div>  </li>
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
			<li href="/<?php echo $educ_level; ?>"><label class="checkbox"><input type="checkbox" class="search_chkbox" <?php echo $educ_sel; ?>> 
			<?php echo $fetch_educ_levels['educ_level']; ?></label></li>	
										<?php } ?>
											
										  
									</ul>
									
								</div>
								<div class="margin_t">
									<h4>Area of Interest</h4>
									<?php $count_area_of_interest = count($fetch_area_intrest); ?>
									<input type="hidden" id="total_records_area_interest" value="<?php echo $count_area_of_interest; ?>"/>
									<ul class="col_filter_list">
										<?php 
										foreach($fetch_area_intrest as $fetch_area_intrest1) { 
							$area_interest_sel='';			
							if(in_array($fetch_area_intrest1['prog_parent_id'],$get_university['filter_area_intrest']))
							{
							$area_interest_sel='checked';
							}			
										$area_intrest=str_replace(' ','_',$fetch_area_intrest1['program_parent_name']);	
										?>	
										
		<li class="area_of_interest" href="/<?php echo $area_intrest; ?>"><label class="checkbox"><input type="checkbox" class="search_chkbox" <?php echo $area_interest_sel; ?>><?php echo $fetch_area_intrest1['program_parent_name']; ?></label></li>	
										<?php } ?>
        <?php if($count_area_of_interest > 5) { ?>											
		<li class="more"> <div style="cursor:pointer; width:60px;height:20px;background-color: whiteSmoke;"> showmore </div>  </li>
		<?php } ?>
									</ul>
									
								</div>
							</div>
						</div>
						<form action="<?php echo "$base"; ?>find_college" method="post" id="frm_search_steps">
						<input type="hidden" name="hid_send_univ_id_frm_search" id="hid_send_univ_id_frm_search" value=""/>
						<div class="float_r" id="search_results">
						<?php if(!($count_array)){ ?>
						<div class="events_holder_box margin_t"><h3>Sorry,NO Result Found</h3></div>
						<?php } ?>
						
							<div id="pagination" class="table_pagination right paging-margin">
   
						   <?php
						   $cc=$get_university['total_res'];
						   $rl=$get_university['limit_res']; 
						   if($cc>$rl)
						   {
						   $z=0;
						   for($c=$cc;$c>0;$c=$c-$rl)
						   {
						   ?>
						 <a style="cursor:pointer" id="paging_<?php echo $z; ?>" <?php if($z==0){ ?> class="add_paging_background_class paging_<?php echo $z; ?>" <?php }else { ?> class="paging_<?php echo $z; ?>" <?php } ?> onclick="ajaxpaging('<?php echo ($rl*$z); ?>','paging_<?php echo $z; ?>')"><?php echo ++$z; ?></a>
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
						$cnt = 1;
						for($no_university = 0; $no_university<$count_array; $no_university++)
						{
						$subdomain_name=$get_university['university'][$no_university]['subdomain_name'];
						$domain_name_url=$this->subdomain->generate_univ_link_by_subdomain($subdomain_name);				

						?>
		<div class="events_holder_box margin_t" date="<?php echo date("m-d-Y", strtotime($get_university['univ_event'][$no_university][0]['event_date_time'])); ?>" country="<?php echo $get_university['university'][$no_university]['country_name']; ?>" univ_name="<?php echo $get_university['university'][$no_university]['univ_name']; ?>">
								<div class="row">
									<div class="span8 float_l margin_l margin_t1">			
										<h3><span><a href="<?php echo $domain_name_url ?>" >
										
										<?php echo $get_university['university'][$no_university]['univ_name']; ?></a></span>- 
										<?php echo $get_university['university'][$no_university]['country_name']; ?></h3>
									</div>
									<div class="float_r">
										
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="margin_t1"> 
									<div class="float_l margin_zero" style="width:310px;">
										<div class="float_l span2 margin_zero">
											<div class="col_list_logo aspectcorrect" style="position: absolute;z-index: 100;">
												<?php
							$image_exist=0;	
							$univ_img = $get_university['university'][$no_university]['univ_logo_path'];	
						    if(file_exists(getcwd().'/uploads/univ_gallery/'.$univ_img) && $univ_img!='')	
							{
							
							$image_exist=1;
							list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/univ_gallery/'.$univ_img);
							}
							else
							{
							list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/univ_gallery/univ_logo.png');
							}
							if($univ_img!='' && $image_exist==1)
							{
							$image=$base.'uploads/univ_gallery/'.$univ_img;
							}
							else
							{
							$image=$base.'uploads/univ_gallery/univ_logo.png';
							} 
							$img_arr=$this->searchmodel->set_the_image($width,$height,110,115,TRUE);
							?>

							<a href="<?php echo $domain_name_url; ?>">
							<img  title="<?php echo $get_university['university'][$no_university]['univ_name']; ?>" src='<?php echo $image;?>' style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" />
							</a>
											
											</div>
											<div class="apply">
												<span id="send_steps_span">
											<input type="hidden" id="steps_univ_id_<?php echo $cnt; ?>" name="steps_univ_id_<?php echo $cnt; ?>" value="<?php echo $get_university['university'][$no_university]['univ_id']; ?>"
												<span class="green"><img src="<?php echo $base; ?>	images/tick.gif"/><a href="javascript:void(0);" id="<?php echo $cnt; ?>" onclick="send_steps(this);">Apply</a></span>
											</span>
											</div>
										</div>
										<div class="float_r course_des margin_l" style="margin-left:0px!important;">
											<?php 
											$overview=$get_university['university'][$no_university]['univ_overview'];
											echo substr($overview,0,205);
											if(strlen($overview)>205)
											{
											
		$univ_about_link=$this->subdomain->genereate_the_subdomain_link($subdomain_name,'about','',''); ?>											
											..<div class="float_r">
											<a href="<?php echo $univ_about_link; ?>">View all&raquo;
											</a></div>
											<?php } ?>										
											
										</div>
									</div>
									<div class="float_r page2_col" style="width:254px;">
										<div class="float_l done margin_l">
										<?php
										$univ_name= str_replace(' ','-',$get_university['university'][$no_university]['univ_name']);
									$univ_name= strtolower($univ_name);
									$univ_name=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $univ_name);	
										?>
											<div class="events_dates float_l" onclick="gotoevent('<?php echo $get_university['university'][$no_university]['univ_id']  ;?>','<?php echo $univ_name  ;?>');" style="cursor:pointer;">
												<div class="red_box">
													Events
												</div>
												<div class="padding1">
													<div class="float_l margin_t1">
													<?php 
													if($get_university['univ_event'][$no_university]!=0)
													{
													$event_has=1;
													$date=$get_university['univ_event'][$no_university][0]['event_date_time']; 
													$date_part=explode(' ',$date);
													
													?>
														<span class="date"><?php echo $date_part[0]; ?></span>
													</div>
													<div class="span1 float_l margin_l">
														<span>
				
														<span class="blue"><?php if($event_has) { echo $date_part[1]; ?> </span><br/>
						<?php if($get_university['univ_event'][$no_university][0]['cityname']!='') {
											echo ucwords($get_university['univ_event'][$no_university][0]['cityname']); }
											} ?><br />
											<?php if($get_university['univ_event'][$no_university][0]['country_name']!='') {
											echo ucwords($get_university['univ_event'][$no_university][0]['country_name']);
											} ?><br />
													
										
														</span>
											<?php } else { ?>
											
											<div class="center">
														<span >No Recent Event </span> </div><?php } ?>			
													</div>
													</div>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="float_r page4_col margin_l">
											<ul>
	<?php 
	$article_url=$this->subdomain->genereate_the_subdomain_link($subdomain_name,'university_articles','',''); 
	$programs=$this->subdomain->genereate_the_subdomain_link($subdomain_name,'programs','',''); 
	$questions=$this->subdomain->genereate_the_subdomain_link($subdomain_name,'Questions_Answers','',''); 
	?>										
												<li><a href="<?php echo $article_url; ?>">Articles (<span class="blue"><?php echo $get_university['article'][$no_university]; ?></span>)</a></li>
												<li><a href="<?php echo $questions; ?>">Q/A (<span class="blue"><?php echo $get_university['questions'][$no_university]; ?></span>)</a></li>
												<li>Followers (<span class="blue followers_<?php echo $get_university['university'][$no_university]['univ_id']; ?>"><?php echo $get_university['followers'][$no_university]; ?></span>)</li>
												<li><a href="<?php echo $programs; ?>">Courses(<span class="blue"><?php echo count($get_university['program'][$no_university]); ?></span>)</a></li>
												
												<!--<li><a href="#">E-Brochure</a></li>-->
											</ul>
										</div>
										<div class="clearfix"></div>
										<div>
											<div class="float_l top_page">
												Views: <span class="blue"><?php echo $get_university['university'][$no_university]['univ_views_count']; ?></span>
											</div>
											<div class="float_l top_page margin_l">
												&nbsp;&nbsp;Listed: <span class="blue"><?php 
												$viwed=$get_university['university'][$no_university]['univ_views_count'];
												echo $listed=ceil((($viwed*5)/3))+10;
												?></span>
												
											</div>
											<div class="last_box_col float_r">
												<img src="<?php echo "$base$img_path"; ?>/add.png" class="img_set">
				<span class="margin_l follow_univ_<?php echo $get_university['university'][$no_university]['univ_id']; ?>" onclick="follow_university('<?php echo $get_university['university'][$no_university]['univ_id']; ?>','<?php echo $get_university['followers'][$no_university]; ?>')" style="cursor:pointer;">
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
					<?php $cnt++; } ?>	
						</div>
						<!--paging start-->
						<div id="pagination" class="table_pagination right paging-margin" style="margin-top:20px;">
   
						   <?php
						   $cc=$get_university['total_res'];
						   $rl=$get_university['limit_res']; 
						   if($cc>$rl)
						   {
						   $z=0;
						   for($c=$cc;$c>0;$c=$c-$rl)
						   {
						   ?>
						 <a style="cursor:pointer" id="paging_<?php echo $z; ?>" <?php if($z==0){ ?> class="add_paging_background_class paging_<?php echo $z; ?>" <?php }else { ?> class="paging_<?php echo $z; ?>" <?php } ?> onclick="ajaxpaging('<?php echo ($rl*$z); ?>','paging_<?php echo $z; ?>')"><?php echo ++$z; ?></a>
						 <?php 
						   }
						   }
						   ?>
						   <input type="hidden" id="current_paging_value" value="0">	
						</div>
						<!--paging end -->
						
						
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="span4 float_r">
					<a href="http://university-of-greenwich.meetuniversities.com/university_events"><img src="<?php echo "$base$img_path" ?>/banner_img.png"></a>
					
				</div>
				<div class="clearfix"></div>
			</div>
			
		</div>
		</form>
		
								
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
function ajaxpaging(a,pid)
{
	$('#search_results').css('opacity','0.4');
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
	$('#current_paging_value').val(a);
 	   $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>auth/all_colleges_paging",
	   data: 'offset='+a+'&current_url='+url,
	   cache: false,
	   success: function(r)
	   {
	    res=r.split('!@#$%^&*');
		$('#col_paging').html(res[1]);
		$('#listed_currently_univ').html(res[0]);
		$("#search_results").css('opacity','1');
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
	    document.title=res[0];
	   $('#search_results').animate({
		'opacity':1
		},1000,function(){
		});
		if(res[3]!='0' && res[2]!='0')
		{
		$('#search_results').html(res[3]);
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

function gotoevent(univ_id,univ_name)
{
/*if(univ_id!='' && event_id!='')
{
window.location='<?php echo $base ?><?php echo $univ_id_for_program; ?>/university/'+univ_name+'/events';
}*/
}
function send_steps(atr)
{
var x = atr.id;
var txt_val = $('#steps_univ_id_'+x).val();
$('#hid_send_univ_id_frm_search').val(txt_val);
$('#frm_search_steps').submit();
//redirect(find_college);
}
</script>	 

<script>
$(".area_of_interest").hide();
$(".area_of_interest").slice(0,5).show();

$(".more").click(function(){
var showing = $(".area_of_interest:visible").length;
$(".area_of_interest").slice(showing - 5, showing + 5).show();
var area_interest_record = $("#total_records_area_interest").val();
var total_list_item_area_interest = $(".area_of_interest:visible").length;
if(total_list_item_area_interest == area_interest_record)
{
	$(".more").hide();
}
});

$(".listitem_country").hide();
$(".listitem_country").slice(0,5).show();

$(".more_country").click(function(){
var showing = $(".listitem_country:visible").length;
$(".listitem_country").slice(showing - 5, showing + 5).show();
var country_record = $("#total_records_country").val();
var total_list_item_country = $(".listitem_country:visible").length;
if(total_list_item_country == country_record)
{
	$(".more_country").hide();
}
});
</script>