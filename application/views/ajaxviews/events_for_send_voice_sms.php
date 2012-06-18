<style>
input {width:200px;}
.submit {width:120px;}

#error {
	color:red;
	font-size:10px;
	display:none;
}
.needsfilled {
	background:whitesmoke !important;
	color:red !important;
	border-color:red !important;
}
</style>
<?php
//Global Configuration access
$vsms_config['vsms_uid'] = $this->config->item('vsms_uid');
$vsms_config['vsms_pwd'] = $this->config->item('vsms_pwd');
$vsms_config['vsms_fid'] = $this->config->item('vsms_fid');

$fullname = "";
$mobno= "";
$email = "";
	if(!empty($fetch_profile_user))
	{
	if($fetch_profile_user['fullname'] != '')
	{
		$fullname = $fetch_profile_user['fullname'];
		$fullname_show = $fetch_profile_user['fullname'];
	} else { $fullname='';
	$fullname_show = "User";
	}
	
	if($fetch_profile_user['mob_no'] != '')
	{
		$mobno = $fetch_profile_user['mob_no'];
	} else { $mobno=''; }
	if($fetch_profile_user['email'] != '')
	{
		$email = $fetch_profile_user['email'];
	}
	else{
	$email = "";
	}
	}
if(!empty($event_info_sms))
{
foreach($event_info_sms as $event_sms)
{
	/* Event ID */ $event_id = $event_sms['event_id'];
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
	
	  echo "<h4>Let Aisha remember this for you and personally send you an email to remind about the event
	  </h4></br>";
	  
	echo "
		<div>
	<div class='span4 float_l margin_zero'>

	<form action='$base$url' method='post' id='sms_form_voice' class='form-horizontal'>
	<input type='hidden' name='uid' value='$vsms_config[vsms_uid]'/>
	<input type='hidden' name='pwd' value='$vsms_config[vsms_pwd]'/>
	<input type='hidden' name='fid' value='$vsms_config[vsms_fid]'/>
	
	<div class='control-group'>
         <label class='control-label'>Name</label>
		<div class='controls docs-input-sizes'>
			<input class='span3' type='text' placeholder='Name' name='fullname_voice' id='fullname_voice' value='$fullname'/>
		</div>
	</div>
	<div class='control-group'>
         <label class='control-label'>Mobile No</label>
		<div class='controls docs-input-sizes'>
			<input class='span3' type='text' placeholder='Mobile no.' name='mobno' id='mobno' value='$mobno'/>
		</div>
	</div>
	<div class='control-group'>
         <label class='control-label'>Email</label>
		<div class='controls docs-input-sizes'>
			<input class='span3' type='text' placeholder='Name' name='email_voice' id='email_voice' value='$email'/>
		</div>
	</div>
	<!--<div class='control-group'>
            <label class='control-label'>Event- </label>
			<div class='controls docs-input-sizes'>
				<span class='model_style'>$event_sms[event_title]</span>
			</div>
	</div>
	<div class='control-group'>
            <label class='control-label'>Event Date- </label>
			<div class='controls docs-input-sizes'>
				<span class='model_style'>$event_sms[event_date_time]</span>
			</div>
	</div>
	<div class='control-group'>
            <label class='control-label'>Event Time- </label>
			<div class='controls docs-input-sizes'>
				<span class='model_style'>$event_sms[event_time]</span>
			</div>
	</div>
	<div class='control-group'>
            <label class='control-label'>Venue- </label>
			<div class='controls docs-input-sizes'>
				<span class='model_style'>$event_sms[event_place] &nbsp;$event_sms[cityname]</span>
			</div>
	</div>-->
	<input type='hidden' name='event_id_voice' id='event_id_voice' value='$event_id'/>
	<input type='hidden' name='call_date' value='$date_for_call'>
	<input type='hidden' name='call_month' value='$month_for_call'>
	<input type='hidden' name='call_year' value='$year_for_call'>
	<input type='hidden' name='event_title_voice' value='$event_sms[event_title]'>
	<input type='hidden' name='event_date_voice' value='$event_sms[event_date_time]'>
	<input type='hidden' name='event_time_voice' value='$event_sms[event_time]'>
	<input type='hidden' name='event_place_voice' value='$event_sms[event_place]'>
	<input type='hidden' name='event_city_voice' value='$event_sms[cityname]'>
	<div class='controls docs-input-sizes'>
		<label class='checkbox' id='agree_terms'>
					<input type='checkbox' value='yes' name='agree' id='agree'>
				<span id='agree_terms_span'> I agree to the terms and conditions</span>
		</label>
	</div>
	<div class='controls docs-input-sizes'>
		<input type='submit' value='SMS ME' name='btn_sms_me' class='btn btn-primary'/>
	</div>
</div>
<div class='float_l'>
	<img src='$base/images/grammargirlavatar.jpg' style='width: 120px;height: 130px;'/>
</div>
	</form>
	<div class='clearfix'></div>
	</div>
	";
}
}
?>

<script>
$(document).ready(function(){
	// Place ID's of all required fields here.
	required = ["fullname_voice", "email_voice", "mobno","agree"];
	// If using an ID other than #email or #error then replace it here
	email = $("#email_voice");
	agree_terms = $("#agree_terms");
	agree_terms_span = $("#agree_terms_span");
	check_agree = $("#agree");
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
			
		if(!$('#agree[type="checkbox"]').is(':checked')){
		check_agree.addClass("needsfilled");
		agree_terms.addClass("needsfilled");
		agree_terms_span.addClass("needsfilled");
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