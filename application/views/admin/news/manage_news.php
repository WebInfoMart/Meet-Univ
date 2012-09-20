<?php if($approved==''){ $approved=0;}
if($featured==''){ $featured=0;}
if($sel_id==''){ $sel_id=0;}
if($search_box==''){ $search_box=0;}
 ?>
<script type="text/javascript">
jQuery(document).ready(function(){			 
	 jQuery("#drop").change(function()
		{  
			 var e = document.getElementById("drop");
			 var dataString = e.options[e.selectedIndex].value
			 if(dataString==1 || dataString==2)
				{							  
				  $("#search_box").show();
				  $("#search").show();
				}	
				if(dataString==3)
				{
				  $("#search_box").hide();							
				  $("#search").hide();
				  var approved='1';
						var url='<?php echo $base;?>adminnews/manage_news';
						$.ajax({
							  type: "POST",
							  data: "approved="+approved+"&ajax=1",
							  url: url,
							beforeSend: function() {
								$("#ajax_load").css("opacity","0.5");
							  },	
							  success: function(msg) {
							 $("#ajax_load").css("opacity","1");
								$("#ajax_load").html(msg);           
							  }
							});
				}	
					if(dataString==4)
				{
				  $("#search_box").hide();							
				  $("#search").hide();
				  var featured='1';
						var url='<?php echo $base;?>adminnews/manage_news';
						$.ajax({
							  type: "POST",
							  data: "featured="+featured+"&ajax=1",
							  url: url,							  
							  success: function(msg) {
							  //alert(msg);
								$("#ajax_load").html(msg);           
							  }
							});
				}		
		});
});
function search()
{	
	var search_box = $('#search_box').val();	
	var a=document.getElementById("drop");	
	var sel_id=a.options[a.selectedIndex].value;	
	var search_url = "<?php echo $base; ?>adminnews/manage_news";
	$.ajax({
    type: "POST",
    url: search_url,
	data:'search_box='+search_box+"&sel_id="+sel_id+"&ajax=1",	
	beforeSend: function() {
	$("#ajax_load").css("opacity","0.5");
	},
      success: function(msg) {
		  //alert(msg);
		  $("#ajax_load").css("opacity","1");
            $("#ajax_load").html(msg);           
          }
	});
}
function home()
{	
	var search_url = "<?php echo $base; ?>adminnews/manage_news";
	$.ajax({
    type: "POST",
    url: search_url,
	data:"ajax=1",	
      success: function(msg) {		  
            $("#ajax_load").html(msg);           
          }
	});
}
$('.check_all').click(function() {
		$(this).parents('form').find('input:checkbox').attr('checked', $(this).is(':checked'));   
	});
</script>
<div id="ajax_load" >
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
?>
<div id="content" class="content_msg" style="display:none;">
<div class="span8 margin_t">
  <div class="message success"><p class="info_message"></p>
</div>
  </div>
  </div>
  
<div id="content">	
<input type="button" onclick="home()" class="submit tiny" value="Reset" />
<div style="margin-left: 15px; font-size: 20px; margin-top: 15px;">
	<span >Filter</span>
	<select id="drop" name="drop" >
	<option>Select to Search</option>
	<option value="1">new_title</option>														
	<option value="2">University_name</option>
	<option value="3">Approved</option>
	<option value="4">Featured</option>
	</select>
	<input id="search_box"  style="height: 30px;margin-left: 10px;margin-top: 4px;display:none;" type="text" name="fullname" />
	<input type="button" id="search" style="margin-top: 4px;display:none;"  value="search" onclick="search()" />
	</div>
<h2>DETAIL OF NEWS</h2>
			<form action="<?php echo $base ?>adminnews/delete_news" method="post" id="deletenewsform" >	
			<table cellpadding="0" cellspacing="0" width="100%" class="sortable">
			
				<thead>
					<tr>
						<th ><input type="checkbox" class="check_all" ></th>
						<th class="header" style="cursor: pointer; ">News Title</th>
						<th class="header" style="cursor: pointer; ">University Name</th>
						<th class="header" style="cursor: pointer; ">Featured Status</th>
						<th class="header" style="cursor: pointer; ">News Status</th>
						
						<!--<th class="header" style="cursor: pointer; ">Event's Place</th>-->
						<th></th>
					</tr>
				</thead>
				
				<tbody>
				<?php
				if(!empty($news_info))
				{
				foreach($news_info as $row){
				?>
					<tr class="even">
					
						<td>
		<input type="checkbox" class="setchkval" value="" name="check_news_<?php echo $row->news_id; ?>" id="check_news_<?php echo $row->news_id; ?>">
						<input type="hidden" name="news_id[]" value="<?php echo $row->news_id ?>" >
						</td>
						<!--<td><strong><a href="#"><?php // echo $row->id; ?></a></strong></td>-->
						<td>
						<?php echo ucwords(substr($row->news_title,0,50)); ?>
						</td>
						<td><?php echo ucwords($row->univ_name); ?></td>
						<td><?php if($row->featured_home_news){ echo "Make Unfeatured"; } else {  echo"Make Featured";} ?></td>
						<td><?php if($row->news_approve_status){ echo "Disapprove"; } else {  echo"Approve";} ?></td>
						<!--<td><a href="#"><?php //echo ucwords($row->country_name).','.ucwords($row->cityname) ?></a></td>-->
						<td>
			
		<ul class="nav">
          <li data-dropdown="dropdown" >  <a class="btn-primary button_cont" href="#"><i class="icon-univ-event icon-white"></i>News</a>
		  <a class="btn btn-primary dropdown-toggle arrow_but" data-toggle="dropdown" href="#"></a>
            <ul class="dropdown-menu">
			<?php if($view==1) { ?>
              <li><a href="<?php echo "$base"; ?>adminnews/view_news/<?php echo $row->news_id; ?>"><i class="icon-view" ></i> View</a></li>
			<?php } if($edit==1) { ?>
              <li><a href="<?php echo "$base"; ?>adminnews/edit_news/<?php echo $row->news_id; ?>">
			  <i class="icon-pencil"></i>Edit</a></li>
			  <?php } if(($edit==1 || $delete==1 || $insert==1) && $admin_user_level!='3') { ?>
<li><a href="#" onclick="featured_home_confirm('<?php echo "$base";?>adminnews','<?php  echo $row->featured_home_news; ?>','<?php echo $row->news_id; ?>');"><i class="<?php if($row->featured_home_news=='1'){ echo "icon-ban-circle"; } else { echo "icon-unban-circle"; }?>"></i><?php  if($row->featured_home_news=='1'){?> Make Home Unfeatured <?php } else {?> Make Home Featured <?php } ?></a></li>
<li><a href="#" onclick="approve_home_confirm('<?php echo "$base";?>adminnews','<?php  echo $row->featured_home_news; ?>','<?php echo $row->news_id; ?>');"><i class="<?php if($row->featured_home_news=='1'){ echo "icon-ban-circle"; } else { echo "icon-unban-circle"; }?>"></i><?php  if($row->featured_home_news=='0'){?> Approve news <?php } else {?> DisAprrove news <?php } ?></a></li>
			<!-- </li>	
			  <li><a href="#" onclick="featured_dest_confirm('<?php echo "$base";?>adminevents','<?php  echo $row->featured_dest_news; ?>','<?php echo $row->news_id; ?>');"><i class="<?php if($row->featured_dest_news=='1'){ echo "icon-ban-circle"; } else { echo "icon-unban-circle"; }?>"></i><?php  if($row->featured_dest_news=='1'){?> Make Study-Abroad Unfeatured <?php } else {?> Make Study-Abroad Featured <?php } ?></a>
			 </li>-->	
			<?php }	 if($delete==1) { ?>
			 <li><a href="#" onclick="delete_confirm('<?php echo $row->news_id; ?>');" ><i class="icon-trash"></i> Delete</a></li>
				<?php }$news_title=$this->subdomain->process_url_title(substr($row->news_title,0,50));
				$news_link=$this->subdomain->genereate_the_subdomain_link($row->subdomain_name,'news',$news_title,$row->news_id);
				?>
				
			<li><a target="_balnk" href="<?php echo $news_link ; ?>" ><i class="icon-trash"></i>Front View</a></li>
			<?php	//} }?>
			</ul>
          </li>
        </ul>
</td>		
</tr>
				
			<?php } }else { echo "<tr><td>".'No Result Found!'."<td></tr>"; } ?>		
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
function delete_confirm(newsid)
{
$('#check_news_'+newsid).attr('checked','checked')
var r=confirm("Are U sure u want to Delete this event?");
if(r)
{
window.location.href="<?php echo $base ?>"+'adminnews/delete_single_news/'+newsid;
}
else
{
$('#check_university_'+newsid).removeAttr('checked');
}
}
function approve_home_confirm(a,b,c)
{
if(b==0)
{
status='approve';
}
if(b==1)
{
status='disapprove';
}
var r=confirm("Are U sure u want to " +status+ " to this news?");
if (r==true)
{
  window.location.href=a+'/approve_disapprove_news/'+b+'/'+c+'/';
}
}
function featured_home_confirm(a,b,c)
{
var nof='1';
if(b=='0')
{
nof=chknooffeatured('featured_home_news');
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
var r=confirm("Are U sure u want to " +status+ " to this news?");
if (r==true)
{
  window.location.href=a+'/featured_unfeatured_news/'+b+'/'+c+'/';
}
}
else
{
alert("You have reached maximum limit for show news");
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
var r=confirm("Are U sure u want to " +status+ " to this news?");
if (r==true)
{
  window.location.href=a+'/featured_unfeatured_dest_event/'+b+'/'+c+'/';
}
}
else
{
alert("Max Limit 5 reached,To make this home featured event,First make other to unfeature");
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
var r=confirm("Are U sure u want to delete the selected newss");
set_chkbox_val();

if(r)
{
$('#deletenewsform').submit();
}
}
else
{
alert("please select al least one news");
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
	   url: "<?php echo $base; ?>adminnews/count_featured_news/"+field,
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
		var approved='<?php echo $approved; ?>';
		var featured='<?php echo $featured; ?>';
		var sel_id='<?php echo $sel_id; ?>';		
		var search_box='<?php echo $search_box; ?>';
		var data={sel_id:sel_id,search_box:search_box,approved:approved,featured:featured,ajax:'1'};		
        $.ajax({
          type: "POST",
          data: data,
          url: url,
          beforeSend: function() {
          $("#ajax_load").css("opacity","0.5");
          },
          success: function(msg) {		 
            $("#ajax_load").html(msg);     
			$("#ajax_load").css("opacity","1");			
          }
        });
        return false;
      });   
  });
</script>		