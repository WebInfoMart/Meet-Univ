<?php
$facebook = new Facebook(array(
  'appId'  => '358428497523493',
  'secret' => '497eb1b9decd06c794d89704f293afdd',
));
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
	

			<div class="row" style="margin-top:-10px">
				<div class="float_l span13 margin_l">
					<div>
					<div class="float_r">
							<div class="float_l" style="margin-right:20px;"><g:plusone size="medium" annotation="none"></g:plusone></div>
							<div class="float_l" style="margin-right:-30px;"><div class="fb-like" data-href="<?php $_SERVER["REQUEST_URI"]; ?>" data-send="false" data-layout="button_count" data-width="10" data-show-faces="true" ></div></div>
							<div class="float_l">
								<a href="https://twitter.com/share" class="twitter-share-button" data-via="munjal_sumit" data-count="none">Tweet</a>
							</div>
						</div>
						<div class="float_l span4 margin_zero">
							<div id="single_event_calendar">
							
							</div>
						</div>
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
						<div class="float_r span9 page_univ">
							<h2><?php echo $event_detail['event_title']; ?>  <small><?php 
							if($event_detail['cityname']==''){} else{echo $event_detail['cityname'];}
							if($event_detail['statename']==''){} else{echo ', '.$event_detail['statename'];}
							if($event_detail['country_name']==''){} else{echo ', '.$event_detail['country_name'];} 
								
								
								?></small></h2> 
								<div class="float_r margin_t1">
								<form action="EventRegistration" method="post">
									<input type="hidden" name="event_register_of_univ_id" value="<?php echo $event_detail['univ_id']; ?>"/>
									<input type="hidden" name="event_register_id" value="<?php echo $event_detail['event_id']; ?>"/>
									<div class="float_r margin_t1">
									<input type="submit" name="btn_event_register" value="Register" class="btn btn-success" /></div>
								</div>
							<h3><?php echo $extract_date[1] ?> <?php echo ' '.$extract_date[0].' '.$extract_date[2];?></h3> 
							<h3>Timings: <?php echo $event_detail['event_time']; ?></h3>
							<!--<h3>Total Registered Users: <span class="blue">25</span></h3>-->
							
							<div class="margin_t1">
								<div class="course_cont"><?php echo $event_detail['event_detail']; ?></div>
							</div>
							
							<div class="margin_t1">
								<div class="map_layout">
									<?php echo $headerjs; ?>
									<?php echo $headermap; ?>
									<?php echo $onload; ?>
									<?php echo $map; ?>
									<?php echo $sidebar; ?>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="margin_t1">
						<div class="event_border">
							<input type="hidden" id="txt_cnt_comment_show" value="<?php echo count($event_comments); ?>"/>
								<h3><span id="cnt_comment_show"><?php echo count($event_comments); ?></span> Comments</h3>
							</div> 
							<?php if(count($event_comments)>0){
						foreach($event_comments as $event_comments_detail){ ?>
							<div class="event_border hover_delete_comment_<?php echo $event_comments_detail['comment_id']; ?>" >
								<div class="float_l">
									<div class="comment_img">
									<?php if($event_comments_detail['user_pic_path']==''){?>
										<img src="<?php echo "$base$img_path"; ?>/user_model.png" />
								<?php } else { ?>		
								<img src="<?php echo "$base"; ?>uploads/<?php echo $event_comments_detail['user_pic_path']; ?>" />
								<?php } ?>
									</div>
								</div>
								<div>
			<?php if($user_is_logged_in ){
			if($user_detail['user_id']==$event_comments_detail['user_id'])
			{
			?>					
			<span class="float_r delete_comment" >
					<img style="cursor:pointer;" class="del_icon" onclick='delete_this_comment("<?php echo $event_comments_detail['comment_id']; ?>")' src="<?php echo "$base$img_path";?>/close.jpg">
			</span>
			<?php	} } ?>				
									<h4 ><a href="#" class="course_txt">
									<?php if($event_comments_detail['commented_by_user_name']==''){
									echo $event_comments_detail['fullname'];
									}else{
									echo $event_comments_detail['commented_by_user_name']; 
									} ?>
									</a>
									</h4>
									<?php echo $event_comments_detail['commented_text'];?>
									<div style="font-size;color:black;" class="float_r"><?php
									echo substr($event_comments_detail['comment_time'],0,16);?></div>
								</div>
								<div class="clearfix"></div>
							</div>
				<?php }
					}?>			
						
					</div>
					<div class="margin_t margin_b">
						<div class="events_box">
							<?php if($user_is_logged_in==0){ ?>		
				<div class="events_box" style="height: 53px;">
				<div class="float_r">
					Have an account? <a href="<?php echo $base; ?>login">Log In</a> OR <a href="<?php echo $base; ?>register">Sign Up</a>
				</div>
				<div class="float_l" style="margin-top: 30px; margin-left: 311px;">
				<center><h3>Please Login for comment</h3></center>
				</div>
				</div>
				<?php } else { ?>
				<div class="margin_t margin_bs">
							<div class="events_box">
							<div class="float_l">
									<div class="comment_img">
									<?php if($user)
									{ ?>
									<img src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=small">
									<?php }
									else if($user_detail['user_pic_path']==''){?>
										<img src="<?php echo "$base$img_path"; ?>/user_model.png" />
								<?php } else { ?>		
								<img src="<?php echo "$base"; ?>uploads/<?php echo $user_detail['user_pic_path']; ?>" />
								<?php } echo $user_detail['fullname']; ?>
									</div>
								</div>
								<div class="float_l span9 margin_zero">
									<form class="form-horizontal" method="post" action="">
									<input type="hidden" name="commented_on_id" id="commented_on_id" value="<?php echo $event_detail['event_id']; ?>" >
									<input type="hidden" name="commented_on" id="commented_on" value="event" >
										<div class="control-group">
											<div class="my_form_controls">
												<textarea class="<?php echo $class_commented_text; ?>" id="commented_text" name="commented_text" rows="3">
												</textarea>
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
						</div>
				<?php } ?>
				
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
				<div class="float_r span3">
					<img src="images/banner_img.png">
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	
<script>

function post_comment()
{
var commentedtext=$('#commented_text').val();
var commentd_on=$('#commented_on').val()
var commented_on_id=$('#commented_on_id').val();
var span_comment = $('#txt_cnt_comment_show').val();
var span_comment_incr = parseInt(span_comment) + 1;
if($('#commented_text').val()!='')
{
	$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>univ/post_comment",
	   async:false,
	   data: 'commented_text='+commentedtext+'&commentd_on='+commentd_on+'&commented_on_id='+commented_on_id,
	   cache: false,
	   success: function(msg)
	   {
		
		$(".event_border:last").after(msg);
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
var r=confirm("Want to Delete this comment");
var span_comment = $('#txt_cnt_comment_show').val();
var span_comment_incr = parseInt(span_comment) - 1;
if(r)
{
$.ajax({
	   type: "POST",
	   url: "<?php echo $base; ?>univ/delete_comment",
	   async:false,
	   data: 'comment_id='+comment_id,
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
</script>	
<?php 
$array_dates=implode(',',$array_dates);
//echo $event_detail['event_date_time'];
$show_date = '';
								//echo $event_detail['event_date_time'];
								$show_current_date = explode(" ",$event_detail['event_date_time']);
								//echo $extract_date[];
								$month = $extract_date[1];
								//echo $show_current_date[2];
								$number_month = date('m', strtotime($month));
								$number_month = $number_month -1;
			// foreach($array_dates as $dates){
			// echo $dates;
			// }?>
<script type="text/javascript">
var x = new Array(<?php echo $array_dates; ?>);
//'12/04/2012';
			$(document).ready(function () {
				//$("#example").thingerlyCalendar();
				$("#single_event_calendar").thingerlyCalendar({
					'month' : <?php echo $number_month; ?>,
					'year' : <?php echo $show_current_date[2]; ?>,
          'transition' : 'slide',
					'viewTransition' : 'fade',
          'events' : [
		  <?php echo $array_dates; ?>
          ]
          });

			});
		</script>