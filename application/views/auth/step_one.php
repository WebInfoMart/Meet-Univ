<?php
$class_email='';
$class_agree='';
$error_email = form_error('step_email');
$error_agree = form_error('step_email');

if($error_email != '') { $class_email = 'focused_error_stepone'; } else { $class_email='span3'; }

if($error_agree != '') { $class_agree = 'focused_error_stepone'; } else { $class_agree=''; }
?>
	<div>
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body_container">
			<div class="row show-grid">
				<div class="span13">
					<div class="alert alert-message message" data-alert="alert">
						<a class="close" data-dismiss="alert">&times;</a>
						<div>
							<div class="float_l"><h2>Welcome! Let&#8217;s get started by</h2></div>
							<div class="float_r close_cont"> <span> Don't want our help? </span> Close Tips </div>
							<div class="clearfix"></div>
						</div>
						<nav id="help-tools">
							<ul>
								<li class="text_dec">1) Step 1</li>
								<li><a href="#">2) Step 2</a></li>
								<li><a href="#">3) Step 3</a></li>
								<li><a href="#">4) Step 4</a></li>
							</ul>
						</nav>
					</div>
					<div>
						<div class="span8 margin_zero padding">
							<div class="step_box">
									<h1>Search & Apply to 100+ Colleges & Universities</h1>
										<div class="margin_t">
											<h2>Basic Info</h2>
											<form class="form-horizontal form_step_box" action="find_college" method="post">
												<div class="control-group">
													<label class="control-label">Your Home Country</label>
													<div class="controls docs-input-sizes">
														<select class="span3" name="home_country">
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
												</div>
												<div class="control-group">
													<label class="control-label" for="inlineCheckboxes">Your Email Address</label>
														<div class="controls">
															<input class="<?php echo $class_email; ?>" type="text" name="step_email">
															<span style="color:red"><?php echo form_error('step_email'); ?><?php echo isset($errors['step_email'])?$errors['step_email']:''; ?></span>
														</div>
												</div>
												<div class="control-group">
													<label class="control-label" for="inlineCheckboxes"></label>
													<div class="controls">
														<label class="checkbox inline">
															<input type="checkbox" name="iagree" id="iagree" value="agree">I agree to the  <a>Service Agreement</a>  &  <a>Privacy Policy</a>
														</label>
														<span style="color:red"><?php echo form_error('iagree'); ?><?php echo isset($errors['iagree'])?$errors['iagree']:''; ?></span>
													</div>
												</div>
												<div class="controls">
													<input type="submit" value="Continue" name="process_step_one" class="btn btn-success" >
												</div>
											</form>
										</div>
									<div class="clearfix"></div>
							</div>
						</div>
						<div class="span15 float_r">
							<img src="images/banner_img.png">
						</div>
					<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	