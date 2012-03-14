<?php
foreach($user_detail_edit as $user_detail){
?>

<h2>Edit User</h2>
<div id="content">
<div class="form span7">
				<form action="<?php echo $base ?>admin/update_user_detail" method="post">
				<input type="hidden" name="hid_user_id" value="<?php echo $user_detail->id; ?>" >
						<div>
							<label>FULLNAME:</label><br>
							<input type="text" size="30" class="text" value="<?php echo $user_detail->fullname; ?>" name="fullname"> 
								<span style="color: red;"> <?php echo form_error('fullname'); ?><?php echo isset($errors['fullname'])?$errors['fullname']:''; ?> </span>
							
						</div> 
						<div>
							<label>EMAIL:</label><br>
							<input type="text" size="30" class="text"value="<?php echo $user_detail->email; ?>" name="email"> 
								<span style="color: red;"> <?php echo form_error('email'); ?><?php echo isset($errors['email'])?$errors['email']:''; ?> </span>
						
						</div> 
						<div><label>USER ROLL</label></br>
						<select class="styled" name="level_user" id="level_user">
							<option value="4" <?php if($user_detail->level=='4'){ echo "selected" ;}  ?> >ADMIN</option>
							<option value="3" <?php if($user_detail->level=='3'){ echo "selected" ;}  ?> >UNIVERSITY ADMIN</option>
							<option value="2" <?php if($user_detail->level=='2'){ echo "selected" ;}  ?> >COUNSELLOR</option>
							<option value="1" <?php if($user_detail->level=='1'){ echo "selected" ;}  ?> >STUDENT</option>	
						</select>
						<span style="color: red;"> <?php echo form_error('level_user'); ?><?php echo isset($errors['level_user'])?$errors['level_user']:''; ?> </span>
					
						</div>
						<input type="submit" class="submit" value="UPDATE">
				</form>
</div>
</div>
<?php } ?>