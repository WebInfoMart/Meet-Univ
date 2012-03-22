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

?>
	<div id="content">
			
		<h2 class="margin">Create University</h2>
		<div class="form span8">
			<form action="" method="post" class="caption_form" enctype="multipart/form-data">
				<ul>
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>University Name</label>
							</div>
							<div class="float_l span3">
								<input type="text" name="univ_name" size="30" class="<?php echo $class_univ_name; ?>">
								<span style="color: red;"> <?php echo form_error('univ_name'); ?><?php echo isset($errors['univ_name'])?$errors['univ_name']:''; ?> </span>
							
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
							<div class="float_l"><img src="<?php echo "$base$admin_img";  ?>/thumb1.jpg" class="logo_img"></div>
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
							<select class="<?php echo $class_univ_owner; ?> styled span3 margin_zero" name="univ_owner">
								<option value="">Please Select</option>
								<?php foreach($univ_admins as $univ_detail) { ?>
								<option value="<?php echo $univ_detail['id']; ?>"><?php echo $univ_detail['fullname']; ?></option>
							<?php } ?>
							</select>
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
							<input type="text" size="30" class="text" name="address1" value="<?php echo set_value('address1'); ?>">
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
							<input type="text" size="30" class="text" name="address2" value="<?php echo set_value('address2'); ?>">
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
										<option value="<?php echo $country['country_id']; ?>" ><?php echo $country['country_name']; ?></option>
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
											<select class="styled span3 margin_zero" name="state" onchange="fetchcities(this)" id="state" disabled="disabled">
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
							<input type="text" size="30" class="text" value="<?php echo set_value('phone_no'); ?>" name="phone_no">
						</div>
						<div class="clearfix"></div>
						</div>
					</li>
					<li>
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
					</li>
					<li>
						<div>
						<div class="float_l span3 margin_zero">
							<label>University Is Client</label>
						</div>
						<div class="float_l span3">
							<input type="checkbox" id="univ_client" class="checkbox" checked >
							<input type="hidden" name="univ_is_client" id="univ_is_client" value="1">
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
								<input type="text" size="30"  name="sub_domain" class="<?php echo $class_sub_domain; ?>">
								<span style="color: red;"> <?php echo form_error('sub_domain'); ?><?php echo isset($errors['sub_domain'])?$errors['sub_domain']:''; ?> </span>
							
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
								<input type="text" size="30" class="text" name="contact_us"  value="<?php echo set_value('contact_us'); ?>">
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
								<textarea rows="9" cols="103" name="about_us"><?php echo set_value('about_us'); ?></textarea>
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
				</ul>
				<input type="hidden" id="chkcustomjs" value="0">
						<input type="submit" class="submit" name="submit" value="UPDATE">
						
			</form>
		</div>
		

		<div class="form span7">
			
			<div class="modal-lightsout" id="add-country">
				<div class="modal-profile" id="add-country1">
					<h2>Add Your Place</h2>
					<a href="#" title="Close profile window" class="modal-close-profile">
					<img src="http://www.klevermedia.co.uk/assets/Uploads/close.png" alt="Close profile window"/></a>
					<form action="" method="post" id="form_country">
						<p>
							<label>Country:</label><br>
							<input type="text" size="30" class="text" name="country_model" value="<?php echo set_value('country_model'); ?>"> 
							<div style="color: red;"> <?php echo form_error('country_model'); ?><?php echo isset($errors['country_model'])?$errors['country_model']:''; ?> </div>
							
						</p>
						<p>
							<label>State:</label><br>
							<input type="text" size="30" class="text" name="state_model" value="<?php echo set_value('state_model'); ?>"> 
							<div style="color: red;"> <?php echo form_error('state_model'); ?><?php echo isset($errors['state_model'])?$errors['state_model']:''; ?> </div>
							
						</p>
						<p>
							<label>City:</label><br>
							<input type="text" size="30" class="text" name="city_model" value="<?php echo set_value('city_model'); ?>"> 
							<div style="color: red;"> <?php echo form_error('city_model'); ?><?php echo isset($errors['city_model'])?$errors['city_model']:''; ?> </div>
							
						</p>
						<p>
							<input type="submit" class="submit" name="addcountry" value="Submit">
						</p>
					</form>
				</div>
			</div>
			
			<div class="modal-lightsout" id="add-state">
				<div class="modal-profile" id="add-state1">
					<h2>Add Your Place</h2>
					<a href="#" title="Close profile window" class="modal-close-profile">
					<img src="http://www.klevermedia.co.uk/assets/Uploads/close.png" alt="Close profile window"/></a>
						<form action="" method="post" id="form_state">
						<p>
							<label>Country:</label><br>
						<select class="country_select margin_zero" name="country_model1" id="country" >
										<option value="">Select Country</option>
							<?php foreach($countries as $country) { ?>
										<option value="<?php echo $country['country_id']; ?>" ><?php echo $country['country_name']; ?></option>
										<?php } ?>
						</select>
						</p>
						<div style="color: red;"> <?php echo form_error('country_model1'); ?><?php echo isset($errors['country_model1'])?$errors['country_model1']:''; ?> </div>
							
						<p>
							<label>State:</label><br>
							<input type="text" size="30" class="text" name="state_model1" value="<?php echo set_value('state_model1'); ?>"> 
							<div style="color: red;"> <?php echo form_error('state_model1'); ?><?php echo isset($errors['state_model1'])?$errors['state_model1']:''; ?> </div>
							
						</p>
						<p>
							<label>City:</label><br>
							<input type="text" size="30" class="text" name="city_model1" value="<?php echo set_value('city_model1'); ?>"> 
							<div style="color: red;"> <?php echo form_error('city_model1'); ?><?php echo isset($errors['city_model1'])?$errors['city_model1']:''; ?> </div>
							
						</p>
						<p>
							<input type="submit" class="submit" name="addstate" value="Submit">
						</p>
					</form>
					
				</div>
			</div>
			<div class="modal-lightsout" id="add-city">
				<div class="modal-profile" id="add-city1">
					<h2>Add Your Place</h2>
					<a href="#" title="Close profile window" class="modal-close-profile">
					<img src="http://www.klevermedia.co.uk/assets/Uploads/close.png" alt="Close profile window"/></a>
					<form action="" method="post" id="form_city">
						<p>
							<label>Country:</label><br>
						<select class="country_select margin_zero" name="country_model2"  id="country_model" onchange="fetchstatesmodel(this)">
										<option value="">Select Country</option>
							<?php foreach($countries as $country) { ?>
										<option value="<?php echo $country['country_id']; ?>" ><?php echo $country['country_name']; ?></option>
										<?php } ?>
						</select>
						<div style="color: red;"> <?php echo form_error('country_model2'); ?><?php echo isset($errors['country_model2'])?$errors['country_model2']:''; ?> </div>
						
						</p>
						<p>
							<label>State:</label><br>
							<select class="country_select margin_zero" name="state_model2"  id="state_model" disabled="disabled">
							<option value="">Please Select</option>
							</select>
							<div style="color: red;"> <?php echo form_error('state_model2'); ?><?php echo isset($errors['state_model2'])?$errors['state_model2']:''; ?> </div>
							
						</p>
						<p>
							<label>City:</label><br>
							<input type="text" size="30" class="text" name="city_model2"> 
			<div style="color: red;"> <?php echo form_error('city_model2'); ?><?php echo isset($errors['city_model2'])?$errors['city_model2']:''; ?> </div>
								
						</p>
						<p>
							<input type="submit" class="submit" name="addcity" value="Submit">
						</p>
					</form>
					
				</div>
			</div>
		</div>
		
	</div>
	
<script> 
$(document).ready(function()
{
<?php if($model=='1') { ?>
 $('#add-country').fadeIn("slow");
 $('#add-country1').fadeTo("slow", .9);
<?php }?>
<?php if($model=='2') { ?>
 $('#add-state').fadeIn("slow");
 $('#add-state1').fadeTo("slow", .9);
<?php }?>
<?php if($model=='3') { ?>
 $('#add-city').fadeIn("slow");
 $('#add-city1').fadeTo("slow", .9);
<?php }?>
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
function fetchstates(a)
{
var cid=$("#"+a.id+" option:selected").val();
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>admin/state_list_ajax/"+cid,
   data: '',
   cache: false,
   success: function(msg)
   {
    $('#state').attr('disabled', false);
	$('#state').html(msg);
   }
   });
}
function fetchstatesmodel(a)
{
var cid=$("#"+a.id+" option:selected").val();
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>admin/state_list_ajax/"+cid,
   data: '',
   cache: false,
   success: function(msg)
   {
    $('#state_model').attr('disabled', false);
	$('#state_model').html(msg);
   }
   });
}
function fetchcities(a)
{
var sid=$("#state option:selected").val();
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>admin/city_list_ajax/"+sid,
   data: '',
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
</script>	