<meta charset="utf-8">
<meta name="description" content="">
<meta name="viewport" content="width=device-width">

<link rel="stylesheet" href="<?php echo $base;?>css/admin/new_admin/css/bootstrap-responsive.css">
<link rel="stylesheet" href="<?php echo $base;?>css/admin/new_admin/css/fullcalendar.css">
<link rel="stylesheet" href="<?php echo $base;?>css/admin/new_admin/css/jquery.tagsinput.css">
<link rel="stylesheet" href="<?php echo $base;?>css/admin/new_admin/css/jquery.cleditor.css">
<link rel="stylesheet" href="<?php echo $base;?>css/admin/new_admin/css/bootstrap.datepicker.css">

<script src="<?php echo $base;?>js/new_admin/js/fullcalendar.min.js"></script>
<script src="<?php echo $base;?>js/new_admin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $base;?>js/new_admin/js/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo $base;?>js/new_admin/js/jquery.flot.js"></script>
<script src="<?php echo $base;?>js/new_admin/js/chosen.jquery.min.js"></script>
<script src="<?php echo $base;?>js/new_admin/js/bootstrap.datepicker.js"></script>
<script src="<?php echo $base;?>js/new_admin/js/bootstrap.timepicker.js"></script>
<script src="<?php echo $base;?>js/new_admin/js/jquery.mousewheel.js"></script>
<script src="<?php echo $base;?>js/new_admin/js/ui.spinner.js"></script>
<script src="<?php echo $base;?>js/new_admin/js/plupload/plupload.full.js"></script>
<script src="<?php echo $base;?>js/new_admin/js/jquery.tagsinput.min.js"></script>
<script src="<?php echo $base;?>js/new_admin/js/jquery.cleditor.min.js"></script>
<script src="<?php echo $base;?>js/new_admin/js/jquery.inputmask.min.js"></script>  
<?php
$edit=0;
$delete=0;
$view=0;
$insert=0;
$event_edit_op=array('3','6','7','10');
$event_delete_op=array('5','7','8','10');
$event_insert_op=array('4','6','8','10');

foreach ($admin_priv as $admin_priv_res){ 
if($admin_priv_res['privilege_type_id']=='2' && $admin_priv_res['privilege_level']!=0)
{
$view=1;
if(in_array($admin_priv_res['privilege_level'],$event_edit_op))
{
$edit=1;
}
if(in_array($admin_priv_res['privilege_level'],$event_delete_op))
{
$delete=1;
}
if(in_array($admin_priv_res['privilege_level'],$event_insert_op))
{
$insert=1;
}
}
}

if(!empty($events_info))
{
?>
<!-- BEGIN Content -->
  <div id="deleted" style="display:none;" class="alert alert-success" style="z-index:99999">
 <a class="close" data-dismiss="alert" href="#">×</a>
  <strong>Event deleted successfully</strong>
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="responsible_navi">
        <div class="currentPage">
          <i class="icon-tasks icon-white"></i> Interface Elements - Tabs
          <div class="sorting">
            <img src="img/sort_both.png" alt="">
          </div>
        </div>
        <ul class='respNav'>
          <li>
            <a href="dash.html">
              <i class="icon-home"></i>
              Dashboard
              <span class="label label-important">16</span>
            </a>
          </li>
          <li>
            <a href="#" class='toggle-subnav'>
              <i class="icon-book"></i>
              Sample Pages
              <span class="label label-toggle"><img src="img/toggle_minus.png" alt=""></span>
            </a>
            <ul class="collapsed-nav closed">
              <li><a href="calendar.html">Calendar</a></li>
              <li><a href="gallery.html">Gallery</a></li>
              <li><a href="user.html">User Profile</a></li>
              <li><a href="404.html">404 Error</a></li>
            </ul>
          </li>
          <li>
            <a href="stats.html">
              <i class="icon-signal"></i>
              Statistics
            </a>
          </li>
          <li>
            <a href="4.html" class='toggle-subnav'>
              <i class="icon-tasks"></i>
              Interface Elements
              <span class="label label-toggle"><img src="img/toggle_minus.png" alt=""></span>
            </a>
            <ul class="collapsed-nav closed">
              <li><a href="buttons.html">Buttons & Icons</a></li>
              <li><a href="modals.html">Modals, Alerts & Notifications</a></li>
              <li><a href="tabs.html">Tabs & Accordion</a></li>
              <li><a href="tooltips.html">Tooltips & Popovers</a></li>
              <li><a href="sliders.html">Sliders & Progressbars</a></li>
            </ul>
          </li>
          <li>
            <a href="forms.html">
              <i class="icon-list"></i>
              Forms
            </a>
          </li>
          <li>
            <a href="tables.html">
              <i class="icon-th-large"></i>
              Tables
              <span class="badge badge-warning">4</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="row-fluid">
        <div class="span12">
          <div class="page-header clearfix tabs">
            <h2>Events</h2>
            <ul class="nav nav-pills">
			<li class='active'>
                <a href="#cal" data-toggle="pill">View Calendar </a>
            </li>
              <li>
                <a href="#all" data-toggle="pill">All</a>
              </li>
              <li>
                <a href="#new" data-toggle="pill">New</a>
              </li>
			  <li id="active_menu">
                <a href="#create" data-toggle="pill">Create Events</a>
              </li>
            </ul>
          </div>
          <div class="content-box">
            <div class="tab-content">
			<!--start cal tab -->
				<div class="tab-pane active" id="cal">
					<div class="content-box">
						<div class="calendar"></div>
					</div>
				</div>
			<!--end cal tab -->
			<!--start all tab -->
              <div class="tab-pane" id="all">
                <table class="responsive table table-striped dataTable" id="targetSample">
                  <thead>
                    <tr>
                      <th width="5%"> <input type="checkbox" name="sel_rows" class='sel_rows' data-targettable="targetSample"></th>
					<th width="20%">Events Title</th>
                      <th width="25%">University Name</th>
                      <th width="15%">Event's Country</th>
					  <th width="15%">Event Date</th>
					   <th width="20%">Choose Option</th>
                    </tr>
                  </thead>
                  <tbody>					
					<?php
						foreach($events_info as $row)
						{
					?>	
						<tr id="check_university_<?php echo $row->event_id;?>">
							<td><input type="checkbox" value="<?php echo $row->event_id;?>" name="check_event_<?php echo $row->event_id; ?>" class='selectable_checkbox setchkval'  id="check_event_<?php echo $row->event_id; ?>"></td>							
							<td><?php if($row->event_title){ echo ucwords(substr($row->event_title,0,50)); } else { echo "<span style='color:#000;'>Not Available</span>"; } ?></td>
							<td><?php echo ucwords($row->univ_name); ?></td>
							<td><a href="#"><?php if($row->cityname!=''){ echo ucwords($row->cityname); } else { echo '<span style="color:#000;">Not Available</span>'; }?></a></td>
							<td class="center"><?php echo ucwords($row->event_date_time); ?></a></td>
							<td class="options">
							<div class="btn-group">
								<?php if($view==1) { ?>
								<a href="<?php echo $base;?>newadmin/admin_events/view_event/<?php echo $row->event_id;?>" class="btn btn-icon tip" data-original-title="View">
									<i class="icon-ok"></i>
								</a>
								<?php } if($edit==1){ ?>
								<a href="<?php echo $base;?>newadmin/admin_events/view_event/<?php echo $row->event_id;?>" style="display:none" class="btn btn-icon tip" data-original-title="Edit">
									<i class="icon-pencil"></i>
								</a>
								<?php } if($delete==1)   {?>
								<div class="modal hide" id="myModal_<?php echo $row->event_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to delete?</h3>
									</div>
									<div class="modal-footer">
										<a href="#" onclick="delete_confirm('<?php echo $row->event_id; ?>')" class="btn" data-dismiss="modal">Yes</a>
										<a href="#" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>						
								<a href="#myModal_<?php echo $row->event_id; ?>" class="btn btn-icon tip"  data-toggle="modal" data-original-title="Delete">
									<i class="icon-trash"></i>
								</a>
								<?php }	if(($edit==1 || $delete==1 || $insert==1)  ){  ?>
								<a href="#" onclick="featured_home_confirm('<?php echo "$base";?>newadmin/admin_events','<?php  echo $row->featured_home_event; ?>','<?php echo $row->event_id; ?>');" class="btn btn-icon tip" <?php if($row->featured_home_event){ ?> data-original-title="Unfeatured" <?php } else { ?> data-original-title="Featured" <?php } ?>>
									<i class="<?php if($row->featured_home_event){ echo 'icon-blue'; }?> icon-star"></i>
								</a>
									
								<a href="#" onclick="show_hide_event('<?php echo "$base";?>newadmin/admin_events','<?php  echo $row->ban_event; ?>','<?php echo $row->event_id; ?>');"  class="btn btn-icon tip" <?php if($row->ban_event){ ?> data-original-title="Disapprove" <?php } else { ?> data-original-title="Approve" <?php } ?> >
									<i class="<?php if($row->ban_event){ echo 'icon-blue'; }?> icon-fire"></i>
								</a>
								<?php 
								$event_title=$this->subdomain->process_url_title(substr($row->event_title,0,50));
								$event_link=$this->subdomain->genereate_the_subdomain_link($row->subdomain_name,'event',$event_title,$row->event_id);									
								?>
								<a href="<?php echo $event_link ; ?>" class="btn btn-icon tip" data-original-title="Preview">
									<i class="icon-film"></i>
								</a>
								<?php } ?>
							</div>
						</td>				
                     </tr> 
					<?php 
						} 
					}
					else { 
						echo "<tr><td>".'No Result Found'."</td></tr>";
					} 
					?>					 
                  </tbody>
                </table>
				<?php if($delete==1) { ?> 	
				<div class="tableactions" style="margin-top:70px;">
					<select name="univ_action" id="univ_action">
						<option value="">Actions</option>
						<option value="delete">Delete</option>
					</select>				
					<input type="button" onclick="action_formsubmit(0,0)" class="submit tiny" value="Apply to selected" />
				</div>	
				<?php } ?> 	
			  </div>
			  <!--end cal tab -->
			  <!--start new tab -->
              <div class="tab-pane" id="new">
				<table class="responsive table table-striped dataTable" id="targetSample">
                  <thead>
                    <tr>
                     <th width="5%"> <input type="checkbox" name="sel_rows" class='sel_rows' data-targettable="targetSample"></th>
                     <th width="20%">Events Title</th>
                      <th width="25%">University Name</th>
                      <th width="15%">Event's Country</th>
					  <th width="15%">Event Date</th>
					   <th width="20%">Choose Option</th>
                    </tr>
                  </thead>
                  <tbody>
					<?php
					foreach($recent_event as $row){
					?>
					<tr id="check_university_<?php echo $row->event_id;?>">
					  <td><input type="checkbox" value="<?php echo $row->event_id;?>" name="check_event_<?php echo $row->event_id; ?>" class='selectable_checkbox setchkval'  id="check_event_<?php echo $row->event_id; ?>"></td>							
                      <td><?php echo ucwords(substr($row->event_title,0,50)); ?></td>
                       <td><?php echo ucwords($row->univ_name); ?></td>
                       <td><a href="#"><?php if($row->cityname!=''){ echo ucwords($row->cityname); } else { echo '<span style="color:#000;">Not Available</span>'; }?></a></td>
                       <td class="center"><?php echo ucwords($row->event_date_time); ?></td>
					   <td class="options center">
							<div class="btn-group">
								<?php if($view==1) { ?>
								<a href="<?php echo $base;?>newadmin/admin_events/view_event/<?php echo $row->event_id;?>" class="btn btn-icon tip" data-original-title="View">
									<i class="icon-ok"></i>
								</a>
								<?php } if($edit==1){ ?>
								<a href="<?php echo $base;?>newadmin/admin_events/view_event/<?php echo $row->event_id;?>" style="display:none" class="btn btn-icon tip" data-original-title="Edit">
									<i class="icon-pencil"></i>
								</a>
								<?php } if($delete==1)   {?>
								<div class="modal hide" id="myRecentModal_<?php echo $row->event_id; ?>">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h3>Do you want to delete?</h3>
									</div>
									<div class="modal-footer">
										<a href="#" onclick="delete_confirm('<?php echo $row->event_id; ?>')" class="btn" data-dismiss="modal">Yes</a>
										<a href="#" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>						
								<a href="#myRecentModal_<?php echo $row->event_id; ?>" class="btn btn-icon tip"  data-toggle="modal" data-original-title="Delete">
									<i class="icon-trash"></i>
								</a>
								<?php }	if(($edit==1 || $delete==1 || $insert==1)  ){  ?>
								<a href="#" onclick="featured_home_confirm('<?php echo "$base";?>newadmin/admin_events','<?php  echo $row->featured_home_event; ?>','<?php echo $row->event_id; ?>');" class="btn btn-icon tip" <?php if($row->featured_home_event){ ?> data-original-title="Unfeatured" <?php } else { ?> data-original-title="Featured" <?php } ?>>
									<i class="<?php if($row->featured_home_event){ echo 'icon-blue'; }?> icon-star"></i>
								</a>
									
								<a href="#" onclick="show_hide_event('<?php echo "$base";?>newadmin/admin_events','<?php  echo $row->ban_event; ?>','<?php echo $row->event_id; ?>');"  class="btn btn-icon tip" <?php if($row->ban_event){ ?> data-original-title="Disapprove" <?php } else { ?> data-original-title="Approve" <?php } ?> >
									<i class="<?php if($row->ban_event){ echo 'icon-blue'; }?> icon-fire"></i>
								</a>
								<?php 
								$event_title=$this->subdomain->process_url_title(substr($row->event_title,0,50));
								$event_link=$this->subdomain->genereate_the_subdomain_link($row->subdomain_name,'event',$event_title,$row->event_id);									
								?>
								<a href="<?php echo $event_link ; ?>" class="btn btn-icon tip" data-original-title="Preview">
									<i class="icon-film"></i>
								</a>
								<?php } ?>
							</div>
						</td>
                     </tr>
					<?php
					}
					?>                  
                  </tbody>
                </table>
				<?php if($delete==1) { ?> 	
				<div class="tableactions" style="margin-top:70px;">
					<select name="univ_action" id="del_action">
						<option value="">Actions</option>
						<option value="delete">Delete</option>
					</select>				
					<input type="button" onclick="action_formsubmit(0,0)" class="submit tiny" value="Apply to selected" />
				</div>	
				<?php } ?> 
              </div>
				<!--end new tab -->				
				<!--start create tab -->
				<div class="tab-pane" id="create">
				<div class="row-fluid">
					<div class="span12">
						<form name="myAddForm" id="myAddForm" onsubmit="return addEvent(this);" action="<?php echo $base; ?>newadmin/admin_events/create_event_ajax" method="post" class="form-horizontal">
							<fieldset>
								<div class="row-fluid">
									<div class="span6">
										<div class="control-group">
										<label class="control-label" for="input01">Event Title</label>
										<div class="controls">
											<input type="text" class="input-xlarge" name="title" id="title">
										</div>
										</div>										
										<div class="control-group">
										<label class="control-label" for="input01">Choose University</label>
										<div class="controls">
											<select name="university" id="university" class="inline" >
												<option value="">Please Select</option>
												<?php foreach($univ_info as $univ_detail) { ?>
												<option value="<?php echo $univ_detail->univ_id; ?>"><?php echo $univ_detail->univ_name; ?></option>
												<?php } ?>
											</select>
											<input type="hidden" name="university_name" id="university_name">										
										</div>
										</div>
										<div class="control-group">
										<label class="control-label" for="input06">Checked IF Event IS Online</label>
										<div class="controls">
											<label class="checkbox"><input type="checkbox" value="0" name="location_event" id="location_event"> Check this checkbox!</label>
											<input type="hidden" name="fixedloc" id="fixedloc">
										</div>
										</div>
										<div id="divShowHide">
											<div class="control-group">
												<label class="control-label" for="input01">Country</label>
												<div class="controls">
													<select  id="country" name="country" class="inline" onchange="fetchstates(0)" >
													<option value="">Please Select</option>
													<?php foreach($countries as $key => $countries_detail) { ?>
													<option value="<?php echo $countries_detail['country_id']; ?>"><?php echo $countries_detail['country_name']; ?></option>
													<?php } ?>
													</select>
													<span class="inline margin_l" style="display:none"><button class="btn btn-icon tip" data-original-title="Add New Country"><i class="icon-plus"></i></button></span>													
													<input type="hidden" name="countryname" id="countryname">
												</div>
											</div>									
											<div class="control-group">
												<label class="control-label" for="input01">State</label>
												<div class="controls">
													<select id="state" name="state" class="inline" onchange="fetchcities(0,0)" disabled="disabled">
														<option value="">Please Select</option>
													</select>
													<span class="inline margin_l" style="display:none"><button class="btn btn-icon tip" data-original-title="Add New State"><i class="icon-plus"></i></button></span>
													<input type="hidden" name="statename" id="statename">
												</div>
											</div>	
											<div class="control-group">
												<label class="control-label" for="input01">City</label>
												<div class="controls">
													<select id="city" name="city" class="inline" disabled="disabled">
														<option value="">Please Select</option>	
													</select>
													<span class="inline margin_l" style="display:none"><button class="btn btn-icon tip" data-original-title="Add New City"><i class="icon-plus"></i></button></span>
													<input type="hidden" name="cityname" id="cityname">
												</div>
											</div>
										</div>
										<div class="control-group">
										<label class="control-label" for="input06">Hide Event On Site</label>
										<div class="controls">
											<label class="checkbox"><input type="checkbox" id="hide_event" value="1"  name="hide_event"> Check this checkbox!</label>
										</div>
										</div>
										<div class="control-group">
										<label class="control-label" for="input01">Event Place</label>
										<div class="controls">
											<input type="text" class="input-xlarge" id="event_place" name="event_place">
										</div>
										</div>
										<div class="control-group">
										<label class="control-label" for="input06">Event Type</label>
										<div class="controls">
											<select id="event_type" name="event_type">
											<option value="">Select Category</option>
											<option value="spot_admission">Spot Admission</option>
											<option value="fairs">Fairs</option>
											<option value="alumuni">Counselling-Alumuni</option>
											<option value="others">Counselling-Others</option>
											</select>
										</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="date">Event Start Date</label>
											<div class="controls">
											<div class="input-prepend">
											<span class="add-on"><i class="icon-calendar"></i></span><input type="text" size="16" name="event_start_date"  id="event_start_date" class='span4 datepick'>
											</div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="date">Event End Date</label>
											<div class="controls">
											<div class="input-prepend">
											<span class="add-on"><i class="icon-calendar"></i></span><input type="text" size="16" name="event_end_date"  id="event_end_date" class='span4 datepick'>
											</div>
											</div>
										</div>
										<div class="control-group">
										<label class="control-label" for="input06">Checked IF Event Timing Is</label>
										<div class="controls">
											<label class="checkbox"><input type="checkbox" name="event_timing_fixed_not_fixed" id="event_timing_fixed_not_fixed"> (Appintment based,Not Fixed etc.)</label>
											<input type="hidden" name="etiming" id="etiming" value="1">
										</div>
										</div>
										<div id="divShowHideTime">
											<div class="control-group">
												<label class="control-label" for="time">Event time</label>
												<div class="controls">
													<div class="input-prepend">
														<span>From</span>
													<span class="add-on"><i class="icon-time"></i></span><input type="text" size="16" id="event_time_start" name="event_time_start" class='span4 timepicker'>
													<span class="margin_r">Till</span><span class="add-on inline margin_l"><i class="icon-time"></i></span><input type="text" size="16" id="event_time_end"  name="event_time_end" class='span4 timepicker'>
													</div>
												</div>
											</div>
										</div>
										<div class="control-group" style="display:none" id="divShowHideMentionTime">
											<label class="control-label" for="time">Mention Event Timing</label>
											<div class="controls">
												<input type="text" name="event_mention_time" id="event_mention_time" class="input-xlarge">
											</div>
										</div>
										<div class="control-group" style="display:block" id="divShowHideShareOnFacebook">
										<label class="control-label" for="input06">Share on Facebook</label>
										 <div class="controls">
											<input type="checkbox"  class="text time" id="share_facebook"  name="share_facebook" />
										</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="tags">Council</label>
											<div class="controls">
											<input type="text" class='tagsinput span12' id="tags" name="tags">
											</div>
										</div>
									</div>
									<div class="span6">										
										<div class="control-group">
										<label class="control-label" for="input06">Share on Facebook for</label>
										 <div class="controls">
											<label class='radio'><input type="radio" name="share_facebook_for" id="share_facebook_for" value="3"> 3 days</label>
											<label class='radio'><input type="radio" name="share_facebook_for" id="share_facebook_for" value="7"> 7 days</label>
											<label class='radio'><input type="radio" name="share_facebook_for" id="share_facebook_for" value="15"> 15 days</label>
										</div>
										</div>
										<div class="control-group">
										<label class="control-label" for="input06">Detail</label>
										<div class="controls">
											<textarea name="detail"  id="detail" class='cleditor span12'></textarea>
										</div>
										</div>
										<div class="form-actions">
										 <button type="submit" class='btn btn-primary'>Add Event</button>
										 <a href="<?php echo $base; ?>newadmin/admin_events" class='btn btn-danger'>Cancel</a>									
										</div>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
              </div>
				<!--end create tab -->
            </div>
          </div>
        </div>
      </div>
    </div><!-- close .container-fluid -->
</div><!-- close .content -->
  <!-- END Content -->
<script>
function addEvent()
{
	var valid=true;
	if($("#title").val()=='')
	{
		$("#title").addClass('needsfilled');
		valid=false;		
	}
	else
	{
		$("#title").removeClass('needsfilled');
		valid=true;		
	}
	if($("#university").val()=='')
	{
		$("#university").addClass('needsfilled');
		valid=false;		
	}
	else
	{
		$("#university").removeClass('needsfilled');
		valid=true;		
	}
	if(!$("#location_event").is(":checked"))
	{
		if($('#country option:selected').val()=='')
		{
			$("#country").addClass('needsfilled');
			valid=false;
		}
		else
		{
			$("#country").removeClass('needsfilled');
			valid=true;		
		}
		if($('#state option:selected').val()=='')
		{
			$("#state").addClass('needsfilled');
			valid=false;
		}
		else
		{
			$("#state").removeClass('needsfilled');
			valid=true;		
		}
		if($('#city option:selected').val()=='')
		{
			$("#city").addClass('needsfilled');
			valid=false;
		}
		else
		{
			$("#city").removeClass('needsfilled');
			valid=true;		
		}
	}
	if($("#event_place").val()=='')
	{
		$("#event_place").addClass('needsfilled');
		valid=false;		
	}
	else
	{
		$("#event_place").removeClass('needsfilled');
		valid=true;		
	}
	if($('#event_type option:selected').val()=='')
	{
		$("#event_type").addClass('needsfilled');
		valid=false;
	}
	else
	{
		$("#event_type").removeClass('needsfilled');
		valid=true;		
	}
	if($("#event_start_date").val()=='')
	{
		$("#event_start_date").addClass('needsfilled');
		valid=false;		
	}
	else
	{
		$("#event_start_date").removeClass('needsfilled');
		valid=true;		
	}
	if($("#event_end_date").val()=='')
	{
		$("#event_end_date").addClass('needsfilled');
		valid=false;		
	}
	else
	{
		$("#event_end_date").removeClass('needsfilled');
		valid=true;		
	}
	if(valid==true)
	{
		document.forms["myAddForm"].submit();
	}
	var university_name=$("#university option:selected").text();			
	var country_name=$("#country option:selected").text();			
	var state_name=$("#state option:selected").text();
	var city_name=$("#city option:selected").text();	
	$("#university_name").val(university_name);
	$("#countryname").val(country_name);
	$("#statename").val(state_name);
	$("#cityname").val(city_name);	
	return valid;
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
	
function delete_confirm(id)
{
	//alert(id);
	$.ajax({	
	 type: "POST",
	   url: "<?php echo $base; ?>newadmin/admin_events/delete_single_event/"+id,
	   async:false,
	   data: '',
	   cache: false,
	   success: function(msg)
	   {
	   //alert(msg);
	    $('#check_university_'+id).hide();
		}
	
	});
}
function show_hide_event(url,sh,event_id)
{
if(sh=='1')
{
shh='show';
}
else
{
shh='hide';
}
var r=confirm("Are U sure u want to "+shh+" the selected events");
if(r)
{
var data={event_id:event_id,show_hide:sh}
$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>newadmin/admin_events/show_hide_event",
	   async:false,
	   data: data,
	   cache: false,
	   success: function(msg)
	   {
	  if(msg=='1')
	   {
	   var shh='ess';
	   }
	   else
	   {
	   var shh='ehs';
	   }
	    window.location.href="<?php echo $base; ?>newadmin/admin_events/manage_events/"+shh;
	   }
	   });
}
}
function featured_home_confirm(a,b,c)
{
	var nof='1';
	if(b=='0')
	{
		nof=chknooffeatured('featured_home_event');
	}
	if(nof=='1')
	{
		var status;
		if(b==0)
		{
		status='make home featured';
		}
		if(b==1)
		{
		status='make home unfeatured';
		}
		var r=confirm("Are you sure you want to " +status+ " to this event?");
		if (r==true)
		{
		  window.location.href=a+'/featured_unfeatured_event/'+b+'/'+c;
		}
	}
	else
	{
		alert("You have reached maximum limit for show event");
	}
}	
function chknooffeatured(field)
{
var f;
	$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>newadmin/admin_events/count_featured_events/"+field,
	   async:false,
	   data: '',
	   cache: false,
	   success: function(msg)
		{
		
			f=msg;
		}
	   });
	 return f;
}
var arr=new Array;
function action_formsubmit(id,flag)
{
	var action;
	if($('#univ_action').val()!='')
	{
		action=$('#univ_action').val();
	}
	if($('#del_action').val()!='')
	{
		action=$('#del_action').val();
	}
	
	if(action=='delete')
	{
		var atLeastOneIsChecked = $('.setchkval:checked').length > 0;
		if(atLeastOneIsChecked)
		{
			var r=confirm("Are you sure you want to delete selected events");
			set_chkbox_val();
			var data={'event_id':arr};
			if(r)
			{
				$.ajax({
					type:"post",
					url:'<?php echo $base ?>newadmin/admin_events/delete_events',
					async:false,
					data: data,
					cache: false,
					success: function(msg)
					{						
						$('.toremove').hide();
						$("#deleted").show();
						$("#deleted").delay(5000).hide("slow");						
					}
					
				});
			}
		}
		else
		{
			alert("please select al least one event");
			return false;
		}
	}
	else
	{
		alert("please select the action");
		return false;
	}
}

function set_chkbox_val()
{
	$('.setchkval').each(function()
	{
		if($(this).attr('checked'))
		{
			$('#check_university_'+$(this).val()).addClass('toremove');
			arr.push($(this).val());
		}		
	});
}
$(document).ready(function()
{	
	$("#location_event").click(function() {	
		if($("#location_event").is(":checked"))
		{
			$("#fixedloc").val(0);
		}
		else
		{
			$("#fixedloc").val(1);
		}		
		$("#divShowHide").toggle('slow');
	});
		
	$("#event_timing_fixed_not_fixed").click(function() { 
		if($("#event_timing_fixed_not_fixed").is(":checked"))
		{
			$("#etiming").val(0);
		}
		else
		{
			$("#etiming").val(1);
		}	
		$("#divShowHideTime").toggle('slow');
		$("#divShowHideMentionTime").toggle('slow');
		$("#divShowHideShareOnFacebook").toggle('slow');
	});	
	
});
function fetchstates(sid)
{
	var stid=sid;
	var cid=$("#country option:selected").val();
	$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admin/state_list_ajax/",
	   data: 'country_id='+cid+'&sel_state_id='+stid,
	   cache: false,
	   success: function(msg)
	   {
		$('#state').attr('disabled', false);
		$('#state').html(msg);			
	   }
	   });
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
 </script>