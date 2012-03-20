<div id="content">
<form method="post" action="" enctype="multipart/form-data">
<h4>Upload Home Gallery</h4>
<?php if (isset($a)) echo $a;?>
<input type="file" name="userfile[]" size="20" class="multi" multiple />
<br />
<input type="submit" name="upload">
</form>
</div>