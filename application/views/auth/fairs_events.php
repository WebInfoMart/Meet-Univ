<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row margin_t1">
				<div class="float_l span13 margin_l">
					<div class="float_l span4 margin_zero">
								<div id="event_calendar">
									<?php 
								$array_dates = array();
								if(!empty($events))
								{
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
								<div id="loading_img" style="z-index:-1;margin-left: 487px;margin-top: 139px;position:absolute;"> <img src="<?php echo "$base$img_path"; ?>/AjaxLoading.gif"/> </div>
								</div>
					</div>
					<div class="float_r span9">
						<div class="page_event">
							<ul id="myTab" class="nav nav-tabs">
								<li class="tabs_events"><a href="<?php echo $base; ?>events" data-toggle="tab" id="link1">All</a></li>
								<li class="tabs_events"><a href="<?php echo $base; ?>spot_admission_events" data-toggle="tab" id="link2">Spot Admission</a></li>
								<li class="tabs_events active1"><a href="<?php echo $base; ?>fairs_events" data-toggle="tab" id="link3">Fairs</a></li>
								<li class="tabs_events"><a href="<?php echo $base; ?>Counselling_events" data-toggle="tab" id="link4">Counselling</a></li>
							</ul>
							<div id="event1" class="">
								<?php 
								if(!empty($events))
								{
								foreach($events as $event_detail){ ?>
								<div class="page_last_border">
									<div class="float_l event_border_style aspectcorrect">
										<?php if($event_detail['univ_logo_path']==''){?>
										<img src="<?php echo "$base$img_path"; ?>/default_logo.png" >
										<?php } else {?>
										<img src="<?php echo $base; ?>/uploads/univ_gallery/<?php echo $event_detail['univ_logo_path']; ?>" >
										<?php } ?>	
										
									</div>
									<div class="page_event_data">
											<a href="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>">
											<h3><?php echo $event_detail['event_title']; ?><h3>
										<h4><?php echo $event_detail['cityname'].",".$event_detail['statename'].",".$event_detail['country_name']?></a></h4>
										<div>
											<div class="float_l">
													<span class="timeago time_ago" title="<?php echo $event_detail['event_date_time']; ?>"><?php echo $event_detail['event_date_time']; ?></span>
												</div>
											<div class="float_r">
												<div class="fb-like" data-href="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div>
												
												<!--<g:plusone size="medium" annotation="none"></g:plusone>-->
												<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>" data-via="your_screen_name" data-lang="en">Tweet</a>
											</div>
											<div class="clearfix"></div>
										</div>
											<div>
											</div>
										<div>
											<div class="float_l span5 margin_zero page_event_height"><?php echo substr($event_detail['event_detail'],0,250).'..'; ?></div>
											<div class="float_r margin_t1">
											<form action="find_college/<?php echo $event_detail['univ_id'].'/'.$event_detail['event_id']; ?>" method="post">
											<button class="btn btn-success" href="#">Register</button>
											</form>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="clearfix"></div>
								</div>
								<?php } } else { echo "<h3>No Recent fairs Event Found...</h3>"; } ?>	
							</div>
							<div id="pagination" class="table_pagination right paging-margin">
            <?php echo $this->pagination->create_links();?>
            </div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="float_r span3">
					<img src="<?php echo "$base$img_path"; ?>/banner_img.png">
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
</div>
					
					
</div>

					
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
						data:'date='+x+"&month="+y+"&year="+z+"&type=fairs",
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