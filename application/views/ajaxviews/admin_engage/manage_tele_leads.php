<?php 
	$sno=1;
	$cnt_rows_verify_table = 0;
	foreach($teleleads as $teleleadsres) {
	if($sno % 2) {
        $class = 'back_diff';
    } else {
	$class = '';
    }
	$record_verified_true = 0;
	$temp_var_for_verify_email_phone = 0;
	?>	
		<div id="data_data_<?php echo $teleleadsres['id']; ?>" class="<?php echo $class; ?> old_data old_data_paging" style="border-bottom: 1px solid #CCC;-webkit-border-bottom: 1px solid #CCC;-moz-border-bottom: 1px solid #CCC;padding: 3px 0px;">
			<div class="grid1 float_l">
					<?php echo $sno++ ;?>
			</div>
			<div class="span1 float_l" id="lead_fname_<?php echo $teleleadsres['id']; ?>">
				<?php echo $teleleadsres['fullname']; ?>
			</div>
			<div class="width_adjust float_l" >
			<?php if($teleleadsres['email_verified']) {
?>
<span class="float_l data_img" id="span_verified_email_<?php echo $teleleadsres['id']; ?>">
<img src="<?php echo base_url(); ?>images/admin/success.gif"/>
</span>
<?php } else { ?>

<span class="float_l data_img" id="span_verified_email_<?php echo $teleleadsres['id']; ?>">
 <img src="<?php echo base_url(); ?>images/admin/error.gif"/> </span>
 <?php } 
 //if($all_verify_email_phone[$cnt_rows_verify_table]['v_email'] == $)
 $check_lead_email = $teleleadsres['email'];
 $email_check = $this->lead_tele_model->check_lead_email_in_verify_table($check_lead_email);
  if($email_check == 1)
 {
 $record_verified_true = 1;
  
	$temp_var_for_verify_email_phone++;
 }
 ?>
				<span class="email_data" id="lead_email_<?php echo $teleleadsres['id']; ?>"><?php echo $teleleadsres['email']; ?></span>
 
 
 
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
			<div class="span1 float_l">
				<?php 
if($teleleadsres['phone_no1']=='' || $teleleadsres['phone_no1']==0 || $teleleadsres['phone_no1']==NULL) { ?>
<img src="<?php echo base_url(); ?>images/admin/success.gif"/>
<span style='color:blue'>Not Available</span><span style='color:red;font-size:10px;'>
</span>
<?php
}
else {
if($teleleadsres['phone_verified']) { ?>
<span class="float_l data_img" id="span_verified_phone_<?php echo $teleleadsres['id']; ?>">
 <img src="<?php echo base_url(); ?>images/admin/success.gif"/> </span>
<?php }
 else { ?>
 <span class="float_l data_img" id="span_verified_phone_<?php echo $teleleadsres['id']; ?>">
 <img src="<?php echo base_url(); ?>images/admin/error.gif"/> </span>
 <?php }
echo "<span id='lead_phone_$teleleadsres[id]'>".$teleleadsres['phone_no1']."</span>"; ?>
<?php }
 if($temp_var_for_verify_email_phone < 1)
 {
	$check_lead_phone = $teleleadsres['phone_no1'];
	$phone_check = $this->lead_tele_model->check_lead_phone_in_verify_table($check_lead_phone);
  if($phone_check == 1)
 {
 $record_verified_true = 1;
 }
 else { echo "<br />Phone Lead"; } 
 }
 ?>
			</div>
			<div class="span0 float_l">
				<a href="javascript:void(0);" onclick="edit_user_lead('<?php echo $teleleadsres['id']; ?>')" id="data_<?php echo $teleleadsres['id']; ?>" class="edit inline">Edit</a>			
				<div class="inline margin_l1" id="ajax_loading_img_<?php echo $teleleadsres['id']; ?>" style="display:none;"><img src="<?php echo $base ;?>images/ajax_loader.gif"></div>
			
			<!--<a href="javascript:void();" class="edit inline" style="margin-left:19px;cursor:pointer;" id="img_delete_lead_<?php echo $teleleadsres['id']; ?>" onclick="delete_this_record('<?php echo $teleleadsres['id']; ?>');">Delete</a>-->
			
			</div>
			<div class="clearfix"></div>
			 
		</div>
		<div id="<?php echo $teleleadsres['id']; ?>"></div>
	<?php $cnt_rows_verify_table++; }
?>
<div id="pagination" class="table_pagination right paging-margin float_r" style="margin-right:50px;">
            <?php echo $this->pagination->create_links();?>
           
  </div>
  <input type="hidden" id="lastviewdlead" value="0">	
