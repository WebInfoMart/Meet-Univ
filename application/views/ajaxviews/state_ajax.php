<?php
$regs='<option value="0">Select state</option>';
//print_r($region);

foreach($univ_admins as $reg) { 
$sel='';
if($reg['id']==$ssid)
{
$sel='selected';
}
$regs.="<option value=$reg[state_id] $sel>".$reg['statename']."</option>";
}
 
echo $regs;
?>