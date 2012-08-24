<?php
$regs='<option value="0">Select Univ Admin</option>';
//print_r($region);

foreach($univ_admins as $reg) { 
$sel='';
if($reg['id']==$uai)
{
$sel='selected';
}
$regs.="<option value=$reg[id] $sel>".$reg['fullname']."</option>";
}
 
echo $regs;
?>