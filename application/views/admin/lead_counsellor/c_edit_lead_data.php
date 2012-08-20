<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="X-UA-Compatible" content="IE=7" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		
	<title>Adminium - Modern Admin Panel Interface</title>	
	<meta name="description" content="." />
	<meta name="keywords" content="." />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js" type="text/javascript"></script>
	<link rel="stylesheet" href="http://meetuniv.com/css/admin/style.css">
	<link rel="stylesheet" href="http://meetuniv.com/css/admin/visualize.css">
	<link rel="stylesheet" href="http://meetuniv.com/css/admin/date_input.css">
	<link rel="stylesheet" href="http://meetuniv.com/css/admin/jquery.minicolors.css">
	<link rel="stylesheet" href="http://meetuniv.com/css/admin/admin.css">
	<link rel="stylesheet" href="http://meetuniv.com/css/admin/jquery.autocomplete.css">
	<link rel="stylesheet" href="http://meetuniv.com/css/admin/jquery.multiSelect.css">

<script type="text/javascript">
 var globalid=0;
$(document).ready(function(){
 $(".slidingDiv").hide();
 $(".load").hide();
	
    $('.show_hide').click(function(){
	//$(".hiding-effect").hide();
		//alert($(this).parent().prev().find('.slidingDiv').html());
		if($(this).parent().prev().find('.slidingDiv').is(':visible'))
		{
		$("#view_more_"+globalid).hide();
		$(".slidingDiv").slideUp('slow');
		//$(".hiding-effect").show();
		}
		else
		{
		//$(".hiding-effect").hide();
		$("#view_more_"+globalid).hide();
		$(".slidingDiv").slideUp('slow');
		//$(".hiding-effect").show();
		$(this).parent().prev().find('.slidingDiv').slideToggle();
		}
	
    });
	$('.abc').click(function(){
		  globalid=$(this).attr('id');
	      $("#img_"+globalid).show();
	      setTimeout('abc()',1000);
		
    });
	
	 $('.input-xlarge').keypress(function(e){
	
			if ( event.which == 13 ) {
			alert('enter');
			//event.preventDefault();
			}
    });
 
});
 function abc()
 {
 $("#img_"+globalid).hide();
 $("#view_more_"+globalid).show(1000);
 }
</script>

	<!--[if lt IE 9]>
	<style type="text/css" media="all"> @import url("css/ie.css"); </style>
	<![endif]-->
	

</head>
<body>

<!--
	<div id="header_id">
		<div class="span61 float_r margin2">
			<div class="float_l border_holder">
				<img src="../images/admin/images/user.png" alt="User" title="User"/>
				<span class="margin_l">Hello Administrator</span>
			</div>
			<div class="float_l border_holder">
				<img src="../images/admin/images/setting.png" alt="User" title="User"/>
			</div>
			<div class="float_l border_holder">
				<img src="../images/admin/images/setting.png" alt="User" title="User"/>
			</div>
			<div class="float_l border_holder border_beta">
				logout
			</div>
		</div>
	</div>			<!-- #header ends -->
	<!--
		<div class="float_l sidebar">
		<div class="search_box">
			<img src="../images/admin/images/search_icon.png" class="search_input_set"><input type="text" name="search" value="search" class="search_input">
		</div>
		<div class="menu">
			<ul id="nav">
                <li class="active"><a href="#"><img src="../images/admin/images/home_icon.png" /> <span>Dashboard</span></a></li>
                <li><a href="#"><img src="../images/admin/images/paged_icon.png" /><span>Pages</span></a>
                </li>
               <li><a href="#"><img src="../images/admin/images/side_user_icon.png" /><span>Users</span></a>
                </li>
                <li><a href="#"><img src="../images/admin/images/edit_icon.png" /><span>Articles</span></a></li>
                <li><a href="#"><img src="../images/admin/images/cal_icon.png" /><span>Events</span></a></li>
                <li><a href="#"><img src="../images/admin/images/lib_icon.png" /><span>Manage Universities</span></a></li> 
				<li><a href="#"><img src="../images/admin/images/img_icon.png" /><span>Manage Home Gallery</span></a></li> 
				<li><a href="#"><img src="../images/admin/images/book_icon.png" /><span>Proagram/Courses</span></a></li> 
				<li><a href="#"><img src="../images/admin/images/book_icon.png" /><span>University/Courses</span></a></li>
				<li><a href="#"><img src="../images/admin/images/img_icon.png" /><span>University Gallery</span></a></li>
				<li><a href="#"><img src="../images/admin/images/clip_icon.png" /><span>Manage Univ/Proagram</span> </a></li>
				<li><a href="#"><img src="../images/admin/images/clip_icon.png" /><span>Manage Univ/Users</span> </a></li>
				<li><a href="#"><img src="../images/admin/images/setting.png" /><span>Settings</span> </a></li>
				<li><a href="#"><img src="../images/admin/images/bulb_icon.png" /><span>Supports</span></a></li>
            </ul>
		</div>
	</div>		<!-- #sidebar ends -->
	<div id="content" class="data_shif">

<?php print_r($country); ?>	
		<div class="counsel_next_bg span13 margin_delta">
			<div class="float_l span21 margin_delta">
				<img src="images/user_img.png" class="user_img"/>
			</div>
			<div class="float_r span101">
				<div class="float_l span16 margin_delta">
					<div class="control-group1">
						<label class="control-data" for="input01">First Name: </label>
						<div class="input-data">
							<span   class="selector"><?php echo $verify_teleleads['v_fullname'];  ?></span>
							<input type="text" id="name" name="name" class="edit_box" value="<?php echo $verify_teleleads['v_fullname'];  ?>"/>
						</div>
					</div>
				</div>
				<div class="float_l span16">
					<div class="control-group1">
						<label class="control-data" for="input01">DOB:</label>
						<div class="input-data">
							<span  class="dob selector"><?php echo $verify_teleleads['v_dob'];  ?> </span>
							<input type="text" id="dob" name="dob" class="edit_box" value="<?php echo $verify_teleleads['v_dob'];  ?>"/>
						</div>
					</div>
				</div>
				<div class="float_l span16">
					<div class="control-group1">
						<label class="control-data" for="input01"> Email: </label>
						<div class="input-data">
						<span class="selector"><?php echo $verify_teleleads['v_email'];  ?> </span>
						<input type="text"name="Email" id="Email" class="edit_box" value="<?php echo $verify_teleleads['v_email'];  ?>"/>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="bottom_line_second margin_b"></div>
				<div class="float_l span16">
					<div class="control-group1">
						<label class="control-data" for="input01">Country: </label>
						<div class="input-data">
						<span class="country_drop selector"><?php echo $verify_teleleads['country_name'];  ?> </span>
						<Select  name="Country" id="Country" class='edit_box'><option>Select Country</option>  </select>
						</div>
					</div>
				</div>
				<div class="float_l span16">
					<div class="control-group1">
						<label class="control-data" for="input01">State: </label>
						<div class="input-data">
						<span class="state_drop selector"><?php echo $verify_teleleads['statename'];  ?> </span>
						
						<Select  name="State" id="State" class='edit_box'><option>Select Country</option>  </select>
						</div>
					</div>
				</div>
				<div class="float_l span16 margin_delta">
					<div class="control-group1">
						<label class="control-data" for="input01"> City: </label>
						<div class="input-data">
						<span class="city_drop selector"><?php echo $verify_teleleads['cityname'];  ?> </span>
						<Select  name="city" id="city" class='edit_box'><option>Select Country</option>  </select>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="bottom_line_second margin_b"></div>
				<div class="float_l span16">
					<div class="control-group1">
						<label class="control-data" for="input01">Phone: </label>
						<div class="input-data">
						<span  class="selector"><?php echo $verify_teleleads['v_phone'];  ?> </span>
						<input type="text" name="Phone" id="Phone" class="edit_box" value="<?php echo $verify_teleleads['v_phone'];  ?>"/>
						</div>
					</div>
				</div>
				<div class="float_l span16">
					<div class="control-group1">
						<label class="control-data" for="input01"> Enroll K12: </label>
						<div class="input-data">
						<span  class="selector"><?php echo $verify_teleleads['v_enroll_key'];  ?> </span>
						<input name="Enroll" id="Enroll" id="Phone" class="edit_box" value="<?php echo $verify_teleleads['v_enroll_key'];  ?>"/>
						</div>
					</div>
				</div>
				<div class="float_l span16 margin_delta">
					<div class="control-group1">
						<label class="control-data" for="input01"> Intrested country: </label>
						<div class="input-data">
								<?php 			
				if($verify_teleleads['v_interested_country']!='' && $verify_teleleads['v_interested_country']!='0')
				{
				$interested_cntry=explode(",",$verify_teleleads['v_interested_country']);
				foreach($interested_cntry as $interested_cntry_arr) 
				{ 
					if($interested_cntry_arr!='0' )
					{
					$cnt_name=$this->lead_tele_model->country_name_by_id($interested_cntry_arr);				
				?>
				<span><?php echo ucwords($cnt_name['country_name']); ?>
				<input type="hidden" name="country_ids[]" id="country_<?php echo $interested_cntry_arr; ?>" value="<?php echo $interested_cntry_arr; ?>"></span>
				<?php
				}}
				}			
				?>
				<Select  name="Intrestedcount" id="Interestedcount" class='edit_box'><option>Select Country</option>  </select>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="bottom_line_second"></div>
			</div>
			
			<div class="float_l span61 margin_delta">
				<div class="control-group1">
					<label class="big-data padding_alpha" for="input01">Intrested in courses: </label>
					<div class="input-left">
						<span  class="courses selector"><?php echo $verify_teleleads['course_name'];  ?></span>
						<Select name="courses" id="courses" class='edit_box'><option>Select Country</option>  </select>
					</div>
				</div>
			</div>
			<div class="float_l span61">
				<div class="control-group1">
					<label class="big-data padding_alpha" for="input01">When do you want to begin:  </label>
					<div class="input-left">
				<span name="begin" id="begin" class="selector2 selector"><?php echo $verify_teleleads['v_enroll_date'];?></span>
						<input name="Enroll" id="Enroll" id="Phone" class="edit_box" value="<?php echo $verify_teleleads['v_enroll_date'];  ?>"/>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
				<div class="bottom_line1"></div>
				<div class="float_l span61 margin_delta">
				<div class="control-group1">
					<label class="big-data padding_alpha" for="input01">Exam score:  </label>
					<div class="input-left">
						<span class="selector2 selector"><?php echo $verify_teleleads['v_aggregate_percentage'];  ?></span>
						<input name="Exam" id="Exam"  class="edit_box" value="<?php echo $verify_teleleads['v_aggregate_percentage'];  ?>"/>
					</div>
				</div>
			</div>
			<div class="float_l span61">
				<div class="control-group1">
					<label class="big-data padding_alpha" for="input01">The last institution that you attended:  </label>
					<div class="input-left">
						<span class="selector2 selector"><?php echo $verify_teleleads['v_last_institute'];  ?></span>
							<input name="attended" id="attended"   class="edit_box" value="<?php echo $verify_teleleads['v_last_institute'];  ?>"/>
						
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
				<div class="bottom_line1"></div>
			<div class="float_l span61 margin_delta">
				<div class="control-group1">
					<label class="big-data padding_alpha" for="input01">Other exams if any:  </label>
					<div class="input-left">
						<span  class="selector2 selector"><?php echo $verify_teleleads['v_other_exam'];  ?></span>
						<input name="Other" id="Other"  class="edit_box" value="<?php echo $verify_teleleads['v_other_exam'];  ?>"/>
						<span  class="selector2 selector"><?php echo $verify_teleleads['v_other_exam_score'];  ?></span>
						<input name="Other" id="Other"  class="edit_box" value="<?php echo $verify_teleleads['v_other_exam_score'];  ?>"/>
					</div>
				</div>
			</div>
			<div class="float_l span61">
				<div class="control-group1">
					<label class="big-data padding_alpha" for="input01">Status:  </label>
					<div class="input-left">
						<span class="Status selector"><?php echo $verify_teleleads['v_lead_status'];  ?></span>
						<input name="Status" id="Status" class="edit_box" value="<?php echo $verify_teleleads['v_lead_status'];  ?>"/>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="bottom_line1"></div>
				<div class="float_l span61 margin_delta">
				<div class="control-group1">
					<label class="big-data padding_alpha" for="input01">Current education level:  </label>
					<div class="input-left">
						<span  class="current selector"><?php echo $verify_teleleads['v_current_educ_level'];  ?></span>
						<input name="education" id="education" class="edit_box" value="<?php echo $verify_teleleads['v_current_educ_level'];  ?>"/>
					</div>
				</div>
			</div>
			<div class="float_l span61">
				<div class="control-group1">
					<label class="big-data padding_alpha" for="input01">Stage:  </label>
					<div class="input-left">
						<span name="Stage" id="Stage" class="Stage selector"><?php echo $verify_teleleads['v_enroll_key'];  ?></span>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
				<div class="bottom_line1"></div>
			<div class="float_l span61 margin_delta">
				<div class="control-group1">
					<label class="big-data padding_alpha" for="input01">Next education level:  </label>
					<div class="input-left">
						<span  class="next selector"><?php echo $verify_teleleads['v_next_educ_level'];  ?></span>
						<input name="Next" id="Next" class="edit_box" value="<?php echo $verify_teleleads['v_next_educ_level'];  ?>"/>
					</div>
				</div>
			</div>
			<div class="float_l span61">
				<div class="control-group1">
					<label class="big-data padding_alpha" for="input01">Priority:  </label>
					<div class="input-left">
						<span name="Priority" id="Priority" class="Priority selector"><?php echo $verify_teleleads['v_enroll_key'];  ?></span>
						
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
				<div class="bottom_line1"></div>
			<div class="float_l span61 margin_delta">
				<div class="control-group1">
					<label class="big-data padding_alpha" for="input01">Most Recent Overall Academic Percentage:  </label>
					<div class="input-left">
						<span  class="selector2 selector"><?php echo $verify_teleleads['v_aggregate_percentage'];  ?></span>
						<input name="Academic" id="Academic" class="edit_box" value="<?php echo $verify_teleleads['v_aggregate_percentage'];  ?>"/>
					</div>
				</div>
			</div>
			
			<div class="clearfix"></div>
				<div class="bottom_line1"></div>
			<div class="span121 margin_delta">
				<div class="control-group1">
					<label class="big-data padding_alpha" for="input01">Notes:  </label>
					<div class="input-left">
						<span  class="note selector"><?php echo $verify_teleleads['v_enroll_key'];  ?></span>
						<textarea name="Notes" id="Notes" class="edit_box"><?php echo $verify_teleleads['v_enroll_key']; ?></textarea>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="bottom_line1"></div>
			<div class="span21" style="margin-left: 406px;">
					<button class="btn_img">Save now</button>
				</div>
	</div>
</div>	
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.8.16/jquery-ui.min.js"></script>
	
	<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="js/jquery.date_input.min.js"></script>
	<script type="text/javascript" src="js/jquery.minicolors.min.js"></script>
	<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
	<script type="text/javascript" src="js/jquery.fancybox.js"></script>
	<script type="text/javascript" src="js/jquery.tipsy.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>
<script type="text/javascript">
	 $(document).ready(function() {
	 $(".edit_box").hide();
	 $(".counsel_next_bg").click(function(){
	  $(".selector").hide();
	   $(".edit_box").show();
	 });
		// $('.selector').click(function () {
			// var n = $(this).text();
			// var glob_id = $(this).attr('id');
			// var glob_name = $(this).attr('name');
			
			// $(this).parent().html("<input type='text' class='large1' value='"+n+"' id='"+glob_id+"' name='"+glob_name+"'> ");
			// $(this).removeClass('selector');
		// });
		// $('.selector2').click(function () {
			// var n = $(this).text();
			// var glob_id = $(this).attr('id');
			// var glob_name = $(this).attr('name');
			
			// $(this).parent().html("<input type='text' class='input-large input-large_set' value='"+n+"' id='"+glob_id+"' name='"+glob_name+"'> ");
			// $(this).removeClass('selector');
		// });
		// $('.country_drop').click(function () {
			// var n = $(this).text();
			// var glob_id = $(this).attr('id');
			// var glob_name = $(this).attr('name');
			
			// $(this).parent().html("<Select id='"+glob_id+"' class='large1 input-large_set' ><option>Select Country</option>  </select>");
			// $(this).removeClass('selector');
		// });
		// $('.state_drop').click(function () {
			// var n = $(this).text();
			// var glob_id = $(this).attr('id');
			// var glob_name = $(this).attr('name');
			
			// $(this).parent().html("<Select id='"+glob_id+"' class='large1 input-large_set' ><option>Select Country</option>  </select>");
			// $(this).removeClass('selector');
		// });
		// $('.city_drop').click(function () {
			// var n = $(this).text();
			// var glob_id = $(this).attr('id');
			// var glob_name = $(this).attr('name');
			
			// $(this).parent().html("<Select id='"+glob_id+"' class='large1 input-large_set' ><option>Select Country</option>  </select>");
			// $(this).removeClass('selector');
		// });
		// $('.Intrestedcount').click(function () {
			// var n = $(this).text();
			// var glob_id = $(this).attr('id');
			// var glob_name = $(this).attr('name');
			
			// $(this).parent().html("<Select id='"+glob_id+"' class='selector large1 input-large_set' ><option>Select Country</option>  </select>");
			// $(this).removeClass('selector');
		// });
		// $('.courses').click(function () {
			// var n = $(this).text();
			// var glob_id = $(this).attr('id');
			// var glob_name = $(this).attr('name');
			
			// $(this).parent().html("<Select id='"+glob_id+"' class='select_input input-large_set'><option>Select Country</option>  </select> ");
			// $(this).removeClass('selector');
		// });
		// $('.Status').click(function () {
			// var n = $(this).text();
			// var glob_id = $(this).attr('id');
			// var glob_name = $(this).attr('name');
			
			// $(this).parent().html("<Select id='"+glob_id+"' class='select_input input-large_set'><option>Select Country</option>  </select> ");
			// $(this).removeClass('selector');
		// });
		// $('.Stage').click(function () {
			// var n = $(this).text();
			// var glob_id = $(this).attr('id');
			// var glob_name = $(this).attr('name');
		
			// $(this).parent().html("<Select id='"+glob_id+"' class='select_input input-large_set'><option>Select Country</option>  </select> ");
			// $(this).removeClass('selector');
		// });
		// $('.Priority').click(function () {
			// var n = $(this).text();
			// var glob_id = $(this).attr('id');
			// var glob_name = $(this).attr('name');
			
			// $(this).parent().html("<Select id='"+glob_id+"' class='select_input input-large_set'><option>Select Country</option>  </select> ");
			// $(this).removeClass('selector');
		// });
		// $('.current').click(function () {
			// var n = $(this).text();
			// var glob_id = $(this).attr('id');
			// var glob_name = $(this).attr('name');
			
			// $(this).parent().html("<Select id='"+glob_id+"' class='select_input input-large_set'><option>Select Current Education</option>  </select> ");
			// $(this).removeClass('selector');
		// });
		// $('.next').click(function () {
			// var n = $(this).text();
			// var glob_id = $(this).attr('id');
			// var glob_name = $(this).attr('name');
	
			// $(this).parent().html("<Select id='"+glob_id+"' class='select_input input-large_set'><option>Select Next Education</option>  </select> ");
			// $(this).removeClass('selector');
		// });
		// $('.dob').click(function () {
			// var n = $(this).text();
			// var glob_id = $(this).attr('id');
			// var glob_name = $(this).attr('name');
		
			// $(this).parent().html("<Select id='"+glob_id+"' class='input-large_set' style='width:42px'><option id='1'>19</option><option id='2'>2</option><option id='3'>3</option>  </select><Select id='"+glob_id+"' class='input-large_set' style='width:50px'><option id='jan'>Jan</option><option id='feb'>Feb</option><option id='Mar'>Mar</option>  </select><Select id='"+glob_id+"' class='input-large_set' style='width:58px'><option id='1'>1999</option><option id='2'>2</option><option id='3'>3</option>  </select>");
			// $(this).removeClass('selector');
		// });
		// $('.note').click(function () {
			// var n = $(this).text();
			// var glob_id = $(this).attr('id');
			// var glob_name = $(this).attr('name');
			
			// $(this).parent().html("<textarea class='span8 margin_delta' id='"+glob_id+"' name='"+glob_name+"'>" +n+ "</textarea>");
			// $(this).removeClass('selector');
		// });
 });
</script>
