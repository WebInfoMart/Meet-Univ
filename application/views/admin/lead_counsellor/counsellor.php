<link rel="stylesheet" href="<?php echo $base; ?>css/admin/engage/style.css">
<script src="<?php echo $base; ?>js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $base; ?>js/jquery-ui-custom-autosuggest.js" type="text/javascript" charset="utf-8"></script>  
<div id="content">
		<div class="big_width margin_delta">
			<div class="counsel_bg">
			<div class="float_l span77 margin_delta">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Source country: </label>
					<div class="controls-input-data">
					<select class="large" id="s_country" onchange="fetchcities()">
					<option value="0">-Select Country-</option>
					<?php foreach($country as $cntry)
					{ ?>
					<option value="<?php echo $cntry['country_id']; ?>"><?php echo $cntry['country_name']; ?></option>
					<?php
					}
					?>
					</select>
					</div>
				</div>
			</div>
			<div class="float_l span77">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Source city: </label>
					<div class="controls-input-data">
					<select class="large" id="s_city">
					<option value="0">-Select City-</option>
					<?php foreach($city as $ct)
					{ ?>
					<option value="<?php echo $ct['city_id']; ?>"><?php echo $ct['cityname']; ?></option>
					<?php
					}
					?>
					</select>
					</div>
				</div>
			</div>
			<div class="float_l span77">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Leads: </label>
					<div class="controls-input-data">
					<select name="status" id="s_status"  class="edit_box large" >
						<option value="0">--Please Select--</option>
						<option value="Valid" >Valid</option>
						<optgroup label="Invalid Reason">
						<option value="None Given">None Given</option>
						<option value="Poor Candidate Data" >Poor Candidate Data</option>
						<option value="Incorrect Academic Level" >Incorrect Academic Level</option>
						<option value="Program/School Fit" >Program/School Fit</option>
						<option value="No Reply">No Reply</option>
						<option value="Spammers/Agents">Spammers/Agents</option>
						<option value="Invalid Contact Details">Invalid Contact Details</option>
						<option value="Looking For Different Country" >Looking For Different Country</option>
						<option value="Fail to meet filters" >Fail to meet filters</option>
						<option value="Duplicate" >Duplicate</option>
						<option value="Incomplete">Incomplete</option>
						<option value="Cap met" >Cap met</option>
						<option value="Velocity limit met" >Velocity limit met</option>
						<option value="Because of year" >Because of year</option>
						<option value="Unable to Establish Contact- 3 Attempts">Unable to Establish Contact- 3 Attempts</option>
						<option value="Incorrect/Wrong Number" >Incorrect/Wrong Number</option>
						<option value="Hasn't Decided yet" >Hasn't Decided yet</option>
						<option value="Looking for Different Course" >Looking for Different Course</option>
						<option value="Not Looking for further studies" >Not Looking for further studies</option>
						<option value="Due to Location of the colllege" >Due to Location of the colllege</option>
						<option value="Looking for Part-time Course" >Looking for Part-time Course</option>
						<option value="Poor Lead Quality" >Poor Lead Quality</option>
						<option value="Looking for Lateral entry" >Looking for Lateral entry</option>
						<option value="Already applied/Enrolled" >Already applied/Enrolled</option>
						<option value="Language Problem" >Language Problem</option>
						<option value="Just Browsing/Looking for information only" >Just Browsing/Looking for information only</option>
						<option value="Looking for Different college" >Looking for Different college</option>						
						</optgroup>
						</select>
					</div>
				</div>
			</div>
			<div class="float_l span77">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Next action: </label>
					<div class="controls-input-data">
					<select class="large" id="s_next_action">
					<option value="0">-Select Action-</option>
					<option value="none">none</option>
					<option value="counsellor">counsellor</option>
					<option value="hot">hot</option>
					<option value="paused">paused</option>
					</select>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="bottom_line"></div>
			<div class="float_l span77 margin_delta">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Source: </label>
					<div class="controls-input-data">
					<select class="large" id="s_source">
					<option value="0">-Select Source-</option>
					<option value="site_user">Siteuser</option>
					<option value="fb_login">fb Login</option>
					<option value="fb_canvas">fb Canvas</option>
					<option value="android_user">Android User</option>
					<option value="event_user">Event USer</option>
					<option value="other">Other</option>
					</select>
					</div>
				</div>
			</div>
			<div class="float_l span77">
				<div class="control-group">
					<label class="label-control-data blue" for="input01">Phone no: </label>
					<div class="controls-input-data">
					<input type="checkbox" id="s_phone" class="checkbox_set">
					</div>
				</div>
			</div>
			<div class="float_l span77">
				<div class="control-group">
					<label class="label-control-data blue" for="input01"> Email address: </label>
					<div class="controls-input-data">
					<input type="checkbox" id="s_email" class="checkbox_set">
					</div>
				</div>
			</div>
			<div class="float_1 span77">
				<div class="control-group">
					<button type="button" id="search_btn" value="" onclick="search();" style="width:80px;height:30px;">Search</button>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="bottom_line"></div>
		</div>
	
		<div class="margin_t " id="main_content" >
			<div class="span1 float_l">
				<b>Sr.no</b>
			</div>
			<div class="span14 float_l">
				<b class="blue">FullName</b>
			</div>
			<div class="data4 float_l">
				<b class="green">Email</b>
			</div>
			<div class="span14 float_l">
				<b class="blue">Source</b>
			</div>
			<div class="data2 float_l">
				<b class="green">Phone</b>
			</div>
			<div class="clearfix"></div>
			<div class="dotted_line"></div>
			
			<?php 
			$sno=1;
			foreach($verify_teleleads as $result)
			{if($sno % 2) {
			$class = 'back_diff';
			} else {
			$class = '';
			} ?>
  			<div id="c_lead_<?php echo $result['v_id']; ?>" class="old_data update_verify_lead" style="cursor:pointer;">
				<div class="span1 float_l">
						<?php echo $sno++; ?>
				</div>
				<div class="span14 float_l">
					<?php  echo $result['v_fullname']; ?>
				</div>
				<div class="data4 float_l">
					<?php  echo $result['v_email']; ?>
				</div>
				<div class="span14 float_l">
					<?php  echo $result['v_user_type']; ?>
				</div>
				<div class="data2 float_l">
					<?php  echo $result['v_phone'];  ?>
				</div>				
				<div class="clearfix"></div>
			</div>
			<?php } ?>
					<div id="pagination" class="table_pagination right paging-margin float_r" style="margin-right:50px;">
            <?php echo $this->pagination->create_links();?>          
			</div>

		</div>
	</div>
</div>	
	<div id="c_edit"></div>
<script type="text/javascript">
$('.update_verify_lead').click(function(){
var id=$(this).attr("id");
id=id.replace("c_lead_","");
$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admin_counsellor/counsellor",
	   async:false,
	   data: 'id='+id,
	   cache: false,
	   success: function(msg)
	   {//alert(msg);
	    $('#content').hide();
		$("#c_edit").show();
		$('#c_edit').html(msg);		 
	   }
	   });
});
function cancel()
{
	$("#c_edit").hide();
	//$('#c_edit').replaceWith('');
	$('#content').show();
	//$("#data_"+id).show('slow');
}

function fetchcities()
{
var cityid=0;
var e = document.getElementById("s_country");
var country_id=e.options[e.selectedIndex].value;
//alert(country_id);
 $.ajax({
   type: "POST",
   url: "<?php echo $base; ?>admin_counsellor/city_list/",
   data: 'country_id='+country_id+'&sel_city_id='+cityid,
   cache: false,
   success: function(msg)
   {
    //$('#'+cityID).attr('disabled', false);
	$('#s_city').html(msg);
   }
   });  
}
function search()
{   var a=document.getElementById("s_country");
	var cnt_id=a.options[a.selectedIndex].value;
	var b=document.getElementById("s_city");
	var ct_id=b.options[b.selectedIndex].value;
	var c=document.getElementById("s_status");
	var status=c.options[c.selectedIndex].value;
	var d=document.getElementById("s_next_action");
	var action_id=d.options[d.selectedIndex].value;
	var f=document.getElementById("s_source");
	var src_id=f.options[f.selectedIndex].value;
	var phone=$("#s_phone").is(':checked');
	var email=$("#s_email").is(':checked');
	var data='country='+cnt_id+'&city='+ct_id+'&status='+status+'&action_id='+action_id+'&src_id='+src_id+'&phone='+phone+'&email='+email;	
	$.ajax({
	type:"POST",
	url:"<?php echo $base; ?>admin_counsellor/search_lead",
	data: data,
	cache: false,
	async:false,
	success:function(msg)
	{
	   //alert(msg);
		if(msg=='0')
		{
			$("#main_content").html('No Result Found');
		}
		else
		{
			$("#main_content").html(msg);
		}
	}
	});
	
}

	$(function(){
    applyPagination();
    function applyPagination() 
	{
	
      $("#pagination a").click(function() {
        var url = $(this).attr("href");
        $.ajax({
          type: "POST",
          data: 'ajax=1',
          url: url,
          beforeSend: function() {
		  $("#main_content").html("");
          },
          success: function(msg) {			
            $("#main_content").html(msg);
            applyPagination();
          }
        });
        return false;
      });
    }
  });
  
	  
</script>	

