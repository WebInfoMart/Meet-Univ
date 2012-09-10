<div class="row" style="margin-top: -10px;">
	<div class="span16 margin_l">
				<div class="float_l span13 margin_zero">
				<div class="span9 margin_zero">
					<h3>Upcoming Events</h3>
					
						<div>
				
					<ul class="event_new">
					<?php foreach($event_list_detail as $event_detail){
				$event_title =$this->subdomain->process_url_title($event_detail['event_title']);	
$events_link=$this->subdomain->genereate_the_subdomain_link($event_detail['subdomain_name'],'event',$event_title,$event_detail['event_id']);
$event_link_register=$this->subdomain->genereate_the_subdomain_link($event_detail['subdomain_name'],'event','','');		
		
		
					?>
							<li>
							<div class="float_l span5 margin_zero">
								<div class="margin_zero grid_3 fix_h3">
								<h3><a href="<?php echo $events_link; ?>"><?php echo $event_detail['event_title']; ?>
								</a></h3>
								<span>
								<?php
						if($event_detail['country_name']!='') { 
						echo $event_detail['country_name'];
						}
						if($event_detail['country_name']!='' && $event_detail['statename']!='')
						{
						echo ','.$event_detail['statename'];
						}
						else if($event_detail['statename']!='')
						{
						echo $event_detail['statename'];
						}
						if(($event_detail['country_name']!='' || $event_detail['statename']!='') && $event_detail['cityname']!='')
						{
						echo ','.$event_detail['cityname'];
						}
						else
						{
						echo $event_detail['cityname'];
						}
						?></span>
								</div>
							</div>
							<div class="float_r span4 margin_zero">
								<div class="float_r social_set">
									<div class="float_l"><g:plusone size='medium' id='shareLink' annotation='none' href='<?php echo $events_link; ?>' callback='countGoogleShares' data-count="true"></g:plusone></div>
									<div class="float_l tw">
										<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $events_link; ?>" data-via="munjal_sumit" data-count="none">Tweet</a>
									</div>
									<div class="float_r fb"><div class="fb-like" style="width:66px;" data-href="<?php echo $events_link; ?>" data-send="false" data-layout="button_count" data-width="10" data-show-faces="true" data-font="arial"></div></div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="margin_t1 img_height">
								<div class="float_l img_style aspectcorrect img_r">
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
									$img_arr=$this->searchmodel->set_the_image($width,$height,112,77,TRUE);
									?>
									<img style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" src="<?php echo $image; ?>" >
								
								</div>
								<div class="div_fix">
									<div class="float_l span3 margin_zero">
										<div><img src="<?php echo $base; ?>images/clock.png" class="line_img inline"><span class="blue line_time inline"><abbr class="timeago time_ago" title="<?php echo $event_detail['event_date_time']; ?>"></abbr>
										</span></div>
										<div><img src="<?php echo $base; ?>images/group.png" class="line_img inline"><span class="blue line_time inline"><?php 	echo $event_register_user = $this->frontmodel->count_event_register($event_detail['event_id']); ?>
											Register
										</span></div>
									</div>
									<div class="float_r">
										<form action="<?php echo $event_link_register; ?>/EventRegistration" method="post">
											<input type="hidden" name="event_register_of_univ_id" value="<?php echo $event_detail['univ_id']; ?>"/>
											<input type="hidden" name="event_register_id" value="<?php echo $event_detail['event_id']; ?>"/>
											<div class="float_r margin_t1">
											<input type="submit" name="btn_event_register" value="Register" class="btn btn-success" /></div>
											<div class="clearfix"></div>
										</form>
									</div>
									<div class="clearfix"></div>
								</div>
								<span class="wrap"><?php echo substr($event_detail['event_detail'],0,250).'..'; ?></span>	
								
							</div>
						</li>
					<?php } ?>	
					
						</ul>
				</div>
				</div>
				<div class="float_l span4">			
					<div class="back_up">
						<h3><img src="<?php echo base_url(); ?>images/home_cal.gif" style="z-index: 100;position: relative;top:6px;"><span style="position: relative;left: 10px;">Popular Events</span></h3>
						<ul class="up_event">
						<?php if(!empty($feature_events)){
								foreach($feature_events as $upcoming_event)
								{
								$event_title_list =$this->subdomain->process_url_title($upcoming_event['event_title']);	
								$event_link=$this->subdomain->genereate_the_subdomain_link(
								$upcoming_event['subdomain_name'],'event',$event_title_list,$upcoming_event['event_id']);
								?>
									<li><a href="<?php echo $event_link; ?>"><?php echo $upcoming_event['event_title']; ?></a></li>
								<?php } }
						?>		
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
	