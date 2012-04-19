<?php
$regs='<option value="0">Select Country</option>';
//print_r($region);

foreach($country_list as $con) { 
// $sel='';
// if($col['state_id']==$ssid)
// {
// $sel='selected';
// }
$regs.="<option value=$con[country_id]>".$con['country_name']."</option>";
}
 
echo $regs;
?>