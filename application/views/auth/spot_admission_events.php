<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row">
			<div class="float_l span13 margin_l margin_t">
				<ul id="myTab" class="nav nav-tabs">
					<li class="tabs_events"><a href="<?php echo $base; ?>events" data-toggle="tab" id="link1">All</a></li>
					<li class="tabs_events active1"><a href="<?php echo $base; ?>spot_admission_events" data-toggle="tab" id="link2">Spot Admission</a></li>
					<li class="tabs_events"><a href="<?php echo $base; ?>fairs_events" data-toggle="tab" id="link3">Fairs</a></li>
					<li class="tabs_events "><a href="<?php echo $base; ?>Counselling_events" data-toggle="tab" id="link4">Counselling</a></li>
				</ul>
				<div id="event1" class="form-search tab-content">
					<?php foreach($events as $event_detail){ ?>
						<div class="event_border">
							<div class="float_l">
								<?php if($event_detail['univ_logo_path']==''){?>
								<img src="<?php echo "$base$img_path"; ?>/default_logo.png" style="width:80px;height:80px;margin-right:20px">
								<?php } else {?>
								<img src="<?php echo $base; ?>/uploads/univ_gallery/<?php echo $event_detail['univ_logo_path']; ?>" style="width:80px;height:80px;margin-right:20px" >
								<?php } ?>	
								<div>
									<h4>22 Register</h4>
									</div>
							</div>
							<div class="dsolution">
								<h3><a href="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>"><?php echo $event_detail['event_title']; ?>
				-<?php echo $event_detail['cityname'].",".$event_detail['statename'].",".$event_detail['country_name']?></a></h3>
				<div>
									<div class="float_l">
										<span>
										<abbr class="timeago time_ago" title="<?php echo $event_detail['event_date_time']; ?>"></abbr>
										</span><br/>
									</div>
									<div class="float_r">
	<div class="fb-like" data-href="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div>
									
									<!--<g:plusone size="medium" annotation="none"></g:plusone>-->
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>" data-via="your_screen_name" data-lang="en">Tweet</a>
				
									</div>
									
									<div class="clearfix"></div>
								</div>
								<div class="course_cont"><?php echo substr($event_detail['event_detail'],0,250).'..'; ?></div>
							</div>
							<div class="float_r margin_t1"><button class="btn btn-success" href="#">Register</button></div>
							<div class="clearfix"></div>
						</div>
					<?php } ?>	
				</div>
					</div>
					<div class="float_r span3 margin_t">
					<img src="<?php echo "$base$img_path"; ?>/banner_img.png">
				</div>
				<div class="clearfix"></div>
					</div>
					</div>
					</div>
					</div>
