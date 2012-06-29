$(document).ready(function()
{
$('#location_event').click(function()
{
if($(this).is(':checked'))
{
$('.location_hide_show').hide(1000);
/*$("#country_name").attr("disabled", "disabled");
$('#country_name').val('');
$('#country').val('');
$('#state_name').val('');
$('#state').val('');
$('#city_name').val('');
$('#city').val('');
$("#state_name").attr("disabled", "disabled");
$("#city_name").attr("disabled", "disabled");
*/

$('#country_name').removeClass("needsfilled");
$('#country_name_ajax_err').text("");

$('#state_name').removeClass("needsfilled");
$('#state_name_ajax_err').text("");

$('#city_name').removeClass("needsfilled");
$('#city_name_ajax_err').text("");

$('#add_country').hide();
$('#add_state').hide();
$('#add_city').hide();					
}
else
{
$("#country_name").removeAttr("disabled"); 
$('#add_country').show();
$('#add_state').show();
$('#add_city').show();
$('.location_hide_show').show(1000);

}
});
/*$('#add_event_step').click(function()
{
$('.content_event_form1').animate({
left:'-690',
top:'50'
},1000);
$('.content_event_form2').animate({
left:'220',
top:'50'

},1000);
});*/
$('#add_event_step2').click(function()
{
$('.content_event_form1').animate({
left:'200',
top:'50'
},1000);
$('.content_event_form2').animate({
left:'1350',
top:'50'

},1000);
});

//step 1 validation

	$("#add_event_step1").click(function(){
	if($('#location_event').is(':checked'))
	{
	required = ["title_event", "univ_name","event_place"];
	}
	else
	{
	required = ["title_event", "univ_name","country_name","state_name","city_name","event_place"];
	}
	//errornotice = $("#error");
	emptyerror = "Please fill out this field.";
		for (i=0;i<required.length;i++) {
			var input = $('#'+required[i]);
			var inputerr=$('#'+required[i]+'_ajax_err');
			var iperrtext=inputerr.text();
			iperrtext=iperrtext.trim();
			if (input.val() == "" || iperrtext==emptyerror) {
				input.addClass("needsfilled");
				inputerr.text(emptyerror);
				//errornotice.fadeIn(750);
			} else {
				input.removeClass("needsfilled");
				inputerr.text('');
			}
		}
		
		//if any inputs on the page have the class 'needsfilled' the form will not submit
		if (!($(":input").hasClass("needsfilled"))) {
			//errornotice.hide();
			$('.content_event_form1').animate({
			left:'-690',
			top:'50'
			},1000);
			$('.content_event_form2').animate({
			left:'220',
			top:'50'

			},1000);
		}
	}); 
	
//on focus remove the error
 $(":input").focus(function(){		
	   if ($(this).hasClass("needsfilled") ) {
	   var inperrid=$(this).attr("id")+'_ajax_err';
	   	$('#'+inperrid).text('');
			$(this).removeClass("needsfilled");
	   }
	});
	
//check event timing fixed or not fixed
$('#event_timing_fixed_not_fixed').click(function(){
if($(this).is(':checked'))
{
$('.notfixed_event_timing').show(1000);
$('.fix_event_timing').hide(1000);
$('#event_time_end').removeClass("needsfilled");
$('#event_time_start').removeClass("needsfilled");
$('#event_time_end_ajax_err').text("");
$('#event_time_start_ajax_err').text("");
}
else
{
$('.notfixed_event_timing').hide(1000);
$('.fix_event_timing').show(1000);
$('#event_timing').removeClass("needsfilled")
$('#event_timing_ajax_err').text("");

}
});	

//submit event
$('#submit_event').click(function()
{
	if($('#event_timing_fixed_not_fixed').is(':checked'))
	{
	required = ["event_date","event_timing","event_type"];
	}
	else
	{
	required = ["event_date","event_time_start","event_time_end","event_type"];
	}
	//errornotice = $("#error");
	emptyerror = "Please fill out this field.";
		for (i=0;i<required.length;i++) {
			var input = $('#'+required[i]);
			var inputerr=$('#'+required[i]+'_ajax_err');
			var iperrtext=inputerr.text();
			iperrtext=iperrtext.trim();
			if (input.val() == "" || iperrtext==emptyerror) {
				input.addClass("needsfilled");
				inputerr.text(emptyerror);
				//errornotice.fadeIn(750);
			} else {
				input.removeClass("needsfilled");
				inputerr.text('');
			}
		}
		
		//if any inputs on the page have the class 'needsfilled' the form will not submit
		if (!($(":input").hasClass("needsfilled"))) {
		if($('#event_timing_fixed_not_fixed').is(':checked'))
		{
		var event_timing=$('#event_timing').val();
		}
		else
		{
		var event_timing=$('#event_time_start').val()+'-'+$('#event_time_end').val();
		}
		if(!($('#location_event').is(':checked')))
		{
		var country_id=$('#country').val();
		var state_id=$('#state').val();
		var city_id=$('#city').val();
		}
		else
		{
		var country_id=0;
		var state_id=0;
		var city_id=0;
		}
			  var form_data = {
			   title : $('#title_event').val(),
			   university : $('#university').val(),
			   country : country_id,
			   state : state_id,
			   city : city_id,
			   event_place : $('#event_place').val(),
			   event_type : $('#event_type').val(),
			   event_time : $('#event_date').val(),
			   event_timing: event_timing,
			   detail : $('#event_detail').val(),
			   submit:1
			  };
			
			var edit_event=$('#edit_event').val();
			var baseurl=location.hostname;
			if(edit_event=='1')
			{
			var event_id=$('#eventid').val();
			var url=baseurl+'/adminevents/edit_event_ajax/'+event_id;
			eop='eus';
			}
			else
			{	
			var url=baseurl+'/adminevents/create_event_ajax';
			eop='eas';
			}
			//alert()
			$.ajax({
				  type: 'POST',
				  url: 'http://'+url,
				  data:form_data,
				  async:false,
				  success: function(response){
					if(response==0)
					{
					window.location.href="../admin/adminlogin";
					}
					else if(response=='sorry')
					{
					alert("Sorry.You have not permission to acess this");
					}
					else
					{
					rurl='http://'+location.hostname;
					rurl=rurl+"/adminevents/manage_events/"+eop;
					window.location.href=rurl;
					}
				}
			});
		}
});	














});