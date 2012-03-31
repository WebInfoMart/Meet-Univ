$(document).ready(function()
{
$("#add_user_form").validate.form({
				rules: {
					fullname: "required",		// simple rule, converted to {required:true}
					email: {				// compound rule
						required: true,
						email: true
					},
					password:{
					"required":true,
					"minlength":4
					},
					confirm_password:{
					"required": true,
					"equalTo":"#password"
					}
					
				},
				messages: {
					fullname: "Please enter fullname.",
					email: "plase enter valid Email",
					password:{
					"required":"please enter password",
					"minlength":"your password is not long enough"
					},
					confirm_password:{
					"required":"please enter confirm password",
					"equalTo":"password should be match with confirm password"
				}
				},
			success: function(){
			alert("hii");
             }
})	
			});	
});			