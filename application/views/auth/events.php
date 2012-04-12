<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row margin_t1">
				<div class="float_l span13 margin_l">
					<h2 class="course_txt">Upcoming Events</h2>
					<div class="margin_t1">
					<?php foreach($events as $event_detail){ ?>
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
										<h3><a href="university/1"><?php echo $event_detail['event_title']; ?>
				-<?php echo $event_detail['cityname'].",".$event_detail['statename'].",".$event_detail['country_name']?></a></h3>
										<span><?php echo $event_detail['event_date_time']; ?></span><br/>
									</div>
									<div class="float_r">
										<h4>22 Register</h4>
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
			
				<div class="float_r span3">
					<img src="<?php echo "$base$img_path"; ?>/banner_img.png">
				</div>
				<div id="pagination" class="table_pagination right paging-margin">
            <?php echo $this->pagination->create_links();?>
            </div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	