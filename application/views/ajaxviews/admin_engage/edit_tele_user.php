<link rel="stylesheet" href="<?php echo $base; ?>css/admin/autosuggest.css" type="text/css" media="screen" title="Test Stylesheet" charset="utf-8" />
<script src="<?php echo $base; ?>js/jquery.js" type="text/javascript" charset="utf-8"></script>
 <script src="<?php echo $base; ?>js/admin/fcbkcomplete.js" type="text/javascript" charset="utf-8"></script>    
 
 <div id="edit_data_<?php echo $lead_info['id']; ?>" class="open_box data update_lead_data" style="display:none">
 <div class="open_form_holder">
 <span id="error_message" style="color:red;margin-left: 294px;">  </span>
			<div>
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Full Name: </label>
							<div class="controls-input">
							<input type="text" class="input-large"  name="full_name" id="lead_full_name_<?php echo $lead_info['id']; ?>" value="<?php echo $lead_info['fullname']; ?>">
							</div>
						</div>
				</div>
				<div class="mail_set float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Email: </label>
							<div class="controls-input">
							<input type="text" class="input-large inline" name="email" id="lead_user_email_<?php echo $lead_info['id']; ?>" value="<?php echo $lead_info['email']; ?>">
							<input type="checkbox" class="inline" name="<?php echo $lead_info['id']; ?>" id="check_verify_lead_email_<?php echo $lead_info['id']; ?>" value="verify" onclick="verify_lead(this);" />
							<span class="inline" id="verify_img_email_<?php echo $lead_info['id']; ?>"> <img src="<?php echo base_url(); ?>images/admin/error.gif"/> </span>
							</div>
						</div>
				</div>
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Source: </label>
							<div class="controls-input">
	<input type="hidden" class="input-large" id="lead_source_<?php echo $lead_info['id']; ?>" value="<?php echo $lead_info['lead_source'] ?>"/>
					<?php
					if($lead_info['lead_source']=='site_user'){ 
					$lead_source="Site User"; }
					else if($lead_info['lead_source']=='fb_login'){ $lead_source="FB Login(Site User)"; }
					else if($lead_info['lead_source']=='android_user'){ $lead_source="Mobile App"; }
					else if($lead_info['lead_source']=='event_user'){ $lead_source="Event Registration"; }
					else if($lead_info['lead_source']=='fb_canvas'){ $lead_source="FB Application"; }
					else if($lead_info['lead_source']=='college_request') { $lead_source="Request College"; }
					else{$lead_source="Other";};
					echo $lead_source;
					?>
													</div>
						</div>
				</div>
				<div class="mail_set float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Phone: </label>
							<div class="controls-input">
							<?php if($lead_info['phone_no1']=='0' || $lead_info['phone_no1']==NULL)
						{
						$mobile='';
						}
						else
						{
						$mobile=$lead_info['phone_no1'];
						}?>
							<input type="text" class="input-large inline" name="phone" id="lead_user_phone_<?php echo $lead_info['id']; ?>" value="<?php echo $mobile; ?>">
							<input type="checkbox" name="<?php echo $lead_info['id']; ?>" id="check_verify_lead_phone_<?php echo $lead_info['id']; ?>" value="verify" onclick="verify_lead(this);" />
							<span id="verify_img_phone_<?php echo $lead_info['id']; ?>"> <img src="<?php echo base_url(); ?>images/admin/error.gif"/> </span>
							</div>
						</div>
				</div>
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">DOB: </label>
							<div class="controls-input select_width">
							<?php
					$dob=$lead_info['dob'];
					 if($dob=='' || $dob==NULL || $dob=='0')
					 {
					 $dob='0000-00-00';
					 }
					 $d_of_b=explode("-",$dob);	
					?> 
					<select name="year" id="year_<?php echo $lead_info['id']; ?>" class="margin-delta grid1 <?php //echo $class_year_name; ?>" >
					<option value="0" >Year</option> 
					<?php
					for($count_year=1920;$count_year<=2005;$count_year++)
					{ ?>
					<option  value="<?php echo $count_year; ?>" <?php if($count_year==$d_of_b[0]){ echo "selected"; } ?> ><?php echo $count_year; ?></option>
					<?php } ?>
					</select>
																		
						
					<select name="month"  id="month_<?php echo $lead_info['id']; ?>" class="grid1 margin_l6" >

					<option value="0" >Month</option> 

					<?php
					$arr_month = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'); 
					for($count_month=1;$count_month<=12;$count_month++)
					{
					?>
					<option value="<?php echo $count_month; ?>" <?php if($count_month==$d_of_b[1]){ echo "selected"; } ?>><?php echo $arr_month[$count_month-1]; ?></option>
					<?php } ?>
					</select>
				 
				 <select  name="date" id="date_<?php echo $lead_info['id']; ?>" class="grid1 margin_l6" >

					<option value="0" >Date</option> 
				<?php

				for($count_date=1;$count_date<=31;$count_date++)
				{
				?>
				<option value="<?php echo $count_date; ?>" <?php if($count_date==$d_of_b[2]){ echo "selected"; } ?> ><?php echo $count_date; ?></option>
				<?php } ?>
				</select>
							</div>
						</div>
				</div>
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Country: </label>
							<div class="controls-input select_width">
							<select name="country" id="country_<?php echo $lead_info['id']; ?>" onchange="fetchstates('<?php echo $lead_info['id']; ?>','-1')" class="select_width">
								<option value="">Select country</option>
					<?php	foreach($country_res as $country_result) { 
					$selected='';
					if($country_result['country_id']==$lead_info['home_country_id']) { 
					$selected='selected';
					}
					?>	
					<option value="<?php echo $country_result['country_id']; ?>" <?php echo $selected; ?>><?php echo $country_result['country_name']; ?></option>
					<?php } ?>
							</select>
							</div>
						</div>
						<!--<div class="float_l span3">
								<a rel="modal-profile" href="#" id="add_country" class="tdn">Add New Country</a>
								</div>-->
				</div>
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">State: </label>
							<div class="controls-input select_width">
			<select name="state" id="state_<?php echo $lead_info['id']; ?>" onchange="fetchcities('<?php echo $lead_info['id']; ?>',this.value,'0');" class="select_width">
								<option> Select State </option>	
					
					
					
					</select>
							</div>
							<!--<div class="float_l span3">
										<a id="add_state" href="#" class="tdn">Add New State</a>
										</div>-->
						</div>
				</div><div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">City: </label>
							<div class="controls-input select_width">
							<select name="city" id="city_<?php echo $lead_info['id']; ?>" class="select_width">
								<option value=""> Select City </option>

					
					</select>
							</div>
						</div>
						<!--<div class="float_l span3">
										<a id="add_city" href="#" class="tdn">Add New City</a>
										</div>-->
				</div>
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Enroll K12: </label>
							<div class="controls-input">
							<input type="text" class="input-large" id="lead_tele_enroll_<?php echo $lead_info['id']; ?>">
							</div>
						</div>
				</div>
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Interested Country: </label>
							<div class="controls-input select_width">
							<select id="interested_country_<?php echo $lead_info['id']; ?>" name="interested_country_<?php echo $lead_info['id']; ?>" class="select_width">
					<option value="">Select country</option>
					<?php	foreach($country_res as $interested_country) { 
					?>	
					<option value="<?php echo $interested_country['country_id']; ?>"><?php echo $interested_country['country_name']; ?></option>
					<?php } ?>
				</select>
							</div>
						</div>
				</div>
				
				
				
				
				
				
				
				<!--<div class="control_full float_l">
					<label class="label-control">Interested Courses</label>
					<div class="controls_data">
						<input type="text" class="input_text" id="input01">
					</div>
				</div>-->
			<div class="float_l">
						<div class="control-group">
							<label class="label-control" for="input01"><img src="../images/admin/images/note_icon.png" class="note_img">Note:</label>
							<div class="controls-input">
								<textarea class="input-xlarge text-area" id="notes_<?php echo $lead_info['id']; ?>" rows="4"></textarea>
							</div>
						</div>
					</div>
					<div class="span2 float_l">
						<div class="control-group">
							<button class="btn_img" style="cursor:pointer;" name="<?php echo $lead_info['id']; ?>" id="save_data_<?php echo $lead_info['id']; ?>" value="save" onclick="save_form(this);">Save now</button>
							<button class="btn_img" style="cursor:pointer;" name="cancel" id="cancel_data_<?php echo $lead_info['id']; ?>" value="Cancel" onclick="canceldata('<?php echo $lead_info['id']; ?>')">Cancel</button>
							<div class="float_r margin_t ajax_loading_img_<?php echo $lead_info['id']; ?>" style="display:none;" ><img src="<?php echo $base; ?>images/ajax_loader.gif"></div>
						</div>
					</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
 
 <!-- Form for Add Country, State and City -->	
	
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
							<?php foreach($country_res as $country) { ?>
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
			
			
			
			
			
			
			
			
			
			
			
			
			
			
 
 <script>
 
 var current_lead_id = "<?php echo $lead_info['id']; ?>";
 var home_country = "<?php echo $lead_info['home_country_id']; ?>";
 var selstateid="<?php echo $lead_info['state']; ?>";
 var selcityid="<?php echo $lead_info['city']; ?>";
 
 if(home_country !=''&& home_country!='0' && home_country!=null)
 {
  fetchstates(current_lead_id,selstateid);
 }
 if(selstateid !=''&& selstateid!='0' && selstateid!=null)
 {
  fetchcities(current_lead_id,selstateid,selcityid);
 }
 
 function save_form(control){
 var form_id = control.name;
  //alert($("#lead_full_name_"+current_lead_id).val());		
 var fullname = $('#lead_full_name_'+form_id).val();
 fullname=fullname.trim();
 var email = $('#lead_user_email_'+form_id).val();
 email=email.trim();
 var phone = $('#lead_user_phone_'+form_id).val();
 phone=phone.trim();
 var phone_digit = phone.length;
 var country = $('#country_'+form_id).val();
 var state = $('#state_'+form_id).val();
 var city = $('#city_'+form_id).val();
 var enroll = $('#lead_tele_enroll_'+form_id).val();
 var notes = $('#notes_'+form_id).val();
 notes=notes.trim();
 var year = $('#year_'+form_id).val();
 var month = $('#month_'+form_id).val();
 var date = $('#date_'+form_id).val();
 var interested_cont = $('#interested_country_'+form_id).val();
 var lead_source = $("#lead_source_"+form_id).val();
 if(year==0 || month==0 || date==0)
 {
	if(year==0)
	{
	$("#year_"+form_id).css("border-color","red");
	}
	else
	{
	$("#year_"+form_id).css("border-color","#ccc");
	}
	if(month==0)
	{
	$("#month_"+form_id).css("border-color","red");
	}
	else
	{
	$("#month_"+form_id).css("border-color","#ccc");
	}
	if(date==0)
	{
	$("#date_"+form_id).css("border-color","red");
	}
	else
	{
	$("#date_"+form_id).css("border-color","#ccc");
	}
	if(year==0 && month==0 && date==0)
	{
	$("#year_"+form_id).css("border-color","#ccc");
	$("#month_"+form_id).css("border-color","#ccc");
	$("#date_"+form_id).css("border-color","#ccc");
	}
	
 }
 else
 {
 $("#year_"+form_id).css("border-color","#ccc");
	$("#month_"+form_id).css("border-color","#ccc");
	$("#date_"+form_id).css("border-color","#ccc");
 }
 
 if((phone_digit<10 && phone_digit>0)  || phone_digit>10)
 {
	$("#lead_user_phone_"+form_id).css("border-color","red");
	$('#error_message').html("Phone number should be 10 digit");
	$('#error_message').css("display","block");
 }
 //if($("#check_verify_lead_email_"+form_id).is(':checked') || $("#check_verify_lead_phone_"+form_id).is(':checked'))
else 
{

$('#error_message').html("");
$('#error_message').css("display","none");
var email_stauts='';
$.ajax({
type: "POST",
url: "<?php echo $base; ?>adminleads/check_email_exist",
async: false,
data: 'email='+email+'&phone='+phone,
cache: false,
success: function(msg)
{
email_stauts=msg;
}
});
email_stauts=parseInt(email_stauts);
if(email_stauts) {
alert("For This Email or Phone No. Lead is already verified.");
}
else
{
if($("#check_verify_lead_email_"+form_id).is(':checked') || $("#check_verify_lead_phone_"+form_id).is(':checked'))
{
var lead_verfied=1;
}
else
{
lead_verfied=0;
}
var data={
current_lead_id :current_lead_id,
interested_cont :interested_cont,
fullname: fullname,
email : email,
phone:phone,
country:country,
state:state,
city :city,
enroll:enroll,
notes:notes,
year:year,
month:month,
date:date,
lead_source:lead_source,
lead_verfied:lead_verfied
 };
$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>adminleads/save_verified_leads",
	   async:false,
	   data: data,
	   cache: false,
	   success: function(msg)
	   {
	   if(msg=='0')
	   {
	    $("#lead_fname_"+current_lead_id).html(fullname);
		$("#lead_phone_"+current_lead_id).html(phone);
		$("#lead_email_"+current_lead_id).html(email);
		$("#content_msg").css("display","block");
		$('#content_msg p').html("Student has been verified !!!");
		$("#content_msg").hide(4000);
		
		$('#data_'+current_lead_id).show();	
	   }
	   else
	   {
	    $("#lead_fname_"+current_lead_id).html(fullname);
		$("#lead_phone_"+current_lead_id).html(phone);
		$("#lead_email_"+current_lead_id).html(email);
		if($("#check_verify_lead_email_"+current_lead_id).is(':checked'))
		{
		 $("#span_verified_email_"+current_lead_id+ ' img').attr('src','<?php echo $base; ?>images/admin/success.gif');
		 
		}
		if($("#check_verify_lead_phone_"+current_lead_id).is(':checked'))
		{
		 $("#span_verified_phone_"+current_lead_id+ ' img').attr('src','<?php echo $base; ?>images/admin/success.gif');
		}
		 $("#content_msg").css("display","block");
		 $('#content_msg p').html("Lead Verified successfully");
		 // $("#content_msg").hide(1000);
		
	   }
		 $("#edit_data_"+form_id).hide(1000);
	     $('#edit_data_'+form_id).replaceWith('');
		/*if($("#check_verify_lead_email_"+current_lead_id).is(':checked'))
		{
		$("#span_not_verified_"+current_lead_id).css("color","green");
		$("#span_not_verified_"+current_lead_id).html('Verified');
		}
		if($("#check_verify_lead_phone_"+current_lead_id).is(':checked'))
		{
		$("#span_not_verified_phone_"+current_lead_id).css("color","green");
		$("#span_not_verified_phone_"+current_lead_id).html('Verified');
		}
		
	   $("#edit_data_"+form_id).hide(1000);
	   $('#edit_data_'+form_id).replaceWith('');
	   $('#data_'+form_id).show();
	   
		
		$("#content_verify_message").css("display","none");
		$("#content_msg").css("display","block");*/
		
	   }
});
}
}
 //var interested_country = $('#interested_country').val();
 //alert(interested_country);
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
	
	
	$('#addcountry').click(function(){
	var country=$("#country_model").val();
	var state=$("#state_model").val();
	var city=$("#city_model").val();
	
	var flag=0;
	if(country=='' || country==null)
	{
	 $('#country_error').html("Please enter the country name"); 
	 $('#country_model').addClass('error');
	 flag=0;
	}
	else
	{
	$('#country_error').html("") 
	 $('#country_model').removeClass('error');
	  flag=flag+1;
	}
	if(state=='' || state==null)
	{
	$('#state_error').html("Please enter the state name"); 
	$('#state_model').addClass('error');
	flag=0;
	
	}
	else
	{
	$('#state_error').html(""); 
	$('#state_model').removeClass('error');
	 flag=flag+1;
	}
	if(city=='' || city==null)
	{
	$('#city_error').html("Please enter the city"); 
	$('#city_model').addClass('error');
	flag=0;
	}
	else
	{
	$('#city_error').html(""); 
	$('#city_model').removeClass('error');
	flag=flag+1;
	}
	if(flag==3)
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
	   //alert(msg);
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
	   //alert(msg);
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

function fetchstates(cid,ssid)
{

var scid=$('#country_'+cid+' option:selected').val();
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>admin/state_list_ajax/",
   data: 'country_id='+scid+'&sel_state_id='+ssid,
   cache: false,
   success: function(msg)
   {
    $('#state_'+cid).attr('disabled', false);
	$('#state_'+cid).html(msg);
	$('#city_'+cid).html('<option value="">Select City </option>');
	}
   });
 }



function fetchcities(curcid,state_id,cityid)
{
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>admin/city_list_ajax/",
   data: 'state_id='+state_id+'&sel_city_id='+cityid,
   cache: false,
   success: function(msg)
   {
    $('#city_'+curcid).attr('disabled', false);
	$('#city_'+curcid).html(msg);
   }
   });  
}

$('#addstate').click(function(){
	var country=$("#country_model1 option:selected").val();
	var state=$("#state_model1").val();
	var city=$("#city_model1").val();
	var flag=0;
	if(country=='' || country==null || country=='0')
	{
	 $('#country_error1').html("Please select the country"); 
	 $('#country_model1').addClass('error');
	 flag=0;
	}
	else
	{
	$('#country_error1').html("");
	 $('#country_model1').removeClass('error');
	  flag=flag+1;
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
	  flag=flag+1;
	}
	if(city=='' || city==null)
	{
	$('#city_error1').html("Please enter the city"); 
	$('#city_model1').addClass('error');
	flag=0;
	}
	else
	{
	$('#city_error1').html(""); 
	$('#city_model1').removeClass('error');
	 flag=flag+1;
	}
	if(flag==3)
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
alert('called');
	var country=$("#country_model2 option:selected").val();
	var state=$("#state_model2 option:selected").val();
	var city=$("#city_model2").val();
	var flag=0;
	if(country=='' || country==null || country=='0')
	{
	 $('#country_error2').html("Please select the country"); 
	 $('#country_model2').addClass('error');
	 flag=0;
	}
	else
	{
	$('#country_error2').html("");
	 $('#country_model2').removeClass('error');
	  flag=flag+1;
	}
	if(state=='' || state==null || state=='0')
	{
	$('#state_error2').html("Please select the state "); 
	$('#state_model2').addClass('error');
	flag=0;
	}
	else
	{
	$('#state_error2').html(""); 
	$('#state_model2').removeClass('error');
	 flag=flag+1;
	}
	if(city=='' || city==null)
	{
	$('#city_error2').html("Please enter the city"); 
	$('#city_model2').addClass('error');
	flag=0;
	}
	else
	{
	$('#city_error2').html(""); 
	$('#city_model2').removeClass('error');
	flag=flag+1;
	}
	if(flag==3)
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