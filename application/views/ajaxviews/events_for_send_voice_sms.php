<style>
input {width:200px;}
.submit {width:120px;}

#error {
	color:red;
	font-size:10px;
	display:none;
}
.needsfilled {
	background:whitesmoke;
	color:red;
	border-color:red;
}
</style>
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
	/* event date */ $event_sms['event_date_time'];
	/* exploding event date */ $date = explode(" ",$event_sms['event_date_time']);
	
	//$date_deduct = $date[0];
	
	/* converting month name to number */ $number_month_array = date_parse($date[1]);
	 /* converted month in number */ $month_call = $number_month_array['month'];
	/* concatenate date as Y-m-d */ $now_db_date = $date[2].'-'.$month_call.'-'.$date[0];
	/* getting previous date for call */ $previous_day = date('Y-m-d',strtotime('-1 day',strtotime($now_db_date)));
	/* exploding final call date */ $final_explode_date = explode('-',$previous_day);
	
	/* Date for call */  $date_for_call = $final_explode_date[2];
	/* Year for call */  $year_for_call = $final_explode_date[0];
	/* Month for call */ $month_for_call = $final_explode_date[1];
	//print_r($final_explode_date);
	$url = 'leadcontroller/send_sms_voice_of_event';
	echo "
	<form action='$base$url' method='post' id='sms_form_voice'>
	<input type='hidden' name='uid' value='127'/>
	<input type='hidden' name='pwd' value='restapi1103'/>
	<input type='hidden' name='fid' value='606'/>
	<span>Name</span> <span style='margin-left:5px;'><input type='text' style='margin-left:25px;' name='fullname_voice' id='fullname_voice' value='$fullname'/></span></br></br>
	<span>Mobile No</span> <span style='margin-left:5px;'><input type='text' name='mobno' id='mobno' value='$mobno'/></span></br></br>
	<span>Email</span> <span style='margin-left: 29px;'><input type='text' name='email_voice' id='email_voice' value='$mobno'/></span></br>
	
	<input type='hidden' name='call_date' value='$date_for_call'>
	<input type='hidden' name='call_month' value='$month_for_call'>
	<input type='hidden' name='call_year' value='$year_for_call'>
	
	
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

<script>
$(document).ready(function(){
	// Place ID's of all required fields here.
	required = ["fullname_voice", "email_voice", "mobno"];
	// If using an ID other than #email or #error then replace it here
	email = $("#email_voice");
	//phone = $("#dest");
	errornotice = $("#error");
	//var regEx = /^(\+\d)*\s*(\(\d{3}\)\s*)*\d{3}(-{0,1}|\s{0,1})\d{2}(-{0,1}|\s{0,1})\d{2}$/;
	phone = $("#mobno");
	// The text to show up within a field when it is incorrect
	emptyerror = "Please fill out this field.";
	emailerror = "Please enter a valid e-mail.";
	phoneerror_digit = "Mobile no should be in digit";
	phoneerror_digit_ten = "Please enter in Number & 10 digit";
	$("#sms_form_voice").submit(function(){	
		//Validate required fields
		for (i=0;i<required.length;i++) {
			var input = $('#'+required[i]);
			if ((input.val() == "") || (input.val() == emptyerror)) {
				input.addClass("needsfilled");
				input.val(emptyerror);
				errornotice.fadeIn(750);
			} else {
				input.removeClass("needsfilled");
			}
		}
		// Validate the e-mail.
		if (!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email.val())) {
			email.addClass("needsfilled");
			email.val(emailerror);
		}
		//Validate the Mobile no should be 10 characters long
		if (phone.val().length != 10) {
	   
	  // phone.match(regEx)) {
            phone.addClass("needsfilled");
			phone.val(phoneerror_digit_ten);
        }
		
		// Validate the Mobile no should be digit
       if (!/[0-9]/.test(phone.val())) {
	   
	  // phone.match(regEx)) {
            phone.addClass("needsfilled");
			phone.val(phoneerror_digit);
        }

		//if any inputs on the page have the class 'needsfilled' the form will not submit
		if ($(":input").hasClass("needsfilled")) {
			return false;
		} else {
			errornotice.hide();
			return true;
		}
	});
	
	// Clears any fields in the form when the user clicks on them
	$(":input").focus(function(){		
	   if ($(this).hasClass("needsfilled") ) {
			$(this).val("");
			$(this).removeClass("needsfilled");
	   }
	});
});	
</script>				