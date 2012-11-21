<?php
$regs='<option value="0">Select City</option>';
//print_r($region);
foreach($region as $reg) {
$sel='';
if($reg['city_id']==$scid)
{
$sel='selected';
} 
$regs.="<option value=$reg[city_id] $sel>".$reg['cityname']."</option>";
}
echo $regs;
?>