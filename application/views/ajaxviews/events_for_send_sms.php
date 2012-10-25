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
$email = "";
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
	$url = 'leadcontroller/send_sms_of_event';
	//echo "";
	  echo "<h4>Let Aisha remember this for you and personally </br> send you an SMS to remind about the event
	  </h4></br>";
	echo "
	
	<div>
	<div class='span4 float_l margin_zero'>
	<form action='$base$url' method='post' id='sms_form' class='form-horizontal'>
	<input type='hidden' name='uname' value='$sms_config[tsms_uname]'/>
	<input type='hidden' name='pass' value='$sms_config[tsms_pass]'/>
	<input type='hidden' name='send' value='$sms_config[tsms_send]'/>
	
	<div class='control-group'>
            <label class='control-label'>Name</label>
			<div class='controls docs-input-sizes'>
				<input class='span3' type='text' placeholder='Name' name='fullname' id='fullname' value='$fullname'/>
			</div>
		</div>
		<div class='control-group'>
            <label class='control-label'>Mobile No</label>
			<div class='controls docs-input-sizes'>
				<input class='span3' type='text' placeholder='Mobile No' name='dest' id='dest' value='$mobno'/>
			</div>
		</div>
		<div class='control-group'>
            <label class='control-label'>Email</label>
			<div class='controls docs-input-sizes'>
				<input class='span3' type='text' placeholder='Name' name='email' id='email' value='$email'/>
			</div>
		</div>
	
	<!--<div class='control-group'>
            <label class='control-label'>Event- </label>
			<div class='controls docs-input-sizes'>
				<span class='model_style'>$event_sms[event_title]</span>
			</div>
	</div>
	<div class='control-group'>
            <label class='control-label'>Event Date - </label>
			<div class='controls docs-input-sizes'>
				<span class='model_style'>$event_sms[event_date_time]</span>
			</div>
	</div>
	<div class='control-group'>
            <label class='control-label'>Event Time - </label>
			<div class='controls docs-input-sizes'>
				<span class='model_style'>$event_sms[event_time]</span>
			</div>
	</div>
	<div class='control-group'>
            <label class='control-label'>Venue - </label>
			<div class='controls docs-input-sizes'>
				<span class='model_style'>$event_sms[event_place]</span>
			</div>
	</div>-->
	<div class='controls docs-input-sizes'>
	<label class='checkbox' id='agree_terms'>
                <input type='checkbox' value='yes' name='agree' id='agree'>
            <span id='agree_terms_span'> I agree to the terms and conditions</span>
    </label>
	</div>
	<div class='controls docs-input-sizes'>
	<input type='submit' value='SMS ME !' name='btn_sms_me' id='btn_sms_me' class='btn btn-primary'/>
	</div>
	<span style='margin-left: 29px;'><input type='hidden' name='event_id_sms' id='event_id_sms' value='$event_id'/></span>
	
	<input type='hidden' name='event_univ' value='$event_sms[univ_name]'>
	<input type='hidden' name='event_title' value='$event_sms[event_title]'>
	<input type='hidden' name='event_category' value='$event_sms[event_category]'>
	<input type='hidden' name='event_date' value='$event_sms[event_date_time]'>
	<input type='hidden' name='event_time' value='$event_sms[event_time]'>
	<input type='hidden' name='event_place' value='$event_sms[event_place]'>
	<input type='hidden' name='event_city' value='$event_sms[cityname]'>
	<input type='hidden' name='event_country' value='$event_sms[country_name]'>
	</div>
	<div class='float_r' style='margin-right: 84px;'>
	<img src='$base/images/grammargirlavatar.jpg' style='width: 120px;height: 130px;'/>
	</form>
	</div>
	
	<div class='clearfix'></div>
	</div>
	
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