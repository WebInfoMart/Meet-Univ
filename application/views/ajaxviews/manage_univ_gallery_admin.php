<?php if ($count) { ?>
<ul class="imglist">
<?php foreach($gallery as $gal_images) {
if(file_exists(getcwd().'/uploads/univ_gallery/'.$gal_images['g_image_path']) && $gal_images['g_image_path']!='')	
{									
 ?>	
	<li>		
	<img src="<?php echo "$base";?>uploads/univ_gallery/<?php echo $gal_images['g_image_path']; ?>" style="height:100px;width:100px;" />	
	<ul>
	<li class="view" >
	<a href="<?php echo "$base";?>uploads/univ_gallery/<?php echo $gal_images['g_image_path']; ?>" class="modal" rel="gallery" >View</a>
	</li>
	<?php if($delete=='1') { ?>
	<li class="delete"><a href="#" onclick='delete_confirm("<?php echo $base; ?>","<?php echo $gal_images['gid']; ?>")'> Delete</a></li>
	
	<?php } ?>				
	</ul>		
	</li>
	<?php } } ?>		
	</ul>
	<?php }
	else { ?>
	
	<div id="content">	
	<div class="message info"><p>No Images Uploaded Yet</p></div> </div>	
	
	<?php } ?>