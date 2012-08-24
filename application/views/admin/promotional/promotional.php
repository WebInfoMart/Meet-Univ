	<div class="body" id="content">
		<div class="data13">
			
			<div class="data13 promot_holder">
				<div class="promot_heading">
				Promote
				</div>
				<div class="pc_set"><img src="<?php echo $base; ?>images/images/pc_icon.png" class="inline pc_img_set">
					<data class="inline text_size">Promote your events / university using our super intelligent :</data>
					<div class="line_set"></div>
				</div>
				<div class="center_area">
					<div class="float_l data3 center_color margin_delta">
						<div class="bg_green">
							<img src="<?php echo $base; ?>images/images/sms.png" class="icon_img"/>
							<a href="<?php echo $base; ?>admin_promotional/sms_campaign" ><data class="icon_txt">SMS campaign</data></a>
						</div>
						<div class="padding fix_height">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</div>
						<button type="button" class="promo_btn">View Plans & Pricing</button>
					</div>
					<div class="line_back"></div>
					<div class="float_l data3 margin_delta center_color">
						<div class="bg_orange">
							<img src="<?php echo $base; ?>images/images/mail.png" class="icon_img"/>
							<data class="icon_txt">EMAIL campaign</data>
						</div>
						<div class="padding fix_height">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</div>
						<button type="button" class="promo_btn">View Plans & Pricing</button>
					</div>
					<div class="line_back"></div>
					<div class="float_l data3 margin_delta center_color">
						<div class="bg_blue">
							<img src="<?php echo $base; ?>images/images/voice.png" class="icon_img"/>
							<data class="icon_txt">VOICE campaign</data>
						</div>
						<div class="padding fix_height">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</div>
						<button type="button" class="promo_btn">View Plans & Pricing</button>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="data13 second_holder">
				<div class="promot_heading">
				Super Intelligent comparison
				</div>
					<div class="data_margin">
						<div class="data5 float_l margin_delta">
							<form class="form-horizontal">
								<div class="control-group2">
									<label class="control-label5" for="input01">Country: </label>
									<div class="controls">
										<select id="country_list" onchange="find_no_of_user_on_onchange(this)">
										
											<option value="0">Select Country</option>
											<?php foreach($country_list as $country_lists) { ?>
											<option value="<?php echo $country_lists['country_id']; ?>"><?php echo $country_lists['country_name']; ?></option>
											<?php } ?>
											
										</select>
									</div>
								</div>
								<div class="control-group2">
									<label class="control-label5" for="select01">City: </label>
									<div class="controls">
										<select id="city_list" onchange="find_no_of_user_on_onchange(this)">
											<option value="0">Select Educ Level</option>
								<?php foreach($all_cities as $all_city) { ?>			
											<option value="<?php echo $all_city['city_id']; ?>"><?php echo $all_city['cityname']; ?></option>
								<?php } ?>			
										</select>
									</div>
								</div>
								<div class="control-group2">
									<label class="control-label5" for="select01">Educational level: </label>
									<div class="controls">
										<select id="educ_level" onchange="find_no_of_user_on_onchange(this)">
											<option value="0">Select your location</option>
											<option value="2">Fondation</option>
											<option value="3">UnderGraduate</option>
											<option value="4">PostGraduate</option>
										</select>
									</div>
								</div>
								
							</form>
						</div>
						<div class="hori_dotted"></div>
						<div class="data4 float_l margin_delta">
							<div class="orange_icon float_l">
								<data class="data_text" id="country_text_name" >Worldwide</data>
							</div>
							<h3 class="count_txt" id="total_no_of_student_in_country" ><?php echo $total_student; ?></h3>
							<div class="clearfix"></div>
							<div class="down_arrow city_div"></div>
							<div class="blue_icon float_l city_div">
								<data class="data_text" id="city_text_name">Select City</data>
							</div>
							<h3 class="count_txt city_div" id="no_of_student_in_city">0<?php // echo $total_student_in_india; ?></h3>
							<div class="clearfix"></div>
							<div class="down_arrow educ_div"></div>
							<div class="green_icon educ_div float_l">
								<data class="data_text" id="educ_lvl_text_name">Select Educ. Level</data>
							</div>
							<h3 class="count_txt educ_div" id="no_of_student_in_educ_lvl">0<?php //echo $undergraduate_in_india; ?></h3>
						</div>
						<div class="clearfix"></div>
						<div><img src="<?php echo $base; ?>images/admin/graph.png" style="width:416px;"></div>
					</div>
			</div>
		</div>
	</div>
<script>
function find_no_of_user_on_onchange(select)
{
var country_id=$('#country_list option:selected').val();
var country_text=$('#country_list option:selected').text();
var city_id=$('#city_list option:selected').val();
var city_text=$('#city_list option:selected').text();
var educ_level=$('#educ_level option:selected').val();
var educ_level_text=$('#educ_level option:selected').text();
var data;
var change='';
if(select.id=='country_list')
{
change='country';
}
else if(select.id=='city_list')
{
change='city';
}
else
{
change='educ_level';
}
data={country_id:country_id,city_id:city_id,educ_level:educ_level};
url='<?php echo $base; ?>admin_promotional/count_student_change_wise/'+change;
$.ajax({
	   type: "POST",
	   url: url,
	   async:false,
	   data: data,
	   success: function(msg)
	   {
	   if(select.id=='country_list')
		{
		 if(country_id==0)
		 {
		 $('#country_text_name').html('Worldwide');
		 }
		 var res=msg.split('!@#$%');
		 $('#city_list').html(res[0]);
		 $('#total_no_of_student_in_country').html(res[1]);
		 $('#country_text_name').html(country_text);
		 $('#city_text_name').html('Select City');
		 $('#no_of_student_in_city').html('0');
		  $('#no_of_student_in_educ_lvl').html(res[2]);
		}
		else if(select.id=='city_list')
		{
		var res=msg.split('!@#$%');
		$('#city_text_name').html(city_text);
		$('#no_of_student_in_city').html(res[0]);
		if(educ_level!='0'){
		 $('#no_of_student_in_educ_lvl').html(res[1]);
		 }
		$('.city_div').show();
		}
		else if(select.id=='educ_level')
		{
		if(educ_level==0)
		{
		$('#educ_lvl_text_name').html('Select Educ. Level');
		 $('#no_of_student_in_educ_lvl').html('0');
		}
		else {
		 $('#educ_lvl_text_name').html(educ_level_text);
		 $('#no_of_student_in_educ_lvl').html(msg);
		}
	   }
	   }
});
}
</script>