<script>
 if (typeof FB  != "undefined"){
        FB.XFBML.parse(document.getElementById('fbLike'));} 
		twttr.widgets.load();
</script>
<?php 
								foreach($search_event_by_calendar as $event_detail){ 
								?>
								<div class="page_last_border">
									<div class="float_l event_border_style">
									<?php if($event_detail['univ_logo_path']==''){?>
									<img src="<?php echo "$base$img_path"; ?>/default_logo.png">
									<?php } else {?>
									<img src="<?php echo $base; ?>/uploads/univ_gallery/<?php echo $event_detail['univ_logo_path']; ?>">
									<?php } ?>	
									</div>
									<div class="page_event_data">
										<a href="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>">
										<h3><?php echo $event_detail['event_title']; ?></h3>
										<h4><?php echo $event_detail['cityname'].",".$event_detail['statename'].",".$event_detail['country_name']?> </a></h4>
										
										 	<div>
												<div class="float_l">
													<span class="timeago time_ago" title="<?php echo $event_detail['event_date_time']; ?>"><?php echo $event_detail['event_date_time']; ?></span>
												</div>
												<div class="float_r">
													<div class="fb-like" data-href="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div>
												<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>" data-via="your_screen_name" data-lang="en">Tweet</a>
												</div>
												<div class="clearfix"></div>
											</div>
											<div>
												<div class="float_l span5 margin_zero page_event_height"><?php echo substr($event_detail['event_detail'],0,250).'..'; ?></div>
										
												<div class="float_r margin_t1"><button class="btn btn-success" href="#">Register</button></div>
												<div class="clearfix"></div>
											</div>
									<div class="clearfix"></div>
								</div>
									<div class="clearfix"></div>
								</div>
								<?php }  ?>
								