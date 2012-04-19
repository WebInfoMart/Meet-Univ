<div class="row" style="margin-top:-20px">
	<div>
		<div class="float_l span13 margin_l">
			<h3>Question: <span class="heading_follow"> <?php echo $single_quest['q_title'] ? $single_quest['q_title'] : 'Question Has been removed !' ; ?></span></h3>
			<div>
				<div class="float_l span2 margin_zero">
					<?php echo $single_quest['user_pic_path'] ? "<img class='question_user' src='".base_url()."uploads/".$single_quest['user_pic_path']."'/>" : 'No Image'; ?>
				</div>
				<?php echo "Asked By : "; echo $single_quest['fullname'] ? $single_quest['fullname'] : 'Name Not available'; ?>
				<div class="clearfix"></div>
			</div>
			<div class="margin_t">
				<div class="event_border">
					<h3>6 Comments</h3>
				</div>
				<div class="event_border">
					<div class="float_l">
						<div class="comment_img">
							<img src="<?php echo "$base"; ?>images/user_model.png"/>
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
							<img src="<?php echo "$base"; ?>images/user_model.png"/>
						</div>
					</div>
					<div>
						<h4><a href="#" class="course_txt">Seema</a></h4>
						Where text is comprehensible in a document, people tend to focus on the textual content rather than upon overall presentation, so publishers use lorem 
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
				<div class="margin_t margin_b">
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
		<div class="float_r span3 margin_t">
			<img src="<?php echo "$base"; ?>images/banner_img.png">
		</div>
		<div class="clearfix"></div>
	</div>
</div>
</div>