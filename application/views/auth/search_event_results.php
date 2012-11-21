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
				<div class="float_l span13 margin_l">
				<div class="float_l span4 margin_zero">
						<div id="event_calendar">
						
						</div>
						<div id="event_search_filter">
						<h3> <div style="color:#7D7E7D;margin-top:9px;margin-left:19px;" > Filter By City </div> </h3>
						<?php 
						if(!empty($city_name_having_event))
						{
							foreach($city_name_having_event as $citynames)
							{
								echo "<div id='cityname' style='margin-left:17px;'><h3><a style='cursor:pointer;' id=".$citynames['city_id']." onclick='filter_city(this)'><div class='city_name_filter'> ".$citynames['cityname']."</div> </a></h3></div>";
							}
						}
						?>
						</div>
					</div>
					<div class="float_r" style="width:585px;">
					<div id="show_filter_city_name">
					<h2 class="course_txt">Events in <?php echo $selected_month; ?> Month </h2>
					</div>
					<div class="margin_t1">
					
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
							<div id="loading_img" style="z-index:-1;margin-left: 252px;margin-top: 139px;position:absolute;"> <img src="<?php echo "$base$img_path"; ?>/AjaxLoading.gif"/> </div>
					
						<div id="event1" class="">
						<?php 
						if(!empty($events))
						{
						foreach($events as $event_detail){ ?>
						<div class="event_border">
							<div class="float_l">
								<?php if($event_detail['univ_logo_path']==''){?>
								<img src="<?php echo "$base$img_path"; ?>/default_logo.png" style="width:80px;height:80px;margin-right:20px">
								<?php } else {?>
								<img src="<?php echo $base; ?>/uploads/univ_gallery/<?php echo $event_detail['univ_logo_path']; ?>" style="width:80px;height:80px;margin-right:20px" >
								<?php } ?>	
							</div>
							<div class="dsolution">
								<div>
									<div class="float_l">
<h3><a href="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>"><?php echo $event_detail['event_title']; ?>
				</a></h3>
										<span>
										<?php echo $event_detail['cityname'].",".$event_detail['statename'].",".$event_detail['country_name']?>,
										
										<strong><?php echo $event_detail['event_date_time']; ?></strong>
										</span><br/>
									</div>
									<div class="float_r">
										<!--<h4>22 Register</h4>-->
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="course_cont"><?php echo substr($event_detail['event_detail'],0,250).'..'; ?>
								
								</div>
							</div>
							<div class="float_r margin_t1">
							<form action="EventRegistration" method="post">
							<input type="hidden" name="event_register_of_univ_id" value="<?php echo $event_detail['univ_id']; ?>"/>
							<input type="hidden" name="event_register_id" value="<?php echo $event_detail['event_id']; ?>"/>
							<input type="BUTTON" value="SMS ME" class="btn btn-primary" onClick="popup('<?php echo $event_detail['event_id']; ?>')">
							<input type="BUTTON" value="VOICE SMS" class="btn btn-primary" onClick="voicepopup('<?php echo $event_detail['event_id']; ?>')">
							<input type="submit" class="btn btn-success" value="Register"/>
							</form>
							</div>
							<div class="clearfix"></div>
						</div>
					<?php } } ?>	
					</div>
					</div> </div>
				</div>
				<div class="float_r span3">
					<a href="http://university-of-greenwich.meetuniversities.com/university_events"><img src="<?php echo "$base$img_path" ?>/banner_img.png"></a>
					
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- Div For Send Text SMS -->
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
<?php $event_month = $this->input->get('event_month'); ?>
<script type="text/javascript">
var event_month = '<?php echo $event_month; ?>';
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
					$('#event1').animate({
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
					var searchUrl = "<?php echo $base; ?>/univ/event_search_page_by_calendar";
					//fetch result according calendar date
					//alert('hello');
					
					$.ajax({
						type: "POST",
						url: searchUrl,
						data:'date='+x+"&month="+y+"&year="+z+"&type=all",
						success: function(response)
						{
							//$('#content_search').html(response);
							//alert(response);
							$('#event1').html(response);
							$('#event1').animate({
								opacity: 1,
							});
							$('#loading_img').css('z-index',"-1");
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
function filter_city(atribute)
{
$('#event1').animate({
					opacity: 0.1,
					});
					//$('#event1').fadeTo('slow', 0.3);
					$('#loading_img').css('z-index', 1);
var event_city_id = atribute.id;
var searchUrl = "<?php echo $base; ?>/univ/event_filter_by_city";
	$.ajax({
						type: "POST",
						url: searchUrl,
						data:'event_city='+event_city_id+"&event_month="+event_month,
						success: function(response)
						{
							//$('#content_search').html(response);
							$('#event1').html(response);
							$('#event1').animate({
								opacity: 1,
							});
							$('#loading_img').css('z-index',"-1");
						}
					});
}
</script>	
<SCRIPT LANGUAGE="JavaScript">    
var loc = window.location;
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
		$('#sms_form').append("<input type='hidden' name='page_status' value='"+loc+"'/>");
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
var loc = window.location;
  $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>leadcontroller/sms_voice_me_event_ajax",
	   async:false,
	   data: 'event_id='+id,
	   cache: false,
	   success: function(msg)
	   {
	   $('#event_det_voice').html(msg);
		$('#sms_form_voice').append("<input type='hidden' name='page_status_voice' value='"+loc+"'/>");
		$('#myModal-voice').modal({
        keyboard: false
    })
	  //$('#search_program').html(msg);
	   }
	   }) 
}

</script>	