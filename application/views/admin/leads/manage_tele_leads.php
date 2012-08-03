<style>
#content_msg {
	overflow: hidden;
	padding: 0 20px;
	left: 220px;
	width: 82%;
	}
.message.info {
	border: 1px solid #bbdbe0;
	background: #ecf9ff url(../../images/admin/info.gif) 12px 12px no-repeat;
	color: #0888c3;
	}
	
	.message {
	padding: 10px 15px 10px 40px;
	margin-bottom: 15px;
	font-weight: bold;
	overflow: hidden;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	}
	
</style>
<div id="content_msg" style="display:none;">
<div class="message info"><p>Student has been verified !!!</p></div> 
</div>
	
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
$lead_source="Site User"; }
else if($teleleadsres['lead_source']=='fb_login'){ $lead_source="FB Login(Site User)"; }
else if($teleleadsres['lead_source']=='android_user'){ $lead_source="Mobile App"; }
else if($teleleadsres['lead_source']=='event_user'){ $lead_source="Event Registration"; }
else if($teleleadsres['lead_source']=='fb_canvas'){ $lead_source="FB Application"; }
else if($teleleadsres['lead_source']=='college_request') { $lead_source="Request College"; }
else{$lead_source="Other";};
echo $lead_source;
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
				
				
</script>

</body>
</html>