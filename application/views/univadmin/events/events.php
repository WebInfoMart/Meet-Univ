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
                <a href="create_event.html">Create Events</a>
              </li>
            </ul>
          </div>
          <div class="content-box">
            <div class="tab-content">
				<div class="tab-pane active" id="cal">
					<div class="content-box">
						<div class="calendar"></div>
					</div>
				</div>
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
							<td> <input type="checkbox" name="sel_row[]" value="1" class='selectable_checkbox' name="check_event_<?php echo $row->event_id; ?>" id="check_event_<?php echo $row->event_id; ?>"></td>
							<td><?php if($row->event_title){ echo ucwords(substr($row->event_title,0,50)); } else { echo "<span style='color:#000;'>Not Available</span>"; } ?></td>
							<td><?php echo ucwords($row->univ_name); ?></td>
							<td><a href="#"><?php if($row->cityname!=''){ echo ucwords($row->cityname); } else { echo '<span style="color:#000;">Not Available</span>'; }?></a></td>
							<td class="center"><a href="#"><?php if($row->featured_home_event=='1'){ echo "Featured Event"; } else { echo "<span style='color:#000;'>Non Featured Event</span>"; } ?></a></td>
							<td class="options">
							<div class="btn-group">
								
								<a href="<?php echo $base;?>newadmin/admin_events/view_event/<?php echo $row->event_id;?>" class="btn btn-icon tip" data-original-title="View">
									<i class="icon-ok"></i>
								</a>
								
								<a href="<?php echo $base;?>newadmin/admin_events/view_event/<?php echo $row->event_id;?>" class="btn btn-icon tip" data-original-title="Edit">
									<i class="icon-pencil"></i>
								</a>
							
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
			  </div>
              <div class="tab-pane" id="new">
				<table class="responsive table table-striped dataTable" id="targetSample1">
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
					<tr>
                      <td> <input type="checkbox" name="sel_row[]" value="1" class='selectable_checkbox'></td>
                      <td>Internet
                       Explorer 4.0</td>
                       <td>Win 95+</td>
                       <td>Win 95+</td>
                       <td class="center"> 4</td>
					   <td class="options center">
							<div class="btn-group">
								<a href="view_events.html" class="btn btn-icon tip" data-original-title="View">
									<i class="icon-ok"></i>
								</a>
								<a href="view_events.html" class="btn btn-icon tip" data-original-title="Edit">
									<i class="icon-pencil"></i>
								</a>
								<a href="#" class="btn btn-icon tip" data-original-title="Delete">
									<i class="icon-trash"></i>
								</a>
								<a href="#" class="btn btn-icon tip" data-original-title="Featured">
									<i class="icon-play-circle"></i>
								</a>
								<a href="#" class="btn btn-icon tip" data-original-title="Disapprove">
									<i class="icon-fire"></i>
								</a>
								<a href="#" class="btn btn-icon tip" data-original-title="Preview">
									<i class="icon-film"></i>
								</a>
							</div>
						</td>
                     </tr>
                    <tr class="gradeX">
                      <td> <input type="checkbox" name="sel_row[]" value="2" class='selectable_checkbox'></td>
                      <td>Dillo 0.8</td>
                      <td>Embedded devices</td>
                      <td>Embedded devices</td>
                      <td class="center">-</td>
                      <td class="options center">
							<div class="btn-group">
								<a href="view_events.html" class="btn btn-icon tip" data-original-title="View">
									<i class="icon-ok"></i>
								</a>
								<a href="view_events.html" class="btn btn-icon tip" data-original-title="Edit">
									<i class="icon-pencil"></i>
								</a>
								<a href="#" class="btn btn-icon tip" data-original-title="Delete">
									<i class="icon-trash"></i>
								</a>
								<a href="#" class="btn btn-icon tip" data-original-title="Featured">
									<i class="icon-play-circle"></i>
								</a>
								<a href="#" class="btn btn-icon tip" data-original-title="Disapprove">
									<i class="icon-fire"></i>
								</a>
								<a href="#" class="btn btn-icon tip" data-original-title="Preview">
									<i class="icon-film"></i>
								</a>
							</div>
						</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- close .container-fluid -->
  </div><!-- close .content -->
  <!-- END Content -->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/fullcalendar.min.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/jquery.dataTables.bootstrap.js"></script>
  <script src="js/custom.js"></script>
<script src="js/jquery.flot.js"></script>
<script src="js/chosen.jquery.min.js"></script>
<script src="js/bootstrap.datepicker.js"></script>
<script src="js/bootstrap.timepicker.js"></script>
<script src="js/jquery.mousewheel.js"></script>
<script src="js/ui.spinner.js"></script>
<script src="js/plupload/plupload.full.js"></script>
<script src="js/jquery.tagsinput.min.js"></script>
<script src="js/jquery.cleditor.min.js"></script>
<script src="js/jquery.inputmask.min.js"></script>
  <script>
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
 </script>