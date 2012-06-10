<div class="row margin_t1">
				<div class="float_l span13 margin_l">
				<!--<div class="float_r">
				<div class="float_l" style="margin-right:15px;">
				<g:plusone size='medium' id='shareLink' annotation='none' href='<?php $_SERVER['REQUEST_URI']; ?>' callback='countGoogleShares' data-count="true"></g:plusone>
				</div>
				<div class="float_l" style="margin-right:10px;"><div class="fb-like" data-href="<?php $_SERVER['REQUEST_URI']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div></div>
	
				<div class="float_l">
					<a href="https://twitter.com/share" class="twitter-share-button" data-via="munjal_sumit" data-count="none">Tweet</a>
				</div>
				</div>-->
					<h2 class="course_txt">Upcoming Events</h2>
					<div class="margin_t1">
					<?php foreach($event_list_detail as $event_detail){
$events_link=$this->subdomain->genereate_the_subdomain_link($event_detail['subdomain_name'],'event',$event_detail['event_title'],$event_detail['event_id']);
		
					?>
						<div class="event_border">
							<div class="float_l">
								<?php if($event_detail['univ_logo_path']==''){?>
								<img src="<?php echo "$base$img_path"; ?>/default_logo.png" style="width:80px;height:80px;margin-right:20px">
								<?php } else {?>
								<img src="<?php echo $base; ?>/uploads/univ_gallery/<?php echo $event_detail['univ_logo_path']; ?>" style="width:80px;height:80px;margin-right:20px" >
								<?php } ?>	
							</div>
							<div class="dsolution">
								<div>
									<div class="float_l">
<h3><a href="<?php echo $events_link; ?>"><?php echo $event_detail['event_title']; ?>
				-<?php echo $event_detail['cityname'].",".$event_detail['statename'].",".$event_detail['country_name']?></a></h3>
										<span><?php echo $event_detail['event_date_time']; ?></span><br/>
									</div>
									<div class="float_r">
	
									<div class="float_l" style="margin-right:15px;">
				<g:plusone size='medium' id='shareLink' annotation='none' href='<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>' callback='countGoogleShares' data-count="true"></g:plusone>
				</div>
				<div class="float_l"><div class="fb-like" style="width:66px;" data-href="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div></div>
	
				<div class="float_l">
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>" data-via="munjal_sumit" data-count="none">Tweet</a>
				</div>
									<h4>
								<?php 	echo $event_register_user = $this->frontmodel->count_event_register($event_detail['event_id']); ?>
									Register</h4>
									</div>
									
									<div class="clearfix"></div>
								</div>
								<div class="course_cont"><?php echo substr($event_detail['event_detail'],0,250).'..'; ?></div>
							</div>
							<div class="float_r margin_t1">
							<form action="EventRegistration" method="post">
									<input type="hidden" name="event_register_of_univ_id" value="<?php echo $event_detail['univ_id']; ?>"/>
									<input type="hidden" name="event_register_id" value="<?php echo $event_detail['event_id']; ?>"/>
									<div class="float_r margin_t1">
									<input type="submit" name="btn_event_register" value="Register" class="btn btn-success" /></div>
							</div>
							<div class="clearfix"></div>
						</div>
					<?php } ?>	
					</div>
				</div>
			
				<div class="float_r span3">
					<img src="<?php echo "$base$img_path"; ?>/banner_img.png">
				</div>
				<div id="pagination" class="table_pagination right paging-margin">
            <?php echo $this->pagination->create_links();?>
            </div>
				<div class="clearfix"></div>
			</div>
	