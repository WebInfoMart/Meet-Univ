
<div class="event_border hover_delete_comment_<?php echo $delete_comment; ?>">
								<div class="float_l">
									<div class="comment_img" style="margin-right:10px;">
									<?php if($user_detail['user_pic_path']==''){?>
										<img src="<?php echo "$base$img_path"; ?>/user_model.png" />
								<?php } else { ?>		
								<img src="<?php echo "$base"; ?>uploads/<?php echo $user_detail['user_pic_path']; ?>" />
								<?php } ?>
									</div>
								</div>
								<div>
				<span class="float_r delete_comment" >
					<img style="cursor:pointer" class="del_icon" onclick='delete_this_comment("<?php echo $delete_comment; ?>")' src="<?php echo "$base$img_path";?>/close.jpg">
			</span>

									<h4><a href="#" class="course_txt">
									<?php echo $user_detail['fullname']; ?>
									</a></h4>
									<?php echo $commented_text; ?>
									
									<div style="font-size;color:black;" class="float_r">
									<?php
											$date = date("Y-m-d H:i:s");				
											$original=time($date);
											$hr  = 5;
											$min = 30;
											$sec = 0;
											$modified = $original+$sec+($min*60)+($hr*60*60);				
								   ?>		
								<abbr class="timeago time_ago" title="<?php echo date('Y-m-d H:i:s', $modified) ?>"></abbr>
									</div>
								</div>
								<div class="clearfix"></div>
</div>
<script>
jQuery(document).ready(function() {
  jQuery("abbr.timeago").timeago();
});
</script>