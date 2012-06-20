$(document).ready(function(){
	$("#login_form").submit(function(){
required = ["pass_login", "email_login"];
	
	email = $("#email_login");

	errornotice = $("#error");
	
	emptyerror = "Please fill out this field.";
	emailerror = "Please enter a valid e-mail.";	
		//Validate required fields
		for (i=0;i<required.length;i++) {
        
			var input = $('#'+required[i]);
			var txt_change_mode = input.attr('id');
			if ((input.val() == "") || (input.val() == emptyerror)) {
			
			
			if(txt_change_mode == 'pass_login')
			{   
                //input.attr('type','text') ; 
				input.prop('type','text');
				input.addClass("needsfilled");
				input.val(emptyerror);
				//alert(emptyerror);
				errornotice.fadeIn(750);
			}
			else{
				input.addClass("needsfilled");
				input.val(emptyerror);
				errornotice.fadeIn(750);
				}
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



/* For Registration */
	
	$("#signup").submit(function(){
required = ["fullname", "email", "password_register","conf_password_register","agree_term"];
	email = $("#email");
	agree_terms = $("#label_agree");
	check_agree = $("#agree_term");
	errornotice = $("#error");
	emptyerror = "Please fill out this field.";
	emailerror = "Please enter a valid e-mail.";
	phoneerror_digit = "Mobile no should be in digit";
	phoneerror_digit_ten = "Please enter in Number & 10 digit";	
		//Validate required fields
		for (i=0;i<required.length;i++) {
			var input = $('#'+required[i]);
			if ((input.val() == "") || (input.val() == emptyerror)) {
			var change_txt_mode = input.attr('id')
			if(change_txt_mode == 'password_register' || change_txt_mode == 'conf_password_register')
			{
				input.prop('type','text');
				input.addClass("needsfilled");
				input.val(emptyerror);
				errornotice.fadeIn(750);
			}
			else{
				input.addClass("needsfilled");
				input.val(emptyerror);
				errornotice.fadeIn(750);
				}
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
            phone.addClass("needsfilled");
			phone.val(phoneerror_digit_ten);
        } */
		
		// Validate the Mobile no should be digit
       /* if (!/[0-9]/.test(phone.val())) {
	   

            phone.addClass("needsfilled");
			phone.val(phoneerror_digit);
        } */
			
		if(!$('#agree_term[type="checkbox"]').is(':checked')){
		check_agree.addClass("needsfilled");
		agree_terms.addClass("needsfilled");
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
	
	
	/* Validation Code For Event Registration */
	
	$("#frm_Event_Register").submit(function(){
required = ["event_fullname", "event_email", "event_phone"];
	email = $("#event_email");
	//agree_terms = $("#label_agree");
	//check_agree = $("#agree_term");
	errornotice = $("#error");
	emptyerror = "Please fill out this field.";
	emailerror = "Please enter a valid e-mail.";
	phone = $("#event_phone");
	phoneerror_digit = "Mobile no should be in digit";
	phoneerror_digit_ten = "Please enter in Number & 10 digit";	
		//Validate required fields
		for (i=0;i<required.length;i++) {
			var input = $('#'+required[i]);
			if ((input.val() == "") || (input.val() == emptyerror)) {
			//var change_txt_mode = input.attr('id')
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
            phone.addClass("needsfilled");
			phone.val(phoneerror_digit_ten);
        } 
		
		// Validate the Mobile no should be digit
        if (!/[0-9]/.test(phone.val())) {
	   

            phone.addClass("needsfilled");
			phone.val(phoneerror_digit);
        }
			
		/* if(!$('#agree_term[type="checkbox"]').is(':checked')){
		check_agree.addClass("needsfilled");
		agree_terms.addClass("needsfilled");
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
	
	/*  Validation Code For univ_fb_sidebar  */
	
	$("#apply_now").click(function(){
	required = ["apply_name", "apply_email", "apply_mobile"];
	email = $("#apply_email");
	errornotice = $("#error");
	phone = $("#apply_mobile");
	// The text to show up within a field when it is incorrect
	emptyerror = "Please fill out this field.";
	emailerror = "Please enter a valid e-mail.";
	phoneerror_digit = "Mobile no should be in digit";
	phoneerror_digit_ten = "Please enter in Number & 10 digit";
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
	
	/* Validation For Step One */
	$("#frm_step_one").submit(function(){
	required = ["so_first_name", "so_last_name", "so_dob_day", "so_dob_year", "so_phone", "so_email", "so_iagree", "so_country"];
	email = $("#so_email");
	errornotice = $("#error");
	phone = $("#so_phone");
	year = $("#so_dob_year");
	month = $("#so_dob_day");
	
	agree_terms = $("#label_so_iagree");
	check_agree = $("#so_iagree");
	country = $("#so_country");
	// The text to show up within a field when it is incorrect
	emptyerror = "Please fill out this field.";
	emailerror = "Please enter a valid e-mail.";
	phoneerror_digit = "Mobile no should be in digit";
	phoneerror_digit_ten = "Please enter in Number & 10 digit";
	year_digit = "Year should be digit";
	year_digit_four = "should be four digit";
	
	month_digit = "month should be digit";
	month_digit_two = "maximum two digit";
	month_greater_zero = "Invalid Date";
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
		//year match
		if (!/[0-9]/.test(year.val())) {
	   
	  // year.match(regEx)) {
            year.addClass("needsfilled");
			year.val(year_digit);
        }
		
		if (year.val().length != 4) {
	   
	  // year.match(regEx)) {
            year.addClass("needsfilled");
			year.val(year_digit_four);
        }
		
		//month match
		
		if (!/[0-9]/.test(month.val())) {
	   
	  // year.match(regEx)) {
            month.addClass("needsfilled");
			month.val(month_digit);
        }
		
		if (month.val().length >=3) {
	   
	  // year.match(regEx)) {
            month.addClass("needsfilled");
			month.val(month_digit_two);
        }
		
		if (month.val() ==0) {
	   
	  // year.match(regEx)) {
            month.addClass("needsfilled");
			month.val(month_greater_zero);
        }
		if (month.val() ==00) {
	   
	  // year.match(regEx)) {
            month.addClass("needsfilled");
			month.val(month_greater_zero);
        }
		
		
		
		if(!$('#so_iagree[type="checkbox"]').is(':checked')){
		check_agree.addClass("needsfilled");
		agree_terms.addClass("needsfilled");
		//agree_terms_span.addClass("needsfilled");
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

	// Validation Code For Step Two
	
	$("#frm_step_two").submit(function(){
	required = ["interest_study_country", "st_home_address", "state", "city", "st_area_interest", "st_current_educ_level", "st_next_educ_level", "st_academic_exam_score1"];
	//email = $("#apply_email");
	errornotice = $("#error");
	//phone = $("#apply_mobile");
	// The text to show up within a field when it is incorrect
	emptyerror = "Please fill out this field.";
	//emailerror = "Please enter a valid e-mail.";
	//phoneerror_digit = "Mobile no should be in digit";
	//phoneerror_digit_ten = "Please enter in Number & 10 digit";
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
		/* if (!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email.val())) {
			email.addClass("needsfilled");
			email.val(emailerror);
		} */
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
