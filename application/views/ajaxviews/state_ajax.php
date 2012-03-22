<?php
$regs='<option value="0">Select state</option>';
//print_r($region);
foreach($region as $reg) { 
$regs.="<option value=$reg[state_id]>".$reg['statename']."</option>";
 }
echo $regs;
?>