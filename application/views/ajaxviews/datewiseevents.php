<div>			
					<?php 	
					if($date_event){ 			
					foreach($date_event as $today_event) {
					?>
						
							<div class="float_l" style="border:2px solid;">
								<h3><?php if($today_event['event_title']!='')
								{ 
								echo $today_event['event_title']; 
								}
								else
								{
								echo $today_event['univ_name'];
								} ?> </h3>
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
						
								
								<div id="date_<?php echo $today_event['event_id']; ?>" onclick="showDetail(<?php echo $today_event['event_id']; ?>)"  class="div_fix" style="width:300px;cursor:pointer;">
									<div class="float_l span3 margin_zero">
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
								<input type="checkbox" name="checked[]" value="<?php echo $today_event['event_id']; ?>" />&nbsp;&nbsp;select to register
							</div>
					
					<?php } 
					}
					else 
					{ echo "No events for today please select a date for event"; }
					?>								
						
					</div>
				