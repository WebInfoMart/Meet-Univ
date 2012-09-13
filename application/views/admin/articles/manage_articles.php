<?php if($approved==''){ $approved=0;}
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
						var url='<?php echo $base;?>adminarticles/manage_articles';
						$.ajax({
							  type: "POST",
							  data: "approved="+approved+"&ajax=1",
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
	var search_url = "<?php echo $base; ?>adminarticles/manage_articles";
	$.ajax({
    type: "POST",
    url: search_url,
	data:'search_box='+search_box+"&sel_id="+sel_id+"&ajax=1",	
      success: function(msg) {
		  //alert(msg);
            $("#ajax_load").html(msg);           
          }
	});
}
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
<div style="margin-left: 15px; font-size: 20px; margin-top: 15px;">
	<span >Filter</span>
	<select id="drop" name="drop" >
	<option>Select to Search</option>
	<option value="1">Article_title</option>														
	<option value="2">University_name</option>
	<option value="3">Approved</option>
	</select>
	<input id="search_box"  style="height: 30px;margin-left: 10px;margin-top: 4px;display:none;" type="text" name="fullname" />
	<input type="button" id="search" style="margin-top: 4px;display:none;"  value="search" onclick="search()" />
	</div>
<h2>DETAIL OF ARTICLES</h2>
			<form action="<?php echo $base ?>adminarticles/delete_articles" method="post" id="deletearticleform" >	
			<table cellpadding="0" cellspacing="0" width="100%" class="sortable">
			
				<thead>
					<tr>
						<th ><input type="checkbox" class="check_all" ></th>
						<th class="header" style="cursor: pointer; ">Article Title</th>
						<th class="header" style="cursor: pointer; ">University Name</th>
						<th class="header" style="cursor: pointer; ">Article Status</th>
						
						<!--<th class="header" style="cursor: pointer; ">Event's Place</th>-->
						<th></th>
					</tr>
				</thead>
				
				<tbody>
				<?php
				if(!empty($article_info))
				{
				foreach($article_info as $row){
				?>
					<tr class="even">
					
						<td>
		<input type="checkbox" class="setchkval" value="" name="check_article_<?php echo $row->article_id; ?>" id="check_article_<?php echo $row->article_id; ?>">
						<input type="hidden" name="article_id[]" value="<?php echo $row->article_id ?>" >
						</td>
						<!--<td><strong><a href="#"><?php // echo $row->id; ?></a></strong></td>-->
						<td>
						<?php echo ucwords(substr($row->article_title,0,50)); ?>
						</td>
						<td><?php echo ucwords($row->univ_name); ?></td>
						<td><?php if($row->article_approve_status){ echo "Approved"; } else {  echo"Pending For Approve";} ?></td>
						
						<!--<td><a href="#"><?php //echo ucwords($row->country_name).','.ucwords($row->cityname) ?></a></td>-->
						<td>
			
		<ul class="nav">
          <li data-dropdown="dropdown" >  <a class="btn-primary button_cont" href="#"><i class="icon-univ-event icon-white"></i>Articles</a>
		  <a class="btn btn-primary dropdown-toggle arrow_but" data-toggle="dropdown" href="#"></a>
            <ul class="dropdown-menu">
			<?php if($view==1) { ?>
              <li><a href="<?php echo "$base"; ?>adminarticles/view_article/<?php echo $row->article_id; ?>"><i class="icon-view" ></i> View</a></li>
			<?php } if($edit==1) { ?>
              <li><a href="<?php echo "$base"; ?>adminarticles/edit_article/<?php echo $row->article_id; ?>">
			  <i class="icon-pencil"></i> Edit</a></li>
			  <?php } if(($edit==1 || $delete==1 || $insert==1) && $admin_user_level!='3') { ?>
<li><a href="#" onclick="featured_home_confirm('<?php echo "$base";?>adminarticles','<?php  echo $row->featured_home_article; ?>','<?php echo $row->article_id; ?>');"><i class="<?php if($row->featured_home_article=='1'){ echo "icon-ban-circle"; } else { echo "icon-unban-circle"; }?>"></i><?php  if($row->featured_home_article=='1'){?> Make Home Unfeatured <?php } else {?> Make Home Featured <?php } ?></a></li>
<li><a href="#" onclick="approve_home_confirm('<?php echo "$base";?>adminarticles','<?php  echo $row->article_approve_status; ?>','<?php echo $row->article_id; ?>');"><i class="<?php if($row->article_approve_status=='1'){ echo "icon-ban-circle"; } else { echo "icon-unban-circle"; }?>"></i><?php  if($row->article_approve_status=='0'){?> Approve Article <?php } else {?> DisAprrove Article <?php } ?></a></li>
			<!-- </li>	
			  <li><a href="#" onclick="featured_dest_confirm('<?php echo "$base";?>adminevents','<?php  echo $row->featured_dest_article; ?>','<?php echo $row->article_id; ?>');"><i class="<?php if($row->featured_dest_article=='1'){ echo "icon-ban-circle"; } else { echo "icon-unban-circle"; }?>"></i><?php  if($row->featured_dest_article=='1'){?> Make Study-Abroad Unfeatured <?php } else {?> Make Study-Abroad Featured <?php } ?></a>
			 </li>-->	
			<?php }	 if($delete==1) { ?>
			 <li><a href="#" onclick="delete_confirm('<?php echo $row->article_id; ?>');" ><i class="icon-trash"></i> Delete</a></li>
				<?php }?>
				
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
function delete_confirm(articleid)
{
$('#check_article_'+articleid).attr('checked','checked')
var r=confirm("Are U sure u want to Delete this event?");
if(r)
{
window.location.href="<?php echo $base ?>"+'adminarticles/delete_single_article/'+articleid;
}
else
{
$('#check_university_'+articleid).removeAttr('checked');
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
var r=confirm("Are U sure u want to " +status+ " to this article?");
if (r==true)
{
  window.location.href=a+'/approve_disapprove_article/'+b+'/'+c+'/';
}
}
function featured_home_confirm(a,b,c)
{
var nof='1';
if(b=='0')
{
nof=chknooffeatured('featured_home_article');
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
var r=confirm("Are U sure u want to " +status+ " to this article?");
if (r==true)
{
  window.location.href=a+'/featured_unfeatured_article/'+b+'/'+c+'/';
}
}
else
{
alert("You have reached maximum limit for show article");
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
var r=confirm("Are U sure u want to " +status+ " to this article?");
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
var r=confirm("Are U sure u want to delete the selected articles");
set_chkbox_val();

if(r)
{
$('#deletearticleform').submit();
}
}
else
{
alert("please select al least one article");
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
	   url: "<?php echo $base; ?>adminarticles/count_featured_articles/"+field,
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
		var sel_id='<?php echo $sel_id; ?>';		
		var search_box='<?php echo $search_box; ?>';
		var data={sel_id:sel_id,search_box:search_box,approved:approved,ajax:'1'};		
        $.ajax({
          type: "POST",
          data: data,
          url: url,
          beforeSend: function() {
            $("#ajax_load").html("");
          },
          success: function(msg) {		 
            $("#ajax_load").html(msg);          
          }
        });
        return false;
      });   
  });
</script>		