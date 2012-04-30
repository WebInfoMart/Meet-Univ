<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			
			<div class="row" style="margin-top:-25px">
				<div class="float_l span13 margin_l margin_t">
					<div class="green_box">
						<div>
							<div class="float_l">
								<div class="letter_uni">
								<div>Upcoming Events</div>
								</div>
							</div>
							
							
							<div class="sliderkit-panels">
								<form>
									
						<div class="sliderkit contentslider-std">
							<div class="sliderkit-nav">
								<div class="sliderkit-nav-clip">
									<ul>
										<li class="float_l"><a href="#tab1" title="[link title]">All Events</a></li>
										<li class="float_l"><a href="#tab2" title="[link title]">Browse More Q & A</a></li>
										<li class="float_l"><a href="#tab3" title="[link title]">Office</a></li>
											<div class="clearfix"></div>
									</ul>
								</div>
							</div>
							<div class="sliderkit-panels">
								<form>
									<div class="sliderkit-panel" id="tab1">
										<div class="control-group">
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
										<span><?php echo $event_detail['event_date_time']; ?></span><br/>
									</div>
									<div class="float_r">
	<div class="fb-like" data-href="<?php echo $base;?>univ-<?php echo $event_detail['univ_id']; ?>-event-<?php echo $event_detail['event_id']; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div>
									
									<g:plusone size="medium" annotation="none"></g:plusone>
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
										
										<!--<span>Category course <a href="#" id="cat">Category</a></span>
										<div id="change" class="form-inline">
											<div class="control-group margin_t1">
												<label>Categorys</label>
												<select class="span3">
													<option>something</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
													<option>5</option>
												</select>
												<select id="select01">
													<option>something</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
													<option>5</option>
												</select>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="control-group margin_t1">
											<button class="btn btn-success" href="#">Post Question</button>
										</div>-->
									</div>
									<div class="sliderkit-panel" id="tab2">
										
										<div class="clearfix"></div>
									</div>
									<div class="sliderkit-panel" id="tab3">
										fine
									</div>
								</form>
							</div>
							<div class="clearfix"></div>
							<div id="pagination" class="table_pagination right paging-margin">
            <?php echo $this->pagination->create_links();?>
            </div>
										
									</div>
									
									<div class="sliderkit-panel" id="tab3">
										fine
									</div>
								</form>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
				<div class="float_r span3 margin_t">
					<img src="<?php echo "$base$img_path"; ?>/banner_img.png">
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
			
				
	<script type="text/javascript">
$(document).ready(function() {
	var fixed = false;

$(document).scroll(function() {
    if( $(this).scrollTop() >= 50 ) {
        if( !fixed ) {
            fixed = true;
            $('#main-nav-holder').css({position:'fixed',top:140,left:476});
			// Or set top:20px; in CSS
        }                                           // It won't matter when static
    } else {
        if( fixed ) {
            fixed = false;
            $('#main-nav-holder').css({position:'static'});
        }
    }
});

});

</script>
<!-- ===================start slider_kit=================== -->
		<script type="text/javascript" src="js/jquery.sliderkit.1.9.2.pack.js"></script>
		<script type="text/javascript" src="js/jquery.easing.1.3.min.js"></script>
		<script type="text/javascript" src="js/jquery.mousewheel.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/sliderkit-core.css" media="screen, projection" />
		<link rel="stylesheet" type="text/css" href="css/sliderkit-demos.css" media="screen, projection" />
		<link rel="stylesheet" type="text/css" href="css/sliderkit-site.css" media="screen, projection" />
		
			<script type="text/javascript">
			$(window).load(function(){ //$(window).load() must be used instead of $(document).ready() because of Webkit compatibility		
				
				// Photo slider > Minimal
				$(".contentslider-std").sliderkit({
					auto:0,
					tabs:1,
					circular:1,
					panelfx:"sliding",
					panelfxfirst:"fading",
					panelfxeasing:"easeInOutExpo",
					fastchange:0,
					keyboard:1
				});
				
			});	
		</script>
	<!-- ===================end slider_kit=================== -->