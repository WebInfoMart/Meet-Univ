	<div class="row ">
				<div class="float_l span13 margin_l">
					
					<div class="">
						<h2 class="course_txt"><?php echo $event_detail['event_title']; ?></h2>
						<div class="float_l span9 margin_zero">
							<div>
								<h3>When</h3>
								<div class="date_heading"><?php echo $event_detail['event_date_time']; ?></div>
								<h3>Where</h3>
								<div class="date_heading"><?php echo $event_detail['country_name']; 
								if($event_detail['statename']==''){} else{echo ",".$event_detail['statename'];}
								if($event_detail['cityname']==''){} else{echo ",".$event_detail['cityname'];}
								?></div>
								<h3>Details</h3>
								<?php echo $event_detail['event_detail']; ?>
							</div>
						</div>
						
						<div class="clearfix"></div>
						<div class="margin_t">
							<div class="event_border">
								<h3>6 Comments</h3>
							</div>
							<div class="event_border">
								<div class="float_l">
									<div class="comment_img">
										<img src="images/user_model.png"/>
									</div>
								</div>
								<div>
									<h4><a href="#" class="course_txt">Ritu</a></h4>
									Where text is comprehensible in a document, people tend to focus on the textual content rather than upon overall presentation, so publishers use lorem 
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="event_border">
								<div class="float_l">
									<div class="comment_img">
										<img src="images/user_model.png"/>
									</div>
								</div>
								<div>
									<h4><a href="#" class="course_txt">Seema</a></h4>
									Where text is comprehensible in a document, people tend to focus on the textual content rather than upon overall presentation, so publishers use lorem 
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="margin_t margin_bs">
							<div class="events_box">
								<h3>Your Comment</h3>
								<div class="float_l span9 margin_zero">
									<form class="form-horizontal">
										<div class="control-group">
											<label class="control-label" for="input01">Name:</label>
											<div class="controls">
												<input type="text" class="input-xlarge" id="input01">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="input01">Email:</label>
											<div class="controls">
												<input type="text" class="input-xlarge" id="input01">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="textarea">Comment:</label>
											<div class="controls">
												<textarea class="input-xxlarge" id="textarea" rows="3"></textarea>
											</div>
										</div>
										<div class="control-group">
											<div class="controls">
												<button class="btn btn-success" href="#">Success</button>
											</div>
										</div>
									</form>
								</div>
								<div class="float_r">
									Have an account? <a href="#">Log In</a>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="float_r span3">
					<img src="images/banner_img.png">
				</div>
				<div class="clearfix"></div>
			</div>
	