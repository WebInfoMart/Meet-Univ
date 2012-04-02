<div id="content" class="content_msg" style="display:none;">
<div class="span8 margin_t">
  <div class="message success"><p>University Admin added successfully</p>
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

//ist model box
$class_country_model='';
$class_state_model='';
$class_city_model='';
$error_country_model = form_error('country_model');
$error_state_model = form_error('state_model');
$error_city_model = form_error('city_model');

if($error_country_model != '') { $class_country_model = 'focused_error_univ'; } else { $class_country_model='text'; }

if($error_state_model != '') { $class_state_model = 'focused_error_univ'; } else { $class_state_model='text'; }
if($error_city_model != '') { $class_city_model = 'focused_error_univ'; } else { $class_city_model='text'; }

//2nd model box
$class_country_model1='';
$class_state_model1='';
$class_city_model1='';
$error_country_model1 = form_error('country_model1');
$error_state_model1 = form_error('state_model1');
$error_city_model1 = form_error('city_model1');

if($error_country_model1 != '') { $class_country_model1 = 'focused_error_univ'; } else { $class_country_model1='text'; }

if($error_state_model1 != '') { $class_state_model1 = 'focused_error_univ'; } else { $class_state_model1='text'; }
if($error_city_model1 != '') { $class_city_model1 = 'focused_error_univ'; } else { $class_city_model1='text'; }

//3rd model box
$class_country_model2='';
$class_state_model2='';
$class_city_model2='';
$error_country_model2 = form_error('country_model2');
$error_state_model2 = form_error('state_model2');
$error_city_model2 = form_error('city_model2');

if($error_country_model2 != '') { $class_country_model2 = 'focused_error_univ'; } else { $class_country_model2='text'; }

if($error_state_model2 != '') { $class_state_model2 = 'focused_error_univ'; } else { $class_state_model2='text'; }
if($error_city_model2 != '') { $class_city_model2 = 'focused_error_univ'; } else { $class_city_model2='text'; }

//4th model box
$class_full_name='';
$class_email='';
$class_password='';
$class_confirm_password='';
$error_full_name = form_error('fullname');
$error_email = form_error('email');
$error_password = form_error('password');
$error_confirm_password = form_error('confirm_password');

if($error_full_name != '') { $class_full_name = 'focused_error_univ_new'; } else { $class_full_name='text'; }

if($error_email != '') { $class_email = 'focused_error_univ_new'; } else { $class_email='text'; }
if($error_password != '') { $class_password = 'focused_error_univ_new'; } else { $class_password='text'; }
if($error_confirm_password != '') { $class_confirm_password = 'focused_error_univ_new'; } else { $class_confirm_password='text'; }

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
								<input type="text" name="univ_name" size="30" value="<?php echo set_value('univ_name'); ?>" class="<?php echo $class_univ_name; ?>">
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
								<input type="text" name="title" size="30" class="text" value="<?php echo set_value('title'); ?>">
								
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
								<input type="text" name="keyword" size="30" class="text" value="<?php echo set_value('keyword'); ?>">
								
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
								<input type="text" name="description" size="30" class="text" value="<?php echo set_value('description'); ?>">
								
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
								<input type="text" name="latitude" size="30" class="text" value="<?php echo set_value('latitude'); ?>" >
								
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
								<input type="text" name="longitude" size="30" class="text" value="<?php echo set_value('longitude'); ?>">
								
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
							<div class="float_l"><img src="<?php echo "$base$img_path";  ?>/logo.png" class="logo_img"></div>
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
							<select class="<?php echo $class_univ_owner; ?> styled span3 margin_zero" name="univ_owner" id="univ_owner">
								<option value="">Please Select</option>
								<?php foreach($univ_admins as $univ_detail) { ?>
								<option value="<?php echo $univ_detail['id']; ?>"><?php echo ucwords($univ_detail['fullname']); ?></option>
							<?php } ?>
							</select>
							<span style="color: red;"> <?php echo form_error('univ_owner'); ?><?php echo isset($errors['univ_owner'])?$errors['univ_owner']:''; ?> </span>
							
						</div>
						<div class="float_l span3">
								<a rel="add-univ-admin" href="#" id="add_univ_admin" class="tdn">Add New University Admin</a>
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
										<option value="<?php echo $country['country_id']; ?>" <?php if($country['country_id']==$select_place[0]){?> selected <?php }?> ><?php echo $country['country_name']; ?></option>
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
								<input type="text" size="30" value="<?php echo set_value('sub_domain'); ?>"  name="sub_domain" class="<?php echo $class_sub_domain; ?>">
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
			
						<input type="submit" class="submit" name="submit" value="UPDATE">
						
			</form>
		</div>
		

		<div class="form span11">
			
			<div class="modal-lightsout" id="add-country">
				<div class="modal-profile" id="add-country1">
					<h2>Add Your Place</h2>
					<a href="#" title="Close profile window" class="modal-close-profile">
					<img src="<?php echo "$base$img_path/$admin"; ?>/close_model.png" class="closeimagesize" alt="Close window"/></a>
					<form action="" method="post" id="form_country" >
						<p>
							<label>Country:</label><br>
							<input type="text" size="30" class="<?php echo $class_country_model; ?>" name="country_model" value="<?php echo set_value('country_model'); ?>"> 
							<div style="color: red;"> <?php echo form_error('country_model'); ?><?php echo isset($errors['country_model'])?$errors['country_model']:''; ?> </div>
							
						</p>
						<p>
							<label>State:</label><br>
							<input type="text" size="30" class="<?php echo $class_state_model; ?>" name="state_model" value="<?php echo set_value('state_model'); ?>"> 
							<div style="color: red;"> <?php echo form_error('state_model'); ?><?php echo isset($errors['state_model'])?$errors['state_model']:''; ?> </div>
							
						</p>
						<p>
							<label>City:</label><br>
							<input type="text" size="30" class="<?php echo $class_city_model; ?>" name="city_model" value="<?php echo set_value('city_model'); ?>"> 
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
					<img src="<?php echo "$base$img_path/$admin"; ?>/close_model.png" class="closeimagesize" alt="Close window"/></a>
						<form action="" method="post" id="form_state">
						<p>
							<label>Country:</label><br>
						<select class="<?php echo $class_country_model1; ?> country_select margin_zero" name="country_model1" id="country" >
										<option value="">Select Country</option>
							<?php foreach($countries as $country) { ?>
										<option value="<?php echo $country['country_id']; ?>" ><?php echo $country['country_name']; ?></option>
										<?php } ?>
						</select>
						</p>
						<div style="color: red;"> <?php echo form_error('country_model1'); ?><?php echo isset($errors['country_model1'])?$errors['country_model1']:''; ?> </div>
							
						<p>
							<label>State:</label><br>
							<input type="text" size="30" class="<?php echo $class_state_model1; ?>" name="state_model1" value="<?php echo set_value('state_model1'); ?>"> 
							<div style="color: red;"> <?php echo form_error('state_model1'); ?><?php echo isset($errors['state_model1'])?$errors['state_model1']:''; ?> </div>
							
						</p>
						<p>
							<label>City:</label><br>
							<input type="text" size="30" class="<?php echo $class_city_model1; ?>" name="city_model1" value="<?php echo set_value('city_model1'); ?>"> 
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
					<img src="<?php echo "$base$img_path/$admin"; ?>/close_model.png" class="closeimagesize" alt="Close window"/></a>
					<form action="" method="post" id="form_city">
						<p>
							<label>Country:</label><br>
						<select class="<?php echo $class_country_model2; ?> country_select margin_zero" name="country_model2"  id="country_model" onchange="fetchstatesmodel(this)">
										<option value="">Select Country</option>
							<?php foreach($countries as $country) { ?>
										<option value="<?php echo $country['country_id']; ?>" ><?php echo $country['country_name']; ?></option>
										<?php } ?>
						</select>
						<div style="color: red;"> <?php echo form_error('country_model2'); ?><?php echo isset($errors['country_model2'])?$errors['country_model2']:''; ?> </div>
						
						</p>
						<p>
							<label>State:</label><br>
							<select class="<?php echo $class_state_model2; ?> country_select margin_zero" name="state_model2"  id="state_model" disabled="disabled">
							<option value="">Please Select</option>
							</select>
							<div style="color: red;"> <?php echo form_error('state_model2'); ?><?php echo isset($errors['state_model2'])?$errors['state_model2']:''; ?> </div>
							
						</p>
						<p>
							<label>City:</label><br>
							<input type="text" size="30" class="<?php echo $class_city_model2; ?>" name="city_model2"> 
			<div style="color: red;"> <?php echo form_error('city_model2'); ?><?php echo isset($errors['city_model2'])?$errors['city_model2']:''; ?> </div>
								
						</p>
						<p>
						<input type="hidden" name="level_user" value="3">
							<input type="submit" class="submit" name="addcity" value="Submit">
						</p>
					</form>
					
				</div>
			</div>
			
			<div class="modal-lightsout1" id="add-univ">
				<div class="modal-profile1" id="add-univ1">
					<h3>Create Univeraity Admin</h3>
					<a href="#" title="Close profile window" class="modal-close-profile">
					<img src="<?php echo "$base$img_path/$admin"; ?>/close_model.png" class="closeimagesize"  alt="Close profile window"/></a>
					<form action="" method="post" id="add_user_form" class="university_model" onsubmit="return false;">
						<div>
							<div class="float_l form_univ">
								<p>
									<label>FULLNAME:</label><br>
									<input type="text" size="30" class="<?php echo $class_full_name; ?>" value="" id="fullname" name="fullname"> 
									<label class="label_error"  id="fullname_error"></label>
								</p> 
								<p>
									<label>EMAIL:</label><br>
									<input type="text" size="30" value="" class="<?php echo $class_email; ?>" id="email"  name="email">
									<label class="label_error"  id="email_error"></label>		
							</p> 
								<p>
									<label>PASSWORD:</label><br>
									<input type="password" size="30"  class="<?php echo $class_password; ?>" id="password" name="password"> 
									<label class="label_error"  id="pwd_error"></label><label class="label_error"  id="length_pwd_error"></label>				
								</p> 
								<p>
									<label>CONFIRM PASSWORD:</label><br>
									<input type="password" size="30" class="<?php echo $class_confirm_password; ?>" id="confirm_password"  name="confirm_password"> 
									<label class="label_error"  id="cpwd_error"></label>		
						</p> 
							</div>
							<div class="right_univ"></div>
							<div class="float_l span5 margin_zero">
								<ul>
									<li>
										<div>
											<div class="float_l span1 margin_zero"><h4><center>Manage</center></h4></div>
											<div class="float_l button_width"><h5><center>VIEW</center></h5></div>
											<div class="float_l button_width"><h5><center>EDIT</center></h5></div>
											<div class="float_l button_width"><h5><center>INSERT</center></h5></div>
											<div class="float_l button_width"><h5><center>DELETE</center></h5></div>
											<div class="clearfix"></div>
										</div>
									</li>
									<?php
										foreach ($results as $privilage){	
										if($privilage['privilege_type_id']==2 || $privilage['privilege_type_id']==3 || $privilage['privilege_type_id']==4 || $privilage['privilege_type_id']==6 || $privilage['privilege_type_id']==11)
										{?>	
									<li>
										<div>
											<div class="float_l span1 margin_zero"><h5><center><?php echo ucwords($privilage['privilege_name']);?></center></h5></div>
											<input type="hidden" name="privilege_type_id[]" value="<?php echo $privilage['privilege_type_id']; ?>">
											<input type="hidden" value="0" name="privilege_total[]" class="reset_priv" id="privilege_total_<?php echo $privilage['privilege_type_id']; ?>">
											<div class="float_l button_width">
											<p class="onoffswitch margin_l3">
											<span class="onoff_box" style="background-position-x: 0px; ">
											<input type="checkbox" id="view_<?php echo $privilage['privilege_type_id'];?>" name="view_<?php echo $privilage['privilege_type_id'];?>" value="1"  class="onoffbtn" ></span>
											</p>
											</div>
											<div class="float_l button_width">
											<p class="onoffswitch margin_l3">
											<span class="onoff_box" style="background-position-x: 0px; ">
											<input type="checkbox" id="edit_<?php echo $privilage['privilege_type_id'];?>" name="edit_<?php echo $privilage['privilege_type_id'];?>" value="2" class="onoffbtn priorop" ></span>
											</p>
											</div>
											<div class="float_l button_width">
											<p class="onoffswitch margin_l3">
											<span class="onoff_box" style="background-position-x: 0px; ">
											<input type="checkbox" id="insert_<?php echo $privilage['privilege_type_id'];?>" name="insert_<?php echo $privilage['privilege_type_id']?>"  value="3" class="onoffbtn priorop" ></span>
											</p></div>
											<div class="float_l button_width">
											<p class="onoffswitch margin_l3">
											<span class="onoff_box" style="background-position-x: 0px; ">
											<input type="checkbox" id="delete_<?php echo $privilage['privilege_type_id'];?>" name="delete_<?php echo $privilage['privilege_type_id'];?>"  value="4" class="onoffbtn priorop" ></span>
											</p></div>
											<div class="clearfix"></div>
										
										</div>
									</li>
									<?php } 
										}?>	
									
								</ul>
							</div>
							<div class="clearfix"></div>
						</div>
						<center>
						<input type="submit" onclick="univ_admin_validate_form()" class="submit" name="add_univ_admin_submit" value="Submit"></center>
					</form>
				</div>
		</div>

			
			
		</div>
		
	</div>	
	
<script> 
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}
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
<?php if($model=='4') { ?>
 $('#add-univ').fadeIn("slow");
 $('#add-univ1').fadeTo("slow", .9);
<?php }?>
});
<?php
if($select_place[0]!='0' && $select_place[1]!='0' && $select_place[2]!='0')
{?>
fetchstates(1);
fetchcities(1);
<?php }
?>
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
var cid=$("#country option:selected").val();
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>admin/state_list_ajax/"+cid+"/<?php echo $select_place[1]; ?>",
   data: '',
   cache: false,
   async:false,
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
   url: "<?php echo $base; ?>admin/city_list_ajax/"+sid+"/<?php echo $select_place[2]; ?>",
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

function univ_admin_validate_form()
{
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
	   data: 'email='+email,
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
		$('.content_msg').css('display','block');
	   }
	   });
	 } 
	   
	}
	
}	
</script>	