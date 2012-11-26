<?php //print_r($user_info);exit;

$host=$_SERVER['HTTP_HOST'];
 ?>
<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
		<div class="row margin_t1">
		
			<div class="float_l span10 margin_l">				
				
					<div class="span9 margin_zero float_l">
					<form class="form-horizontal form_step_box" onsubmit="return validate(this);" action="<?php echo $base; ?>auth/advt_event_register" method="post" id="frm_Event_Register">
						<!--
						<a href="<?php echo $base;?>british_council_fair/hm/2"><img src="<?php echo $base;?>images/banner.jpg" style="float:right;" /></a>
						<div class="span13 margin_zero float_l">
						<h3>British Council Events</h3>
						<div class="margin_t1">			
							<img id="ajax_loader" src="<?php echo $base;?>images/ajax_loader.gif" style="display:none;width:30px;height:30px;"/>			
						<?php foreach($events_for_calendar as $events) {
						?>
							
								<div id="date_<?php echo $events['event_id']; ?>" onclick="eventDetail('<?php echo $events['event_date_time'];?>','<?php echo $events['event_city_id']; ?>')" class="float_l event_bc_cal" >
									<h3><?php echo $events['event_date_time']; ?></h3>
									<?php if($events['event_date_time_end']!='') { echo " - ".$events['event_date_time_end'];} ?>
									<span><?php echo $events['cityname']; ?></span>
								</div>
						
						<?php } ?>					
						</div>
						</div>
						<br />
						<h3>Register to get : </h3>
						<h3 style="color:#F36E21;">University Information <span style="color:black;">| </span>Free expert advice <span style="color:black;">|</span> MeetUps</h3>
						<br /> -->
					<div style="width:1000px;">
						<div style="width:300px;float:left;margin:11px;">
								<a href="<?php echo $base;?>british_council_fair/hm/2">
								<img src="<?php echo $base;?>images/banner.jpg"  /></a>
						</div>	
						<div style="width:300px;float:left;margin:5px;">
							<div class="span13 margin_zero float_l">
							<h3>British Council Events</h3>
							<div class="margin_t1">			
								<img id="ajax_loader" src="<?php echo $base;?>images/ajax_loader.gif" style="display:none;width:30px;height:30px;"/>			
							<?php 
							if(!empty($events_for_calendar))
							{
							foreach($events_for_calendar as $events) {
							?>
								
									<div id="date_<?php echo $events['event_id']; ?>" onclick="eventDetail('<?php echo $events['event_date_time'];?>','<?php echo $events['event_city_id']; ?>')" class="float_l event_bc_cal" >
										<h3><?php echo $events['event_date_time']; ?></h3>
										<?php if($events['event_date_time_end']!='') { echo " - ".$events['event_date_time_end'];} ?>
										<span><?php echo $events['cityname']; ?></span>
									</div>
							
							<?php } }else{ 
							echo "No Events Available";
							} ?>					
							</div>
							</div>
						
						</div>	
					<div style="width: 300px;float: right;margin: 5px;border: 1px solid;border-color: #CCC;padding: 10px;background: #F1F1F1;">
						<h3>Register to get : </h3>
						<h3 style="color:#F36E21;">University Information <span style="color:black;">| </span>Free expert advice <span style="color:black;">|</span> MeetUps</h3>
						</br>
						<div class="margin_t1">
						
							
							<div>
								<label class="control-label" for="focusedInput">Full Name</label>
								<div style="margin-top:10px;">
									<input style="width:150px;" type="text" class="input-xlarge focused span2" name="event_fullname" id="event_fullname" value=""/>	
									<input	type="hidden" name="current_user_id" value="<?php echo $user_info; ?>" />				
								</div>
							</div>
							<div>
								<label class="control-label" for="focusedInput">Email</label>
								<div style="margin-top:10px;">
									<input style="width:150px;" type="text" name="event_email" id="event_email" class="input-xlarge focused span2" value=""/>
									<input type="hidden" name="uri_seg" value="<?php echo $this->uri->segment(2); ?>"/>
								</div>
							</div>
							<div>
								<label class="control-label" for="focusedInput">Phone</label>
								<div style="margin-top:10px;">
								<input style="width:150px;" type="text" maxlength="10" class="input-xlarge focused span2" name="event_phone" id="event_phone" value=""/>
								</div>
							</div>
							<div>
								<label class="control-label" for="focusedInput"></label>
								<div style="margin-top:10px;">
									<input type='checkbox' onclick='select_all()' id='select_it'>&nbsp;&nbsp;<b>Check for all events</b>
								</div>
							</div>
							
							<div>
							<input style="margin-top:28px;" type="submit" name="submit_event_register" value="Register me" class="btn btn-success"/>
							<div id="notselect" style="display:none;"><h4 style="color:red;">Please select atleast one event!!</h4></div>
								
							</div>
					</div>
					</div>					
					</div>
					
					<div class="clearfix"></div>
					
					<div id="content" class="margin_t1">			
					<?php 	
					if(!empty($datewise_event))
					{ 	
					$i=0; ?>
					<table>
					<?php
					foreach($datewise_event as $today_event) {
					if($i%3==0)
					{ echo "<tr>"; }
					?>
						<td>
							<div class="float_l list_bc_univ" style="height:215px;" >
							<?php $i++;
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

									<img class="img_bc_univ" style="float:left;width:<?php echo $img_arr['width']; ?>px;height:<?php echo $img_arr['height']; ?>px;" src="<?php echo $image; ?>" >								
								<h4><?php echo $today_event['univ_name']; ?></h4>
								<h5><?php if($today_event['event_title']!='')
								{ 
								echo $today_event['event_title']; 
								}
								else
								{
								echo $today_event['univ_name'];
								} ?> </h5>
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
						
								
								<div id="date_<?php echo $today_event['event_id']; ?>" onclick="showDetail(<?php echo $today_event['event_id']; ?>)"  class="div_fix" style="cursor:pointer;">
									<div><!-- class="float_l span3 margin_zero"-->
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
								<label><input type="checkbox" class="event_selected" name="checked[]" value="<?php echo $today_event['event_id']; ?>" /> Select to register</label>
							</div>
					</td>
					<?php 
					if($i%3==0)
					{
					echo "</tr>";
					}
					} 
					}
					else 
					{ echo "No events for today please select a date for event"; }
					?>	
					</table>
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
	//alert(id);
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
	var check=false;
	$("input[type='checkbox']:checked").each(
		function() 
		{//alert('hi');
			check=true;       

		}
	);
//alert(check);	
	//var check=$('.event_selected').attr('checked')?true:false;
	//alert(check);
	if(check==false)
	{
		$("#notselect").show();
		valid=false;
	}
	else
	{
		$("#notselect").hide();
		
	}
	return valid;
	
	
}

function eventDetail(date,city)
{$("#ajax_loader").show();
	//alert(city);
	var url='http://<?php echo $host;?>/auth/date_event';
	 var data={date:date,city:city};
	 $.ajax({
				type: "POST",
				url: url,
				data:data,
				success:function(msg)
				{	$("#ajax_loader").hide();			
					$("#content").html();
					$("#content").html(msg);					
					//$("html, body").animate({ scrollTop: $(document).height()-$(window).height() });				
			
				}
			});
}
function select_all()
{
			if($('#select_it').is(':checked'))
			{
				$('input:checkbox').attr('checked','checked');
			}
			else 
			{
				$('input:checkbox').removeAttr('checked');
			}
}
</script>
