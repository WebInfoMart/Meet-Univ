<div id="content_msg" style="display:none;" class="alert alert-success" style="z-index:99999">
 <a class="close" data-dismiss="alert" href="#">×</a>
  <strong>Question edited successfully</strong>
  </div>
  
<div id="newadded" class="alert alert-success " style="display:none;">
<div class="message info"><p>Answer Added Successfully</p></div> 
</div>  
<?php 
$edit=0;
$delete=0;
$view=0;
$ans=0;
$insert=0;
$event_edit_op=array('3','6','7','10');
$event_delete_op=array('5','7','8','10');
$event_insert_op=array('4','6','8','10');

foreach ($admin_priv as $admin_priv_res){ 
if($admin_priv_res['privilege_type_id']=='2' && $admin_priv_res['privilege_level']!=0)
{
$view=1;
if(in_array($admin_priv_res['privilege_level'],$event_edit_op))
{
$edit=1;
}
if(in_array($admin_priv_res['privilege_level'],$event_delete_op))
{
$delete=1;
}
if(in_array($admin_priv_res['privilege_level'],$event_insert_op))
{
$insert=1;
}
}
}
//print_r($ans_info);
foreach($ques_info as $ques_detail) { ?>
  <div class="content">
    <div class="container-fluid">
        <div class="row-fluid">
        <div class="span12">
          <div class="page-header clearfix tabs">
            <h2>Question</h2>
          </div>
          <div class="content-box">
            <div class="row-fluid">
				<div class="span12">
					 <form class="form-horizontal">
						<fieldset>
						<div class="row-fluid">
							<div class="span8">
								<div class="control-group margin_b">
									<label for="username" class="control-label">Title</label>
									<div class="controls">
									<div class="help-inline data1"><?php echo $ques_detail['q_title']; ?></div>
									<input type="text" id="title" style="display:none;" class="input-xlarge inputElement" value="<?php echo $ques_detail['q_title']; ?>">
									</div>
								</div>
								<div class="control-group margin_b">
									<label for="username" class="control-label">Detail</label>
									<div class="controls">
									<div class="help-inline data1"><?php echo $ques_detail['q_detail'];?> </div>
									<textarea  style="display:none;" id="detail" class="span11 inputElement" rows="4">
									<?php echo trim($ques_detail['q_detail']);?></textarea>
									</div>
								</div>								
								<input type="hidden" name="univ" id="univ" value="<?php echo $ques_detail['q_univ_id']; ?>">
					
								 <div class="modal hide" id="myModal">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>										
										<h3>Do you want to delete answer?</h3>
									</div>
									<div class="modal-footer">
										<a href="#"  onclick="delete_this_record('<?php echo $ans['comment_id']; ?>')" id="data_del_<?php echo $ans['comment_id']; ?>" class="btn" data-dismiss="modal">Yes</a>
											
										<a href="#" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>
								<?php
								if($ques_detail['q_univ_id'] != '0')
										{
											$question_title = str_replace(' ','-',$ques_detail['q_title']);
											$univ_domain=$ques_detail['subdomain_name'];
											$quest_title=$ques_detail['q_title'];
											$que_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'question',$quest_title,$ques_detail['que_id']);
											$url = $que_link;
										}
										else if($ques_detail['q_country_id']!= '0')
										{
											$url = "";
										}
										else
										{
											
											$question_title =$this->subdomain->process_url_title($ques_detail['q_title']);	
											$url = "MeetQuest/".$ques_detail['que_id']."/".$question_title."/".$ques_detail['q_askedby'];
											$url = $base.'otherQuestion'.'/'.$ques_detail['que_id'].'/'.$question_title;
										}
										//echo $url;
										?>
								<input type="hidden" id="que_url_<?php echo $ques_detail['que_id'] ?>" value="<?php echo $url;?>" />
						<input type="hidden" name="que_id[]" value="<?php echo $ques_detail['que_id'] ?>" >
								<?php if(!empty($ans_info))
								{ ?>
								<div class="control-group">
									<label for="username" class="control-label">Answers:</label>
									<?php foreach($ans_info  as $ans)
										{ ?>
									<div class="controls">									
									<div style="border:1px solid;" class="help-inline data1"><?php echo trim($ans['commented_text']);?></div>
									<div style="float:left;width:400px;">
									<textarea style="display:none;" name="text" id="ans_<?php echo $ans['comment_id']; ?>" class="span11 inputElement" rows="4"><?php echo trim($ans['commented_text']);?></textarea>
									</div>
									<div style="float:left;">
									<a href="javascript:void(0);" style="display:none;" onclick="delete_this_record('<?php echo $ans['comment_id']; ?>')" id="data_del_<?php echo $ans['comment_id']; ?>" class="inputElement"><img style="height:18px;" src="<?php echo $base; ?>images/admin/delete.png" alt="Delete"></a>
									
									<a href="javascript:void(0);"  style="display:none;" onclick="edit_ans('<?php echo $ans['comment_id']; ?>')" id="data_<?php echo $ans['comment_id']; ?>" class="inputElement"> <img  src="<?php echo $base; ?>images/admin/edit-icon.png" alt="Edit"></a>	
									</div>
									<div class="clearfix"></div>
									</div>
									<div id="content_drop_msg_<?php echo $ans['comment_id']; ?>" style="display:none;" class="alert alert-success">
									<div class="message info"><p>Record dropped !!!</p></div> 
									</div>
									<div id="content_<?php echo $ans['comment_id']; ?>" class="alert alert-success" style="display:none;">
									<div class="span8 margin_t">  
									<div class="message success"><p class="info_message">Answer Edited Successfully</p></div>  
									</div>  
									</div> 
									<?php } ?>
								</div>
								<?php } 
								if($edit==1)
								{
								?>
							<div class="form-actions">
									<a id="edit" class='btn btn-success pover' data-placement="top" data-content="Want to change" title="Edit">Edit</a>
									<a href="#" style="display:none;" id="update" onclick="update('<?php echo $ques_detail['que_id'];?>')" class='btn btn-success pover inputElement' data-placement="top" data-content="Update it" title="Update">Update</a>
									<a id="add_textarea" style="display:none;" class='btn btn-success pover inputElement' data-placement="top" data-content="Add box" title="Answer">Add Answer</a>
							</div>
							<?php } ?>
							</div>
						</div>
						</fieldset>
					</form>
				</div>
			</div>
          </div>
        </div>
      </div>
    </div><!-- close .container-fluid -->
  </div><!-- close .content -->
  <!-- END Content -->
<?php } ?>
   <script>
$(document).ready(function(){
	//alert('fnslfc');
	$('.collapsed-nav').css('display','none');
	var url = window.location.pathname; 
	var activePage = url.substring(url.lastIndexOf('/')+1);
	$('.mainNav li a').each(function(){  
		var currentPage = this.href.substring(this.href.lastIndexOf('/')+1);
		if (activePage == currentPage) {
			$('.mainNav li').removeClass('active');
			$('li').find('span').removeClass('label-white');
			$('li').find('i').removeClass('icon-white');
			$(this).parent().addClass('active'); 
			$(this).parent().find('span').addClass('label-white');
			$(this).parent().find('i').addClass('icon-white');
				$(this).parent().parent().css('display','block');
				if($(this).parent().parent().css('display','block'))
				{
					$(this).parent().parent().prev().parent().addClass('active');
					$(this).parent().parent().prev().find('span img').attr('src', 'img/toggle_minus.png');
					$(this).parent().parent().prev().find('span').addClass('label-white');
					$(this).parent().parent().prev().find('i').addClass('icon-white');
				}
			} 
		});
	});
 </script>
  <script>
	$(document).ready(function(){
		$("#edit").click(function() {
			$('form').find('.control-group').removeClass('margin_b');
			$('form').find('.help-inline').css('display', 'none');
			$('form').find('.inputElement').css('display', 'inline-block');
			//$('.answer').after('<a href="#myModal" data-toggle="modal" class="tip btn btn-icon margin_l" data-original-title="Delete Answer"><i class="icon-remove"></i></a>');
			$('form').find('.add-on').css('display', 'inline-block');
			$('form').find('.datepick, .timepicker').css('display', 'inline-block');
			$("#edit").hide();
		});	
		$("#add_textarea").click(function() {
			$('textarea').last().parent().parent().after('<div class="control-group"><div class="controls"><textarea style="display:inline-block" name="text" id="newans" class="span11 inputElement" rows="4"></textarea><a id="cross" title="close box" href="javascript:void(0)" onclick="closehh();" ><i class="icon-remove"></i></a></div></div>');
		$('#update').addClass('addanswer');
		$('#update').show();
		});
		
	});
function closehh()
		{		
			$('#update').removeClass('addanswer');
			$("#newans").remove();
			$("#cross").remove();
			
		}	
function update(id)
{
if($('#update').hasClass('addanswer') && $("#newans").val()!='')
{	
	var url='<?php echo $base; ?>newadmin/admin_ques/add_ans';
	var que_url=$('#que_url_'+id).val();	
	var answer=$("#newans").val();
	var data={id:id,answer:answer,que_url:que_url,ajax:'1'};		
        $.ajax({
          type: "POST",
          data: data,
          url: url,		 
          success: function(msg) 
		  {	 
		   if(msg='1')
			{				
				$("#newadded").show('slow');
			}				   
          }
        });
	
}
else
{ 
    var valid=true;	
	if($("#title").val()=='')
	{
		$("#title").addClass('needsfilled');
		valid=false;		
	}
	else
	{
		$("#title").removeClass('needsfilled');
	}
	if($("#detail").val()=='')
	{
		$("#detail").addClass('needsfilled');		
		valid=false;
	}
	else
	{
		$("#detail").removeClass('needsfilled');
	}	
	if(valid==true)
	{
		
	var univ=$('#univ').val();	
	 var title=$("#title").val();
	 var detail=$("#detail").val();
	 var data={univ:univ,title:title,detail:detail,ajax:'1'};
	 $.ajax({
	 type:'POST',
	 url:"<?php echo $base; ?>newadmin/admin_ques/edit_ques/"+id,
	 data:data,
	 success:function(msg)
	 {
		if(msg)
		{
			
			$("#content_msg").show();
			$("#content_msg").delay(5000).hide("slow");
		}
	 }
	 
	 });
		
	}
	
}
}
function delete_this_record(id)
	{
		var current_id = id;
		var ask_confirm = confirm("Do you want to drop this record?");
		var url='<?php echo $base;?>newadmin/admin_ques/droprecord';
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
					$("#content_drop_msg_"+current_id).delay(5000).hide("slow");
				}
			}
			});
		}
	}	
function edit_ans(id)
	{
	var ans=$("#ans_"+id).val();
	var data={id:id,ans:ans};
	var url='<?php echo $base;?>newadmin/admin_ques/edit_ans';
	$.ajax({
          type: "POST",
          data: data,
          url: url,         
          success: function(msg) {
		  	if(msg == '1')
			{	  
				$('#content_'+id).show();
				$('#content_'+id).delay(5000).hide("slow");
			}
          }
        });
	}
	
 </script>
