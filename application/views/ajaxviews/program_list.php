<?php
$res1='<option value="0">Select Program</option>';
//print_r($region);

foreach($result as $res) { 
$res1.="<option value=$res[prog_parent_id] >".$res['program_parent_name']."</option>";
}
 
echo $res1;
?>