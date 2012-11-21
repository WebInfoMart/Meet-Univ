		<?php 
	$sno=$sr_id+1;
	foreach($verify_teleleads as $teleleadsres) {
	if($sno % 2) {
        $class = 'back_diff';
    } else {
	$class = '';
    }
	?>	
		<div id="data_data_<?php echo $teleleadsres['v_id']; ?>" class="<?php echo $class; ?> old_data old_data_paging" style="-webkit-border-bottom: 1px solid #CCC;-moz-border-bottom: 1px solid #CCC;border-bottom: 1px solid #CCC;padding: 3px 0px;">
			<div class="grid1 float_l">
					<?php echo $sno++ ;?>
			</div>
			<div class="span1 float_l" id="lead_fname_<?php echo $teleleadsres['v_id']; ?>">
				<?php echo $teleleadsres['v_fullname']; ?>
			</div>
			<div class="width_adjust float_l" >
				
<?php if($teleleadsres['v_verified_email']) {
?>
<span class="float_l data_img" id="span_verified_email_<?php echo $teleleadsres['v_id']; ?>" style="float: left;">
<img  src="<?php echo base_url(); ?>images/admin/success.gif"/>
</span>
<?php } else { ?>

<span  class="float_l data_img" id="span_verified_email_<?php echo $teleleadsres['v_id']; ?>" style="float: left;">
 <img  src="<?php echo base_url(); ?>images/admin/error.gif"/> </span>
 <?php } 
 if($teleleadsres['v_email']!='')
       { ?>
	   <span class="email_data" id="lead_email_<?php echo $teleleadsres['v_id']; ?>">
 <?php
	   echo $teleleadsres['v_email'];
	   }
	   else
	   { ?>
	      <span class="email_data" id="lead_email_<?php echo $teleleadsres['v_id']; ?>" style="color:blue;">
      <?php
	   echo "Not Availbale";
	   }
 ?></span>
			</div>
			
			
			<div class="span1 float_l">
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

<div class="span1 float_l" >

<?php 

 if($teleleadsres['v_verified_phone']) {
?>
<span  id="span_verified_phone_<?php echo $teleleadsres['v_id']; ?>">
<img  src="<?php echo base_url(); ?>images/admin/success.gif"/>
</span>
<?php } else { ?>

<span  id="span_verified_phone_<?php echo $teleleadsres['v_id']; ?>">
 <img  src="<?php echo base_url(); ?>images/admin/error.gif"/> </span>
 <?php }  ?>
<?php if($teleleadsres['v_phone']=='' || $teleleadsres['v_phone']==0 || $teleleadsres['v_phone']==NULL) {
echo "<span style='color:blue'>Not Available</span>";
}
else {
echo "<span id='lead_phone_$teleleadsres[v_id]'>".$teleleadsres['v_phone']."</span>";
}?>
</div>


 <div class="span0 float_l">
				<a href="javascript:void(0);" onclick="edit_user_lead('<?php echo $teleleadsres['v_id']; ?>','<?php echo $teleleadsres['v_lead_id']; ?>')" id="data_<?php echo $teleleadsres['v_id']; ?>" class="edit inline"><img src="<?php echo $base; ?>images/admin/edit-icon.png" alt="Edit"></a>
				<a href="javascript:void(0);" onclick="delete_this_record('<?php echo $teleleadsres['v_id']; ?>')" id="data_del_<?php echo $teleleadsres['v_id']; ?>" class="edit inline"><img style="height:18px;" src="<?php echo $base; ?>images/admin/delete.png" alt="Delete"></a>	
				<div class="inline margin_l1" id="ajax_loading_img_<?php echo $teleleadsres['v_id']; ?>" style="display:none;"><img src="<?php echo $base ;?>images/ajax_loader.gif"></div>
</div>
			<div class="clearfix"></div>
		</div>
		<div id="<?php echo $teleleadsres['v_id']; ?>"></div>
	<?php }
?>
<div id="pagination" class="table_pagination right paging-margin float_r" style="margin-right:50px;">
            <?php echo $this->pagination->create_links();?>
           
  </div>
  <input type="hidden" id="lastviewdlead" value="0">	
