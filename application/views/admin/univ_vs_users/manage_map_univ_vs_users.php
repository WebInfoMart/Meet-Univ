<div id="content">
<h2>Manage Map University with users</h2>
<div class="form span8">
<form action="" method="post">	
<center>
<select name="users"  id="users" onchange="fetch_univ_map();">
<option value="0">Select User</option>
<?php
foreach($users_info as $get_user_info_list)
{?>

<option value="<?php echo $get_user_info_list['id']; ?>"><?php echo $get_user_info_list['fullname']; ?></option>
<?php } ?>
</select>
</center>
<div id="user_university">

</div>
</form>
</div>

</div>
<script>
function fetch_univ_map()
{
var userid=$('#users option:selected').val();;
if(userid!='0')
{
	 $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admin_users/fetch_univ_maped_with_user_ajax",
	   async:false,
	   data: 'user_id='+userid,
	   cache: false,
	   success: function(msg)
	   {
	    $('#user_university').html(msg);
		$('html, body').animate({
						scrollTop: 150
					}, 2000);
	   }
	   });
}
else
{
$('#user_university').html('');
}	   
}
</script>

