
	<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body_container">
			<div class="row">
				<div class="margin_zero span16">
					<!--<div data-alert="alert" class="alert alert-message message">
								<a data-dismiss="alert" class="close"></a>
								<div>
									<div class="float_l"><h2>Welcome! Let&#8217;s get started by</h2></div>
									<div class="float_r close_cont"> <span> Don't want our help? </span> Close Tips </div>
									<div class="clearfix"></div>
								</div>
								<nav id="help-tools">
									<ul>
										<li class="text_dec">1) Step 1</li>
										<li><a href="#">2) Step 2</a></li>
										<li><a href="#">3) Step 3</a></li>
										<li><a href="#">4) Step 4</a></li>
									</ul>
								</nav>
					</div>-->
					<?php $this->load->view('user/profile-sidebar.php'); ?>
					<div class="span13 float_r">
						<div class="span10 margin_zero float_l">
							<div class="inbox_box">
								<h2>Sent Mail</h2>
								<ul class="inbox_list">
								<form action="delete_message_outbox" method="post" id="message_delete_form">
								<?php
								if(!empty($inbox_messages))
								{
								$checkbox_numbering = 0;
								foreach($inbox_messages as $messages)
								{
								
								?>
									<li style="background-color:lightgray;border:1px solid whiteSmoke">
										<div class="span0 margin_zero">
											<input type="checkbox" name="msg[]" id="<?php echo $checkbox_numbering; ?>" value="<?php echo $messages['id'] ? $messages['id']: ''; ?>">
								<input type="hidden" name="msg_inbox_status[]" value="<?php echo $messages['msg_inbox_status']; ?>">
										</div>
										<a href="<?php echo "$base"; ?>outbox/<?php echo $messages['id']; ?>">
										<div class="span2 margin_l">
											<span><?php echo $messages['subject']!='' ? $messages['subject'] : 'No Subject' ; ?></span>
										</div>
										<div class="span6 margin_l span6_modified">
											<div><?php echo $messages['body']!='' ? $messages['body'] : 'Empty Message' ; ?></div>
										</div>
										</a>
										<div class="span1 margin_l span1_modified">
											<?php echo $messages['ontime']!='' ? $messages['ontime'] : 'Time not Found' ; ?>
										</div>
										
										<div class="span0 margin_l">
<a href="#" id="<?php echo $messages['id']; ?>" name="del_single_msg" onclick="deletechecked(this,'<?php echo $base; ?>','<?php echo $messages['msg_inbox_status']; ?> ')"><i class="icon-remove"></i></a>
										</div>
										<div class="clearfix"></div>
									</li>
								<?php $checkbox_numbering++; } } else { echo "Empty Message Outbox..."; } ?>
									
								</ul>
								<div class="float_r">
								<?php if(!empty($inbox_messages)) { ?>
							<input type="hidden" name="msg_delete" value="1">
				<input type="button" onclick="deletechecked(this,'<?php echo $base; ?>','null');" class="btn btn-success" name="del_multi_msg" value="Delete" />
								<?php } ?>	
								</form>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="span3 float_l">
							<a href="http://university-of-greenwich.meetuniversities.com/university_events"><img src="<?php echo "$base$img_path" ?>/banner_img.png"></a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	function deletechecked(atr,base,inbox_status)
{
	var name = atr.name;
	if(name == 'del_multi_msg')
	{
	var checked = $('input[name="msg[]"]:checked').length;
	if(checked==0)
	{
		alert("Please select at least one message");
	}
	else
	{
    var answer = confirm("Are you sure to Delete selected  messages ?");
    if (answer){
        $('#message_delete_form').submit();
    }
	}
	}
	else if(name == 'del_single_msg') {
	var answer1 = confirm("Are you sure you to Delete this message ?");
	 if (answer1){
	 var id=atr.id;
	 id=id.trim();
	  window.location=base+'delete_message_outbox/'+id+'/'+inbox_status;
    }
	}
  
} 
	</script>