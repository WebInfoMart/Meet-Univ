<?php
foreach($user_detail_edit as $user_detail){
?>
<div id="content">
<h2 class="margin">User Detail</h2>
<div class="form span7">
				<form>
				<div class="span6">
				<input type="hidden" name="hid_user_id" value="<?php echo $user_detail->id; ?>" >
						<div>
							<label>FULLNAME:<input type="text" disabled="disabled"  size="30" class="text blue float_r" value="<?php echo $user_detail->fullname; ?>" name="fullname"> 
							
						</div> 
						<div>
							<label>EMAIL:<input type="text" disabled="disabled" size="30" class="text blue float_r" readonly="readonly" value="<?php echo $user_detail->email; ?>"> 
							
						</div>
						
						
						
						<div><label>USER ROLL
						<input type="text" size="30" class="text blue float_r" readonly="readonly" value="<?php if($user_detail->level=='4'){ echo "ADMIN"; } 
						else if($user_detail->level=='3') { echo "UNIVERSITY ADMIN" ;}
						else if($user_detail->level=='2'){echo  "COUNSELLOR";}
						else if($user_detail->level=='1') {echo "STUDENT";}
						//current user level and id		
						$user_level=$user_detail->level;
						$user_id=$user_detail->id;
						}
						?>"></label>
					</div>
			</div>	
			</form>				
			</div>
</div>