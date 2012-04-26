
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
									
									<div style="font-size;color:black;" class="float_r"><?php
									$time_now=mktime(date('h')+5,date('i')+30,date('s'));
									$date = date('h:i A',$time_now);
									$date =str_replace("/","-",$date);
									echo substr($date,0,16);?>
									</div>
								</div>
								<div class="clearfix"></div>
</div>