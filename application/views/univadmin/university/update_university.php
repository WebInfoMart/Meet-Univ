<?php
$class_univ_name='';
$class_univ_owner='';
$class_sub_domain='';
$error_univ_name = form_error('univ_name');
$error_univ_owner = form_error('univ_owner');
if($error_univ_name != '') { $class_univ_name = 'needsfilled'; } else { $class_univ_name=''; }
if($error_univ_owner != '') { $class_univ_owner = 'needsfilled'; } else { $class_univ_owner='text'; }
?>

<!-- alert model start -->
<div class="modal hide" id="updated">				<!-- Added by satbir on 12/14/2012 -->			
	<div class="modal-header">		
		<div align="center"><h3>University Updated Successfully</h3></div>
	</div>
</div>
<div class="modal hide" id="no_changes">				<!-- Added by satbir on 12/14/2012 -->			
	<div class="modal-header">		
		<div align="center" style="color:red;"><h3>No changes found</h3></div>
	</div>
</div>
<div class="modal hide" id="denied">
	<div class="modal-header">		
		<div align="center" style="color:red;"><h3>Unable to perform action please contact admin</h3></div>
	</div>
</div>
<!-- alert model end -->
<!-- Add country city state model start -->
<div class="modal hide" id="add-country">
	
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">x</button>
			<h2>Add Your Place</h2>
			<form action="" method="post" id="form_country" id="add_country_form" >
				<p>
					<label>Country:</label><br>
					<input type="text" size="30" class="text" name="country_model" id="country_model" value=""> 
					<label class="form_error"  id="country_error"></label>
				</p>
				<p>
					<label>State:</label><br>
					<input type="text" size="30" class="text" name="state_model" id="state_model" value=""> 
					<label class="form_error"  id="state_error"></label>
				</p>
				<p>
					<label>City:</label><br>
					<input type="text" size="30" class="text" name="city_model" id="city_model" value=""> 
					<label class="form_error"  id="city_error"></label>
				</p>	
		</div>
		<div class="modal-footer">
			<input type="button" class="btn" name="addcountry" id="addcountry" value="Submit">			
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		</div>
			</form>
	
</div>

<div class="modal hide" id="add-state">
	
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">x</button>
			<h2>Add Your Place</h2>
				<form action="" method="post" id="form_state" id="add_state_form">
					<p>
						<label>Country:</label><br>
						<select class="text country_select margin_zero" name="country_model1" id="country_model1" >
							<option value="">Select Country</option>
							<?php foreach($countries as $country) { ?>
							<option value="<?php echo $country['country_id']; ?>" ><?php echo $country['country_name']; ?></option>
							<?php } ?>
						</select>
						<label class="form_error"  id="country_error1"></label>						
					</p>
						
					<p>
						<label>State:</label><br>
						<input type="text" size="30" class="text" name="state_model1" id="state_model1" value=""> 
						<label class="form_error"  id="state_error1"></label>
					
					</p>
					<p>
						<label>City:</label><br>
						<input type="text" size="30" class="text" name="city_model1" id="city_model1" value=""> 
						<label class="form_error"  id="city_error1"></label>
					
					</p>				
				
		</div>
		<div class="modal-footer">
			<input type="button" class="btn" name="addstate" id="addstate" value="Submit">			
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		</div>
			</form>
	
</div>

<div class="modal hide" id="add-city">
	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">x</button>
			<h2>Add Your Place</h2>
						<form action="" method="post" id="add_city_form" >
							<p>
								<label>Country:</label><br>
							<select class="text country_select margin_zero" name="country_model2"  id="country_model2" onchange="fetchstates('-1')">
							<option value="">Select Country</option>
							<?php foreach($countries as $country) { ?>
							<option value="<?php echo $country['country_id']; ?>" ><?php echo $country['country_name']; ?></option>
							<?php } ?>
							</select>
							<label class="form_error"  id="country_error2"></label>
							<div style="color: red;"> <?php echo form_error('country_model2'); ?><?php echo isset($errors['country_model2'])?$errors['country_model2']:''; ?> </div>
							
							</p>
							<p>
								<label>State:</label><br>
								<select class="text country_select margin_zero" name="state_model2"  id="state_model2" disabled="disabled">
								<option value="">Please Select</option>
								</select>
								<label class="form_error"  id="state_error2"></label>
							</p>
							<p>
								<label>City:</label><br>
								<input type="text" size="30" class="text" name="city_model2" id="city_model2"> 
									<label class="form_error"  id="city_error2"></label>
							</p>
							<input type="hidden" name="level_user" value="3">						
						
		</div>
		<div class="modal-footer">
			<input type="button" class="btn" name="addcity" id="addcity" value="Submit">			
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		</div>
			</form>
	
</div>
 <!-- Add country city state model end -->
 <!-- BEGIN Content -->
  <div class="content">
    <div class="container-fluid">
	<div class="responsible_navi"></div>
       <div class="row-fluid">
		<div class="span12">
			<div class="page-header">
				<h2>Update University</h2>
				<ul class="nav nav-pills">
					<li class='active'>
						<a href="#general" data-toggle="pill">General</a>
					</li>
					<li>
						<a href="#info" data-toggle="pill" id="univ">University Info.</a>
					</li>
					<li>
						<a href="#seo" data-toggle="pill">SEO</a>
					</li>
				</ul>
			</div>
<?php 
foreach($univ_detail_edit as $univ_detail_update)
{
$univ_state_id=$univ_detail_update['state_id'];
$univ_city_id=$univ_detail_update['city_id'];
?>			
          <div class="content-box">
            <div class="tab-content">
              <div class="tab-pane active" id="general">
					<form class="form-horizontal" enctype="multipart/form-data" id="update_univ_form">
						<fieldset>
							<div class="span6">
								<div class="control-group">
								<label class="control-label" for="input01">University Name</label>
								<div class="controls">
									<input type="text" name="univ_name" id="univ_name" class="input-xlarge <?php echo $class_univ_name; ?>"  size="30" value="<?php echo $univ_detail_update['univ_name']; ?>" >
									<span style="color: red;"> <?php echo form_error('univ_name'); ?><?php echo isset($errors['univ_name'])?$errors['univ_name']:''; ?> </span>
								</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="input04">University Logo</label>
									<div class="controls">
									<img src="<?php echo "$base";  ?>uploads/univ_gallery/<?php if($univ_detail_update['univ_logo_path']==''){ echo "univ_logo.png"; } else { echo $univ_detail_update['univ_logo_path']; } ?>" class="logo_img">
										<input type="file" name="userfile" id="userfile" class="input-xlarge" id="input04">
									</div>
								</div>
								<div class="control-group">
								<label class="control-label" for="input01">Phone Number</label>
								<div class="controls">
									<input type="text" name="phone_no" id="phone_no" class="input-xlarge" maxlength="10"  id="input01" value="<?php echo $univ_detail_update['phone_no']; ?>" >
								</div>
								</div>
								<div class="control-group">
								<label class="control-label" for="input01">University Email</label>
								<div class="controls">
									<input type="text" name="univ_email" id="univ_email" class="input-xlarge" value="<?php echo $univ_detail_update['univ_email']; ?>">
								</div>
								<span style="color: red;"> <?php echo form_error('univ_email'); ?><?php echo isset($errors['univ_email'])?$errors['univ_email']:''; ?> </span>
								</div><div class="control-group">
								<label class="control-label" for="input01">Web Address</label>
								<div class="controls">
									<input type="text" name="web_address" id="web_address" class="input-xlarge" value="<?php echo $univ_detail_update['univ_web']; ?>">
								</div>
								</div>
								<div class="control-group">
								<label class="control-label" for="input07">Address</label>
								<div class="controls">
									<textarea name="address" id="address" class='span12' rows='4'><?php echo $univ_detail_update['address_line1']; ?></textarea>
								</div>
								</div>
							</div>
							<div class="span6">
								<div class="control-group">
									<label class="control-label" for="input01">Country</label>
									<div class="controls">
										<select  class="inline" name="country" id="country" onchange="fetchstates(this)">
										<option value="0">- Select Country -</option>
										<?php foreach($countries as $country) { ?>
										<option value="<?php echo $country['country_id']; ?>" <?php if($country['country_id']==$univ_detail_update['country_id']){?> selected <?php }?> ><?php echo $country['country_name']; ?></option>
										<?php } ?>
										</select>
										<a href="#add-country" class="btn btn-icon tip"  data-toggle="modal" data-original-title="Add New Country">
										<i class="icon-plus"></i>
										</a>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="input04">State</label>
									<div class="controls">
									<select name="state" onchange="fetchcities(0)" id="state" disabled="disabled">
									
									
									</select>
									<a href="#add-state" class="btn btn-icon tip" data-toggle="modal" data-original-title="Add New State">
									<i class="icon-plus" id="setCountryValue"></i></a>
								</div>
								</div>
								<div class="control-group">
								<label class="control-label" for="input01">City</label>
								<div class="controls">
									<select name="city" id="city" disabled="disabled" >				
									
									</select>
									<a href="#add-city" class="btn btn-icon tip"  data-toggle="modal" data-original-title="Add New City">
									<i class="icon-plus" id="setCountryStateValue"></i></a>
								</div>
								</div>
								<div class="control-group">
								<label class="control-label" for="input01">Contact Us</label>
								<div class="controls">
									<input type="text" name="contact_us" id="contact_us" class="input-xlarge" value="<?php echo $univ_detail_update['contact_us']; ?>" />
								</div>
								</div>
								<div class="control-group">
								<label class="control-label" for="input01">Fax Address</label>
								<div class="controls">
									<input type="text" name="fax_address" id="fax_address"  class="input-xlarge" value="<?php echo $univ_detail_update['univ_fax']; ?>">
								</div>
								</div>
								<div class="form-actions">
									<input type="button" name="submit" id="submit" onclick="update_univ_gen()" class='btn btn-primary' value="Submit" />									
								</div>
							</div>
						</fieldset>
					</form>           
				</div>
				<div class="tab-pane" id="info">
					<form class="form-horizontal" id="info_form">
						<fieldset>
							<div class="row-fluid">
								<div class="span6">
									<div class="control-group">
								<label class="control-label" for="input07">Overview University</label>
								<div class="controls">
									<textarea name="txtareaoverview" id="txtareaoverview" class='cleditor span12'><?php echo $univ_detail_update['univ_overview']; ?></textarea>
								</div>
								</div>
								<div class="control-group">
								<label class="control-label" for="input07">Campus Overview</label>
								<div class="controls">
									<textarea name="txtareacampus" id="txtareacampus" class='cleditor span12'><?php echo $univ_detail_update['univ_campus']; ?></textarea>
								</div>
								</div>
								<div class="control-group">
								<label class="control-label" for="input07">Facilities & Services / Accommodation</label>
								<div class="controls">
									<textarea name="txtareaservices" id="txtareaservices" class='cleditor span12'><?php echo $univ_detail_update['univ_services']; ?></textarea>
								</div>
								</div>
								<div class="control-group">
								<label class="control-label" for="input07">Awarded Alumni</label>
								<div class="controls">
									<textarea name="txtareaalumni" id="txtareaalumni" class='cleditor span12'><?php echo $univ_detail_update['univ_alumni']; ?></textarea>
								</div>
								</div>
									<div class="control-group">
										<label class="control-label" for="input07">Departments</label>
										<div class="controls">
											<textarea name="txtareadepartments" id="txtareadepartments" id="vad" class='cleditor span12'><?php echo $univ_detail_update['univ_departments']; ?></textarea>
										</div>
									</div>
								</div>
								<div class="span6">
									<div class="control-group">
									<label class="control-label" for="input07">Faculties</label>
									<div class="controls">
										<textarea name="txtareafaculties" id="txtareafaculties" class='cleditor span12'><?php echo $univ_detail_update['univ_faculties']; ?></textarea>
									</div>
									</div>
									<div class="control-group">
									<label class="control-label" for="input07">Student Life</label>
									<div class="controls">
										<textarea name="txtareaslife" id="txtareaslife" class='cleditor span12'><?php echo $univ_detail_update['univ_slife']; ?></textarea>
									</div>
									</div>
									<div class="control-group">
									<label class="control-label" for="input07">For International Students</label>
									<div class="controls">
										<textarea name="txtareainterstudents" id="txtareainterstudents" class='cleditor span12'><?php echo $univ_detail_update['univ_interstudents']; ?></textarea>
									</div>
									</div>
									<div class="control-group">
									<label class="control-label" for="input07">Research Expertise</label>
									<div class="controls">
										<textarea name="txtareaexpertise" id="txtareaexpertise" class='cleditor span12'><?php echo $univ_detail_update['univ_expertise']; ?></textarea>
									</div>
									</div>
									<div class="control-group">
									<label class="control-label" for="input07">Insights</label>
									<div class="controls">
										<textarea name="txtareainsights" id="txtareainsights" class='cleditor span12'><?php echo $univ_detail_update['univ_insights']; ?></textarea>
									</div>
									</div>
									<div class="form-actions">
										<input type="button" name="info_save" class='btn btn-primary' value="Save" onclick="update_univ_INFO()"/>
									</div>
								</div>
							</div>
						</fieldset>
					</form>
              </div>
              <div class="tab-pane" id="seo">
				<div class="row-fluid">
					<div class="span9">
						<form class="form-horizontal">
							<fieldset>
								<div class="control-group">
								<label class="control-label" for="input01">Title</label>
								<div class="controls">
									<input type="text" name="title" id="title" class="input-xlarge" id="input01" value="<?php echo strip_tags($univ_detail_update['title']); ?>">
								</div>
								</div>
								<div class="control-group">
								<label class="control-label" for="input01">Description</label>
								<div class="controls">
									<input type="text" name="description" id="description" class="input-xlarge" id="input01" value="<?php echo strip_tags($univ_detail_update['description']); ?>">
								</div>
								</div>
								<div class="control-group">
								<label class="control-label" for="input01">Keyword</label>
								<div class="controls">
									<input type="text" name="keyword" id="keyword" class="input-xlarge" id="input01" value="<?php echo strip_tags($univ_detail_update['keyword']); ?>">
								</div>
								</div>
								<div class="form-actions">
									<input type="button" name="info_seo" class='btn btn-primary' value="Update" onclick="update_univ_SEO()"/>									
								</div>
							</fieldset>
						</form>
					</div>
				</div>
              </div>
            </div>
          </div>
			<?php } ?>		  
		</div>
      </div>
    </div><!-- close .container-fluid -->
  </div><!-- close .content -->
  <!-- END Content -->
<script>
function update_univ_gen()
{
	var valid = true;
	if($("#univ_name").val()=='')
	{
		$("#univ_name").addClass('needsfilled');
		valid = false;		
	}
	else
	{
		$("#univ_name").removeClass('needsfilled');
	}
	if(valid == true)
	{		
		var univ_name  = $("#univ_name").val();
		var phone_no  = $("#phone_no").val();
		var univ_email  = $("#univ_email").val();
		var web_address  = $("#web_address").val();
		var address  = $("#address").val();
		var country  = $("#country option:selected").val();
		var state  = $("#state option:selected").val();
		var city  = $("#city option:selected").val();
		var contact_us = $("#contact_us").val();
		var fax_address = $("#fax_address").val();
		var data = {
					submit:'submit',
					univ_name:univ_name,
					phone_no:phone_no,
					univ_email:univ_email,
					web_address:web_address,
					address:address,
					country:country,
					state:state,
					city:city,
					contact_us:contact_us,
					fax_address:fax_address
					};
		$.ajax({
			type: 'POST',
			data: data,
			url: '<?php echo $base; ?>admin/update_university_detail',
			async: false,
			success: function(msg)
			{
				if(msg == '1')
				{
					$('#updated').show();
					setTimeout(function(){$('#updated').fadeOut('slow');},2000);
				}
				else if(msg == '0')
				{
					$('#no_changes').show();
					setTimeout(function(){$('#no_changes').fadeOut('slow');},2000);
				}
				else
				{
					$('#denied').show();
					setTimeout(function(){$('#denied').fadeOut('slow');},2000);
				}
			}
		});
	}
	
}
function update_univ_INFO()
{
	var txtareaoverview = $("#txtareaoverview").val();
	var txtareacampus = $("#txtareacampus").val();
	var txtareaservices = $("#txtareaservices").val();
	var txtareaalumni = $("#txtareaalumni").val();
	var txtareadepartments = $("#txtareadepartments").val();
	var txtareafaculties = $("#txtareafaculties").val();
	var txtareaslife = $("#txtareaslife").val();
	var txtareainterstudents = $("#txtareainterstudents").val();
	var txtareaexpertise = $("#txtareaexpertise").val();
	var txtareainsights = $("#txtareainsights").val();	
	var data = {info_save:'info_save',txtareaoverview:txtareaoverview,txtareacampus:txtareacampus,txtareaservices:txtareaservices,txtareaalumni:txtareaalumni,txtareadepartments:txtareadepartments,txtareafaculties:txtareafaculties,txtareaslife:txtareaslife,txtareainterstudents:txtareainterstudents,txtareaexpertise:txtareaexpertise,txtareainsights:txtareainsights};
	$.ajax({
		type: 'POST',
		url: '<?php echo $base; ?>admin/update_university_detail',
		data: data,
		async: false,
		success: function(msg)
		{
			if(msg == '1')
			{
				$('#updated').show();
				setTimeout(function(){$('#updated').fadeOut('slow');},2000);
			}
			else if(msg == '0')
			{
				$('#no_changes').show();
				setTimeout(function(){$('#no_changes').fadeOut('slow');},2000);
			}
			else
			{
				$('#denied').show();
				setTimeout(function(){$('#denied').fadeOut('slow');},2000);
			}
		}		
	});
}
function update_univ_SEO()
{
	var valid = true;
	if($("#title").val()=='')
	{
		$("#title").addClass('needsfilled');
		valid = false;		
	}
	else
	{
		$("#title").removeClass('needsfilled');
	}
	if(valid == true)
	{
		var ttl = $("#title").val();
		var des = $("#description").val();
		var key = $("#keyword").val();
		data = {info_seo:'info_seo',title:ttl,description:des,keyword:key};
		$.ajax({
			type: 'POST',
			url: '<?php echo $base; ?>admin/update_university_detail',
			data: data,
			cache: false,
			async: false,
			success: function(msg)
			{
				if(msg == '1')
				{
					$('#updated').show();
					setTimeout(function(){$('#updated').fadeOut('slow');},2000);
				}
				else if(msg == '0')
				{
					$('#no_changes').show();
					setTimeout(function(){$('#no_changes').fadeOut('slow');},2000);
				}
				else
				{
					$('#denied').show();
					setTimeout(function(){$('#denied').fadeOut('slow');},2000);
				}
			}
		});
	}
}
$(document).ready(function(){
	//alert('fnslfc');
	$('.collapsed-nav').css('display','none');
	var url = window.location.pathname; 
	var activePage = url.substring(url.lastIndexOf('/')+1);
	$('.mainNav li a').each(function(){  
		var currentPage = this.href.substring(this.href.lastIndexOf('/')+1);
		if (activePage == currentPage) {
			$('.mainNav li').removeClass('active');
			$('li').find('span').removeClass('label-white');
			$('li').find('i').removeClass('icon-white');
			$(this).parent().addClass('active'); 
			$(this).parent().find('span').addClass('label-white');
			$(this).parent().find('i').addClass('icon-white');
				$(this).parent().parent().css('display','block');
				if($(this).parent().parent().css('display','block'))
				{
					$(this).parent().parent().prev().parent().addClass('active');
					$(this).parent().parent().prev().find('span img').attr('src', 'img/toggle_minus.png');
					$(this).parent().parent().prev().find('span').addClass('label-white');
					$(this).parent().parent().prev().find('i').addClass('icon-white');
				}
			} 
		});
	});
fetchstates('<?php echo $univ_state_id; ?>');
fetchcities('<?php echo $univ_state_id; ?>','<?php echo $univ_city_id; ?>');
$('#univ_client').click(function()
{
	if($('#univ_client').is(':checked'))
	{
		$('#univ_is_client').val(1);
	}
	else
	{
		$('#univ_is_client').val(0);
	}
});
function fetchcountry(cid)
{
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>admin/country_list_ajax",
   data: 'country_id='+cid,
   cache: false,
   async:false,
   success: function(msg)
   {
   // $('#state').attr('disabled', false);
	$('#country').html(msg);
   }
   });
}
function fetchcountryNew(cid,cname)
{
	$("#country option:selected").text(cname);	
	$("#country option:selected").val(cid);
	$("#state").removeAttr("disabled");
	$("#city").removeAttr("disabled");
}
function fetchstates(sid)
{
var stid=sid;
var cid;
if(sid=='-1')
{
stid='0';
cid=$("#country_model2 option:selected").val();
}
else
{
var cid=$("#country option:selected").val();
}
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>admin/state_list_ajax/",
   data: 'country_id='+cid+'&sel_state_id='+stid,
   cache: false,
   success: function(msg)
   {
    if(sid=='-1')
	{
	$('#state_model2').attr('disabled', false);
	$('#state_model2').html(msg);
	}
	else
	{
    $('#state').attr('disabled', false);
	$('#state').html(msg);

	}
   }
   });
 } 
function fetchstatesNew(sid,sname)
{
var stid=sid;
var cid;
if(sid=='-1')
{
stid='0';
cid=$("#country_model2 option:selected").val();
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>admin/state_list_ajax/",
   data: 'country_id='+cid+'&sel_state_id='+stid,
   cache: false,
   success: function(msg)
   {
    if(sid=='-1')
	{
	$('#state_model2').attr('disabled', false);
	$('#state_model2').html(msg);
	}
   }
   });
}  
else
{
	$("#state option:selected").text(sname);	
	$("#state option:selected").val(sid);	
	$("#state").removeAttr("disabled");
	$("#city").removeAttr("disabled");
}
}
function fetchcities(state_id,cityid)
{
	if(state_id=='0')
	{
	state_id=$("#state option:selected").val();
	}
	$.ajax({
		type: "POST",
		url: "<?php echo $base; ?>admin/city_list_ajax/",
		data: 'state_id='+state_id+'&sel_city_id='+cityid,
		cache: false,
		success: function(msg)
		{
		$('#city').attr('disabled', false);
		$('#city').html(msg);
		}
	});  
}
function fetchcitiesNew(cityid,cityname)
{
	$("#city option:selected").text(cityname);	
	$("#city option:selected").val(cityid);	
	$("#state").removeAttr("disabled");
	$("#city").removeAttr("disabled");
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

$('#addcountry').click(function(){
	var country=$("#country_model").val();
	var state=$("#state_model").val();
	var city=$("#city_model").val();
	var flag=0;
	if(country=='' || country==null)
	{
	 $('#country_error').html("Please enter the country name"); 
	 $('#country_model').addClass('needsfilled');
	 flag=0;
	}
	else
	{
		$('#country_error').html("") 
		$('#country_model').removeClass('needsfilled');
		flag=flag+1;
	}
	if(state=='' || state==null)
	{
		$('#state_error').html("Please enter the state name"); 
		$('#state_model').addClass('needsfilled');
		flag=0;	
	}
	else
	{
		$('#state_error').html(""); 
		$('#state_model').removeClass('needsfilled');
		flag=flag+1;
	}
	if(city=='' || city==null)
	{
	$('#city_error').html("Please enter the city"); 
	$('#city_model').addClass('needsfilled');
	flag=0;
	}
	else
	{
	$('#city_error').html(""); 
	$('#city_model').removeClass('needsfilled');
	flag=flag+1;
	}
	if(flag==3)
	{
	 var  countrystatus=0;
		$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admin/check_unique_field/country_name/country",
	   async:false,
	   data: 'field='+country,
	   cache: false,
	   success: function(msg)
	   {
	   if(msg=='1')
		{
		$('#country_error').html('Country Already Exist');
		$('#country_model').addClass('needsfilled');
		}
		else if(msg=='0')
		{
		$('#country_model').html('');
		$('#country_error').addClass('');
		countrystatus=1;
		}
	   }
	   });
	 if(countrystatus)
	 {
	$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admin/add_country_ajax",
	   async:false,
	   data: 'country_model='+country+'&state_model='+state+'&city_model='+city,
	   cache: false,
	   success: function(msg)
	   {
	    var place=msg.split('##');
		fetchcountryNew(place[0],country);
		fetchstatesNew(place[1],state);
		fetchcitiesNew(place[2],city);
		$('.modal-backdrop').fadeOut("slow");	
		$('.in').fadeOut("slow");		
		$('.modal-profile').fadeOut("slow");
        $('.modal-lightsout').fadeOut("slow");
		//$('#add_country_form').reset();
		$('.info_message').html('Your Place Added Successfully');
		$('.content_msg').css('display','block');
	   }
	   });
	 } 
	   
	}
	
});

$('#addstate').click(function(){
	var country=$("#country_model1 option:selected").val();
	var countrytext=$("#country_model1 option:selected").text();
	var state=$("#state_model1").val();
	var city=$("#city_model1").val();
	var flag=0;
	if(country=='' || country==null || country=='0')
	{
	 $('#country_error1').html("Please select the country"); 
	 $('#country_model1').addClass('needsfilled');
	 flag=0;
	}
	else
	{
	$('#country_error1').html("");
	 $('#country_model1').removeClass('needsfilled');
	  flag=flag+1;
	}
	if(state=='' || state==null)
	{
	$('#state_error1').html("Please enter the state name"); 
	$('#state_model1').addClass('needsfilled');
	flag=1;
	
	}
	else
	{
	$('#state_error1').html(""); 
	$('#state_model1').removeClass('needsfilled');
	  flag=flag+1;
	}
	if(city=='' || city==null)
	{
	$('#city_error1').html("Please enter the city"); 
	$('#city_model1').addClass('needsfilled');
	flag=0;
	}
	else
	{
	$('#city_error1').html(""); 
	$('#city_model1').removeClass('needsfilled');
	 flag=flag+1;
	}
	if(flag==3)
	{
	 var  statestatus=0;
		$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admin/state_check",
	   async:false,
	   data: 'state_model1='+state+'&country_model1='+country,
	   cache: false,
	   success: function(msg)
	   {
	    if(msg=='1')
		{
		$('#state_error1').html('State Already Exist in Selected Country');
		$('#state_model1').addClass('needsfilled');
		}
		else if(msg=='0')
		{
		$('#state_error1').html('');
		$('#state_model1').addClass('');
		statestatus=1;
		}
	   }
	   });
	 if(statestatus)
	 {
	 $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admin/add_state_ajax",
	   async:false,
	   data: 'country_model1='+country+'&state_model1='+state+'&city_model1='+city,
	   cache: false,
	   success: function(msg)
	   {
	    var place=msg.split('##');
		fetchcountryNew(place[0],countrytext);
		fetchstatesNew(place[1],state);
		fetchcitiesNew(place[2],city);		
		$('.modal-backdrop').fadeOut("slow");
		$('.in').fadeOut("slow");		
		$('.modal-profile').fadeOut("slow");
        $('.modal-lightsout').fadeOut("slow");
		//$('#add_state_form').reset();
		$('.info_message').html('Your Place Added Successfully');
		$('.content_msg').css('display','block');
	   }
	   });
	 } 
	   
	}
	
});




$('#addcity').click(function(){
	var country=$("#country_model2 option:selected").val();
	var countrytext=$("#country_model2 option:selected").text();
	var state=$("#state_model2 option:selected").val();
	var statetext=$("#state_model2 option:selected").text();
	var city=$("#city_model2").val();
	var flag=0;
	if(country=='' || country==null || country=='0')
	{
	 $('#country_error2').html("Please select the country"); 
	 $('#country_model2').addClass('needsfilled');
	 flag=0;
	}
	else
	{
	$('#country_error2').html("");
	 $('#country_model2').removeClass('needsfilled');
	  flag=flag+1;
	}
	if(state=='' || state==null || state=='0')
	{
	$('#state_error2').html("Please select the state "); 
	$('#state_model2').addClass('needsfilled');
	flag=0;
	}
	else
	{
	$('#state_error2').html(""); 
	$('#state_model2').removeClass('needsfilled');
	 flag=flag+1;
	}
	if(city=='' || city==null)
	{
	$('#city_error2').html("Please enter the city"); 
	$('#city_model2').addClass('needsfilled');
	flag=0;
	}
	else
	{
	$('#city_error2').html(""); 
	$('#city_model2').removeClass('needsfilled');
	flag=flag+1;
	}
	if(flag==3)
	{
	 var  citystatus=0;
		$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admin/city_check",
	   async:false,
	   data: 'state_model2='+state+'&country_model2='+country+'&city_model2='+city,
	   cache: false,
	   success: function(msg)
	   {
	    if(msg=='1')
		{
		$('#city_error2').html('CIty Already Exist in Selected State');
		$('#city_model2').addClass('needsfilled');
		}
		else if(msg=='0')
		{
		$('#city_error2').html('');
		$('#city_model2').addClass('');
		citystatus=1;
		}
	   }
	   });
	 if(citystatus)
	 {
	 $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admin/add_city_ajax",
	   async:false,
	   data: 'country_model2='+country+'&state_model2='+state+'&city_model2='+city,
	   cache: false,
	   success: function(msg)
	   {
	    var place=msg.split('##');
		fetchcountryNew(place[0],countrytext);
		fetchstatesNew(place[1],statetext);
		fetchcitiesNew(place[2],city);		
		$('.modal-backdrop').fadeOut("slow");	
		$('.in').fadeOut("slow");		
		$('.modal-profile').fadeOut("slow");
        $('.modal-lightsout').fadeOut("slow");
		//$('#add_city_form').reset();
		$('.info_message').html('Your Place Added Successfully');
		$('.content_msg').css('display','block');
	   }
	   });
	 } 
	   
	}
	
});
$('#setCountryValue').click(function(){
	var selCountryText = $("#country option:selected").text();
	var selCountryVal = $("#country option:selected").val();
	$("#country_model1 option:selected").val(selCountryVal);
	$("#country_model1 option:selected").text(selCountryText);
	if(selCountryText=="Please Select")
	{
		$("#country_model1").removeAttr("disabled");
	}
	else
	{
		$('#country_model1').attr('disabled', true);
	}
});
$('#setCountryStateValue').click(function(){
	var selCountryText = $("#country option:selected").text();
	var selCountryVal = $("#country option:selected").val();	
	$("#country_model2 option:selected").text(selCountryText);
	$("#country_model2 option:selected").val(selCountryVal);
	if(selCountryText=="Please Select")
	{
		$("#country_model2").removeAttr("disabled");
	}
	else
	{
		$('#country_model2').attr('disabled', true);
	}


	var selStateText = $("#state option:selected").text();
	var selStateVal = $("#state option:selected").val();
	$("#state_model2 option:selected").text(selStateText);
	$("#state_model2 option:selected").val(selStateVal);
	$('#state_model2').attr('disabled', true);
	if(selStateText=="Please Select" || selStateText=="Select state")
	{
		$("#state_model2").removeAttr("disabled");
	}
	else
	{
		$('#state_model2').attr('disabled', true);
	}
	
});
function onEnter() {
    var key = window.event.keyCode;

    // If the user has pressed enter
    if (key == 13) {
        document.getElementById("salient_features").value =document.getElementById("salient_features").value + "\n*";
        return false;
    }
    else {
        return true;
    }
}
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}			
	
	
</script>	



<!-- Code For site Menu Added by Subh -->
<script>
$('#overview').click(function(){
$('#txtcampus').hide("slow");
$('#txtservices').hide("slow");
$('#txtfaculties').hide("slow");
$('#txtexpertise').hide("slow");
$('#txtslife').hide("slow");
$('#txtinterstudents').hide("slow");
$('#txtalumni').hide("slow");
$('#txtdepartments').hide("slow");
$('#txtinsights').hide("slow");
$('#txtoverview').toggle("slow");
});

$('#campus').click(function(){
$('#txtservices').hide("slow");
$('#txtfaculties').hide("slow");
$('#txtexpertise').hide("slow");
$('#txtslife').hide("slow");
$('#txtinterstudents').hide("slow");
$('#txtalumni').hide("slow");
$('#txtdepartments').hide("slow");
$('#txtinsights').hide("slow");
$('#txtoverview').hide("slow");
$('#txtcampus').toggle("slow");
});

$('#services').click(function(){
$('#txtfaculties').hide("slow");
$('#txtexpertise').hide("slow");
$('#txtslife').hide("slow");
$('#txtinterstudents').hide("slow");
$('#txtalumni').hide("slow");
$('#txtdepartments').hide("slow");
$('#txtinsights').hide("slow");
$('#txtoverview').hide("slow");
$('#txtcampus').hide("slow");
$('#txtservices').toggle("slow");
});

$('#faculties').click(function(){
$('#txtexpertise').hide("slow");
$('#txtslife').hide("slow");
$('#txtinterstudents').hide("slow");
$('#txtalumni').hide("slow");
$('#txtdepartments').hide("slow");
$('#txtinsights').hide("slow");
$('#txtoverview').hide("slow");
$('#txtcampus').hide("slow");
$('#txtservices').hide("slow");
$('#txtfaculties').toggle("slow");
});

$('#expertise').click(function(){
$('#txtslife').hide("slow");
$('#txtinterstudents').hide("slow");
$('#txtalumni').hide("slow");
$('#txtdepartments').hide("slow");
$('#txtinsights').hide("slow");
$('#txtoverview').hide("slow");
$('#txtcampus').hide("slow");
$('#txtservices').hide("slow");
$('#txtfaculties').hide("slow");
$('#txtexpertise').toggle("slow");
});

$('#slife').click(function(){
$('#txtinterstudents').hide("slow");
$('#txtalumni').hide("slow");
$('#txtdepartments').hide("slow");
$('#txtinsights').hide("slow");
$('#txtoverview').hide("slow");
$('#txtcampus').hide("slow");
$('#txtservices').hide("slow");
$('#txtfaculties').hide("slow");
$('#txtexpertise').hide("slow");
$('#txtslife').toggle("slow");
});

$('#interstudents').click(function(){
$('#txtalumni').hide("slow");
$('#txtdepartments').hide("slow");
$('#txtinsights').hide("slow");
$('#txtoverview').hide("slow");
$('#txtcampus').hide("slow");
$('#txtservices').hide("slow");
$('#txtfaculties').hide("slow");
$('#txtexpertise').hide("slow");
$('#txtslife').hide("slow");
$('#txtinterstudents').toggle("slow");
});

$('#alumni').click(function(){
$('#txtdepartments').hide("slow");
$('#txtinsights').hide("slow");
$('#txtoverview').hide("slow");
$('#txtcampus').hide("slow");
$('#txtservices').hide("slow");
$('#txtfaculties').hide("slow");
$('#txtexpertise').hide("slow");
$('#txtslife').hide("slow");
$('#txtinterstudents').hide("slow");
$('#txtalumni').toggle("slow");
});

$('#departments').click(function(){
$('#txtinsights').hide("slow");
$('#txtoverview').hide("slow");
$('#txtcampus').hide("slow");
$('#txtservices').hide("slow");
$('#txtfaculties').hide("slow");
$('#txtexpertise').hide("slow");
$('#txtslife').hide("slow");
$('#txtinterstudents').hide("slow");
$('#txtalumni').hide("slow");
$('#txtdepartments').toggle("slow");
});

$('#insights').click(function(){
$('#txtoverview').hide("slow");
$('#txtcampus').hide("slow");
$('#txtservices').hide("slow");
$('#txtfaculties').hide("slow");
$('#txtexpertise').hide("slow");
$('#txtslife').hide("slow");
$('#txtinterstudents').hide("slow");
$('#txtalumni').hide("slow");
$('#txtdepartments').hide("slow");
$('#txtinsights').toggle("slow");
});
</script>
<script>
$('#bold-0').click(function(){
//alert($('#txtareaoverview').val());
$('#txtareaoverview').val($('#txtareaoverview').val()+'[b][/b]');
});
$('#italic-0').click(function(){
$('#txtareaoverview').val($('#txtareaoverview').val()+'[i][/i]');
});
$('#ul-0').click(function(){
$('#txtareaoverview').val($('#txtareaoverview').val()+'[ul][li][/li][/ul]');
});

//2//
$('#bold-1').click(function(){
//alert($('#txtareaoverview').val());
$('#txtareacampus').val($('#txtareacampus').val()+'[b][/b]');
});
$('#italic-1').click(function(){
$('#txtareacampus').val($('#txtareacampus').val()+'[i][/i]');
});
$('#ul-1').click(function(){
$('#txtareacampus').val($('#txtareacampus').val()+'[ul][li][/li][/ul]');
});

//3//

$('#bold-2').click(function(){
//alert($('#txtareaoverview').val());
$('#txtareaservices').val($('#txtareaservices').val()+'[b][/b]');
});
$('#italic-2').click(function(){
$('#txtareaservices').val($('#txtareaservices').val()+'[i][/i]');
});
$('#ul-2').click(function(){
$('#txtareaservices').val($('#txtareaservices').val()+'[ul][li][/li][/ul]');
});

//4//

$('#bold-3').click(function(){
//alert($('#txtareaoverview').val());
$('#txtareafaculties').val($('#txtareafaculties').val()+'[b][/b]');
});
$('#italic-3').click(function(){
$('#txtareafaculties').val($('#txtareafaculties').val()+'[i][/i]');
});
$('#ul-3').click(function(){
$('#txtareafaculties').val($('#txtareafaculties').val()+'[ul][li][/li][/ul]');
});
//5//

$('#bold-4').click(function(){
//alert($('#txtareaoverview').val());
$('#txtareaexpertise').val($('#txtareaexpertise').val()+'[b][/b]');
});
$('#italic-4').click(function(){
$('#txtareaexpertise').val($('#txtareaexpertise').val()+'[i][/i]');
});
$('#ul-4').click(function(){
$('#txtareaexpertise').val($('#txtareaexpertise').val()+'[ul][li][/li][/ul]');
});
//6//

$('#bold-5').click(function(){
//alert($('#txtareaoverview').val());
$('#txtareaslife').val($('#txtareaslife').val()+'[b][/b]');
});
$('#italic-5').click(function(){
$('#txtareaslife').val($('#txtareaslife').val()+'[i][/i]');
});
$('#ul-5').click(function(){
$('#txtareaslife').val($('#txtareaslife').val()+'[ul][li][/li][/ul]');
});
//7//

$('#bold-6').click(function(){
//alert($('#txtareaoverview').val());
$('#txtareainterstudents').val($('#txtareainterstudents').val()+'[b][/b]');
});
$('#italic-6').click(function(){
$('#txtareainterstudents').val($('#txtareainterstudents').val()+'[i][/i]');
});
$('#ul-6').click(function(){
$('#txtareainterstudents').val($('#txtareainterstudents').val()+'[ul][li][/li][/ul]');
});
//8//

$('#bold-7').click(function(){
//alert($('#txtareaoverview').val());
$('#txtareaalumni').val($('#txtareaalumni').val()+'[b][/b]');
});
$('#italic-7').click(function(){
$('#txtareaalumni').val($('#txtareaalumni').val()+'[i][/i]');
});
$('#ul-7').click(function(){
$('#txtareaalumni').val($('#txtareaalumni').val()+'[ul][li][/li][/ul]');
});
//9//
//3//

$('#bold-8').click(function(){
//alert($('#txtareaoverview').val());
$('#txtareadepartments').val($('#txtareadepartments').val()+'[b][/b]');
});
$('#italic-8').click(function(){
$('#txtareadepartments').val($('#txtareadepartments').val()+'[i][/i]');
});
$('#ul-8').click(function(){
$('#txtareadepartments').val($('#txtareadepartments').val()+'[ul][li][/li][/ul]');
});
//10//
//3//

$('#bold-9').click(function(){
//alert($('#txtareaoverview').val());
$('#txtareainsights').val($('#txtareainsights').val()+'[b][/b]');
});
$('#italic-9').click(function(){
$('#txtareainsights').val($('#txtareainsights').val()+'[i][/i]');
});
$('#ul-9').click(function(){
$('#txtareainsights').val($('#txtareainsights').val()+'[ul][li][/li][/ul]');
});

//Salient Features
$('#bold-salient').click(function(){
//alert($('#txtareaoverview').val());
$('#salient_features').val($('#salient_features').val()+'[b][/b]');
});
$('#italic-salient').click(function(){
$('#salient_features').val($('#salient_features').val()+'[i][/i]');
});
$('#ul-salient').click(function(){
$('#salient_features').val($('#salient_features').val()+'[ul][li][/li][/ul]');
});	
 </script>
</body>
</html>