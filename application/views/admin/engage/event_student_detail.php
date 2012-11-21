<div class="counsel_next_bg data_value">
<?php 
if(!empty($event_stud))
{ ?>
				<table width="100%" class="last_table" cellspacing="0" cellpadding="0">
				
					<tbody>	
						<tr>
							<td width="25%"><b>Name</b></td>
							<td width="25%"><b>Email</b></td>
							<td width="25%"><b>Phone no.</b></td>							
						</tr>
						<?php //echo $dact_more; 
						foreach($event_stud as $desc)
					{ ?>
						<tr>
							<td width="25%"><b><?php echo $desc['fullname'] ?></b></td>
							<td width="25%"><b><?php echo $desc['email'] ?></b></td>
							<td width="25%"><b><?php echo $desc['phone'] ?></b></td>							
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<div class="float_r" id="more" <?php if($dact_more=='nomore'){ ?> style="display:none;" <?php } ?> onclick="moreData('<?php echo $id;?>','<?php echo $end;?>')">more...</div> 
				<?php }else{ ?>
<div><?php echo 'No Registration Yet...';?> </div>
<?php } ?>				
				<div class="clearfix"></div>			
		</div>
