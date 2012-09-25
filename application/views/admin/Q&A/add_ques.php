<div id="content" class="content_msg" style="display:none;">
<div class="span8 margin_t">  
<div class="message success"><p class="info_message"></p></div>  
</div>  
</div> 
<?php $class_title=''; 
$class_univ_name='';
$class_country='';
$class_state='';
$class_city='';
$error_title = form_error('title');
$error_univ_name = form_error('colleges');
if($error_title != '') 
{ $class_title = 'focused_error_univ'; } 
else 
{ $class_title='text'; }
if($error_univ_name != '') 
{ $class_univ_name = 'focused_error_univ'; } 
else { $class_univ_name='text'; }?>   
<div id="content">		
<h2 class="margin">Add Question</h2>	
<div class="form span8">			
<form action="<?php echo $base; ?>adminques/add_ques" method="post" class="caption_form" >				
<input type="hidden" name="ques_type_ud" value="univ_ques"/>
<ul>					
<li>						
<div>							
<div class="float_l span3 margin_zero">								
<label>Title</label>							
</div>							
<div class="float_l span3">								
<input type="text" size="30" class="<?php echo $class_title; ?>" value="<?php echo set_value('title'); ?>" name="title">								
<span style="color: red;"> <?php echo form_error('title'); ?><?php echo isset($errors['title'])?$errors['title']:''; ?> 
</span>									
</div>														
<div class="clearfix"></div>						
</div>					
</li>				

<li>
<?php if($admin_user_level['admin_user_level']!='3')
{ ?>					
<div class="float_l span3 margin_zero">							
<label>Select Categories</label>						
</div>	
<select class="span3" id="category" name="category" onchange="fetch_collage(this);">
<option value="general">Choose Type</option>			
<option value="univ">College</option>			
</select>
<div class="clearfix"></div>
<div class="float_l span3 margin_zero">							
<label>Choose University</label>						
</div>	
<select id="colleges" name="colleges" class="colege_set">
<option value="0"> select </option>	
</select>
<?php }
else
{ ?>
	<input type="hidden" id="category" value="univ" />	
	<input type="hidden" id="colleges" value="<?php echo $univ_info['univ_id']; ?>" />
<?php
}
?>
		
<div>							
	<div class="float_l span3 margin_zero">								
	<label>Detail</label>							
	</div>							
	<div class="">								
	<textarea rows="12" name="detail"  cols="103"><?php echo set_value('detail'); ?></textarea>								
	<span style="color: red;"> <?php echo form_error('detail'); ?><?php echo isset($errors['detail'])?$errors['detail']:''; ?> </span>							
	</div>							
	<div class="clearfix"></div>						
</div>					
</li>				
</ul>						
<input type="submit" name="submit" class="submit" value="Add ques">									
</form>		
</div>					
</div>
<script type="text/javascript">
function fetch_collage(values)
{
var type = values.value;
if(type == 'univ')
{
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>quest_ans_controler/collage_list_ajax",
   data: '',
   cache: false,
   success: function(msg)
   {
	$('#colleges').html(msg);
   }
   });
 }
 else if(type == 'sa')
 {
	$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>quest_ans_controler/country_list_ajax",
   data: '',
   cache: false,
   success: function(msg)
   {
	$('#colleges').html(msg);
   }
   });
 }
}
	</script>