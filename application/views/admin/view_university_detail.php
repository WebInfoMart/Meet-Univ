<?php
foreach($user_detail_edit as $user_detail){
?>
<div id="content">
<h2 class="margin">User Detail</h2>
<div class="form span7">
	<form class="form_horizontal_data">
		<input type="hidden" name="hid_user_id" value="<?php echo $user_detail->id; ?>" >
		<div class="control-group1">
			<label class="control-label1" for="select01">FULLNAME:</label>
			<div class="controls1">
				<input type="text" disabled="disabled"  size="30" class="blue" value="<?php echo $user_detail->fullname; ?>" name="fullname"> 		
			</div>
		</div>
		<div class="control-group1">
			<label class="control-label1" for="select01">EMAIL:</label>
			<div class="controls1">
				<input type="text" disabled="disabled" size="30" class="blue" readonly="readonly" value="<?php echo $user_detail->email; ?>"> 		
			</div>
		</div>
		<div class="control-group1">
			<label class="control-label1" for="select01">USER ROLL:</label>
			<div class="controls1">
				<input type="text" size="30" class="blue" readonly="readonly" value="<?php if($user_detail->level=='4'){ echo "ADMIN"; } 
						else if($user_detail->level=='3') { echo "UNIVERSITY ADMIN" ;}
						else if($user_detail->level=='2'){echo  "COUNSELLOR";}
						else if($user_detail->level=='1') {echo "STUDENT";}
						//current user level and id		
						$user_level=$user_detail->level;
						$user_id=$user_detail->id;
						}
						?>">	
			</div>
		</div>
	</form>				
</div>
</div>