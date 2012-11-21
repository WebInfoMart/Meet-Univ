<?php
$regs='';
foreach($collage_list as $col) { 
$regs.="<option value=$col[univ_id]>".$col['univ_name']."</option>";
} 
echo $regs;
?>