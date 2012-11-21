<div id="content">
			
		<h2 class="margin">Map Parent Course and SubCourse</h2>
		<div class="form span8">
	<form action="" method="post" class="caption_form">
<div class="float_l">

	<ul>
	
<?php 
foreach($area_interest as $area_i) { ?>
<li style="margin-top:5px;">
<input type="radio" name="area_intrest[]" id="area_<?php echo $area_i['prog_parent_id']; ?>" value="<?php echo $area_i['prog_parent_id']; ?>">
<label for="area_<?php echo $area_i['prog_parent_id']; ?>"><strong><?php echo $area_i['program_parent_name']; ?></strong></label>
</li>
<?php } ?>
</ul>
</div>

<div class="float_r" >
<ul>

<?php 
$i=0;
foreach($program_list as $program_list1) {
?>
<li  >
<input type="checkbox" id="program_<?php echo $program_list1['prog_id']; ?>" name="progrms_ name[]" value="<?php echo $program_list1['prog_id']; ?>">
<label for="program_<?php echo $program_list1['prog_id']; ?>"><strong><?php echo $program_list1['course_name']; ?></strong></label>
</li>
<?php } ?>
</ul>

</div>	
<div class="clearfix"></div>
<div>
<input type="submit" name="submit" class="submit" value="UPDATE">	
</div>
		</form>
		</div>
</div>		