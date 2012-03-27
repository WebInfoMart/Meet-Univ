<?php
//print_r($gallery);
$user_edit_op=array('3','6','7','10');
$user_delete_op=array('5','7','8','10');
$delete=0;
$edit=0;
foreach ($admin_priv as $admin_priv_res){ 
if($admin_priv_res['privilege_type_id']=='1' && in_array($admin_priv_res['privilege_level'],$user_delete_op))
{
$delete=1;
break;
}
}
foreach ($admin_priv as $admin_priv_res){ 
if($admin_priv_res['privilege_type_id']=='1' && in_array($admin_priv_res['privilege_level'],$user_edit_op))
{
$edit=1;
break;
}
}
$z=Array();
?>
<?php if($gallery!=$z) { ?>
<div id="content">
		<h2 class="margin">Update Gallery</h2>
		<div class="form span7 margin_zero">
			<form action="manage_home_gallery" method="post">

				<ul>
					<li>
						<div>
							<div class="span0 margin_zero">
								<label><h3><center>S.No.</center></h3></label>
							</div>
							<div class="span1">
								<label><h3><center>Image</center></h3></label>
							</div>
							<div class="span2">
								<label><h3><center>Title</center></h3></label>
							</div>
							<div class="span3">
								<label><h3><center>Caption</center></h3></label>
							</div>
							<div class="span2">
								<label><h3><center>Link To</center></h3></label>
							</div>
							<div class="span0">
								<label><h3><center></center></h3></label>
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
					<?php
					foreach($gallery as $gallery_info){

					?>
					<li>
						<div>
							<div class="span0 margin_zero">
								<label><h3><center><?php echo $gallery_info['id'];?>
								<input type="hidden" name="g_id[]" value="<?php echo $gallery_info['id'];?>"></center></h3></label>
							</div>
							<div class="span1">
								<img src="<?php echo "$base";?>/uploads/home_gallery/<?php echo $gallery_info['image_path'];?>" align="middle" class="img_width">
							</div>
							<div class="span2">
								<label><input type="textbox"  name="title[]" class="text_box"  value="<?php echo $gallery_info['title']; ?>" <?php if($edit!='1') {?> readonly="readonly" <?php } ?>  ></label>
							</div>
							<div class="span3">
								<label><textarea rows="3" name="image_caption[]" <?php if($edit!='1') {?> readonly="readonly" <?php } ?>  cols="32"><?php echo $gallery_info['image_caption']; ?></textarea></label>
							</div>
							<div class="span2">
								<label><input type="text" name="link_to[]" <?php if($edit!='1') { ?> readonly="readonly" <?php } ?> value="<?php echo $gallery_info['event_link_path'];?>"  size="20" class="text text_box"></label>
							</div>
							<?php if($delete=='1')
							{?>
							<div class="span0">
								<div class="center"><a href="#"><img src="<?php echo "$base$img_path";  ?>/admin/close.png" align="middle" onclick="delete_confirm('<?php echo "$base$admin";?>',<?php echo $gallery_info['id']; ?>)"></a></div>
							</div>
							<?php } ?>
							<div class="clearfix"></div>
						</div>
					</li>
					<hr></hr>
					<?php } ?>
				</ul>
					<?php	if($edit=='1') {?>
					<input type="submit" class="submit" name="update" value="Update">
					<?php } ?>
						
				</form>
</div>
		
		
	</div> 
	<?php } else { ?>
	<div id="content">
		<div class="message info"><p>Please Add the Gallery </p></div> 
		</div>
	<?php } ?>
	<script>
function delete_confirm(adminbase,gid)
{
var r=confirm("Are U sure u want to delete this image?");
if (r==true)
  {
  window.location.href=adminbase+'/manage_home_gallery/'+gid;
  }

}
</script>		