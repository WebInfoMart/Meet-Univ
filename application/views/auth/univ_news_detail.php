<?php
$class_fullname='';
$class_email='';
$class_commented_text='';
$error_fullname = form_error('full_name');
$error_email = form_error('email');
$error_commented_text = form_error('commented_text');

if($error_fullname != '') { $class_fullname = 'focused_error'; } else { $class_fullname='input-xlarge'; }

if($error_email != '') { $class_email = 'focused_error'; } else { $class_email='input-xlarge'; }

if($error_commented_text != '') { $class_commented_text = 'focused_error'; } else { $class_commented_text='input-xxlarge'; }
?>	
	<div class="row ">
				<div class="float_l span13 margin_l">
					
					<div class="">
						<h2 class="course_txt"><?php echo $news_detail['news_title']; ?></h2>
						<div class="float_l span9 margin_zero">
							<div>
								<h3>Posted Time</h3>
								<div class="date_heading"><?php echo $news_detail['publish_time']; ?></div>
								<h3>Details</h3>
								<?php echo $news_detail['news_detail']; ?>
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
									<form class="form-horizontal" method="post" action="">
									<input type="hidden" name="commented_on_id" value="<?php echo $news_detail['news_id']; ?>" >
									<input type="hidden" name="commented_on" value="news" >
									
										<div class="control-group">
											<label class="control-label" for="input01">Name:</label>
											<div class="controls">
												<input type="text" value="<?php if($clear_comment==1){ echo ""; } else{ echo set_value('full_name');} ?>" class="<?php echo $class_fullname; ?>" id="input01" name="full_name">
												<span style="color: red;"> <?php echo form_error('full_name'); ?><?php echo isset($errors['full_name'])?$errors['full_name']:''; ?> </span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="input01">Email:</label>
											<div class="controls">
												<input type="text" value="<?php if($clear_comment==1){ } else{ echo set_value('email');} ?>" class="<?php echo $class_email; ?>" id="input01" name="email">
												<span style="color: red;"> <?php echo form_error('email'); ?><?php echo isset($errors['email'])?$errors['email']:''; ?> </span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="textarea">Comment:</label>
											<div class="controls">
												<textarea class="<?php echo $class_commented_text; ?>" id="textarea" name="commented_text" rows="3">
												<?php if($clear_comment==1){ echo ""; } else{ echo set_value('commented_text');} ?></textarea>
												<span style="color: red;"> <?php echo form_error('commented_text'); ?><?php echo isset($errors['commented_text'])?$errors['commented_text']:''; ?> </span>
											</div>
										</div>
										<div class="control-group">
											<div class="controls">
												<input type="submit" class="btn btn-success" name="submit" value="Post Comment">
											</div>
										</div>
									</form>
								</div>
								<div class="float_r">
									Have an account? <a href="<?php echo $base; ?>login">Log In</a> OR <a href="<?php echo $base; ?>register">Sign Up</a>
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