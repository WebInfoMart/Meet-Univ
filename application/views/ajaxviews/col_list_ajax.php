<?php
$regs='<option value="0">Select Collage</option>';
//print_r($region);

foreach($collage_list as $col) { 
// $sel='';
// if($col['state_id']==$ssid)
// {
// $sel='selected';
// }
$regs.="<option value=$col[univ_id]>".$col['univ_name']."</option>";
}
 
echo $regs;
?>