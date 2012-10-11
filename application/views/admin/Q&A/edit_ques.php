<style>
#content_msg {
	overflow: hidden;
	padding: 0 20px;
	left: 220px;
	width: 40%;
	position:absolute;
	}
#content_verify_message {
	overflow: hidden;
	padding: 0 20px;
	left: 220px;
	width: 82%;
	}
#content_drop_msg {
	overflow: hidden;
	padding: 0 20px;
	left: 220px;
	width: 35%;
	position:absolute;
	}		
.message.info {
	border: 1px solid #bbdbe0;
	background: #ecf9ff url(../../images/admin/info.gif) 12px 12px no-repeat;
	color: #0888c3;
	}
	
	.message {
	padding: 10px 15px 10px 40px;
	margin-bottom: 15px;
	font-weight: bold;
	overflow: hidden;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	}
	
</style>
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
<?php //print_r($ques_info);exit;
foreach($ques_info as $ques_detail) { ?>			
<form action="<?php echo $base; ?>adminques/edit_ques/<?php echo $ques_detail['que_id']; ?>" method="post" class="caption_form form_horizontal_data" >				
	<input type="hidden" name="ques_type_ud" value="univ_ques"/>
	<div class="control-group1">
		<label class="control-label1" for="select01">Title:</label>
		<div class="controls1">
			<input type="hidden" size="30"  value="<?php echo $ques_detail['que_id']; ?>" name="que_id">				
			<input type="text" size="30" class="<?php echo $class_title; ?>" value="<?php echo $ques_detail['q_title']; ?>" name="title">								
			<span style="color: red;"> <?php echo form_error('title'); ?><?php echo isset($errors['title'])?$errors['title']:''; ?> 
			</span>	
		</div>
	</div>
	<div class="control-group1">
		<label class="control-label1" for="select01">University:</label>
		<div class="controls1">
			<input type="text" disabled="disabled" size="30"  value="<?php echo $ques_detail['univ_name']; ?>" name="college">		
		</div>
	</div>
	<div class="control-group1">
		<label class="control-label1" for="select01">Detail:</label>
		<div class="controls1">
			<textarea rows="5" name="detail"  cols="50"><?php echo $ques_detail['q_detail'];?></textarea>								
			<span style="color: red;"> <?php echo form_error('detail'); ?><?php echo isset($errors['detail'])?$errors['detail']:''; ?> </span>		
		</div>
	</div>
	<div class="control-group1">
		<label class="control-label1" for="select01">Answers:</label>
		<div class="controls1">
			<?php foreach($ans_info  as $ans)
			{ ?>
			<textarea rows="5" id="ans_<?php echo $ans['comment_id']; ?>" cols="50" class="float_l"><?php echo $ans['commented_text'];?></textarea>
			<a href="javascript:void(0);" onclick="delete_this_record('<?php echo $ans['comment_id']; ?>')" id="data_del_<?php echo $ans['comment_id']; ?>" class="edit inline float_l"><img style="height:18px;" src="<?php echo $base; ?>images/admin/delete.png" alt="Delete"></a>				
			<a href="javascript:void(0);" onclick="edit_ans('<?php echo $ans['comment_id']; ?>')" id="data_<?php echo $ans['comment_id']; ?>" class="edit inline float_l"><img src="<?php echo $base; ?>images/admin/edit-icon.png" alt="Edit"></a>	
			<div id="content_drop_msg_<?php echo $ans['comment_id']; ?>" style="display:none;">
				<div class="message info"><p>Record dropped !!!</p></div> 
				</div>
				<div id="content_<?php echo $ans['comment_id']; ?>" class="content_msg" style="display:none;">
					<div class="span8 margin_t">  
						<div class="message success"><p class="info_message">Answer Edited Successfully</p></div>  
					</div>  
				</div> 
			<?php } ?>	
			<div class="clearfix"></div>
			</div>
		</div>
	<div class="control-group1">
		<div class="controls1">
			<input type="submit" name="submit" class="submit" value="Edit Question">									
		</div>
	</div>				
</form>	
<?php } ?>
</div>					
</div>
<script type="text/javascript">
	//var main_url = "<?php echo $base ?>";
	function delete_this_record(id)
	{
		var current_id = id;
		var ask_confirm = confirm("Do you want to drop this record?");
		var url='<?php echo $base;?>adminques/droprecord';
		if(ask_confirm)
		{
		$.ajax({
		type: "POST",
		data: "id="+id,
		url: url,
		async: false,
		cache: false,
		success: function(msg)
		{
			if(msg == '1')
			{
				$("#ans_"+current_id).hide("slow");
				$("#data_del_"+current_id).hide("slow");
				$("#data_"+current_id).hide("slow");
				$("#ans_"+current_id).replaceWith("");
				$("#content_drop_msg_"+current_id).css("display","block");
			}
		}
		});
		}
	}
	function edit_ans(id)
	{
	var ans=$("#ans_"+id).val();
	var data={id:id,ans:ans};
	var url='<?php echo $base;?>adminques/edit_ans';
	$.ajax({
          type: "POST",
          data: data,
          url: url,         
          success: function(msg) {
		  	if(msg == '1')
			{	  
				$('#content_'+id).show();
			}
          }
        });
	}
</script>	