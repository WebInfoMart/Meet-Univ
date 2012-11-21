<?php //print_r($events_for_calendar);exit; 
//echo $this->uri->segment(2);

?>
<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
		<div class="row margin_t1">
			<div class="float_l span13 margin_l">				
				<div class="span9 margin_zero float_l">
					<h3>Events</h3>
					<div class="margin_t1">			
									
					<?php foreach($events_for_calendar as $events) {
					?>
						
							<div id="date_<?php echo $events['event_id']; ?>" onclick="eventDetail(<?php echo $events['event_id']; ?>)" class="float_l" style="border:2px solid;cursor:pointer;">
								<h3><?php echo $events['event_date_time']; ?></h3>
								<?php if($events['event_date_time_end']!='') { echo " - ".$events['event_date_time_end'];} ?>
								<span><?php echo $events['cityname']; ?></span>
							</div>
					
					<?php } ?>								
						
					</div>
					
				</div>
					<div class="span9 margin_zero float_l">
					<h3>Events Details</h3>
					<form class="form-horizontal form_step_box" onsubmit="return validate(this);" action="<?php echo $base; ?>auth/advt_event_register" method="post" id="frm_Event_Register">
					<div id="content" class="margin_t1">			
					<?php 	
					if($datewise_event){ 			
					foreach($datewise_event as $today_event) {
					?>
						
							<div class="float_l" style="border:2px solid;">
							<?php
							$image_exist=0;	

									$event_img = $today_event['univ_logo_path'];	

									if(file_exists(getcwd().'/uploads/univ_gallery/'.$event_img) && $event_img!='')	

									{

									$image_exist=1;

									list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/univ_gallery/'.$event_img);

									}

									else

									{

									list($width, $height, $type, $attr) = getimagesize(getcwd().'/uploads/univ_gallery/univ_logo.png');

								    }

									if($event_img!='' && $image_exist==1)

									{

									$image=$base.'uploads/univ_gallery/'.$event_img;

									}

									else

									{

									$image=$base.'/uploads/univ_gallery/univ_logo.png';

									} 

									$img_arr=$this->searchmodel->set_the_image($width,$height,112,77,TRUE);

									?>

									<img style="left:<?php echo $img_arr['targetleft']; ?>px;top:<?php echo $img_arr['targettop']; ?>px;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" src="<?php echo $image; ?>" >

								
								<h3><?php if($today_event['event_title']!='')
								{ 
								echo $today_event['event_title']; 
								}
								else
								{
								echo $today_event['univ_name'];
								} ?> </h3>
								<span>
								<?php
								
									if($today_event['cityname']!='') { 
									echo $today_event['cityname'];
									}
									if($today_event['cityname']!='' && $today_event['statename']!='')
									{
									echo '&nbsp;,&nbsp;'.$today_event['statename'];
									}
									else if($today_event['statename']!='')
									{
									echo $today_event['statename'];
									}
									if(($today_event['cityname']!='' || $today_event['statename']!='') && $today_event['country_name']!='')
									{
									echo '&nbsp;,&nbsp;'.$today_event['country_name'];
									}
									else
									{
									echo $today_event['country_name'];
									}
									?>
								</span>
						
								
								<div id="date_<?php echo $today_event['event_id']; ?>" onclick="showDetail(<?php echo $today_event['event_id']; ?>)"  class="div_fix" style="width:300px;cursor:pointer;">
									<div class="float_l span3 margin_zero">
										<div>
										<img src="<?php echo $base; ?>images/clock.png" class="line_img inline">
											<span style="width:180px;" class="blue line_time inline"><?php echo $today_event['event_date_time'].','.$today_event['event_time']; ?>
											</span>
										</div>
									</div>
									<div>
									<img src="<?php echo $base; ?>images/group.png" class="line_img inline">
										<span class="blue line_time inline"><?php 	echo $event_register_user = $this->frontmodel->count_event_register($today_event['event_id']); ?>	Register
										</span>
									</div>
								<span class="wrap"><?php echo substr(strip_tags($today_event['event_detail']),0,150).'..'; ?></span>
								</div>									
								<br />
								<input type="checkbox" name="checked[]" value="<?php echo $today_event['event_id']; ?>" />&nbsp;&nbsp;select to register
							</div>
					
					<?php } ?>
					</div>
					<div class="clearfix"></div>
					<div class="margin_t1">
						
							
							<div class="control-group ">
								<label class="control-label" for="focusedInput">Full Name</label>
								<div class="controls">
								<input type="text" class="input-xlarge focused" name="event_fullname" id="event_fullname" value=""/>						
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Email</label>
								<div class="controls">
								<input type="text" name="event_email" id="event_email" class="input-xlarge focused" value=""/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" maxlength="10" for="focusedInput">Phone</label>
								<div class="controls">
								<input type="text" class="input-xlarge focused" name="event_phone" id="event_phone" value=""/>
								</div>
							</div>
						
							<div class="controls">
							<input type="submit" name="submit_event_register" value="Register me" class="btn btn-success"/>
								
							</div>
						
					
					<?php
					
					}
					else 
					{ echo "No events for today please select a date for event"; }
					?>								
						
					</div>
					</form>
				</div>
			</div>		
		</div>
	</div>
</div>
<script type="text/javascript">
function showDetail(id)
{
	alert(id);
}
function validate()
{
	var valid=true;
	if($('#event_fullname').val()=='')
	{
		$("#event_fullname").addClass('needsfilled');
		valid=false;
	}
	if($("#event_email").val()=='')
	{
		$("#event_fullname").addClass('needsfilled');
		valid=false;		
	}
	if($("#event_phone").val()=='')
	{
		$("#event_fullname").addClass('needsfilled');	
			valid=false;
	}
	return valid;
	
}

function eventDetail(id)
{
	var url='<?php echo $base;?>auth/date_event';
	 var data={date:id};
	 $.ajax({
				type: "POST",
				url: url,
				data:data,
				success:function(msg)
				{
				
					$("#content").html();
					$("#content").html(msg);					
					$("html, body").animate({ scrollTop: $(document).height()-$(window).height() });				
			
				}
			});
}
</script>