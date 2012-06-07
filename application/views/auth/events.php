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
					<div class="margin_t">
						<div class="float_l">
							<div class="fliters_data">
								<h3>Filter your Search</h3>
								<div class="margin_t">
									<h4>Event Type</h4>
									<form class="margin_zero">
										<ul class="col_filter_list">
											<li><label class="checkbox">
												<input type="checkbox" checked="yes"> All
											</label></li>
											<li><label class="checkbox">
												<input type="checkbox">Spot Admission
											</label></li>
											<li><label class="checkbox">
												<input type="checkbox"> Fairs
											</label></li>
											<li><label class="checkbox">
												<input type="checkbox">Counseling
											</label></li>
										</ul>
									</form>
								</div>
								<div class="margin_t">
									<h4>Country</h4>
									<form class="margin_zero">
										<ul class="col_filter_list">
											<li>
												<label class="checkbox">
												<input type="checkbox"> All
												</label>
											</li>
											<li>
												<label class="checkbox">
												<input type="checkbox"> India
												</label>
											</li>
											<li>
												<label class="checkbox">
												<input type="checkbox"> UK
												</label>
											</li>
											<li>
												<label class="checkbox">
												<input type="checkbox"> USA
												</label>
											</li>
										</ul>
									</form>
									<div class="float_r"><a href="">more</a></div>
								</div>
								<div class="margin_t">
									<h4>City</h4>
									<form class="margin_zero">
										<ul class="col_filter_list">
											<li><label class="checkbox">
												<input type="checkbox"> All
											</label></li>
											<li><label class="checkbox">
												<input type="checkbox"> Delhi
											</label></li>
											<li><label class="checkbox">
												<input type="checkbox"> Amritsar
											</label></li>
											<li><label class="checkbox">
												<input type="checkbox"> Ludhiana
											</label></li>
										</ul>
									</form>
									<div class="float_r"><a href="">more</a></div>
								</div>
							</div>
						</div>
						<div class="float_r">
							<div class="row">
								<div class="span9 float_l margin_zero">
									<div class="events_holder_box padding margin_t">
										<div>
											<div class="float_l span7 margin_zero">
												<h3>GITAM-School of International Business (GLSCM) Admission </h3>
											</div>
											<div class="float_r">
												<a href="#"><img src="images/call.png" title="Reminder Call" alt="Reminder Call"></a>
													<a href="#"><img src="images/sms.png" title="Send SMS" alt="Send SMS"></a>
													<!--<a href="#"><img src="images/msg_box.png" title="Send Meassage" alt="Send Meassage"></a>-->
													<a href="#"><img src="images/map.png" title="Map" alt="Map"></a>
											</div>
											<div class="clearfix"></div>
										</div>
										<div>
											<div class="img_style float_l">
												<img src="http://workforcetrack.in/uploads/univ_gallery/uog20logo1.jpg" style="width: 100px;">
											</div>
											<div class="float_l text-width" style="font-size:14px;">
												<h4 class="blue line_time">25 June, 2012</h4>
												<h4 class="line_time">British Council, New Delhi, India</h4>
												<button class="btn btn-primary" href="#">Register</button>
											</div>
											
											<div class="float_l">
												<img src="images/map_data.png" style="width: 112px;height: 62px;border: 1px solid #DDD;padding: 2px;">
											</div>
											<div class="float_r registered">
													<h2 class="blue">15</h2>	
													<h4 class="blue">Registered</h4>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="float_r">
											<img src="images/fb_like.png">
											<img src="images/tweet_social.png">
											<img src="images/fb_like.png">
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="events_holder_box padding margin_t">
										<div>
											<div class="float_l span7 margin_zero">
												<h3>GITAM-School of International Business (GLSCM) Admission </h3>
											</div>
											<div class="float_r">
												<a href="#"><img src="images/call.png" title="Reminder Call" alt="Reminder Call"></a>
													<a href="#"><img src="images/sms.png" title="Send SMS" alt="Send SMS"></a>
													<!--<a href="#"><img src="images/msg_box.png" title="Send Meassage" alt="Send Meassage"></a>-->
													<a href="#"><img src="images/map.png" title="Map" alt="Map"></a>
											</div>
											<div class="clearfix"></div>
										</div>
										<div>
											<div class="img_style float_l">
												<img src="http://workforcetrack.in/uploads/univ_gallery/uog20logo1.jpg" style="width: 100px;">
											</div>
											<div class="float_l text-width" style="font-size:14px;">
												<h4 class="blue line_time">25 June, 2012</h4>
												<h4 class="line_time">British Council, New Delhi, India</h4>
												<button class="btn btn-primary" href="#">Register</button>
											</div>
											
											<div class="float_l">
												<img src="images/map_data.png" style="width: 112px;height: 62px;border: 1px solid #DDD;padding: 2px;">
											</div>
											<div class="float_r registered">
													<h2 class="blue">15</h2>	
													<h4 class="blue">Registered</h4>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="float_r">
											<img src="images/fb_like.png">
											<img src="images/tweet_social.png">
											<img src="images/fb_like.png">
										</div>
										<div class="clearfix"></div>
									</div>
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
$(document).ready(function(){
			FixImages(true);
});			
</script>	