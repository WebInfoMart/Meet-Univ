<?php

// $course_name_list='[';
// $ai=0;
// foreach($result as $res)
// {
	// $course_name_list.='{label: "'.$res['course_name'].'"}';
	// if($ai!=count($result)-1)
	// {
		// $course_name_list.=',';
	// }
	// $ai++;
// }
 // echo $course_name_list.=']';
 $course_name_list='';
$ai=0;
foreach($result as $res)
{
	$course_name_list.= $res['course_name'];
	if($ai!=count($result)-1)
	{
		$course_name_list.=',';
	}
	$ai++;
}
 echo $course_name_list;
 
?>
