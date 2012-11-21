<div id="content" class="content_msg" style="display:none;">
<div class="span8 margin_t">
  <div class="message success"><p class="info_message"></p>
</div>
  </div>
  </div>
 <?php 
$class_title=''; 
$class_univ_name='';
$class_country='';
$class_state='';
$class_city='';

$error_title = form_error('title');
$error_univ_name = form_error('university');
$error_country=form_error('country');
$error_state=form_error('state');
$error_city=form_error('city');


if($error_title != '') { $class_title = 'focused_error_univ'; } else { $class_title='text'; }

if($error_univ_name != '') { $class_univ_name = 'focused_error_univ'; } else { $class_univ_name='text'; }
if($error_country != '') { $class_country = 'focused_error_univ'; } else { $class_country='text'; }
if($error_state != '') { $class_state = 'focused_error_univ'; } else { $class_state='text'; }
if($error_city != '') { $class_city = 'focused_error_univ'; } else { $class_city='text'; }

?>
  
 <div id="content" class="movetheform" >
		<h2 class="margin">Create University Events</h2>
		<div class="form span8">
			<form action="<?php echo $base; ?>adminevents/add_more_event" method="post" id="caption_form">
				<ul>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Title</label>
							</div>
							<div class="float_l span3">
								<input type="text" size="30" id="title" class="<?php echo $class_title; ?>" value="<?php echo set_value('title'); ?>" name="title">
									<label class="form_error"  id="title_error_form"></label>
								
							</div>
							
							<div class="clearfix"></div>
						</div>
					</li>
					<?php if($admin_user_level=='5' || $admin_user_level=='4') {?>
					<li>
						<div>
						<div class="float_l span3 margin_zero">
							<label>Choose University</label>
						</div>
						<div class="float_l span3">
							<select class="<?php echo $class_univ_name; ?> styled span3 margin_zero" name="university" id="university">
								<option value="">Please Select</option>
									<?php foreach($univ_info as $univ_detail) { ?>
										<option value="<?php echo $univ_detail->univ_id; ?>" ><?php echo $univ_detail->univ_name; ?></option>
										<?php } ?>
							</select>
							<label class="form_error"  id="university_error_form"></label>
		
						</div>
						<div class="clearfix"></div>
						</div>
					</li>
					<!--<li>
						<div>
						<div class="float_l span3 margin_zero">
							<label>Event Type</label>
						</div>
						<div class="float_l span3">
								<label><input type="radio" class="radio" name="demo" checked="checked" />University Event</label>
								<label><input type="radio" class="radio" name="demo" />Study Abroad Event</label>
				
						</div>
						<div class="clearfix"></div>
						</div>
					</li>
					-->
					<?php } else { ?>
	 				<input type="hidden" id="university" name="university" value="<?php echo $univ_info['univ_id']; ?>">
					<?php }?>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Country</label>
							</div>
							<div class="float_l span3" >
								<select class="<?php echo $class_country; ?> styled span3 margin_zero" name="country" id="country" onchange="fetchstates(0)">
									<option value="">Please Select</option>
									<?php foreach($countries as $country) { ?>
										<option value="<?php echo $country['country_id']; ?>" ><?php echo $country['country_name']; ?></option>
										<?php } ?>
	
								</select>
			<label class="form_error"  id="country_error_form"></label>
		
							
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
							<select class="<?php echo $class_state; ?> styled span3 margin_zero" name="state" onchange="fetchcities(0,0)" id="state" disabled="disabled">
								<option value="">Please Select</option>
							</select>
						<label class="form_error"  id="state_error_form"></label>
		
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
							<select class="<?php echo $class_city; ?> styled span3 margin_zero"  name="city" id="city" disabled="disabled">
								<option value="">Please Select</option>
							</select>
						<label class="form_error"  id="city_error_form"></label>
			
				
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
							<label>Event Place</label>
						</div>
						<div class="float_l span3">
						<input type="text" size="30" class="text" id="event_place" value="<?php echo set_value('event_place'); ?>" name="event_place">	
						
						<label class="form_error"  id="event_place_error_form"></label>
			
						</div>
						</div>
					</li>
					<li>
						<div>
						<div class="float_l span3 margin_zero">
							<label>Event Type</label>
						</div>
						<div class="float_l span3">
							<select class="text styled span3 margin_zero" id="event_type"  name="event_type">
								<option value="all">Select</option>
								<option value="spot_admission">Spot Admission</option>
								<option value="fairs">Fairs</option>
								<option value="alumuni">Counselling-Alumuni</option>
								<option value="others">Counselling-Others</option>
								
							</select>
					<label class="form_error"  id="event_type_error_form"></label>
						
						</div>
						
						<div class="clearfix"></div>
						</div>
					</li>
					
					
					
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Event Date</label>
							</div>
							<div class="float_l span3">
								<input type="text" size="30" id="event_time" class="date_picker" value="<?php echo set_value('event_time'); ?>" name="event_time">
									<label class="form_error"  id="event_time_error_form"></label>
				
		
							</div>
							
							<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Event Time</label>
							</div>
							<div class="float_l span3">
								<input type="text" id="event_timing" class="text" size="30" value="<?php echo set_value('event_timing'); ?>" name="event_timing">
								<label class="form_error"  id="event_timing_error_form"></label>
				
							</div>
							
							<div class="clearfix"></div>
						</div>
					</li>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>Detail</label>
							</div>
							<div class="">
								<textarea rows="12" id="detail"  name="detail" class="wysiwyg" cols="103"><?php echo set_value('detail'); ?></textarea>
								<label class="form_error"  id="detail_error_form"></label>
				
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
				</ul>
						<input type="button" name="submitevent" class="submit" onclick="addmoreevent();" value="Add More Event">
						<input type="submit" name="submit" class="submit" value="Submit">
						
			</form>
		</div>
		
		
	
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

<script>

function addmoreevent()
{
	var title=$("#title").val();
	var university=$("#university").val();
	var country=$("#country").val();
	var state=$("#state").val();
	var city=$("#city").val();
	var event_time=$("#event_time").val();
	var detail=$("#detail").val();
	var event_place=$("#event_place").val();
	var event_timing=$("#event_timing").val();
	var event_type=$('#event_type').val();
	var flag=0;
	if(title=='' || title==null)
	{
	 $('#title_error_form').html("Please enter the Title"); 
	 $('#title').addClass('error');
	 flag=0;
	}
	else
	{
	$('#title_error_form').html("") 
	 $('#title').removeClass('error');
	  flag=flag+1;
	}
	if(university=='' || university==null || university=='0')
	{
	$('#university_error_form').html("Please select the university"); 
	$('#university').addClass('error');
	flag=0;
	}
	else
	{
	$('#university_error_form').html(""); 
	$('#university').removeClass('error');
	 flag=flag+1;
	}
	if(country=='' || country==null)
	{
	$('#country_error_form').html("Please enter the country"); 
	$('#country').addClass('error');
	flag=0;
	}
	else
	{
	$('#country_error_form').html(""); 
	$('#country').removeClass('error');
	flag=flag+1;
	}
	if(state=='' || state==null || state=='0')
	{
	 $('#state_error_form').html("Please enter the state"); 
	 $('#state').addClass('error');
	 flag=0;
	}
	else
	{
	$('#state_error_form').html("") 
	 $('#state').removeClass('error');
	  flag=flag+1;
	}
	if(city=='' || city==null || city=='0')
	{
	$('#city_error_form').html("Please enter the city"); 
	$('#city').addClass('error');
	flag=0;
	}
	else
	{
	$('#city_error_form').html(""); 
	$('#city').removeClass('error');
	 flag=flag+1;
	}
	if(detail=='' || detail==null)
	{
	$('#detail_error_form').html("Please enter the detail"); 
	$('#detail').addClass('error');
	flag=0;
	}
	else
	{
	$('#detail_error_form').html(""); 
	$('#detail').removeClass('error');
	flag=flag+1;
	}
	if(event_time=='' || event_time==null)
	{
	 $('#event_time_error_form').html("Please enter the event time"); 
	 $('#event_time').addClass('error');
	 flag=0;
	}
	else
	{
	 $('#event_time_error_form').html("") ;
	 $('#event_time').removeClass('error');
	  flag=flag+1;
	}
	if(event_place=='' || event_place==null)
	{
	 $('#event_place_error_form').html("Please enter the Event place"); 
	 $('#event_place').addClass('error');
	 flag=0;
	}
	else
	{
	 $('#event_place_error_form').html("") 
	 $('#event_place').removeClass('error');
	  flag=flag+1;
	}
	if(event_timing=='' || event_timing==null )
	{
	$('#event_timing_error_form').html("Please enter the Event time"); 
	$('#event_timing').addClass('error');
	flag=0;
	}
	else
	{
	$('#event_timing_error_form').html(""); 
	$('#event_timing').removeClass('error');
	 flag=flag+1;
	}
	if(flag==9)
	{
	 var  countrystatus=0;
		$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>adminevents/add_more_event_by_ajax",
	   async:false,
	   data: 'title='+title+'&university='+university+'&country='+country+'&state='+state+'&city='+city+'&event_time='+event_time+'&detail='+detail+'&event_place='+event_place+'&event_timing='+event_timing+'&event_type='+event_type+'&add_multiple_event_by_ajax=1',
	   cache: false,
	   success: function(msg)
	   {
	  //$('.movetheform').animate({opacity:0.1}, "slow");
	  $('.movetheform').animate({
		opacity: 0.1,
	  }, 1000, function() {
		 $('#caption_form').reset();
	  });
		$('.movetheform').animate({
		opacity: 1,
	  }, 1000, function() {
	  });
	  $('.info_message').html('Event Added Sucessfully.You can Add more event');
	$('.content_msg').css('display','block');
	  $('html, body').animate({
						scrollTop: 0
					}, 2000);
		}
	});
	   } 
	}

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