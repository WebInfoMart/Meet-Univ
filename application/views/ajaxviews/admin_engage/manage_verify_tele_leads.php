<?php 
	$sno=1;
	foreach($verify_teleleads as $teleleadsres) { ?>	
		<div id="data_data_<?php echo $teleleadsres['v_id']; ?>" class="old_data old_data_paging">
			<div class="grid1 float_l">
					<?php echo $sno++ ;?>
			</div>
			<div class="span14 float_l" id="lead_fname_<?php echo $teleleadsres['v_id']; ?>">
				<?php echo $teleleadsres['v_fullname']; ?>
			</div>
			<div class="span14 float_l" >
				<span id="lead_email_<?php echo $teleleadsres['v_id']; ?>"><?php echo $teleleadsres['v_email']; ?></span>
(
<?php 
echo '<span style="color:green;font-size:10px;">Verified</span>' ;
/*if($teleleadsres['email_verified']) { echo '<span style="color:green;font-size:10px;">Verified</span>' ;}
 else { echo '<span style="color:red;font-size:10px;" id="span_not_verified_'.$teleleadsres['v_id'].'">Not Verified</span>'; }*/ ?>
 )
			</div>
			
			
			<div class="span14 float_l">
				<?php
if($teleleadsres['v_user_type']=='site_user'){ 
$lead_source="Site User"; }
else if($teleleadsres['v_user_type']=='fb_login'){ $lead_source="FB Login(Site User)"; }
else if($teleleadsres['v_user_type']=='android_user'){ $lead_source="Mobile App"; }
else if($teleleadsres['v_user_type']=='event_user'){ $lead_source="Event Registration"; }
else if($teleleadsres['v_user_type']=='fb_canvas'){ $lead_source="FB Application"; }
else if($teleleadsres['v_user_type']=='college_request') { $lead_source="Request College"; }
else{$lead_source="Other";};
echo $lead_source;
?>
			</div>
			<div class="span14 float_l">
				<?php 
if($teleleadsres['v_phone']=='' || $teleleadsres['v_phone']==0 || $teleleadsres['v_phone']==NULL) {
echo "<span style='color:blue'>Not Available</span>(<span style='color:red;font-size:10px;'>Not Verified</span>)";
}
else {
echo "<span id='lead_phone_$teleleadsres[v_id]'>".$teleleadsres['v_phone']."</span>"; ?>(
<?php 
echo '<span style="color:green;font-size:10px;">Verified</span>' ;
/*if($teleleadsres['phone_verified']) { echo '<span style="color:green;font-size:10px;">Verified</span>' ;}
 else { echo '<span style="color:red;font-size:10px;" id="span_not_verified_phone_'.$teleleadsres['v_id'].'"> Not Verified</span>'; } ?> )<?php */ } ?>
			</div>
			<div class="span14 float_l">
				<a href="javascript:void(0);" onclick="edit_user_lead('<?php echo $teleleadsres['v_id']; ?>')" id="data_<?php echo $teleleadsres['v_id']; ?>" class="edit inline">Edit</a>
				<div class="inline margin_l1" id="ajax_loading_img_<?php echo $teleleadsres['v_id']; ?>" style="display:none;"><img src="<?php echo $base ;?>images/ajax_loader.gif"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div id="<?php echo $teleleadsres['v_id']; ?>"></div>
	<?php }
?>