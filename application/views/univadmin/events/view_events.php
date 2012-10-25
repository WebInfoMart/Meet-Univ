  <div class="content">
    <div class="container-fluid">
      
      <div class="row-fluid">
        <div class="span12">
          <div class="page-header clearfix tabs">
            <h2>Events</h2>
          </div>
          <div class="content-box">
            <div class="row-fluid">
				<div class="span12">					
				<?php
				if(!empty($event_info))
				{
				?>
					<form class="form-horizontal">
						<fieldset>
						<div class="row-fluid">
							<div class="span6">				
								<div class="control-group margin_b">
									<label for="username" class="control-label">Event Title</label>
									<div class="controls">
									<div class="help-inline data1"><?php echo $event_info[0]['event_title'] ?></div>
									<input type="text" style="display:none;" class="input-xlarge inputElement" value="<?php echo $event_info[0]['event_title'] ?>">
									</div>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Choose University</label>
									<div class="controls">
									<div class="help-inline data1"><?php echo $event_info[0]['univ_name'] ?></div>
									<input type="text" style="display:none;" class="input-xlarge inputElement" value="<?php echo $event_info[0]['univ_name'] ?>">
									</div>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Checked IF Event IS Online</label>
									<div class="controls">
									<div class="help-inline data1">No</div>
									<input type="checkbox" value="yes" name="check" class="inputElement" style="display:none;">
									</div>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Country</label>
									<div class="controls">
									<div class="help-inline data1"><?php echo $event_info[0]['country_name'] ?></div>
									<input type="text" style="display:none;" class="input-xlarge inputElement" value="<?php echo $event_info[0]['country_name'] ?>">
									</div>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">State</label>
									<div class="controls">
									<div class="help-inline data1"><?php echo $event_info[0]['statename'] ?></div>
									<input type="text" style="display:none;" class="input-xlarge inputElement" value="<?php echo $event_info[0]['statename'] ?>">
									</div>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">City</label>
									<div class="controls">
									<div class="help-inline data1"><?php echo $event_info[0]['cityname'] ?></div>
									<input type="text" style="display:none;" class="input-xlarge inputElement" value="<?php echo $event_info[0]['cityname'] ?>">
									</div>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Event Place</label>
									<div class="controls">
									<div class="help-inline data1"><?php echo $event_info[0]['event_place'] ?></div>
									<input type="text" style="display:none;" class="input-xlarge inputElement" value="<?php echo $event_info[0]['event_place'] ?>">
									</div>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Detail</label>
									<div class="controls">
									<div class="help-inline data1"><?php echo $event_info[0]['event_detail'] ?></div>
									<textarea  style="display:none;" name="text" id="input07" class="span12 inputElement" rows="4"><?php echo $event_info[0]['event_detail'] ?></textarea>
									</div>
								</div>
							</div>
							<div class="span6">
								<div class="control-group margin_b">
									<label for="username" class="control-label">Event Type</label>
									<div class="controls">
									<div class="help-inline data1"><?php echo $event_info[0]['event_type'] ?></div>
									<input type="text" style="display:none;" class="input-xlarge inputElement" value="<?php echo $event_info[0]['event_type'] ?>">
									</div>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Event Date</label>
									<div class="controls">
									<div class="help-inline data1"><?php echo $event_info[0]['event_date_time'] ?></div>
									<div class="input-prepend inputElement" style="display:none">
										<span class="add-on" style="display:none"><i class="icon-calendar"></i></span><input type="text" class="span4 datepick" value="<?php echo $event_info[0]['event_date_time'] ?>" style="display:none">
									</div>
									</div>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Checked IF Event Timing IS</label>
									<div class="controls">
									<div class="help-inline data1">No</div>
									<input type="checkbox" value="checked" name="check" class="inputElement" style="display:none;">
									</div>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Event Start Time</label>
									<div class="controls">
									<?php
										$event_info_time = explode("-",$event_info[0]['event_time']);
									?>
									<div class="help-inline data1"><?php echo $event_info_time[0] ?></div>
									<div class="input-prepend inputElement" style="display:none">
										<span class="add-on inline margin_l" style="display:none"><i class="icon-time"></i></span><input type="text" size="16" id="time" class='span4 timepicker' value="<?php echo $event_info_time[0] ?>" style="display:none">									</div>
									</div>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Event End Time</label>
									<div class="controls">
									<div class="help-inline data1"><?php echo $event_info_time[1] ?></div>
									<div class="input-prepend inputElement" style="display:none">
										<span class="add-on inline margin_l" style="display:none"><i class="icon-time"></i></span><input type="text" size="16" id="time" class='span4 timepicker' value="<?php echo $event_info_time[1] ?>" style="display:none">									</div>
									</div>
								</div>
							</div>
							
							<div class="clearfix"></div>
							<div class="form-actions">
									<a id="edit" class='btn btn-success pover' data-placement="top" data-content="Want to change" title="Edit">Edit</a>
									<a href="#" class='btn btn-success pover' data-placement="top" data-content="Update it" title="Update">Update</a>
							</div>
						</div>
						</fieldset>
					</form>	
				<?php
				}
				?>
			</div> <!-- span12 -->
          </div> <!-- row-fluid --> 
        </div> <!-- content-box -->
       </div> <!-- span12 -->
      </div> <!-- row-fluid -->
    </div><!-- close .container-fluid -->
  </div><!-- close .content -->

   <script>
$(document).ready(function(){
	//alert('fnslfc');
	$('.collapsed-nav').css('display','none');
	var url = window.location.pathname; 
	var activePage = url.substring(url.lastIndexOf('/')+1);
	$('.mainNav li a').each(function(){  
		var currentPage = this.href.substring(this.href.lastIndexOf('/')+1);
		if (activePage == currentPage) {
			$('.mainNav li').removeClass('active');
			$('li').find('span').removeClass('label-white');
			$('li').find('i').removeClass('icon-white');
			$(this).parent().addClass('active'); 
			$(this).parent().find('span').addClass('label-white');
			$(this).parent().find('i').addClass('icon-white');
				$(this).parent().parent().css('display','block');
				if($(this).parent().parent().css('display','block'))
				{
					$(this).parent().parent().prev().parent().addClass('active');
					$(this).parent().parent().prev().find('span img').attr('src', 'img/toggle_minus.png');
					$(this).parent().parent().prev().find('span').addClass('label-white');
					$(this).parent().parent().prev().find('i').addClass('icon-white');
				}
			} 
		});
	});
 </script>
  <script>
	$(document).ready(function(){
		$("#edit").click(function() {
			$('form').find('.control-group').removeClass('margin_b');
			$('form').find('.help-inline').css('display', 'none');
			$('form').find('.inputElement').css('display', 'block');
			$('form').find('.add-on').css('display', 'inline-block');
			$('form').find('.datepick, .timepicker').css('display', 'inline-block');
		});	
	});
 </script>
 