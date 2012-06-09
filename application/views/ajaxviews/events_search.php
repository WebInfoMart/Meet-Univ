	<script>
 if (typeof FB  != "undefined"){
        FB.XFBML.parse(document.getElementById('fbLike'));} 
		twttr.widgets.load();
		
 gapi.plusone.go();
</script>
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
											foreach($events['event_res'] as $event_detail){
//code for apply comma in date											

$var_date = '';
//echo $event_detail['event_date_time'];
$extract_date = explode(" ",$event_detail['event_date_time']);
$month = $extract_date[1];
$number_month = date('m', strtotime($month));
$number_month = date('m', strtotime($month));
$var = "'".$number_month.'/'.$extract_date[0].'/'.$extract_date[2]."'";
array_push($array_dates,$var);

//end here 
																			
											?>
									<div class="events_holder_box padding margin_t">
										<div>
											<div class="float_l span7 margin_zero">
											<a href="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>">
												<h3> <?php echo $event_detail['univ_name']; ?> </h3>
												</a>
												<?php
												echo "<h4 style='display:inline';>";
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
												echo '<h5 style="display:inline;"><span class="inline"> &raquo; </span>'.$event_detail['event_title'].'</h5>';
												?>
											</div>
											<div class="float_r">
												<a onclick="popup('<?php echo $event_detail['event_id']; ?>');" style="cursor:pointer;"><img src="<?php echo $base; ?>images/call.png" title="Reminder Call" alt="Reminder Call"></a>
													<a onclick="voicepopup('<?php echo $event_detail['event_id']; ?>');" style="cursor:pointer;"><img src="<?php echo$base; ?>images/sms.png" title="Send SMS" alt="Send SMS"></a>
													<!--<a href="#"><img src="images/msg_box.png" title="Send Meassage" alt="Send Meassage"></a>-->
													<a href="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>"><img src="<?php echo $base; ?>images/map.png" title="Map" alt="Map"></a>
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
									$image=$base.$img_path.'/default_logo.png';
									} 
									$img_arr=$this->searchmodel->set_the_image($width,$height,92,87,TRUE);
											?>
											<img style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" src="<?php echo $image; ?>">
												
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
												<h4 class="blue line_time"><?php echo $extract_dates[0].' '.$extract_dates[1].' '.$extract_dates[2];
												
												 ?></h4>
												<h4 class="line_time">
												<?php
												
												$place=0;
												$city=0;						
												if($event_detail['event_place']!='')
												{
												echo $event_detail['event_place'];
												$place=1;
												}
												if($event_detail['cityname']!=='')
												{
												if($place==1)
												{
												echo ", "; 
												}
												echo $event_detail['cityname'];
												$city=1;
												}
												if($event_detail['country_name']!='')
												{
												if($city==1 || $place==1)
												{
												echo ", ";
												}
												echo $event_detail['country_name'];
												}
												?>
												</h4>
												<button class="btn btn-primary" href="#">Register</button>
											</div>
											
											<div class="float_l">
												<!--<img src="images/map_data.png" style="width: 112px;height: 62px;border: 1px solid #DDD;padding: 2px;">-->
											</div>
											<div class="float_r registered">
											<?php $event_register_user = $this->frontmodel->count_event_register($event_detail['event_id']); ?>
													<h2 class="blue"><?php echo $event_register_user; ?></h2>	
													<h5 class="blue">Registered</h5>
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