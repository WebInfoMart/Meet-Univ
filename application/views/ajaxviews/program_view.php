<?php
$res1='<option value="0">Select Program</option>';
//print_r($region);

foreach($result as $res) { 
$res1.="<option value=$res[prog_id] >".$res['course_name']."</option>";
}
 
echo $res1;
?>