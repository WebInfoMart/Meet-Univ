	<div id="content">
		
		<div class="breadcrumb">
			<a href="#">Admin</a> &raquo; <a href="#">Add user</a> &raquo; <!--<a href="#">Subsection title</a> &raquo; <a href="#">Page title</a>-->
		</div>	
		<div class="span8">
			<div id="steps">
				<div class="step first active">
					<div class="num"><h3>1</h3></div>
					<div class="name"><h3 class="text_dec light">Sign Up</h3></div>
					<img src="http://apply.learnhub.com/layouts/default/images/dark_arrow.png" width="19" height="50" alt="Grey Arrow">
				</div>
				
				<div class="step first">
					<div class="num margin_l2"><h3>2</h3></div>
					<div class="name"><h3 class="orange">Privileges</h3></div>
					<img src="http://apply.learnhub.com/layouts/default/images/grey_arrow.png" width="19" height="50" alt="Grey Arrow">
				</div>
			</div>
			<div class="form">
				<form action="usercreated" method="post">
					<ul>
						<li>
							<div class="span3">
								<label><h3>MANAGE</h3></label>
							</div>
							<div class="span5">
								<div class="span1"><h5><center>VIEW</center></h5></div>
								<div class="span1"><h5><center>EDIT</center></h5></div>
								<div class="span1"><h5><center>INSERT</center></h5></div>
								<div class="span1"><h5><center>DELETE</center></h5></div>
								<div class="clearfix"></div>
							</div>
						</li>
						<?php 
						 
						//echo $new_user_level;
						foreach ($results as $privilage){
							if(($new_user_level==4 && $privilage['privilege_type_id']!=8 && $privilage['privilege_type_id']!=9) || ($new_user_level==2 && ($privilage['privilege_type_id']==8 || $privilage['privilege_type_id']==9)) || ($new_user_level==3 && ($privilage['privilege_type_id']==2 || $privilage['privilege_type_id']==3 || $privilage['privilege_type_id']==4 || $privilage['privilege_type_id']==6 || $privilage['privilege_type_id']==11 || $privilage['privilege_type_id']==12)))
							{

							?>
						
							<li>
							<div class="span3 margin_t">
								<label><h4><?php echo ucwords($privilage['privilege_name']);?></h4></label>
								<input type="hidden" name="privilege_type_id[]" value="<?php echo $privilage['privilege_type_id']; ?>">
								<input type="hidden" value="0" name="privilege_total[]" id="privilege_total_<?php echo $privilage['privilege_type_id']; ?>">
							</div>
							<div class="span5">
								<div class="span1"><p class="onoffswitch margin_l3">
									<span class="onoff_box" style="background-position-x: 0px; ">
									<input type="checkbox" id="view_<?php echo $privilage['privilege_type_id'];?>" name="view_<?php echo $privilage['privilege_type_id'];?>" value="1"  class="onoffbtn" ></span>
								</p>
								</div>
								<div class="span1"><p class="onoffswitch margin_l3">
									<span class="onoff_box checked"><input type="checkbox" id="edit_<?php echo $privilage['privilege_type_id'];?>" name="edit_<?php echo $privilage['privilege_type_id'];?>" value="2" class="onoffbtn priorop" ></span>
									</p>
								</div>
								<div class="span1"><p class="onoffswitch margin_l3">
									<span class="onoff_box checked"><input type="checkbox" id="insert_<?php echo $privilage['privilege_type_id'];?>" name="insert_<?php echo $privilage['privilege_type_id']?>"  value="3" class="onoffbtn priorop" ></span>
									</p>
								</div>
								<div class="span1"><p class="onoffswitch margin_l3">
									<span class="onoff_box checked"><input type="checkbox" id="delete_<?php echo $privilage['privilege_type_id'];?>" name="delete_<?php echo $privilage['privilege_type_id'];?>"  value="4" class="onoffbtn priorop" ></span>
									</p>
								</div>
								
							</div>
							<div class="clearfix"></div>
							</li>
					<?php
					 }
					 ?>
					<div class="clearfix"></div>
						<?php
					}?>
					
						
					</ul>
						<input type="submit" class="submit" value="Create New User">
				</form>		
			</div>
		</div>
	</div>
<script type="text/javascript">
//alert("hi");
</script>	
	