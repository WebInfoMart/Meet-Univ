<link rel="stylesheet" href="<?php echo $base; ?>css/admin/autocomplete.css" type="text/css" media="screen"  charset="utf-8" />
<link rel="stylesheet" href="<?php echo $base; ?>css/admin/jquery-ui-1.8.custom.css" type="text/css" media="screen"  charset="utf-8" />

<script src="<?php echo $base; ?>js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $base; ?>js/jquery-ui-custom-autosuggest.js" type="text/javascript" charset="utf-8"></script>    
 
 <div id="edit_data" class="open_box data update_lead_data" style="position: absolute;left: 393px;top: 89px;">
  <div class="open_form_holder">
  <span id="error_message" style="color:red;margin-left: 294px;">  </span>
			<div>
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Full Name: </label>
							<div class="controls-input">
							<input type="text" class="input-large"  name="full_name" id="lead_full_name" value="">
							</div>
					</div>
				</div>
				<div class="mail_set float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Email: </label>
							<div class="controls-input">
							<input type="text" class="input-large inline" name="email" id="lead_user_email" value="">
							<input type="hidden" class="input-large" id="lead_source" value="offline"/>
					
							</div>
						</div>
				</div>
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">DOB: </label>
							<div class="controls-input select_width">
						
					<select name="year" id="year" class="margin-delta grid1 " >
					<option value="0" >Year</option> 
					<?php
					for($count_year=1920;$count_year<=2005;$count_year++)
					{ ?>
					<option  value="<?php echo $count_year; ?>"><?php echo $count_year; ?></option>
					<?php } ?>
					</select>
																		
						
					<select name="month"  id="month" class="grid1 margin_l6" >

					<option value="0" >Month</option> 

					<?php
					$arr_month = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'); 
					for($count_month=1;$count_month<=12;$count_month++)
					{
					?>
					<option value="<?php echo $count_month; ?>"><?php echo $arr_month[$count_month-1]; ?></option>
					<?php } ?>
					</select>
				 
				 <select  name="date" id="date" class="grid1 margin_l6" >

					<option value="0" >Date</option> 
				<?php

				for($count_date=1;$count_date<=31;$count_date++)
				{
				?>
				<option value="<?php echo $count_date; ?>" ><?php echo $count_date; ?></option>
				<?php } ?>
				</select>
							</div>
						</div>
				</div>
				<div class="mail_set float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Phone: </label>
							<div class="controls-input">						
							<input type="text" class="input-large inline" name="phone" id="lead_user_phone" value="">
							
							</div>
						</div>
				</div>
				
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Country: </label>
							<div class="controls-input select_width">
							<select name="country" id="country" class="select_width" onchange="fetchstates('0','-1')">
								<option value="">Select country</option>
					<?php
					foreach($country_res as $country_result) 
					{ 					
					?>	
					<option value="<?php echo $country_result['country_id']; ?>" ><?php echo $country_result['country_name']; ?></option>
					<?php } ?>
							</select>
							</div>
						</div>
						
				</div>
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">State: </label>
							<div class="controls-input select_width">
					<select name="state" id="state" class="select_width" onchange="fetchcities(this.value);">
								<option value=''> Select State </option>	
						<?php
					$state_list=$this->lead_tele_model->fetch_states_by_country_ajax($lead_info['home_country_id']);
					if($state_list!='0')
					{ 
					foreach($state_list as $state_list_ajax){
					
					?>	
					<option value="<?php echo $city_list_ajax['city_id']; ?>"  ><?php echo $city_list_ajax['cityname']; ?></option>
					<?php
					}
					}
					?>
					
					</select>
							</div>
							
						</div>
				</div><div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">City: </label>
							<div class="controls-input select_width">
							<select name="city" id="city" class="select_width">
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
			<input type="text" class="input-large" id="lead_tele_enroll" value="">
							</div>
						</div>
				</div>
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Interested Country: </label>
							
							<div id="intrested_countries" class="ui-helper-clearfix">
							<input id="auto_intrested_countries" type="text">
							</div>
						</div>
				</div>
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Lead Status</label>
							<div class="controls-input">
							<select id="lead_status" name="lead_status" class="select_width">
							<option value="0">--Please Select--</option>
						<option value="Valid" >Valid</option>
						<optgroup label="Invalid Reason">
						<option value="None Given">None Given</option>
						<option value="Poor Candidate Data" >Poor Candidate Data</option>
						<option value="Incorrect Academic Level" >Incorrect Academic Level</option>
						<option value="Program/School Fit" >Program/School Fit</option>
						<option value="No Reply">No Reply</option>
						<option value="Spammers/Agents">Spammers/Agents</option>
						<option value="Invalid Contact Details">Invalid Contact Details</option>
						<option value="Looking For Different Country" >Looking For Different Country</option>
						<option value="Fail to meet filters" >Fail to meet filters</option>
						<option value="Duplicate" >Duplicate</option>
						<option value="Incomplete">Incomplete</option>
						<option value="Cap met" >Cap met</option>
						<option value="Velocity limit met" >Velocity limit met</option>
						<option value="Because of year" >Because of year</option>
						<option value="Unable to Establish Contact- 3 Attempts">Unable to Establish Contact- 3 Attempts</option>
						<option value="Incorrect/Wrong Number" >Incorrect/Wrong Number</option>
						<option value="Hasn't Decided yet" >Hasn't Decided yet</option>
						<option value="Looking for Different Course" >Looking for Different Course</option>
						<option value="Not Looking for further studies" >Not Looking for further studies</option>
						<option value="Due to Location of the colllege" >Due to Location of the colllege</option>
						<option value="Looking for Part-time Course" >Looking for Part-time Course</option>
						<option value="Poor Lead Quality" >Poor Lead Quality</option>
						<option value="Looking for Lateral entry" >Looking for Lateral entry</option>
						<option value="Already applied/Enrolled" >Already applied/Enrolled</option>
						<option value="Language Problem" >Language Problem</option>
						<option value="Just Browsing/Looking for information only" >Just Browsing/Looking for information only</option>
						<option value="Looking for Different college" >Looking for Different college</option>						
						</optgroup>
							</select>
							</div>
					</div>
				</div>
				
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Next Action</label>
							<div class="controls-input select_width">
							<select id="next_action" name="next_action" class="select_width">
							<option value="none">select</option>
							<option value="counsellor" >Counsellor</option>
							<option value="paused" >Paused</option>
							<option value="hot" >Hot</option>
							</select>
							</div>
					</div>
				</div>
				<div class="span15 float_l">
					<div class="control-group">
							<label class="label-control" for="input01">Add As Site User</label>
							<div class="controls-input select_width">
							<input type="checkbox" name="lead_as_site_user" id="lead_as_site_user">
							</div>
					</div>
				</div>
				
			<div class="float_l">
						<div class="control-group" >
							<label class="label-control" for="input01"><img src="../images/admin/images/note_icon.png" style="left: 69px;" class="note_img">Note:</label>
							<div class="controls-input">													
							<textarea  class="input-xlarge" id="notes" rows="4"></textarea>											
							</div>
						</div>
					</div>
					<div class="span2 float_l">
						<div class="control-group">
							<button class="btn_img" style="cursor:pointer;" name="save" id="save_data" value="save" onclick="save_lead_form(this);">Save now</button>
							<button class="btn_img" style="cursor:pointer;" name="cancel" id="cancel_data" value="Cancel" onclick="cancel()">Cancel</button>
							<div class="float_r margin_t ajax_loading_img" style="display:none;" ><img src="<?php echo $base; ?>images/ajax_loader.gif"></div>
						</div>
					</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
 				
			
			
 
 <script>
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
 $(function(){
				var suggest_country_ids = new Array();
				//attach autocomplete
				$("#auto_intrested_countries").autocomplete({
					
					//define callback to format results
					source: function(req, add){
						var c_id_list=0;
						$("input[name^=country_ids]").each(function() {
						var val=$(this).val();
						val=val.trim();
						c_id_list=c_id_list+','+val;
					});
						//pass request to server
						$.getJSON("<?php echo $base; ?>adminleads/get_country_list/"+c_id_list+"?callback=?", req, function(data) {
							
							//create array for response objects
							var suggestions = [];
							
							//process response
							$.each(data, function(i, val){	
								suggestions.push(val.name);
								suggest_country_ids[val.name]=val.id;
							});
							
							//pass array to callback
							add(suggestions);
						});
					},
					
					//define select handler
					select: function(e, ui) {
						//create formatted friend
						var country_name = ui.item.value;
						var country_id=suggest_country_ids[country_name];
						var exist_int_c_list=$('#intrested_country_list').val();
						
							var span = $("<span id='remove_country_"+country_id+"' onclick='removecountry("+country_id+")'>").text(country_name);
							var a = $("<a>").addClass("remove").attr({
								href: "javascript:",
								title: "Remove " + country_name,
								id: country_id
							}).text("x");
							var h= $('<input/>',{type:'hidden',name:'country_ids[]',id:'country_'+country_id,value:country_id});
							
							//var h='<input type="hidden" name="country_ids" id="country" value="">';	
							a.appendTo(span);
						  h.appendTo(span);
						//add friend to friend div
//auto_intrested_countries').val('');
						span.insertBefore("#auto_intrested_countries");
						
						//alert("hi");
					},
					
					//define select handler
					change: function() {
						
						//prevent 'to' field being updated and correct position
						$("#auto_intrested_countries").val("").css("top", 2);
					}
				});
				
				//add click handler to friends div
				$("#intrested_countries").click(function(){
					
					//focus 'to' field
					$("#auto_intrested_countries").focus();
				});
				
				//add live handler for clicks on remove links
							
			});
			function removecountry(id){
					$('#remove_country_'+id).replaceWith('');
					//$(this).parent().remove();
					//correct 'to' field position
					if($("#intrested_countries span").length === 0) {
					$("#auto_intrested_countries").css("top", 0);
					}				
				}
			
 </script>	
