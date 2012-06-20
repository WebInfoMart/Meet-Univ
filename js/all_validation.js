<script>
$(document).ready(function(){
	// Place ID's of all required fields here.
	required = ["pass_login", "email_login"];
	// If using an ID other than #email or #error then replace it here
	email = $("#email_login");
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
	$("#login_form").submit(function(){	
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