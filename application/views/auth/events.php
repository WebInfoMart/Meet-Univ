<?php
$sms_suc_sess_val = $this->session->userdata('msg_send_suc');
$sms_voice_suc_sess_val = $this->session->userdata('msg_send_suc_voice');
if($sms_suc_sess_val == 1)
{
	$show_suc_msg = "A Event Details has been send to you successfully.....";
}
else if($sms_voice_suc_sess_val == 1)
{
	$show_suc_msg = "A Reminder Voice SMS has been send to you successfully.....";
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
<?php 
								if(!empty($events))
								{
								$array_dates = array();
								foreach($events as $event_detail){ 
								$var_date = '';
								//echo $event_detail['event_date_time'];
								$extract_date = explode(" ",$event_detail['event_date_time']);
								//echo $extract_date[];
								$month = $extract_date[1];
								$number_month = date('m', strtotime($month));
								//echo $extract_date[0];
								//echo $number_months; //= $number_month-1 ;
								//echo $extract_date[2];
								$var = "'".$number_month.'/'.$extract_date[0].'/'.$extract_date[2]."'";
								array_push($array_dates,$var);
								} }
								?>
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
						<div class="float_l"><h3>Viewing 1 - 20 universities of 5232.</h3></div>
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
					<div id="loading_img" style="z-index:-1;margin-left: 448px;margin-top: 228px;position:absolute;"> <img src="<?php echo "$base$img_path"; ?>/AjaxLoading.gif"/> </div>
					<div class="margin_t">
						<div class="float_l">
							<div class="fliters_data">
								<h3>Filter your Search</h3>
								<div class="margin_t">
									<h4>Event Type</h4>
									<form class="margin_zero">
										<ul class="col_filter_list">
											
											<li><label class="checkbox">
												<input type="checkbox" id="" value="">Spot Admission
											</label></li>
											<li><label class="checkbox">
												<input type="checkbox" id="" value=""> Fairs
											</label></li>
											<li><label class="checkbox">
												<input type="checkbox" id="" value="">Counseling
											</label></li>
										</ul>
									</form>
								</div>
								<div class="margin_t">
									<h4>Country</h4>
									<form class="margin_zero">
										<ul class="col_filter_list">
											
											<?php if(!empty($country_name_having_event)) {
											foreach($country_name_having_event as $country_name_having_event){
											$country_name=str_replace(' ','_',$country_name_having_event['country_name']);
											?>
											<li  href="/<?php echo $country_name; ?>"><label class="checkbox">
												<input type="checkbox" id="" value="" class="search_chkbox"> <?php echo $country_name_having_event['country_name'];?>
											</label></li>
											<?php } } ?>
										</ul>
									</form>
									<!--<div class="float_r"><a href="">more</a></div>-->
								</div>
								<div class="margin_t">
									<h4>City</h4>
									<form class="margin_zero">
										<ul class="col_filter_list">
										<?php if(!empty($city_name_having_event))
										{
										foreach($city_name_having_event as $city_name_have_event)
										{
										?>
											<li><label class="checkbox">
												<input type="checkbox" id="<?php echo $city_name_have_event['city_id']; ?>" value="<?php echo $city_name_have_event['cityname'];?>"> <?php echo $city_name_have_event['cityname'];?>
											</label></li>
										<?php } } ?>	
										</ul>
									</form>
									<!--<div class="float_r"><a href="">more</a></div>-->
								</div>
							</div>
						</div>
						<div class="float_r">
							<div class="row">
								<div class="span9 float_l margin_zero" id="div_events">
									<?php if(!empty($events))
										  {
											foreach($events as $event_detail){  ?>
									<div class="events_holder_box padding margin_t">
										<div>
											<div class="float_l span7 margin_zero">
											<a href="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>">
												<h3> <?php echo $event_detail['univ_name']; ?> </h3>
												
												<?php
												echo "<h3 style='display:inline';>";
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
												echo "</h3>";
												echo '<h5 style="display:inline;"><span class="inline"> &raquo; </span>'.$event_detail['event_title'].'</h5>';
												?>
												</a>
											</div>
											<div class="float_r">
												<a onclick="popup('<?php echo $event_detail['event_id']; ?>');" style="cursor:pointer;"><img src="images/call.png" title="Reminder Call" alt="Reminder Call"></a>
													<a onclick="voicepopup('<?php echo $event_detail['event_id']; ?>');" style="cursor:pointer;"><img src="images/sms.png" title="Send SMS" alt="Send SMS"></a>
													<!--<a href="#"><img src="images/msg_box.png" title="Send Meassage" alt="Send Meassage"></a>-->
													<a href="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>"><img src="images/map.png" title="Map" alt="Map"></a>
											</div>
											<div class="clearfix"></div>
										</div>
										<div>
											<div class="img_style float_l">
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
									$image=$base.$img_path.'default_logo.png';
									} 
									$img_arr=$this->searchmodel->set_the_image($width,$height,80,80,TRUE);
											?>
											<img style="width: 100px;left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" src="<?php echo $image; ?>">
												
											</div>
											<div class="float_l text-width" style="font-size:14px;">
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
												<h4 class="blue line_time"><?php echo $extract_dates[0].' '.$extract_dates[1].' '.$extract_dates[2]; ?></h4>
												<h4 class="line_time"><?php echo $event_detail['event_place']?$event_detail['event_place'].',':'';$event_detail['cityname']?$event_detail['cityname'].',':''; echo $event_detail['country_name']?$event_detail['country_name']:''; ?></h4>
												<button class="btn btn-primary" href="#">Register</button>
											</div>
											
											<div class="float_l">
												<!--<img src="images/map_data.png" style="width: 112px;height: 62px;border: 1px solid #DDD;padding: 2px;">-->
											</div>
											<div class="float_r registered">
											<?php $event_register_user = $this->frontmodel->count_event_register($event_detail['event_id']); ?>
													<h2 class="blue"><?php echo $event_register_user; ?></h2>	
													<h4 class="blue">Registered</h4>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="float_r">
											<div id="gp" class="float_l" style="margin-right:15px;"><g:plusone size='medium' id='shareLink' annotation='none' href='<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>' callback='countGoogleShares' data-count="true"></g:plusone></div>
												<div id="fb" class="float_l fb" style="margin-right:24px;"><div class="fb-like" data-href="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial" style="width:48px;"></div></div>
												<div id="tw" class="float_r tw"><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>" data-via="your_screen_name" data-lang="en">Tweet</a></div>
										</div>
										<div class="clearfix"></div>
									</div>
									<?php } } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="span4 float_r">
					<div class="college_form">
						<div id="event_calendar">
						</div>
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
	<div id="myModal-voice" class="model_back modal hide fade">
	<div class="modal-header no_border model_heading">
		<a class="close" data-dismiss="modal">x</a>
		<h3>Event Information</h3>
	</div>
	<div id="event_det_voice" class="modal-body model_body_height">
	
	</div>
	</div>
	<!-- End Here -->
<?php 
if(!empty($events))
{
$array_dates=implode(',',$array_dates);
}
else{
$array_dates = date("m/d/Y");
}
//echo $event_detail['event_date_time'];
$show_date = '';
								//echo $event_detail['event_date_time'];
								if(!empty($events))
								{
								$show_current_date = explode(" ",$event_detail['event_date_time']);
								//echo $extract_date[];
								$month = $extract_date[1];
								//echo $show_current_date[2];
								$number_month = date('m', strtotime($month));
								$number_month = $number_month -1;
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
		$('#myModal').modal({
        keyboard: false
    })
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
		$('#myModal-voice').modal({
        keyboard: false
    })
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
							//$('#content_search').html(response);
							//alert(response);
							$('#div_events').html(response);
							$('#div_events').animate({
								opacity: 1,
							});
							$('#loading_img').css('z-index',"-1");
							//var url = '<?php echo "$base"; ?>events';
							//var href='<?php echo "$base"; ?>events';
							//alert(href); 
							
							//href=href.replace(url,'');
							//alert(href);
							history.pushState('',href,href);
							//window.history.replaceState(url);
						}
					});
						/* alert(complete_date);
						alert(d.getDate());
						alert(d.getMonth());
						alert(d.getFullYear()); */
					}
          });

			});
		</script>
		<script>
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
	   alert(r);
	   res=r.split('!@#$%^&*');
	   $('#search_results').animate({
		'opacity':1
		},1000,function(){
		});
		if(res[2]!='0' && res[1]!='0')
		{
		$('#search_results').html(res[2]);
		}
		else
		{
		$('#search_results').html('<div class="events_holder_box margin_t"><h3>Sorry,NO Result Found</h3></div>');	
		}
	  	$('#listed_currently_univ').html(res[1]);
	    $('#red_total_univ').html(res[0]);
	   }
	   })
}
		</script>
	<script>
$(document).ready(function(){
			FixImages(true);
});			
</script>	