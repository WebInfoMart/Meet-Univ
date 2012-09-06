<?php
$univ_id=explode('##',$univ_user_mapped_info);
 ?>
 <center>
<select name="university[]" id="university" multiple size="30">
<?php foreach($univ_info as $univ_info1) { 
$sel='';
if(in_array($univ_info1['univ_id'],$univ_id))
{
$sel='selected';
}
?>
<option value="<?php echo $univ_info1['univ_id'] ?>" <?php echo $sel; ?>><?php echo $univ_info1['univ_name']; ?></option>

<?php } ?>
</select>
</center>
<center>
<div style="margin-top:15px;">
<input type="submit" name="submit" class="submit">
</div>
</center>