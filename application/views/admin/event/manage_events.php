<?php 
$edit=0;
$delete=0;
$view=0;
$insert=0;
$event_edit_op=array('3','6','7','10');
$event_delete_op=array('5','7','8','10');
$event_insert_op=array('4','6','8','10');

foreach ($admin_priv as $admin_priv_res){ 
if($admin_priv_res['privilege_type_id']=='3' && $admin_priv_res['privilege_level']!=0)
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
?>
<div id="content" class="content_msg" style="display:none;">
<div class="span8 margin_t">
  <div class="message success"><p class="info_message"></p>
</div>
  </div>
  </div>
  
 <div id="content">	

<h2>DETAIL OF EVENTS</h2>
			<form action="<?php echo $base ?>adminevents/delete_events" method="post" id="deleteeventform" >	
			<table cellpadding="0" cellspacing="0" width="100%" class="sortable">
			
				<thead>
					<tr>
						<th ><input type="checkbox" class="check_all" ></th>
						<th class="header tabledata_width" style="cursor: pointer; ">Event Title</th>
						<th class="header tabledata_width" style="cursor: pointer; ">University Name</th>
						<th class="header" style="cursor: pointer; ">Event's Country</th>
						<th class="header" style="cursor: pointer; ">Featured/Unfeatured</th>
						<th class="header" style="cursor: pointer; ">Event Date</th>
						
						<th></th>
					</tr>
				</thead>
				
				<tbody>
				<?php
				foreach($events_info as $row){
				?>
					<tr class="even">
					
						<td>
		<input type="checkbox" class="setchkval" value="" name="check_event_<?php echo $row->event_id; ?>" id="check_event_<?php echo $row->event_id; ?>">
						<input type="hidden" name="event_id[]" value="<?php echo $row->event_id ?>" >
						</td>
						<!--<td><strong><a href="#"><?php // echo $row->id; ?></a></strong></td>-->
						<td class="tabledata_width">
						<?php echo ucwords(substr($row->event_title,0,50)); ?>
						</td>
						<td class="tabledata_width"><?php echo ucwords($row->univ_name); ?></td>
						<td><a href="#"><?php echo ucwords($row->country_name).','.ucwords($row->cityname) ?></a></td>
						<td><a href="#"><?php if($row->featured_home_event=='1'){?>Featured Event <?php } ?></a></td>
						<td><a href="#"><?php echo $row->event_date_time; ?></a></td>
						
						<td>
			
		<ul class="nav">
          <li data-dropdown="dropdown" >  <a class="btn-primary button_cont" href="#"><i class="icon-univ-event icon-white"></i>Events</a>
		  <a class="btn btn-primary dropdown-toggle arrow_but" data-toggle="dropdown" href="#"></a>
            <ul class="dropdown-menu">
			<?php if($view==1) { ?>
              <li><a href="<?php echo "$base"; ?>adminevents/view_event/<?php echo $row->event_id; ?>"><i class="icon-view" ></i> View</a></li>
			<?php } if($edit==1) { ?>
              <li><a href="<?php echo "$base"; ?>adminevents/edit_event/<?php echo $row->event_id; ?>">
			  <i class="icon-pencil"></i> Edit</a></li>
			  <?php } if(($edit==1 || $delete==1 || $insert==1) && $admin_user_level!='3') { ?>
<li><a href="#" onclick="featured_home_confirm('<?php echo "$base";?>adminevents','<?php  echo $row->featured_home_event; ?>','<?php echo $row->event_id; ?>');"><i class="<?php if($row->featured_home_event=='1'){ echo "icon-ban-circle"; } else { echo "icon-unban-circle"; }?>"></i><?php  if($row->featured_home_event=='1'){?> Make Home Unfeatured <?php } else {?> Make Home Featured <?php } ?></a>
			 </li>	
			 <!-- <li><a href="#" onclick="featured_dest_confirm('<?php echo "$base";?>adminevents','<?php  echo $row->featured_dest_event; ?>','<?php echo $row->event_id; ?>');"><i class="<?php if($row->featured_dest_event=='1'){ echo "icon-ban-circle"; } else { echo "icon-unban-circle"; }?>"></i><?php  if($row->featured_dest_event=='1'){?> Make Study-Abroad Unfeatured <?php } else {?> Make Study-Abroad Featured <?php } ?></a>
			 </li>
			-->	
			<?php }	 if($delete==1) { ?>
			 <li><a href="#" onclick="delete_confirm('<?php echo $row->event_id; ?>');" ><i class="icon-trash"></i> Delete</a></li>
				<?php }?>
				
			<?php	//} }?>
			</ul>
          </li>
        </ul>
</td>		
</tr>
				
			<?php } ?>		
				</tbody>
				
			</table>
			</form>
		
		<?php if($delete==1) { ?> 	
			<div class="tableactions" style="margin-top:70px;">
				<select name="univ_action" id="univ_action">
					<option value="">Actions</option>
					<option value="delete">Delete</option>
				</select>
				
				<input type="button" onclick="action_formsubmit(0,0)" class="submit tiny" value="Apply to selected" />
			</div>		<!-- .tableactions ends -->
		<?php  } ?>	
		
			<div id="pagination" class="table_pagination right paging-margin">
			
            <?php echo $this->pagination->create_links();?>
			
            </div> 		
			
		
		
		</div>
<script>
function delete_confirm(eventid)
{
$('#check_event_'+eventid).attr('checked','checked')
var r=confirm("Are U sure u want to Delete this event?");
if(r)
{
window.location.href="<?php echo $base ?>"+'adminevents/delete_single_event/'+eventid;
}
else
{
$('#check_university_'+eventid).removeAttr('checked');
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
var r=confirm("Are U sure u want to " +status+ " to this event?");
if (r==true)
{
  window.location.href=a+'/featured_unfeatured_event/'+b+'/'+c+'/';
}
}
else
{
alert("Max Limit 3 reached,To make this home featured event,make other to unfeature");
}
}
function featured_dest_confirm(a,b,c)
{
var nof='1';
if(b=='0')
{
nof=chknooffeatured('featured_dest_event');
}
if(nof=='1')
{
var status;
if(b==0)
{
status='make country page featured';
}
if(b==1)
{
status='make country page unfeatured';
}
var r=confirm("Are U sure u want to " +status+ " to this event?");
if (r==true)
{
  window.location.href=a+'/featured_unfeatured_dest_event/'+b+'/'+c+'/';
}
}
else
{
alert("Max Limit 3 reached,To make this home featured event,First make other to unfeature");
}
}
function action_formsubmit(id,flag)
{
var action=$('#univ_action').val();
if(action=='delete')
{
var atLeastOneIsChecked = $('.setchkval:checked').length > 0;
if(atLeastOneIsChecked)
{
var r=confirm("Are U sure u want to delete the selected events");
set_chkbox_val();

if(r)
{
$('#deleteeventform').submit();
}
}
else
{
alert("please select al least one usniversity");
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
$(this).val('checked');
}
else
{
$(this).val('');
}
});
}
 
function chknooffeatured(field)
{
var f;
	$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>adminevents/count_featured_events/"+field,
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