<div id="content">
<h2>Manage Gallery</h2>
<?php if($admin_user_level=='3') {?>
<ul class="imglist">
<?php
foreach($gallery as $gal_images)
{
?>
		<li>
				<img src="<?php echo "$base";?>uploads/univ_gallery/<?php echo $gal_images['g_image_path']; ?>" style="height:100px;width:100px;" />
				<ul>
					<li class="view"><a href="<?php echo "$base";?>uploads/univ_gallery/<?php echo $gal_images['g_image_path']; ?>" class="modal" rel="gallery" title="Summer boat">View</a></li>
					<li class="delete"><a href="#" onclick='delete_confirm("<?php echo $base; ?>","<?php echo $gal_images['gid']; ?>","1")'>Delete</a></li>
				</ul>
		</li>
<?php } ?>		
</ul>
<?php } else { ?>
			<form action="" method="post" id="deleteform">
				<ul >
						<li>
						<div>
						<div class="float_l span3 margin_zero">
							<label>Choose University</label>
						</div>
						<div class="float_l span3">
							<select class="text styled span3 margin_zero" name="university" id="university" onchange="get_univ_gallery_detail();">
								<option value="">Please Select</option>
									<?php foreach($univ_info as $univ_detail) { ?>
										<option value="<?php echo $univ_detail->univ_id; ?>" ><?php echo $univ_detail->univ_name; ?></option>
										<?php } ?>
							</select>
		
						</div>
						<div class="clearfix"></div>
						</div>
					</li>
				</ul>	
				<div id="univ_gallery" >
				
				</div>		
			</form>	
</div>
<?php } ?>
</div>
<script>
function delete_confirm(base,picid)
{
var r=confirm("Are U sure u want to delete this image?");
if (r==true)
  {
  window.location.href=base+'admin/manage_univ_gallery/'+picid;
  }

}
function get_univ_gallery_detail()
{
var univid=$("#university option:selected").val();
$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admin/fetch_univ_gallery_ajax",
	   async:false,
	   data:'univ_id='+univid,
	   cache: false,
	   success: function(msg)
	   {
	   $('#univ_gallery').html(msg);
	   $('a.modal').fancybox({
		'overlayOpacity':	0.7,
		'overlayColor'	:	'#000',
		'padding'		:	0
	});
	   }
})
}
</script>