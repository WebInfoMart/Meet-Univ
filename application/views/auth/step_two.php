<?php
$class_interest_country='';
$class_firstname='';
$class_lastname='';
$class_dob_day='';
$class_dob_year='';
$class_home_adress='';
$class_state='';
$class_city='';
$class_phone='';
$class_area_interest='';
$class_current_educ='';
$class_next_educ='';
$class_academic_exam_score='';

$error_interest_country = form_error('interest_study_country');
$error_firstname = form_error('first_name');
$error_lastname = form_error('last_name');
$error_dob_day = form_error('dob_day');
$error_dob_year = form_error('dob_year');
$error_home_adress = form_error('home_address');
$error_state = form_error('state');
$error_city = form_error('city');
$error_phone = form_error('phone');
$error_area_interest = form_error('area_interest');
$error_current_educ = form_error('current_educ_level');
$error_next_educ = form_error('next_educ_level');
$error_academic_exam_score = form_error('academic_exam_score1');
//$error_agree = form_error('step_email');

if($error_interest_country != '') { $class_interest_country = 'focused_error_stepone'; } else { $class_interest_country=''; }

if($error_state != '') { $class_state = 'focused_error_steptwo_dropdown span3'; } else { $class_state='span3'; }
if($error_city != '') { $class_city = 'focused_error_steptwo_dropdown span3'; } else { $class_city='span3'; }
if($error_area_interest != '') { $class_area_interest = 'focused_error_steptwo_dropdown span3'; } else { $class_area_interest='span3'; }
if($error_current_educ != '') { $class_current_educ = 'focused_error_steptwo_dropdown span3'; } else { $class_current_educ='span3'; }
if($error_next_educ != '') { $class_next_educ = 'focused_error_steptwo_dropdown span3'; } else { $class_next_educ='span3'; }

if($error_firstname != '') { $class_firstname = 'focused_error_steptwo_small_textboxes span2'; } else { $class_firstname='span2'; }
if($error_lastname != '') { $class_lastname = 'focused_error_steptwo_small_textboxes span2'; } else { $class_lastname='span2'; }
if($error_dob_day != '') { $class_dob_day = 'focused_error_steptwo_small_textboxes span2'; } else { $class_dob_day='span2'; }
if($error_dob_year != '') { $class_dob_year = 'focused_error_steptwo_small_textboxes span2'; } else { $class_dob_year='span2'; }
if($error_home_adress != '') { $class_home_adress = 'focused_error_steptwo_large_textboxes span3'; } else { $class_home_adress='span3'; }
if($error_phone != '') { $class_phone = 'focused_error_steptwo_small_textboxes span2'; } else { $class_phone='span2'; }
if($error_academic_exam_score != '') { $class_academic_exam_score = 'focused_error_steptwo_small_textboxes span2'; } else { $class_academic_exam_score='span2'; }
?>
	<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body">
			<div class="row margin_t1">
				<div class="float_l span13 margin_l">
					<div class="float_l span10 margin_zero">
						<div class="step_back round_box ">
							<div class="center handle_img step2_posit">
							</div>
							<h2>Your University & College Search</h2>
							<div class="margin_t">
											<form class="form-horizontal form_step_box" action="" method="post">
											
												<div class="control-group">
													<label class="control-label" for="inlineCheckboxes">When do you want to begin?</label>
													<div class="controls">
														<label class="checkbox inline">
															<input type="checkbox" name="begin_year1" id="begin_year1" value="Fall 2012"> Fall 2012
														</label>
														<label class="checkbox inline">
															<input type="checkbox" name="begin_year2" id="begin_year2" value="Spring 2013"> Spring 2013
														</label>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label" for="inlineCheckboxes">Where are you interested in studying?</label>
													<div class="controls">
														<select name="interest_study_country" id="interest_study_country" class="<?php echo $class_interest_country; ?>" onchange="fetchstates(this);">
														<option value=""> Please select </option>
														<?php 
															foreach($country as $contries)
															{
														?>
														<option value="<?php echo $contries['country_id']; ?>"> <?php echo $contries['country_name']; ?> </option>
														<?php } ?>
														</select>
														<span style="color:red"> <?php echo form_error('interest_study_country'); ?><?php echo isset($errors['interest_study_country'])?$errors['interest_study_country']:''; ?> </span>
													</div>
												</div>
												<!--<div class="control-group">
													<label class="control-label">Your Name</label>
													<div class="controls docs-input-sizes">
													<select class="grid_0 margin_zero" name="title">
														<option>Mr</option>
														<option>Mrs</option>
														<option>Ms</option>
													</select>
													<input class="<?php echo $class_firstname; ?>" type="text" placeholder="First Name" name="first_name">
													<input class="<?php echo $class_lastname; ?>" type="text" placeholder="Last Name" name="last_name">
													<span style="color:red"> <?php echo form_error('first_name'); ?><?php echo isset($errors['first_name'])?$errors['first_name']:''; ?> </span>
													<span style="color:red"> <?php echo form_error('last_name'); ?><?php echo isset($errors['last_name'])?$errors['last_name']:''; ?> </span>
													</div>
													
												</div>-->
												<!--<div class="control-group">
													<label class="control-label">Your Birth Date</label>
													<div class="controls docs-input-sizes">
														<select class="grid_0 margin_zero" name="dob_month">
															<option value="1">January</option>
															<option value="2">February</option>
															<option value="3">March</option>
															<option value="4">April</option>
															<option value="5">May</option>
															<option value="6">June</option>
															<option value="7">July</option>
															<option value="8">August</option>
															<option value="9">September</option>
															<option value="10">October</option>
															<option value="11">November</option>
															<option value="12">December</option>
														</select>
														<input class="<?php echo $class_dob_day; ?>" type="text" placeholder="Day" name="dob_day">
														<input class="<?php echo $class_dob_year; ?>" type="text" placeholder="Year" name="dob_year">
														<span style="color:red"> <?php echo form_error('dob_day'); ?><?php echo isset($errors['dob_day'])?$errors['dob_day']:''; ?> </span> 
													<span style="color:red"> <?php echo form_error('dob_year'); ?><?php echo isset($errors['dob_year'])?$errors['dob_year']:''; ?> </span>
													</div>
													
												</div>-->
												<!--<div class="control-group">
													<label class="control-label">Country</label>
													<div class="controls docs-input-sizes">
														<select class="span3">
															<option value="afghanistan">Afghanistan</option>
															<option value="bangladesh">Bangladesh</option>
															<option value="bhutan">Bhutan</option>
															<option value="brazil">Brazil</option>
															<option value="canada">Canada</option>
															<option value="china">China</option>
															<option value="germany">Germany</option>
															<option value="ghana">Ghana</option>
															<option value="indonesia">Indonesia</option>
															<option value="kenya">Kenya</option>
															<option value="korea_republic_of">Korea Republic Of</option>
															<option value="mexico">Mexico</option>
															<option value="nepal">Nepal</option>
															<option value="nigeria">Nigeria</option>
															<option value="pakistan">Pakistan</option>
															<option value="philippines">Philippines</option>
															<option value="saudi_arabia">Saudi Arabia</option>
															<option value="sri_lanka">Sri Lanka</option>
															<option value="turkey">Turkey</option>
															<option value="united_arab_emirates">United Arab Emirates</option>
															<option value="united_kingdom">United Kingdom</option>
															<option value="united_states">United States</option><option value="" disabled="disabled">-------------</option>
															<option value="afghanistan">Afghanistan</option>
															<option value="aland_islands">Aland Islands</option>
															<option value="albania">Albania</option>
															<option value="algeria">Algeria</option>
															<option value="american_samoa">American Samoa</option>
															<option value="andorra">Andorra</option>
															<option value="angola">Angola</option>
															<option value="anguilla">Anguilla</option>
															<option value="antarctica">Antarctica</option>
															<option value="antigua_and_barbuda">Antigua And Barbuda</option>
															<option value="argentina">Argentina</option>
															<option value="armenia">Armenia</option>
															<option value="aruba">Aruba</option>
															<option value="australia">Australia</option>
															<option value="austria">Austria</option>
															<option value="azerbaijan">Azerbaijan</option>
															<option value="bahamas">Bahamas</option>
															<option value="bahrain">Bahrain</option>
															<option value="bangladesh">Bangladesh</option>
															<option value="barbados">Barbados</option>
															<option value="belarus">Belarus</option>
															<option value="belgium">Belgium</option>
															<option value="belize">Belize</option>
															<option value="benin">Benin</option>
															<option value="bermuda">Bermuda</option>
															<option value="bhutan">Bhutan</option>
															<option value="bolivia">Bolivia</option>
															<option value="bosnia_and_herzegowina">Bosnia And Herzegowina</option>
															<option value="botswana">Botswana</option>
															<option value="bouvet_island">Bouvet Island</option>
															<option value="brazil">Brazil</option>
															<option value="british_indian_ocean_territory">British Indian Ocean Territory</option>
															<option value="brunei_darussalam">Brunei Darussalam</option>
															<option value="bulgaria">Bulgaria</option>
															<option value="burkina_faso">Burkina Faso</option>
															<option value="burundi">Burundi</option>
															<option value="cambodia">Cambodia</option>
															<option value="cameroon">Cameroon</option>
															<option value="canada">Canada</option>
															<option value="cape_verde">Cape Verde</option>
															<option value="cayman_islands">Cayman Islands</option>
															<option value="central_african_republic">Central African Republic</option>
															<option value="chad">Chad</option>
															<option value="chile">Chile</option>
															<option value="china">China</option>
															<option value="christmas_island">Christmas Island</option>
															<option value="cocos_keeling_islands">Cocos Keeling Islands</option>
															<option value="colombia">Colombia</option>
															<option value="comoros">Comoros</option>
															<option value="congo">Congo</option>
															<option value="congo_the_democratic_republic_of_the">Congo The Democratic Republic Of The</option>
															<option value="cook_islands">Cook Islands</option>
															<option value="costa_rica">Costa Rica</option>
															<option value="cote_divoire">Cote Divoire</option>
															<option value="croatia">Croatia</option>
															<option value="cuba">Cuba</option>
															<option value="cyprus">Cyprus</option>
															<option value="czech_republic">Czech Republic</option>
															<option value="denmark">Denmark</option>
															<option value="djibouti">Djibouti</option>
															<option value="dominica">Dominica</option>
															<option value="dominican_republic">Dominican Republic</option>
															<option value="ecuador">Ecuador</option>
															<option value="egypt">Egypt</option>
															<option value="el_salvador">El Salvador</option>
															<option value="equatorial_guinea">Equatorial Guinea</option>
															<option value="eritrea">Eritrea</option>
															<option value="estonia">Estonia</option>
															<option value="ethiopia">Ethiopia</option>
															<option value="falkland_islands_malvinas">Falkland Islands Malvinas</option>
															<option value="faroe_islands">Faroe Islands</option>
															<option value="fiji">Fiji</option>
															<option value="finland">Finland</option>
															<option value="france">France</option>
															<option value="french_guiana">French Guiana</option>
															<option value="french_polynesia">French Polynesia</option>
															<option value="french_southern_territories">French Southern Territories</option>
															<option value="gabon">Gabon</option>
															<option value="gambia">Gambia</option>
															<option value="georgia">Georgia</option>
															<option value="germany">Germany</option>
															<option value="ghana">Ghana</option>
															<option value="gibraltar">Gibraltar</option>
															<option value="greece">Greece</option>
															<option value="greenland">Greenland</option>
															<option value="grenada">Grenada</option>
															<option value="guadeloupe">Guadeloupe</option>
															<option value="guam">Guam</option>
															<option value="guatemala">Guatemala</option>
															<option value="guernsey">Guernsey</option>
															<option value="guinea">Guinea</option>
															<option value="guinea_bissau">Guinea Bissau</option>
															<option value="guyana">Guyana</option>
															<option value="haiti">Haiti</option>
															<option value="heard_and_mcdonald_islands">Heard And Mcdonald Islands</option>
															<option value="holy_see_vatican_city_state">Holy See Vatican City State</option>
															<option value="honduras">Honduras</option>
															<option value="hong_kong">Hong Kong</option>
															<option value="hungary">Hungary</option>
															<option value="iceland">Iceland</option>
															<option selected="selected" value="india">India</option>
															<option value="indonesia">Indonesia</option>
															<option value="iran_islamic_republic_of">Iran Islamic Republic Of</option>
															<option value="iraq">Iraq</option>
															<option value="ireland">Ireland</option>
															<option value="isle_of_man">Isle Of Man</option>
															<option value="israel">Israel</option>
															<option value="italy">Italy</option>
															<option value="jamaica">Jamaica</option>
															<option value="japan">Japan</option>
															<option value="jersey">Jersey</option>
															<option value="jordan">Jordan</option>
															<option value="kazakhstan">Kazakhstan</option>
															<option value="kenya">Kenya</option>
															<option value="kiribati">Kiribati</option>
															<option value="korea_democratic_peoples_republic_of">Korea Democratic Peoples Republic Of</option>
															<option value="korea_republic_of">Korea Republic Of</option>
															<option value="kuwait">Kuwait</option>
															<option value="kyrgyzstan">Kyrgyzstan</option>
															<option value="lao_peoples_democratic_republic">Lao Peoples Democratic Republic</option>
															<option value="latvia">Latvia</option>
															<option value="lebanon">Lebanon</option>
															<option value="lesotho">Lesotho</option>
															<option value="liberia">Liberia</option>
															<option value="libyan_arab_jamahiriya">Libyan Arab Jamahiriya</option>
															<option value="liechtenstein">Liechtenstein</option>
															<option value="lithuania">Lithuania</option>
															<option value="luxembourg">Luxembourg</option>
															<option value="macao">Macao</option>
															<option value="macedonia_the_former_yugoslav_republic_of">Macedonia The Former Yugoslav Republic Of</option>
															<option value="madagascar">Madagascar</option>
															<option value="malawi">Malawi</option>
															<option value="malaysia">Malaysia</option>
															<option value="maldives">Maldives</option>
															<option value="mali">Mali</option>
															<option value="malta">Malta</option>
															<option value="marshall_islands">Marshall Islands</option>
															<option value="martinique">Martinique</option>
															<option value="mauritania">Mauritania</option>
															<option value="mauritius">Mauritius</option>
															<option value="mayotte">Mayotte</option>
															<option value="mexico">Mexico</option>
															<option value="micronesia_federated_states_of">Micronesia Federated States Of</option>
															<option value="moldova_republic_of">Moldova Republic Of</option>
															<option value="monaco">Monaco</option>
															<option value="mongolia">Mongolia</option>
															<option value="montenegro">Montenegro</option>
															<option value="montserrat">Montserrat</option>
															<option value="morocco">Morocco</option>
															<option value="mozambique">Mozambique</option>
															<option value="myanmar">Myanmar</option>
															<option value="namibia">Namibia</option>
															<option value="nauru">Nauru</option>
															<option value="nepal">Nepal</option>
															<option value="netherlands">Netherlands</option>
															<option value="netherlands_antilles">Netherlands Antilles</option>
															<option value="new_caledonia">New Caledonia</option>
															<option value="new_zealand">New Zealand</option>
															<option value="nicaragua">Nicaragua</option>
															<option value="niger">Niger</option>
															<option value="nigeria">Nigeria</option>
															<option value="niue">Niue</option>
															<option value="norfolk_island">Norfolk Island</option>
															<option value="northern_mariana_islands">Northern Mariana Islands</option>
															<option value="norway">Norway</option>
															<option value="oman">Oman</option>
															<option value="pakistan">Pakistan</option>
															<option value="palau">Palau</option>
															<option value="palestinian_territory_occupied">Palestinian Territory Occupied</option>
															<option value="panama">Panama</option>
															<option value="papua_new_guinea">Papua New Guinea</option>
															<option value="paraguay">Paraguay</option>
															<option value="peru">Peru</option>
															<option value="philippines">Philippines</option>
															<option value="pitcairn">Pitcairn</option>
															<option value="poland">Poland</option>
															<option value="portugal">Portugal</option>
															<option value="puerto_rico">Puerto Rico</option>
															<option value="qatar">Qatar</option>
															<option value="reunion">Reunion</option>
															<option value="romania">Romania</option>
															<option value="russian_federation">Russian Federation</option>
															<option value="rwanda">Rwanda</option>
															<option value="saint_barthelemy">Saint Barthelemy</option>
															<option value="saint_helena">Saint Helena</option>
															<option value="saint_kitts_and_nevis">Saint Kitts And Nevis</option>
															<option value="saint_lucia">Saint Lucia</option>
															<option value="saint_pierre_and_miquelon">Saint Pierre And Miquelon</option>
															<option value="saint_vincent_and_the_grenadines">Saint Vincent And The Grenadines</option>
															<option value="samoa">Samoa</option>
															<option value="san_marino">San Marino</option>
															<option value="sao_tome_and_principe">Sao Tome And Principe</option>
															<option value="saudi_arabia">Saudi Arabia</option>
															<option value="senegal">Senegal</option>
															<option value="serbia">Serbia</option>
															<option value="seychelles">Seychelles</option>
															<option value="sierra_leone">Sierra Leone</option>
															<option value="singapore">Singapore</option>
															<option value="slovakia">Slovakia</option>
															<option value="slovenia">Slovenia</option>
															<option value="solomon_islands">Solomon Islands</option>
															<option value="somalia">Somalia</option>
															<option value="south_africa">South Africa</option>
															<option value="south_georgia_and_the_south_sandwich_islands">South Georgia And The South Sandwich Islands</option>
															<option value="spain">Spain</option>
															<option value="sri_lanka">Sri Lanka</option>
															<option value="sudan">Sudan</option>
															<option value="suriname">Suriname</option>
															<option value="svalbard_and_jan_mayen">Svalbard And Jan Mayen</option>
															<option value="swaziland">Swaziland</option>
															<option value="sweden">Sweden</option>
															<option value="switzerland">Switzerland</option>
															<option value="syrian_arab_republic">Syrian Arab Republic</option>
															<option value="taiwan_province_of_china">Taiwan Province Of China</option>
															<option value="tajikistan">Tajikistan</option>
															<option value="tanzania_united_republic_of">Tanzania United Republic Of</option>
															<option value="thailand">Thailand</option>
															<option value="timor_leste">Timor Leste</option>
															<option value="togo">Togo</option>
															<option value="tokelau">Tokelau</option>
															<option value="tonga">Tonga</option>
															<option value="trinidad_and_tobago">Trinidad And Tobago</option>
															<option value="tunisia">Tunisia</option>
															<option value="turkey">Turkey</option>
															<option value="turkmenistan">Turkmenistan</option>
															<option value="turks_and_caicos_islands">Turks And Caicos Islands</option>
															<option value="tuvalu">Tuvalu</option>
															<option value="uganda">Uganda</option>
															<option value="ukraine">Ukraine</option>
															<option value="united_arab_emirates">United Arab Emirates</option>
															<option value="united_kingdom">United Kingdom</option>
															<option value="united_states">United States</option>
															<option value="united_states_minor_outlying_islands">United States Minor Outlying Islands</option>
															<option value="uruguay">Uruguay</option>
															<option value="uzbekistan">Uzbekistan</option>
															<option value="vanuatu">Vanuatu</option>
															<option value="venezuela">Venezuela</option>
															<option value="viet_nam">Viet Nam</option>
															<option value="virgin_islands_british">Virgin Islands British</option>
															<option value="virgin_islands_us">Virgin Islands Us</option>
															<option value="wallis_and_futuna">Wallis And Futuna</option>
															<option value="western_sahara">Western Sahara</option>
															<option value="yemen">Yemen</option>
															<option value="zambia">Zambia</option>
															<option value="zimbabwe">Zimbabwe</option>
														</select>
													</div>
												</div>-->
												<div class="control-group">
													<label class="control-label" for="inlineCheckboxes">Home Address</label>
														<div class="controls">
															<input class="<?php echo $class_home_adress; ?>" type="text" name="home_address">
															<span style="color:red"> <?php echo form_error('home_address'); ?><?php echo isset($errors['home_address'])?$errors['home_address']:''; ?> </span>
														</div>
														
												</div>
												<div class="control-group">
													<label class="control-label">State</label>
													<div class="controls docs-input-sizes">
														<select class="<?php echo $class_state; ?>" name="state" id="state" onchange="fetchcities(this);">
															<option value="">Please Select</option>
															
														</select>
														<span style="color:red"> <?php echo form_error('state'); ?><?php echo isset($errors['state'])?$errors['state']:''; ?> </span>
													</div>
													
												</div>
												<div class="control-group">
													<label class="control-label">City</label>
													<div class="controls docs-input-sizes">
														<select class="<?php echo $class_city; ?>" name="city" id="city">
															<option value="">Please Select</option>
															
														</select>
														<span style="color:red"> <?php echo form_error('city'); ?><?php echo isset($errors['city'])?$errors['city']:''; ?> </span>
													</div>
													
												</div>
												<!--<div class="control-group">
													<label class="control-label">Phone Number</label>
													<div class="controls docs-input-sizes">
														<input class="<?php echo $class_phone; ?>" type="text" name="phone">
														<select class="span2" name="phone_type">
															<option value="Mobile">Mobile</option>
															<option selected="selected" value="Home">Home</option>
															<option value="Work">Work</option>
														</select>
														<span style="color:red"> <?php echo form_error('phone'); ?><?php echo isset($errors['phone'])?$errors['phone']:''; ?> </span>
													</div>
													
												</div>-->
												<div class="control-group">
													<label class="control-label">Area of Interest</label>
													<div class="controls docs-input-sizes">
														<select class="<?php echo $class_area_interest; ?>" name="area_interest">
															<option selected="selected" value="">— Please Select —</option>
															<?php 
															foreach($area_interest as $interest)
															{ ?>
																<option value="<?php echo $interest['prog_parent_id']; ?>"> <?php echo $interest['program_parent_name']; ?> </option>
															<?php } ?>
														</select>
														<span style="color:red"> <?php echo form_error('area_interest'); ?><?php echo isset($errors['area_interest'])?$errors['area_interest']:''; ?> </span>
													</div>
													
												</div>
												<!--<div class="control-group">
													<label class="control-label">Choose preferred program type</label>
													<div class="controls docs-input-sizes">
														<select class="span3" name="prefer_prog_type">
															<option selected="selected" value="">— Please Select —</option>
															<option value="Online|OnCampus">Both</option>
															<option value="Online">Distance Learning</option>
															<option value="OnCampus">Full Time</option>
														</select>
													</div>
												</div>-->
												<div class="control-group">
													<label class="control-label">Current Education Level</label>
													<div class="controls docs-input-sizes">
														<select class="<?php echo $class_current_educ; ?>" name="current_educ_level">
															<option selected="selected" value="">— Please Select —</option>
															<?php foreach($educ_level as $education_level) { ?>
																<option value="<?php echo $education_level['prog_edu_lvl_id']; ?>"> <?php echo $education_level['educ_level']; ?> </option>
															<?php } ?>
														</select>
														<span style="color:red"> <?php echo form_error('current_educ_level'); ?><?php echo isset($errors['current_educ_level'])?$errors['current_educ_level']:''; ?> </span>
													</div>
													
												</div>
												<div class="control-group">
													<label class="control-label">Next Education Level</label>
													<div class="controls docs-input-sizes">
														<select class="<?php echo $class_next_educ; ?>" name="next_educ_level">
															<option selected="selected" value="">— Please Select —</option>
															<?php foreach($educ_level as $education_level) { 
																	
																	if($education_level['prog_edu_lvl_id'] !='2' ) {
															?>
															
																<option value="<?php echo $education_level['prog_edu_lvl_id']; ?>"> <?php echo $education_level['educ_level']; ?> </option>
															<?php } } ?>
														</select>
														<span style="color:red"> <?php echo form_error('next_educ_level'); ?><?php echo isset($errors['next_educ_level'])?$errors['next_educ_level']:''; ?> </span>
													</div>
													
												</div>
												<!--<div class="control-group">
													<label class="control-label" for="appendedInput">Appended text</label>
													<div class="controls">
														<div class="input-append">
															<input class="span3" id="appendedInput" size="16" type="text"><span>%</span>
														</div>
													</div>
												</div>-->
												<div class="control-group">
													<label class="control-label">Academic Exam Scores</label>
													<div class="controls docs-input-sizes">
														<div class="margin_bot">
															<select class="grid_0 margin_zero" name="academic_exam_type1">
																<option value="SAT">SAT</option>
																<option value="ACT">ACT</option>
																<option value="GRE">GRE</option>
																<option value="GMAT">GMAT</option>
															</select>
															<input class="<?php echo $class_academic_exam_score; ?>" type="text" name="academic_exam_score1"/>
															<a id="academic_add" style="cursor:pointer;">Add Another »</a><br/>
														</div>
														<span id="academic_another" style="display:none;">
														
														<select class="grid_0 margin_zero" name="academic_exam_type2">
															<option value="SAT">SAT</option>
															<option value="ACT">ACT</option>
															<option value="GRE">GRE</option>
															<option value="GMAT">GMAT</option>
														</select>
														<input class="span2" type="text" name="academic_exam_score2">
														</span>
														<span style="color:red"> <?php echo form_error('academic_exam_score1'); ?><?php echo isset($errors['academic_exam_score1'])?$errors['academic_exam_score1']:''; ?> </span>
														<!--<a href="#academic_scores">Add Another »</a>-->
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">English Proficiency Exam (Optional)</label>
													<div class="controls docs-input-sizes">
														<div class="margin_bot">
															<select class="span2" name="eng_prof_exam_type1">
																<option selected="selected" value="IELTS-Academic">IELTS-Academic</option>
																<option value="TOEFL-iBT">TOEFL-iBT</option>
																<option value="TOEFL-PBT">TOEFL-PBT</option>
																<option value="TOEFL-CBT">TOEFL-CBT</option>
															</select>
															<input class="grid_0 margin_zero" type="text" name="eng_prof_exam_score1">
															<a id="eng_prof_add" style="cursor:pointer;">Add Another »</a><br/>
														</div>
														<span id="eng_prof_another" style="display:none;">
														<select class="span3" name="eng_prof_exam_type2">
															<option value="IELTS-Academic">IELTS-Academic</option>
															<option selected="selected" value="TOEFL-iBT">TOEFL-iBT</option>
															<option value="TOEFL-PBT">TOEFL-PBT</option>
															<option value="TOEFL-CBT">TOEFL-CBT</option>
														</select>
														<input class="grid_0 margin_zero" type="text" name="eng_prof_exam_score2">
														</span>
														<!--<a href="#academic_scores">Add Another »</a>-->
														<p class="help-block">Entering your Exam Scores is the best way to let the top schools around the world know that you have the required skills to study abroad.</p>
													</div>
												</div>
												<!--<div class="control-group">
													<label class="control-label" for="inlineCheckboxes">When do you want to begin?</label>
													<div class="controls">
														<label class="radio inline">
															<input type="radio" name="want_begin" id="want_begin" value="yes" checked="">Yes
														</label>
														<label class="radio inline">
															<input type="radio" name="want_begin" id="want_begin" value="No" checked=""> No
														</label>
													</div>
												</div>-->
												<div class="controls">
													<input type="submit" class="btn btn-success" name="submit_step_data" value="Continue">
												</div>
											</form>
										</div>
						</div>
					</div>
					<div class="float_r span3">
						<img src="<?php echo "$base$img_path" ?>/banner_img.png">
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="float_r span3">
					<img src="<?php echo "$base$img_path" ?>/banner_img.png">
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<script>
function fetchstates(a)
{
var cid=$("#interest_study_country option:selected").val();
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>auth/state_list_ajax/"+cid,
   data: '',
   cache: false,
   success: function(msg)
   {
    $('#state').attr('disabled', false);
	$('#state').html(msg);
   }
   });
}
function fetchcities(a)
{
var sid=$("#state option:selected").val();
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>auth/city_list_ajax/"+sid,
   data: '',
   cache: false,
   success: function(msg)
   {
    $('#city').attr('disabled', false);
	$('#city').html(msg);
   }
   });
}

// show another controllers
$('#academic_add').click(function(){
$('#academic_another').css("display","block");
});

$('#eng_prof_add').click(function(){
$('#eng_prof_another').css("display","block");
});
</script>