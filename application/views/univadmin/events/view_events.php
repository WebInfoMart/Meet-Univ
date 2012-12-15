<?php
if(!empty($event_info))
{
?> 
 <div class="content">
    <div class="container-fluid"> 
	<div class="responsible_navi"></div>		
      <div class="row-fluid">
        <div class="span12">
          <div class="page-header clearfix tabs">
            <h2>Events</h2>
          </div>
        <div class="content-box">
            <div class="row-fluid">
				<div class="span12">
					<form class="form-horizontal" onsubmit="return editEvent(this);" id="myform" action="<?php echo $base; ?>newadmin/admin_events/edit_event/<?php echo $event_info[0]['event_id']; ?>" method="post" enctype="multipart/form-data">
						<fieldset>
						<div class="row-fluid">
							<div class="span6">				
								<div class="control-group margin_b">
									<label for="username" class="control-label">Event Title</label>
									<div class="controls">
									<div class="help-inline data1"><?php echo $event_info[0]['event_title']; ?></div>
									<input type="text" name="title" id="title" style="display:none;" class="input-xlarge inputElement" value="<?php echo $event_info[0]['event_title']; ?>">
									</div>
								</div>
								<?php if($admin_user_level=='5' || $admin_user_level=='4') {?>
								<div class="control-group margin_b">
									<label for="username" class="control-label"><b>Choose University</b></label>
									<div class="controls">
									<div class="help-inline data1"><?php echo $event_info[0]['univ_name']; ?></div>
									<select style="display:none" class="input-xlarge inputElement"  id="university" name="university">
										<option value="">Please Select</option>
										<?php foreach($univ_info as $univ_detail) { ?>
										<option value="<?php echo $univ_detail->univ_id; ?>" <?php if($univ_detail->univ_id == $event_info[0]['event_univ_id']) { ?> selected <?php } ?> ><?php echo $univ_detail->univ_name; ?></option>
										<?php } ?>
									</select>
									</div>
								</div>
								<?php } else { ?>
									<input type="hidden" name="university" value="<?php echo $event_info[0]['event_univ_id']; ?>">
								<?php }?>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Checked IF Event IS Online</label>
									<div class="controls">
									<div class="help-inline data1">No</div>
									<?php
									if($event_info[0]['event_country_id']!='0' && $event_info[0]['event_state_id']!='0' && $event_info[0]['event_city_id']!='0')
									{ 
										$checked='';
										$disabled='';										
									}
									else
									{
										$checked='checked';
										$disabled='disabled';										
									}
									?>
									<input type="checkbox" <?php echo $checked; ?> name="location_event" id="location_event" class="inputElement" style="display:none;">
									</div>
								</div>								
								<?php // if($admin_user_level=='5' || $admin_user_level=='4') { ?>
								<div id="divShowHide" <?php if($checked=='checked'){ ?> style="display:none" <?php } ?>>
									<div class="control-group margin_b">
										<label for="username" class="control-label"><b>Country</b></label>
										<div class="controls">
										<div class="help-inline data1"><?php echo $event_info[0]['country_name']; ?></div>
										<select style="display:none" class="input-xlarge inputElement"  id="country" name="country" onchange="fetchstates(<?php echo $event_info[0]['event_state_id']; ?>)">
											<option value="">Please Select</option>
											<?php foreach($countries as $key => $countries_detail) { ?>
											<option value="<?php echo $countries_detail['country_id']; ?>" <?php if($countries_detail['country_id']==$event_info[0]['event_country_id']) { ?> selected <?php } ?> ><?php echo $countries_detail['country_name']; ?></option>
											<?php } ?>
										</select>
										</div>
									</div>							
									<?php // }else { ?>
										<!-- <input type="hidden" name="country" id="country" value="<?php echo $event_info[0]['event_country_id']; ?>"> -->
									<?php // } ?>

									<?php // if($admin_user_level=='5' || $admin_user_level=='4') { ?>
									<div class="control-group margin_b">
										<label for="username" class="control-label"><b>State</b></label>
										<div class="controls">
										<div class="help-inline data1"><?php echo $event_info[0]['statename']; ?></div>
										<select style="display:none" class="input-xlarge inputElement"  id="state" name="state" onchange="fetchcities(0,<?php echo $event_info[0]['event_city_id']; ?>)">
											<?php if($event_info[0]['event_state_id']!='0'){ ?>
												<option value="<?php echo $event_info[0]['event_state_id'];?>"><?php echo $event_info[0]['statename']; ?></option>
											<? } else { ?>
												<option value="">Please Select</option>
											<? } ?>
										</select>
										</div>
									</div>
									<?php //}else { ?>
										<!-- <input type="hidden" name="state" id="state" value="<?php echo $event_info[0]['event_state_id']; ?>"> -->
									<?php //}?>
									
									
									<?php //if($admin_user_level=='5' || $admin_user_level=='4') { ?>
									<div class="control-group margin_b">
										<label for="username" class="control-label"><b>City</b></label>
										<div class="controls">
										<div class="help-inline data1"><?php echo $event_info[0]['cityname']; ?></div>
										<select style="display:none" class="input-xlarge inputElement"  id="city" name="city">
											<?php if($event_info[0]['event_city_id']!='0'){ ?>
												<option value="<?php echo $event_info[0]['event_city_id'];?>"><?php echo $event_info[0]['cityname']; ?></option>
											<? } else { ?>
												<option value="">Please Select</option>
											<? } ?>
										</select>
										</div>
									</div>
									<?php // }else { ?>
									<!-- <input type="hidden" name="city" id="city" value="<?php echo $event_info[0]['event_city_id']; ?>"> -->
									<?php // } ?>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Event Place</label>
									<div class="controls">
									<div class="help-inline data1"><?php echo $event_info[0]['event_place'] ?></div>
									<input type="text" name="event_place" id="event_place" style="display:none;" class="input-xlarge inputElement" value="<?php echo $event_info[0]['event_place'] ?>">
									</div>
								</div>	
									<div class="control-group margin_b">
									<label for="username" class="control-label">Detail</label>
									<div class="controls">
									<div class="help-inline data1"><?php echo $event_info[0]['event_detail'] ?></div>
									<textarea name="detail" style="display:none;" id="detail" class="span12 inputElement" rows="4"><?php echo $event_info[0]['event_detail'] ?></textarea>
									</div>
								</div>	
							</div>
							<div class="span6">
								<div class="control-group margin_b">
									<label for="username" class="control-label">Event Type</label>
									<div class="controls">
									<div class="help-inline data1"><?php echo $event_info[0]['event_type'] ?></div>
									<input type="text" name="event_type" id="event_type" style="display:none;" class="input-xlarge inputElement" value="<?php echo $event_info[0]['event_type'] ?>">
									</div>
								</div>
								<div class="control-group margin_b">
									<?php $newStartDate = date("m/d/Y", strtotime($event_info[0]['event_date_time']));?>
									<label for="username" class="control-label">Event Start Date</label>
									<div class="controls">
									<div class="help-inline data1"><?php echo $newStartDate ?></div>
									<div class="input-prepend inputElement" style="display:none">
										<span class="add-on" style="display:none"><i class="icon-calendar"></i></span><input type="text" name="event_time" id="event_time" class="span4 datepick" value="<?php echo $newStartDate; ?>" style="display:none">
									</div>
									</div>
								</div>
								<div class="control-group margin_b">
									<?php $newEndDate = date("m/d/Y", strtotime($event_info[0]['event_date_time_end']));?>
									<label for="username" class="control-label">Event End Date</label>
									<div class="controls">
									<div class="help-inline data1"><?php echo $newEndDate; ?></div>
									<div class="input-prepend inputElement" style="display:none">
										<span class="add-on" style="display:none"><i class="icon-calendar"></i></span><input type="text" name="event_time_end" id="event_time_end" class="span4 datepick" value="<?php echo $newEndDate; ?>" style="display:none">
									</div>
									</div>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Checked IF Event Timing IS</label>
									<div class="controls">
									<div class="help-inline data1">No</div>
									<input type="checkbox" name="event_timing_not_fixed" id="event_timing_not_fixed" class="inputElement" style="display:none;">									
									</div>
								</div>
								<div id="divShowHideTime">
									<div class="control-group margin_b">
										<label for="username" class="control-label">Event Start Time</label>
										<div class="controls">
										<?php
											$event_info_time = explode("-",$event_info[0]['event_time']);
										?>
										<div class="help-inline data1"><?php echo $event_info_time[0]; ?></div>
										<div class="input-prepend inputElement" style="display:none">
											<span class="add-on inline margin_l" style="display:none"><i class="icon-time"></i></span>
											<input type="text" name="event_start_time" id="event_start_time" size="16" class='span4 timepicker' value="<?php echo $event_info_time[0]; ?>" style="display:none">										 
										</div>
										</div>
									</div>
									<div class="control-group margin_b">
										<label for="username" class="control-label">Event End Time</label>
										<div class="controls">
										<div class="help-inline data1"><?php echo $event_info_time[1]; ?></div>
										<div class="input-prepend inputElement" style="display:none">
											<span class="add-on inline margin_l" style="display:none"><i class="icon-time"></i></span><input type="text" name="event_end_time" id="event_end_time"  size="16" class='span4 timepicker' value="<?php echo $event_info_time[1]; ?>" style="display:none">
											</div>
										</div>
									</div>											
								</div>
								<div class="control-group margin_b" style="display:none" id="divShowHideMentionTime">
									<label for="username" class="control-label">Mention Event Timing</label>
									<div class="controls">
									<div class="help-inline data1"></div>
									<div class="input-prepend inputElement" style="display:none">
										<input type="text" name="event_mention_time" id="event_mention_time" class="input-xlarge inputElement" value="<?php echo $event_info[0]['event_time']; ?>" style="display:none">
									</div>
									</div>
								</div>	
														
							</div>
							
							<div class="clearfix"></div>
							<div class="form-actions">
									<a id="edit" class='btn btn-success pover' data-placement="top" data-content="Want to change" title="Edit">Edit</a>
									<a id="cancel" href="<?php echo $base; ?>newadmin/admin_events/view_event/<?php echo $event_info[0]['event_id']; ?>" style="display:none" class='btn btn-success pover' data-placement="top" data-content="Want to Cancel" title="Cancel">Cancel</a>
									<input id="update" style="display:none" type="submit" name="submit"  class='btn btn-success pover' data-placement="top" data-content="Update it" value="Update"/>
							</div>
						</div>
						</fieldset>
					</form>				
				</div> <!-- span12 -->
			</div> <!-- row-fluid --> 
        </div> <!-- content-box -->
       </div> <!-- span12 -->
      </div> <!-- row-fluid -->
    </div><!-- close .container-fluid -->
  </div><!-- close .content -->
<?php
}
?>
<script>
function editEvent()
{   
    var valid=true;
	if($("#title").val()=='')
	{
		$("#title").addClass('needsfilled');
		valid=false;		
	}
	else
	{
		$("#title").removeClass('needsfilled');
		valid=true;	
	}
	if($('#university option:selected').val()=='')
	{
		$("#university").addClass('needsfilled');
		valid=false;
	}	
	// if($('#country option:selected').val()=='')
	// {
		// $("#country").addClass('needsfilled');
		// valid=false;
	// }
	// if($('#state option:selected').val()=='')
	// {
		// $("#state").addClass('needsfilled');
		// valid=false;
	// }
	// if($('#city option:selected').val()=='')
	// {
		// $("#city").addClass('needsfilled');
		// valid=false;
	// }
	if($("#detail").val()=='')
	{
		$("#detail").addClass('needsfilled');
		valid=false;		
	}
	else
	{
		$("#detail").removeClass('needsfilled');
		valid=true;	
	}
	if($("#event_place").val()=='')
	{
		$("#event_place").addClass('needsfilled');
		valid=false;		
	}
	else
	{
		$("#event_place").removeClass('needsfilled');
		valid=true;	
	}
	if($("#event_type").val()=='')
	{
		$("#event_type").addClass('needsfilled');
		valid=false;		
	}
	else
	{
		$("#event_type").removeClass('needsfilled');
		valid=true;	
	}
	if($("#event_time").val()=='')
	{
		$("#event_time").addClass('needsfilled');
		valid=false;		
	}
	else
	{
		$("#event_time").removeClass('needsfilled');
		valid=true;	
	}
	if($("#event_time_end").val()=='')
	{
		$("#event_time_end").addClass('needsfilled');
		valid=false;		
	}
	else
	{
		$("#event_time_end").removeClass('needsfilled');
		valid=true;	
	}
	if($("#event_start_time").val()=='')
	{
		$("#event_start_time").addClass('needsfilled');
		valid=false;		
	}
	else
	{
		$("#event_start_time").removeClass('needsfilled');
		valid=true;	
	}
	if($("#event_end_time").val()=='')
	{
		$("#event_end_time").addClass('needsfilled');
		valid=false;		
	}
	else
	{
		$("#event_end_time").removeClass('needsfilled');
		valid=true;	
	}
	return valid;
}
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
			$('#cancel').show();
			$('#update').show();
			$('#edit').hide();
			$('form').find('.control-group').removeClass('margin_b');
			$('form').find('.help-inline').css('display', 'none');
			$('form').find('.inputElement').css('display', 'block');
			$('form').find('.add-on').css('display', 'inline-block');
			$('form').find('.datepick, .timepicker').css('display', 'inline-block');
			$('[name=event_start_time]').val("<?php echo $event_info_time[0]; ?>");
			$('[name=event_end_time]').val("<?php echo $event_info_time[1]; ?>");
			fetchstates(<?php echo $event_info[0]['event_state_id']; ?>);
			fetchcities(0,<?php echo $event_info[0]['event_city_id']; ?>);
			
		});	
	});
	$(document).ready(function()
	{	
		$("#location_event").click(function() {
		$("#divShowHide").toggle('slow');
		});
		$("#event_timing_not_fixed").click(function() {
		$("#divShowHideTime").toggle('slow');
		$("#divShowHideMentionTime").toggle('slow');
		});
		
	});
	function fetchstates(sid)
	{
		var stid=sid;
		var cid=$("#country option:selected").val();
		$.ajax({
		   type: "POST",
		   url: "<?php echo $base; ?>admin/state_list_ajax/",
		   data: 'country_id='+cid+'&sel_state_id='+stid,
		   cache: false,
		   success: function(msg)
		   {
			$('#state').attr('disabled', false);
			$('#state').html(msg);			
		   }
		   });
	}
	function fetchcities(state_id,cityid)
	{
		if(state_id=='0')
		{
			state_id=$("#state option:selected").val();
		}
		$.ajax({
			type: "POST",
			url: "<?php echo $base; ?>admin/city_list_ajax/",
			data: 'state_id='+state_id+'&sel_city_id='+cityid,
			cache: false,
			success: function(msg)
			{
				$('#city').attr('disabled', false);
				$('#city').html(msg);
			}
		});  
	} 
 </script>
 