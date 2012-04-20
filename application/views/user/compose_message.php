<?php
	if($msg_send_suc == 1)
	{
	?>
	<script>
	$(document).ready(function(){
	$('#show_success').css('display','block');
	$('#show_success').hide();
	$('#show_success').show("show");
	$("#show_success").delay(3000).fadeOut(200);
	});
	</script>
	<?php
	}
	$msg_send_suc = '';
	?>

	<div class="container">
		<div class="body_bar"></div>
		<div class="body_header"></div>
		<div class="body_container">
			<div class="row">
				<div class="margin_zero span16">
					<!--<div data-alert="alert" class="alert alert-message message">
								<a data-dismiss="alert" class="close">×</a>
								<div>
									<div class="float_l"><h2>Welcome! Let’s get started by</h2></div>
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
					
					<!-- send message successfully box -->
					<div class="modal" id="show_success" style="display:none;" >
					  <div class="modal-header">
						<a class="close" data-dismiss="modal"></a>
						<h3>Message For You</h3>
					  </div>
					  <div class="modal-body">
						<p><center><h4>Your Message Has been sent successfully.....</h4></center></p>
					  </div>
					  <div class="modal-footer">
						<!--<a href="#" class="btn">Close</a>-->
						<!--<a href="#" class="btn btn-primary">Save changes</a>-->
					  </div>
				</div>
					<!-- End here -->
					
					<div class="span13 float_r">
						<div class="span10 margin_zero float_l">
							<div class="search_box_profile">
								<h2>For Compose</h2>
								<div class="form-horizontal">
									<div class="control-group">
										<label class="control-label" for="input01">Email Id</label>
										<div class="controls">
											<input type="text" class="input-xlarge" id="search_user_email" name="search_user_email"/>
											<span class="help-inline"><input type="button" class="btn btn-success" name="search_user" id="search_user" value="Search"/></span>
										</div>
									</div>
								</div>
							</div>
							<form class="form-horizontal" action="" method="post" name="frm_msg">
							<div class="margin_t">
								
								<div class="margin_t" id="add_content" style="display:none;"> 
									
								</div>
								<div class="well" id="show_error" style="display:none;text-align:center;">
								
								</div>
							</div>
							<center><div id="show_process" style="display:none;"> <img src="<?php echo "$base$img_path" ?>/searching.gif" /> </div></center>
							<div class="margin_t" id="body_msg" style="display:none;">
								
								
									<div class="control-group">
										<label class="control-label" for="input01">Recipient</label>
										<div class="controls">
											<span class="help-inline" id="recipient_name"></span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="input01">Subject</label>
										<div class="controls">
											<input type="text" class="input-xlarge" id="msg_sub" name="msg_sub">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="textarea">Body</label>
										<div class="clearfix"></div>
										<div class="controls">
										<!--<textarea id="msg_body" name="msg_body" style="width:400px; height:200px;"></textarea>-->
											<textarea class="input-xlarge" id="msg_body" name="msg_body" rows="5"></textarea>
										</div>
									</div>
									<div class="margin_t">
										<div class="controls">
											<input type="submit" class="btn btn-primary" value="Send" name="msg_send_btn"/>
											</div>
									</div>
								</form>
							</div>
						</div>
						<div class="span3 float_l">
							<img src="images/banner_img.png">
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $logged_user_id = $query['id']; ?>
<script type="text/javascript">
$(document).ready(function(){
var logged_user_id = <?php echo $logged_user_id; ?>;

$('#search_user').click(function(){
$('#show_process').css("display","block");
var email = $("#search_user_email").val();
//alert(email);
$.ajax({
   type: "POST",
   url: "<?php echo $base; ?>user/search_user_list/"+email,
   data: "",
   cache: false,
   success: function(msg)
   {
	$('#add_content').css("display","none");
	$('#body_msg').css("display","none");
    //$('#state').attr('disabled', false);
	$('#add_content').html(msg);
	var get_hidden_id_user = $('#recp_id').val();
	if(get_hidden_id_user == logged_user_id )
	{
		var error = "You Can't Send Message To You !!!";
		$('#show_error').css("display","block");
		$('#show_error').html(error);
	}
	else{
	$('#show_process').hide("slow");
	$('#show_error').css("display","none");
	$('#add_content').css("display","block");
	$('#add_content').hide();
	$('#add_content').show("slow");
	if(msg != '')
	{
	$('#show_process').hide("slow");
	$('#body_msg').css("display","block");
	$('#body_msg').hide();
	$('#body_msg').show("slow");
	}
	else if(msg == '')
	{
	$('#show_process').hide("slow");
	$('#body_msg').css("display","none");
	var error = "Sorry...Email not found !!!";
		$('#show_error').css("display","block");
	$('#show_process').hide("slow");	
		$('#show_error').html(error);
	}
	}
	
	//$('#recipient_name').html(msg);
   }
   });
   });
   });
</script>

<!--<script type="text/javascript">
new TINY.editor.edit('editor',{
	id:'msg_body',
	width:584,
	height:175,
	cssclass:'te',
	controlclass:'tecontrol',
	rowclass:'teheader',
	dividerclass:'tedivider',
	controls:['bold','italic','underline','strikethrough','|','subscript','superscript','|',
			  'orderedlist','unorderedlist','|','outdent','indent','|','leftalign',
			  'centeralign','rightalign','blockjustify','|','unformat','|','undo','redo','n',
			  'font','size','style','|','image','hr','link','unlink','|','cut','copy','paste','print'],
	footer:true,
	fonts:['Verdana','Arial','Georgia','Trebuchet MS'],
	xhtml:true,
	cssfile:'style.css',
	bodyid:'editor',
	footerclass:'tefooter',
	toggle:{text:'source',activetext:'wysiwyg',cssclass:'toggle'},
	resize:{cssclass:'resize'}
});
</script>-->