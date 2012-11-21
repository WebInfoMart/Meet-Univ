<div class="border_b">
				<div class="btn_city">
				<?php if(!empty($city_event))
				{ 
					echo $city_event[0]['cityname'].'  Events';
				} 
				else
				{
				echo 'No events';exit;
				}
				?>
			</div>
			</div>
<div class="margin_t3">
				<div id="slides_content">
					<div class="slides_container">
					<?php 
					$x=1;
					foreach($city_event as $events)
					{ if($x==1)
						{ 
					?>
						<div>
							<ul>
								<li>
								<?php } ?>
									<div style="cursor:pointer;" class="float_l span3 spacing_slides engage_bg" onclick="eventStudents(<?php echo $events['event_id']?>)">
										<h4><?php echo $events['event_title']; ?> </h4>
										<small><?php echo $events['event_category']; ?></small><br/>
										<span class="margin_both"><?php echo strip_tags($events['event_detail']);?></span>							
									</div>
									<?php $x++; if($x==4){ $x=1; ?>
								</li>
							</ul>
						</div>
						<?php }} ?>	
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		

<script>
		$(function(){
			$('#slides_content').slides({
				preload: true,
				generateNextPrev: true
			});
		});
		
</script>