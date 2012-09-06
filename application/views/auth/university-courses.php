
		<div class="row" style="margin-top:-40px">
			<div class="span12 float_l margin_l margin_t">	
				<h1 class="course_txt">Academic Programs</h1>
					<div>
						<ul class="course_list">
							<?php
							//echo $university_name;
							if(!empty($prog_title_of_univ))
							{
							foreach($prog_title_of_univ as $show_title)
								{
			
		$univ_domain=$show_title['subdomain_name'];
		$prog_title=$show_title['prog_title'];
		$prog_id=$show_title['prog_id'];
		
		$prog_link=$this->subdomain->genereate_the_subdomain_link($univ_domain,'programs',$prog_title,$prog_id);?>
							
								<li>
			<a href="<?php echo $prog_link; ?>"><h2><?php echo $show_title['course_name']; ?> </h2></a>
								<span class="course_tit"><?php echo $show_title['educ_level']; ?> </span></li>
								<?php 
								}
							} else { echo "</br><h4>We are gathering information about $university_name. Please visit back soon</h4>"; } ?>
							
						</ul>
					</div>
			</div>
			<?php $this->load->view('auth/univ-fb-sidebar'); ?>
			<div class="clearfix"></div>
		</div>
</div>
</div>
		