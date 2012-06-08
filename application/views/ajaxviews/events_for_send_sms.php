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
$sms_config['tsms_uname'] = $this->config->item('tsms_uname');
$sms_config['tsms_pass'] = $this->config->item('tsms_pass');
$sms_config['tsms_send'] = $this->config->item('tsms_send');
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
	/* Event ID */ $event_id = $event_sms['event_id'];
	$url = 'leadcontroller/send_sms_of_event';
	echo "<div style='float:left;'>";
	  echo "<h4>Let Aisha remember this for you and personally send you an email to remind about the event
	  </h4></br>";
	echo "
	<form action='$base$url' method='post' id='sms_form' style='height:350px;'>
	<div style='float:left;'>
	<input type='hidden' name='uname' value='$sms_config[tsms_uname]'/>
	<input type='hidden' name='pass' value='$sms_config[tsms_pass]'/>
	<input type='hidden' name='send' value='$sms_config[tsms_send]'/>
	<div style='float:left'>
	<span>Name</span> <span style='margin-left: 5px;'><input type='text' style='margin-left:25px;' name='fullname' id='fullname' value='$fullname'/></span></br></br>
	<span>Mobile No</span> <span style='margin-left: 5px;'><input type='text' name='dest' id='dest' value='$mobno'/></span></br></br>
	<span>Email</span> <span style='margin-left: 29px;'><input type='text' name='email' id='email' value='$mobno'/></span></br>
	<span style='margin-left: 29px;'><input type='hidden' name='event_id_sms' id='event_id_sms' value='$event_id'/></span>
	</div>
	<div style='float:right;'>
	<img src='$base/images/grammargirlavatar.jpg' style='width: 159px;height: 161px;'/>
	<div class='clearfix'></div><div class='clearfix'></div></br></br>
	</div>
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
	<div id='agree_terms' style='float:left;'><span><input type='checkbox' value='yes' name='agree' id='agree'/></span>
	<span id='agree_terms_span' style='font-size: 15px;color: black;margin-left:5px;'>I agree to the terms and conditions</span></div>
	</div>
	</br>
	<input type='submit' value='SMS ME' name='btn_sms_me' id='btn_sms_me' class='btn btn-primary'/>
	</div>
	</form>
	";
}
}
?>
<script>
$(document).ready(function(){
	// Place ID's of all required fields here.
	required = ["fullname", "email", "dest","agree"];
	// If using an ID other than #email or #error then replace it here
	email = $("#email");
	agree_terms = $("#agree_terms");
	agree_terms_span = $("#agree_terms_span");
	//phone = $("#dest");
	errornotice = $("#error");
	//var regEx = /^(\+\d)*\s*(\(\d{3}\)\s*)*\d{3}(-{0,1}|\s{0,1})\d{2}(-{0,1}|\s{0,1})\d{2}$/;
	phone = $("#dest");
	check_agree = $("#agree");
	// The text to show up within a field when it is incorrect
	emptyerror = "Please fill out this field.";
	emailerror = "Please enter a valid e-mail.";
	phoneerror_digit = "Mobile no should be in digit";
	phoneerror_digit_ten = "Please enter in Number & 10 digit";
	$("#sms_form").submit(function(){	
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