
	<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body_container">
		
		<!-- send message successfully box -->
					<div class="modal" id="show_success" style="display:none;" >
					  <div class="modal-header">
						<a class="close" data-dismiss="modal"></a>
						<h3>Message For You</h3>
					  </div>
					  <div class="modal-body">
						<p><center><h4>Your Message Has been sent successfully.....</h4></center></p>
					  </div>
					  <div class="modal-footer">
						<!--<a href="#" class="btn">Close</a>-->
						<!--<a href="#" class="btn btn-primary">Save changes</a>-->
					  </div>
				</div>
					<!-- End here -->
					
			<div class="row">
				<div class="margin_zero span16">
					<div data-alert="alert" class="alert alert-message message">
								<a data-dismiss="alert" class="close">×</a>
								<div>
									<div class="float_l"><h2>Welcome! Let’s get started by</h2></div>
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
					<?php $this->load->view('user/profile-sidebar.php'); ?>
					<div class="span13 float_r">
						<div class="span10 margin_zero float_l">
							<div class="inbox_box">
								<div class="float_r"><?php echo $message_full['ontime']!='0' ? $message_full['ontime'] : ''; ?></div>
								<h3>Sender</h3><?php echo $get_sender_email['email']!='0' ? $get_sender_email['email'] : ''; ?>
								<h3>Subject </h3><?php echo $message_full['subject']!='0' ? $message_full['subject'] : ''; ?>
								<h3>Message</h3><p> <?php echo $message_full['body']!='0' ? $message_full['body'] : ''; ?> </p>
								<div id="reply_msg" class="reply_msg_box" > Reply to user </div>
								<div class="float_r">
									<a href="<?php echo "$base"; ?>inbox">back to Inbox</a>
								</div>
								<form class="well form-search" id="form_reply" style="width:369px;display:none;" action="" method="post">
        Subject:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="input-xlarge" name="msg_sub"></br></br>
		<span style="color:red;"> <?php echo form_error('msg_sub'); ?><?php echo isset($errors['msg_sub'])?$errors['msg_sub']:''; ?></span>
        Message:&nbsp;&nbsp;&nbsp;<textarea class="input-xlarge" id="textarea" rows="3" name="msg_body"></textarea></br></br>
		<span style="color:red;"> <?php echo form_error('msg_body'); ?><?php echo isset($errors['msg_body'])?$errors['msg_body']:''; ?></span>
        <center><input type="submit" name="btn_msg_reply" class="btn" value="Send Message"></center>
      </form>
								
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="span3 float_l">
							<img src="images/banner_img.png">
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script>
	$(document).ready(function(){
	$('#reply_msg').click(function(){
	$('#form_reply').css('display','block');
	$('#form_reply').hide();
	$('#form_reply').show('slow');
	});
	<?php if($error_send_msg_via_reply == 1) { ?>
	$('#form_reply').css('display','block');
	<?php } ?>
	});
	</script>
	<script>
	$(document).ready(function(){
	<?php if($send_msg_via_reply == 1) { ?>
	$('#show_success').css('display','block');
	$('#show_success').delay(3000).fadeOut(300);
	<?php } ?>
	});
	</script>
	
	
	
	