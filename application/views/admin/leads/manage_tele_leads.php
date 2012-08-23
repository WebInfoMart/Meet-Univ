<style>
#content_msg {
	overflow: hidden;
	padding: 0 20px;
	left: 220px;
	width: 40%;
	position:absolute;
	}
#content_verify_message {
	overflow: hidden;
	padding: 0 20px;
	left: 220px;
	width: 82%;
	}
#content_drop_msg {
	overflow: hidden;
	padding: 0 20px;
	left: 220px;
	width: 35%;
	position:absolute;
	}		
.message.info {
	border: 1px solid #bbdbe0;
	background: #ecf9ff url(../../images/admin/info.gif) 12px 12px no-repeat;
	color: #0888c3;
	}
	
	.message {
	padding: 10px 15px 10px 40px;
	margin-bottom: 15px;
	font-weight: bold;
	overflow: hidden;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	}
	
</style>
<div id="content_msg" class="content_msg" style="display:none;">
<div class="message info"><p></p></div> 
</div>
<div id="content_drop_msg" style="display:none;">
<div class="message info"><p>Record dropped !!!</p></div> 
</div>
	
<div id="content" style="margin-left: 200px;">
		
			
			<!-- .breadcrumb ends -->
	<div class="margin-delta margin_t" style="width: 945px;">
		<div>
			<div class="grid1 float_l">
				<b>Sr.no</b>
			</div>
			<div class="span1 float_l">
				<b class="blue">FullName</b>
			</div>
			<div class="width_adjust float_l">
				<b class="green">Email Verfied</b>
			</div>
			<div class="span1 float_l">
				<b class="blue">Source</b>
			</div>
			<div class="span1 float_l">
				<b class="green">Phone Verified</b>
			</div>
			<div class="span0 float_l">
				<input id="adduser" type="button" style="cursor:pointer;" value="Add New Lead" onclick="add_user_lead()" class="edit inline">
               <div class="inline margin_l1" id="add_user_lead_loading_img" style="display:none;"><img src="<?php echo $base ;?>images/ajax_loader.gif"></div>				
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="dotted_line"></div>
		<?php if($teleleads!='0') { ?>
		<div id="content_data">
		<?php 
	$sno=1;
	$cnt_rows_verify_table = 0;
	foreach($teleleads as $teleleadsres) {
	if($sno % 2) {
        $class = 'back_diff';
    } else {
	$class = '';
    }
	$record_verified_true = 0;
	$temp_var_for_verify_email_phone = 0;
	?>	
		<div id="data_data_<?php echo $teleleadsres['id']; ?>" class="<?php echo $class; ?> old_data old_data_paging" style="border-bottom: 1px solid #CCC;-webkit-border-bottom: 1px solid #CCC;-moz-border-bottom: 1px solid #CCC;padding: 3px 0px;">
			<div class="grid1 float_l">
					<?php echo $sno++ ;?>
			</div>
			<div class="span1 float_l" id="lead_fname_<?php echo $teleleadsres['id']; ?>">
				<?php echo $teleleadsres['fullname']; ?>
			</div>
			<div class="width_adjust float_l" >
			<?php if($teleleadsres['email_verified']) {
?>
<span class="float_l data_img" id="span_verified_email_<?php echo $teleleadsres['id']; ?>" >
<img src="<?php echo base_url(); ?>images/admin/success.gif"/>
</span>
<?php } else { ?>

<span class="float_l data_img" id="span_verified_email_<?php echo $teleleadsres['id']; ?>">
 <img src="<?php echo base_url(); ?>images/admin/error.gif"/> </span>
 <?php } 
 //if($all_verify_email_phone[$cnt_rows_verify_table]['v_email'] == $)
 $check_lead_email = $teleleadsres['email'];
 $email_check = $this->lead_tele_model->check_lead_email_in_verify_table($check_lead_email);
  if($email_check == 1)
 {
 $record_verified_true = 1;
  
	$temp_var_for_verify_email_phone++;
 }
 ?>
				<span class="email_data" id="lead_email_<?php echo $teleleadsres['id']; ?>"><?php echo $teleleadsres['email']; ?></span>
 
 
 
			</div>
			
			
			<div class="span1 float_l">
				<?php
if($teleleadsres['lead_source']=='site_user'){ 
$lead_source="Site User"; }
else if($teleleadsres['lead_source']=='fb_login'){ $lead_source="FB Login(Site User)"; }
else if($teleleadsres['lead_source']=='android_user'){ $lead_source="Mobile App"; }
else if($teleleadsres['lead_source']=='event_user'){ $lead_source="Event Registration"; }
else if($teleleadsres['lead_source']=='fb_canvas'){ $lead_source="FB Application"; }
else if($teleleadsres['lead_source']=='college_request') { $lead_source="Request College"; }
else{$lead_source="Other";};
echo $lead_source;
?>
			</div>
			<div class="span1 float_l">
				<?php 
if($teleleadsres['phone_no1']=='' || $teleleadsres['phone_no1']==0 || $teleleadsres['phone_no1']==NULL) { ?>
<img src="<?php echo base_url(); ?>images/admin/error.gif"/>
<span style='color:blue'>Not Available</span><span style='color:red;font-size:10px;'>
</span>
<?php
}
else {
if($teleleadsres['phone_verified']) { ?>
<span class="float_l data_img" id="span_verified_phone_<?php echo $teleleadsres['id']; ?>">
 <img src="<?php echo base_url(); ?>images/admin/success.gif"/> </span>
<?php }
 else { ?>
 <span class="float_l data_img" id="span_verified_phone_<?php echo $teleleadsres['id']; ?>">
 <img src="<?php echo base_url(); ?>images/admin/error.gif"/> </span>
 <?php }
echo "<span id='lead_phone_$teleleadsres[id]'>".$teleleadsres['phone_no1']."</span>"; ?>
<?php }
 if($temp_var_for_verify_email_phone < 1)
 {
	$check_lead_phone = $teleleadsres['phone_no1'];
	$phone_check = $this->lead_tele_model->check_lead_phone_in_verify_table($check_lead_phone);
  if($phone_check == 1)
 {
 $record_verified_true = 1;
 } 
 }
 ?>
			</div>
			<div class="float_l" style="width:66px;">
				<a href="javascript:void(0);" onclick="edit_user_lead('<?php echo $teleleadsres['id']; ?>')" id="data_<?php echo $teleleadsres['id']; ?>" class="edit inline"><img src="<?php echo $base; ?>images/admin/edit-icon.png" alt="Edit"></a>	
                <a href="javascript:void(0);" onclick="delete_this_record('<?php echo $teleleadsres['id']; ?>')" id="data_<?php echo $teleleadsres['id']; ?>" class="edit inline"><img src="<?php echo $base; ?>images/admin/delete.png" alt="Delete"></a>				
				<div class="inline margin_l1" id="ajax_loading_img_<?php echo $teleleadsres['id']; ?>" style="display:none;"><img src="<?php echo $base ;?>images/ajax_loader.gif"></div>
			
			<!--<a href="javascript:void();" class="edit inline" style="margin-left:19px;cursor:pointer;" id="img_delete_lead_<?php echo $teleleadsres['id']; ?>" onclick="delete_this_record('<?php echo $teleleadsres['id']; ?>');">Delete</a>-->
			
			</div>
			<div class="clearfix"></div>
			 
		</div>
		<div id="<?php echo $teleleadsres['id']; ?>"></div>
	<?php $cnt_rows_verify_table++; }
?>
<div id="pagination" class="table_pagination right paging-margin float_r" style="margin-right:50px;">
            <?php echo $this->pagination->create_links();?>
           
  </div>
  <input type="hidden" id="lastviewdlead" value="0">	

</div>
<?php	}?>	

</div>	
</div>
	<div id="xxx"></div>
	<script type="text/javascript">
	var main_url = "<?php echo $base ?>";
	function delete_this_record(id)
	{
		var current_id = id;
		var ask_confirm = confirm("Do you want to drop this record?");
		var url='<?php echo $base;?>adminleads/droprecord';
		if(ask_confirm)
		{
		$.ajax({
		type: "POST",
		data: "id="+id,
		url: url,
		async: false,
		cache: false,
		success: function(msg)
		{
			if(msg == '1')
			{
				$("#data_data_"+current_id).hide("slow");
				$("#data_data_"+current_id).replaceWith("");
				$("#content_drop_msg").css("display","block");
			}
		}
		});
		}
	}
	
	function verify_lead(id)
	{
		var dynamic_lead_id = id.name;
		var verify_image_yes = main_url+'images/admin/success.gif';
		var verify_image_no = main_url+'images/admin/error.gif';
		if(id.id == "check_verify_lead_email_"+dynamic_lead_id)
		{
			if($("#check_verify_lead_email_"+dynamic_lead_id).is(':checked'))
			{
			$("#verify_img_email_"+dynamic_lead_id).html('<img src="'+verify_image_yes+'" />');
			}
			else{
			$("#verify_img_email_"+dynamic_lead_id).html('<img src="'+verify_image_no+'" />');
			}
		}
		else if(id.id == "check_verify_lead_phone_"+dynamic_lead_id)
		{
			if($("#check_verify_lead_phone_"+dynamic_lead_id).is(':checked'))
			{
			$("#verify_img_phone_"+dynamic_lead_id).html('<img src="'+verify_image_yes+'" />');
			}
			else{
			$("#verify_img_phone_"+dynamic_lead_id).html('<img src="'+verify_image_no+'" />');
			}
		}
	}
	
	
	function edit_user_lead(id)
	{
	//alert(id);
	var url='<?php echo $base;?>adminleads/fetch_user_info_for_tele';
	$.ajax({
          type: "POST",
          data: "id="+id,
          url: url,
          beforeSend: function() {
           $('#ajax_loading_img_'+id).show();
		   var lasteditleadid=$('#lastviewdlead').val();
		   //alert(lasteditleadid);
		   if(lasteditleadid!='0')
		   {
		    $('#edit_data_'+lasteditleadid).hide(1000);
			$('#edit_data_'+lasteditleadid).replaceWith('');
			 $('#data_'+lasteditleadid).show();
		   }
          },
          success: function(msg) {
		  $('#lastviewdlead').val(id);
		  $('#ajax_loading_img_'+id).hide();
		  $('#data_data_'+id).after(msg);
		  $('#edit_data_'+id).slideDown(500);
		  //$("#edit_data_"+id).css("width","589").css("padding-top","10px").css("border-color", "#000").css("border-width", "1px").css('border-style','solid');
		  $('#data_'+id).hide();
				 // $(this).after(msg);
          //  $("#xx").html(msg);
           // applyPagination();
          }
        });
	}
	
	function add_user_lead()
	{
	$("#content_msg").css("display","none");	
	var url='<?php echo $base;?>adminleads/add_new_leads';
	$.ajax({
          type: "POST",         
          url: url, 
		beforeSend:function()
		{
		$('#add_user_lead_loading_img').show();
		var lasteditleadid=$('#lastviewdlead').val();
		   //alert(lasteditleadid);
		   if(lasteditleadid!='0')
		   {
		    $('#edit_data_'+lasteditleadid).hide(1000);
			$('#edit_data_'+lasteditleadid).replaceWith('');
			 $('#data_'+lasteditleadid).show();
		   }
		},
          success: function(msg) {
		  $('#add_user_lead_loading_img').hide();
		  $('#xxx').html(msg);
		  
          }
        });
	
	}
	
	$(function() {
    applyPagination();

    function applyPagination() {
      $("#pagination a").click(function() {
        var url = $(this).attr("href");
        $.ajax({
          type: "POST",
          data: "ajax=1",
          url: url,
          beforeSend: function() {
            $("#content_data").html("");
          },
          success: function(msg) {
		  //alert(msg);
            $("#content_data").html(msg);
            applyPagination();
          }
        });
        return false;
      });
    }
  });
  
		/*$(document).ready(function() {
			var globalid;
			 $(".edit").click(function () {
				globalid = $(this).attr('id');
				$(".data").hide('slow');
				$(".old_data").show('slow');
				$("#data_"+globalid).hide('slow');
				$("#edit_"+globalid).slideDown('slow');
				$("#edit_"+globalid).css("width","589").css("padding-top","10px").css("border-color", "#000").css("border-width", "1px").css('border-style','solid');
				$("#cancel_"+globalid).click(function () {
					$("#edit_"+globalid).css('display','none');
					$("#data_"+globalid).show('slow');
				});
				
			 });
		});*/
		function canceldata(id){
					$("#edit_data_"+id).hide(1000);
					$('#edit_data_'+id).replaceWith('');
					$('#data_'+id).show();
					//$("#data_"+id).show('slow');
				};
				function cancel(){
					$("#edit_data").hide(1000);
					$('#edit_data').replaceWith('');
					$('#data').show();
					//$("#data_"+id).show('slow');
				}
	function fetchstates(cid,ssid)
	{
		ssid=0;
		var scid=$('#country option:selected').val();
		$.ajax({
		type: "POST",
		url: "<?php echo $base; ?>admin/state_list_ajax",
		data: 'country_id='+scid+'&sel_state_id='+ssid,
		cache: false,
		success: function(msg)
		{
		$('#state').attr('disabled', false);
		$('#state').html(msg);
		$('#city').html('<option value="">Select City </option>');
		}
		});
	}	

function fetchcities(state_id)
{

$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>admin/city_list_ajax/",
   data: 'state_id='+state_id,
   cache: false,
   success: function(msg)
   {
    $('#city').attr('disabled', false);
	$('#city').html(msg);
   }
   });  
}	
	
 function save_lead_form()
 { 		
 var fullname = $('#lead_full_name').val();
 fullname=fullname.trim();
 var email = $('#lead_user_email').val();
 email=email.trim();
 var phone = $('#lead_user_phone').val();
 phone=phone.trim();
 var phone_digit = phone.length;
 var country = $('#country').val();
 var state = $('#state').val();
 var city = $('#city').val();
 var enroll = $('#lead_tele_enroll').val();
 var notes = $('#notes').val();
 notes=notes.trim();
 var year = $('#year').val();
 var month = $('#month').val();
 var date = $('#date').val();
 var interested_cont = $('#interested_country').val();
 var lead_source = $("#lead_source").val();
 var lead_status = $("#lead_status").val();
 var next_action = $("#next_action").val();
 var success_exists=0;
 //start store intrested countries
 var c_id_list=0;
 $("input[name^=country_ids]").each(function() {
	var val=$(this).val();
	val=val.trim();
	c_id_list=c_id_list+','+val;

	});
//end code here			
var success=1;

if(year==0 || month==0 || date==0)
 {
	success=0;
	if(year==0)
	{
	$("#year").css("border-color","red");
	}
	else
	{
	$("#year").css("border-color","#ccc");
	}
	if(month==0)
	{
	$("#month").css("border-color","red");
	}
	else
	{
	$("#month").css("border-color","#ccc");
	}
	if(date==0)
	{
	$("#date").css("border-color","red");
	}
	else
	{
	$("#date").css("border-color","#ccc");
	}
	if(year==0 && month==0 && date==0)
	{
	success=1;
	$("#year").css("border-color","#ccc");
	$("#month").css("border-color","#ccc");
	$("#date").css("border-color","#ccc");
	}
	
 }
 else
 {
 success=1;
 $("#year").css("border-color","#ccc");
	$("#month").css("border-color","#ccc");
	$("#date").css("border-color","#ccc");
 }
 if(!success)
 {
 }
else if(phone_digit>0  && phone_digit<3)
{
 	$("#lead_user_phone").css("border-color","red");
	$('#error_message').html("Phone number should be 10 digit");
	$('#error_message').css("display","block");
	success=0;
}	
else if(validate_email(email)=='0' && email!='')
{
$("#lead_user_phone").css("border-color","#ccc");
success=0;
$("#lead_user_email").css("border-color","red");
}
else if(fullname=='')
{
$("#lead_user_email").css("border-color","#ccc");
$('#lead_full_name').css("border-color","red");
success=0;
}
 //if($("#check_verify_lead_email").is(':checked') || $("#check_verify_lead_phone").is(':checked'))
else 
{
$('#lead_full_name').css("border-color","#ccc");
	$('#error_message').html("");
	$('#error_message').css("display","none");
if(email=='' && phone=='' )
{
alert("Please Fill Either Email or Phone");
success_exists=0;
}
else {	
success_exists=1;
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
}
email_stauts=parseInt(email_stauts);
if(email_stauts) {
alert("For This Email or Phone No. Lead is already verified.");
}
else if(success_exists)
{

	if(email!='')
	{
	var email_verified=1;
	}
	else
	{
	 var email_verified=0;
	}
	if(phone!='')
	{
	var phone_verified=1;
	}
	else
	{
	 var phone_verified=0;
	}
	var lead_verified=1;

 // make as site user
 var lead_as_site_user=0;
 if($('#lead_as_site_user').is(':checked'))
 {
 lead_as_site_user=1;
 }
var data={
interested_cont :c_id_list,
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
phone_verified:phone_verified,
email_verified:email_verified,
lead_verified:lead_verified,
lead_status:lead_status,
next_action:next_action,
lead_as_site_user:lead_as_site_user
 };
 
$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>adminleads/add_new_verified_lead",
	   async:false,
	   data: data,
	   cache: false,
	   success: function(msg)
	   {
	  // alert(msg);
	   if(msg=='1')
	   {
	    $("#content_msg").css("display","block");
		 $('#content_msg p').html("Lead Verified successfully");
		
		
	   }	   
		 $("#edit_data").hide();
	     $('#edit_data').replaceWith('');
		 $('#adduser').show();
		
		
	   }
});
}
}
}	
function validate_email(email)
{
 var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   if(reg.test(email) == false) {
      return 0;
   }
}			
</script>

</body>
</html>