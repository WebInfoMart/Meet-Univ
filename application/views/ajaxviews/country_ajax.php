<?php
$regs='<option value="0">Select state</option>';
//print_r($region);

foreach($region as $reg) { 
$sel='';
if($reg['country_id']==$scid)
{
$sel='selected';
}
$regs.="<option value=$reg[country_id] $sel>".$reg['country_name']."</option>";
}
 
echo $regs;
?>