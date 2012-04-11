<div id="content" class="content_msg" style="display:none;">
<div class="span8 margin_t">
  <div class="message success"><p class="info_message"></p>
</div>
  </div>
  </div>
<?php
$class_univ_name='';
$class_univ_owner='';
$class_sub_domain='';
$error_univ_name = form_error('univ_name');
$error_univ_owner = form_error('univ_owner');
$error_sub_domain = form_error('sub_domain');

if($error_univ_name != '') { $class_univ_name = 'focused_error_univ'; } else { $class_univ_name='text'; }

if($error_univ_owner != '') { $class_univ_owner = 'focused_error_univ'; } else { $class_univ_owner='text'; }
if($error_sub_domain != '') { $class_sub_domain = 'focused_error_univ'; } else { $class_sub_domain='text'; }

foreach($univ_detail_edit as $univ_detail_update)
{
$univ_state_id=$univ_detail_update['state_id'];
$univ_city_id=$univ_detail_update['city_id'];

?>

	<div id="content">
			
		<h2 class="margin">Update University</h2>
		<div class="form span8">
			<form action="" method="post" class="caption_form" enctype="multipart/form-data">
				<ul>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>University Name</label>
							</div>
							
							<div class="float_l span3">
								<input type="text" name="univ_name" size="30" value="<?php echo $univ_detail_update['univ_name']; ?>" class="<?php echo $class_univ_name; ?>">
								<span style="color: red;"> <?php echo form_error('univ_name'); ?><?php echo isset($errors['univ_name'])?$errors['univ_name']:''; ?> </span>
								
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Title</label>
							</div>
							<div class="float_l span3">
								<input type="text" name="title" value="<?php echo $univ_detail_update['title']; ?>" size="30" class="text">
								
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Keyword</label>
							</div>
							<div class="float_l span3">
								<input type="text" name="keyword" value="<?php echo $univ_detail_update['keyword']; ?>" size="30" class="text">
								
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Description</label>
							</div>
							<div class="float_l span3">
								<input type="text" value="<?php echo $univ_detail_update['description']; ?>"  name="description" size="30" class="text">
								
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Latitude</label>
							</div>
							<div class="float_l span3">
								<input type="text" name="latitude" value="<?php echo $univ_detail_update['latitude']; ?>"   size="30" class="text">
								
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Longitude</label>
							</div>
							<div class="float_l span3">
								<input type="text" value="<?php echo $univ_detail_update['longitude']; ?>"  name="longitude" size="30" class="text">
								
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
						<div class="float_l span3 margin_zero">
							<label>University Logo</label>
						</div>
						<div class="float_l span3">
							<div class="float_l">
							
							<img src="<?php echo "$base";  ?>uploads/univ_gallery/<?php if($univ_detail_update['univ_logo_path']==''){ echo "logo.png"; } else { echo $univ_detail_update['univ_logo_path']; } ?>" class="logo_img"></div>
							<div class="float_l span1"><input type="file" name="userfile" class="file"></div>
						</div>
						<div class="clearfix"></div>
						</div>
					</li>
					
						<li>
						<div>
						<div class="float_l span3 margin_zero" >
							<label style="color:#2E64FE">University Owner</label>
						</div>
						<div class="float_l span3" >
						<input type="text" size="30" class="text" readonly name="univ_owner" value="<?php echo ucwords($univ_detail_update['fullname']); ?>" >
							<!--<select class="<?php echo $class_univ_owner; ?> styled span3 margin_zero" name="univ_owner">
								<option value="">Please Select</option>
								<?php foreach($univ_admins as $univ_detail) { ?>
								<option value="<?php echo $univ_detail['id']; ?>"><?php echo ucwords($univ_detail['fullname']); ?></option>
							<?php } ?>
							</select>
							-->
			<input type="hidden" name="user_id" value="<?php echo $univ_detail_update['user_id']; ?>">

							<span style="color: red;"> <?php echo form_error('univ_owner'); ?><?php echo isset($errors['univ_owner'])?$errors['univ_owner']:''; ?> </span>
							
						</div>
						<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
						<div class="float_l span3 margin_zero">
							<label>Address Line1</label>
						</div>
						<div class="float_l span3">
							<input type="text" size="30" class="text" name="address1" value="<?php echo $univ_detail_update['address_line1']; ?>" >
						</div>
						<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
						<div class="float_l span3 margin_zero">
							<label>Address Line2</label>
						</div>
						<div class="float_l span3">
							<input type="text" size="30" class="text" name="address2" value="<?php echo $univ_detail_update['address_line1']; ?>">
						</div>
						<div class="clearfix"></div>
						</div>
					</li>
						<li>
							<div>
								<div class="float_l span3 margin_zero">
									<label>Country</label>
								</div>
								<div class="float_l span3">
									<select class="styled span3 margin_zero" name="country" id="country" onchange="fetchstates(this)">
										<option value="0">Select Country</option>
							<?php foreach($countries as $country) { ?>
										<option value="<?php echo $country['country_id']; ?>" <?php if($country['country_id']==$univ_detail_update['country_id']){?> selected <?php }?> ><?php echo $country['country_name']; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="float_l span3">
								<a rel="modal-profile" href="#" id="add_country" class="tdn">Add New Country</a>
								</div>
								<div class="clearfix"></div>
							</div>
						</li>
									<li>
										<div>
										<div class="float_l span3 margin_zero">
											<label>State</label>
										</div>
										<div class="float_l span3">      
											<select class="styled span3 margin_zero" name="state" onchange="fetchcities(0)" id="state" disabled="disabled">
												<option value="">Please Select</option>
												
											
											</select>
										</div>
										<div class="float_l span3">
										<a id="add_state" href="#" class="tdn">Add New State</a>
										</div>
										<div class="clearfix"></div>
										</div>
									</li>
									<li>
										<div>
										<div class="float_l span3 margin_zero">
											<label>City</label>
										</div>
										<div class="float_l span3">
											<select class="styled span3 margin_zero" name="city" id="city" disabled="disabled">
												<option value="">Please Select</option>
											</select>
										</div>
										<div class="float_l span3">
										<a id="add_city" href="#" class="tdn">Add New City</a>
										</div>
										<div class="clearfix"></div>
										</div>
									</li>
					
				
					<li>
						<div>
						<div class="float_l span3 margin_zero">
							<label>Phone Number</label>
						</div>
						<div class="float_l span3">
							<input type="text" size="30" class="text" value="<?php echo $univ_detail_update['phone_no']; ?>"  name="phone_no">
						</div>
						<div class="clearfix"></div>
						</div>
					</li>
					<!--<li>
						<div>
						<div class="float_l span3 margin_zero">
							<label>Switch Status( On for Ban,Off for Unban)</label>
						</div>
						<div class="float_l span3">
							<div class="onoffswitch">
								<span class="onoff_box checked"><input type="checkbox" id="switch_status"  class="onoffbtn"></span>
								<input type="hidden" name="switch_univ_status" id="switch_univ_status" value="0">
							</div>
						</div>
						<div class="clearfix"></div>
						</div>
					</li>-->
					<li>
						<div>
						<div class="float_l span3 margin_zero">
							<label>University Is Client</label>
						</div>
						<div class="float_l span3">
							<input type="checkbox" id="univ_client" class="checkbox" <?php if($univ_detail_update['univ_is_client']){?> checked <?php } ?> >
							<input type="hidden" name="univ_is_client" id="univ_is_client" value="<?php echo $univ_detail_update['univ_is_client']; ?>">
						<!--	<div class="onoffswitch">
								<span class="onoff_box checked"><input type="checkbox" id="univ_client" class="onoffbtn" ></span>
								<input type="hidden" name="univ_is_client" id="univ_is_client" value="0">
							</div>
						-->	
						</div>
						<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Sub Domain Name</label>
							</div>
							<div class="float_l span3">
								<input type="text" size="30" value="<?php echo $univ_detail_update['subdomain_name']; ?>"   name="sub_domain" class="<?php echo $class_sub_domain; ?>">
								<span style="color: red;"> <?php echo form_error('sub_domain'); ?><?php echo isset($errors['sub_domain'])?$errors['sub_domain']:''; ?> </span>
								<input type="hidden" name="sub_domain_name" value="<?php echo $univ_detail_update['subdomain_name']; ?>">
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Contact Us</label>
							</div>
							<div class="float_l span3">
								<input type="text" size="30" value="<?php echo $univ_detail_update['contact_us']; ?>"  class="text" name="contact_us"  value="<?php echo set_value('contact_us'); ?>">
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Fax Address</label>
							</div>
							<div class="float_l span3">
	<input type="text" size="30"  class="text" name="fax_address"  value="<?php echo $univ_detail_update['univ_fax']; ?>">
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>University Email</label>
							</div>
							<div class="float_l span3">
			<input type="text" size="30"  class="text" name="univ_email" value="<?php echo $univ_detail_update['univ_email']; ?>">
			<span style="color: red;"> <?php echo form_error('univ_email'); ?><?php echo isset($errors['univ_email'])?$errors['univ_email']:''; ?> </span>
							</div>
							<div class="clearfix"></div>
						</div>
					</li> 
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Web Address</label>
							</div>
							<div class="float_l span3">
			<input type="text" size="30" class="text" name="web_address"  value="<?php echo $univ_detail_update['univ_web']; ?>">
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>About Us</label>
							</div>
							<div class="float_l">
								<textarea rows="9" cols="103" name="about_us"><?php echo $univ_detail_update['about_us']; ?>"</textarea>
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
				</ul>
			
						<input type="submit" class="submit" name="submit" value="UPDATE">
						
			</form>
		</div>
	<?php } ?>	
<div class="form span11">
			
			<div class="modal-lightsout" id="add-country">
				<div class="modal-profile" id="add-country1">
					<h2>Add Your Place</h2>
					<a href="#" title="Close profile window" class="modal-close-profile">
					<img src="<?php echo "$base$img_path/$admin"; ?>/close_model.png" class="closeimagesize" alt="Close window"/></a>
					<form action="" method="post" id="form_country" id="add_country_form" >
						<p>
							<label>Country:</label><br>
							<input type="text" size="30" class="text" name="country_model" id="country_model" value=""> 
							<label class="form_error"  id="country_error"></label>
						</p>
						<p>
							<label>State:</label><br>
							<input type="text" size="30" class="text" name="state_model" id="state_model" value=""> 
							<label class="form_error"  id="state_error"></label>
						</p>
						<p>
							<label>City:</label><br>
							<input type="text" size="30" class="text" name="city_model" id="city_model" value=""> 
							<label class="form_error"  id="city_error"></label>
						</p>
						<p>
							<input type="button" class="submit" name="addcountry" id="addcountry" value="Submit">
						</p>
					</form>
				</div>
			</div>
			
			<div class="modal-lightsout" id="add-state">
				<div class="modal-profile" id="add-state1">
					<h2>Add Your Place</h2>
					<a href="#" title="Close profile window" class="modal-close-profile">
					<img src="<?php echo "$base$img_path/$admin"; ?>/close_model.png" class="closeimagesize" alt="Close window"/></a>
						<form action="" method="post" id="form_state" id="add_state_form">
						<p>
							<label>Country:</label><br>
						<select class="text country_select margin_zero" name="country_model1" id="country_model1" >
										<option value="">Select Country</option>
							<?php foreach($countries as $country) { ?>
										<option value="<?php echo $country['country_id']; ?>" ><?php echo $country['country_name']; ?></option>
										<?php } ?>
						</select>
							<label class="form_error"  id="country_error1"></label>
						
						</p>
							
						<p>
							<label>State:</label><br>
							<input type="text" size="30" class="text" name="state_model1" id="state_model1" value=""> 
								<label class="form_error"  id="state_error1"></label>
						
						</p>
						<p>
							<label>City:</label><br>
							<input type="text" size="30" class="text" name="city_model1" id="city_model1" value=""> 
								<label class="form_error"  id="city_error1"></label>
						
						</p>
						<p>
							<input type="button" class="submit" name="addstate" id="addstate" value="Submit">
						</p>
					</form>
					
				</div>
			</div>
			<div class="modal-lightsout" id="add-city">
				<div class="modal-profile" id="add-city1">
					<h2>Add Your Place</h2>
					<a href="#" title="Close profile window" class="modal-close-profile">
					<img src="<?php echo "$base$img_path/$admin"; ?>/close_model.png" class="closeimagesize" alt="Close window"/></a>
					<form action="" method="post" id="add_city_form" >
						<p>
							<label>Country:</label><br>
						<select class="text country_select margin_zero" name="country_model2"  id="country_model2" onchange="fetchstates('-1')">
										<option value="">Select Country</option>
							<?php foreach($countries as $country) { ?>
										<option value="<?php echo $country['country_id']; ?>" ><?php echo $country['country_name']; ?></option>
										<?php } ?>
						</select>
						<label class="form_error"  id="country_error2"></label>
						<div style="color: red;"> <?php echo form_error('country_model2'); ?><?php echo isset($errors['country_model2'])?$errors['country_model2']:''; ?> </div>
						
						</p>
						<p>
							<label>State:</label><br>
							<select class="text country_select margin_zero" name="state_model2"  id="state_model2" disabled="disabled">
							<option value="">Please Select</option>
							</select>
							<label class="form_error"  id="state_error2"></label>
						</p>
						<p>
							<label>City:</label><br>
							<input type="text" size="30" class="text" name="city_model2" id="city_model2"> 
								<label class="form_error"  id="city_error2"></label>
						</p>
						<p>
						<input type="hidden" name="level_user" value="3">
							<input type="button" class="submit" name="addcity" id="addcity" value="Submit">
						</p>
					</form>
					
				</div>
			</div>
			
			
		</div>
		
	</div>	
	
<script> 
$(document).ready(function()
{
fetchstates(<?php echo $univ_state_id; ?>);
fetchcities(<?php echo $univ_state_id; ?>,<?php echo $univ_city_id; ?>);
//fetchcities();
});
$('#univ_client').click(function(){
if($('#univ_client').is(':checked'))
{
$('#univ_is_client').val(1);
}
else
{
$('#univ_is_client').val(0);
}
});
function fetchcountry(cid)
{
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>admin/country_list_ajax",
   data: 'country_id='+cid,
   cache: false,
   async:false,
   success: function(msg)
   {
   // $('#state').attr('disabled', false);
	$('#country').html(msg);
   }
   });
}
function fetchstates(sid)
{
var stid=sid;
var cid;
if(sid=='-1')
{
stid='0';
cid=$("#country_model2 option:selected").val();
}
else
{
var cid=$("#country option:selected").val();
}
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>admin/state_list_ajax/",
   data: 'country_id='+cid+'&sel_state_id='+stid,
   cache: false,
   success: function(msg)
   {
    if(sid=='-1')
	{
	$('#state_model2').attr('disabled', false);
	$('#state_model2').html(msg);
	}
	else
	{
    $('#state').attr('disabled', false);
	$('#state').html(msg);
	}
   }
   });
 } 
function fetchcities(state_id,cityid)
{
if(state_id=='0')
{
state_id=$("#state option:selected").val();
}
 $.ajax({
   type: "POST",
   url: "<?php echo $base; ?>admin/city_list_ajax/",
   data: 'state_id='+state_id+'&sel_city_id='+cityid,
   cache: false,
   success: function(msg)
   {
    $('#city').attr('disabled', false);
	$('#city').html(msg);
   }
   });  
}
//for fancy box
$.fn.center = function () {
        this.css("position","absolute");
        this.css("top","100px");
        this.css("left","330px");
        return this;
      }
 
    $(".modal-profile").center();
	$(".modal-profile1").center();
    $('.modal-lightsout').css("height", jQuery(document).height()); 
 
    $('#add_country').click(function() {
		 $('#add-country').fadeIn("slow");
        $('#add-country1').fadeTo("slow", .9);
    });
	$('#add_state').click(function() {
		//remove city and state form
		 $('#add-state').fadeIn("slow");
        $('#add-state1').fadeTo("slow", .9);
    });
	$('#add_city').click(function() {
		//remove city and state form
		$('#add-city').fadeIn("slow");
        $('#add-city1').fadeTo("slow", .9);
    });
	$('#add_univ_admin').click(function() {
		//remove city and state form
		$('#add-univ').fadeIn("slow");
        $('#add-univ1').fadeTo("slow", .9);
    });
    $('a.modal-close-profile').click(function() {
			//remove country and state form
        $('.modal-profile').fadeOut("slow");
        $('.modal-lightsout').fadeOut("slow");
    });
	$('a.modal-close-profile').click(function() {
			//remove country and state form
        $('.modal-profile1').fadeOut("slow");
        $('.modal-lightsout1').fadeOut("slow");
    });

$('#add_univ_admin_submit').click(function(){
	var fn=$("#add_user_form input[name=fullname]").val();
	var email=$("#add_user_form input[name=email]").val();
	var pwd=$("#add_user_form input[name=password]").val();
	var cpwd=$("#add_user_form input[name=confirm_password]").val();
	var pwdl=pwd.length;
	var flag=0;
	if(fn=='' || fn==null)
	{
	 $('#fullname_error').html("Please enter the full name"); 
	 $('#fullname').addClass('error');
	 flag=1;
	}
	else
	{
	$('#fullname_error').html("") 
	 $('#fullname').removeClass('error');
	  flag=0;
	}
	if(email=='' || email==null ||  (!isValidEmailAddress(email)))
	{
	$('#email_error').html("Please enter valid email address").addClass("error"); 
	$('#email').addClass('error');
	flag=1;
	
	}
	else
	{
	$('#email_error').html(""); 
	$('#email').removeClass('error');
	 flag=0;
	}
	if(pwd=='' || pwd==null)
	{
	$('#pwd_error').html("Please enter the password"); 
	$('#password').addClass('error');
	flag=1;
	}
	else
	{
	if(pwdl<4 && pwdl>0)
	{
	$('#length_pwd_error').html("password length is not enough"); 
	$('#password').addClass('error');
	flag=1;
	}
	else
	{
	$('#length_pwd_error').html(""); 
	$('#password').removeClass('error');
	 flag=0;
	}
	$('#pwd_error').html("");
	}
	if(cpwd=='' || cpwd==null || cpwd!=pwd)
	{
	$('#cpwd_error').html("password and confirm password does not match").addClass("error"); 
	$('#confirm_password').addClass('error');
	flag=1;
	}
	else
	{
	$('#cpwd_error').html(""); 
	$('#confirm_password').removeClass('error');
	 flag=0;
	}
	if(!flag)
	{
	 var  emailstatus=0;
		$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admin/check_unique_field/email/users",
	   async:false,
	   data: 'field='+email,
	   cache: false,
	   success: function(msg)
	   {
	   if(msg=='1')
		{
		$('#email_error').html('E-mail Already Exist');
		$('#email').addClass('error');
		}
		else if(msg=='0')
		{
		$('#email_error').html('');
		$('#email').addClass('');
		emailstatus=1;
		}
	   }
	   });
	 if(emailstatus)
	 {
	 var val='';
	 for(i=2;i<12;i++)
	 {
	 if(i==2||i==3 ||i==4 || i==6 || i==11)
	 {
	 val=val+i+'##'+$('#privilege_total_'+i).val();
	 if(i!=11)
	 val=val+'$$';
	 }
	 } 
	$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admin/add_univ_admin_ajax",
	   async:false,
	   data: 'privilege='+val+'&name='+fn+'&email='+email+'&pwd='+pwd,
	   cache: false,
	   success: function(msg)
	   {
	    $('.modal-profile1').fadeOut("slow");
        $('.modal-lightsout1').fadeOut("slow");
		$('#add_user_form').reset();
		$(':input','#add_user_form').removeAttr('checked');
		$('.reset_priv').val(0);
		$('.onoff_box').removeClass('checked');
		$('.onoff_box').css('background-position-x','0px');
		$('#univ_owner').html(msg);
		$('.info_message').html('University Admin added successfully');
		$('.content_msg').css('display','block');
	   }
	   });
	 } 
	   
	}
	
});


$('#addcountry').click(function(){
	var country=$("#country_model").val();
	var state=$("#state_model").val();
	var city=$("#city_model").val();
	var flag=0;
	if(country=='' || country==null)
	{
	 $('#country_error').html("Please enter the country name"); 
	 $('#country_model').addClass('error');
	 flag=1;
	}
	else
	{
	$('#country_error').html("") 
	 $('#country_model').removeClass('error');
	  flag=0;
	}
	if(state=='' || state==null)
	{
	$('#state_error').html("Please enter the state name"); 
	$('#state_model').addClass('error');
	flag=1;
	
	}
	else
	{
	$('#state_error').html(""); 
	$('#state_model').removeClass('error');
	 flag=0;
	}
	if(city=='' || city==null)
	{
	$('#city_error').html("Please enter the city"); 
	$('#city_model').addClass('error');
	flag=1;
	}
	else
	{
	$('#city_error').html(""); 
	$('#city_model').removeClass('error');
	flag=0;
	}
	if(!flag)
	{
	 var  countrystatus=0;
		$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admin/check_unique_field/country_name/country",
	   async:false,
	   data: 'field='+country,
	   cache: false,
	   success: function(msg)
	   {
	   if(msg=='1')
		{
		$('#country_error').html('Country Already Exist');
		$('#country_model').addClass('error');
		}
		else if(msg=='0')
		{
		$('#country_model').html('');
		$('#country_error').addClass('');
		countrystatus=1;
		}
	   }
	   });
	 if(countrystatus)
	 {
	$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admin/add_country_ajax",
	   async:false,
	   data: 'country_model='+country+'&state_model='+state+'&city_model='+city,
	   cache: false,
	   success: function(msg)
	   {
	    var place=msg.split('##');
		fetchcountry(place[0]);
		fetchstates(place[1]);
		fetchcities(place[1],place[2]);
		$('.modal-profile').fadeOut("slow");
        $('.modal-lightsout').fadeOut("slow");
		$('#add_country_form').reset();
		$('.info_message').html('Your Place Added Successfully');
		$('.content_msg').css('display','block');
	   }
	   });
	 } 
	   
	}
	
});






$('#addstate').click(function(){
	var country=$("#country_model1 option:selected").val();
	var state=$("#state_model1").val();
	var city=$("#city_model1").val();
	var flag=0;
	if(country=='' || country==null || country=='0')
	{
	 $('#country_error1').html("Please select the country"); 
	 $('#country_model1').addClass('error');
	 flag=1;
	}
	else
	{
	$('#country_error1').html("");
	 $('#country_model1').removeClass('error');
	  flag=0;
	}
	if(state=='' || state==null)
	{
	$('#state_error1').html("Please enter the state name"); 
	$('#state_model1').addClass('error');
	flag=1;
	
	}
	else
	{
	$('#state_error1').html(""); 
	$('#state_model1').removeClass('error');
	 flag=0;
	}
	if(city=='' || city==null)
	{
	$('#city_error1').html("Please enter the city"); 
	$('#city_model1').addClass('error');
	flag=1;
	}
	else
	{
	$('#city_error1').html(""); 
	$('#city_model1').removeClass('error');
	flag=0;
	}
	if(!flag)
	{
	 var  statestatus=0;
		$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admin/state_check",
	   async:false,
	   data: 'state_model1='+state+'&country_model1='+country,
	   cache: false,
	   success: function(msg)
	   {
	    if(msg=='1')
		{
		$('#state_error1').html('State Already Exist in Selected Country');
		$('#state_model1').addClass('error');
		}
		else if(msg=='0')
		{
		$('#state_error1').html('');
		$('#state_model1').addClass('');
		statestatus=1;
		}
	   }
	   });
	 if(statestatus)
	 {
	 $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admin/add_state_ajax",
	   async:false,
	   data: 'country_model1='+country+'&state_model1='+state+'&city_model1='+city,
	   cache: false,
	   success: function(msg)
	   {
	    var place=msg.split('##');
		fetchcountry(place[0]);
		fetchstates(place[1]);
		fetchcities(place[1],place[2]);
		$('.modal-profile').fadeOut("slow");
        $('.modal-lightsout').fadeOut("slow");
		$('#add_state_form').reset();
		$('.info_message').html('Your Place Added Successfully');
		$('.content_msg').css('display','block');
	   }
	   });
	 } 
	   
	}
	
});




$('#addcity').click(function(){
	var country=$("#country_model2 option:selected").val();
	var state=$("#state_model2 option:selected").val();
	var city=$("#city_model2").val();
	var flag=0;
	if(country=='' || country==null || country=='0')
	{
	 $('#country_error2').html("Please select the country"); 
	 $('#country_model2').addClass('error');
	 flag=1;
	}
	else
	{
	$('#country_error2').html("");
	 $('#country_model2').removeClass('error');
	  flag=0;
	}
	if(state=='' || state==null || state=='0')
	{
	$('#state_error2').html("Please select the state "); 
	$('#state_model2').addClass('error');
	flag=1;
	}
	else
	{
	$('#state_error2').html(""); 
	$('#state_model2').removeClass('error');
	 flag=0;
	}
	if(city=='' || city==null)
	{
	$('#city_error2').html("Please enter the city"); 
	$('#city_model2').addClass('error');
	flag=1;
	}
	else
	{
	$('#city_error2').html(""); 
	$('#city_model2').removeClass('error');
	flag=0;
	}
	if(!flag)
	{
	 var  citystatus=0;
		$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admin/city_check",
	   async:false,
	   data: 'state_model2='+state+'&country_model2='+country+'&city_model2='+city,
	   cache: false,
	   success: function(msg)
	   {
	    if(msg=='1')
		{
		$('#city_error2').html('CIty Already Exist in Selected State');
		$('#city_model2').addClass('error');
		}
		else if(msg=='0')
		{
		$('#city_error2').html('');
		$('#city_model2').addClass('');
		citystatus=1;
		}
	   }
	   });
	 if(citystatus)
	 {
	 $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admin/add_city_ajax",
	   async:false,
	   data: 'country_model2='+country+'&state_model2='+state+'&city_model2='+city,
	   cache: false,
	   success: function(msg)
	   {
	    var place=msg.split('##');
		fetchcountry(place[0]);
		fetchstates(place[1]);
		fetchcities(place[1],place[2]);
		$('.modal-profile').fadeOut("slow");
        $('.modal-lightsout').fadeOut("slow");
		$('#add_city_form').reset();
		$('.info_message').html('Your Place Added Successfully');
		$('.content_msg').css('display','block');
	   }
	   });
	 } 
	   
	}
	
});	
	
</script>	