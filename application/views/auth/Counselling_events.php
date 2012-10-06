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
					</div>
				<div class="float_r span9">
				<div class="page_event">
					<ul id="myTab" class="nav nav-tabs">
					<li class="tabs_events"><a href="<?php echo $base; ?>events" data-toggle="tab" id="link1">All</a></li>
					<li class="tabs_events "><a href="<?php echo $base; ?>spot_admission_events" data-toggle="tab" id="link2">Spot Admission</a></li>
					<li class="tabs_events"><a href="<?php echo $base; ?>fairs_events" data-toggle="tab" id="link3">Fairs</a></li>
					<li class="tabs_events active1"><a href="<?php echo $base; ?>Counselling_events" data-toggle="tab" id="link4">Counselling</a></li>
				</ul>
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
								}
								}
								?>
				
				<div id="loading_img" style="z-index:-1;margin-left: 252px;margin-top: 139px;position:absolute;"> <img src="<?php echo "$base$img_path"; ?>/AjaxLoading.gif"/> </div>
				<div id="event1" class="">
					<?php 
					if(!empty($events))
					{
					foreach($events as $event_detail){ ?>
						<div class="page_last_border">
							<div class="float_l event_border_style aspectcorrect">
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
								
								<img style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" src="<?php echo $image; ?>">
									
									</div>
							<div class="page_event_data">
								<a href="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>">
								<h3><?php echo $event_detail['event_title']; ?></h3>
				<h4><?php echo $event_detail['cityname'].",".$event_detail['statename'].",".$event_detail['country_name']?></a></h4>
				<div>
									<div class="float_l">
													<span class="timeago time_ago" title="<?php echo $event_detail['event_date_time']; ?>"><?php echo $event_detail['event_date_time']; ?></span>
												</div>
									<div class="float_r">
									<div id="gp" class="float_l"><g:plusone size='medium' id='shareLink' annotation='none' href='<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>' callback='countGoogleShares' data-count="true"></g:plusone></div>
									<div id="fb" class="float_l" style="width: 66px;margin-left: 19px;">
									<div class="fb-like" style="width: 66px;" data-href="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div>
									</div>
									<div id="tw" class="float_r">
									<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>" data-via="your_screen_name" data-lang="en">Tweet</a>
									</div>
									</div>
									
									<div class="clearfix"></div>
								</div>
											<div>
								</div>
								<div>
								<div class="float_l span5 margin_zero page_event_height"><?php echo substr($event_detail['event_detail'],0,250).'..'; ?></div>
							
							<div class="float_r margin_t1">
							<form action="EventRegistration" method="post">
									<input type="hidden" name="event_register_of_univ_id" value="<?php echo $event_detail['univ_id']; ?>"/>
									<input type="hidden" name="event_register_id" value="<?php echo $event_detail['event_id']; ?>"/>
									<div class="float_r margin_t1">
									<input type="BUTTON" value="SMS ME" class="btn btn-primary" onClick="popup('<?php echo $event_detail['event_id']; ?>')">
									<input type="BUTTON" value="VOICE SMS" class="btn btn-primary" onClick="voicepopup('<?php echo $event_detail['event_id']; ?>')">
									<input type="submit" name="btn_event_register" value="Register" class="btn btn-success" /></div>
							</form>
							</div>
							<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
							</div>
									<div class="clearfix"></div>
						</div>
					<?php } } else { echo "<h3> No Recent Counselling Events Found... </h3>"; } ?>	
					</div>
					<div id="pagination" class="table_pagination right paging-margin">
            <?php echo $this->pagination->create_links();?>
            </div>
				</div>
				</div>
				<div class="clearfix"></div>
					</div>
					
					<div class="float_r span3 margin_t">
					<a href="http://university-of-greenwich.meetuniversities.com/university_events"><img src="<?php echo "$base$img_path" ?>/banner_img.png"></a>
					
				</div>
				<div class="clearfix"></div>
					</div>
					</div>
					</div>
					</div>
<!--  Div For Text SMS  -->					
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
else {
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
								$number_month = date('m', strtotime($month));
								$number_month = $number_month -1;
								}
								else {
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
		$('#sms_form').append('<input type="hidden" name="page_status" value="counsell"/>');
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
		$('#sms_form_voice').append('<input type="hidden" name="page_status_voice" value="counsell"/>');
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
						data:'date='+x+"&month="+y+"&year="+z+"&type=counsell_alumuni_others",
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
		