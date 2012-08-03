
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
