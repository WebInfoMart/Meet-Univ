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
	$url = 'leadcontroller/send_sms_of_event';
	echo "
	<form action='$base$url' method='post' id='sms_form'>
	<input type='hidden' name='uname' value='webinfo'/>
	<input type='hidden' name='pass' value='e7w9Y~R9'/>
	<input type='hidden' name='send' value='promot'/>
	Name &nbsp;<input type='text' style='margin-left:25px;' name='fullname' value='$fullname'/></br></br>
	Mobile No &nbsp;<input type='text' name='dest' value='$mobno'/></br>
	<input type='hidden' name='event_title' value='$event_sms[event_title]'>
	<input type='hidden' name='event_date' value='$event_sms[event_date_time]'>
	<input type='hidden' name='event_time' value='$event_sms[event_time]'>
	<input type='hidden' name='event_place' value='$event_sms[event_place]'>
	<input type='hidden' name='event_city' value='$event_sms[cityname]'>
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