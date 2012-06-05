<?php 
								if(!empty($search_event_by_calendar))
								{
								foreach($search_event_by_calendar as $event_detail)
								{ 
								?>
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
									$image=base_url().'uploads/univ_gallery/'.$event_img;
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
										<a href="<?php echo base_url(); ?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>">
										<h3><?php echo $event_detail['event_title']; ?></h3>
										<h4><?php echo $event_detail['cityname'].",".$event_detail['statename'].",".$event_detail['country_name']?> </a></h4>
										
										 	<div>
												<div class="float_l">
													<span class="timeago time_ago" title="<?php echo $event_detail['event_date_time']; ?>"><?php echo $event_detail['event_date_time']; ?></span>
												</div>
												
												<div class="clearfix"></div>
											</div>
											<div>
												<div class="float_l span5 margin_zero page_event_height"><?php echo substr($event_detail['event_detail'],0,250).'..'; ?></div>
											<form action="EventRegistration" method="post">
									<input type="hidden" name="event_register_of_univ_id" value="<?php echo $event_detail['univ_id']; ?>"/>
									<input type="hidden" name="event_register_id" value="<?php echo $event_detail['event_id']; ?>"/>
									<div class="float_r margin_t1">
									<input type="BUTTON" value="SMS ME" class="btn btn-primary" onClick="popup('<?php echo $event_detail['event_id']; ?>')">
									<input type="BUTTON" value="VOICE SMS" class="btn btn-primary" onClick="voicepopup('<?php echo $event_detail['event_id']; ?>')">
									<button class="btn btn-success" href="#">Register</button></div>
												<div class="clearfix"></div>
									</form>
											</div>
									<div class="clearfix"></div>
								</div>
									<div class="clearfix"></div>
								</div>
								<?php } } else { echo "No Events Found On This Date..."; }								
								?>
						