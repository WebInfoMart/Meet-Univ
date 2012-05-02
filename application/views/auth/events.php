<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			
			<div class="row">
				<div class="float_l" style="margin-top: -13px;">
				<div class="well form-search" style="width: 784px;">
					
					<div id="link1" style="cursor:pointer;color:whitesmoke;float:left;width: 100px;"> <h3><a style="color:brown;">All Events</a></h3> </div>
					<div id="link2" style="cursor:pointer;color:whitesmoke;float:left;"> <h3><a style="color:brown;">Selected Events</a></h3> </div>
					
				</div>
				<div id="event1" class="well form-search" style="width: 705px;padding:0px;float:left;margin-top: -20px;width: 822px;">
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
								<div>
									<div class="float_l">
<h3><a href="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>"><?php echo $event_detail['event_title']; ?>
				-<?php echo $event_detail['cityname'].",".$event_detail['statename'].",".$event_detail['country_name']?></a></h3>
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
				<div id="event2" class="well form-search" style="height: 298px;width: 705px;padding:0px;float:right;display:none;margin-top: -20px;width: 822px;">
					No Results Found !!!
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
<script>
$('#link1').click(function(){
$('#event2').css("display","none");
$('#event1').css("display","block");
});
$('#link2').click(function(){
$('#event1').css("display","none");
$('#event2').css("display","block");
});
</script>