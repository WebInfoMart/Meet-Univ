<div id="content">
<h2>Map University with users</h2>
<div class="form span8">
<form action="" method="post">	
<center>
<select name="users"  id="users">
<option value="">Select User</option>
<?php
foreach($users_info as $get_user_info_list)
{?>

<option value="<?php echo $get_user_info_list['id']; ?>"><?php echo $get_user_info_list['fullname']; ?></option>
<?php } ?>
</select>
<span style="color: red;"> <?php echo form_error('users'); ?><?php echo isset($errors['univ_name'])?$errors['users']:''; ?> </span>
</center>

<center>
<div style="margin-top:30px;">
<select name="university[]"  id="university" multiple size="25">
<?php
foreach($univ_info as $univ_info_list)
{?>

<option value="<?php echo $univ_info_list['univ_id']; ?>"><?php echo $univ_info_list['univ_name']; ?></option>
<?php } ?>
</select>
</div>
</center>
<center>
<input type="submit" name="submit" class="submit" value="submit">
</center>
</form>
</div>

</div>


