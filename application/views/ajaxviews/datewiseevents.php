<div>			
					<?php 	
					if($date_event){
					$i=0;	?>
					<table>
					<?php
					foreach($date_event as $today_event) {
					if($i%3==0)
					{ echo "<tr>"; }
					?>
						<td>
							<div class="float_l list_bc_univ" style="height:215px;">
							<?php  $i++;
							$image_exist=0;	

									$event_img = $today_event['univ_logo_path'];	

									if(file_exists(getcwd().'/uploads/univ_gallery/'.$event_img) && $event_img!='')	

									{

									$image_exist=1;

									list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/univ_gallery/'.$event_img);

									}

									else

									{

									list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/univ_gallery/univ_logo.png');

								    }

									if($event_img!='' && $image_exist==1)

									{

									$image=$base.'uploads/univ_gallery/'.$event_img;

									}

									else

									{

									$image=$base.'/uploads/univ_gallery/univ_logo.png';

									} 

									$img_arr=$this->searchmodel->set_the_image($width,$height,112,77,TRUE);

									?>

									<img class="img_bc_univ" style="float:left;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" src="<?php echo $image; ?>" >
									<h4><?php echo $today_event['univ_name']; ?></h4>
								<h5><?php if($today_event['event_title']!='')
								{ 
								echo $today_event['event_title']; 
								}
								else
								{
								echo $today_event['univ_name'];
								} ?> </h5>
								<span>
								<?php
									if($today_event['cityname']!='') { 
									echo $today_event['cityname'];
									}
									if($today_event['cityname']!='' && $today_event['statename']!='')
									{
									echo '&nbsp;,&nbsp;'.$today_event['statename'];
									}
									else if($today_event['statename']!='')
									{
									echo $today_event['statename'];
									}
									if(($today_event['cityname']!='' || $today_event['statename']!='') && $today_event['country_name']!='')
									{
									echo '&nbsp;,&nbsp;'.$today_event['country_name'];
									}
									else
									{
									echo $today_event['country_name'];
									}
									?>
								</span>
						
								
								<div id="date_<?php echo $today_event['event_id']; ?>" onclick="showDetail(<?php echo $today_event['event_id']; ?>)"  class="div_fix" style="cursor:pointer;">
									<div><!-- class="float_l span3 margin_zero"-->
										<div>
										<img src="<?php echo $base; ?>images/clock.png" class="line_img inline">
											<span style="width:180px;" class="blue line_time inline"><?php echo $today_event['event_date_time'].','.$today_event['event_time']; ?>
											</span>
										</div>
									</div>
									<div>
									<img src="<?php echo $base; ?>images/group.png" class="line_img inline">
										<span class="blue line_time inline"><?php 	echo $event_register_user = $this->frontmodel->count_event_register($today_event['event_id']); ?>	Register
										</span>
									</div>
								<span class="wrap"><?php echo substr(strip_tags($today_event['event_detail']),0,150).'..'; ?></span>
								</div>									
								<br />
								<input type="checkbox" class="event_selected" name="checked[]" value="<?php echo $today_event['event_id']; ?>" />&nbsp;&nbsp;select to register
							</div>
							</td>
					<?php  
					if($i%3==0)
					{
					echo "</tr>";
					} }
					}
					else 
					{ echo "No events for today please select a date for event"; }
					?>								
					</table>	
					</div>
				