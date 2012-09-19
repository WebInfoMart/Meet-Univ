<script type="text/javascript">
$('.check_all').click(function() {
		$(this).parents('form').find('input:checkbox').attr('checked', $(this).is(':checked'));   
	})
	$('input.date_picker').date_input();
jQuery(document).ready(function(){			 
	 jQuery("#drop").change(function()
		{  
			 var e = document.getElementById("drop");
			 var dataString = e.options[e.selectedIndex].value;
			 if(dataString==1 || dataString==2 || dataString==3)
				{		 
				  $("#search_box").show();
				  $("#date_selector").hide();	
				  $("#btnUnivSearch").show();
				}				
				if(dataString==5)
				{
					$("#search_box").hide();
					$("#date_selector").show();				  
					$("#btnUnivSearch").show();
					//search_events();
				}	
				if(dataString==4)
				{
					$("#search_box").hide();
					$("#date_selector").hide();				  
					$("#btnUnivSearch").hide();
					search_events();
				}
		});
});
</script>
<?php 
if($featured==''){ $featured=0;}
if($sel_id==''){ $sel_id=0;}
if($search_box==''){ $search_box=0;}
if($date_selector==''){ $date_selector=0;}
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
<div id="ajax_load">
<div  class="content_msg" style="display:none;">
	<div class="span8 margin_t">
		<div class="message success"><p class="info_message"></p></div>
	</div>
</div>  
<div id="content">	
<h2>DETAIL OF EVENTS</h2>
			<div id="search_university" > 
			<span >Filter</span>
			<select id="drop" name="drop" >
				<option>Select to Search</option>
				<option value="1">Event Title</option>														
				<option value="2">University Name</option>
				<option value="3">Event's Country</option>
				<option value="4">Featured Events</option>
				<option value="5">Date Wise Events</option>
			</select>
			<input type="text" id="search_box" style="display:none;"/>	
			<input type="text" id="date_selector" class="date_picker" style="display:none;"/>	
			<input type="button" class="btn btn-primary" value="Search" name="btnUnivSearch" id="btnUnivSearch" onclick="search_events();" style="display:none;">
			 <div class="clearfix"></div>
			 </div> 
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
				if(!empty($events_info))
				{
				foreach($events_info as $row){
				?>
					<tr class="even">
					
						<td>
		<input type="checkbox" class="setchkval" value="" name="check_event_<?php echo $row->event_id; ?>" id="check_event_<?php echo $row->event_id; ?>">
						<input type="hidden" name="event_id[]" value="<?php echo $row->event_id ?>" >
						</td>
						<!--<td><strong><a href="#"><?php // echo $row->id; ?></a></strong></td>-->
						<td class="tabledata_width">
						<?php if($row->event_title){ echo ucwords(substr($row->event_title,0,50)); } else { echo "<span style='color:#000;'>Not Available</span>"; } ?>
						</td>
						<td class="tabledata_width"><?php echo ucwords($row->univ_name); ?></td>
						<td><a href="#"><?php
						if($row->cityname!='')
						{
						echo ucwords($row->cityname);
						}
						else
						{
						echo '<span style="color:#000;">Not Available</span>';
						}
						?></a></td>
						<td><a href="#"><?php if($row->featured_home_event=='1'){?>Featured Event <?php } else { echo "<span style='color:#000;'>Non Featured Event</span>"; } ?></a></td>
						<td><a href="#"><?php echo $row->event_date_time; ?></a></td>
						
						<td>
			
		<ul class="nav">
          <li data-dropdown="dropdown" >  <a class="btn-primary button_cont" href="#"><i class="icon-univ-event icon-white"></i>Events</a>
		  <a class="btn btn-primary dropdown-toggle arrow_but" data-toggle="dropdown" href="#"></a>
            <ul class="dropdown-menu">
			<?php if($view==1) { ?>
 <!--             <li><a href="<?php //echo "$base"; ?>adminevents/view_event/<?php //echo $row->event_id; ?>"><i class="icon-view" ></i> View</a></li>-->
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
				<?php }
	$event_title=$this->subdomain->process_url_title(substr($row->event_title,0,50));
    $event_link=$this->subdomain->genereate_the_subdomain_link($row->subdomain_name,'event',$event_title,$row->event_id);	
?>	
	<li><a target="_blank" href="<?php echo $event_link; ?>"><i class="icon-view" ></i> Front View</a></li>
		
			</ul>
          </li>
        </ul>
</td>		
</tr>
				
			<?php } } else { 
			echo "<tr><td>".'No Result Found'."</td></tr>";
			} ?>		
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
		
		</div>
<script>
function search_events()
{
	var search_box = $('#search_box').val();
	var date_selector=$('#date_selector').val();	
	var a=document.getElementById("drop");	
	var sel_id=a.options[a.selectedIndex].value;
	var search_url = "<?php echo $base; ?>adminevents/manage_events";	
	$.ajax({
    type: "POST",
    url: search_url,
	data:'search_box='+search_box+"&sel_id="+sel_id+"&date_selector="+date_selector+"&ajax=1",	
	 beforeSend: function() {
             $("#ajax_load").css("opacity","0.5");
     },
    success: function(response)
    {//alert(response);
	 $("#ajax_load").css("opacity","1");
		$('#ajax_load').html(response);
    }
	});

}
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

$(function() {
		$("#pagination a").click(function() {
        var url = $(this).attr("href");	
		var featured='<?php echo $featured; ?>';
		var sel_id='<?php echo $sel_id; ?>';		
		var search_box='<?php echo $search_box; ?>';
		var date_selector='<?php echo $date_selector; ?>';		
		var data={sel_id:sel_id,search_box:search_box,featured:featured,date_selector:date_selector,ajax:'1'};			
        $.ajax({
          type: "POST",
          data: data,
          url: url,
          beforeSend: function() {
             $("#ajax_load").css("opacity","0.5");
          },
          success: function(msg) {
		$("#ajax_load").css("opacity","1");		  
            $("#ajax_load").html(msg);          
          }
        });
        return false;
      });   
  });
</script>		