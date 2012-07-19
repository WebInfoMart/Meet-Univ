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
												echo '<h5>'.$event_detail['event_title'].'</h5>';
												?>
											</div>
											<div class="float_r">
												<!--<a onclick="popup('<?php// echo $event_detail['event_id']; ?>');" style="cursor:pointer;"><img src="<?php// echo $base; ?>images/call.png" title="Reminder Call" alt="Reminder Call"></a>
													<a onclick="voicepopup('<?php //echo $event_detail['event_id']; ?>');" style="cursor:pointer;"><img src="<?php// echo$base; ?>images/sms.png" title="Send SMS" alt="Send SMS"></a>
												<a href="<?php //echo $event_link; ?>"><img src="<?php //echo $base; ?>images/map.png" title="Map" alt="Map"></a>-->
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
											<div class="float_l span5 margin_delta" style="font-size:14px;">
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
												<h5 class="line_time">
												<?php
												
												$place=0;
												$city=0;						
												if($event_detail['event_place']!='' && $event_detail['event_place']!=$event_detail['cityname'])
												{
												echo $event_detail['event_place'];
												$place=1;
												} 
												if($event_detail['cityname']!=='' && $event_detail['cityname']!=NULL)
												{
												if($place==1)
												{
												echo ",&nbsp;"; 
												}
												echo $event_detail['cityname'];
												$city=1;
												}
												if($event_detail['country_name']!='' && $event_detail['cityname']!=NULL)
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
												<button class="btn btn-success margin_l1" href="#">Register</button>
												<input type="hidden" name="event_register_of_univ_id" value="<?php echo $event_detail['univ_id']; ?>"/>
												<input type="hidden" name="event_register_id" value="<?php echo $event_detail['event_id']; ?>"/>
												</form>
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
											<div class="social_set float_r">
												<div id="gp" class="float_l">
													<g:plusone size='medium' id='shareLink' annotation='none' href='<?php echo $event_link; ?>' callback='countGoogleShares' data-count="true"></g:plusone>
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