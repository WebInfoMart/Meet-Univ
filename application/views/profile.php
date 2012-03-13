<!DOCTYPE html>
<html lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Project</title>
<meta name="description" content="">
<meta name="author" content="">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/style_sh.css">
<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap-collapse.js"></script>
<script type="text/javascript" src="js/bootstrap-dropdown.js"></script>
<script src="js/bootstrap-alerts.js"></script>
<script type="text/javascript" src="js/bootstrap-modal.js"></script>
<script type="text/javascript">
$(document).ready(function(){
 $('#pulse').click(function(){
$('#myModal').modal('toggle');});
 });

</script>

</head>

<body>
	
	<div>
		
		<div class="body_container">
			<div class="row show-grid">
				<div class="span13">
					<div class="alert alert-message message" data-alert="alert">
						<a class="close" data-dismiss="alert">&times;</a>
						<div>
							<div class="float_l"><h2>Welcome! Let&#8217;s get started by</h2></div>
							<div class="float_r close_cont"> <span> Don't want our help? </span> Close Tips </div>
							<div class="clearfix"></div>
						</div>
						<nav id="help-tools">
							<ul>
								<li class="text_dec">1) Step 1</li>
								<li><a href="#">2) Step 2</a></li>
								<li><a href="#">3) Step 3</a></li>
								<li><a href="#">4) Step 4</a></li>
							</ul>
						</nav>
					</div>
					<div>
						<div class="float_l span15 margin_zero sidebar">
							<div class="sidebar_profic_pic">
								<img src="images/profile_pic.png">
								<h3 class="text_align"><?php echo $query['fullname']; ?></h3>
								<div>
									<div class="margin_all">
										<h4>11 March,Male</h4>
										<h4>MBA</h4>
									</div>
								</div>
							</div>
							<div class="part_second" style="">
								<div class="index_sidebar_progress">
									<div class="index_sidebar_body">
										<h4 class="font_sidebar">Your Profile Completes 25%</h4>
										<div class="progress_outline progress_out">
											<div class="progress progress_bar">
												<div class="bar margin_zero" style="width: 50%;">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="part_second">
								<div class="index_sidebar_box">
									<div class="index_sidebar_header font_sidebar">
										My Colleges
									</div>
									<div class="index_sidebar_body">
									<ul class="links">
										<li><a href="#">MBA</a></li>
										<li><a href="#">Engineering</a></li>
										<li><a href="#">Info Tech</a></li>
										<li><a href="#">Education</a></li>
										<li><a href="#">Aviation</a></li>
										<li><a href="#">Science</a></li>
									</ul>
									</div>
								</div>
							</div>
							<div class="part_second">
								<div class="index_sidebar_box">
									<div class="index_sidebar_header font_sidebar">
										Messages
									</div>
									<div class="index_sidebar_content">
										<ul class="links1">
											<li><a href="#">Composer</a></li>
											<li><a href="#">Inbox (40)</a></li>
											<li><a href="#">Outbox (40)</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="part_second font_sidebar">
								<div class="index_sidebar_content invite">
									<div class="index_sidebar_header">
										<a data-toggle="modal" href="#myModal" id="pulse"><span class="orange">+  Invite Friends</span></a>
										<div id="myModal" class="modal hide fade" style="display: none; ">
											<div class="modal-header">
												<a class="close" data-dismiss="modal">×</a>
												<h3>thank you</h3>
											</div>
											<div class="modal-footer">
											<a href="#" class="btn btn-primary">Save changes</a>
											<a href="#" class="btn" data-dismiss="modal">Close</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="float_r span111">
							<div class="row">
								<div class="span71">
									<div class="events_box">
										<h2>Events</h2>
										<ul>
											<li>Barnes, H.M. 2012. Durable composites: An overview. Proceedings, American Wood in floodplain lakes of the Mississippi Alluvial Valley. Environmental Biology of Fishes.<img src="images/event_arrow.png"></li>
											<li>Dembkowski, D.J., L.E. Miranda. 2012. Hierarchy in factors affecting fish biodiversity Supplemental treatments for timber bridge components. Forest Products Journal.<img src="images/event_arrow.png"></li>
											<li>Barnes, H.M. 2012. Durable composites: An overview. Proceedings, American Wood <img src="images/event_arrow.png"></li>
											<li>Dembkowski, D.J., L.E. Miranda. 2012. Hierarchy in factors affecting fish biodiversity.<img src="images/event_arrow.png"></li>
										</ul>
									</div>
									<div class="margin1 news_box">
										<div class="float_l span74 margin_zero">
											<h2>Study Abroad</h2>
											<div>
												<ul class="margin_zero span41 study_point">
													<li>
														<div class="float_l count">
															<div class="float_l"><a href="#" class="study_content">USA</a></div>
															<div class="float_r"><img src="images/us.png"></div>
															<div class="clearfix"></div>
														</div>
														<div class="float_l count">
															<div class="float_l"><a href="#" class="study_content">UK</a></div>
															<div class="float_r"><img src="images/gb.png"></div>
															<div class="clearfix"></div>
														</div>
														<div class="clearfix"></div>
													</li>
													<li>
														<div class="float_l count">
															<div class="float_l"><a href="#" class="study_content">Canada</a></div>
															<div class="float_r"><img src="images/ca.png"></div>
															<div class="clearfix"></div>
														</div>
														<div class="float_l count">
															<div class="float_l"><a href="#" class="study_content">Korea</a></div>
															<div class="float_r"><img src="images/kr.png"></div>
															<div class="clearfix"></div>
														</div>
														<div class="clearfix"></div>
													</li>
													<li>
														<div class="float_l count">
															<div class="float_l"><a href="#" class="study_content">India</a></div>
															<div class="float_r"><img src="images/india.png"></div>
															<div class="clearfix"></div>
														</div>
														<div class="float_l count">
															<div class="float_l"><a href="#" class="study_content">Online</a></div>
															<div class="float_r"><img src="images/ol.png"></div>
															<div class="clearfix"></div>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="right_border float_l"></div>
										<div class="float_r span74 news_data margin_zero">
											<h2>News</h2>
												<ul>
													<li>Barnes, H.M. 2012. Durable composites: An overview. Proceedings, American Wood.<img src="images/event_arrow.png" class="news_arrow"></li>
													<li>Dembkowski, D.J., L.E. Miranda. 2012. Hierarchy in factors affecting fish biodiversity.<img src="images/event_arrow.png" class="news_arrow"></li>
													<li>Barnes, H.M. 2012. Durable composites: An overview. Proceedings, American Wood.<img src="images/event_arrow.png" class="news_arrow"></li>
											</ul>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="news_box">
										<h2>Question and Answer</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a dictum arcu. Vestibulum ultrices lacus in velit posuere sit amet elementum metus fringilla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut at quam id velit pulvinar rutrum. Cras gravida velit id augue viverra eget tempus mauris mollis.Ut at quam id velit. </p>
									</div>
								</div>
								<div class="span15">
									<img src="images/banner_img.png">
								</div>
								
							</div>
							<div class="row artical margin_t">
									<div class="span72 artical_box">
										<div class="index_sidebar_box">
												<div class="artical_heading">Article</div>
											<div id="home" class="box artical_box_data">
												<div class="float_l margin_r1">
													<img src="images/layer.png">
												</div>
												<div class="margin_l8">
													Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od vestibulum felis aesent eu.Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od vestibulum felis aesent eu nisl at eros vulputate fringilla uismod dictum. 
												</div>							
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<div class="span72 artical_box">
										<div class="index_sidebar_box">
												<div class="artical_heading">Article</div>
											<div id="home" class="box artical_box_data">
												<div class="float_l margin_r1">
													<img src="images/layer.png">
												</div>
												<div class="margin_l8">
													Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od vestibulum felis aesent eu.Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od vestibulum felis aesent eu nisl at eros vulputate fringilla uismod dictum. 
												</div>							
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<div class="span72 artical_box">
										<div class="index_sidebar_box">
												<div class="artical_heading">Article</div>
											<div id="home" class="box artical_box_data">
												<div class="float_l margin_r1">
													<img src="images/layer.png">
												</div>
												<div class="margin_l8">
													Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od vestibulum felis aesent eu.Aenean id ipsum nec lorem commodo imperdiet euismod dictum erat. Praesent eu nisl at eros vulputate fringilla vel rdiet od vestibulum felis aesent eu nisl at eros vulputate fringilla uismod dictum. 
												</div>							
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<div class="clearfix"></div>
							</div>
						<div class="clearfix"></div>
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>

</body>
</html>