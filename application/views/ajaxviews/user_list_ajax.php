<?php
$content = "";
if(!empty($user_list))
{
foreach($user_list as $user_list)
{
if(file_exists(getcwd().'/uploads/user_pic/thumbs/'.$user_list['user_thumb_pic_path']) && $user_list['user_thumb_pic_path']!='' )
{
	$pic = base_url().'/uploads/user_pic/thumbs/'.$user_list['user_thumb_pic_path'];
}
else if(file_exists(getcwd().'/uploads/user_pic/'.$user_list['user_pic_path']) && $user_list['user_pic_path']!='')
{
	$pic = base_url().'/uploads/user_pic/'.$user_list['user_pic_path'];
}
else{
$pic = base_url()."images/profile_icon.png";
}
/* else if($user_list['gender'] == 'male'){
$pic = "user_model.png";
}
else if($user_list['gender'] == 'female'){
$pic = "user_model_female.jpg";
} */

if($user_list['fullname'] != '')
{
	$name = $user_list['fullname'];
}
else {
$name = "Name not available";
}
$content.= "<div class='float_l'>".
				"<img src='".$pic."' class='search_result'/>".
				"</div>".
				"<div class='float_l span8 margin_l margin_t1'>".
				"<a href='#' class='user_color'>".$name."</a></br>".
				"<input type='hidden' name='recp_id' id='recp_id' value=".$user_list['id'].">".
				"</div>".
				"<div class='clearfix'></div>";
		echo $content;
		//echo $user_list['fullname'];
	}
}
exit(0);
?>