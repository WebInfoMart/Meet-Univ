<?php
$event_link_register=$this->subdomain->genereate_the_subdomain_link($event_detail['subdomain_name'],'event','','');
$facebook = new Facebook();
$user = $facebook->getUser();
$this->load->model('users');
if ($user) {
//$logoutUrl2 = $this->tank_auth->logout();
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me'); 
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}
$class_fullname='';
$class_email='';
$class_commented_text='';
$error_fullname = form_error('full_name');
$error_email = form_error('email');
$error_commented_text = form_error('commented_text');

if($error_fullname != '') { $class_fullname = 'focused_error'; } else { $class_fullname='input-xlarge'; }

if($error_email != '') { $class_email = 'focused_error'; } else { $class_email='input-xlarge'; }

if($error_commented_text != '') { $class_commented_text = 'focused_error'; } else { $class_commented_text='input-xxlarge'; }
?>	
<?php
$sms_suc_sess_val = "";
$sms_voice_suc_sess_val = "";
$show_suc_msg = "";
$sms_suc_sess_val = $this->session->userdata('msg_send_suc');
$sms_voice_suc_sess_val = $this->session->userdata('msg_send_suc_voice');
if($sms_suc_sess_val == 1)
{
	$show_suc_msg = "A Event Details has been send to you successfully.....";
}
else if($sms_voice_suc_sess_val == 1)
{
	$show_suc_msg = "A Reminder Voice SMS has been send to you successfully.....";
}
if($sms_suc_sess_val == '1' || $sms_voice_suc_sess_val == '1')
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
$this->session->unset_userdata('msg_send_suc');
$this->session->unset_userdata('msg_send_suc_voice');
?>
		<div id="wrapper">
			<div class="clearfix"></div>
			<div class="row" style="margin-top:-12px">
			<div class="modal" id="show_success" style="display:none;" >
					  <div class="modal-header">
						<a class="close" data-dismiss="modal"></a>
						<h3>Message For You</h3>
					  </div>
					  <div class="modal-body">
						<p><center><h4><?php echo $show_suc_msg; ?></h4></center></p>
					  </div>
					  <div class="modal-footer">
						<!--<a href="#" class="btn">Close</a>-->
						<!--<a href="#" class="btn btn-primary">Save changes</a>-->
					  </div>
				</div>
				<div class="span16 margin_l">
				<div class="float_l span13 margin_zero">
					<div>
						<div class="float_l span8 margin_zero">
						<div id="single_event_calendar">
							
							</div>
							<div class="span6 margin_zero">
							<?php 
						if($event_detail['event_date_time'] !=0 || $event_detail['event_date_time'] != '')
						{
								$array_dates = array();
								
								$var_date = '';
								//echo $event_detail['event_date_time'];
								$extract_date = explode(" ",$event_detail['event_date_time']);
								//echo $extract_date[];
								$month = $extract_date[1];
								$number_month = date('m', strtotime($month));
								//echo $extract_date[0];
								//echo $number_months; //= $number_month-1 ;
								//echo $extract_date[2];
								$var = "'".$number_month.'/'.$extract_date[0].'/'.$extract_date[2]."'";
								array_push($array_dates,$var);
						}
								?>
								<h3 class="inline">
								<?php 
								if($event_detail['event_category'] == "spot_admission"){
									echo "Spot Admission";
								} 
								else if($event_detail['event_category'] == "fairs")
								{
									echo "Fairs";
								}
								else if($event_detail['event_category'] == "others")
								{
									echo "Counselling";
								}
								else if($event_detail['event_category'] == "alumuni")
								{
									echo "Counselling";
								}
								echo '&nbsp;<span class="inline"> &raquo; </span>&nbsp;'.$event_detail['event_title'];
								?>
								
								</h3> 
								<div>
									<div><img src="<?php echo base_url(); ?>images/home.png" class="line_img inline"><span class="blue line_time inline">Event Venue:<?php echo $event_detail['event_place']; ?>
										</span></div>
									<div><img src="<?php echo base_url(); ?>images/city.png" class="line_img inline"><span class="blue line_time inline"><?php 
									
									if($event_detail['cityname']!='') { 
										echo $event_detail['cityname'];
									}
									if($event_detail['cityname']!='' && $event_detail['statename']!='')
									{
										echo ',&nbsp;'.$event_detail['statename'];
									}
									else if($event_detail['statename']!='')
									{
										echo $event_detail['statename'];
									}
									if(($event_detail['cityname']!='' || $event_detail['statename']!='') && $event_detail['country_name']!='')
									{
										echo ',&nbsp;'.$event_detail['country_name'];
									}
									else
									{
										echo $event_detail['country_name'];
									}
						// if($event_detail['country_name']!='') { 
						// echo $event_detail['country_name'];
						// }
						// if($event_detail['country_name']!='' && $event_detail['statename']!='')
						// {
						// echo ','.$event_detail['statename'];
						// }
						// else if($event_detail['statename']!='')
						// {
						// echo $event_detail['statename'];
						// }
						// if(($event_detail['country_name']!='' || $event_detail['statename']!='') && $event_detail['cityname']!='')
						// {
						// echo ','.$event_detail['cityname'];
						// }
						// else
						// {
						// echo $event_detail['cityname'];
						// }
						?></span></div>
										<div><img src="<?php echo base_url(); ?>images/clock.png" class="line_img inline"><span class="blue line_time inline">Timings: 
										<?php //echo $extract_date[0].' '.$extract_date[1].', '.$extract_date[2].'&nbsp;&nbsp;&nbsp;'.?><?php echo $event_detail['event_date_time'].' , '.$event_detail['event_time'];?></span></div>
										<div><img src="<?php echo base_url(); ?>images/group.png" class="line_img inline"><span class="blue line_time inline">Total Registered Users:
										<?php echo $total_register_user; ?></span></div>
										
								</div>
							</div>
							<div class="float_r">
								<div>
									<!--<a onclick="voicepopup('<?php //echo $event_detail['event_id']; ?>');" style="cursor:pointer" class="float_r"><img src="<?php //echo $base; ?>images/call.png" title="Reminder Call" alt="Reminder Call"></a>
										<a onclick="popup('<?php //echo $event_detail['event_id']; ?>');" style="cursor:pointer" class="float_r"><img src="<?php //echo $base; ?>images/sms.png" title="Send SMS" alt="Send SMS"></a>
										<div class="clearfix"></div>-->
								</div>
								<div class="margin_t1">
									<form action="<?php echo $event_link_register; ?>/EventRegistration" method="post">
									<input type="hidden" name="event_register_of_univ_id" value="<?php echo $event_detail['univ_id']; ?>"/>
									<input type="hidden" name="event_register_id" value="<?php echo $event_detail['event_id']; ?>"/>
									<input type="submit" name="btn_event_register" value="Register" class="btn btn-success" />
									</form>
								</div>
							</div>
								<div class="margin_t1">
									<div class="float_l span5 margin_zero course_cont"><?php echo $event_detail['event_detail']; ?></div>
									<div class="span3 float_r">
										<div class="map_layout">
									<?php echo $headerjs; ?>
									<?php echo $headermap; ?>
									<?php echo $onload; ?>
									<?php echo $map; ?>
									<?php echo $sidebar; ?>
								</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="margin_t1">
						<div class="event_border">
						<input type="hidden" id="txt_cnt_comment_show" value="<?php echo $total_comment; ?>"/>
							<h3><span id="cnt_comment_show"><?php if($total_comment==0){ echo "No"; } else { echo $total_comment;} ?></span> Comments Yet</h3>
						</div>
						<?php 
							if($event_comments!=0){
							$logged_user_id = $this->tank_auth->get_user_id(); 
						foreach($event_comments as $event_comments_detail){ ?>
						<div class="event_border find_comment hover_delete_comment_<?php echo $event_comments_detail['comment_id']; ?>">
							<div class="float_l">
								<div class="comment_img">
								
								<?php
							if(file_exists(getcwd().'/uploads/user_pic/thumbs/'.$event_comments_detail['user_thumb_pic_path']) && $event_comments_detail['user_thumb_pic_path']!='' )
							{
							//echo $image_thumb = $profile_pic['user_pic_path'].'_thumb';
							
								echo "<img src='".base_url()."uploads/user_pic/thumbs/".$event_comments_detail['user_thumb_pic_path']."'/>";
							}
							else if(file_exists(getcwd().'/uploads/user_pic/'.$event_comments_detail['user_pic_path']) && $event_comments_detail['user_pic_path']!='')
							{
								echo "<img src='".base_url()."uploads/user_pic/".$event_comments_detail['user_pic_path']."'/>";
							}
							else if($user && $event_comments_detail['commented_by'] == $logged_user_id)
							{
							?>
								<img src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=small">
							<?php
							}
							else{
							echo "<img src='".base_url()."images/profile_icon.png'/>";
							}
							?>
								</div>
							</div>
							<div>
							<?php if($user_is_logged_in ){
			if($user_detail['user_id']==$event_comments_detail['user_id'])
			{
			?>					
			<!--<span class="float_r delete_comment">
					<img style="cursor:pointer;" class="del_icon" onclick='delete_this_comment("<?php //echo $event_comments_detail['comment_id']; ?>")' src="<?php //echo "$base$img_path";?>/close.jpg">
			</span>-->
			<?php	} } ?>	
								
								<?php echo $event_comments_detail['commented_text'];?>
								<div style="font-size;color:black;" class="float_r">
								<abbr class="timeago time_ago" title="<?php echo $event_comments_detail['comment_time']; ?>"></abbr>
								</div>
							</div>
							<div class="clearfix"></div>
							<h4><span class="course_txt">
								<?php if($event_comments_detail['commented_by_user_name'] !=''){
									echo $event_comments_detail['commented_by_user_name']; 
									}
									else if($event_comments_detail['fullname'] !='')
									{
										echo $event_comments_detail['fullname'];
									}
									else if($user)
									{
										echo $user_profile['name'];
									} ?>
								</span></h4>
						</div> <?php } } ?>
					</div>
					<?php if($total_comment>4) { ?>
					<div  id="show_more">show more comment</div>
					<input type="hidden" id="show_more_offset" value="1">
					<?php } ?>
					<div class="margin_t margin_b">
						<div>
						<?php if($user_is_logged_in==0){ ?>		
						<div class="events_box" style="height: 53px;">
							<div>
							<div class="float_r">
								Have an account? <a href="<?php echo $base; ?>login">Log In</a> OR <a href="<?php echo $base; ?>register">Sign Up</a>
							</div>
							<div class="clearfix"></div>
							</div>
								<h3 class="center">Please Login for comment</h3>
						</div>
						<?php } else { ?>
							<div class="margin_t margin_bs">
							<div class="events_box">
							<div class="float_l">
									<div class="comment_img">
									
									<?php
							if(file_exists(getcwd().'/uploads/user_pic/thumbs/'.$user_detail['user_thumb_pic_path']) && $user_detail['user_thumb_pic_path']!='' )
							{
							//echo $image_thumb = $profile_pic['user_pic_path'].'_thumb';
							
								echo "<img src='".base_url()."uploads/user_pic/thumbs/".$user_detail['user_thumb_pic_path']."'/>";
							}
							else if(file_exists(getcwd().'/uploads/user_pic/'.$user_detail['user_pic_path']) && $user_detail['user_pic_path']!='')
							{
								echo "<img src='".base_url()."uploads/user_pic/".$user_detail['user_pic_path']."'/>";
							}
							else if($user)
							{
							?>
								<img src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=small">
							<?php
							}
							else{
							echo "<img src='".base_url()."images/profile_icon.png'/>";
							}
							?>
								<div style='width: 46px;position: absolute;' class="center">
								<?php
								if($user_detail['fullname'] !='')
								{
									echo $user_detail['fullname'];
								}
								else if($user)
								{
									echo $user_profile['name'];
								}
								?>
								</div>
									</div>
								</div>
								<div class="float_l span6 margin_zero">
									
									<form class="form-horizontal" method="post" action="">
									<div class="control-group">
											<div class="my_form_controls">
												<textarea class="<?php echo $class_commented_text; ?>" id="commented_text" name="commented_text" rows="3"></textarea>
											</div>
										</div>
										<div class="control-group">
											<div class="my_form_controls">
												<input type="button" onclick="post_comment();" class="btn btn-success" name="submit" value="Post Comment">
											</div>
										</div>
									</form>
								</div>
								
								<div class="clearfix"></div>
							</div>
						</div> <?php } ?>
						<input type="hidden" name="commented_on_id" id="commented_on_id" value="<?php echo $event_detail['event_id']; ?>" >
						<input type="hidden" name="commented_on" id="commented_on" value="event" >
						<input type="hidden"  id="lastcommentid" value="0" >
									
							<div class="clearfix"></div>
						</div>
					</div>
								
						</div>
						<div class="float_r span5">
							<div class="float_r social_set">
								<div class="float_l"><g:plusone size='medium' id='shareLink' annotation='none' href='<?php //$_SERVER["REQUEST_URI"]; ?>' callback='countGoogleShares' data-count="true"></g:plusone></div>
								<div class="float_l tw">
									<a href="https://twitter.com/share" class="twitter-share-button" data-via="munjal_sumit">Tweet</a>
								</div>
								<div class="float_r fb"><div class="fb-like" data-href="<?php //$_SERVER["REQUEST_URI"]; ?>" data-send="false" data-layout="button_count" data-width="10" data-show-faces="true"></div></div>
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
							<div class="back_up">
								<h3><img src="<?php echo base_url(); ?>images/home_cal.gif" style="z-index: 100;position: relative;top:6px;"><span style="position: relative;left: 10px;">Recently Added</span></h3>
								<ul class="up_event">
								<?php if(!empty($feature_event_of_univ)){
								foreach($feature_event_of_univ as $upcoming_event)
								{
								$event_link=$this->subdomain->genereate_the_subdomain_link(
								$upcoming_event['subdomain_name'],'event',$upcoming_event['event_title'],$upcoming_event['event_id']);
								?>
									<li><a href="<?php echo $event_link; ?>"><?php echo $upcoming_event['event_title']; ?></a></li>
								<?php } }
								else
								{
								echo "No Recent Event";
								}
								?>	
								</ul>
							</div>
							
						</div>
						<div class="clearfix"></div>
						
					</div>
					
					</div>
				<div class="float_r span3">
					<img src="<?php echo base_url(); ?>images/banner_img.png">
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	<!--  Div For Text SMS  -->					
<div id="myModal" class="model_back modal hide fade">
	<div class="modal-header no_border model_heading">
		<a class="close" data-dismiss="modal">x</a>
		<h3>Event Information</h3>
	</div>
	<div id="event_det" class="modal-body model_body_height">
	
	</div>
	</div>					
<!-- End Here -->
<!-- Div For Voice SMS -->
	<div id="myModal-voice" class="model_back modal hide fade">
	<div class="modal-header no_border model_heading">
		<a class="close" data-dismiss="modal">x</a>
		<h3>Event Information</h3>
	</div>
	<div id="event_det_voice" class="modal-body model_body_height">
	
	</div>
	</div>
	<!-- End Here -->
	
	<SCRIPT LANGUAGE="JavaScript">     
 function popup(id) {
 var loc = window.location;
  $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>leadcontroller/sms_me_event_ajax",
	   async:false,
	   data: 'event_id='+id,
	   cache: false,
	   success: function(msg)
	   {
		$('#event_det').html(msg);
		$('#sms_form').append("<input type='hidden' name='page_status' value='"+loc+"'/>");
		$('#myModal').modal({
        keyboard: false
    })
	  //$('#search_program').html(msg);
	   }
	   }) 
//alert(id);
/* var URL = "<?php echo site_url('leadcontroller/sms_me_event');?>";
//window.open("<?php echo site_url('controller/method/param1/param2/etc');?>", 'width=150,height=150'); 
day = new Date();
id = day.getTime();
window.open(URL, 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=880,height=300'); */
} 

function voicepopup(id) {
var loc = window.location;
  $.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>leadcontroller/sms_voice_me_event_ajax",
	   async:false,
	   data: 'event_id='+id,
	   cache: false,
	   success: function(msg)
	   {
	   $('#event_det_voice').html(msg);
		$('#sms_form_voice').append("<input type='hidden' name='page_status_voice' value='"+loc+"'/>");
		$('#myModal-voice').modal({
        keyboard: false
    })
	  //$('#search_program').html(msg);
	   }
	   }) 
}

function post_comment()
{
var commentedtext=$('#commented_text').val();
var commentd_on=$('#commented_on').val()
var commented_on_id=$('#commented_on_id').val();
var span_comment = $('#txt_cnt_comment_show').val();
var span_comment_incr = parseInt(span_comment)+1;
var user_id='<?php echo $this->ci->session->userdata('user_id'); ?>';
var fb_user_id='<?php echo $user; ?>';
var lastpostcommentid=$('#lastcommentid').val();
if($('#commented_text').val()!='')
{
	$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>univ/post_comment",
	   async:false,
	   data: 'commented_text='+commentedtext+'&commentd_on='+commentd_on+'&commented_on_id='+commented_on_id+'&user_id='+user_id+'&fb_user_id='+fb_user_id,
	   cache: false,
	   success: function(msg)
	   {
	    msgarr=msg.split('!@#$%^&*');
		var lastinsid=parseInt(msgarr[0]);
		if(lastpostcommentid=='0')
		{
		$('#lastcommentid').val(lastinsid);
		}
		$(".event_border:last").after(msgarr[1]);
		$('#commented_text').val('');
		$('#txt_cnt_comment_show').val(parseInt(span_comment)+1);
		$('#cnt_comment_show').html(span_comment_incr);
		}
	   });
}
   
}

/*$('.hover_delete_comment').hover(
                function () {
                 $(this).find('.delete_comment').css('display','block'); 				 
                },
                function () {
				 $(this).find('.delete_comment').css('display','none');  	   	
                }
            );*/
function delete_this_comment(comment_id)
{
var r=confirm("Do you want to delete the comment?");
var span_comment = $('#txt_cnt_comment_show').val();
var span_comment_incr = parseInt(span_comment) - 1;
if(span_comment_incr=='0')
{
span_comment_incr='No';
}
var user_id='<?php echo $this->ci->session->userdata('user_id'); ?>';
if(r)
{
$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>univ/delete_comment",
	   async:false,
	   data: 'comment_id='+comment_id+'&user_id='+user_id,
	   cache: false,
	   success: function(msg)
	   {
		$('.hover_delete_comment_'+comment_id).replaceWith('');
		$('#txt_cnt_comment_show').val(parseInt(span_comment)-1);
		$('#cnt_comment_show').html(span_comment_incr);
		}
	   });
}
}	

$('#show_more').click(function()
{
$('#show_more').text('Loading..');
var commentd_on=$('#commented_on').val();
var commented_on_id=$('#commented_on_id').val();
var offset=$('#show_more_offset').val();
offset=parseInt(offset);
var lastpostcommentid=$('#lastcommentid').val();
$('#show_more_offset').val(offset+1);
var fb_user_id='<?php echo $user; ?>';

var user_id='<?php echo $this->ci->session->userdata('user_id'); ?>';
var data={'user_id':user_id,'commented_on':commentd_on,'commented_on_id':commented_on_id,'offset':offset,'lastpostcommentid':lastpostcommentid,'fb_user_id':fb_user_id };
$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>univ/show_more_comment",
	   async:false,
	   data: data,
	   cache: false,
	   success: function(msg)
	   {
	   msgarr=msg.split('!@#$%^&*');
	   $('#wrapper').find('.find_comment:last').after(msgarr[1]);
	   if(msgarr[0]=='0')
	   {
	   $('#show_more').hide();
	   }
	   
	   $('#show_more').text('show more comment');

		//	alert(msg.toSource());
	}
	   });
});
jQuery(window).bind("load", function() {
var url=window.location;
postCook(url);
});	
</script>	