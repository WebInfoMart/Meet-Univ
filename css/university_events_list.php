<div class="row" style="margin-top: -10px;">
	<div class="span16 margin_l">
				<div class="float_l span13 margin_zero">
				<div class="span9 margin_zero">
				<!--<div class="float_r">
				<div class="float_l" style="margin-right:15px;">
				<g:plusone size='medium' id='shareLink' annotation='none' href='<?php $_SERVER['REQUEST_URI']; ?>' callback='countGoogleShares' data-count="true"></g:plusone>
				</div>
				<div class="float_l" style="margin-right:10px;"><div class="fb-like" data-href="<?php $_SERVER['REQUEST_URI']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div></div>
	
				<div class="float_l">
					<a href="https://twitter.com/share" class="twitter-share-button" data-via="munjal_sumit" data-count="none">Tweet</a>
				</div>
				</div>-->
					<h2>Upcoming Events</h2>
					
						<div>
				
					<ul class="event_new">
					<?php foreach($event_list_detail as $event_detail){
$events_link=$this->subdomain->genereate_the_subdomain_link($event_detail['subdomain_name'],'event',$event_detail['event_title'],$event_detail['event_id']);
		
					?>
							<li>
							<div class="float_l span5 margin_zero">
								<div class="fix_h3">
								<h3><a href="<?php echo $events_link; ?>"><?php echo $event_detail['event_title']; ?>
								-<?php echo $event_detail['cityname'].",".$event_detail['statename'].",".$event_detail['country_name']?></a></h3>
								</div>
							</div>
							<div class="float_r span4 margin_zero">
								<div class="float_l fb_set"><div class="fb-like" style="width:66px;" data-href="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div></div>
								<div class="float_l" style="margin-left:1px;">
								<g:plusone size='medium' id='shareLink' annotation='none' href='<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>' callback='countGoogleShares' data-count="true"></g:plusone>
								</div>
								<div class="float_r tw" style="width:82px;">
									<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>" data-via="munjal_sumit" data-count="none">Tweet</a>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="margin_t1 img_height">
								<div class="float_l">
								<?php if($event_detail['univ_logo_path']==''){?>
								<img src="<?php echo "$base$img_path"; ?>/default_logo.png" class="img_style img_r">
								<?php } else {?>
								<img src="<?php echo $base; ?>/uploads/univ_gallery/<?php echo $event_detail['univ_logo_path']; ?>" class="img_style img_r">
								<?php } ?>	
								</div>
								<div style="height:40px">
									<div class="float_l span3 margin_zero">
										<div><img src="http://meetuniv.com/images/clock.png" class="line_img inline"><span class="blue line_time inline"><abbr class="timeago time_ago" title="<?php echo $event_detail['event_date_time']; ?>"></abbr>
										</span></div>
										<div><img src="http://meetuniv.com/images/group.png" class="line_img inline"><span class="blue line_time inline"><?php 	echo $event_register_user = $this->frontmodel->count_event_register($event_detail['event_id']); ?>
											Register
										</span></div>
									</div>
									<div class="float_r">
										<form action="EventRegistration" method="post">
											<input type="hidden" name="event_register_of_univ_id" value="<?php echo $event_detail['univ_id']; ?>"/>
											<input type="hidden" name="event_register_id" value="<?php echo $event_detail['event_id']; ?>"/>
											<div class="float_r margin_t1">
											<input type="submit" name="btn_event_register" value="Register" class="btn btn-success" /></div>
											<div class="clearfix"></div>
										</form>
									</div>
									<div class="clearfix"></div>
								</div>
								<?php echo substr($event_detail['event_detail'],0,250).'..'; ?>
								
							</div>
						</li>
					<?php } ?>	
					
						</ul>
				</div>
				</div>
				<div class="float_l span4">			
					<div class="back_up">
						<h3><img src="<?php echo base_url(); ?>images/home_cal.gif" style="z-index: 100;position: relative;top:6px;"><span style="position: relative;left: 10px;">Popular Articles</span></h3>
						<ul class="up_event">
							<li>Lorem ipsum</li>
						</ul>
					</div>
				</div>
			</div>
				<div class="float_r span3">
					<img src="<?php echo "$base$img_path"; ?>/banner_img.png">
				</div>
			</div>
				<div id="pagination" class="table_pagination right paging-margin">
            <?php echo $this->pagination->create_links();?>
            </div>
				<div class="clearfix"></div>
			</div>
	</div>
</div>
	