<?php
$class_full_name='';
$error_full_name = form_error('fullname');
if($error_full_name != '') { $class_full_name = 'focused_error_univ'; } else { $class_full_name='text'; }

foreach($user_detail_edit as $user_detail){
?>


<div id="content">
<h2 class="margin">Edit User</h2>
<div class="form ">
				<form action="<?php echo $base ?>admin/edituser/<?php echo $user_detail->id; ?>/<?php echo $user_detail->level; ?>" method="post">
				<div class="span6">
				<input type="hidden" name="hid_user_id" value="<?php echo $user_detail->id; ?>" >
						<div>
							<label>FULLNAME:<input type="text" size="30" class="<?php echo $class_full_name; ?> blue float_r" value="<?php echo $user_detail->fullname; ?>" name="fullname"> 
								<span style="color: red;"> <?php echo form_error('fullname'); ?><?php echo isset($errors['fullname'])?$errors['fullname']:''; ?> </span></label>
							
						</div> 
						<div>
							<label>EMAIL:<input type="text" size="30" class="text blue float_r" readonly="readonly" value="<?php echo $user_detail->email; ?>"> 
								<span style="color: red;"> <?php echo form_error('email'); ?><?php echo isset($errors['email'])?$errors['email']:''; ?></span></label>
						<input type="hidden" name="email" value="<?php echo $user_detail->email; ?>">
						</div>
						
						
						
						<div><label>USER ROLL
						<input type="hidden" name="level_user" value="<?php echo $user_detail->level ?>">
						<input type="text" size="30" class="text blue float_r" readonly="readonly" value="<?php if($user_detail->level=='4'){ echo "ADMIN"; } 
						else if($user_detail->level=='3') { echo "UNIVERSITY ADMIN" ;}
						else if($user_detail->level=='2'){echo  "COUNSELLOR";}
						else if($user_detail->level=='1') {echo "STUDENT";}
						//current user level and id		
						$user_level=$user_detail->level;
						$user_id=$user_detail->id;
						}
						?>"></label>
					</div>
						
					<!--	<div>
							<label>Switch Status( On for Ban,Off for Unban)</label>
							<div class="onoffswitch" <?php //if($user_detail->banned){?> style="background-position:-40px;"<?php//  }?>>
								<span class="onoff_box checked" <?php// if($user_detail->banned){?> style="background-position:-40px;"<?php //} else {?> style="background-position-x: 0px; " <?php //} ?>>
								
								<input type="checkbox" <?php // if($user_detail->banned){?> checked }<?php //}?> id="switch_status"  class="onoffbtn"></span>
								<input type="hidden" name="switch_user_status" id="switch_user_status" value="0">
									<input type="hidden" id="chkcustomjs" value="0">
							</div>
							
						</div>
					-->	
						
						
						
					<div class="clearfix"></div>
	</div>	
			
					<hr></hr>
						
						<!-- user privilege section for editing -->
						<?php
						//echo $user_detail_edit->level;
						if($user_level!='1'){ ?>
						<ul>
						<li>
							<div class="span3">
								<label><h3>MANAGE PRIVILIGES</h3></label>
							</div>
							<div class="span5">
								<div class="span1"><h5><center>VIEW</center></h5></div>
								<div class="span1"><h5><center>EDIT</center></h5></div>
								<div class="span1"><h5><center>INSERT</center></h5></div>
								<div class="span1"><h5><center>DELETE</center></h5></div>
								<div class="clearfix"></div>
							</div>
						</li>
						<?php 
					
						 $user_level=$user_detail->level;
						 
						// print_r($current_user_priv);
						//echo $user_level;
						foreach ($results as $privilage){
						
							if(($user_level==4 && $privilage['privilege_type_id']!=8 && $privilage['privilege_type_id']!=9) || ($user_level==2 && ($privilage['privilege_type_id']==8 || $privilage['privilege_type_id']==9)) || ($user_level==3 && ($privilage['privilege_type_id']==2 || $privilage['privilege_type_id']==3 || $privilage['privilege_type_id']==4 || $privilage['privilege_type_id']==6 || $privilage['privilege_type_id']==11)))
							{
							$res=$this->adminmodel->get_basic_operation_level($user_id,$privilage['privilege_type_id']);
							foreach($res as $res_level)
							{
							
							?>
						
							<li>
							<div class="span3 margin_t">
								<label><h4><?php echo ucwords($privilage['privilege_name']);?></h4></label>
								<input type="hidden" name="privilege_type_id[]" value="<?php echo $privilage['privilege_type_id']; ?>">
								<input type="hidden" value="<?php echo $res_level['privilege_level']; ?>" name="privilege_total[]" id="privilege_total_<?php echo $privilage['privilege_type_id']; ?>">
							</div>
							<div class="span5">
							
							<?php 
							$view = strlen(strstr($res_level['operation_name'],'view'));
							?>
							
								<div class="span1">
								<p class="onoffswitch margin_l3" <?php if($view){?> style="background-position:-40px;"<?php }?>>
									<span class="onoff_box" <?php if($view){?> style="background-position:-40px;"<?php } else {?> style="background-position-x: 0px; " <?php } ?>>
									<input type="checkbox" <?php if($view){?> checked="checked" <?php }?>id="view_<?php echo $privilage['privilege_type_id'];?>" name="view_<?php echo $privilage['privilege_type_id'];?>" value="1"  class="onoffbtn" ></span>
								</p>
								</div>
							<?php 
							$edit = strlen(strstr($res_level['operation_name'],'edit'));
							?>	
								<div class="span1"><p class="onoffswitch margin_l3" <?php if($edit){?> style="background-position:-40px;"<?php  }?>>
									<span class="onoff_box checked" <?php if($edit){?> style="background-position:-40px;"<?php } else {?> style="background-position-x: 0px; " <?php } ?>>
									<input type="checkbox"  <?php if($edit){?> checked="checked" <?php }?> id="edit_<?php echo $privilage['privilege_type_id'];?>" name="edit_<?php echo $privilage['privilege_type_id'];?>" value="2" class="onoffbtn priorop" ></span>
									</p>
								</div>
							<?php 
							$insert = strlen(strstr($res_level['operation_name'],'insert'));
							?>	
							
								<div class="span1"><p class="onoffswitch margin_l3" <?php if($insert){?> style="background-position:-40px;"<?php  }?>>
									<span class="onoff_box checked" <?php if($insert){?> style="background-position:-40px;"<?php } else {?> style="background-position-x: 0px; " <?php } ?>>
									<input type="checkbox" <?php if($insert){?> checked="checked" <?php }?>  id="insert_<?php echo $privilage['privilege_type_id'];?>" name="insert_<?php echo $privilage['privilege_type_id']?>"  value="3" class="onoffbtn priorop" ></span>
									</p>
								</div>
							<?php 
							$delete = strlen(strstr($res_level['operation_name'],'delete'));
							?>		
								<div class="span1"><p class="onoffswitch margin_l3" <?php if($delete){?> style="background-position:-40px;"<?php  }?>>
									<span class="onoff_box checked" <?php if($delete){?> style="background-position:-40px;"<?php } else {?> style="background-position-x: 0px; " <?php } ?>>
									<input type="checkbox" <?php if($delete){?> checked="checked" <?php }?> id="delete_<?php echo $privilage['privilege_type_id'];?>" name="delete_<?php echo $privilage['privilege_type_id'];?>"  value="4" class="onoffbtn priorop" ></span>
									</p>
								</div>
								
							</div>
							<?php } ?>
							<div class="clearfix"></div>
							</li>
					<?php
					 }
					 ?>
					<div class="clearfix"></div>
						<?php
					}?>
					
						
					</ul>
					<?php } ?>	
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						<input type="submit" class="submit" value="UPDATE">
				</form>
</div>
</div>
