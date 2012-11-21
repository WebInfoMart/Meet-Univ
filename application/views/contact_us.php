<?php if($this->session->flashdata('contact_suc')) 
{
?>
<script>
$(document).ready(function(){
	$('#show_success').css('display','block');
	$('#show_success').hide();
	$('#show_success').show("show");
	$("#show_success").delay(3000).fadeOut(200);
	});
</script>
<?php } ?>
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
<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row margin_t1"> 
				<div class="modal" id="show_success" style="display:none;" >
					  <div class="modal-header">
						<a class="close" data-dismiss="modal"></a>
						<h3>Message From MeetUniversities</h3>
					  </div>
					  <div class="modal-body">
						<p><center><h4>Thank You...We Will Contact You Very Soon!!!</h4></center></p>
					  </div>
					  <div class="modal-footer">
						<!--<a href="#" class="btn">Close</a>-->
						<!--<a href="#" class="btn btn-primary">Save changes</a>-->
					  </div>
				</div>
				<div class="span13 about_back">
					<div class="padding">
					<h2>Contact Us</h2>
					</div>
					<div class="span8">
					<!--  Controller:auth, and function:contact_us.  -->
						<form class="form-horizontal" action="" method="post" id="contact_form">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="contact_name">Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" id="contact_name" name="contact_name">
							  </div>
							</div>
						  </fieldset>
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="contact_email">Email</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" id="contact_email" name="contact_email">
							  </div>
							</div>
						  </fieldset>
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="contact_phone">Phone</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" id="contact_phone" name="contact_phone">
							  </div>
							</div>
						  </fieldset>
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="contact_organization">Organization</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" id="contact_organization" name="contact_organization">
							  </div>
							</div>
						  </fieldset>
						  <fieldset>
							<div class="control-group">
								<label class="control-label" for="contact_message">Message</label>
								<div class="controls">
								  <textarea class="input-xlarge" id="contact_message" name="contact_message" rows="3"></textarea>
								</div>
							</div>						  
						</fieldset>
						<fieldset>
							<div class="control-group">
								<label class="control-label"></label>
								<div class="controls">
									<input type="submit" class="btn btn-primary" id="contact_submit" name="contact_submit" value="Submit">
								</div>
							</div>
						</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<style>
#tube{ width:200px; height:50px; float:left;background:#FFFFFF;width:200px;}
	#tube2{ width:200px; height:50px; float:left;background:#FFFFFF;width:200px;}

</style>	
<script>
$(document).ready(function(){
	// Place ID's of all required fields here.
	required = ["contact_name", "contact_email"];
	// If using an ID other than #email or #error then replace it here
	email = $("#contact_email");
	//agree_terms = $("#agree_terms");
	//agree_terms_span = $("#agree_terms_span");
	//phone = $("#dest");
	errornotice = $("#error");
	//var regEx = /^(\+\d)*\s*(\(\d{3}\)\s*)*\d{3}(-{0,1}|\s{0,1})\d{2}(-{0,1}|\s{0,1})\d{2}$/;
	//phone = $("#dest");
	//check_agree = $("#agree");
	// The text to show up within a field when it is incorrect
	emptyerror = "Please fill out this field.";
	emailerror = "Please enter a valid e-mail.";
	//phoneerror_digit = "Mobile no should be in digit";
	//phoneerror_digit_ten = "Please enter in Number & 10 digit";
	$("#contact_form").submit(function(){	
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
		/* if (phone.val().length != 10) {
	   
	  // phone.match(regEx)) {
            phone.addClass("needsfilled");
			phone.val(phoneerror_digit_ten);
        } */
		
		// Validate the Mobile no should be digit
       /* if (!/[0-9]/.test(phone.val())) {
	   
	  // phone.match(regEx)) {
            phone.addClass("needsfilled");
			phone.val(phoneerror_digit);
        } */
		 
		/* if(!$('#agree[type="checkbox"]').is(':checked')){
		check_agree.addClass("needsfilled");
		agree_terms.addClass("needsfilled");
		agree_terms_span.addClass("needsfilled");
		} */

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