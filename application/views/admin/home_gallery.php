<div id="content">
<form method="post" action="" enctype="multipart/form-data">
<h2>Upload Home Gallery</h2>
<h4>File size must be less than 500kb</h4>
<?php if (isset($a)) echo $a;?>
<input type="file" name="userfile1[]" size="20" class="multi" multiple />
<br />
<input type="submit" class="submit" name="upload">
</form>
</div>