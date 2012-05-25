<?php
$content = "";
if(!empty($user_list))
{
foreach($user_list as $user_list)
{
if($user_list['user_pic_path'] != '')
{
	$pic = $user_list['user_pic_path'];
}
else if($user_list['gender'] == 'male'){
$pic = "user_model.png";
}
else if($user_list['gender'] == 'female'){
$pic = "user_model_female.jpg";
}
else{
$pic = "user_model.png";
}
if($user_list['fullname'] != '')
{
	$name = $user_list['fullname'];
}
else {
$name = "Name not available";
}
$content.= "<div class='float_l'>".
				"<img src='".base_url()."uploads/".$pic."' class='search_result'/>".
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