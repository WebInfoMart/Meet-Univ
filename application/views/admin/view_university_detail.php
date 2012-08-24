<?php
foreach($univ_detail_edit as $univ_detail_update)
{
?>

	<div id="content">
			
		<h2 class="margin">Update University</h2>
		<div class="form span8">
			<form action="" method="post" class="caption_form" enctype="multipart/form-data">
				<ul class="new_div">
					<li>
						<div>
							<div class="float_l span3 margin_zero">
								<label>University Name</label>
							</div>
							
							<div class="float_l span3">
						<input type="text" disabled="disabled" name="univ_name" size="30" value="<?php echo $univ_detail_update['univ_name']; ?>" class="text univ_name_txt">
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
								<input type="text" disabled="disabled" name="title" value="<?php echo $univ_detail_update['title']; ?>" size="30" class="text univ_name_txt">
								
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
								<input type="text" disabled="disabled" name="keyword" value="<?php echo $univ_detail_update['keyword']; ?>" size="30" class="text univ_name_txt">
								
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
								<input type="text" disabled="disabled" value="<?php echo $univ_detail_update['description']; ?>"  name="description" size="30" class="text univ_name_txt">
								
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
								<input type="text" disabled="disabled" name="latitude" value="<?php echo $univ_detail_update['latitude']; ?>"   size="30" class="text univ_name_txt">
								
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
								<input type="text" disabled="disabled" value="<?php echo $univ_detail_update['longitude']; ?>"  name="longitude" size="30" class="text univ_name_txt">
								
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
							
							<img src="<?php echo "$base";  ?>uploads/univ_gallery/<?php if($univ_detail_update['univ_logo_path']==''){ echo "default_logo.png"; } else { echo $univ_detail_update['univ_logo_path']; } ?>" class="logo_img"></div>
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
<input type="text" disabled="disabled" size="30" class="text univ_name_txt" readonly name="univ_owner" value="<?php if($univ_detail_update['fullname']==''){echo "No Admin Assigned Yet";} else{ echo $univ_detail_update['fullname']; } ?>" >
						
							
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
							<input type="text" disabled="disabled" size="30" class="text univ_name_txt" name="address1" value="<?php echo $univ_detail_update['address_line1']; ?>" >
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
									<input type="text" disabled="disabled" size="30" class="text univ_name_txt"  value="<?php echo $univ_detail_update['country_name']; ?>">
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
										<input type="text" disabled="disabled" size="30" class="text univ_name_txt"  value="<?php echo $univ_detail_update['statename']; ?>">
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
											<input type="text" disabled="disabled" size="30" class="text univ_name_txt"  value="<?php echo $univ_detail_update['cityname']; ?>">
										
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
							<input type="text" disabled="disabled" size="30" class="text univ_name_txt" value="<?php echo $univ_detail_update['phone_no']; ?>"  name="phone_no">
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
				<input type="checkbox" disabled="disabled" id="univ_client" class="checkbox" <?php if($univ_detail_update['univ_is_client']){?> checked <?php } ?> >
						
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
								<input type="text" disabled="disabled" size="30" value="<?php echo $univ_detail_update['subdomain_name']; ?>"   name="sub_domain" class="text univ_name_txt">
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
								<input type="text" disabled="disabled" size="30" value="<?php echo $univ_detail_update['contact_us']; ?>"  class="text univ_name_txt" name="contact_us"  value="<?php echo set_value('contact_us'); ?>">
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
	<input type="text" size="30"  class="text univ_name_txt" disabled="disabled" name="fax_address"  value="<?php echo $univ_detail_update['univ_fax']; ?>">
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
			<input type="text" size="30"  disabled="disabled"  class="text univ_name_txt" name="univ_email" value="<?php echo $univ_detail_update['univ_email']; ?>"   >
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
					<input type="text" disabled="disabled" size="30" value="<?php echo $univ_detail_update['univ_web']; ?>"  class="text univ_name_txt" name="web_address">
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
								<textarea rows="9" disabled="disabled" cols="103" name="about_us" class="univ_name_txt"><?php echo $univ_detail_update['about_us']; ?>"</textarea>
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
				</ul>
			
					
						
			</form>
		</div>
		</div>
<?php } ?>
	