<link rel="stylesheet" href="<?php echo $base; ?>css/admin/engage/style.css">
<script src="<?php echo $base; ?>js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $base; ?>js/jquery-ui-custom-autosuggest.js" type="text/javascript" charset="utf-8"></script>  
<div id="content">
		<div class="big_width margin_delta">
			<div class="counsel_bg">
			<div class="float_l span77 margin_delta">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Source country: </label>
					<div class="controls-input-data">
					<select class="large" id="country" onchange="fetchcities()">
					<option value="0">-Select Country-</option>
					<?php foreach($country as $cntry)
					{ ?>
					<option value="<?php echo $cntry['country_id']; ?>"><?php echo $cntry['country_name']; ?></option>
					<?php
					}
					?>
					</select>
					</div>
				</div>
			</div>
			<div class="float_l span77">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Source city: </label>
					<div class="controls-input-data">
					<select class="large" id="city">
					<option value="0">-Select City-</option>
					<?php foreach($city as $ct)
					{ ?>
					<option value="<?php echo $ct['city_id']; ?>"><?php echo $ct['cityname']; ?></option>
					<?php
					}
					?>
					</select>
					</div>
				</div>
			</div>
			<div class="float_l span77">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Leads: </label>
					<div class="controls-input-data">
					<input type="text" class="large" id="input01">
					</div>
				</div>
			</div>
			<div class="float_l span77">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Next action: </label>
					<div class="controls-input-data">
					<select class="large" id="next_action">
					<option value="0">-Select Action-</option>
					<option value="none">none</option>
					<option value="counsellor">counsellor</option>
					<option value="hot">hot</option>
					<option value="paused">paused</option>
					</select>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="bottom_line"></div>
			<div class="float_l span77 margin_delta">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Source: </label>
					<div class="controls-input-data">
					<select class="large" id="source">
					<option value="0">-Select Source-</option>
					<option value="site_user">Siteuser</option>
					<option value="fb_login">fb Login</option>
					<option value="fb_canvas">fb Canvas</option>
					<option value="android_user">Android User</option>
					<option value="event_user">Event USer</option>
					<option value="other">Other</option>
					</select>
					</div>
				</div>
			</div>
			<div class="float_l span77">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Phone no: </label>
					<div class="controls-input-data">
					<input type="checkbox" id="phone" class="checkbox_set">
					</div>
				</div>
			</div>
			<div class="float_l span77">
				<div class="control-group">
					<label class="label-control-data blue" for="input01"> Email address: </label>
					<div class="controls-input-data">
					<input type="checkbox" id="email" class="checkbox_set">
					</div>
				</div>
			</div>
			<div class="float_1 span77">
				<div class="control-group">
					<button type="button" id="search_btn" value="" onclick="search();" style="width:80px;height:30px;">Search</button>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="bottom_line"></div>
		</div>
		<!--
		<pre>
		<?php //print_r($country); ?>
		</pre> -->
		<div class="margin_t " id="main_content" >
			<div class="span1 float_l">
				<b>Sr.no</b>
			</div>
			<div class="span14 float_l">
				<b class="blue">FullName</b>
			</div>
			<div class="span14 float_l">
				<b class="green">Email</b>
			</div>
			<div class="span14 float_l">
				<b class="blue">Source</b>
			</div>
			<div class="span14 float_l">
				<b class="green">Phone</b>
			</div>
			<div class="clearfix"></div>
			<div class="dotted_line"></div>
			<?php 
			$sr_no=0;
			foreach($verify_teleleads as $result)
			{ ?>
			<div id="c_lead_<?php echo $result['v_id']; ?>" class="old_data update_verify_lead">
				<div class="span1 float_l">
						<?php $sr_no++; echo $sr_no; ?>
				</div>
				<div class="span14 float_l">
					<?php  echo $result['v_fullname']; ?>
				</div>
				<div class="span14 float_l">
					<?php  echo $result['v_email']; ?>
				</div>
				<div class="span14 float_l">
					<?php if($result['v_user_type']==''){ echo ''; } else { echo $result['v_user_type']; } ?>
				</div>
				<div class="span14 float_l">
					<?php  echo $result['v_phone'];  ?>
				</div>				
				<div class="clearfix"></div>
			</div>
			<?php } ?>
		
		</div>
	</div>
</div>	
	<div id="c_edit"></div>
<script type="text/javascript">
$('.update_verify_lead').click(function(){
var id=$(this).attr("id");

id=id.replace("c_lead_","");
$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admin_counsellor/counsellor",
	   async:false,
	   data: 'id='+id,
	   cache: false,
	   success: function(msg)
	   {//alert(msg);
	    $('#content').hide();
		$("#c_edit").show();
		$('#c_edit').html(msg);		 
	   }
	   });
});
function cancel()
{
	$("#c_edit").hide();
	//$('#c_edit').replaceWith('');
	$('#content').show();
	//$("#data_"+id).show('slow');
}
function fetchcities()
{
var cityid=0;
var country_id=$("#country").val();

 $.ajax({
   type: "POST",
   url: "<?php echo $base; ?>admin_counsellor/city_list/",
   data: 'country_id='+country_id+'&sel_city_id='+cityid,
   cache: false,
   success: function(msg)
   {
    //$('#'+cityID).attr('disabled', false);
	$('#city').html(msg);
   }
   });  
}
function search()
{
	var cnt_id=$("#country").val();
	var ct_id=$("#city").val();
	var action_id=$("#next_action").val();
	var src_id=$("#source").val();
	var phone=$("#phone").is(':checked');
	var email=$("#email").is(':checked');
	var data='country='+cnt_id+'&city='+ct_id+'&action_id='+action_id+'&src_id='+src_id+'&phone='+phone+'&email='+email;	
	$.ajax({
	type:"POST",
	url:"<?php echo $base; ?>admin_counsellor/search_lead",
	data: data,
	cache: false,
	async:false,
	success:function(msg)
	{
		//alert(msg);
		$("#main_content").html(msg);
	}
	});
	
	
}	 
</script>	

