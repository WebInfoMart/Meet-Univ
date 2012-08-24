<div id="content">
			
		<h2 class="margin">Map University and SubCourse</h2>
		<div class="form span8">
	<form action="<?php echo $base; ?>admincourses/map_program_and_university" method="post" class="caption_form">
<div>
<center><h4>Please Select College</h4></center>
<center>

<select name="university" id="university" onchange="populate_program();">
<option value="">Select College</option> 
<?php foreach($university_detail as $university_details) { ?>
<option value="<?php echo $university_details['univ_id']; ?>"><?php echo $university_details['univ_name']; ?></option>
<?php } ?>
</select>
</center>
</div>

<div id="program_list" class="prog_css"  >

</div>	
</form>
		</div>
</div>		
<script>
function populate_program()
{
var univ=$("#university option:selected").val();
if(univ!='' && univ!=null)
{
$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>admincourses/fetch_univ_programs_ajax",
	  data: 'university='+univ,
	   cache: false,
	   success: function(msg)
	   {
	  // alert(msg);
	   $('#program_list').html(msg);
	   }
	   });
}
else
{
$('#program_list').html('');
}	   
}		
</script>