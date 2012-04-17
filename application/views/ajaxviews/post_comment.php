<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=255162604516860";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="event_border hover_delete_comment_<?php echo $delete_comment; ?>">
								<div class="float_l">
									<div class="comment_img">
									<?php if($user_detail['user_pic_path']==''){?>
										<img src="<?php echo "$base$img_path"; ?>/user_model.png" />
								<?php } else { ?>		
								<img src="<?php echo "$base"; ?>uploads/<?php echo $user_detail['user_pic_path']; ?>" />
								<?php } ?>
									</div>
								</div>
								<div>
				<span class="float_r delete_comment" >
					<img style="cursor:pointer" onclick='delete_this_comment("<?php echo $delete_comment; ?>")' src="<?php echo "$base$img_path";?>/close.jpg">
			</span>

									<h4><a href="#" class="course_txt">
									<?php echo $user_detail['fullname']; ?>
									</a></h4>
									<?php echo $commented_text; ?>
									<div class="fb-like float_l" data-href="<?php $_SERVER["REQUEST_URI"]; ?>/<?php echo $commented_on; ?>_commentid/<?php echo $delete_comment; ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true" data-font="arial"></div>
									<div style="font-size;color:black;" class="float_r"><?php
									$time_now=mktime(date('h')+5,date('i')+30,date('s'));
									$date = date('h:i A',$time_now);
									$date =str_replace("/","-",$date);
									echo substr($date,0,16);?>
									</div>
								</div>
								<div class="clearfix"></div>
</div>