<?php
foreach($user_detail_edit as $user_detail){
?>

<h2>Edit User</h2>
<div id="content">
<div class="form span7">
				<form action="<?php echo $base ?>admin/edituser/<?php echo $user_detail->id; ?> " method="post">
				<input type="hidden" name="hid_user_id" value="<?php echo $user_detail->id; ?>" >
						<div>
							<label>FULLNAME:</label><br>
							<input type="text" size="30" class="text" value="<?php echo $user_detail->fullname; ?>" name="fullname"> 
								<span style="color: red;"> <?php echo form_error('fullname'); ?><?php echo isset($errors['fullname'])?$errors['fullname']:''; ?> </span>
							
						</div> 
						<div>
							<label>EMAIL:</label><br>
							<h4><?php  echo $user_detail->email; ?></h4>
						<!--	<input type="text" size="30" class="text"value="<?php echo $user_detail->email; ?>" name="email"> 
								<span style="color: red;"> <?php echo form_error('email'); ?><?php echo isset($errors['email'])?$errors['email']:''; ?> </span>
						
						</div> 
						--><input type="hidden" name="email" value="<?php echo $user_detail->email; ?>">
						<div><label>USER ROLL</label><h4>
						<input type="hidden" name="level_user" value="<?php echo $user_detail->level ?>">
						<?php if($user_detail->level=='4'){ echo "ADMIN"; } 
						else if($user_detail->level=='3') { echo "UNIVERSITY ADMIN" ;}
						else if($user_detail->level=='2'){echo  "COUNSELLOR";}
						else if($user_detail->level=='1') {echo "STUDENT";}
						//current user level and id		
						$user_level=$user_detail->level;
						$user_id=$user_detail->id;
						}
						?></h4>
					</div>
						
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
								<label><h4><?php echo $privilage['privilege_name'];?></h4></label>
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
