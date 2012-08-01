
	
	<div id="content" style="margin-left: 200px;">
		
			<?php if($teleleads!='0') { ?>
			<!-- .breadcrumb ends -->
		<div>
			<div class="span0 float_l">
				<b>Sr.no</b>
			</div>
			<div class="span1 float_l">
				<b>FullName</b>
			</div>
			<div class="span3 float_l">
				<b>Email Verfied</b>
			</div>
			<div class="span1 float_l">
				<b>Source</b>
			</div>
			<div class="span3 float_l">
				<b>Phone Verified</b>
			</div>
			<div class="span1 float_l">
				
			</div>
			<div class="clearfix"></div>
		</div>
		<div id="content_data">
		<?php 
	$sno=1;
	foreach($teleleads as $teleleadsres) { ?>	
		<div id="data_data_<?php echo $teleleadsres['id']; ?>" class="old_data old_data_paging">
			<div class="span0 float_l">
					<?php echo $sno++ ;?>
			</div>
			<div class="span1 float_l">
				<?php echo $teleleadsres['fullname']; ?>
			</div>
			<div class="span3 float_l">
				<?php echo $teleleadsres['email']; ?>(
<?php if($teleleadsres['email_verified']) { echo '<span style="color:green;font-size:10px;">Verified</span>' ;}
 else { echo '<span style="color:red;font-size:10px;">Not Verified</span>'; } ?>
 )
			</div>
			
			
			<div class="span1 float_l">
				<?php
if($teleleadsres['lead_source']=='site_user'){ 
$lead_sorce="Site User"; }
else if($lead_info['lead_sorce']=='fb_login'){ $lead_sorce="FB Login(Site User)"; }
else if($lead_info['lead_sorce']=='android_user'){ $lead_sorce="Mobile App"; }
else if($lead_info['lead_sorce']=='event_user'){ $lead_sorce="Event Registration"; }
else if($lead_info['lead_sorce']=='fb_canvas'){ $lead_sorce="FB Application"; }
else if($lead_info['lead_sorce']=='college_request') { $lead_sorce="Request College"; }
else{$lead_sorce="Other";};
echo $lead_sorce;
?>
			</div>
			<div class="span3 float_l">
				<?php 
if($teleleadsres['phone_no1']=='' || $teleleadsres['phone_no1']==0 || $teleleadsres['phone_no1']==NULL) {
echo "<span style='color:blue'>Not Available</span>(<span style='color:red;font-size:10px;'>Not Verified</span>)";
}
else {
echo $teleleadsres['phone_no1']; ?>(
<?php if($teleleadsres['phone_verified']) { echo '<span style="color:green;font-size:10px;">Verified</span>' ;}
 else { echo '<span style="color:red;font-size:10px;"> Not Verified</span>'; } ?> )<?php }?>
			</div>
			<div class="span1 float_l">
				<a href="javascript:void(0);" onclick="edit_user_lead('<?php echo $teleleadsres['id']; ?>')" id="data_<?php echo $teleleadsres['id']; ?>" class="edit inline">Edit</a>
				<div class="inline margin_l1" id="ajax_loading_img_<?php echo $teleleadsres['id']; ?>" style="display:none;"><img src="<?php echo $base ;?>images/ajax_loader.gif"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div id="<?php echo $teleleadsres['id']; ?>"></div>
	<?php }
?>
<div id="pagination" class="table_pagination right paging-margin float_r" style="margin-right:50px;">
            <?php echo $this->pagination->create_links();?>
           
  </div>
  <input type="hidden" id="lastviewdlead" value="0">	

</div>
<?php	}?>	
	</div>
		
	<script type="text/javascript">
	function edit_user_lead(id)
	{
	//alert(id);
	var url='<?php echo $base;?>adminleads/fetch_user_info_for_tele'
	$.ajax({
          type: "POST",
          data: "id="+id,
          url: url,
          beforeSend: function() {
           $('#ajax_loading_img_'+id).show();
		   var lasteditleadid=$('#lastviewdlead').val();
		   //alert(lasteditleadid);
		   if(lasteditleadid!='0')
		   {
		    $('#edit_data_'+lasteditleadid).hide(1000);
			$('#edit_data_'+lasteditleadid).replaceWith('');
			 $('#data_'+lasteditleadid).show();
		   }
          },
          success: function(msg) {
		  $('#lastviewdlead').val(id);
		  $('#ajax_loading_img_'+id).hide();
		  $('#data_data_'+id).after(msg);
		  $('#edit_data_'+id).slideDown(500);
		  $("#edit_data_"+id).css("width","589").css("padding-top","10px").css("border-color", "#000").css("border-width", "1px").css('border-style','solid');
		  $('#data_'+id).hide();
				 // $(this).after(msg);
          //  $("#xx").html(msg);
           // applyPagination();
          }
        });
	}
	
	$(function() {
    applyPagination();

    function applyPagination() {
      $("#pagination a").click(function() {
        var url = $(this).attr("href");
        $.ajax({
          type: "POST",
          data: "ajax=1",
          url: url,
          beforeSend: function() {
            $("#content_data").html("");
          },
          success: function(msg) {
		  //alert(msg);
            $("#content_data").html(msg);
            applyPagination();
          }
        });
        return false;
      });
    }
  });
  
		/*$(document).ready(function() {
			var globalid;
			 $(".edit").click(function () {
				globalid = $(this).attr('id');
				$(".data").hide('slow');
				$(".old_data").show('slow');
				$("#data_"+globalid).hide('slow');
				$("#edit_"+globalid).slideDown('slow');
				$("#edit_"+globalid).css("width","589").css("padding-top","10px").css("border-color", "#000").css("border-width", "1px").css('border-style','solid');
				$("#cancel_"+globalid).click(function () {
					$("#edit_"+globalid).css('display','none');
					$("#data_"+globalid).show('slow');
				});
				
			 });
		});*/
		function canceldata(id){
					$("#edit_data_"+id).hide(1000);
					$('#edit_data_'+id).replaceWith('');
					$('#data_'+id).show();
					//$("#data_"+id).show('slow');
				};
				
function fetchstates(leadid)
{
cid=$("#country_model2 option:selected").val();
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>admin/state_list_ajax/",
   data: 'country_id='+cid,
   cache: false,
   success: function(msg)
   {
    
	$('#state_'+leadid).attr('disabled', false);
	$('#state_'+leadid).html(msg);
   }
   });				
}				
	</script>

</body>
</html>