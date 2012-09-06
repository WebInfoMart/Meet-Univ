<div id="content">
<form method="post" action="<?php echo $base; ?>admincourses/upload_courses" enctype="multipart/form-data">
<h2>Upload The Programs In Bulk</h2><h4>(Only Upload .xls file(In 1997/2003 format)</h4>
<?php if (isset($a)) echo $a;?>
<input type="file" name="userfile" size="20"  />
<br /><br />
<input type="submit" class="submit" name="upload">
</form>
</div>