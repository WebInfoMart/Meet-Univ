<?php
$class_univ_name='';
$class_sub_domain='';
$error_univ_name = form_error('university');

if($error_univ_name != '') { $class_univ_name = 'focused_error_univ'; } else { $class_univ_name='text'; }

?>

<div id="content">
<?php if($admin_user_level=='3')
{ ?>
<form method="post" action="" enctype="multipart/form-data">
<h2>Upload University Gallery</h2>
<h4>1.File size must be less than 500kb</h4>
<?php if (isset($a)) echo $a;?>
<input type="file" name="userfile1[]"  class="multi" multiple />
<br />
<input type="submit" class="submit" name="upload">
</form>
<?php }
else
{
 ?>
<form method="post" action="" enctype="multipart/form-data">
<h2>Upload University Gallery</h2>
<h4>1.File size must be less than 500kb</h4>
				<ul >
						<li>
						<div>
						<div class="float_l span3 margin_zero">
							<label>Choose University</label>
						</div>
						<div class="float_l span3">
							<select class="<?php echo $class_univ_name; ?> styled span3 margin_zero" name="university" id="university" onchange="get_univ_gallery_detail();">
								<option value="">Please Select</option>
									<?php foreach($univ_info as $univ_detail) { ?>
										<option value="<?php echo $univ_detail->univ_id; ?>" ><?php echo $univ_detail->univ_name; ?></option>
										<?php } ?>
							</select>
	<span style="color: red;"> <?php echo form_error('university'); ?><?php echo isset($errors['university'])?$errors['university']:''; ?> </span>
		
						</div>
						<div class="clearfix"></div>
						</div>
					</li>
				</ul>
<?php if (isset($a)) echo $a;?>
<input type="file" name="userfile1[]"  class="multi" multiple />
<br />
<input type="submit" class="submit" name="upload">
</form>
<?php
 }
 ?>

</div>