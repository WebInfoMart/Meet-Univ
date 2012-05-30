<?php
$fullname = "";
$mobno= "";
	if(!empty($fetch_profile_user))
	{
	if($fetch_profile_user['fullname'] != '')
	{
		$fullname = $fetch_profile_user['fullname'];
	} else { $fullname=''; }
	
	if($fetch_profile_user['mob_no'] != '')
	{
		$mobno = $fetch_profile_user['mob_no'];
	} else { $mobno=''; }
	}
if(!empty($event_info_sms))
{
foreach($event_info_sms as $event_sms)
{
	$url = 'leadcontroller/send_sms_voice_of_event';
	echo "
	<form action='$base$url' method='post' id='sms_form_voice'>
	<input type='hidden' name='uid' value='127'/>
	<input type='hidden' name='pwd' value='restapi1103'/>
	<input type='hidden' name='fid' value='606'/>
	Name &nbsp;<input type='text' style='margin-left:25px;' name='fullname_voice' value='$fullname'/></br></br>
	Mobile No &nbsp;<input type='text' name='mobno' value='$mobno'/></br>
	<input type='hidden' name='event_title_voice' value='$event_sms[event_title]'>
	<input type='hidden' name='event_date_voice' value='$event_sms[event_date_time]'>
	<input type='hidden' name='event_time_voice' value='$event_sms[event_time]'>
	<input type='hidden' name='event_place_voice' value='$event_sms[event_place]'>
	<input type='hidden' name='event_city_voice' value='$event_sms[cityname]'>
	<div style='width: 440px;border-radius: 4px;margin-top: 15px;'>
	<div style='width: 434px;word-wrap: break-word;'><span style='font-size: 15px;color: black;'>Event </span>$event_sms[event_title]</div><div class='clearfix'></div>
	<div style='float:left;'><span style='font-size: 15px;color: black;'>Event Date -</span>$event_sms[event_date_time]</div><div class='clearfix'></div>
	<div style='float:left;'><span style='font-size: 15px;color: black;'>Event Time-</span>$event_sms[event_time]</div><div class='clearfix'></div>
	<div style='float:left;'><span style='font-size: 15px;color: black;'>Venue -</span>$event_sms[event_place] &nbsp;$event_sms[cityname]</div><div class='clearfix'></div>
	
	</div>
	</br>
	<input type='submit' value='SMS ME' name='btn_sms_me' class='btn btn-primary'/>
	</form>
	";
}
}
?>