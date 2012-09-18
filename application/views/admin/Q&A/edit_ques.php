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
<h2 class="margin">Edit Question</h2>	
<div class="form span8">
<?php 
foreach($ques_info as $ques_detail) { ?>			
<form action="<?php echo $base; ?>adminques/edit_ques/<?php echo $ques_detail['que_id']; ?>" method="post" class="caption_form" >				
<input type="hidden" name="ques_type_ud" value="univ_ques"/>
<ul>					
<li>						
<div>							
<div class="float_l span3 margin_zero">								
<label>Title</label>							
</div>							
<div class="float_l span3">		 		
<input type="hidden" size="30"  value="<?php echo $ques_detail['que_id']; ?>" name="que_id">				
<input type="text" size="30" class="<?php echo $class_title; ?>" value="<?php echo $ques_detail['q_title']; ?>" name="title">								
<span style="color: red;"> <?php echo form_error('title'); ?><?php echo isset($errors['title'])?$errors['title']:''; ?> 
</span>									
</div>														
<div class="clearfix"></div>						
</div>					
</li>				

<li>
<div class="float_l span3 margin_zero">							
<label>University</label>						
</div>	
<div class="float_l span3">	
<input type="text" disabled="disabled" size="30"  value="<?php echo $ques_detail['univ_name']; ?>" name="college">		
</div>
<div>	
<div class="clearfix"></div>						
	<div class="float_l span3 margin_zero">								
	<label>Detail</label>							
	</div>							
	<div class="">								
	<textarea rows="12" name="detail"  cols="103"><?php echo $ques_detail['q_detail'];?></textarea>								
	<span style="color: red;"> <?php echo form_error('detail'); ?><?php echo isset($errors['detail'])?$errors['detail']:''; ?> </span>							
	</div>							
	<div class="clearfix"></div>						
</div>					
</li>				
</ul>						
<input type="submit" name="submit" class="submit" value="Edit Question">									
</form>	
<?php } ?>
</div>					
</div>
