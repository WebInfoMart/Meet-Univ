<?php
$regs='<option value="0">Select City</option>';
//print_r($region);
foreach($region as $reg) { 
$regs.="<option value=$reg[city_id]>".$reg['cityname']."</option>";
 }
echo $regs;
?>