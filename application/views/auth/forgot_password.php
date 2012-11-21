
	<div>
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div>
				<a data-toggle="modal" href="#forget_model" id="pulse"><span class="orange">+  Invite Friends</span></a>
				<div id="forget_model" class="model_back modal hide fade" style="display: none; ">
					<div class="modal-header no_border forget_heading">
						<a class="close" data-dismiss="modal">x</a>
						<h3>Forget Password</h3>
					</div>
					<div class="forget_back">
					<div class="modal-body forget_height">
						<form class="form-horizontal" action="forgot_password" method="post">
							<fieldset>
								<div class="control-group">
									<label class="control-label" for="prependedInput">Enter Your Email</label>
									<div class="controls">
										<div class="input-prepend">
											<span class="add-on"><img src="images/lock1.png" class="email_forget"></span><input type="text" class="span3" name="email" size="16" >
											<span style="color:red;"> <?php echo form_error('email'); ?><?php echo isset($errors['email'])?$errors['email']:''; ?> </span>
										</div>
									</div>
								</div>
								<div class="controls">
									<input type="submit" class="btn btn-primary" name="reset_pass">
								</div>
							 </fieldset>
						</form>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	