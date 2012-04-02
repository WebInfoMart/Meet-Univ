<div id="content">
		<h2 class="margin">Create University Events</h2>
		<div class="form span8">
			<form action="" method="post" class="caption_form">
				<ul>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Title</label>
							</div>
							<div class="float_l span3">
								<input type="text" size="30" class="text">
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
					<?php if($admin_user_level=='5' || $admin_user_level=='4') {?>
					<li>
						<div>
						<div class="float_l span3 margin_zero">
							<label>Choose University</label>
						</div>
						<div class="float_l span3">
							<select class="styled span3 margin_zero">
								<option value="">Please Select</option>
							</select>
						</div>
						<div class="clearfix"></div>
						</div>
					</li>
					<?php } ?>
					<li>
						<div>
						<div class="float_l span3 margin_zero">
							<label>City</label>
						</div>
						<div class="float_l span3">
							<select class="styled span3 margin_zero">
								<option value="">Please Select</option>
							</select>
						</div>
						<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
						<div class="float_l span3 margin_zero">
							<label>State</label>
						</div>
						<div class="float_l span3">
							<select class="styled span3 margin_zero">
								<option value="">Please Select</option>
							</select>
						</div>
						<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Country</label>
							</div>
							<div class="float_l span3">
								<select class="styled span3 margin_zero">
									<option value="">Please Select</option>
									
								</select>
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Detail</label>
							</div>
							<div class="float_l">
								<textarea rows="12" cols="103"></textarea>
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
				</ul>
						<input type="submit" class="submit" value="UPDATE">
						
			</form>
		</div>
		
		
	</div>