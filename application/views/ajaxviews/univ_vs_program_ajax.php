<ul>

<?php 
$i=0;
foreach($program_list as $program_list1) {
$i=$i+1;
$checked='';
?>
<li class="float_l list_univ" >
<?php foreach($univ_program as $univ_program1) {
if($program_list1['prog_id']==$univ_program1['program_id'])
{
?>
<input type="hidden" name="already_checked_prog[]" value="<?php echo $univ_program1['program_id']; ?>">
<?php
$checked='checked';
}
}?>
<input type="checkbox" <?php echo $checked; ?> id="program_<?php echo $program_list1['prog_id']; ?>" name="programs_name[]" value="<?php echo $program_list1['prog_id']; ?>">
<label for="program_<?php echo $program_list1['prog_id']; ?>"><strong><?php echo $program_list1['course_name']; ?></strong></label>(<?php echo $program_list1['educ_level']; ?>)
<input type="hidden" name="area_interest[]" value="<?php echo $program_list1['prog_parent_id']; ?>">
<input type="hidden" name="education_level_id[]" value="<?php echo $program_list1['educ_level_id']; ?>">
<input type="hidden" name="program_id[]" value="<?php echo $program_list1['prog_id']; ?>">


</li>
<?php 

} ?>
</ul>
<center>
<input type="submit" name="submit" value="UPDATE" class="submit">
</center>