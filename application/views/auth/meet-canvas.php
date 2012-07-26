<html>
<head>
<link href="http://www.webdigi.co.uk/css/fb.css" rel="stylesheet" type="text/css" />
<style>
html,body{padding:0px;margin:0px}
.input-xlarge{width:150px;border-radius: 5px;border: 1px solid white;}
.control{margin-bottom:20px;}
.data_label{float:left;width:65px;color:white;font-family:arial;font-weight:bold;}
.control_data{float:left;width:100px}
.clearfix:after {
	content: ".";
	display: block;
	clear: both;
	visibility: hidden;
	line-height: 0;
	height: 0;
}

#error {
	color:red;
	font-size:10px;
	display:none;
}
.needsfilled {
	/*background:#FFFFFF !important;*/
	color:red !important;
	border-color:red !important;
}
</style>
</head>
<body>
<div style="background:url('../images/background.jpg')no-repeat;width:810px;height:100%;" id="info_box_centered_container">
	 <div align="left" class="info_box_middle">
	<div style="background:url('../images/form_bg.png')no-repeat;width:259;height:242px;float:right;margin-right: 40px;margin-top: 115px;s">
		<div style="padding:20px;">
			<span style="font-family:arial;font-weight:bold;color:#f3b700;">REGISTER NOW :</span>
			<div style="background:url('../images/divider.png')no-repeat;width: 228px;height: 7px;margin: 10px 0px;"></div>
			<form action="<?php echo base_url(); ?>user/submit_canvas_datauser/submit_canvas_data" id="ContactForm" name="ContactForm" method="post">
			<div class="control">
				<label class="data_label">Name : </label>
				<div class="control_data">
					<input type="text" class="input-xlarge" id="name" name="name">
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="control">
				<label class="data_label">Mobile : </label>
				<div class="control_data">
					<input type="text" class="input-xlarge" id="phone" name="phone">
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="control">
				<label class="data_label">Email : </label>
				<div class="control_data">
					<input type="text" class="input-xlarge" id="email" name="email">
				</div>
				
			</div>
			<div style="font-family:arial;float:right;background:url('../images/btn.png')no-repeat;width: 45px;padding: 5px 18px;cursor:pointer" id="submit_canvas_data" onclick="submit_form();">Submit</div>
			</form>
		</div>
	</div>
	</div>
</div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script>
/* var name = $('#name').val(); 
var email = $('#email').val();
var phone = $('#telephone').val();
var msg = $('#message').val();
alert(name);
			$.ajax({
				url:"http://meetuniversities.info/user/submit_canvas_data",
				type:"POST",
				async:true,
				cache:true,
				data:"name="+name+"&email="+email+"&phone="+phone+"&msg="+msg,
				success:function(response)
				{
					alert(response);
					alert('data inserted successfully');
				}
			}); */





$("#submit_canvas_data").click(function(){
required = ["name", "email","phone"];
	email = $("#email");
	phone = $("#phone");
	errornotice = $("#error");
	emptyerror = "Please fill out this field.";
	emailerror = "Please enter a valid e-mail.";
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
			
		//if any inputs on the page have the class 'needsfilled' the form will not submit
		if ($(":input").hasClass("needsfilled")) {
			return false;
		} else {
			errornotice.hide();
			document.ContactForm.submit();
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
	
</script>