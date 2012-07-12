<?php
$sms_suc_sess_val = $this->session->userdata('msg_send_suc');
$sms_voice_suc_sess_val = $this->session->userdata('msg_send_suc_voice');
if($sms_suc_sess_val == 1)
{
	$show_suc_msg = "Thanks ! SMS sent to the registered mobile number with the event details";
}
else if($sms_voice_suc_sess_val == 1)
{
	$show_suc_msg = "Thanks ! Will call and remind you about the event";
}
if($sms_suc_sess_val == '1' || $sms_voice_suc_sess_val == '1')
{
?>
	<script>
	$(document).ready(function(){
	$('#show_success').css('display','block');
	$('#show_success').hide();
	$('#show_success').show("show");
	$("#show_success").delay(3000).fadeOut(200);
	});
	</script>
<?php
}
$this->session->unset_userdata('msg_send_suc');
$this->session->unset_userdata('msg_send_suc_voice');
?>

<script type="text/javascript" src="<?php echo $base; ?>js/jquery.tinysort.js"></script>
								
<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row margin_t1">
			<div class="modal" id="show_success" style="display:none;" >
					  <div class="modal-header">
						<a class="close" data-dismiss="modal"></a>
						<h3>Message For You</h3>
					  </div>
					  <div class="modal-body">
						<p><center><h4><?php echo $show_suc_msg; ?></h4></center></p>
					  </div>
					  <div class="modal-footer">
						<!--<a href="#" class="btn">Close</a>-->
						<!--<a href="#" class="btn btn-primary">Save changes</a>-->
					  </div>
				</div>
				
			<div id="myModal" class="model_back modal hide fade">
	<div class="modal-header no_border model_heading">
		<a class="close" data-dismiss="modal">x</a>
		<h3>Event Information</h3>
	</div>
	<div id="event_det" class="modal-body model_body_height">
	
	</div>
	</div>
				<div class="float_l span12 margin_l">
					<div class="start_bar">
						<div class="float_l"><h3>Viewing 1 - <span id="listed_currently_event"><?php echo $events['per_page_res']; ?></span> events of <span id="red_total_univ"> <?php echo $events['total_res']; ?></span>.</h3></div>
						<div class="float_r">
							<div class="sort_contanier">
								<ul class="sort_list">
									<li><h4>Sort By:</h4></li>
									<li id="sort_country"><a href="javascript:void(0)"  onclick="eventsorting('country','desc','sort_country','Country')">Country</a>
									</li>
									
									<li id="sort_univ_name"><a href="javascript:void(0)" onclick="eventsorting('univ_name','desc','sort_univ_name','University Name')">University Name</a></li>
									<li id="sort_event_date"><a href="javascript:void(0)" onclick="eventsorting('date','desc','sort_event_date','Events')" class="active">Events</a></li>
								</ul>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div id="loading_img" style="z-index:-1;margin-left: 405px;margin-top: 197px;position:absolute;"> <img src="<?php echo "$base$img_path"; ?>/ajax-loader.gif"/> </div>
					<div class="margin_t">
						<div class="float_l">
							<div class="fliters_data">
							<?php
							?>
								<h3>Filter your Search</h3>
								<div class="margin_t">
									<h4>Event Type</h4>
									<form class="margin_zero">
										<ul class="col_filter_list">
											
											<li href="/spot_admission"><label class="checkbox">
												<input type="checkbox" class="search_chkbox"  id="" <?php
												if(in_array('spot_admission',$events['filter_event_type']))
												{
												echo "checked";
												} ?> value="">Spot Admission
											</label></li>
											<li href="/fairs"><label class="checkbox" >
							<input type="checkbox" class="search_chkbox" id="" value=""
												<?php
												if(in_array('fairs',$events['filter_event_type']))
												{
												echo "checked";
												} ?>
												> Fairs
											</label></li>
											<li href="/counselling"><label class="checkbox"  >
												<input type="checkbox" class="search_chkbox" <?php
												if(in_array('counselling',$events['filter_event_type']))
												{
												echo "checked";
												} ?>

												>Counselling
											</label></li>
										</ul>
									</form>
								</div>
								<div class="margin_t">
									<h4>Country</h4>
									<form class="margin_zero">
										<ul class="col_filter_list">
											
											<?php
											if(!empty($country_name_having_event) && ($country_name_having_event!=1)) {
											foreach($country_name_having_event as $country_name_having_event){
											$country_name=str_replace(' ','_',$country_name_having_event['country_name']);
											?>
											<li  href="/<?php echo $country_name; ?>"><label class="checkbox">
									<input type="checkbox" id="" class="search_chkbox" value=""
												<?php if(in_array($country_name_having_event['country_id'],$events['filter_country']))
												{
												echo "checked";
												}
												?>												
											   > <?php echo $country_name_having_event['country_name'];?>
											</label></li>
											<?php } } 
										else
										{ ?>
										<li>Sorry,No Country avaliable</li>
										<?php
										}										
										?>	
											
										</ul>
									</form>
									<!--<div class="float_r"><a href="">more</a></div>-->
								</div>
								<div class="margin_t">
									<h4>City</h4>
									<form class="margin_zero">
										<ul class="col_filter_list">
										<?php if(!empty($city_name_having_event) && ($city_name_having_event!=1))
										{
										foreach($city_name_having_event as $city_name_have_event)
										{
										?>
											<li href="/<?php echo $city_name_have_event['cityname']; ?>"><label class="checkbox">
		<input type="checkbox" class="search_chkbox" <?php if(in_array($city_name_have_event['city_id'],$events['filter_city']))
												{
												echo "checked";
												}?>
												id="<?php echo $city_name_have_event['city_id']; ?>"
												value="<?php echo $city_name_have_event['cityname'];?>"> <?php echo $city_name_have_event['cityname'];?>
											</label></li>
										<?php } }
										else
										{ 
										?>
										<li>Sorry,No city avaliable</li>
										<?php
										}										
										?>	
										</ul>
									</form>
									<!--<div class="float_r"><a href="">more</a></div>-->
								</div>
							</div>
						</div>
						<div class="float_r">
						<?php if(!($events['event_res'])){ ?>
						<div class="events_holder_box margin_t"><h3>Sorry,NO Result Found</h3></div>
						<?php } ?>
						
			<div id="event_results_filteration">
									
							<div id="pagination" class="table_pagination right paging-margin">
   
						   <?php
						 $cc=$events['total_res'];
						 $rl=$events['limit_res']; 
						   if($cc>$rl)
						   {
						   $z=0;
						   for($c=$cc;$c>0;$c=$c-$rl)
						   {
						   ?>
						 <a style="cursor:pointer" id="paging_<?php echo $z; ?>" <?php if($z==0){ ?> class="add_paging_background_class paging_<?php echo $z; ?>" <?php }else { ?> class="paging_<?php echo $z; ?>" <?php } ?> onclick="events_result_by_paging('<?php echo ($rl*$z); ?>','paging_<?php echo $z; ?>')"><?php echo ++$z; ?></a>
						 <?php 
						   }
						   }
						   ?>
						   <input type="hidden" id="current_paging_value" value="0">	
							</div>

							<div class="row">
								<div class="span9 float_l margin_zero" id="div_events">
									<?php
$array_dates = array();

									if(!empty($events))
										  {
$count_event_date = 1;										  
											foreach($events['event_res'] as $event_detail){
//code for apply comma in date			
if($count_event_date == 1)
{								
$current_event_month =  $event_detail['event_date_time'];
}
$var_date = '';
//echo $event_detail['event_date_time'];
$extract_date = explode(" ",$event_detail['event_date_time']);
$month = $extract_date[1];
$number_month = date('m', strtotime($month));
$number_month = date('m', strtotime($month));
$var = "'".$number_month.'/'.$extract_date[0].'/'.$extract_date[2]."'";
array_push($array_dates,$var);
$count_event_date++;

//end here 
																			
											?>
									<div class="events_listing padding margin_t" date="<?php echo date("d-m-Y", strtotime($event_detail['event_date_time'])); ?>" country="<?php echo $event_detail['country_name']; ?>" univ_name="<?php echo $event_detail['univ_name']; ?>">
										<div>
											<div class="float_l span7 margin_zero">
		<?php
		$univ_domain=$event_detail['subdomain_name'];
		$event_title=$event_detail['event_title'];
		$event_id=$event_detail['event_id'];
		
		$event_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'event',$event_title,$event_id);
$event_link_register=$this->subdomain->genereate_the_subdomain_link($univ_domain,'event','','');		
		?>		
											<a href="<?php echo $event_link; ?>">
												<h3 class="inline"> <?php echo $event_detail['univ_name']; ?> </h3>
												</a>
												<span class="inline"> &raquo; </span>
												<?php
												echo "<h4 class='inline'>";
												if($event_detail['event_category'] == "spot_admission")
												{
													echo "Spot Admission";
												} 
												else if($event_detail['event_category'] == "fairs")
												{
													echo "Fairs";
												}
												else if($event_detail['event_category'] == "others")
												{
													echo "Counselling";
												}
												else if($event_detail['event_category'] == "alumuni")
												{
													echo "Counselling";
												}
												echo "</h4>";
												echo ' <h5>'.$event_detail['event_title'].'</h5>';
												?>
											</div>
											<?php 
											if($event_detail['event_id'] == 55) { ?>
											<div class="float_r">
												<a onclick="voicepopup('<?php echo $event_detail['event_id']; ?>');" style="cursor:pointer;"><img src="<?php echo $base; ?>images/call.png" title="Reminder Call" alt="Reminder Call"></a>
													<a onclick="popup('<?php echo $event_detail['event_id']; ?>');" style="cursor:pointer;"><img src="<?php echo$base; ?>images/sms.png" title="Send SMS" alt="Send SMS"></a>
													<a href="<?php echo $event_link; ?>"><img src="<?php echo $base; ?>images/map.png" title="Map" alt="Map"></a>
											</div>
											<?php } ?>
											<div class="clearfix"></div>
										</div>
										<div>
											<div class="img_style float_l aspectcorrect">
											<?php
											$image_exist=0;	
									$event_img = $event_detail['univ_logo_path'];	
									if(file_exists(getcwd().'/uploads/univ_gallery/'.$event_img) && $event_img!='')	
									{
									$image_exist=1;
									list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/univ_gallery/'.$event_img);
									}
									else
									{
									list($width, $height, $type, $attr) = getimagesize(getcwd().'/'.$img_path.'/default_logo.png');
								    }
									if($event_img!='' && $image_exist==1)
									{
									$image=$base.'uploads/univ_gallery/'.$event_img;
									}
									else
									{
									$image=$base.$img_path.'/default_logo.png';
									} 
									$img_arr=$this->searchmodel->set_the_image($width,$height,110,75,TRUE);
											?>
											<img style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" src="<?php echo $image; ?>">
												
											</div>
											<div class="float_l span5 margin_l" style="font-size:14px;">
											<?php
											$extract_dates = explode(" ",$event_detail['event_date_time']);
								//echo $extract_date[];
								$months = $extract_dates[1];
								//$number_months = date('m', strtotime($month));
								//echo $extract_date[0];
								//echo $number_months; //= $number_month-1 ;
								//echo $extract_date[2];
								//echo $var = "'".$extract_dates[0].'/'.$extract_dates[1].'/'.$extract_dates[2]."'";
											?>
												<h4 class="blue line_time"><?php echo $extract_dates[0].' '.$extract_dates[1].', '.$extract_dates[2];
												
												 ?></h4>
												<h5 class="line_time">
												<?php
												
												$place=0;
												$city=0;						
												/*if($event_detail['event_place']!='')
												{
												echo $event_detail['event_place'];
												$place=1;
												}*/
												if($event_detail['cityname']!=='')
												{
												if($place==1)
												{
												echo ",&nbsp;"; 
												}
												echo $event_detail['cityname'];
												$city=1;
												}
												if($event_detail['country_name']!='')
												{
												if($city==1 || $place==1)
												{
												echo ",&nbsp;";
												}
												echo $event_detail['country_name'];
												}
												?>
												</h5>
												<form action="<?php echo $event_link_register; ?>/EventRegistration" method="post">
												<button class="btn btn-success" href="#">Register</button>
												<input type="hidden" name="event_register_of_univ_id" value="<?php echo $event_detail['univ_id']; ?>"/>
												<input type="hidden" name="event_register_id" value="<?php echo $event_detail['event_id']; ?>"/>
												</form>
											</div>
											
											<div class="float_l">
												<!--<img src="images/map_data.png" style="width: 112px;height: 62px;border: 1px solid #DDD;padding: 2px;">-->
											</div>
											<div class="float_r registered">
											<a href="<?php echo $event_link; ?>" style="text-decoration:none;">
											<?php $event_register_user = $this->frontmodel->count_event_register($event_detail['event_id']); ?>
													<h2 class="blue"><?php echo $event_register_user; ?></h2>	
													<h5 class="blue">Registered</h5></a>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="float_r">
											<div class="social_set float_r">
												<div id="gp" class="float_l">
													<g:plusone size='medium' id='shareLink' annotation='none' href='<?php echo $event_link; ?>'callback='countGoogleShares' data-count="true"></g:plusone> 
												</div>
												<div id="tw" class="float_l tw"><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $event_link; ?>" data-via="your_screen_name" data-lang="en">Tweet</a>
												</div>
												<div id="fb" class="float_r fb"><div class="fb-like" data-href="<?php echo $event_link; ?>" data-send="false" data-layout="button_count" data-width="10" data-show-faces="true" data-font="arial"></div>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
									<?php } } ?>
								</div>
								
								
								
								
								
							</div>
						</div>	
						</div>
					</div>
				</div>
				<div class="span4 float_r">
					<div id="event_calendar">
					</div>
				</div>
			</div>
			
		</div>
</div>
<!--  Div for Text SMS  -->
<div id="myModal" class="model_back modal hide fade">
	<div class="modal-header no_border model_heading">
		<a class="close" data-dismiss="modal">x</a>
		<h3>Event Information</h3>
	</div>
	<div id="event_det" class="modal-body model_body_height">
	
	</div>
	</div>
<!-- End Here -->	
<!-- Div For Voice SMS -->
	<div id="myModal_voice" class="model_back modal hide fade">
	<div class="modal-header no_border model_heading">
		<a class="close" data-dismiss="modal">x</a>
		<h3>Event Information</h3>
	</div>
	<div id="event_det_voice" class="modal-body model_body_height">
	
	</div>
	</div>
	<!-- End Here -->
<?php 
if(!empty($events['event_res']))
{
$array_dates=implode(',',$array_dates);
}
else{
$array_dates = date("m/d/Y");
}
//echo $event_detail['event_date_time'];
$show_date = '';
//echo $event_detail['event_date_time'];
if(!empty($events['event_res']))
{
$show_current_date = explode(" ",$current_event_month);
//echo $extract_date[];
$month = $extract_date[1];
//echo $show_current_date[2];
$number_month = date('m', strtotime($month));
$number_month = $number_month - 2;
}
else{
$show_current_date[2] = date('Y');
$number_month = date('m');
}
			// foreach($array_dates as $dates){
			// echo $dates;
			// }?>
<SCRIPT LANGUAGE="JavaScript"> 
    
 function popup(id) {
 /* $('#myModal').modal({
        keyboard: false
    }) */
  $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>leadcontroller/sms_me_event_ajax",
	   async:false,
	   data: 'event_id='+id,
	   cache: false,
	   success: function(msg)
	   {
	   $('#event_det').html(msg);
		$('#sms_form').append('<input type="hidden" name="page_status" value="events"/>');
		$("#myModal").modal({                    
		  "keyboard"  : true,
		  "show"      : true                     
		});
		/* $('#myModal').modal({
        keyboard: false
    }) */
	  //$('#search_program').html(msg);
	   }
	   }) 
//alert(id);
/* var URL = "<?php echo site_url('leadcontroller/sms_me_event');?>";
//window.open("<?php echo site_url('controller/method/param1/param2/etc');?>", 'width=150,height=150'); 
day = new Date();
id = day.getTime();
window.open(URL, 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=880,height=300'); */
} 

function voicepopup(id) {
 /* $('#myModal').modal({
        keyboard: false
    }) */
  $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>leadcontroller/sms_voice_me_event_ajax",
	   async:false,
	   data: 'event_id='+id,
	   cache: false,
	   success: function(msg)
	   {
	   $('#event_det_voice').html(msg);
		$('#sms_form_voice').append('<input type="hidden" name="page_status_voice" value="events"/>');
		$("#myModal_voice").modal({                    
		  "keyboard"  : true,
		  "show"      : true                     
		});
		/* $('#myModal-voice').modal({
        keyboard: false
    }) */
	  //$('#search_program').html(msg);
	   }
	   }) 
}
</script>			
<script type="text/javascript">
var x = new Array(<?php echo $array_dates; ?>);
//'12/04/2012';
			$(document).ready(function () {
				//$("#example").thingerlyCalendar();
				$("#event_calendar").thingerlyCalendar({
					'month' : <?php echo $number_month; ?>,
					'year' : <?php echo $show_current_date[2]; ?>,
          'transition' : 'slide',
					'viewTransition' : 'fade',
          'events' : [
		  <?php echo $array_dates; ?>
          ],
					'eventClick' : function(e) {
					FB.XFBML.parse();
					$('#div_events').animate({
					opacity: 0.1,
					});
					//$('#event1').fadeTo('slow', 0.3);
					$('#loading_img').css('z-index', 1);
					var d=new Date(e);
					//alert(e.toSource());
					var x = d.getDate().toString();
					var z = d.getFullYear().toString();
					var month=new Array();
						month[0]="Jan";
						month[1]="Feb";
						month[2]="Mar";
						month[3]="Apr";
						month[4]="May";
						month[5]="Jun";
						month[6]="Jul";
						month[7]="Aug";
						month[8]="Sep";
						month[9]="Oct";
						month[10]="Nov";
						month[11]="Dec";
						var n = month[d.getMonth()];
						var y = n.toString();
					var complete_date = x + y+ z;
					//alert(complete_date)
					var searchUrl = "<?php echo $base; ?>/univ/search_event_by_calendar";
					//fetch result according calendar date
					//alert('hello');
					
					$.ajax({
						type: "POST",
						url: searchUrl,
						async:true,
						data:'date='+x+"&month="+y+"&year="+z+"&type=all",
						success: function(response)
						{

							r=response.split('!@#$%^&*');
							$('#event_results_filteration').html(r[1]);
							$('#div_events').animate({
								opacity: 1,
							});
							$('#loading_img').css('z-index',"-1");
							$('#listed_currently_event').html(r[0]);
							$('#red_total_univ').html(r[0]);
							$('.search_chkbox').attr('checked',false);
							href='<?php echo $base; ?>events/';
							history.pushState('',href,href);
						}
					});
					}
          });

			});
		</script>
		<script>
		var href=document.URL;
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
			get_event_result_by_ajax();
			});;

			


		});
function get_event_result_by_ajax()
{
	var url=document.URL;
	var change_url=url.split('events/');
	if(!(change_url.length>1 && change_url[1]!=''))
	{
	url='<?php echo $base; ?>events';
	}
	
	$('#search_results').css('opacity','0.4');
	   $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>auth/all_events_search",
	   data: 'current_url='+url,
	   cache: false,
	   success: function(r)
	   {
		
	   res=r.split('!@#$%^&*');
		$('#event_results_filteration').animate({
		'opacity':1
		},1000,function(){
		});
		if(res[2]!='0' && res[1]!='0')
		{
		$('#event_results_filteration').html(res[2]);
		}
		else
		{
		$('#event_results_filteration').html('<div class="events_holder_box margin_t"><h3>Sorry,NO Result Found</h3></div>');	
		}
	  	$('#listed_currently_event').html(res[1]);
	    $('#red_total_univ').html(res[0]);
	   }
	   })
}	

function events_result_by_paging(a,pid)
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
	$('#div_events').animate({
	'opacity':0.5
	},1000,function(){
	});

	$('#pagination a').removeClass('add_paging_background_class');
	$('.'+pid).addClass('add_paging_background_class');
	//$('#ajax_loader_paging').css('z-index','9');
	//$('#col_paging').css('opacity','0.4');
	$('#current_paging_value').val(a);
 	   $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>auth/all_events_paging",
	   async:false,
	   data: 'offset='+a+'&current_url='+url,
	   cache: false,
	   success: function(r)
	   {
	    res=r.split('!@#$%^&*');
		$('#div_events').animate({
		'opacity':1
		},1,function(){
		});
		$('#div_events').html(res[1]);
		$('#listed_currently_event').html(res[0]);
	   }
	   })
	   
   }
}



function eventsorting(what,orderBy,id,text){
$('.sort_list a').removeClass('active');
var od='desc';
if(orderBy=='desc')
{
od='asc';
}
$('#'+id).html('<a href="javascript:void(0)" class="active" onclick="eventsorting(\''+what+'\',\''+od+'\',\''+id+'\',\''+text+'\')">'+text+'</a>');

 $('.events_listing').tsort('',{attr:what,order:orderBy});

}









	</script>